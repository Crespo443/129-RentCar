<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of all reviews (Admin)
     */
    public function index(Request $request)
    {
        $query = Review::with(['car', 'user'])->orderBy('created_at', 'desc');

        // Filter by status if provided
        if ($request->has('status')) {
            $status = $request->get('status');
            if (in_array($status, ['menunggu', 'disetujui', 'ditolak'])) {
                $query->where('status', $status);
            }
        }

        $reviews = $query->paginate(20);
        return view('admin.reviewsCar', compact('reviews'));
    }

    /**
     * Show pending reviews (Admin)
     */
    public function pending()
    {
        $reviews = Review::with(['car', 'user'])
            ->pending()
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.reviewsCar', compact('reviews'));
    }

    /**
     * Store a new review (User)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10|max:1000',
        ], [
            'car_id.required' => 'Mobil harus dipilih.',
            'car_id.exists' => 'Mobil tidak ditemukan.',
            'rating.required' => 'Rating harus diisi.',
            'rating.min' => 'Rating minimal 1 bintang.',
            'rating.max' => 'Rating maksimal 5 bintang.',
            'comment.required' => 'Komentar harus diisi.',
            'comment.min' => 'Komentar minimal 10 karakter.',
            'comment.max' => 'Komentar maksimal 1000 karakter.',
        ]);

        // Check if user has already reviewed this car
        $existingReview = Review::where('car_id', $validated['car_id'])
            ->where('user_id', session('user_id'))
            ->first();

        if ($existingReview) {
            return back()->with('error', 'Anda sudah memberikan ulasan untuk mobil ini.');
        }

        Review::create([
            'car_id' => $validated['car_id'],
            'user_id' => session('user_id'),
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'status' => 'menunggu' // pending approval
        ]);

        return back()->with('success', 'Ulasan Anda berhasil dikirim dan menunggu persetujuan admin.');
    }

    /**
     * Approve a review (Admin)
     */
    public function approve(Request $request, $id)
    {
        $review = Review::findOrFail($id);
        $review->status = 'disetujui';
        $review->save();

        // Update car rating
        $this->updateCarRating($review->car_id);

        // Return JSON for AJAX requests
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Ulasan berhasil disetujui.'
            ]);
        }

        return back()->with('success', 'Ulasan berhasil disetujui.');
    }

    /**
     * Reject a review (Admin)
     */
    public function reject($id)
    {
        $review = Review::findOrFail($id);
        $review->status = 'ditolak';
        $review->save();

        return back()->with('success', 'Ulasan berhasil ditolak.');
    }

    /**
     * Delete a review (Admin)
     */
    public function destroy(Request $request, $id)
    {
        $review = Review::findOrFail($id);
        $carId = $review->car_id;
        $review->delete();

        // Update car rating after deletion
        $this->updateCarRating($carId);

        // Return JSON for AJAX requests
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Ulasan berhasil dihapus.'
            ]);
        }

        return back()->with('success', 'Ulasan berhasil dihapus.');
    }

    /**
     * Update car's average rating
     */
    private function updateCarRating($carId)
    {
        $car = Car::findOrFail($carId);
        $averageRating = Review::where('car_id', $carId)
            ->approved()
            ->avg('rating');

        $car->stars = $averageRating ? round($averageRating, 1) : 0;
        $car->save();
    }

    /**
     * Show user's own reviews
     */
    public function myReviews()
    {
        $reviews = Review::with(['car'])
            ->where('user_id', session('user_id'))
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('user.my-reviews', compact('reviews'));
    }

    /**
     * Edit user's own review
     */
    public function edit($id)
    {
        $review = Review::where('id', $id)
            ->where('user_id', session('user_id'))
            ->firstOrFail();

        return view('user.edit-review', compact('review'));
    }

    /**
     * Update user's own review
     */
    public function update(Request $request, $id)
    {
        $review = Review::where('id', $id)
            ->where('user_id', session('user_id'))
            ->firstOrFail();

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10|max:1000',
        ], [
            'rating.required' => 'Rating harus diisi.',
            'rating.min' => 'Rating minimal 1 bintang.',
            'rating.max' => 'Rating maksimal 5 bintang.',
            'comment.required' => 'Komentar harus diisi.',
            'comment.min' => 'Komentar minimal 10 karakter.',
            'comment.max' => 'Komentar maksimal 1000 karakter.',
        ]);

        $review->update([
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'status' => 'menunggu' // reset to pending after edit
        ]);

        return redirect()->route('reviews.my')->with('success', 'Ulasan berhasil diperbarui dan menunggu persetujuan admin.');
    }

    /**
     * Delete user's own review
     */
    public function destroyOwn($id)
    {
        $review = Review::where('id', $id)
            ->where('user_id', session('user_id'))
            ->firstOrFail();

        $carId = $review->car_id;
        $review->delete();

        // Update car rating
        $this->updateCarRating($carId);

        return back()->with('success', 'Ulasan berhasil dihapus.');
    }
}
