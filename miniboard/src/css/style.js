// header 현재시간
let now = new Date();
// 현재시간
let year = now.getFullYear();
// 년
let month = now.getMonth()+1;
// 월은 0~11로 반환되어서 +1 해줘야함
let date = now.getDate();
// 일
let hour = now.getHours();
// 시
let min = now.getMinutes();
// 분
let sec = now.getSeconds();
// 초

function Time() {
	let now = new Date();
	let year = now.getFullYear();
	let month = now.getMonth()+1;
	let date = now.getDate();
	let hour = ('0' + now.getHours()).slice(-2);
	let min = ('0' + now.getMinutes()).slice(-2);
	let sec = ('0' + now.getSeconds()).slice(-2);
	let P1 = document.querySelector('.time span')
	P1.innerHTML = ' ' + year + '-' + month + '-' + date + ' ' + hour + ':' + min + ':' +  sec;
}

Time();
let go = setInterval(Time, 1000);

// delete confirm
function deLete() {
	if(confirm("삭제하시겠습니까?")) {  
		alert("정상적으로 삭제 되었습니다.");
   		return true;
	} else {		
		return false;
	}
}