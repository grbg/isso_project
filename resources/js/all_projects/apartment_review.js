export function apartment_review() {
  const baseDataHeight = 100;

  // Установка начальных высот
  function setInitialHeights() {
    document.querySelectorAll('.project_item').forEach(item => {
      const dataBlock = item.querySelector('.project_item_data');
      const imgBlock = item.querySelector('.project_item_img');
      const totalHeight = item.clientHeight;

      dataBlock.style.height = baseDataHeight + 'px';
      imgBlock.style.height = (totalHeight - baseDataHeight) + 'px';
    });
  }

  // Основная логика наведения
  function setupHoverEvents() {
    document.querySelectorAll('.project_item').forEach(item => {
      const dataBlock = item.querySelector('.project_item_data');
      const imgBlock = item.querySelector('.project_item_img');
      const apartmentTypes = item.querySelector('.apartment_types');

      dataBlock.addEventListener('mouseenter', () => {
        const totalHeight = item.clientHeight;
        const apartmentTypesHeight = apartmentTypes.scrollHeight;
        const newDataHeight = baseDataHeight + apartmentTypesHeight + 50;
        const newImgHeight = totalHeight - newDataHeight;

        dataBlock.style.height = newDataHeight + 'px';
        imgBlock.style.height = newImgHeight + 'px';

        apartmentTypes.style.transform = 'translateY(0%)';
        apartmentTypes.style.opacity = '1';
        apartmentTypes.style.pointerEvents = 'auto';

        item.classList.add('active');
      });

      dataBlock.addEventListener('mouseleave', () => {
        const totalHeight = item.clientHeight;

        dataBlock.style.height = baseDataHeight + 'px';
        imgBlock.style.height = (totalHeight - baseDataHeight) + 'px';

        apartmentTypes.style.transform = 'translateY(100%)';
        apartmentTypes.style.opacity = '0';
        apartmentTypes.style.pointerEvents = 'none';

        item.classList.remove('active');
      });
    });
  }

  // Инициализация
  setInitialHeights();
  setupHoverEvents();

  // Обновление при изменении размера окна
  window.addEventListener('resize', () => {
    setInitialHeights();
  });
}

document.addEventListener('DOMContentLoaded', () => {
  apartment_review();
});
