<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('home');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

// Auth routes
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Password reset routes
Route::get('password/reset', [ForgotPasswordController::class,'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class,'sendResetLinkEmail'])->name('password.email');

Route::get('password/reset/{token}', [ResetPasswordController::class,'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class,'reset'])->name('password.update');

// Change password routes
Route::get('password/change', function (Request $request) {
    // menampilkan login view tapi dengan form change password
    return view('login', ['show_change_password' => true, 'email' => $request->query('email')]);
})->name('password.change');

Route::post('password/change', [ChangePasswordController::class, 'update'])->name('password.change.update');

// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user(); // pakai helper, tidak perlu import
        
        // Redirect based on role
        if ($user->role === 'manager_stock') {
            // Get statistics for manager stock
            $orders = \App\Models\Order::latest()->get();

            // totalOrders should exclude already completed orders
            $totalOrders = $orders->where('status', '!=', 'completed')->count();
            $pendingOrders = $orders->where('status', 'pending')->count();
            $inProgressOrders = $orders->whereIn('status', ['confirmed', 'in_progress'])->count();
            $completedOrders = $orders->where('status', 'completed')->count();

            return view('dashboards.manager-stock', compact('orders', 'totalOrders', 'pendingOrders', 'inProgressOrders', 'completedOrders'));
        } elseif ($user->role === 'vendor') {
            return view('dashboards.vendor');
        } elseif ($user->role === 'admin') {
            return view('dashboards.admin');
        }
        
        // Fallback
        return view('dashboard');
    })->name('dashboard');

    // AJAX endpoints for orders
    Route::get('/vendors', [OrderController::class, 'vendors']);
    Route::get('/vendors/{id}/products', [OrderController::class, 'products']);
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
});
