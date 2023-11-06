<?php

// [php mysql 테이블 생성]

$sql = "CREATE TABLE employees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE,
    hire_date DATE,
    salary int DEFAULT 0,
    is_active INT DEFAULT 1
)";

// id INT AUTO_INCREMENT PRIMARY KEY
// 1) int : 정수 정의
// 2) auto_increment : 자동으로 증가하는 기본 키 열
// 3) primary key : 기본 키 지정

// first_name VARCHAR(50) NOT NULL
// 1) varchar(50) : 최대 길이 50자 문자열 정의
// 2) not null : null 값 허용X
// cf) not null 설정 시, 해당 데이터 반드시 제공되어야 함
// 예로써 first_name, last_name 제공하지 않으면 해당 데이터는 저장되지 않음

// email VARCHAR(100) UNIQUE
// 1) varchar(100) : 최대 길이 100자 문자열 정의
// 2) unique : 중복 값 허용하지 않는 고유 제약 조건

// hire_date DATE
// 1) date : 날짜 형식 정의

// salary int DEFAULT 0.00
// 1) int : 정수 정의
// 2) default : 기본 값으로 설정
// cf) default 설정 시, 새로운 레코드 삽입 시에 값이 제공되지 않은 경우 사용되는 기본값 설정
// 모든 레코드가 열에 값을 제공하지 않더라도 기본값이 설정되어 데이터 일관성 유지 가능
// 예로써 사용자 등록일자를 입력하지 않아도 해당 열에는 자동으로 현재날짜 설정