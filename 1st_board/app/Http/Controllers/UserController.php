<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class UserController extends Controller
{
    public function login_get() {
        // 로그인 유저 board.index 이동
        if(Auth::check()) {
            return redirect()->route('board.index');
        }
        return view('login');
    }

    public function login_post(Request $request) {
        // 유저정보 획득
        $result = User::where('email', $request->email)->first();
        // first() : 검색된 결과 중 첫번째 레코드 반환
        // (조건에 맞는 결과 하나만 가져올 때 사용)
        if(!$result || !(Hash::check($request->password, $result->password))) {
            // 유저의 입력 비밀번호와 DB의 비밀번호 비교
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
        return redirect()->route('board.index');
    }

    public function registrer_get() {
        return view('register');
    }

    public function register_post(Request $request) {
        $data = $request->only('email', 'password', 'name'); // 배열로 only 내 데이터 확인가능        
        // var_dump($data);

        $data['password'] = Hash::make($data['password']); // 비밀번호 암호화        
        // var_dump($data);
        
        $result = User::create($data); // 회원정보 DB 저장
        // create 메소드 호출>이메일, 비밀번호, 이름 DB insert 처리
        // var_dump($result);       

        return redirect()->route('user.login.get');
        // cf)try catch문 사용하지 않아도 라라벨 내부에서 자동으로 잡아줌 
    }

    public function logout_get() {
        Session::flush(); // 세션파기
        Auth::logout(); // 로그아웃
        return redirect()->route('user.login.get');
    }
}