<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});

//register new user
Route::post('/bookbus/register', [AuthController::class, 'register']); 

//login user
Route::post('/bookbus/login', [AuthController::class, 'login']);

//view existing users
Route::post('/bookbus/users', [UserController::class, 'users']);

//resetting passwords
Route::post('/bookbus/reset_password/{id}', [AuthController::class, 'reset_password']); 

//view bus schedule lists
Route::get('/bookbus/{role}', [UserController::class, 'bus_schedule_list']); 

//booking a schedule from the bus schedule list
Route::post('/bookbus/book_schedule/{role}', [UserController::class, 'book_schedule']);

//get all the bookings of a unique user
Route::get('/bookbus/{role}/{id}', [UserController::class, 'my_bookings']);

//cancel a booking
Route::post('/bookbus/cancel_bookings', [UserController::class, 'cancel_bookings']);

//managing bookings(add/edit)
Route::post('/bookbus/bus_management/{role}/{type}', [SuperAdminController::class, 'bus_management']);

//managing routes(add/edit)
Route::post('/bookbus/route_management/{role}/{type}', [SuperAdminController::class, 'route_management']);

//assigning bus routes using routes table
Route::post('/bookbus/route_bus_mapping/{role}/{type}', [SuperAdminController::class, 'route_bus_mapping']);

//managing bus seats(add/edit)
Route::post('/bookbus/bus_seat_management/{role}/{type}', [SuperAdminController::class, 'bus_seat_management']);

//managing schedules
Route::post('/bookbus/schedule_management/{role}/{type}', [SuperAdminController::class, 'schedule_management']);

