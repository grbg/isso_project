function showPopup(message) {
    const popup = document.getElementById('popup');
    const popupMessage = document.querySelector('.popup_message');

    popupMessage.textContent = message;

    popup.classList.remove('show');

    void popup.offsetWidth;

    popup.classList.add('show');

    setTimeout(() => {
        popup.classList.remove('show');
    }, 4000);
}


document.getElementById('add_favorite_btn').addEventListener('click', function() {
    const apartmentId = this.dataset.apartmentid;

    fetch('/favorites/add', {  
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ apartment_id: apartmentId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showPopup(data.message || 'Квартира успешно добавлена в избранное!');
        } else {
            showPopup(data.message || 'Ошибка при добавлении.');
        }
    })
    .catch(() => {
        showPopup('Ошибка сети, попробуйте еще раз.');
    });
});

