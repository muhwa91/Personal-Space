// let add = (a, b) => a + b;

// function countdown(n) {
//   if (n < 0) return;
//   console.log(n);
//   countdown(n - 1);
// }
// countdown(10);

// 처리가 많을 때의 화살표 함수
// let f1 = (a, b) => {
//   if (a < b) return "b가 a보다 크다";
//   else return "a가 b보다 크다";
// };

// 콜백함수
// function repeat(n, f) {
//   for (var i = 0; i < n; i++) f(i);
// }

// var logAll = function (i) {
//   console.log(i);
// };

// repeat(5, logAll);
// 처리과정
// 아규먼트 5, logAll을 함수 repeat 파라미터에 전달
// for문 실행 i = 0, 0 < 5, 0++
// logAll에 저장되어 있는 콜백함수 호출
// cf)고차함수의 아규먼트를 콜백함수에 전달할 수 있음
// function(i) { console.log(i) }; 실행
// 01234 출력

// < 처리할 문이 1개일 경우 {} 생략할 수 있는 상황 >
// if, else if, else
// for, wile, do-while, switch case

// 콜백함수 사용 이벤트 처리
// document.getElementById("BTN").addEventListener("click", function () {
//   window.alert("버튼 눌렀어요");
// });

// 함수 setTimeout : 콜백함수 사용한 비동기 처리
setTimeout(function () {
  console.log("5초경과");
}, 5000);
