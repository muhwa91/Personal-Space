document.addEventListener('DOMContentLoaded', function () {
    var userIcon = document.getElementById('user-icon');
    var userMenu = document.getElementById('user-menu');

    userIcon.addEventListener('click', function () {
        if (userMenu.style.display === 'none' || userMenu.style.display === '') {
        userMenu.style.display = 'block';
        } else {
        userMenu.style.display = 'none';
        }
    });

    // 다른 부분을 클릭하면 메뉴가 닫히도록 설정
    document.addEventListener('click', function (event) {
    var targetElement = event.target;
        if (!userIcon.contains(targetElement) && !userMenu.contains(targetElement)) {
        userMenu.style.display = 'none';
        }
    });
});