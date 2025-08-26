import { filterProjects } from './project_filtration.js';

document.addEventListener('DOMContentLoaded', () => {
    const dropdown = document.getElementById('cityDropdown');
    const selected = dropdown.querySelector('#selectedCity');
    const list = dropdown.querySelector('.dropdown_list');
    const input = dropdown.querySelector('#cityInput');

    selected.addEventListener('click', () => {
      dropdown.classList.toggle('open');
    });

    list.querySelectorAll('li').forEach(item => {
      item.addEventListener('click', () => {
        const value = item.dataset.value;
        const displayValue = value === '' ? 'Все' : value;

        selected.innerHTML = `${displayValue} <span class="dropdown_arrow">&#9662;</span>`;
        input.value = value;
        dropdown.classList.remove('open');
        filterProjects();
      });

    });

    // Закрытие при клике вне
    document.addEventListener('click', (e) => {
      if (!dropdown.contains(e.target)) {
        dropdown.classList.remove('open');
      }
    });
  });