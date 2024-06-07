<?php

use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\IdeaLikeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\IdeaController as AdminIdeaController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\WalletController;
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

Route::get('lang/{lang}', function ($lang) {

    app()->setLocale($lang);
    session()->put('locale', $lang);

    return redirect()->route('dashboard');
})->name('lang');

Route::get('', [DashboardController::class, 'index'])->name('dashboard');

Route::group(['middleware' => ['auth']], function(){
    Route::resource('ideas', IdeaController::class)->except(['index', 'create', 'show']);
    Route::resource('ideas.comments', CommentController::class)->only(['store']);
    Route::resource('users', UserController::class)->only('edit', 'update');
    Route::get('profile', [UserController::class, 'profile'])->name('profile');
    Route::post('users/{user}/follow', [FollowerController::class, 'follow'])->name('users.follow');
    Route::post('users/{user}/unfollow', [FollowerController::class, 'unfollow'])->name('users.unfollow');
    Route::post('ideas/{idea}/like', [IdeaLikeController::class, 'like'])->name('ideas.like');
    Route::post('ideas/{idea}/unlike', [IdeaLikeController::class, 'unlike'])->name('ideas.unlike');
    Route::get('/feed', FeedController::class)->name('feed');
    Route::get('/wallets', [WalletController::class, 'index'])->name('wallets');
    // Route::get('autocomplete', [SearchController::class, 'autocomplete'])->name('autocomplete');

});

Route::resource('ideas', IdeaController::class)->only(['show']);
Route::resource('users', UserController::class)->only('show');
Route::get('/terms', function () {
    return view('terms');
})->name('terms');

