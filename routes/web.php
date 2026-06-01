<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EnquiryController;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/admin/dashboard');
    }
    return view('auth.login');
});

Auth::routes();



Route::prefix("admin")->middleware(['auth'])->group(function () {
    Route::get('dashboard',[DashboardController::class, 'dashboard']);
    Route::resource('enquiries', EnquiryController::class);
});