<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommunityBoardController;

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
Route::get('/', function() {
    return view('index');
})->name('index');
// 메인

// <User>
Route::get('/games', [UserController::class, 'games_get'])->name('games.link.get');
// Games 화면 이동

Route::get('/blog', [UserController::class, 'blog_get'])->name('blog.link.get');
// Blog 화면 이동

Route::get('/forums', [UserController::class, 'forums_get'])->name('forums.link.get');
// Forums 화면 이동

Route::get('/contact', [UserController::class, 'contact_get'])->name('contact.link.get');
// Contact 화면 이동

Route::get('/login', [UserController::class, 'login_get'])->name('login.get'); 
// 로그인 화면 이동

Route::middleware('UserInfoValidation')->post('/login', [UserController::class, 'login_post'])->name('login.post');
// 로그인 처리

Route::get('/register', [UserController::class, 'register_get'])->name('register.get');
// 회원가입 화면 이동

Route::middleware('UserInfoValidation')->post('/register', [UserController::class, 'register_post'])->name('register.post'); 
// 회원가입 처리

Route::get('/logout', [UserController::class, 'logout_get'])->name('logout.get'); 
// 로그아웃 처리


// <Community Board>
Route::middleware('auth')->resource('/communityboard', CommunityBoardController::class);

// GET|HEAD  communityboard .......................... communityboard.index › CommunityBoardController@index
// 게시판 화면 이동
// POST      communityboard .......................... communityboard.store › CommunityBoardController@store 
// 게시글 insert 처리
// GET|HEAD  communityboard/{communityboard} ......... communityboard.show › CommunityBoardController@show
// 게시판 detail 화면 이동
// GET|HEAD  communityboard/{communityboard}/edit .... communityboard.edit › CommunityBoardController@edit
// 게시판 update 화면 이동 
// PUT|PATCH communityboard/{communityboard} ......... communityboard.update › CommunityBoardController@update
// 게시글 update 처리 
// DELETE    communityboard/{communityboard} ......... communityboard.destroy › CommunityBoardController@destroy  
// 게시글 delete 처리



Route::fallback(function(){
    return response()->json([
        'code' => 'E03'
    ], 404);
});

// DB_DATABASE=portfolio

