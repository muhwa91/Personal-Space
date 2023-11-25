<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BoardController;

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
    return view('login');
});

Route::get('/board.index', [UserController::class, 'main_get'])->name('main.get');
// 홈으로 이동
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

Route::middleware('auth')->resource('/board', BoardController::class);

//   GET|HEAD  board .......................... board.index › BoardController@index  게시판 화면이동
//   GET|HEAD  board/create ................... board.create › BoardController@create  게시글 create 화면이동
//   POST      board .......................... board.store › BoardController@store  게시글 insert 처리
//   GET|HEAD  board/{board} .................. board.show › BoardController@show  게시글 detail 화면이동
//   DELETE    board/{board} .................. board.destroy › BoardController@destroy  게시글 delete 처리
//   GET|HEAD  board/{board}/edit ............. board.edit › BoardController@edit  게시글 update 화면이동
//   PUT|PATCH board/{board} .................. board.update › BoardController@update  게시글 update 처리