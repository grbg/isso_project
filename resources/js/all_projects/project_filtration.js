import gsap from 'gsap';
import { apartment_review } from './apartment_review.js';

export function filterProjects() {
    const city = document.getElementById('cityInput').value;
    const type = document.querySelector('.filter_button.active')?.dataset.type || '';

    fetch(`/projects/filter?city=${encodeURIComponent(city)}&type=${encodeURIComponent(type)}`)
        .then(response => response.json())
        .then(data => {
            const container = document.querySelector('.project_list_container');
            container.innerHTML = data.html;
            apartment_review();

            gsap.from('.project_item', {
                opacity: 0,
                y: 50,
                duration: 0.8,
                ease: 'power3.out',
                stagger: {
                    amount: 0.3,
                    from: "start"
                }
            });
        });
}
