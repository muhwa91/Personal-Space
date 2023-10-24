CREATE DATABASE miniboard;

USE miniboard;

CREATE TABLE boards(
	id INT PRIMARY KEY AUTO_INCREMENT
	,title VARCHAR(100) NOT NULL
	,content VARCHAR(1000) NOT NULL
	,create_at DATE NOT NULL
	,update_at DATE
	,delete_at DATE
	,delete_flg CHAR(1) NOT NULL DEFAULT '0'
);

commit;