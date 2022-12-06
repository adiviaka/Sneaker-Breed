<?php

use App\Http\Controllers\ShoesController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\OwnerController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/shoes', [ShoesController::class, 'index'])->name('shoes.index');


// shop
Route::middleware(['auth'])->group(function () {
    Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
    Route::get('/shop/add', [ShopController::class, 'create'])->name('shop.create');
    Route::post('/shop/store', [ShopController::class, 'store'])->name('shop.store');
    Route::get('/shop/edit/{id}', [ShopController::class, 'edit'])->name('shop.edit');
    Route::post('/shop/update/{id}', [ShopController::class, 'update'])->name('shop.update');
    Route::post('/shop/delete/{id}', [ShopController::class, 'delete'])->name('shop.delete');
});

// owner
Route::middleware(['auth'])->group(function () {
    Route::get('/owner', [OwnerController::class, 'index'])->name('owner.index');
    Route::get('/owner/add', [OwnerController::class, 'create'])->name('owner.create');
    Route::post('/owner/store', [OwnerController::class, 'store'])->name('owner.store');
    Route::get('/owner/edit/{id}', [OwnerController::class, 'edit'])->name('owner.edit');
    Route::post('/owner/update/{id}', [OwnerController::class, 'update'])->name('owner.update');
    Route::post('/owner/delete/{id}', [OwnerController::class, 'delete'])->name('owner.delete');
});

// shoes
Route::middleware(['auth'])->group(function () {
    Route::get('/shoes', [ShoesController::class, 'index'])->name('shoes.index');
    Route::get('/shoes/add', [ShoesController::class, 'create'])->name('shoes.create');
    Route::post('/shoes/store', [ShoesController::class, 'store'])->name('shoes.store');
    Route::get('/shoes/edit/{id}', [ShoesController::class, 'edit'])->name('shoes.edit');
    Route::post('/shoes/update/{id}', [ShoesController::class, 'update'])->name('shoes.update');
    Route::post('/shoes/destroy/{id}', [ShoesController::class, 'destroy'])->name('shoes.destroy');
    Route::post('/shoes/restore/{id}', [ShoesController::class, 'restore'])->name('shoes.restore');
    Route::post('/shoes/forceDelete/{id}', [ShoesController::class, 'forceDelete'])->name('shoes.forceDelete');
});

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::get('/about', function () {
    return view('about');
})->name('about');
