<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\WelcomeController;


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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::prefix('manipal/v1')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('addcomment', [WelcomeController::class, 'addcomment'])->name('addcomment');

    Route::get('/forgot-password', [
        AuthController::class,
        'forgot_password',
    ])->name('forgot-password');

    Route::get('/password-reset', [
        AuthController::class,
        'password_reset',
    ])->name('password-reset');

    Route::get('/confirm/{email}',[AuthController::class, 'confirm_email'])->name('confirm');
    Route::post('/confirm/{email}',[AuthController::class, 'confirm_email'])->name('confirm');

    Route::get('/welcome',[WelcomeController::class, 'welcome'])->name('welcome');
});

Route::get('/', function () {
    return redirect()->route('welcome');
});



Route::middleware(['web', 'auth'])
    ->prefix('manipal/v1')
    ->group(function () {
        //redirect to dashboard
        Route::get('/admin', [DashBoardController::class, 'index'])->name(
            'admin'
        );
        //redirect to dashboard
        Route::post('/logout', [AuthController::class, 'logout'])->name(
            'logout'
        );
        //users
        Route::resource('users', UserController::class);
        //comments
        Route::resource('comments', CommentController::class);
        Route::get('comments/approve/{id}', [CommentController::class, 'approve'])->name('comments.approve');

        Route::resource('products', CommentController::class);


    });
