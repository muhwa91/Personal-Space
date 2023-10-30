<?php
	define("ROOT", $_SERVER["DOCUMENT_ROOT"]."/src/"); // 웹서버root
	define("FILE_HEADER", ROOT."header.php"); // 헤더 패스
	require_once(ROOT."lib/lib_db.php");// DB관련 라이브러리

	$conn = null;
	$http_method = $_SERVER["REQUEST_METHOD"];
	$arr_err_msg = [];

	try {		
		if(!db_conn($conn)) {
			throw new Exception("DB Error : PDO Instance");
		}
		if($http_method === "GET") { // 메소드가 GET일 경우
			$id = isset($_GET["id"]) ? $_GET["id"] : ""; //id 세팅
			$page = isset($_GET["page"]) ? $_GET["page"] : ""; // page 세팅
			
			if($id === "") {
				$arr_err_msg[] = sprintf(ERROR_MSG_PARAM, "id");
			}
			// id의 값이 공백일 때 에러메세지 출력
			if($page === "") {
				$arr_err_msg[] = sprintf(ERROR_MSG_PARAM, "page");
			}
			// page : id와 동일
			if(count($arr_err_msg) >= 1) { // 에러메세지가 1 이상일 경우
				throw new Exception(implode("<br>", $arr_err_msg));
			}

			$arr_param = [
				"id" => $id
			];
			// 게시글 데이터 조회 위한 파라미터 세팅 

			$result = db_select_boards_id($conn, $arr_param);

			if($result === false) { // id 조회 실패일 경우
				throw new Exception("DB Error : Select id");
			} else if(!(count($result) === 1)) { // id 조회의 결과가 1이 아닌 경우
				throw new  Exception("DB Error : Select id count");
			}			
		} else {
			// POST일 경우
			$id = isset($_POST["id"]) ? $_POST["id"] : "";
			// id 세팅 : post id 제출 시 true-post로 제출된 id를 $id에 저장
			// false-빈 값 제출
			if($id === "") {
				$arr_err_msg[] = sprintf(ERROR_MSG_PARAM, "id");
			}

			if(count($arr_err_msg) >= 1) { // id나 page 공백일 때
				throw new Exception(implode("<br>", $arr_err_msg));
			}
			// 에러메세지가 1 이상일 때 예외발생

			$conn->beginTransaction();

			$arr_param = [
				"id" => $id
			];
			// 게시글 정보 삭제
			
			if(!db_delete_boards_id($conn, $arr_param)) {
				throw new Exception("DB Error : Delete Boards id");
			}
			$conn->commit();
			header("Location: 00_list.php");
			exit;	
		}
	} catch(Exception $e) {
		if($http_method === "POST") {
			$conn->rollBack();
		}
		// try문에서 예외 발생 시 catch문 실행, 메소드가 POST일 때는 트랜잭션으로 롤백
		echo $e->getMessage();
		exit;
	} finally {
			db_destroy_conn($conn);
	}
?>



<!DOCTYPE html>
<html lang="ko">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>delete</title>
		<link rel="stylesheet" href="./css/common.css">
		<link href="https://fonts.googleapis.com/css2?family=Orbit&display=swap" rel="stylesheet">
	</head>
<body>
	<?php
	require_once(FILE_HEADER);
	?>
	<main>		
		<div class="main_layout">
			<form action="04_delete.php" method="post">
				<table class="board_table">
					<colgroup>
						<col width="10%"> 
						<col width="20%">
						<col width="50%">
						<col width="20%">
					</colgroup>
					<thead class="board_table_head">
						<tr>
							<th class="head_th_1">번호</th>
							<th class="head_th_1">제목</th>
							<th class="head_th_1">내용</th>
							<th class="head_th_1">수정일</th>
						</tr>				
					</thead>
					<tbody class="board_table_body">
						<?php
							foreach($result as $item) {
						?>
						<tr height="618px">
							<td class="body_td_3">
								<?php echo $item["id"]; ?>
							</td>
							<td class="body_td_3">
								<?php echo $item["title"]; ?>
							</td>						
							<td class="body_td_3">
								<?php echo $item["content"]; ?>	
							</td>
							<td class="body_td_3">
								<?php echo $item["update_at"]; ?>
							</td>
						</tr>
						<?php	
						} 
						?>
					</tbody>
				</table>
				<br>
				<div class="paging_layout">
					<input type="hidden" name="id" value="<?php echo $id; ?>">
					<button class="btn" type="button" onclick="location.href='02_detail.php?id=<?php echo $id; ?>&page=<?php echo $page; ?>'">취 소</button>
					<button class="btn_1" onclick="return deLete()">삭 제</button>
				</div>
			</form>  
		</div>
	<script src="./css/style.js"></script>
</body>
</html>