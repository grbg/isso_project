@vite(['resources/css/header.css'])
@vite(['resources/css/buttons.css'])
@vite(['resources/js/nav_load_anim.js'])
@vite(['resources/js/header_menu.js'])

<script src="https://api-maps.yandex.ru/2.1/?apikey=ВАШ_КЛЮЧ&lang=ru_RU"></script>
<div class="navigation_container">
    <div class="navigation">
        <a href="{{ route('home') }}">
        <div class="logo bebas">
            <p>ИССО</p>
        </div>
        </a>

        <ul class="nav_links">
            <li class="nav_link manrope_bold quick-flip"><a href="{{ route('all_project') }}">Недвижимость</a></li>
            <li class="nav_link manrope_bold quick-flip"><a href="">О компании</a></li>
            <li class="nav_link manrope_bold quick-flip"><a href="">Контакты</a></li>
        </ul>

        <div class="account_container">
            <div class="phone_container">
                <p class="number text-md-16">8 365 695-74-69</p>
                <p class="number_desc text-md-16">Ежедневно с 9:00 до 21:00</p>
            </div>

            @auth
            <div class="account_icons_container user_info" id="userInfo">
                <img src="{{ asset('images/ui/default_avatar.svg') }}" alt="Avatar" class="avatar" />
                <!-- <div class="user_details">
                    <p class="user_name manrope_bold">{{ Auth::user()->name }}</p>
                </div> -->
            </div>  
            @else
            <div class="account_icons_container">
                <a href="{{ route('auth.toggle') }}" class="login_btn">
                    <p class="button-bold-16">Войти</p>
                    <img src="{{ asset('images/ui/login.svg') }}">
                </a>
            </div>
            @endauth
        </div>

        <div class="burger_icon" id="burgerIcon">
            <span></span>
            <span></span>
            <span></span>
        </div>

    </div>
    
    @auth
    <div class="user_menu" id="userMenu">
        <div class="user_details">
            <p class="user_mail text-md-16">{{ Auth::user()->email }}</p>
            <img src="{{ asset('images/ui/default_avatar.svg') }}" alt="Avatar" class="avatar" />
            <div class="user_info_menu">
                <p class="user_name text-bold-16">Здравствуй, {{ Auth::user()->name }}</p>
                
            </div>
        </div>
        <a href="{{ route('profile') }}" class="menu_item manrope_bold">Профиль</a>
        @if(auth()->user()->role === 'admin')
        <a href="{{ url('/admin') }}" class="menu_item manrope_bold">Админ-панель</a>
        @endif
        <a href="{{ route('logout') }}" class="menu_item logout_btn manrope_bold">Выйти</a>
    </div>
    @endauth

    <div class="burger_menu">
        <div class="close_btn" id="burgerCloseBtn">
            &#10005;
        </div>

        <ul class="nav_links_mobile">
            <li class="mobile_nav manrope"><a href="">Недвижимость</a></li>
            <li class="mobile_nav manrope"><a href="">О компании</a></li>
            <li class="mobile_nav manrope"><a href="">Контакты</a></li>
        </ul>

        <div class="account_mobile_container">
            <a href="{{ route('auth.toggle') }}" class="mobile_login_btn">
                <p class="button-bold-16">Войти</p>
                <img src="{{ asset('images/ui/login.svg') }}">
            </a>
        </div>
    </div>
</div>

