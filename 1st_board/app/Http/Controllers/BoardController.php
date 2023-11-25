<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Board;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 게시글 획득
        $result = Board::get(); // DB에 있는 데이터 저장
        return view('main')->with('data', $result); // list 페이지에서 DB에서 받아온 데이터를 저장한 $result를 data에 저장하여 사용

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $request->validate([ // 공백입력 막기위해 유효성 검사 실시
            'd_title' => 'required',
            'd_content' => 'required',
        ]);
        $data = $request->only('d_title', 'd_content');
        $result = Board::create($data);
        return redirect()->route('board.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = Board::find($id);
        // 게시글 데이터 획득
        $result->d_hits++;
        // 조회수 1 증가
        $result->timestamps = false;
        // timestamps 현재 시간 기준으로 처리되기 때문에 false 변경
        $result->save(); 
        // save 메소드 사용 시 변경 값 업데이트
        return view('show')->with('data', $result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = Board::find($id);
        return view('edit')->with('data', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $result = Board::find($id);
        $result->d_title = $request->d_title;
        $result->d_content = $request->d_content;
        $result->save();
        return redirect()->route('board.show', ['board' => $result->d_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Log::debug("*****삭제처리 시작*****");
        try {
            DB::beginTransaction();
            Log::debug("*****트랜잭션 시작*****");
            Board::destroy($id);
            Log::debug("*****삭제 완료*****");
            DB::commit();
            Log::debug("*****커밋 완료*****");
            return redirect()->route('board.index');     
        } catch(Exception $e) {
            DB::rollback();
            Log::debug("*****예외 발생 : 롤백 완료*****");
            return redirect()->route('error')->withError($e->getMessage());
        } finally {
        Log::debug("*****삭제처리 종료*****");
        }
    }
}
