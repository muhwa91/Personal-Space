<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\CommunityBoard;

class UserController extends Controller
{
    // Games 화면 이동
    public function games_get() {        
        return view('review');
    }

    // Blog 화면 이동
    public function blog_get() {        
        return view('categories');
    }

    // Forums 화면 이동
    public function forums_get() {  
            
        // $result = CommunityBoard::orderBy('community_id', 'desc')->get()->take(3);
        // foreach ($result as $value) {
        //     $aaa = User::where('id', $value['user_id'])->first();
        //     $value['name'] = $aaa->name;
        // }

        $result = CommunityBoard::join('user as us', 'us.id', '=', 'community_board.user_id')
                ->select('community_board.*', 'us.name')
                ->orderByDesc('community_id')
                ->limit(3)
                ->get();
        Log::debug(" ***** 인덱스1111 *****".$result);  
        return view('community')->with('data', $result);
    }

    // Contact 화면 이동
    public function contact_get() {        
        return view('contact');
    }

    // 로그인 화면 이동
    public function login_get() {
        if(Auth::check()) {
            return redirect()->route('index');
        }
        return view('login');
    }

    // 로그인 처리
    public function login_post(Request $request) {
        // 유저정보 획득
        $result = User::where('email', $request->email)->first();
        // first() : 검색된 결과 중 첫번째 레코드 반환(조건에 맞는 결과 하나만 가져올 때 사용)
        if(!$result || !(Hash::check($request->password, $result->password))) {
            // email or 비밀번호가 DB와 합치하지 않을 때 
            $errorMsg = '이메일 또는 비밀번호를 다시 확인해주세요.';
            return view('login')->withErrors($errorMsg);
        }

        // 유저 인증
        Auth::login($result);
        if(Auth::check()) {
            session($result->only('id'));
        } else {
            $errorMsg = '인증 에러가 발생했습니다.';
            return view('login')->withErrors($errorMsg);
        }
        return redirect()->route('index');
    }

    // 회원가입 화면 이동
    public function register_get() {
        if(Auth::check()) {
            return redirect()->route('board.index');
        } 
        return view('register');
    }

    // 회원가입 처리
    public function register_post(Request $request) {
        $data = $request->only('email', 'password', 'name', 'tel'); 
        // 배열로 only 내 데이터 확인가능 

        $data['password'] = Hash::make($data['password']); 
        // 비밀번호 암호화
        
        $result = User::create($data); 
        // 회원정보 DB 저장
        // create 메소드 호출>이메일, 비밀번호, 이름, 휴대폰번호 DB insert 처리

        return redirect()->route('login.get');
    }

    // 로그아웃 처리
    public function logout_get() {
        Session::flush(); 
        // 세션파기
        Auth::logout(); 
        // 로그아웃
        return redirect()->route('index');
    }
}
