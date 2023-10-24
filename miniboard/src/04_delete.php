<?php
	define("ROOT", $_SERVER["DOCUMENT_ROOT"]."/miniboard/src/"); // 웹서버root
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
			header("Location: 01_list.php");
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
</head>
<body>
	
</body>
</html>