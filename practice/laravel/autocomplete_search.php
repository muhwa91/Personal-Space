<?php
// search route
Route::get("search",[AlgoliaController::class, 'algoliaSearch']);


// AlgoliaController

public function algoliaSearch(Request $request) {
	if($request->ajax()) {
		$data = book_info(모델명)::where('b_title', 'like', '%'.$request->search.'%')
		->orwhere('b_author', 'like', '%'.$request->search.'%')
		->orwhere('b_sub_cate', 'like', '%'.$request->search.'%')->get();
		
		$output = '';
        if(count($data)>0) {            
            $output ='
                <table class="table">
                <thead>
                <tr>
                    <th>제목</th>
                    <th>저자</th>
                    <th>카테고리</th>
                </tr>
                </thead>
                <tbody>';

                    

                    foreach($data as $bookInfo) {
                        $output .='
                        <tr>
                        <td>'.$bookInfo->b_title.'</td>
                        <td>'.$bookInfo->b_author.'</td>
                        <td>'.$bookInfo->b_sub_cate.'</td>
                        </tr>`
                        ';
                    }
            $output .='
                </tbody>
                </table>';
        } else {
            $output .='No results';
        }
    return $output;
    }
}