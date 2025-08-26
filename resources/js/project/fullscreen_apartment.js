const modal = document.querySelector('.more_info_modal_container');
const overlay = document.querySelector('.modal_overlay'); // если есть оверлей
const modalWrapper = modal.querySelector('.more_info_modal_wrapper');
const fullscreenContainer = modal.querySelector('.fullscreen_apartment_container');

const fullscreenImg = fullscreenContainer.querySelector('.fullscreen_apartment_image img');
const fullscreenName = fullscreenContainer.querySelector('[data-fs-project]');
const fullscreenArea = fullscreenContainer.querySelector('[data-fs-area]');
const fullscreenFloor = fullscreenContainer.querySelector('[data-fs-floor]');

const apartmentProjectName = document.getElementById('apartmentPreviewProjName');
const apartmentArea = document.getElementById('apartmentPreviewArea');
const apartmentFloor = document.getElementById('apartmentPreviewFloor');

// Открытие fullscreen модалки с данными квартиры
document.querySelectorAll('.fullscreen_btn').forEach(btn => {
  btn.addEventListener('click', () => {
    // Получаем родительский .apartments_preview (куда положили data-атрибуты)
    const apartmentPreview = btn.closest('.apartments_preview');
    if (!apartmentPreview) return;

    // Считываем данные
    const name = apartmentProjectName.textContent || '—';
    const area = apartmentArea.textContent || '—';
    const floor = apartmentFloor.textContent || '—';
    
    // Получаем src изображения
    const img = apartmentPreview.querySelector('.apartments_preview_img img');
    const imgSrc = img ? img.src : '';

    // Записываем данные в fullscreen секцию
    fullscreenImg.src = imgSrc;
    fullscreenName.textContent = name;
    fullscreenArea.textContent = area + ' м²';
    fullscreenFloor.textContent = floor;

    // Открываем модалку, переключаем видимость блоков
    modal.classList.add('modal-active');
    overlay?.classList.add('active');

    modalWrapper.style.display = 'none';
    fullscreenContainer.style.display = 'block';
  });
});

// Закрытие модалки
function closeModal() {
  modal.classList.remove('modal-active');
  overlay?.classList.remove('active');

  modalWrapper.style.display = 'block';
  fullscreenContainer.style.display = 'none';

  zoomableImage.style.transform = 'none';
  scale = 1;
  translateX = 0;
  translateY = 0;
  targetTranslateX = 0;
  targetTranslateY = 0;
  imageWrapper.classList.remove('zoomable_container');
}

// Закрытие по клику на оверлей
overlay?.addEventListener('click', closeModal);

// Закрытие по кресту в fullscreen секции
fullscreenContainer.querySelector('.close_modal_btn')?.addEventListener('click', closeModal);

// Закрытие по кресту в основном wrapper (если есть)
modalWrapper.querySelector('.close_modal_btn')?.addEventListener('click', closeModal);



const imageWrapper = document.getElementById('imageWrapper');
const zoomableImage = document.getElementById('zoomableImage');
const zoomInBtn = document.getElementById('zoomInBtn');
const zoomOutBtn = document.getElementById('zoomOutBtn');

let scale = 1;
let translateX = 0;
let translateY = 0;

let targetTranslateX = 0;
let targetTranslateY = 0;

let isDragging = false;
let startX = 0;
let startY = 0;

function updateTransform() {
    // Применяем текущие координаты (плавные)
    zoomableImage.style.transform = `scale(${scale}) translate(${translateX / scale}px, ${translateY / scale}px)`;
}

function enterZoomMode() {
    if (!imageWrapper.classList.contains('zoomable_container')) {
        imageWrapper.classList.add('zoomable_container');
    }
}

function exitZoomMode() {
    imageWrapper.classList.remove('zoomable_container');
    zoomableImage.style.transform = 'none';
    scale = 1;
    translateX = 0;
    translateY = 0;
    targetTranslateX = 0;
    targetTranslateY = 0;
}

zoomInBtn.addEventListener('click', () => {
    if (scale < 3) {
        scale += 0.25;
        enterZoomMode();
        updateTransform();
    }
});

zoomOutBtn.addEventListener('click', () => {
    if (scale > 1) {
        scale -= 0.25;
        updateTransform();
    }
    if (scale <= 1) {
        exitZoomMode();
    }
});

// Перетаскивание — обновляем targetTranslateX/Y
imageWrapper.addEventListener('mousedown', (e) => {
    if (!imageWrapper.classList.contains('zoomable_container')) return;
    isDragging = true;
    startX = e.clientX - targetTranslateX;
    startY = e.clientY - targetTranslateY;
    imageWrapper.style.cursor = 'grabbing';
});

document.addEventListener('mousemove', (e) => {
    if (!isDragging) return;
    targetTranslateX = e.clientX - startX;
    targetTranslateY = e.clientY - startY;
});

document.addEventListener('mouseup', () => {
    if (!isDragging) return;
    isDragging = false;
    imageWrapper.style.cursor = 'grab';
});

// Анимационный цикл для плавного смещения
function animate() {
    // Интерполяция — приближаемся к цели с коэффициентом плавности (0.1)
    translateX += (targetTranslateX - translateX) * 0.1;
    translateY += (targetTranslateY - translateY) * 0.1;

    updateTransform();

    requestAnimationFrame(animate);
}

animate();
