@vite(['resources/css/footer.css'])
@vite(['resources/css/buttons.css'])
@vite(['resources/css/fonts.css'])
@vite(['resources/js/project/ymap.js'])

<footer class="footer_wrapper">

    <div class="footer_container">
        <div class="footer_address_container">
            <p class="footer_logo bebas">ИССО</p>
            <p class="footer_address_data text-md-16">297420, Республика Крым, <br>город Евпатория, ул. Чапаева, д. 47 </p>
        </div>

        <div class="footer_navigation">
            <a class="text-bold-16 footer_nav_link" href="{{ route('all_project') }}">Недвижимость</a>
            <a class="text-bold-16 footer_nav_link" href="">О компании</a>
            <a class="text-bold-16 footer_nav_link" href="">Контакты</a>
        </div>

        <div class="footer_contact_container">
            <p class="footer_contact_data text-bold-24 manrope">isso14@mail.ru</p>
            <p class="footer_contact_data text-bold-24 manrope">+7 (978) 710-60-80</p>
        </div>
    </div>
</footer>