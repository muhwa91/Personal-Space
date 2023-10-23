<?php
	$user = ["rock", "paper", "scissors"];
	while(1){
		echo "*****가위바위보 게임*****\n";
		echo "1.rock 2.paper 3.scissors 중 하나의 값을 입력해주세요. 나가려면 exit를 입력해주세요"."\n"." ex)input : rock"."\n"." input : ";
		$in_str =  trim(fgets(STDIN));
		$user_rand_key = array_rand($user);
		$user_rand_value = $user[$user_rand_key];
		$answer= "*************************"."\n"."admin : {$in_str}"."\n"."user : {$user_rand_value}\n";

		if ($in_str === "rock"){
			if($user_rand_value === $user[0]){
				echo $answer."무승부\n";
			}
			else if ($user_rand_value === $user[1]){
				echo $answer."패배\n";
			}
			else if ($user_rand_value === $user[2]){
				echo $answer."승리\n";
			}
			else {
				echo "error";
			}
		}
		else if ($in_str === "paper") {
			if($user_rand_value === $user[0]){
				echo $answer."승리\n";
			}
			else if ($user_rand_value === $user[1]){
				echo $answer."무승부\n";
			}
			else if ($user_rand_value === $user[2]){
				echo $answer."패배\n";
			}
			else {
				echo "error";
			}
		}
		else if ($in_str === "scissors") {
			if($user_rand_value === $user[0]){
				echo $answer."패배\n";
			}
			else if ($user_rand_value === $user[1]){
				echo $answer."승리\n";
			}
			else if ($user_rand_value === $user[2]){
				echo $answer."무승부\n";
			}
			else {
				echo "error";
			}
		}
		else if ($in_str === "exit"){
			break;
		}
		else {
			echo "잘못된 값을 입력하였습니다.\n";
		}
	}
?>