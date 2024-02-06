'use-strict';
{
    const slides = document.querySelectorAll('.arrow-slide');
    let currentIndex = 0;
    slides[currentIndex].classList.add('active');

    function switchSlide(direction) {
        slides[currentIndex].classList.remove('active');
        currentIndex = (currentIndex + direction + slides.length) % slides.length;
        slides[currentIndex].classList.add('active');
    }
}
