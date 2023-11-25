@extends('layout.layout')
{{-- layout.blade.php 상속 --}}
@section('title', 'Create')
{{-- title로 Create 표기 --}}
@section('main')
{{-- layout.blade.php의 상속을 받지 않고 독자적으로 구성 --}}
<main>
	<form class="form-post" method="POST" action="{{route('board.store')}}" style="width: 1000px;">
		{{-- 1. 미들웨어로 권한 체크
			 2. 보드컨트롤러 store()메소드 호출하여 유저 입력 값 중 only()메소드 사용하여 b_title, b_content
			 배열형태로 $data 저장
			 3. 보드모델 create메소드 호출하여 유저 제출 데이터 DB insert 처리
			 4. return redirect()->route('board.index'); --}}		
		{{-- 에러메세지 있을 시 errorMsg.blade.php에서 forelse 사용하여 에러메세지 출력 --}}
		@csrf
		{{-- form 태그에서는 의도하지 않은 요청을 악의적으로 전송하여 다른 유저계정에서 실행되는 액션을 
			트리거하는 공격방어 목적으로 @csrf 사용 --}}           
        <div class="show-body">
            <div>
                <p class="form-p">제목과 내용을 작성해주세요.</p>
                <input type="text" name="d_title" id="d_title" autocomplete="off" class="show-input">
                <textarea class="form-control" name="d_content" id="d_content" cols="10" rows="4"></textarea>
                <div class="form-button">
                    <button type="submit" class="btn">작성</button>
                    <a href="{{route('board.index')}}" class="btn">
                        <button type="button">취소</button>
                    </a>			
                </div>
            </div>
        </div>
	</form>
</main>

@endsection