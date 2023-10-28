<?php
	define("ROOT", $_SERVER["DOCUMENT_ROOT"]."/src/"); // 웹서버root
	define("FILE_HEADER", ROOT."header.php"); // 헤더 패스
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
	<link rel="stylesheet" href="../src/css/common.css">
	<link href="https://fonts.googleapis.com/css2?family=Orbit&display=swap" rel="stylesheet">
</head>
<body>
	<?php
		require_once(FILE_HEADER);
	?>
	<main>		
		<div class="main_layout">
			<table class="board_table">
				<colgroup>
					<col width="10%"> 
					<col width="20%">
					<col width="50%">
					<col width="20%">
				</colgroup>
				<thead class="board_table_head">
					<tr>
						<th class="head_th_2">번호</th>
						<th class="head_th_2">제목</th>
						<th class="head_th_2">내용</th>
						<th class="head_th_2">작성일</th>
					</tr>				
				</thead>
				<tbody class="board_table_body">
					<?php
						foreach($result as $item) {
					?>
					<tr onclick="location.href='02_detail.php?id=<?php echo $item['id']; ?>&page=<?php echo $page_num; ?>'">
						<td class="body_td_2">							
							<?php echo $item["id"]; ?>							
						</td>
						<td class="body_td_2">
							<?php echo $item["title"]; ?>							
						</td class="body_td_2">						
						<td class="body_td_2">							
							<?php echo $item["content"]; ?>							
						</td>
						<td class="body_td_1">
							<?php echo $item["create_at"]; ?>
						</td>
					</tr>
					<?php	
					} 
					?>
				</tbody>
			</table>
			<br><br><br><br><br><br>				
			<div class="paging_layout">
				<a class="right_page_num hovor_bgc" href="00_list.php?page=<?php echo $prev_page_num; ?>"><<</a>
				<?php
					$block_num=(int)ceil($page_num/5);
					$block_first_num=(5*$block_num)-4;
					$present_num=$block_first_num-1;
					for($i = $block_first_num; $i <= $block_num*5; $i++) {
						$present_num+=1;					
						if ($i > $max_page_num) {
							break;
						}
						$str = $page_num === $present_num ? "bgc_black" : "hovor_bgc";					
				?>	
					<a class="right_page_num <?php echo $str; ?>" href="00_list.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
				<?php
					}
				?>
				<a class="right_page_num hovor_bgc" href="00_list.php?page=<?php echo $next_page_num; ?>">>></a>			
				<button class="insert_btn" onclick="location.href='01_insert.php'";>작 성</button>		
			</div>
		</div>
	</main>
</body>
</html>