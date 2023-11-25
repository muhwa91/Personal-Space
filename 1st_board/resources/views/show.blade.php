@extends('layout.layout')
{{-- layout.blade.php 상속 --}}
@section('title', 'Show')
{{-- title로 Detail 표기 --}}
@section('main')
{{-- layout.blade.php의 상속을 받지 않고 독자적으로 구성 --}}
<main>
    <form class="form-post" method="POST" action="{{route('board.destroy', ['board' => $data->d_id])}}">	
        {{-- 에러메세지 있을 시 errorlayout.blade.php에서 forelse 사용하여 에러메세지 출력 --}}
		@csrf
		{{-- form 태그에서는 의도하지 않은 요청을 악의적으로 전송하여 다른 유저계정에서 실행되는 액션을 
			트리거하는 공격방어 목적으로 @csrf 사용 --}}
		@method('DELETE')
		{{-- delete, put, patch 메소드 : 변경되는 메소드로 처리 될 수 있도록 @method('')설정필요 --}}		
		<div class="show-body">
            <div>
                <p>번호 : {{$data->d_id}} | 조회 수 : {{$data->d_hits}} | 작성일 : {{$data->created_at}} | 수정일 : {{$data->updated_at}}</p>   
                <input type="text" name="d_title" id="d_title" value="{{$data->d_title}}" class="show-input">
                <textarea rows="4" cols="20" name="d_content" id="d_content">{{$data->d_content}}</textarea>
                <div class="form-button">
                    <a href="{{route('board.destroy', ['board' => $data->d_id])}}" class="btn">
                        <button type="submit">삭제</button>
                    </a>
                    <a href="{{route('board.edit', ['board' => $data->d_id])}}" class="btn">
                        <button type="button">수정</button>
                    </a>
                    <a href="{{route('board.index')}}" class="btn">
                        <button type="button">취소</button>
                    </a>
                </div>
            </div>
        </div>
	</form>



    
    
		
		
</main>	

@endsection