ymaps.ready(init);
        
function init() {
    const mapBtn = document.getElementById('ymap');
    const latitude = parseFloat(mapBtn.dataset.latitude);
    const longitude = parseFloat(mapBtn.dataset.longitude);
    
    const myMap = new ymaps.Map("ymap", {
        center: [latitude, longitude],
        zoom: 18,
        controls: [] 
    });

    const placemark = new ymaps.Placemark([latitude, longitude], {
        hintContent: 'Расположение проекта',
        balloonContent: 'Проект на карте'
    });

    myMap.geoObjects.add(placemark);
}