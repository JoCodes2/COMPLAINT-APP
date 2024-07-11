<?php

use App\Http\Controllers\CMS\CategoryComplaintController;
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

Route::get('/cms-admin', function () {
    return view('Layouts.Base');
});
Route::get('/', function () {
    return view('Layouts.userTemplete');
});

// category complaint
Route::get('/cms-category-complaint', function () {
    return view('Admin.CategoryComplaint');
});


// api category complaint
Route::prefix('v1/category-complaint')->controller(CategoryComplaintController::class)->group(function () {
    Route::get('/', 'getAllData');
    Route::post('/create', 'createData');
    Route::get('/get/{id}', 'getDataById');
    Route::post('/update/{id}', 'updateDataById');
    Route::delete('/delete/{id}', 'deleteDataById');
});
