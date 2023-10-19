-- >delete 구조

-- delete from 테이블명
-- where 조건
-- where절 적지 않는다면 모든 레코드가 삭제됨
-- 실수방지를 위해 where절을 먼저 작성하고 delete from절 작성하는 습관 기르기

-- INSERT INTO departments (
-- 	dept_no
-- 	,dept_name
-- 	)
-- 	VALUES (
-- 	'd010'
-- 	,'new'
-- 	);
-- >임의로 departments테이블 내에 d010 부서 삽입

DELETE FROM departments
WHERE dept_no = 'd010';
-- >d010부서 삭제















