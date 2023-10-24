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
	<link rel="stylesheet" href="/miniboard/src/css/common.css">	
</head>
<body>

</body>
</html>