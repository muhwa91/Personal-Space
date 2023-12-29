
document.querySelectorAll('.like-button').forEach(function(element) {
    element.addEventListener('click', function(e) {
        e.preventDefault();
        this.classList.toggle('liked');
    });
});