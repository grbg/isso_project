document.addEventListener('DOMContentLoaded', () => {
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    document.querySelectorAll('.remove_favorite_btn').forEach(button => {
        button.addEventListener('click', (event) => {
            event.preventDefault();

            const apartmentId = button.getAttribute('data-id');
            fetch(`/compare/remove/${apartmentId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'removed') {
                    console.log(data);
                    button.closest('.apartment_item').style.display = 'none';
                    
                    if (document.querySelectorAll('.apartment_item').length === 0) {
                        document.querySelector('.apartments_container').remove();
                        document.querySelector('.container').insertAdjacentHTML('beforeend', '<p>Вы ещё не добавили квартиры в сравнение.</p>');
                    }
                }
            });
        });
    });
});
