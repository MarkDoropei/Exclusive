var slider1 = new Swiper('.slider1', {
    loop: true,
    pagination: {
        el: ".swiper-pagination",
    },
});

var slider2 = new Swiper('.slider2', {
    loop: true,
    slidesPerView: 4,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});

// Таймер обратного отсчета
const countdownDate = new Date();
countdownDate.setDate(countdownDate.getDate() + 4);

function updateTimer() {
    const now = new Date().getTime();
    const distance = countdownDate - now;

    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Первый таймер
    document.getElementById('days').textContent = days.toString().padStart(2, '0');
    document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
    document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
    document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');

    // Второй таймер
    document.getElementById('categories-days').textContent = days.toString().padStart(2, '0');
    document.getElementById('categories-hours').textContent = hours.toString().padStart(2, '0');
    document.getElementById('categories-minutes').textContent = minutes.toString().padStart(2, '0');
    document.getElementById('categories-seconds').textContent = seconds.toString().padStart(2, '0');
}

const timerInterval = setInterval(updateTimer, 1000);
updateTimer();