<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\SettingsController;

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
Auth::routes();

Route::get('/',function(){
    return redirect()->route('gallery');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'gallery'],function(){
    Route::get('', [GalleryController::class,'index'])->name('gallery');
    Route::get('/add_book', [GalleryController::class,'add_book'])->name('book_add');
    Route::post('/store', [GalleryController::class,'store'])->name('store_book');
});

Route::group(['middleware'=>'auth','prefix' => 'settings'],function(){
    Route::get('', [SettingsController::class,'index'])->name('settings');
    Route::post('/add/{type}', [SettingsController::class,'store'])->name('settings_add');
    Route::delete('/delete/{type}', [SettingsController::class,'destroy'])->name('settings_delete');
});