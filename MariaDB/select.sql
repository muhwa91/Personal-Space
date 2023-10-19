SELECT *
FROM employees;
-- >employees 테이블에서 전체 검색

SELECT *
FROM employees
WHERE emp_no = 10009;
-- >employees 테이블에서 사원번호 10009 전체 검색

SELECT *
FROM employees
WHERE first_name = 'Mary';
-- >employees 테이블에서 Mary 이름을 가진 사원 검색

SELECT *
FROM employees
WHERE birth_date >= 19650101
  AND birth_date <= 19700101;
-- >employees 테이블에서 1965년 1월 1일 이상 1970년 1월 1일 이하 출생한 사원 검색

SELECT *
FROM employees
WHERE first_name = 'Mary'
  AND last_name = 'piazza';
-- > Mary 이름과 piazza 성을 가진 사원 검색

SELECT *
FROM employees
WHERE first_name = 'Mary'
   or last_name = 'piazza';
-- > Mary 이름 또는 piazza 성을 가진 사원 검색

SELECT *
FROM employees
WHERE emp_no >= 10005
  AND emp_no <= 10010;
SELECT *
FROM employees
WHERE emp_no BETWEEN 10005 AND 10010;
-- > 둘다 동일 값으로 출력 
-- >처리속도 : and>between

SELECT *
FROM employees
WHERE emp_no = 10005 
   OR emp_no = 10010;
SELECT *
FROM employees
WHERE emp_no IN(10005,10010);
-- >둘다 동일 값으로 출력
-- >처리속도 : or>in

SELECT *
FROM employees
WHERE first_name LIKE('Ge%');
-- >이름이 GE~인 사원 검색
SELECT *
FROM employees
WHERE first_name LIKE('%Ge');
-- >이름이 ~ge인 사원 검색
SELECT *
FROM employees
WHERE first_name LIKE('%Ge%');
-- >이름에 ge가 들어간 사원 검색

SELECT *
FROM employees
WHERE first_name LIKE('_Ge');
-- >이름에 _개수만큼 ge가 포함되어 있는 사원 검색

SELECT *
FROM employees
ORDER BY birth_date DESC;
-- >생일을 오름차순으로 정렬
-- >order by : 오름차순으로 정렬
-- >기본 값은 오름차순으로 되어 있으며, asc 생략 가능
-- >내림차순 : desc
SELECT *
FROM employees
ORDER BY last_name DESC
		,first_name
		,birth_date;
-- >성을 내림차순으로, 이름과 생일을 오름차순으로 정렬

SELECT DISTINCT emp_no, salary
FROM salaries;
-- >사원번호와 급여를 중복없이 검색
-- >emp_no, salary 한 묶음으로 중복안되는 값 검색(O)
-- >emp_no 중복안되고, salary 중복안되는 값으로 검색(X)

-- [집계함수]
SELECT SUM(salary) 
FROM salaries
WHERE to_date >= NOW();
-- >현재 받고 있는 급여의 총액

SELECT MAX(salary)
FROM salaries
WHERE to_date >= NOW();
-- >현재 받고 있는 급여 중 가장 높은 급여

SELECT MIN(salary)
FROM salaries
WHERE to_date >= NOW();
-- >현재 받고 있는 급여 중 가장 낮은 급여

SELECT AVG(salary)
FROM salaries
WHERE to_date >= NOW();
-- >현재 받고 있는 급여의 평균

SELECT COUNT(*)
FROM employees;
-- >직원의 수

SELECT COUNT(*)
FROM employees
WHERE first_name = 'Mary';
-- >Mary 이름을 가진 직원의 수

SELECT title, COUNT(title)
FROM titles
WHERE to_date >= NOW()
GROUP BY title HAVING title LIKE('%Staff%');
-- >Staff가 포함된 직급 중 현재 재직중인 직원에 대한 직급과 직원의 수

SELECT CONCAT(first_name, ' ', last_name) full_name
FROM employees;
-- >concat : 문자열을 함쳐주는 함수
-- >이름+공백+성

SELECT *
FROM employees
ORDER BY emp_no
LIMIT 10 OFFSET 10;
-- >employees테이블에서 emp_no 정렬하고 10개 제한
-- >offset : 10개 제외하고 나머지 10개 추출



















