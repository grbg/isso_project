import gsap from 'gsap';

document.addEventListener('DOMContentLoaded', () => {
    const headers = document.querySelectorAll('.accordion_header');
    const previewImg = document.getElementById('accordionPreviewImg');
    let currentImage = previewImg.src;

    headers.forEach(header => {
        header.addEventListener('click', () => {
            const item = header.parentElement;
            const body = item.querySelector('.accordion_body');
            const imagePath = item.dataset.image;
            const isOpen = item.classList.contains('open');

            // Закрытие других аккордеонов
            document.querySelectorAll('.accordion_item').forEach(el => {
                const elBody = el.querySelector('.accordion_body');
                const elIcon = el.querySelector('.accordion_icon');

                if (el !== item) {
                    el.classList.remove('open');
                    gsap.to(elBody, { height: 0, opacity: 0, padding: 0, duration: 0.3 });
                    gsap.to(elIcon, { rotate: 0, duration: 0.3 });
                }
            });

            const icon = header.querySelector('.accordion_icon');

            if (!isOpen) {
                item.classList.add('open');
                body.style.height = 'auto';
                const fullHeight = body.scrollHeight;
                body.style.height = '0px';

                gsap.to(body, {
                    height: fullHeight,
                    opacity: 1,
                    padding: '16px 0',
                    duration: 0.4,
                    onComplete: () => body.style.height = 'auto'
                });

                gsap.to(icon, { rotate: 180, duration: 0.3 });

                // Если картинка другая, меняем с анимацией
                if (imagePath !== currentImage) {
                    gsap.to(previewImg, {
                        opacity: 0,
                        duration: 0.3,
                        onComplete: () => {
                            previewImg.src = imagePath;
                            currentImage = imagePath;
                            gsap.to(previewImg, {
                                opacity: 1,
                                duration: 0.3
                            });
                        }
                    });
                }

            } else {
                item.classList.remove('open');
                gsap.to(body, { height: 0, opacity: 0, padding: 0, duration: 0.3 });
                gsap.to(icon, { rotate: 0, duration: 0.3 });
            }
        });
    });
});
