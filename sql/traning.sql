-- 여자사원의 사번, 생일, 풀네임 오름차순
SELECT
	emp_no
	,birth_date
	,CONCAT(first_name,' ',last_name) full_name
FROM employees
WHERE gender = 'F'
ORDER BY full_name;
-- >오름차순 asc : 기본값으로 설정되어 있어 생략가능

-- 재직중인 사원 중 급여 상위 5위까지 출력
SELECT *
FROM salaries
WHERE to_date >= NOW()
ORDER BY salary DESC
LIMIT 5;

-- d002부서의 현재 매니저 정보 출력
SELECT *
FROM employees
WHERE emp_no = (
	SELECT emp_no
	FROM dept_manager
	WHERE to_date >= NOW()
		AND dept_no = 'd002');
-- >서브쿼리 : 쿼리 내에 또 다른 쿼리가 있는 형태
-- >SELECT emp_no
-- 	FROM dept_manager
-- 	WHERE to_date >= NOW()
-- 		AND dept_no = 'd002'02'; 
-- >dept_manager테이블에서 현재, d002부서의 사원번호 출력 : 110114
-- SELECT *
-- FROM employees
-- WHERE emp_no = 110114;

-- 현재 급여가 가장 높은 사원의 사번과 풀네임 출력
SELECT 
	emp_no
	,CONCAT(first_name,' ',last_name) full_name
FROM employees
WHERE emp_no = (
	SELECT emp_no
	FROM salaries
	WHERE to_date >= NOW()
	ORDER BY salary desc
	LIMIT 1);

-- 현재 부서장인 사람의 소속부서테이블 모든 정보 출력
SELECT
	*
FROM dept_emp
WHERE (dept_no, emp_no) IN (
	SELECT dept_no, emp_no
	FROM dept_manager
	WHERE to_date >= NOW());
	
-- 현재 직책이 Senior Engineer인 사원의 사번과 생일출력
SELECT 
	emp.emp_no
	,emp.birth_date
FROM employees emp
	JOIN titles	tit
	ON emp.emp_no = tit.emp_no
	AND tit.to_date >= NOW()
	WHERE tit.title = 'Senior Engineer';

-- 사원의 현재 급여, 현재 급여를 받기 시작한 날짜, 풀네임 출력
SELECT
	sal.salary
	,sal.from_date
	,CONCAT(emp.first_name,' ',emp.last_name)
FROM employees emp
	JOIN salaries sal
	ON emp.emp_no = sal.emp_no
	AND sal.to_date >= NOW(); 
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	