<?php
	define("ROOT", $_SERVER["DOCUMENT_ROOT"]."/src/"); // 웹서버root
	define("FILE_HEADER", ROOT."header.php"); // 헤더 패스
	define("ERROR_MSG_PARAM", "%s을 입력해 주세요."); // 파라미터 에러 메세지 // 제목, 내용
	require_once(ROOT."lib/lib_db.php");// DB관련 라이브러리

	$conn = null; // DB Connection 변수
	$http_method = $_SERVER["REQUEST_METHOD"]; // 메소드 확인
	$arr_err_msg = []; // 에러메세지 저장용 변수(배열) 설정
	$title = ""; // 제목 세팅
	$content = ""; // 내용 세팅

	try {
		if(!db_conn($conn)) { // DB 연결
			throw new Exception("DB Error : PDO Instance");
		}
		$conn->beginTransaction(); // 트랜잭션 시작

		if($http_method === "POST") {
			$title = isset($_POST["title"]) ? trim($_POST["title"]) : "";
			// title 세팅 : post title 작성 시 true-앞뒤공백 제거 후 title 값 저장
			// false-빈 값 제출
			$content = isset($_POST["content"]) ? trim($_POST["content"]) : "";
			// content 세팅 : title 동일
			
			if($title === "") {
				$arr_err_msg[] = sprintf(ERROR_MSG_PARAM, "제목");
				// title 공백 제출 시 $arr_err_msg[]에 에러메세지 저장
				// 상수선언해둔 결과로 "제목을 입력해 주세요." 출력
			}
			if($content === "") {
				$arr_err_msg[] = sprintf(ERROR_MSG_PARAM, "내용");
			}
				// title과 동일
			if(count($arr_err_msg) === 0) {
				$arr_param = $_POST;			
				// 에러메세지가 0일 경우 슈퍼글로벌변수 $_POST 제출 값 $arr_param에 저장
				if(!db_insert_boards($conn, $arr_param)) {
					throw new Exception("DB Error : Insert Boards");
				}
				$conn->commit();
				header("Location: 00_list.php");
				exit;
			}
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
	<title>insert</title>
	<link rel="stylesheet" href="./css/common.css">
	<link href="https://fonts.googleapis.com/css2?family=Orbit&display=swap" rel="stylesheet">	
</head>
<body>
	<?php
		require_once(FILE_HEADER);
	?>
	<main>
		<div class="main_layout">		
			<form action="01_insert.php" method="post">			
				<table class="board_table">
					<colgroup>
						<col width="40%">
						<col width="60%">
					</colgroup>
					<thead class="board_table_head">
						<tr>
							<th class="head_th_1">제목</th>
							<th class="head_th_1">내용</th>
						</tr>				
					</thead>
					<tbody class="board_table_body">
						<tr>
							<td>								
								<label for="title"></label>
								<textarea class="ins_textarea_1" name="title" id="title" value="<?php echo $title; ?>"
								maxlength="25" placeholder="제목을 작성해주세요." spellcheck="false"></textarea>
								<!-- $title = ""; 로 선언해두었고, $title = ""; 출력하여 입력 기본 값으로 설정 -->
								<!-- value 설정해주면 post 파라미터에 저장됨 -->								
							</td>
							<td>
								<label for="content"></label>
								<textarea class="ins_textarea_2" name="content" id="content" cols="25" rows="10"
								placeholder="내용을 작성해주세요." spellcheck="false"><?php echo $content; ?></textarea>
								<!-- $content = ""; 로 선언해두었고, $content = ""; 출력하여 입력 기본 값으로 설정 -->
							</td>
						</tr>				
					</tbody>
				</table>
				<br>
				<div class="paging_layout">
					<button class="btn" type="reset">초기화</button>
					<button class="btn" type="button" onclick="location.href='00_list.php?page=1'">취 소</button>
					<button class="btn" type="submit">작 성</button>
				</div>
			</form>  		
		</div>
	</main>
</body>
</html>