<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Review;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    // ========== USER SIDE ==========

    /**
     * Tampilkan daftar mobil untuk user
     */
    public function index(Request $request)
    {
        $query = Car::query();

        // Filter berdasarkan pencarian
        if ($request->has('search') && $request->search != '') {
            $query->search($request->search);
        }

        // Filter berdasarkan kategori
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        // Filter berdasarkan transmisi
        if ($request->has('transmission') && $request->transmission != '') {
            $query->where('transmission', $request->transmission);
        }

        // Filter berdasarkan harga
        if ($request->has('max_price') && $request->max_price != '') {
            $query->where('price_per_day', '<=', $request->max_price);
        }

        // Urutkan
        $sortBy = $request->get('sort', 'brand');
        $sortOrder = $request->get('order', 'asc');
        $query->orderBy($sortBy, $sortOrder);

        $cars = $query->paginate(12);

        return view('cars', compact('cars'));
    }

    /**
     * Pencarian mobil dengan filter lengkap
     */
    public function search(Request $request)
    {
        $query = Car::query();

        // Filter berdasarkan merek (brand)
        if ($request->filled('brand')) {
            $query->where('brand', 'like', '%' . $request->brand . '%');
        }

        // Filter berdasarkan model
        if ($request->filled('model')) {
            $query->where('model', 'like', '%' . $request->model . '%');
        }

        // Filter berdasarkan kategori
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter berdasarkan transmisi
        if ($request->filled('transmission')) {
            $query->where('transmission', $request->transmission);
        }

        // Filter berdasarkan jenis bahan bakar
        if ($request->filled('fuel_type')) {
            $query->where('fuel_type', $request->fuel_type);
        }

        // Filter berdasarkan jumlah kursi minimum
        if ($request->filled('seats')) {
            $query->where('seats', '>=', $request->seats);
        }

        // Filter berdasarkan harga minimum
        if ($request->filled('min_price')) {
            $query->where('price_per_day', '>=', $request->min_price);
        }

        // Filter berdasarkan harga maksimum
        if ($request->filled('max_price')) {
            $query->where('price_per_day', '<=', $request->max_price);
        }

        // Urutkan berdasarkan brand secara default
        $query->orderBy('brand', 'asc')->orderBy('model', 'asc');

        $cars = $query->paginate(12)->appends($request->all());

        return view('cars', compact('cars'));
    }

    /**
     * Tampilkan detail mobil
     */
    public function show($id)
    {
        $car = Car::with(['reviews' => function ($query) {
            $query->approved()->latest();
        }])->findOrFail($id);

        // Get related cars (same category, different car)
        $relatedCars = Car::where('category', $car->category)
            ->where('id', '!=', $car->id)
            ->where('status', 'tersedia')
            ->orderBy('stars', 'desc')
            ->take(4)
            ->get();

        // If not enough related cars in same category, fill with other available cars
        if ($relatedCars->count() < 4) {
            $additionalCars = Car::where('id', '!=', $car->id)
                ->where('status', 'tersedia')
                ->whereNotIn('id', $relatedCars->pluck('id'))
                ->orderBy('stars', 'desc')
                ->take(4 - $relatedCars->count())
                ->get();

            $relatedCars = $relatedCars->merge($additionalCars);
        }

        return view('detailsCar', compact('car', 'relatedCars'));
    }

    /**
     * Tampilkan form reservasi
     */
    public function showReservationForm($id)
    {
        $car = Car::findOrFail($id);

        if ($car->status !== 'tersedia') {
            return redirect('/cars')->with('error', 'Mobil tidak tersedia untuk disewa');
        }

        return view('createReservation', compact('car'));
    }

    /**
     * Proses reservasi mobil
     */
    public function processReservation(Request $request, $id)
    {
        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'notes' => 'nullable|string|max:500'
        ]);

        $car = Car::findOrFail($id);

        if ($car->status !== 'tersedia') {
            return back()->with('error', 'Mobil tidak tersedia untuk disewa');
        }

        // Hitung total hari dan harga
        $startDate = \Carbon\Carbon::parse($request->start_date);
        $endDate = \Carbon\Carbon::parse($request->end_date);
        $totalDays = $startDate->diffInDays($endDate) + 1;

        // Cek minimum rental days
        if ($totalDays < $car->minimum_rental_days) {
            return back()->with('error', "Minimal sewa {$car->minimum_rental_days} hari untuk mobil ini");
        }

        $pricePerDay = $car->discounted_price;
        $totalPrice = $pricePerDay * $totalDays;

        // Buat reservasi
        $reservation = Reservation::create([
            'car_id' => $car->id,
            'user_id' => session('user_id'),
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_days' => $totalDays,
            'total_price' => $totalPrice,
            'status' => 'menunggu',
            'payment_status' => 'belum_bayar',
            'notes' => $request->notes
        ]);

        return view('paymentsShow', compact('reservation', 'car'));
    }

    /**
     * Submit review untuk mobil
     */
    public function submitReview(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:500'
        ]);

        Review::create([
            'car_id' => $request->car_id,
            'user_id' => session('user_id'),
            'rating' => $request->rating,
            'comment' => $request->comment,
            'status' => 'menunggu'
        ]);

        return back()->with('success', 'Review Anda telah dikirim dan menunggu persetujuan admin');
    }

    // ========== ADMIN SIDE ==========

    /**
     * Tampilkan daftar mobil untuk admin
     */
    public function adminIndex()
    {
        $cars = Car::latest()->paginate(20);
        return view('admin.cars', compact('cars'));
    }

    /**
     * Tampilkan form tambah mobil
     */
    public function create()
    {
        return view('admin.createCar');
    }

    /**
     * Simpan mobil baru
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'brand' => 'required|string|max:255',
                'model' => 'required|string|max:255',
                'police_number' => 'required|string|unique:cars,police_number',
                'engine' => 'required|string',
                'price_per_day' => 'required|numeric|min:0',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'gallery_images' => 'nullable|array',
                'gallery_images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
                'status' => 'required|in:tersedia,disewa,perbaikan',
                'reduce' => 'nullable|numeric|min:0|max:100',
                'transmission' => 'required|in:manual,automatic,cvt',
                'fuel_type' => 'required|in:bensin,diesel,electric,hybrid',
                'seats' => 'required|integer|min:1',
                'doors' => 'nullable|integer|min:1',
                'category' => 'required|string',
                'color' => 'required|string',
                'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
                'description' => 'nullable|string',
                'mileage' => 'nullable|integer|min:0',
                'available_for_long_term' => 'nullable|boolean',
                'minimum_rental_days' => 'nullable|integer|min:1'
            ]);

            $data = $request->except('image', 'gallery_images', 'features');

            // Handle main image upload
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('images/cars', 'public');
                $data['image'] = '/storage/' . $imagePath;
            }

            // Handle gallery images upload
            if ($request->hasFile('gallery_images')) {
                $galleryPaths = [];
                foreach ($request->file('gallery_images') as $galleryImage) {
                    $galleryPath = $galleryImage->store('images/cars/gallery', 'public');
                    $galleryPaths[] = '/storage/' . $galleryPath;
                }
                $data['gallery_images'] = $galleryPaths;
            }

            // Handle features
            if ($request->has('features')) {
                $data['features'] = is_array($request->features) ? $request->features : explode(',', $request->features);
            }

            $data['reduce'] = $request->reduce ?? 0;
            $data['stars'] = $request->stars ?? 5;
            $data['available_for_long_term'] = $request->has('available_for_long_term');
            $data['minimum_rental_days'] = $request->minimum_rental_days ?? 1;

            $car = Car::create($data);

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Mobil ' . $car->brand . ' ' . $car->model . ' berhasil ditambahkan',
                    'car' => $car
                ]);
            }

            return redirect('/admin/cars')->with('success', 'Mobil berhasil ditambahkan');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $e->errors()
                ], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ], 500);
            }
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    /**
     * Tampilkan detail mobil untuk admin
     */
    public function adminShow($id)
    {
        $car = Car::with('reviews', 'reservations')->findOrFail($id);
        return view('admin.carDetails', compact('car'));
    }

    /**
     * Tampilkan form edit mobil
     */
    public function edit($id)
    {
        $car = Car::findOrFail($id);
        return view('admin.updateCar', compact('car'));
    }

    /**
     * Update mobil
     */
    public function update(Request $request, Car $car)
    {
        try {
            $validated = $request->validate([
                'brand' => 'required|string|max:255',
                'model' => 'required|string|max:255',
                'police_number' => 'required|string|unique:cars,police_number,' . $car->id,
                'engine' => 'required|string',
                'price_per_day' => 'required|numeric|min:0',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'status' => 'required|in:tersedia,disewa,perbaikan',
                'reduce' => 'nullable|numeric|min:0|max:100',
                'transmission' => 'required|in:manual,automatic,cvt',
                'fuel_type' => 'required|in:bensin,diesel,electric,hybrid',
                'seats' => 'required|integer|min:1',
                'doors' => 'nullable|integer|min:1',
                'category' => 'required|string',
                'color' => 'required|string',
                'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
                'description' => 'nullable|string',
                'mileage' => 'nullable|integer|min:0',
                'available_for_long_term' => 'nullable|boolean',
                'minimum_rental_days' => 'nullable|integer|min:1'
            ]);

            $data = $request->except('image', 'gallery_images', 'features');

            // Handle main image upload
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($car->image && Storage::disk('public')->exists(str_replace('/storage/', '', $car->image))) {
                    Storage::disk('public')->delete(str_replace('/storage/', '', $car->image));
                }

                $imagePath = $request->file('image')->store('images/cars', 'public');
                $data['image'] = '/storage/' . $imagePath;
            }

            // Handle gallery images upload
            if ($request->hasFile('gallery_images')) {
                $galleryPaths = [];
                foreach ($request->file('gallery_images') as $galleryImage) {
                    $galleryPath = $galleryImage->store('images/cars/gallery', 'public');
                    $galleryPaths[] = '/storage/' . $galleryPath;
                }

                // Merge dengan gallery yang sudah ada (jika ada)
                // $car->gallery_images sudah auto-cast ke array oleh model
                $existingGallery = $car->gallery_images ?? [];
                $data['gallery_images'] = array_merge($existingGallery, $galleryPaths);
            }

            // Handle features
            if ($request->has('features')) {
                $data['features'] = is_array($request->features) ? $request->features : explode(',', $request->features);
            }

            $data['reduce'] = $request->reduce ?? 0;
            $data['available_for_long_term'] = $request->has('available_for_long_term');
            $data['minimum_rental_days'] = $request->minimum_rental_days ?? 1;

            $car->update($data);

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Mobil ' . $car->brand . ' ' . $car->model . ' berhasil diperbarui',
                    'car' => $car
                ]);
            }

            return redirect('/admin/cars')->with('success', 'Mobil berhasil diperbarui');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $e->errors()
                ], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal memperbarui mobil: ' . $e->getMessage()
                ], 500);
            }
            return redirect()->back()->with('error', 'Gagal memperbarui mobil');
        }
    }

    /**
     * Hapus mobil
     */
    public function destroy($id)
    {
        try {
            $car = Car::findOrFail($id);

            // Check if car has active reservations
            $activeReservations = $car->reservations()
                ->whereIn('status', ['dikonfirmasi', 'sedang_berlangsung'])
                ->count();

            if ($activeReservations > 0) {
                if (request()->wantsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Tidak dapat menghapus mobil yang sedang dalam reservasi aktif'
                    ], 400);
                }
                return redirect('/admin/cars')->with('error', 'Tidak dapat menghapus mobil yang sedang dalam reservasi aktif');
            }

            // Delete image if exists
            if ($car->image && Storage::disk('public')->exists($car->image)) {
                Storage::disk('public')->delete($car->image);
            }

            $carName = $car->brand . ' ' . $car->model;
            $car->delete();

            if (request()->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Mobil ' . $carName . ' berhasil dihapus'
                ]);
            }

            return redirect('/admin/cars')->with('success', 'Mobil berhasil dihapus');
        } catch (\Exception $e) {
            if (request()->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menghapus mobil: ' . $e->getMessage()
                ], 500);
            }
            return redirect('/admin/cars')->with('error', 'Gagal menghapus mobil');
        }
    }

    /**
     * Tampilkan daftar review untuk admin
     */
    public function adminReviews()
    {
        $reviews = Review::with(['car', 'user'])->latest()->paginate(15);
        return view('admin.reviewsCar', compact('reviews'));
    }

    /**
     * Setujui review
     */
    public function approveReview($id)
    {
        $review = Review::findOrFail($id);
        $review->update(['status' => 'disetujui']);

        // Update rating mobil
        $car = $review->car;
        $averageRating = $car->reviews()->approved()->avg('rating');
        $car->update(['stars' => round($averageRating, 1)]);

        return back()->with('success', 'Review berhasil disetujui');
    }

    /**
     * Hapus review
     */
    public function deleteReview($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return back()->with('success', 'Review berhasil dihapus');
    }
}
