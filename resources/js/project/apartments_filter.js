document.addEventListener('DOMContentLoaded', function () {
    const filterButtons = document.querySelectorAll('.filter_button');
    const apartmentsList = document.querySelector('.apartments_list');

    const projectId = window.location.pathname.split('/')[2]; // Извлекаем id из URL

    const item = new Map([
        ['studio','Студия'],
        ['1_room', '1-км квартира'],
        ['2_room', '2-км квартира'],
        ['3_room', '3-км квартира']
    ]);

    const loadApartments = (type = '') => {
        const url = `/projects/${projectId}/apartments${type ? `?type=${type}` : ''}`;
        console.log('Requesting URL:', url); // ← теперь лог корректный
        fetch(url)
            .then(response => response.json())
            .then(data => {
                console.log('Received apartments:', data.apartments); // Логируем все квартиры
                apartmentsList.innerHTML = ''; // Очищаем список квартир

                data.apartments.forEach(apartment => {
                    if (apartment.media && apartment.media.path) {
                        const apartmentItem = document.createElement('div');
                        apartmentItem.classList.add('apartments_item');
                        apartmentItem.setAttribute('data-id', apartment.id);
                        apartmentItem.setAttribute('data-type', apartment.type);
                        apartmentItem.setAttribute('data-floor', apartment.floor);
                        apartmentItem.setAttribute('data-project', apartment.project_name);
                        
                        apartmentItem.innerHTML = `
                            <img src="/storage/${apartment.media.path}" alt="Квартира">
                            <h1 class="text_small mobile_view">${item.get(apartment.type)}</h1>
                            <h1 class="text_small mobile_view">${apartment.floor} этаж</h1>
                            <p class="manrope_regular">${apartment.area} м²</p>
                        `;

                        apartmentsList.appendChild(apartmentItem);
                    } else {
                        console.warn('Missing media or path for apartment:', apartment);
                    }
                });
            })
            .catch(error => console.log('Error:', error));
    };

    // Обработчик кликов на кнопки фильтра
    filterButtons.forEach(button => {
        button.addEventListener('click', function () {
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            const type = this.getAttribute('data-type'); // Получаем тип квартиры с кнопки
            loadApartments(type); // Загружаем квартиры с выбранным типом
        });
    });

    loadApartments(); // Загружаем квартиры по умолчанию
});
