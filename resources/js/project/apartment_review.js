document.addEventListener('DOMContentLoaded', function () {
    const apartmentsList = document.querySelector('.apartments_list');
    
    const previewImage = document.querySelector('.apartments_preview_img img');
    const previewArea = document.querySelector('.preview_project_stats_item:nth-child(2) p.manrope_bold');
    const previewFloor = document.querySelector('.preview_project_stats_item:nth-child(3) p.manrope_bold');
    const previewProject = document.querySelector('.preview_project_stats_item:nth-child(1) p.manrope_bold');
    const add_btn = document.querySelector("#add_favorite_btn");
    const projectId = window.location.pathname.split('/')[2]; 

    const item = new Map([
        ['studio','Студия'],
        ['1_room', '1-км квартира'],
        ['2_room', '2-км квартира'],
        ['3_room', '3-км квартира']
    ]);

    const loadApartments = (type = '') => {
        const url = `/projects/${projectId}/apartments${type ? `?type=${type}` : ''}`;
        fetch(url)
            .then(response => response.json())
            .then(data => {
                apartmentsList.innerHTML = ''; // Очищаем список квартир

                // Загружаем квартиры
                data.apartments.forEach(apartment => {
                    const apartmentItem = document.createElement('div');
                    apartmentItem.classList.add('apartments_item');
                    apartmentItem.setAttribute('data-id', apartment.id);
                    apartmentItem.setAttribute('data-type', apartment.type);
                    apartmentItem.setAttribute('data-floor', apartment.floor);
                    apartmentItem.setAttribute('data-project', apartment.project_name);
                    console.log('Название проекта', apartment.project_name)
                    apartmentItem.innerHTML = `
                        <img src="/storage/${apartment.media.path}" alt="Квартира">
                        <h1 class="text_small mobile_view">${item.get(apartment.type)}</h1>
                        <h1 class="text_small mobile_view">${apartment.floor} этаж</h1>
                        <p class="text_small">${apartment.area} м²</p>
                    `;
                    apartmentsList.appendChild(apartmentItem);
                });

                // Если есть последняя квартира, показываем ее в превью
                if (data.lastApartment) {
                    const lastApartment = data.lastApartment;
                    previewImage.src = `/storage/${lastApartment.media.path}`;
                    previewArea.textContent = lastApartment.area + ' м²';
                    previewArea.setAttribute('data-area', lastApartment.area);
                    previewFloor.textContent = lastApartment.floor || 'Не указан';
                    previewFloor.setAttribute('data-floor', lastApartment.floor);
                    previewProject.textContent = lastApartment.project_name || 'Не указан';
                    console.log('Название проекта last', lastApartment.project_name)
                    previewProject.setAttribute('data-project', lastApartment.project_name);
                    add_btn.setAttribute('data-apartmentId', lastApartment.id);
                
                    const lastApartmentElement = apartmentsList.querySelector(`.apartments_item[data-id="${lastApartment.id}"]`);
                    if (lastApartmentElement) {
                        lastApartmentElement.classList.add('selected');
                    }
                }
            })
            .catch(error => console.log('Error:', error));
    };

    loadApartments(); // Загружаем квартиры по умолчанию

    apartmentsList.addEventListener('click', function (event) {
        const item = event.target.closest('.apartments_item');
    
        if (item) {
            // Снимаем выделение с предыдущего элемента
            const prevSelected = apartmentsList.querySelector('.apartments_item.selected');
            if (prevSelected) {
                prevSelected.classList.remove('selected');
            }
        
            // Добавляем обводку текущему элементу
            item.classList.add('selected');
        
            // Обновляем превью
            const apartmentArea = item.querySelector('p').textContent.trim();
            const apartmentImagePath = item.querySelector('img').getAttribute('src');
            const apartmentFloor = item.dataset.floor || 'Не указан';
            const apartmentProject = item.dataset.project || 'Не указан';
        
            previewImage.src = apartmentImagePath;
            previewArea.textContent = apartmentArea;
            previewFloor.textContent = apartmentFloor;
            previewProject.textContent = apartmentProject;
            add_btn.setAttribute('data-apartmentId', item.dataset.id);
        }
    });

});

