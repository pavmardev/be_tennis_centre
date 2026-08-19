<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourtController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
1. Verejné trasy (Public)
*/

// Autentifikácia
Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
});

// Registrácia používateľa
Route::post('users', [UserController::class, 'store']);

// Kurty
Route::get('courts', [CourtController::class, 'index']);
Route::get('courts/random', [CourtController::class, 'randomCourts']);
Route::get('courts/{court}', [CourtController::class, 'show']);

// Vybavenie
Route::get('equipment', [EquipmentController::class, 'index']);
Route::get('equipment/random', [EquipmentController::class, 'randomEquipment']);
Route::get('equipment/{equipment}', [EquipmentController::class, 'show']);

// Členstvá
Route::get('memberships', [MembershipController::class, 'index']);
Route::get('memberships/{membership}', [MembershipController::class, 'show']);


/*

2. Chránené trasy (Chránené cez auth:sanctum)

*/
Route::middleware('auth:sanctum')->group(function () {

    // Odhlásenie a profil prihláseného používateľa
    Route::prefix('auth')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('me', [AuthController::class, 'me']);
    });

    // Správa vlastného účtu
    Route::get('users/{user}', [UserController::class, 'show']);
    Route::patch('users/{user}', [UserController::class, 'update']);
    Route::delete('users/{user}', [UserController::class, 'destroy']);

    // Rezervácie (prezeranie a rušenie)
    Route::get('reservations/{reservation}', [ReservationController::class, 'show']);
    Route::delete('reservations/{reservation}', [ReservationController::class, 'destroy']);
    Route::put('reservations/{reservation}', [ReservationController::class, 'update']);

    /*
    |
        Vyžaduje prihlásenie + overený e-mail (verified)
    */
    Route::middleware('verified')->group(function () {
        Route::post('reservations', [ReservationController::class, 'store']);
    });

    /*
    |
        Vyžaduje admin práva (admin)
    */
    Route::middleware('admin')->group(function () {
        // Kurty
        Route::post('courts', [CourtController::class, 'store']);
        Route::put('courts/{court}', [CourtController::class, 'update']);
        Route::delete('courts/{court}', [CourtController::class, 'destroy']);

        // Vybavenie
        Route::post('equipment', [EquipmentController::class, 'store']);
        Route::put('equipment/{equipment}', [EquipmentController::class, 'update']);
        Route::delete('equipment/{equipment}', [EquipmentController::class, 'destroy']);

        // Členstvá
        Route::post('memberships', [MembershipController::class, 'store']);
        Route::put('memberships/{membership}', [MembershipController::class, 'update']);
        Route::delete('memberships/{membership}', [MembershipController::class, 'destroy']);

        // Admin zoznamy
        Route::get('users', [UserController::class, 'index']);
        Route::get('reservations', [ReservationController::class, 'index']);
    });
});
