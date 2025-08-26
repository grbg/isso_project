const model_btn = document.getElementById('3d_btn');
const map_btn = document.getElementById('map_btn');
const model_view = document.getElementById('project_section_model');
const ymap_view = document.getElementById('ymap');
const zoom = document.querySelector('.model_zoom_container');

model_view.style.display = 'block';
ymap_view.style.display = 'none';
model_btn.classList.add('selected');

model_btn.addEventListener('click', () => {
  if (!model_btn.classList.contains('active')) {
    // Показываем модель, скрываем карту
    model_view.style.display = 'block';
    ymap_view.style.display = 'none';
    zoom.style.display = 'block';

    // Обновляем классы активности
    model_btn.classList.add('selected');
    map_btn.classList.remove('selected');
  }
});

map_btn.addEventListener('click', () => {
  if (!map_btn.classList.contains('selected')) {
    // Показываем карту, скрываем модель
    ymap_view.style.display = 'block';
    model_view.style.display = 'none';
    
    zoom.style.display = 'none';

    // Обновляем классы активности
    map_btn.classList.add('selected');
    model_btn.classList.remove('selected');
  }
});