'use-strict';
{
    const slides = document.querySelectorAll('.slide');
    let currentIndex = 0;

    slides[currentIndex].classList.add('active');
    function switchSlide() {
        slides[currentIndex].classList.remove('active');
        currentIndex = (currentIndex + 1) % slides.length;
        slides[currentIndex].classList.add('active');
    }

    setInterval(switchSlide, 3000);
}
