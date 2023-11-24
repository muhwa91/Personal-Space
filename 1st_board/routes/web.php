<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('', function () {
    return view('main');
});

Route::get('/user/login', [UserController::class, 'login_get'])->name('user.login.get'); 
// 로그인 화면 이동
Route::middleware('UserInfoValidation')->post('/user/login', [UserController::class, 'login_post'])->name('user.login.post'); 
// 로그인 처리
Route::get('/user/register', [UserController::class, 'register_get'])->name('user.register.get'); 
// 회원가입 화면이동
Route::middleware('UserInfoValidation')->post('/user/register', [UserController::class, 'register_post'])->name('user.register.post'); 
// 회원가입 처리
Route::get('/user/logout', [UserController::class, 'logout_get'])->name('user.logout.get'); 
// 로그아웃 처리
