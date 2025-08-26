@extends('layouts.app')

@section('page_name', 'Список проектов')
@vite(['resources/css/pages/auth.css'])
@vite(['resources/js/auth/validation.js'])
@vite(['resources/js/auth/toggle_btn.js'])

@section('content')
<div class="form_wrapper">
<div class="form__container">
    <div id="register_form_container">
        <div class="formIcon__container">
            <svg height="2rem" width="2rem" version="1.1" id="Capa_1" 
	            viewBox="0 0 377.341 377.341" xml:space="preserve">
                <g>
                	<g>
                		<path style="fill:#010002;" d="M200.631,236.439c-6.353,6.358-6.358,16.709,0,23.094c3.079,3.079,7.174,4.776,11.536,4.776
                			s8.452-1.692,11.547-4.776l59.362-59.346c1.474-1.507,2.643-3.263,3.519-5.347c0.805-1.996,1.218-4.063,1.218-6.168
                			c0-2.105-0.408-4.172-1.273-6.315c-0.843-1.985-2.023-3.742-3.514-5.227l-59.313-59.313c-3.079-3.084-7.18-4.781-11.547-4.781
                			c-4.368,0-8.469,1.702-11.536,4.781c-6.364,6.364-6.364,16.72,0,23.083l31.449,31.449H16.317C7.321,172.35,0,179.677,0,188.668
                			s7.321,16.317,16.317,16.317h215.762L200.631,236.439z"/>
                		<path style="fill:#010002;" d="M322.95,42.531H139.452c-30.002,0-54.402,24.4-54.402,54.391l0.033,57.698h3.263
                			c2.986,3.987,7.74,6.587,13.032,6.587c5.45,0,10.231-2.605,13.184-6.668l3.138-0.044V96.921c0-11.982,9.758-21.74,21.751-21.74
                			H322.95c11.988,0,21.751,9.758,21.751,21.74v183.503c0,11.993-9.763,21.74-21.751,21.74H139.452
                			c-11.993,0-21.751-9.747-21.751-21.74l-0.027-57.725H114.4c-2.986-3.981-7.74-6.57-13.027-6.57
                			c-5.325,0-10.106,2.627-13.086,6.663l-3.242,0.049v57.583c0,29.986,24.4,54.385,54.402,54.385H322.95
                			c29.996,0,54.391-24.4,54.391-54.385V96.921C377.341,66.93,352.946,42.531,322.95,42.531z"/>
                	</g>
                </g>
            </svg>
        </div>
        <h1 class="h2 form__headline">Создание аккаунта</h1>
        <p class="text_small form__subtitle">Зарегистрируйтесь, чтобы получить новые возможности для взаимодействия с объектами</p>
        <form class="form" method="POST" action="{{ route('register') }}" id="registerForm">
            @csrf
            <div class="__input text_small">
                <label class="text_small_bold" for="name">Имя</label>
                <input id="name" type="text" name="name" placeholder="Ваше имя"  />
                <div class="error-message"></div>
            </div>

            <div class="__input text_small">
                <label class="text_small_bold" for="email">Email</label>
                <input id="email" name="email" placeholder="example@mail.com"  />
                <div class="error-message"></div>
            </div>

            <div class="__input text_small">
                <label class="text_small_bold" for="phone">Телефон</label>
                <input id="phone" type="text" name="phone" placeholder="+7 (978) 245 04 53"  />
                <div class="error-message"></div>
            </div>

            <div class="__input text_small">
                <label class="text_small_bold" for="password">Пароль</label>
                <input id="password" type="password" name="password" placeholder="Пароль"  />
                <div class="error-message"></div>
            </div>

            <div class="__input text_small">
                <label class="text_small_bold" for="password_confirmation">Подтверждение пароля</label>
                <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Подтвердите пароль"  />
                <div class="error-message"></div>
            </div>

            <button type="submit" class="reg_btn btn_1">Зарегистрироваться</button>
        </form>
    </div>

    <div class="hidden" id="login_form_container">
        <div class="formIcon__container">
            <svg height="2rem" width="2rem" version="1.1" id="Capa_1" 
	            viewBox="0 0 377.341 377.341" xml:space="preserve">
                <g>
                	<g>
                		<path style="fill:#010002;" d="M200.631,236.439c-6.353,6.358-6.358,16.709,0,23.094c3.079,3.079,7.174,4.776,11.536,4.776
                			s8.452-1.692,11.547-4.776l59.362-59.346c1.474-1.507,2.643-3.263,3.519-5.347c0.805-1.996,1.218-4.063,1.218-6.168
                			c0-2.105-0.408-4.172-1.273-6.315c-0.843-1.985-2.023-3.742-3.514-5.227l-59.313-59.313c-3.079-3.084-7.18-4.781-11.547-4.781
                			c-4.368,0-8.469,1.702-11.536,4.781c-6.364,6.364-6.364,16.72,0,23.083l31.449,31.449H16.317C7.321,172.35,0,179.677,0,188.668
                			s7.321,16.317,16.317,16.317h215.762L200.631,236.439z"/>
                		<path style="fill:#010002;" d="M322.95,42.531H139.452c-30.002,0-54.402,24.4-54.402,54.391l0.033,57.698h3.263
                			c2.986,3.987,7.74,6.587,13.032,6.587c5.45,0,10.231-2.605,13.184-6.668l3.138-0.044V96.921c0-11.982,9.758-21.74,21.751-21.74
                			H322.95c11.988,0,21.751,9.758,21.751,21.74v183.503c0,11.993-9.763,21.74-21.751,21.74H139.452
                			c-11.993,0-21.751-9.747-21.751-21.74l-0.027-57.725H114.4c-2.986-3.981-7.74-6.57-13.027-6.57
                			c-5.325,0-10.106,2.627-13.086,6.663l-3.242,0.049v57.583c0,29.986,24.4,54.385,54.402,54.385H322.95
                			c29.996,0,54.391-24.4,54.391-54.385V96.921C377.341,66.93,352.946,42.531,322.95,42.531z"/>
                	</g>
                </g>
            </svg>
        </div>
        <h1 class="h2 form__headline">Авторизация</h1>
        <form class="form" method="POST" action="{{ route('login') }}" id="loginForm">
            @csrf

            <div class="__input text_small">
                <label class="text_small_bold" for="login_email">Email</label>
                <input id="login_email" name="email" placeholder="example@mail.com"  />
                <div class="error-message"></div>
            </div>

            <div class="__input text_small">
                <label class="text_small_bold" for="login_password">Пароль</label>
                <input id="login_password" type="password" name="password" placeholder="Пароль"  />
                <div class="error-message"></div>
            </div>

            <button type="submit" class="blue_bg manrope_medium">Войти</button>
        </form>
    </div>

    <div class="hidden" id="verification_notice">
        <div class="formIcon__container">
            <img src="{{ asset('images/ui/email_black.svg')}}">
        </div>
        <h1 class="h2 form__headline">Письмо отправлено</h1>
        <p class="text_small">
            Мы отправили письмо с подтверждением на ваш email. Пожалуйста, перейдите по ссылке, чтобы активировать аккаунт.
        </p>
        <p class="text_small">
            После подтверждения вы будете автоматически авторизованы и перенаправлены на главную страницу.
        </p>
    </div>

    <p class="switch_link">Уже есть аккаунт? <span class="link" id="toggleBtn">Войти</span></p>
</div>
</div>
@endsection
