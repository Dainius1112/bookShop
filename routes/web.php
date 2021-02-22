<?php

use App\Http\Controllers\Auth\UserController;
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
    Route::get('/edit_book/{id}', [GalleryController::class,'edit_book'])->name('book_edit');
    Route::post('/edit_book_submit/{id}', [GalleryController::class,'edit_book_submit'])->name('edit_book_submit');
    Route::get('/view/{id}', [GalleryController::class,'view'])->name('book_view');
    Route::get('/approve/{id}', [GalleryController::class,'approve'])->name('approve_book');
    Route::post('/store', [GalleryController::class,'store'])->name('store_book');
    Route::post('/createComment', [GalleryController::class,'createComment'])->name('create_comment');
    Route::post('/createUpdateScore', [GalleryController::class,'createUpdateScore'])->name('create_update_score');
    Route::delete('/deleteBook', [GalleryController::class,'deleteBook'])->name('deleteBook');
});

Route::group(['middleware'=>'auth'],function(){
    Route::group(['prefix'=>'settings'],function(){
        Route::get('', [SettingsController::class,'index'])->name('settings');
        Route::post('/add/{type}', [SettingsController::class,'store'])->name('settings_add');
        Route::delete('/delete/{type}', [SettingsController::class,'destroy'])->name('settings_delete');
    });
    Route::get('/user/edit',[UserController::class,'edit'])->name('edit_user');
    Route::post('/user/update',[UserController::class,'update'])->name('user_update');
});