// AJAX 
// api는 도구의 역할, ajax는 통신을 하기 위한 기술
// 비동기처리로 동적인 화면 처리하고 싶을 때 사용

// JSON 
// 데이터 타입은 문자열, 데이터 포맷을 하여 사용

function getItem() {
	let apiUrl = "http://localhost:8000/api/item"
	fetch(apiUrl) // 서버 url, 패치 실행 후 then 파라미터 받을 수 있음
	.then(response => response.json())
	.then(data => {
		let content = data.data[0].content; 
		// JSON 데이터 내에 date 0번 인덱스의 content
		let cp = document.createElement('p');
		cp.innerHTML = content;
		document.body.appendChild(cp);
	})
	.catch(error => console.log(error));
}

// cf) laravel_api 서버연결 후 DB연동 값 확인가능
// 게시글 작성
function addItem() {
	fetch('http://localhost:8000/api/item', {
		method: 'POST',
		headers: {
			"Content-Type": "application/json"
		},
		body: JSON.stringify({
			"data": {
				"content": "이거 데이터 나옴?"
			}
		})
	})
	.then(response => response.json())
	.then(data => console.log(data))
	.catch(error => console.log(error))
}

// 게시글 수정
function updateItem() {
	fetch('http://localhost:8000/api/item/5', { // 세그먼트 파라미터 잊지말기
		method: 'PUT',
		headers: {
			"Content-Type": "application/json" // 통신 시 필요한 설정값을 넣는 구역(html 헤더부분)
		},
		body: JSON.stringify({
			"data": {
				"completed": "1"
			}
		})
	})
	.then(response => response.json())
	.then(data => console.log(data))
	.catch(error => console.log(error))
}

// 게시글 삭제
function deleteItem() {
	fetch('http://localhost:8000/api/item/5', {
		method: 'DELETE' // delete 세팅 값 없음	
	})
	.then(response => response.json())
	.then(data => console.log(data))
	.catch(error => console.log(error))
}