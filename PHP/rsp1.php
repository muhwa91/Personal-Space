<?php

echo "****** 가위바위보 게임 ******\n";
echo "가위는 S, 바위는 R, 보는 P를 입력해주세요.\n";

$input = strtoupper( trim(fgets(STDIN)) );

$computer = com_rand( 0, 2 );
$user = 0;

//유저 입력값 숫자 변환


if( $computer === 0 ) { //컴 가위 
    if( $user === 0 ) { //유저 가위
        $result = 0; // 무승부
    }
    else if( $user === 1 ) { //유저 바위 
        $result = 1; // 유저 승리
    }
    else{ // 유저 보
        $result = 2; 
    } // 유저 패배    
}
else if( $computer === 1 ) { // 컴 바위
    if( $user === 0) { // 유저 가위
        $result = 2; // 유저 패배
    }
    else if( $user === 1) { // 유저 바위
        $result = 0; // 무승부
    }
    else{ // 유저 보
        $result = 1; 
    } // 유저 승리
}
else { // 컴 보
    if( $user === 0 ) { // 유저 가위
        $result = 1; // 유저 승리
    }
    else if( $user === 1) { // 유저 바위
        $result = 2; // 유저 패배
    }
    else{ // 유저 보
        $result = 0; // 무승부
    }
}

$result_vdl = "";
switch( $result) {
    case 0:

}
















?>