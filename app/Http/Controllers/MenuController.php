<?php

namespace App\Http\Controllers;

class MenuController extends Controller
{
    

    public function showHomePage()
    {
        return view('home');
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
        return view('admin.adminDashboard');
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
