<?php
	define("ROOT", $_SERVER["DOCUMENT_ROOT"]."/src/"); // 웹서버root
	require_once(ROOT."lib/lib_db.php"); // DB관련 라이브러리

	$conn = null; // DB Connection 변수
	$id = ""; // id 세팅

	try {
		if(!db_conn($conn)) { // DB 연결
			throw new Exception("DB Error : PDO Instance");
		}

		if(!isset($_GET["id"]) || $_GET["id"] === "") {
			throw new Exception("Parameter ERROR : No id"); 
		}
		// id 세팅 : get으로 제출받은 값이 id가 아니거나 공백일 때 예외발생
		$id = $_GET["id"]; // id 세팅

		if(!isset($_GET["page"]) || $_GET["page"] === "") {
			throw new Exception("Parameter ERROR : No page");
		}
		// page 세팅 : id와 동일
		$page = $_GET["page"]; // page 세팅

		$arr_param = [
			"id" => $id
		];
		$result = db_select_boards_id($conn, $arr_param);

		// 게시글 조회 예외처리
		if($result === false ) {
			throw new Exception("DB Error : PDO Select_id");
		} else if(!(count($result) === 1)) {
		throw new Exception("DB Error : PDO Select_id count, ".count($result));
		}
	} catch(Exception $e) {
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
	<title>detail</title>
	<link rel="stylesheet" href="../src/css/common.css">	
	<link href="https://fonts.googleapis.com/css2?family=Orbit&display=swap" rel="stylesheet">
</head>
<body>
	<div class="container">
		<table	able class="list_table">
			<colgroup>
				<col width="10%"> 
				<col width="20%">
				<col width="50%">
				<col width="20%">
			</colgroup>
			<thead class="list_table_head">
				<tr>
					<th>번호</th>
					<th>제목</th>
					<th>내용</th>
					<th>작성일</th>
				</tr>				
        	</thead>
			<tbody class="list_table_body text_align">
				<?php
					foreach($result as $item) {
				?>
				<tr>
					<td>
						<?php echo $item["id"]; ?>
					</td>
					<td>
						<?php echo $item["title"]; ?>
					</td>						
					<td>
						<?php echo $item["content"]; ?>
					</td>
					<td>
						<?php echo $item["create_at"]; ?>
					</td>
				</tr>
				<?php	
				} 
				?>
			</tbody>
		</table>
		<br>
		<div class="container_2 text_align">
			<button class="button text_align" onclick="location.href='03_update.php/?id=<?php echo $id; ?>&page=<?php echo $page; ?>'">수 정</button>
			<button class="button text_align" onclick="location.href='00_list.php/?page=<?php echo $page; ?>'";>취 소</button>
			<button class="button text_align" onclick="location.href='04_delete.php/?id=<?php echo $id; ?>&page=<?php echo $page; ?>'">삭 제</button>
		</div>    
	</div>
</body>
</html>