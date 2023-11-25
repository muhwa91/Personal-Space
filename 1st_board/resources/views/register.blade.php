@extends('layout.layout')
{{-- layout.blade.php 상속 --}}
@section('title', 'Login_Register')
{{-- title로 Registration 표기 --}}
@section('main')
{{-- layout.blade.php의 상속을 받지 않고 독자적으로 구성 --}}
<main class="register_body">
    <form class="form-post" method="POST" action="{{route('user.register.post')}}">
		{{-- 1. 미들웨어로 유효성 체크&검사
			 2. return $next($request);
			 3. 유저 요청건에 대하여 유저컨트롤러에서 register_post 메소드 호출
			 4. Hash클래스의 check메소드 호출하여 유저 입력 값과 유저모델을 통한 DB 저장 값과 비교하여 체크
			 5. 체크한 값이 false일 시 return view('login')->withErrors($errorMsg);
			 6. 체크한 값이 true일 시 유저정보의 id를 획득하여 세션에 저장
			 7. return redirect()->route('board.index'); --}}
		{{-- 에러메세지 있을 시 errorlayout.blade.php에서 forelse 사용하여 에러메세지 출력 --}}
		@csrf
		{{-- form 태그에서는 의도하지 않은 요청을 악의적으로 전송하여 다른 유저계정에서 실행되는 액션을 
			트리거하는 공격방어 목적으로 @csrf 사용 --}}	
        <div class="register-form">
            <div class="register_1">
                <div class="mb-3">
                    <label for="email" class="form-label">이메일</label>
                    <input type="text" class="show-input" id="email" name="email" autocomplete="off">
                </div>
                <br>
                <div class="mb-3">
                    <label for="password" class="form-label">비밀번호</label>
                    <input type="password" class="show-input" id="password" name="password" autocomplete="off">
                </div>
                <br>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">비밀번호 확인</label>
                    <input type="password" class="show-input" id="password_confirmation" name="password_confirmation" autocomplete="off">
                </div>
            </div>
            <div class="register_2">
                <div class="mb-3">
                    <label for="name" class="form-label">이름</label>
                    <input type="text" class="show-input" id="name" name="name" autocomplete="off">
                </div>
                <br>
                <div class="register_2">
                    <label for="tel" class="form-label">휴대폰 번호</label>
                    <input type="tel" class="show-input" id="tel" name="tel" autocomplete="off">
                </div>
                <br>
                <div class="form-button">
                    <button type="submit" class="btn">회원가입</button>
                    <a href="{{route('user.login.get')}}" class="btn">
                        <button type="button">취소</button>
                    </a>
                    @include('layout.errorMsg')
                </div>
            </div>
        </div>
	</form>
</main>
@endsection