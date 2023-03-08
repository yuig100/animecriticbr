// script.js

const links = document.querySelectorAll('.nav-item');
const currentUrl = window.location.pathname;

links.forEach(link => {
    const linkUrl = link.querySelector('a').getAttribute('href');

    if (currentUrl === linkUrl) {
        link.classList.add('active');
    } else {
        link.classList.remove('active');
    }
});
/**/

/**/
$('.dropdown-hover').hover(function () {
    $(this).find('.dropdown-menu').stop(true, true).delay(200).slideDown(500);
}, function () {
    $(this).find('.dropdown-menu').stop(true, true).delay(200).slideUp(500);
});

/**/ 
var slides = document.querySelectorAll('.slide');
var currentSlide = 0;
var indicators = document.querySelectorAll('.indicator');
var prevButton = document.querySelector('.prev');
var nextButton = document.querySelector('.next');

function goToSlide(n) {
    slides[currentSlide].classList.remove('active');
    indicators[currentSlide].classList.remove('active');
    currentSlide = (n + slides.length) % slides.length;
    slides[currentSlide].classList.add('active');
    indicators[currentSlide].classList.add('active');
}

function nextSlide() {
    goToSlide(currentSlide + 1);
}

function prevSlide() {
    goToSlide(currentSlide - 1);
}

prevButton.addEventListener('click', prevSlide);
nextButton.addEventListener('click', nextSlide);

setInterval(prevSlide, 5000);

/* */
document.getElementById('logout-link').addEventListener('click', function (e) {
    e.preventDefault();
    axios.post('/logout')
        .then(function (response) {
            window.location.href = response.data.redirect;
        })
        .catch(function (error) {
            console.log(error);
        });
});

/* */
