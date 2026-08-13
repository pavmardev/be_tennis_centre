<?php

use App\Http\Controllers\CourtController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::delete('users/{user}', [UserController::class, 'destroy']);
Route::get('users', [UserController::class, 'index']);
Route::get('users/{user}', [UserController::class, 'show']);
Route::post('users', [UserController::class, 'store']);

Route::delete('reservations/{reservation}', [ReservationController::class, 'destroy']);

Route::get('courts', [CourtController::class, 'index']);
Route::get('courts/{court}', [CourtController::class, 'show']);
Route::post('courts', [CourtController::class, 'store']);
Route::delete('courts/{court}', [CourtController::class, 'destroy']);
Route::get('courts-random', [CourtController::class, 'randomCourts']);


Route::get('equipment', [EquipmentController::class, 'index']);
Route::get('equipment/{equipment}', [EquipmentController::class, 'show']);
Route::post('equipment', [EquipmentController::class, 'store']);
Route::put('equipment/{equipment}', [EquipmentController::class, 'update']);
Route::delete('equipment/{equipment}', [EquipmentController::class, 'destroy']);
Route::get('equipment-random', [EquipmentController::class, 'randomEquipment']);

Route::delete('memberships/{membership}', [MembershipController::class, 'destroy']);
Route::get('memberships', [MembershipController::class, 'index']);

Route::get('reservations', [ReservationController::class, 'index']);
