@extends('layouts.app')

@section('page_name', 'Аккаунт пользователя')

@section('content')

@php
    $typeLabels = [
        'studio' => 'Студия',
        '1_room' => '1-км квартира',
        '2_room' => '2-км квартира',
        '3_room' => '3-км квартира',
    ];
@endphp

@vite(['resources/css/pages/account.css'])
@vite(['resources/css/components/popup.css'])
@vite(['resources/js/account/add_compare.js'])
    <div class="account_wrapper">
        <p class="account_title h1">Личная информация</p>
        <div class="account_inputs_container">
            <form method="POST" action="{{ route('profile.updatePhone') }}" class="profile_input manrope_medium">
                @csrf
                @method('PUT')
                <label for="number">Телефон</label>
                <input id="number" type="text" placeholder="+7 (978) 245-04-53" value="{{ old('phone', $user->phone) }}" />
                <button type="button" class="edit-btn">
                    <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="{{ asset('images/ui/rename_btn')}}">
                        <rect width="36" height="36" rx="18" fill="#EDEDED"/>
                        <path d="M20 20.6667L17.3333 23.3333H22.6667C23.4 23.3333 24 22.7333 24 22C24 21.2667 23.4 20.6667 22.6667 20.6667H20ZM18.04 14.7933L12.1933 20.64C12.0733 20.76 12 20.9333 12 21.1067V22.6667C12 23.0333 12.3 23.3333 12.6667 23.3333H14.2267C14.4067 23.3333 14.5733 23.26 14.7 23.14L20.5467 17.2933L18.04 14.7933ZM22.4733 15.36C22.5351 15.2983 22.5842 15.2251 22.6176 15.1444C22.6511 15.0638 22.6683 14.9773 22.6683 14.89C22.6683 14.8027 22.6511 14.7162 22.6176 14.6356C22.5842 14.5549 22.5351 14.4817 22.4733 14.42L20.9133 12.86C20.8517 12.7982 20.7784 12.7492 20.6978 12.7157C20.6171 12.6823 20.5306 12.665 20.4433 12.665C20.356 12.665 20.2696 12.6823 20.1889 12.7157C20.1083 12.7492 20.035 12.7982 19.9733 12.86L18.7533 14.08L21.2533 16.58L22.4733 15.36Z"/>
                    </svg>
                </button>
            </form>
            <form method="POST" action="{{ route('profile.updateEmail') }}" class="profile_input manrope_medium">
                @csrf
                @method('PUT')
                <label for="number">Почта</label>
                <input id="number" type="text" placeholder="halikov20033@gmail.com" value="{{ old('email', $user->email) }}" />
                <button type="button" class="edit-btn">
                    <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="{{ asset('images/ui/rename_btn')}}">
                        <rect width="36" height="36" rx="18" fill="#EDEDED"/>
                        <path d="M20 20.6667L17.3333 23.3333H22.6667C23.4 23.3333 24 22.7333 24 22C24 21.2667 23.4 20.6667 22.6667 20.6667H20ZM18.04 14.7933L12.1933 20.64C12.0733 20.76 12 20.9333 12 21.1067V22.6667C12 23.0333 12.3 23.3333 12.6667 23.3333H14.2267C14.4067 23.3333 14.5733 23.26 14.7 23.14L20.5467 17.2933L18.04 14.7933ZM22.4733 15.36C22.5351 15.2983 22.5842 15.2251 22.6176 15.1444C22.6511 15.0638 22.6683 14.9773 22.6683 14.89C22.6683 14.8027 22.6511 14.7162 22.6176 14.6356C22.5842 14.5549 22.5351 14.4817 22.4733 14.42L20.9133 12.86C20.8517 12.7982 20.7784 12.7492 20.6978 12.7157C20.6171 12.6823 20.5306 12.665 20.4433 12.665C20.356 12.665 20.2696 12.6823 20.1889 12.7157C20.1083 12.7492 20.035 12.7982 19.9733 12.86L18.7533 14.08L21.2533 16.58L22.4733 15.36Z"/>
                    </svg>
                </button>
            </form>
            <form method="POST" action="{{ route('profile.updatePassword') }}" class="profile_input manrope_medium">
                @csrf
                @method('PUT')
                <label for="number">Пароль</label>
                <input id="number" type="text" placeholder="+7 (978) 245-04-53" value="**********" />
                <button type="button" class="edit-btn">
                    <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="{{ asset('images/ui/rename_btn')}}">
                        <rect width="36" height="36" rx="18" fill="#EDEDED"/>
                        <path d="M20 20.6667L17.3333 23.3333H22.6667C23.4 23.3333 24 22.7333 24 22C24 21.2667 23.4 20.6667 22.6667 20.6667H20ZM18.04 14.7933L12.1933 20.64C12.0733 20.76 12 20.9333 12 21.1067V22.6667C12 23.0333 12.3 23.3333 12.6667 23.3333H14.2267C14.4067 23.3333 14.5733 23.26 14.7 23.14L20.5467 17.2933L18.04 14.7933ZM22.4733 15.36C22.5351 15.2983 22.5842 15.2251 22.6176 15.1444C22.6511 15.0638 22.6683 14.9773 22.6683 14.89C22.6683 14.8027 22.6511 14.7162 22.6176 14.6356C22.5842 14.5549 22.5351 14.4817 22.4733 14.42L20.9133 12.86C20.8517 12.7982 20.7784 12.7492 20.6978 12.7157C20.6171 12.6823 20.5306 12.665 20.4433 12.665C20.356 12.665 20.2696 12.6823 20.1889 12.7157C20.1083 12.7492 20.035 12.7982 19.9733 12.86L18.7533 14.08L21.2533 16.58L22.4733 15.36Z"/>
                    </svg>
                </button>
            </form>
        </div>
        <div class="favorite_container">
            <p class="apartment_title manrope_bold">Избранное</p>
            <a  href="{{ route('compare.view') }}" class="btn_1 selected">
                <p class="text_small_bold">Сравнение</p>
            </a>
        </div>
        
        <hr>
        <div class="apartments_container">
            @foreach($favorites as $apartment)
                <div class="apartment_item">
                    <img src="{{ Storage:: url($apartment->media->path) }}" alt="" class="apartment_img">
                    <div class="apartment_data">
                        <p class="apartment_data_headline manrope_bold">{{ $typeLabels[$apartment->type] ?? $apartment->type }}</p>
                        <a href="{{ route('project', $apartment->project->id) }}">
                        <div class="apartment_project_link">
                            <p class="apartment_data_desc manrope_medium blue_text">{{ $apartment->project->name }}</p>
                            <svg width="1rem" height="1rem" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.05025 1.53553C8.03344 0.552348 9.36692 0 10.7574 0C13.6528 0 16 2.34721 16 5.24264C16 6.63308 15.4477 7.96656 14.4645 8.94975L12.4142 11L11 9.58579L13.0503 7.53553C13.6584 6.92742 14 6.10264 14 5.24264C14 3.45178 12.5482 2 10.7574 2C9.89736 2 9.07258 2.34163 8.46447 2.94975L6.41421 5L5 3.58579L7.05025 1.53553Z" fill="#007bfb"/>
                                <path d="M7.53553 13.0503L9.58579 11L11 12.4142L8.94975 14.4645C7.96656 15.4477 6.63308 16 5.24264 16C2.34721 16 0 13.6528 0 10.7574C0 9.36693 0.552347 8.03344 1.53553 7.05025L3.58579 5L5 6.41421L2.94975 8.46447C2.34163 9.07258 2 9.89736 2 10.7574C2 12.5482 3.45178 14 5.24264 14C6.10264 14 6.92742 13.6584 7.53553 13.0503Z" fill="#007bfb"/>
                                <path d="M5.70711 11.7071L11.7071 5.70711L10.2929 4.29289L4.29289 10.2929L5.70711 11.7071Z" fill="#007bfb"/>
                            </svg>
                        </div>
                        </a>
                        <div class="apartment_info_grid">
                            <div class="grid_item">
                                <span class="label manrope_bold">Площадь:</span>
                                <span class="value manrope_medium grey_text">{{ $apartment->area }} м²</span>
                            </div>
                            <div class="grid_item">
                                <span class="label manrope_bold">Этаж:</span>
                                <span class="value manrope_medium grey_text">{{ $apartment->floor }} этаж</span>
                            </div>
                        </div>

                        <button type="button" class="compare_btn form__button" data-id="{{ $apartment->id }}">
                            <p class="text_small_bold">Сравнить</p>
                        </button>

                        <div class="remove_favorite_btn form__button secondary" data-id="{{ $apartment->id }}">
                            Удалить из избранного
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div id="confirmModal" class="modal" style="display: none;">
        <div class="modal-content">
            <p>Вы действительно хотите удалить квартиру из избранного?</p>
            <div class="modal-actions">
                <button id="confirmDeleteBtn" class="confirm-btn">Удалить</button>
                <button id="cancelDeleteBtn" class="cancel-btn">Отмена</button>
            </div>
        </div>
    </div>

    <div id="popup" class="popup white_bg">
        <div class="popup__content">
            <div class="sucess_popup_data">
                <img src="{{asset('/images/ui/success_blue.svg')}}">
                <p class="popup_message manrope_regular">Вы успешно вошли в систему</p>
            </div>
            <div class="popup__progress"></div>
        </div>
    </div>

    <script>
let selectedApartmentId = null;
let selectedCard = null;

document.querySelectorAll('.remove_favorite_btn').forEach(button => {
    button.addEventListener('click', function () {
        selectedApartmentId = this.dataset.id;
        selectedCard = this.closest('.apartment_item');
        document.getElementById('confirmModal').style.display = 'flex';
    });
});

document.getElementById('cancelDeleteBtn').addEventListener('click', function () {
    document.getElementById('confirmModal').style.display = 'none';
    selectedApartmentId = null;
    selectedCard = null;
});

document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
    if (!selectedApartmentId) return;

    fetch(`/favorites/${selectedApartmentId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
        }
    })
    .then(response => {
        if (response.ok) {
            selectedCard.remove();
            document.getElementById('confirmModal').style.display = 'none';
        } else {
            alert('Ошибка при удалении');
        }
    });
});

</script>

@endsection