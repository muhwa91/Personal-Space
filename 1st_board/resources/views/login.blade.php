@extends('layout.layout')
{{-- layout.blade.php 상속 --}}
@section('title', 'Login')
{{-- title로 Login 표기 --}}
@section('main')
{{-- layout.blade.php의 상속을 받지 않고 독자적으로 구성 --}}
<main>
	<form method="POST" action="{{route('user.login.post')}}" style="width: 400px;">
		{{-- 1. 미들웨어로 유효성 체크&검사
			 2. return $next($request);
			 3. 유저 요청건에 대하여 유저컨트롤러에서 loginpost 메소드 호출
			 4. Hash클래스의 check메소드 호출하여 유저 입력 값과 유저모델을 통한 DB 저장 값과 비교하여 체크
			 5. 체크한 값이 false일 시 return view('login')->withErrors($errorMsg);
			 6. 체크한 값이 true일 시 유저정보의 id를 획득하여 세션에 저장
			 7. return redirect()->route('board.index'); --}}
		@include('layout.errorMsg')
		{{-- 에러메세지 있을 시 errorlayout.blade.php에서 forelse 사용하여 에러메세지 출력 --}}
		@csrf
		{{-- form 태그에서는 의도하지 않은 요청을 악의적으로 전송하여 다른 유저계정에서 실행되는 액션을 
			트리거하는 공격방어 목적으로 @csrf 사용 --}}		
		<div class="mb-3">
			<label for="email" class="form-login">이메일</label>
			<input type="text" class="form-control" id="email" name="email" autocomplete="off">
		</div>
        <br>
		<div class="mb-3">
			<label for="password" class="form-login">비밀번호</label>
			<input type="password" class="form-control" id="password" name="password" autocomplete="off">
		</div>
        <br>
        <div class="form-login-button">
            <button type="submit" class="btn">로그인</button>
        </div>
	</form>
</main>
@endsection