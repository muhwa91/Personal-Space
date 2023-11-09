CREATE DATABASE test;

USE test;

CREATE TABLE USER(
	id INT PRIMARY KEY AUTO_INCREMENT
	,u_name VARCHAR(30) NOT NULL
	,u_birth DATE NOT NULL
	,create_at DATETIME DEFAULT CURRENT_TIMESTAMP()
);

CREATE TABLE PRODUCT(
	id INT PRIMARY KEY AUTO_INCREMENT
	,p_name VARCHAR(100) NOT null
	,p_price INT NOT NULL
);

CREATE TABLE delivery(
	id INT PRIMARY KEY AUTO_INCREMENT
	,delivery_flg CHAR(1) DEFAULT '0'
	,u_id INT NOT NULL
	,p_id INT NOT NULL
);


-- fk키는 주로 alter 이용
-- add constraint(제약조건 추가) 보통은 fk_테이블명_참조당하는 컬럼명
-- foreign key(폴인키/참조당하는 컬럼명) REFERENCES 참조하는 테이블(컬럼명)
ALTER TABLE delivery ADD CONSTRAINT fk_delivery_u_id
foreign KEY (u_id) REFERENCES user(id);

ALTER TABLE delivery ADD CONSTRAINT fk_delivery_p_id
foreign KEY (p_id) REFERENCES product(id);

COMMIT;

-- 테이블 자체 삭제
DROP TABLE delivery;
-- 데이터베이스 삭제
DROP DATABASE test;









