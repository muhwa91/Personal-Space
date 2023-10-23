<?php

echo "****** 가위바위보 게임 ******\n";
echo "가위는 S, 바위는 R, 보는 P를 입력해주세요.\n";

$in_str = trim(fgets(STDIN));
$arr = ["rock", "scissor", "paper"];

$random = array_rand($arr);

if($in_str === "rock") {
    if($random === 0) {
        echo "무승부";
    }
    else if($random === 1) {
        echo "승리";
    }
    else if($random === 2) {
        echo "패배";
    }
}
else if($in_str === "scissor") {
    if($random === 0) {
        echo "패배";
    }
    else if($random === 1) {
        echo "무승부";
    }
    else if($random === 2) {
        echo "승리";
    }
}
else if($in_str === "paper") {
    if($random === 0) {
        echo "승리";
    }
    else if($random === 1) {
        echo "패배";
    }
    else if($random === 2) {
        echo "무승부";
    }
}
else {
    echo "S, R, P 중에서 입력해주세요.\n";
}






















