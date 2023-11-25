<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class UserInfoValidation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // 미들웨어 발리데이션 사용할 때 app>Kernel.php>protected $routeMiddleware 추가

    Log::debug("*****유저 유효성 체크 시작*****");        

        // 항목리스트
        $BaseKey = [ // DB 컬럼명
            'email'
            ,'name'
            ,'password'
            ,'password_confirmation'
            ,'tel'          
        ];

        // 유효성 체크리스트
        $BaseValidation = [
            'email'                     => 'required|email|max:50' 
            // 필수입력, email, 최대입력
            , 'name'                    => 'required|regex:/^[a-zA-Z가-힣]+$/|min:2|max:50' 
            // 필수입력, 정규식, 최소입력, 최대입력
            , 'password'                => 'required' 
            // 필수입력
            , 'password_confirmation'   => 'same:password' 
            // 비밀번호와 동일한지 비교
            , 'tel'                     => 'required|regex:/^010[0-9]{8}$/'
            // 필수입력, 정규식
        ];

        // Request 파라미터
        $RequestParam = [];
        foreach($BaseKey as $val) { // 리퀘스트에 해당 키를 가져오기 위해서 루프
            if($request->has($val)) {
                $RequestParam[$val] = $request->$val;
            } else {
                unset($BaseValidation[$val]);
                // 루프 진행하면서 리퀘스트 값이 없을 때에는 unset 메소드 사용하여
                // 리퀘스트 값이 없는 유효성 체크리스트 값을 지우는 역할
                // ex) name 리퀘스트 값이 없으면 유효성 체크리스트 name의 값도 삭제
            }
        }

        Log::debug("Request 파라미터 획득", $RequestParam);
        Log::debug("유효성 체크 리스트 획득", $BaseValidation);

        // 유효성 검사
        $validator = Validator::make($RequestParam, $BaseValidation);
        
        if($validator->fails()){// 유효성 검사 실패시 처리
            Log::debug("************ 유저 유효성 체크 에러 종료 ************");
            return redirect('/'.$request->path())->withErrors($validator->errors());
        }

        Log::debug("************ 유저 유효성 체크 정상 종료 ************");

        return $next($request);
    }
}
