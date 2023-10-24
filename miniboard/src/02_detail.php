<?php
	define("ROOT", $_SERVER["DOCUMENT_ROOT"]."/miniboard/src/"); // 웹서버root
	require_once(ROOT."lib/lib_db.php");// DB관련 라이브러리

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
		$result = db_select_board_id($conn, $arr_param);

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
	<link rel="stylesheet" href="/miniboard/src/css/common.css">	
</head>
<body>
	
</body>
</html>