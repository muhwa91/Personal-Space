<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\CommunityBoard;
use Illuminate\Support\Facades\Session;


class CommunityBoardController extends Controller
{   
    public function store(Request $request)
    {
        $data = $request->only('user_id', 'community_content');
        $result = CommunityBoard::create($data);

        return redirect()->route('forums.link.get');
        // // return view('community');
    }    

    public function show($id)
    {
       //        
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = CommunityBoard::find($id);
        return view('community/edit')->with('data', $result);
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
        $data = $request->only('community_content');
        $result = CommunityBoard::find($id);
        $result->community_content = $request->community_content;
        $result->save();
        return redirect()->route('forums.link.get', ['communityboard' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Log::debug("***** 삭제 처리 시작 *****");
        try {
            DB::beginTransaction();
            Log::debug(" ***** 트랜잭션 시작 *****");
            CommunityBoard::destroy($id);
            Log::debug(" ***** 삭제 완료 *****");
            DB::commit();
            Log::debug(" ***** 커밋 완료 *****");
            return redirect()->route('forums.link.get');
        } catch(Exception $e) {
            DB::rollback();
            Log::debug(" ***** 예외 발생 : 롤백 완료 *****");
            return redirect()->route('error')->withError($e->getMessage());
        } finally {
            Log::debug(" ***** 삭제 처리 종료 *****");
        }
    }
}
