<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\IdeaController as AdminIdeaController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;


Route::group(['middleware' => ['auth', 'can:admin'], 'prefix'=> '/admin', 'as'=> 'admin.'], function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', AdminUserController::class)->only('index');
    Route::get('/ideas', [AdminIdeaController::class, 'index'])->name('index');
    Route::resource('comments', AdminCommentController::class)->only('index', 'destroy');
    Route::get('/autocomplete', [AdminIdeaController::class, 'autocomplete'])->name('autocomplete');

});
