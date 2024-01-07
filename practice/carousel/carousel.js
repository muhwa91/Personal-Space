var slideIndex = 1;
showSlides(slideIndex);

function plusSlide(n) {
  showSlides((slideIndex += n));
}

function currentSlide(n) {
  showSlides((slideIndex = n));
}

function showSlides (n){
    var i;
    var slides = document.getElementsByClassName("slide-content");
    var balls = document.getElementsByClassName("ball");

    if (n > slides.length) {
        slideIndex = 1
    }
    if (n < 1) {
        slideIndex = slides.length
    }
    for (i = 0; i < slides.length; i++){
        slides[i].style.display = "none";
    }
    for (i = 0; i < balls.length; i++){
      balls[i].className = balls[i].className.replace("active","");
    }
	slides[slideIndex-1].style.display = "block";
	balls[slideIndex-1].className+= " active";
}



function slideTime(n){
 n=1
 showSlides(slideIndex += n);
 }
 
setInterval(slideTime, 5000);


