<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourtController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);

        Route::middleware('admin')->group(function () {
            Route::delete('users/{user}', [UserController::class, 'destroy']);
            Route::delete('reservations/{reservation}', [ReservationController::class, 'destroy']);
            Route::delete('courts/{court}', [CourtController::class, 'destroy']);
            Route::delete('memberships/{membership}', [MembershipController::class, 'destroy']);
            Route::delete('equipment/{equipment}', [EquipmentController::class, 'destroy']);
            Route::post('courts', [CourtController::class, 'store']);
            Route::post('equipment', [EquipmentController::class, 'store']);
            Route::put('equipment/{equipment}', [EquipmentController::class, 'update']);

        });
    });
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::post('reservations', [ReservationController::class, 'store']);
    });
});


Route::get('users', [UserController::class, 'index']);
Route::get('users/{user}', [UserController::class, 'show']);
Route::post('users', [UserController::class, 'store']);
Route::patch('users/{user}', [UserController::class, 'update']);

Route::get('reservations', [ReservationController::class, 'index']);
Route::get('reservations/{reservation}', [ReservationController::class, 'show']);

Route::get('courts', [CourtController::class, 'index']);
Route::get('courts/{court}', [CourtController::class, 'show']);
Route::get('courts-random', [CourtController::class, 'randomCourts']);

Route::get('equipment', [EquipmentController::class, 'index']);
Route::get('equipment/{equipment}', [EquipmentController::class, 'show']);
Route::get('equipment-random', [EquipmentController::class, 'randomEquipment']);

Route::get('memberships', [MembershipController::class, 'index']);

