<?php
	define("ROOT", $_SERVER["DOCUMENT_ROOT"]."/miniboard/src/"); // 웹서버root
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

		if($http_method === "GET") { // 메소드가 GET일 경우(유저가 처리할 수 없는 에러)
			$id = isset($_GET["id"]) ? $_GET["id"] : ""; // id 세팅			
			$page = isset($_GET["page"]) ? $_GET["page"] : ""; // page 세팅
			
			if($id === "") {
				$arr_err_msg[] = sprintf(ERROR_MSG_PARAM, "id");
			}
			// id의 값이 공백일 때 에러메세지 출력
			if($page === "") {
				$arr_err_msg[] = sprintf(ERROR_MSG_PARAM, "page");
			}
			// page : id와 동일
			if(count($arr_err_msg) >= 1) {
				throw new Exception(implode("<br>", $arr_err_msg));
			}
		} else { // 메소드가 POST일 경우(유저가 처리할 수 있는 에러)
			$id = isset($_POST["id"]) ? $_POST["id"] : "";
			// id 세팅 : post id 제출 시 true-post로 제출된 id를 $id에 저장
			// false-빈 값 제출
			$page = isset($_POST["page"]) ? $_POST["page"] : "";
			// page 세팅 : id 동일
			$title = trim(isset($_POST["title"]) ? trim($_POST["title"]) : "");
			// title 세팅 : post title 작성 시 true-앞뒤공백 제거 후 title 값 저장
			// false-빈 값 제출
			$content = trim(isset($_POST["content"]) ? trim($_POST["content"]) : "");
			// content 세팅 : title 동일
	
			if($id === "") {
				$arr_err_msg[] = sprintf(ERROR_MSG_PARAM, "id");
			}
			if($page === "") {
				$arr_err_msg[] = sprintf(ERROR_MSG_PARAM, "page");
			}

			if(count($arr_err_msg) >= 1) { // id나 page 공백일 때
				throw new Exception(implode("<br>", $arr_err_msg));
			}
			// 에러메세지가 1 이상일 때 예외발생
	
			if($title === "") {
				$arr_err_msg[] = sprintf(ERROR_MSG_PARAM, "제목");
			}
			// title 공백 제출 시 $arr_err_msg[]에 에러메세지 저장
			// 상수선언해둔 결과로 "제목을 입력해 주세요." 출력
			if($content === "") {
				$arr_err_msg[] = sprintf(ERROR_MSG_PARAM, "내용");
			}
			// title과 동일
			// 에러 메세지가 없을 경우에 업데이트 처리
			if(count($arr_err_msg) === 0) { // 에러메세지가 0일 경우 
				$arr_param = [
					"id" => $id
					,"title" => $title
					,"content" => $content 
				];
				// $_POST 제출 값 $arr_param에 저장
			
				$conn->beginTransaction();
				// 메소드 post일 경우에만 트랜잭션 시작
				if(!db_update_boards_id($conn, $arr_param)) {
					throw new Exception("DB Error : Update_Boards_id");
				}
				$conn->commit();
				header("Location: 02_detail.php/?id={$id}&page={$page}");
				exit;
			}
		}
		$arr_param = [
			"id" => $id
		];
		// 게시글 데이터 조회 위한 파라미터 세팅 

		$result = db_select_boards_id($conn, $arr_param);

		if($result === false) { // id 조회 실패일 경우
			throw new Exception("DB Error : PDO Select_id");
		} else if(!(count($result) === 1)) { // id 조회의 결과가 1이 아닌 경우
			throw new Exception("DB Error : PDO Select_id Count, ".count($result));
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
	<title>update</title>
</head>
<body>
	
</body>
</html>