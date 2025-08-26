import { gsap } from "gsap";
import SplitType from 'split-type'

const openModalBtn = document.getElementById('openModalBtn');
const modal = document.querySelector('.more_info_modal_container');
const overlay = document.querySelector('.modal_overlay');

openModalBtn.addEventListener('click', () => {
    modal.classList.add('modal-active');
    overlay.classList.add('active');
});

// Закрытие при клике на оверлей
overlay?.addEventListener('click', () => {
    modal.classList.remove('modal-active');
    overlay.classList.remove('active');
});


const title_text = new SplitType('#project_title')

gsap.to('.char', {
    y: 0,
    stagger: 0.05,
    delay: 0.2,
    duration: .1
})


