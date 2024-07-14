<?php

use App\Http\Controllers\CMS\UserController;
use App\Http\Controllers\CMS\CategoryComplaintController;
use App\Http\Controllers\CMS\ComplaintController;
use App\Http\Controllers\CMS\DashboardController;
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

// user
Route::get('/', function () {
    return view('user.home');
});


Route::get('/data-complaint', function () {
    return view('user.dataComplaint');
});
// cms admin
Route::get('/count-dashboard', [DashboardController::class, 'index']);
Route::get('/cms-dashboard', function () {
    return view('Admin.Dashboard');
});
Route::get('/cms-user', function () {
    return view('Admin.User');
});
// category complaint
Route::get('/cms-category-complaint', function () {
    return view('Admin.CategoryComplaint');
});
// complaint
Route::get('/cms-complaint', function () {
    return view('Admin.Complaint');
});
Route::get('/cms-complaint-done', function () {
    return view('Admin.Riviewed');
});
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
