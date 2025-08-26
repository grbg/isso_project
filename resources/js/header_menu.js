import gsap from 'gsap';

document.addEventListener('DOMContentLoaded', () => {
    const burgerIcon = document.getElementById('burgerIcon');
    const burgerMenu = document.querySelector('.burger_menu');
    const burgerCloseBtn = document.getElementById('burgerCloseBtn');

    let menuOpen = false;

    burgerCloseBtn.addEventListener('click', () => {
        // закрываем меню с анимацией круга
        gsap.to(burgerMenu, {
            clipPath: 'circle(0% at 100% 0%)',
            duration: 0.6,
            ease: 'power2.inOut',
            onComplete: () => {
                burgerMenu.style.pointerEvents = 'none';
                menuOpen = false; // чтобы синхронизировать состояние
            }
        });
    });

    burgerIcon.addEventListener('click', () => {
        console.log('+');
        if (menuOpen) {
            // Анимация скрытия меню — сжатие круга
            gsap.to(burgerMenu, {
                clipPath: 'circle(0% at 100% 0%)',
                duration: 0.6,
                ease: 'power2.inOut',
                onComplete: () => {
                    burgerMenu.style.pointerEvents = 'none';
                }
            });
        } else {
            burgerMenu.style.pointerEvents = 'auto';
            // Анимация появления меню — расширение круга
            gsap.to(burgerMenu, {
                clipPath: 'circle(150% at 100% 0%)',
                duration: 0.6,
                ease: 'power2.inOut',
            });
        }
        menuOpen = !menuOpen;
    });

    // --- User Info Menu ---
    const userInfo = document.getElementById('userInfo');
    const userMenu = document.getElementById('userMenu');

    gsap.set(userMenu, { opacity: 0, y: 10, pointerEvents: 'none', display: 'none' });

    let userMenuVisible = false;
    let userMenuAnimation;

    function showUserMenu() {
        userMenu.style.display = 'block';
        userMenuAnimation = gsap.to(userMenu, {
            duration: 0.3,
            opacity: 1,
            y: 0,
            pointerEvents: 'auto',
            ease: 'power3.out',
        });
        userMenuVisible = true;
    }

    function hideUserMenu() {
        userMenuAnimation = gsap.to(userMenu, {
            duration: 0.2,
            opacity: 0,
            y: 10,
            pointerEvents: 'none',
            ease: 'power3.in',
            onComplete: () => {
                userMenu.style.display = 'none';
            },
        });
        userMenuVisible = false;
    }

    userInfo.addEventListener('click', (e) => {
        e.stopPropagation();
        userMenuVisible ? hideUserMenu() : showUserMenu();
    });

    document.addEventListener('click', (e) => {
        if (
            userMenuVisible &&
            !userMenu.contains(e.target) &&
            !userInfo.contains(e.target)
        ) {
            hideUserMenu();
        }
    });

    
});
