// 찜하기 버튼 시작
document.querySelectorAll('.like-button').forEach(function(element) {
    element.addEventListener('click', function(e) {
        e.preventDefault();
        this.classList.toggle('liked');
    });
});
// 찜하기 버튼 끝