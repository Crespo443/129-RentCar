<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Reservation;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{


    public function showHomePage()
    {
        // Get 3 featured cars with discount
        $featuredCars = Car::where('reduce', '>', 0)
            ->orderBy('reduce', 'desc')
            ->take(3)
            ->get();

        // If less than 3 cars with discount, fill with other available cars
        if ($featuredCars->count() < 3) {
            $remaining = Car::where('reduce', 0)
                ->orderBy('stars', 'desc')
                ->take(3 - $featuredCars->count())
                ->get();
            $featuredCars = $featuredCars->merge($remaining);
        }

        return view('home', compact('featuredCars'));
    }

    public function showProfilePage()
    {
        return view('profile');
    }

    public function showCarListPage()
    {
        return view('cars');
    }

    public function searchCars()
    {
        return view('cars');
    }

    public function showCarDetailPage()
    {
        return view('detailsCar');
    }

    public function showReservationForm()
    {
        return view('createReservation');
    }

    public function processReservation()
    {
        return view('paymentsShow');
    }

    public function submitReview()
    {
        return back();
    }

    public function showAdminDashboard()
    {
        // Total pendapatan dari pembayaran lunas
        $totalRevenue = Reservation::where('payment_status', 'lunas')->sum('total_price');

        // Total pemesanan
        $totalReservations = Reservation::count();

        // Pesanan aktif (dikonfirmasi atau sedang berjalan)
        $activeReservations = Reservation::whereIn('status', ['dikonfirmasi', 'sedang_berlangsung'])->count();

        // Review statistics
        $averageRating = Review::approved()->avg('rating') ?? 0;
        $pendingReviews = Review::pending()->count();

        // Pendapatan harian (3 hari terakhir) - berdasarkan pembayaran lunas
        $dailyRevenue = Reservation::where('payment_status', 'lunas')
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total_price) as revenue'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->take(3)
            ->get();

        // Status pemesanan breakdown
        $completedReservations = Reservation::where('status', 'selesai')->count();
        $canceledReservations = Reservation::where('status', 'dibatalkan')->count();

        // Mobil terpopuler (berdasarkan pembayaran lunas)
        $popularCars = Car::withCount(['reservations' => function ($q) {
            $q->where('payment_status', 'lunas');
        }])
            ->withSum(['reservations' => function ($q) {
                $q->where('payment_status', 'lunas');
            }], 'total_price')
            ->having('reservations_count', '>', 0)
            ->orderBy('reservations_count', 'desc')
            ->take(3)
            ->get();

        // Pendapatan per kategori (berdasarkan pembayaran lunas)
        $categoryRevenue = Reservation::join('cars', 'cars.id', '=', 'reservations.car_id')
            ->where('reservations.payment_status', 'lunas')
            ->select('cars.category', DB::raw('SUM(reservations.total_price) as total'))
            ->groupBy('cars.category')
            ->orderBy('total', 'desc')
            ->get();

        // Review statistics detail
        $totalReviews = Review::count();
        $approvedReviews = Review::approved()->count();
        $pendingReviewsCount = Review::pending()->count();

        // Rating distribution
        $ratingDistribution = Review::approved()
            ->select('rating', DB::raw('COUNT(*) as count'))
            ->groupBy('rating')
            ->orderBy('rating', 'desc')
            ->get()
            ->pluck('count', 'rating');

        // Recent reservations for table (latest 10)
        $reservations = Reservation::with(['car', 'user'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('admin.adminDashboard', compact(
            'totalRevenue',
            'totalReservations',
            'activeReservations',
            'averageRating',
            'pendingReviews',
            'dailyRevenue',
            'completedReservations',
            'canceledReservations',
            'popularCars',
            'categoryRevenue',
            'totalReviews',
            'approvedReviews',
            'pendingReviewsCount',
            'ratingDistribution',
            'reservations'
        ));
    }

    public function showAdminCarList()
    {
        return view('admin.cars');
    }

    public function showCreateCarForm()
    {
        return view('admin.createCar');
    }

    public function processCreateCar()
    {
        return redirect('/admin/cars');
    }

    public function showCarDetails()
    {
        return view('admin.cars');
    }

    public function showEditCarForm()
    {
        return view('admin.updateCar');
    }

    public function processUpdateCar()
    {
        return redirect('/admin/cars');
    }

    public function processDeleteCar()
    {
        return redirect('/admin/cars');
    }

    public function showAdminReviewList()
    {
        return view('admin.reviewsCar');
    }

    public function processApproveReview()
    {
        return back();
    }

    public function processDeleteReview()
    {
        return back();
    }

    public function processLogout()
    {
        session()->flush();
        return redirect('/');
    }
}
