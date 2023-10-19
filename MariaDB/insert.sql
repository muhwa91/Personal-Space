-- insert into 테이블명 (속성1,속성2)
-- values (속성값1,속성값2)
-- ex) 500000번 신규회원
insert into employees (
    emp_no
    ,birth_date
    ,first_name
    ,last_name
    ,gender
    ,hire_date
)
values (
    500000
    ,19911002
    ,'pikachu'
    ,'electricity'
    ,'M'
    ,99990101
);

-- ex) 500000번 사원의 직책 데이터 삽입

insert into titles (
    emp_no
    ,title
    ,from_date
    ,to_date
)
values (
    500000
    ,'Senior Engineer'
    ,now()
    ,99990101
);















