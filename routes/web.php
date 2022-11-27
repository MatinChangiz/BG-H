<?php

use App\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserControler;
use App\Http\Controllers\ListingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//linsting home page
Route::get('/', [ListingController::class, 'index']);

//home address
Route::get('/home', function(){
    return redirect('/');
});

//show create listing
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

//stor listing
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

//show edit listing form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

//update listing
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

//Delete listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

//sing view
Route::get('/listings/{listing}', [ListingController::class, 'show']);

//show register create form
Route::get('/register',[UserControler::class, 'create'])->middleware('guest');

//store user
Route::post('/users', [UserControler::class, 'store']);

//logout user
Route::post('/logout', [UserControler::class, 'logout'])->middleware('auth');

//show login form
Route::get('/login',[UserControler::class, 'login'])->name('login')->middleware('guest');

//login user
Route::post('/users/authenticate',[UserControler::class, 'authenticate']);