@forelse ($errors->all() as $val) 
<div id="errorMsg" class="form-text text-danger">{{$val}}</div>
@empty
@endforelse
{{-- login_post, register_post 메소드에서 유효성 검사 실패 시 에러메세지 출력목적으로 
    forelse 사용 --}}