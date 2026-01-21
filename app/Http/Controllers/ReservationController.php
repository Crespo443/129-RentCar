<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReservationController extends Controller
{
    /**
     * Display all reservations (Admin)
     */
    public function index()
    {
        $reservations = Reservation::with(['car', 'user'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.reservations', compact('reservations'));
    }

    /**
     * Show reservation form for a car
     */
    public function create($carId)
    {
        // Check if user is authenticated
        if (!session('user_login')) {
            return redirect('/')
                ->with('error', 'Silakan login terlebih dahulu untuk membuat reservasi.');
        }

        $car = Car::findOrFail($carId);

        // Check if car is available
        if ($car->status !== 'tersedia') {
            return redirect()->route('cars.show', $carId)
                ->with('error', 'Mobil ini sedang tidak tersedia untuk disewa.');
        }

        return view('createReservation', compact('car'));
    }

    /**
     * Store a new reservation
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'notes' => 'nullable|string|max:500',
        ], [
            'car_id.required' => 'Mobil harus dipilih.',
            'car_id.exists' => 'Mobil tidak ditemukan.',
            'start_date.required' => 'Tanggal mulai harus diisi.',
            'start_date.after_or_equal' => 'Tanggal mulai tidak boleh sebelum hari ini.',
            'end_date.required' => 'Tanggal selesai harus diisi.',
            'end_date.after' => 'Tanggal selesai harus setelah tanggal mulai.',
            'notes.max' => 'Catatan maksimal 500 karakter.',
        ]);

        $car = Car::findOrFail($validated['car_id']);

        // Check if car is available
        if ($car->status !== 'tersedia') {
            return back()->with('error', 'Mobil ini sedang tidak tersedia untuk disewa.');
        }

        // Calculate rental days
        $startDate = Carbon::parse($validated['start_date']);
        $endDate = Carbon::parse($validated['end_date']);
        $totalDays = $startDate->diffInDays($endDate) + 1; // Include both start and end date

        // Check minimum rental days
        if ($totalDays < $car->minimum_rental_days) {
            return back()->with('error', "Minimal sewa untuk mobil ini adalah {$car->minimum_rental_days} hari.");
        }

        // Check for conflicting reservations
        $hasConflict = Reservation::where('car_id', $car->id)
            ->where('status', '!=', 'dibatalkan')
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('start_date', [$startDate, $endDate])
                    ->orWhereBetween('end_date', [$startDate, $endDate])
                    ->orWhere(function ($q) use ($startDate, $endDate) {
                        $q->where('start_date', '<=', $startDate)
                            ->where('end_date', '>=', $endDate);
                    });
            })
            ->exists();

        if ($hasConflict) {
            return back()->with('error', 'Mobil sudah dipesan untuk tanggal tersebut. Silakan pilih tanggal lain.');
        }

        // Calculate total price (with discount if applicable)
        $pricePerDay = $car->discounted_price;
        $totalPrice = $pricePerDay * $totalDays;

        // Create reservation
        $reservation = Reservation::create([
            'car_id' => $car->id,
            'user_id' => session('user_id'),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'total_days' => $totalDays,
            'total_price' => $totalPrice,
            'status' => 'menunggu', // pending
            'payment_status' => 'belum_bayar', // unpaid
            'notes' => $validated['notes'],
        ]);

        // Update car status
        $car->status = 'disewa';
        $car->save();

        return redirect()->route('payments.show', $reservation->id)
            ->with('success', 'Reservasi berhasil dibuat. Silakan lanjutkan ke pembayaran.');
    }

    /**
     * Show reservation details
     */
    public function show($id)
    {
        $reservation = Reservation::with(['car', 'user'])
            ->where('id', $id)
            ->where('user_id', session('user_id'))
            ->firstOrFail();

        return view('user.reservation-details', compact('reservation'));
    }

    /**
     * Show user's reservations
     */
    public function myReservations()
    {
        $reservations = Reservation::with(['car'])
            ->where('user_id', session('user_id'))
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('user.my-reservations', compact('reservations'));
    }

    /**
     * Cancel a reservation
     */
    public function cancel($id)
    {
        $reservation = Reservation::where('id', $id)
            ->where('user_id', session('user_id'))
            ->firstOrFail();

        // Only allow cancellation for pending reservations
        if ($reservation->status !== 'menunggu') {
            return back()->with('error', 'Reservasi ini tidak dapat dibatalkan.');
        }

        $reservation->status = 'dibatalkan';
        $reservation->save();

        // Update car status back to available
        $car = $reservation->car;
        $car->status = 'tersedia';
        $car->save();

        return back()->with('success', 'Reservasi berhasil dibatalkan.');
    }

    /**
     * Approve reservation (Admin)
     */
    public function approve($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = 'dikonfirmasi';
        $reservation->save();

        return back()->with('success', 'Reservasi berhasil dikonfirmasi.');
    }

    /**
     * Reject reservation (Admin)
     */
    public function reject($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = 'dibatalkan';
        $reservation->save();

        // Update car status back to available
        $car = $reservation->car;
        $car->status = 'tersedia';
        $car->save();

        return back()->with('success', 'Reservasi berhasil dibatalkan.');
    }

    /**
     * Mark reservation as completed (Admin)
     */
    public function complete($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = 'selesai';
        $reservation->save();

        // Update car status back to available
        $car = $reservation->car;
        $car->status = 'tersedia';
        $car->save();

        return back()->with('success', 'Reservasi berhasil diselesaikan.');
    }

    /**
     * Update reservation (Admin)
     */
    public function update(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);

        $validated = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:menunggu,dikonfirmasi,sedang_berlangsung,selesai,dibatalkan',
            'payment_status' => 'required|in:belum_bayar,dp,lunas',
            'notes' => 'nullable|string|max:500',
        ]);

        // Recalculate if dates changed
        $startDate = Carbon::parse($validated['start_date']);
        $endDate = Carbon::parse($validated['end_date']);
        $totalDays = $startDate->diffInDays($endDate) + 1;

        $pricePerDay = $reservation->car->discounted_price;
        $totalPrice = $pricePerDay * $totalDays;

        $reservation->update([
            'start_date' => $startDate,
            'end_date' => $endDate,
            'total_days' => $totalDays,
            'total_price' => $totalPrice,
            'status' => $validated['status'],
            'payment_status' => $validated['payment_status'],
            'notes' => $validated['notes'],
        ]);

        return back()->with('success', 'Reservasi berhasil diperbarui.');
    }

    /**
     * Delete reservation (Admin)
     */
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);

        // Update car status if needed
        if ($reservation->status !== 'selesai' && $reservation->status !== 'dibatalkan') {
            $car = $reservation->car;
            $car->status = 'tersedia';
            $car->save();
        }

        $reservation->delete();

        return back()->with('success', 'Reservasi berhasil dihapus.');
    }

    /**
     * Update reservation status (Admin)
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            \Log::info('=== UPDATE STATUS START ===');
            \Log::info('Request data:', $request->all());
            \Log::info('Reservation ID:', ['id' => $id]);

            $validated = $request->validate([
                'status' => 'required|in:menunggu,dikonfirmasi,sedang_berlangsung,selesai,dibatalkan'
            ]);

            $reservation = Reservation::findOrFail($id);
            $oldStatus = $reservation->status;
            \Log::info('Before update:', ['old_status' => $oldStatus, 'new_status' => $validated['status']]);

            $reservation->status = $validated['status'];
            $saveResult = $reservation->save();
            \Log::info('Save result:', ['result' => $saveResult]);

            // Verify the update
            $freshReservation = Reservation::find($id);
            \Log::info('After save - Fresh from DB:', ['status' => $freshReservation->status]);

            // Update car status based on reservation status
            $car = $reservation->car;
            if ($validated['status'] === 'sedang_berlangsung') {
                $car->status = 'disewa';
                $car->save();
            } elseif (in_array($validated['status'], ['selesai', 'dibatalkan'])) {
                $car->status = 'tersedia';
                $car->save();
            }

            // Map status to Indonesian for response
            $statusLabels = [
                'menunggu' => 'Menunggu',
                'dikonfirmasi' => 'Dikonfirmasi',
                'sedang_berlangsung' => 'Aktif',
                'selesai' => 'Selesai',
                'dibatalkan' => 'Dibatalkan'
            ];

            \Log::info('=== UPDATE STATUS SUCCESS ===');

            return response()->json([
                'success' => true,
                'message' => 'Status reservasi berhasil diperbarui menjadi ' . $statusLabels[$validated['status']],
                'status' => $validated['status'],
                'status_label' => $statusLabels[$validated['status']]
            ]);
        } catch (\Exception $e) {
            \Log::error('=== UPDATE STATUS FAILED ===');
            \Log::error('Error:', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate status: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update payment status (Admin)
     */
    public function updatePayment(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'payment_status' => 'required|in:belum_bayar,dp,lunas'
            ]);

            $reservation = Reservation::findOrFail($id);
            $reservation->payment_status = $validated['payment_status'];
            $reservation->save();

            // Map payment status to Indonesian for response
            $paymentLabels = [
                'belum_bayar' => 'Belum Bayar',
                'dp' => 'DP',
                'lunas' => 'Lunas'
            ];

            return response()->json([
                'success' => true,
                'message' => 'Status pembayaran berhasil diperbarui menjadi ' . $paymentLabels[$validated['payment_status']],
                'payment_status' => $validated['payment_status'],
                'payment_label' => $paymentLabels[$validated['payment_status']]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate status pembayaran: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mark reservation as returned (Admin)
     */
    public function markReturned(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'actual_return_date' => 'required|date',
                'return_notes' => 'nullable|string|max:500'
            ]);

            $reservation = Reservation::findOrFail($id);
            $reservation->status = 'selesai';

            // Append return notes to existing notes
            $returnNote = "\n\n=== Pengembalian ===\n";
            $returnNote .= "Tanggal: " . $validated['actual_return_date'] . "\n";
            $returnNote .= "Catatan: " . ($validated['return_notes'] ?? 'Tidak ada catatan.');
            $reservation->notes = ($reservation->notes ?? '') . $returnNote;
            $reservation->save();

            // Update car status to available
            $car = $reservation->car;
            $car->status = 'tersedia';
            $car->save();

            return response()->json([
                'success' => true,
                'message' => 'Mobil berhasil ditandai sebagai dikembalikan',
                'return_date' => $validated['actual_return_date']
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menandai mobil sebagai dikembalikan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Cancel reservation (Admin)
     */
    public function cancelReservation($id)
    {
        try {
            $reservation = Reservation::findOrFail($id);
            $reservation->status = 'dibatalkan';
            $reservation->save();

            // Update car status to available
            $car = $reservation->car;
            $car->status = 'tersedia';
            $car->save();

            return response()->json([
                'success' => true,
                'message' => 'Reservasi berhasil dibatalkan'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal membatalkan reservasi: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get available dates for a car (API endpoint)
     */
    public function availableDates($carId)
    {
        $car = Car::findOrFail($carId);

        $bookedDates = Reservation::where('car_id', $carId)
            ->where('status', '!=', 'dibatalkan')
            ->where('status', '!=', 'ditolak')
            ->get(['start_date', 'end_date'])
            ->map(function ($reservation) {
                return [
                    'start' => $reservation->start_date->format('Y-m-d'),
                    'end' => $reservation->end_date->format('Y-m-d'),
                ];
            });

        return response()->json([
            'car' => [
                'id' => $car->id,
                'name' => $car->brand . ' ' . $car->model,
                'minimum_rental_days' => $car->minimum_rental_days,
            ],
            'booked_dates' => $bookedDates,
        ]);
    }
}
