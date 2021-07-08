<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemoController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\DeactiveController;
use App\Http\Controllers\SearchController;

/*-- Auth --*/
# Login
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login.index');
# Register
Route::get('/user', [RegisterController::class, 'showRegistrationForm'])->name('user.register');
Route::post('/user/register', [RegisterController::class, 'register'])->name('user.exec.register');

/*-- Only at Login --*/
Route::group(['middleware' => ['auth']], function() {
    /*-- Home --*/
    Route::get('/memo', [MemoController::class, 'index'])->name('memo.index');
        # Add notes
        Route::get('/memo/add', [MemoController::class, 'add'])->name('memo.add');
        # Select notes
        Route::get('/memo/select', [MemoController::class, 'select'])->name('memo.select');
        # Save notes
        Route::post('/memo/update', [MemoController::class, 'update'])->name('memo.update');
        # Delete notes
        Route::post('/memo/delete', [MemoController::class, 'delete'])->name('memo.delete');
        # Logout
        Route::get('logout', [LoginController::class, 'logout'])->name('memo.logout');
        # Search notes
        Route::get('/memo/search', [SearchController::class, 'index'])->name('memo.search');

    /*-- MyPage --*/
    Route::view('/user/mypage', 'mypage')->name('user.mypage');
        # Delete Users
        Route::get('/deactive', [DeactiveController::class, 'showDeactiveForm'])->name('deactive.form');
        Route::post('/deactive', [DeactiveController::class, 'deactive'])->name('deactive');
});

Auth::routes();
