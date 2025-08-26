import gsap from 'gsap';

window.addEventListener('load', () => {
    gsap.from('.nav_link', {
        y: '120%',  // Начинаем с положения за пределами экрана// Изначально элементы невидимы
        duration: 1.5, // Длительность анимации
        stagger: 0.2, // Задержка между анимациями для каждого элемента
        ease: 'power4.out', // Плавное завершение
    });

    gsap.from('.logo', {
        y: '120%',
        duration: 1.5,
        delay: 1, // Задержка для логотипа
        ease: 'power4.out',
    });

    gsap.from('.account_container', {
        y: '120%',
        duration: 1.5,
        delay: 1, // Задержка для контейнера с аккаунтом
        ease: 'power4.out',
    });
});

  