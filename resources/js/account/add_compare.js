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

document.querySelectorAll('.compare_btn').forEach(button => {
    button.addEventListener('click', function (event) {
        event.preventDefault();
        const apartmentId = this.dataset.id;

        fetch(`/compare/add/${apartmentId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'added') {
                showPopup('Квартира успешно добавлена в сравнение!');
            }
        })
        .catch(err => {
            showPopup('Квартира уже в сравнении');
        });
    });
});