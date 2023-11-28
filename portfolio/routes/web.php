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
Route::get('/', function() {
    return view('index');
})->name('index');
// 메인

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

// Route::post('/login', [UserController::class, 'login_post'])->name('login.post');
// 로그인 처리
Route::middleware('UserInfoValidation')->post('/login', [UserController::class, 'login_post'])->name('login.post');

Route::get('/register', [UserController::class, 'register_get'])->name('register.get');
// 회원가입 화면 이동

// Route::post('/register', [UserController::class, 'register_post'])->name('register.post'); 
// 회원가입 처리
Route::middleware('UserInfoValidation')->post('/register', [UserController::class, 'register_post'])->name('register.post'); 

Route::get('/logout', [UserController::class, 'logout_get'])->name('logout.get'); 
// 로그아웃 처리




Route::fallback(function(){
    return response()->json([
        'code' => 'E03'
    ], 404);
});

// DB_DATABASE=portfolio

// ****문제점****
// 데이터는 들어가고 로그인 했을 때 e99코드
// 설마 토큰이랑 권한키 설정안했기 때문?