<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Car;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Show payment page for a reservation
     */
    public function show($reservationId)
    {
        $reservation = Reservation::with('car')
            ->where('id', $reservationId)
            ->where('user_id', session('user_id'))
            ->firstOrFail();

        // Only show payment for pending reservations
        if ($reservation->payment_status !== 'belum_bayar') {
            return redirect()->route('reservations.show', $reservationId)
                ->with('info', 'Pembayaran sudah dilakukan.');
        }

        return view('payment', compact('reservation'));
    }

    /**
     * Process payment simulation
     */
    public function process(Request $request, $reservationId)
    {
        $validated = $request->validate([
            'payment_method' => 'required|in:bank_transfer,e_wallet,credit_card,cash,midtrans',
        ]);

        $reservation = Reservation::where('id', $reservationId)
            ->where('user_id', session('user_id'))
            ->firstOrFail();

        // Update payment status
        $reservation->payment_status = 'lunas';
        $reservation->save();

        return redirect()->route('payment.success', $reservationId)
            ->with('success', 'Pembayaran berhasil! Reservasi Anda sedang menunggu konfirmasi admin.');
    }

    /**
     * Show payment success page
     */
    public function success($reservationId)
    {
        $reservation = Reservation::with('car')
            ->where('id', $reservationId)
            ->where('user_id', session('user_id'))
            ->firstOrFail();

        return view('payment-success', compact('reservation'));
    }
}
