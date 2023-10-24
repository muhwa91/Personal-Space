<?php
	define("ROOT", $_SERVER["DOCUMENT_ROOT"]."/miniboard/src/"); // 웹서버root
	require_once(ROOT."lib/lib_db.php"); // DB관련 라이브러리

	$conn = null; // DB Connection 변수
	$list_cnt = 5; // 한 페이지당 게시글 수
	$page_num = 1; // 페이지 번호 초기화

	try {
		if(!db_conn($conn)) {
			throw new Exception("DB Error : PDO instance");
		}

		// < 페이징 처리 >
		// 총 게시글 수 검색
		$boards_cnt = db_select_boards_cnt($conn);
		// $boards_cnt : return 값 = int
		if($boards_cnt === false) {
			throw new Exception("DB Error : select COUNT ERROR");
		}
		// 유저가 보내온 페이지 세팅
		if(isset($_GET["page"])) {
			$page_num = (int)$_GET["page"];
		};
		// 최대 페이지 수 세팅
		$max_page_num = ceil($boards_cnt / $list_cnt);
		// $max_page_num = 올림(총 게시글 수/1페이지당 게시글 수)
		// 오프셋 세팅
		$offset = ($page_num - 1) * $list_cnt;
		// 1페이지 : (1-1)*5 = 0 > 1~5 게시글 출력
		// 2페이지 : (2-1)*5 = 1 > 6~10 게시글 출력
		// 함수 db_select_boards_paging 게시글 반복 방지
		// limit 5 offset 0, 5, 10... 5배수 적용
		
		// 이전 버튼 변수 세팅
		$prev_page_num = $page_num - 1;
		// 1페이지에서 이전 버튼 눌렀을 때
		// $prev_page_num = 1-1=0 으로 if문 작성 
		// 이전 페이지가 0일 때 1로 유지시키기 위해서
		if ($prev_page_num === 0) {
			$prev_page_num = 1;
		}

		// 다음 버튼 변수 세팅
		$next_page_num = $page_num + 1;
		// 마지막 페이지에서 다음 버튼 눌렀을 때
		// ex)마지막 페이지가 5일 때,
		// $next_page_num = 5+1=6으로 없는 페이지 설정되어 if문 작성
		// 마지막 페이지가 5로 유지시키기 위해서
		if ($next_page_num > $max_page_num) {
			$next_page_num = $max_page_num;
		}

		// < 게시글 조회 >
		// 게시글 조회 위한 파라미터 변수 세팅
		$arr_param = [
			"list_cnt" => $list_cnt
			,"offset" => $offset
		];

		// 게시글 조회
		$result = db_select_boards_paging($conn, $arr_param);
		if($result === False) {
			throw new Exception("DB Error : SELECT boards paging ERROR");
		}
	} catch (Exception $e) {
		echo $e->getMessage();
	} finally {
		db_destroy_conn($conn);
	}

?>

<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>list</title>
	<link rel="stylesheet" href="/miniboard/src/css/common.css">
	<link href="https://fonts.googleapis.com/css2?family=Orbit&display=swap" rel="stylesheet">
</head>
<body>
	<div class="container">
		<table class="center_table">
			<colgroup>
				<col width= 10%> 
				<col width= 20%>
				<col width= 30%>
				<col width= 10%>
				<col width= 10%>
				<col width= 10%>
			</colgroup>
			<thead>
				<tr>
					<th>번호</th>
					<th>제목</th>
					<th>내용</th>
					<th>작성일</th>
					<th>수정일</th>
					<th>삭제일</th>
				</tr>				
        	</thead>
			<tbody>
				<?php
					foreach($result as $item) {
				?>
				<tr>
					<td><?php echo $item["id"]; ?></td>
					<td>
						<a href="/mini_test/src/detail_test.php?id=<?php echo $item["id"]; ?>&page=<?php echo $page_num; ?>">
						<?php echo $item["title"]; ?>
						</a>
					</td>
					<td>
						<?php echo $item["content"]; ?>
					</td>
					<td>
						<?php echo $item["create_at"]; ?>
					</td>
					<td>
						<?php echo $item["update_at"]; ?>
					</td>
					<td>
						<?php echo $item["delete_at"]; ?>
					</td>
				</tr>
				<?php	
				} 
				?>
			</tbody>
		</table>
	</div>
</body>
</html>