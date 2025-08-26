import gsap from 'gsap';
import { filterProjects } from './all_projects/project_filtration.js';

document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.filter_button').forEach(button => {
    button.addEventListener('click', () => {
      // Убираем активный класс у всех
      document.querySelectorAll('.filter_button').forEach(b => {
        b.classList.remove('active');
        gsap.to(b.querySelector('.fill'), { height: 0, duration: 0.3 });
      });

      // Добавляем активный класс нажатой кнопке
      button.classList.add('active');

      gsap.to(button.querySelector('.fill'), {
        height: '100%',
        duration: 0.5,
        ease: 'power2.out'
      });

      filterProjects();
    });
  });

  // Обработчик для изменения города
  const cityInput = document.getElementById('cityInput');
  cityInput.addEventListener('change', filterProjects);

  gsap.from('.project_item', {
                opacity: 0,
                y: 50,
                duration: 0.8,
                ease: 'power3.out',
                stagger: {
                    amount: 0.35,
                    from: "start"
                }
            });

});
