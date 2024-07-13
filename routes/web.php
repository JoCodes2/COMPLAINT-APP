<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CMS\UserController;
use App\Http\Controllers\CMS\CategoryComplaintController;
use App\Http\Controllers\CMS\ComplaintController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// route view and api login
Route::middleware('guest')->group(function () {
    // ui login
    Route::get('/login', function () {
        return view('Auth.Login');
    })->name('login');
    // api login
    Route::post('/v1/login', [AuthController::class, 'login']);
});

// end route api
Route::middleware(['web', 'auth'])->group(function () {
    Route::post('/v1/logout', [AuthController::class, 'logout']);


    Route::get('/', function () {
        return view('user.home');
    })->middleware('checkRole:user');
    Route::get('/data-complaint', function () {
        return view('user.dataComplaint');
    })->middleware('checkRole:user');
    // cms admin
    Route::get('/cms-dashboard', function () {
        return view('Admin.Dashboard');
    })->middleware('checkRole:admin');
    Route::get('/cms-user', function () {
        return view('Admin.User');
    })->middleware('checkRole:admin');
    // category complaint
    Route::get('/cms-category-complaint', function () {
        return view('Admin.CategoryComplaint');
    })->middleware('checkRole:admin');
    // complaint
    Route::get('/cms-complaint', function () {
        return view('Admin.Complaint');
    })->middleware('checkRole:admin');
    Route::get('/cms-complaint-done', function () {
        return view('Admin.Riviewed');
    })->middleware('checkRole:admin');
    // api category complaint
    Route::prefix('v1/category-complaint')->controller(CategoryComplaintController::class)->group(function () {
        Route::get('/', 'getAllData');
        Route::post('/create', 'createData');
        Route::get('/get/{id}', 'getDataById');
        Route::post('/update/{id}', 'updateDataById');
        Route::delete('/delete/{id}', 'deleteDataById');
    });
    // route  api user //
    Route::prefix('v1/user')->controller(UserController::class)->group(function () {
        Route::get('/', 'getAllData');
        Route::post('/create', 'createData');
        Route::get('/get/{id}', 'getDataById');
        Route::post('/update/{id}', 'updateDataById');
        Route::delete('/delete/{id}', 'deleteData');
    });
    // route  api complaint //
    Route::prefix('v1/complaint')->controller(ComplaintController::class)->group(function () {
        Route::get('/', 'getAllData');
        Route::get('/get/{id}', 'getDataById');
        Route::post('/create', 'createData');
        Route::delete('/delete/{id}', 'deleteDataById');
        Route::post('/review/{id}', 'updateStatusComplaint');
    });
});
