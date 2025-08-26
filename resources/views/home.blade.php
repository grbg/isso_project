@extends('layouts.app')

@section('page_name', 'Главная')

@section('content') 
@vite(['resources/css/components/cards.css'])
@vite(['resources/css/pages/home.css'])
@vite(['resources/js/home_load_anim.js'])
    <div class="home_wrapper">
        <div class="about_container _container">
            <img class="about_bg" src="https://images.unsplash.com/photo-1748273491101-9d1db5d1814d?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">
            <div class="title_headline_container">
                <p class="title_headline bebas_title">Создаём современное пространство для жизни</p>
            </div>
           <div class="title_desc_container desktop_only">
                <p class="title_desc text-md-16">Мы объединяем передовые технологии, современные архитектурные решения и высокие стандарты качества, чтобы создавать пространства, в которых люди чувствуют себя 
                уютно и безопасно.</p>
           </div>
        </div>

        <div class="about_wrapper">
            <div class="manrope about_description">
                <p class="about_item">
                    Мы объединяем передовые технологии, современные архитектурные решения и
                    высокие стандарты качества.
                </p>
            </div>
        </div>

        <div class="achives_wrapper">
            <div class="achives_container">
                <div class="achive">
                    <img src="{{ asset('images/shape_1.png')}}">
                    <p class="achive_headline h1"><span id="yearCount"></span> лет</p>
                    <p class="manrope_medium achive_desc">Мы знаем регион, его климат и 
                        особенности строительства, поэтому создаём дома, 
                        которые прослужат десятилетия.</p>
                </div>
                <div class="achive">
                    <img src="{{ asset('images/shape_2.png')}}">
                    <p class="achive_headline h1"><span id="squareCount"></span></p>
                    <p class="manrope_medium achive_desc">Квадратных метров жилья 
                        было введено в эксплуатацию с 2014 года. 
                        Современные жилые комплексы в Крыму и Севастополе, 
                        созданные для комфортной жизни.</p>
                </div>
                <div class="achive">
                    <img src="{{ asset('images/shape_3.png')}}">
                    <p class="achive_headline h1"><span id="procentCount"></span>%</p>
                    <p class="manrope_medium achive_desc">Чёткое планирование и 
                        контроль на всех этапах строительства позволяют нам выполнять 
                        обязательства перед клиентами.</p>
                </div>
            </div>
        </div>

        <div class="projects_wrapper">
            
            <div class="projects_title h1">
                <div class="project_headline_container">
                <div class="headline_wrapper">
                    <p class="h1">Наши проекты</p>
                </div>
                <div class="project_city_selector">
                    <ul class="city_selector_list">
                      <li class="quick-flip"><a href="#">Евпатория</a></li>
                      <li class="quick-flip"><a href="#">Севастополь</a></li>
                      <li class="quick-flip"><a href="#">Симферополь</a></li>
                    </ul>
                </div>

                </div>
            </div>

            <div class="projects_container">
                @foreach($projects as $project)
                <div class="project">    
                    <div style="background-image: url({{ Storage:: url($project->titleImage->media_path) }})" class="project_img_wrapper"></div>
                    <div class="project_desc_container">
                        <div class="project_text_data_container">
                            <p class="project_name text-bold-16">{{ $project->name }}</p>
                            <div class="project_location_container">
                                <svg width="1.25rem" height="1.25rem" viewBox="0 0 24 24" fill="none"><path stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 10c0 3.976-7 11-7 11s-7-7.024-7-11 3.134-7 7-7 7 3.024 7 7z"/><circle cx="12" cy="10" r="3" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
                                <p class="project_desc text-md-16">
                                    {{ $project->location->city ?? 'Город не указан' }},
                                    {{ $project->location->street ?? '' }}
                                    {{ $project->location->house ?? '' }}
                                </p>
                            </div>
                        </div>
                        <a href="{{ route('project', $project->id) }}">
                            <div class="arrow_icon_btn">
                                <svg width="22" height="21" viewBox="0 0 22 21" fill="none" xmlns="{{ asset('images/ui/arrow.svg')}}">
                                    <path d="M14.6504 11.375L3.99988 11.375V9.62502L14.6504 9.62502L9.95688 4.93152L11.1941 3.69427L17.9999 10.5L11.1941 17.3058L9.95688 16.0685L14.6504 11.375Z" fill="white"/>
                                </svg> 
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            
            <a href="{{ route('all_project') }}" class="arrow_button blue_bg">
                <p class="manrope_bold white_text">Все проекты</p>
                <svg width="22" height="21" viewBox="0 0 22 21" fill="none" xmlns="{{ asset('images/ui/arrow.svg')}}">
                    <path d="M14.6504 11.375L3.99988 11.375V9.62502L14.6504 9.62502L9.95688 4.93152L11.1941 3.69427L17.9999 10.5L11.1941 17.3058L9.95688 16.0685L14.6504 11.375Z" fill="white"/>
                </svg>  
            </a>
        </div>

        <div class="news_section">
            <div class="news_title h1">
                <p class="h1" >Новости</p>
            </div>

            <div class="news_container">
                @foreach($news as $news_item)
                <div class="news_card">
                    <div style="background-image: url({{ Storage::url($news_item->media->media_path) }})" class="news_img_wrapper"></div>
                    <p class="news__date text-md-16">{{  $news_item->formatted_date }}</p>
                    <div class="news_data">
                        <div class="news_name_container list__item">
                            <p class="news_name manrope_h3">{{ $news_item->title}}</p>
                        </div>
                        <a class="list__item" href="{{ route('news' , $news_item->id) }}">
                            <div class="arrow_icon_btn">
                            <svg width="22" height="21" viewBox="0 0 22 21" fill="none" xmlns="{{ asset('images/ui/arrow.svg')}}">
                                <path d="M14.6504 11.375L3.99988 11.375V9.62502L14.6504 9.62502L9.95688 4.93152L11.1941 3.69427L17.9999 10.5L11.1941 17.3058L9.95688 16.0685L14.6504 11.375Z" fill="white"/>
                            </svg> 
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="arrow_button blue_bg">
                <p class="manrope_bold white_text">Все новости</p>
                <svg width="22" height="21" viewBox="0 0 22 21" fill="none" xmlns="{{ asset('images/ui/arrow.svg')}}">
                    <path d="M14.6504 11.375L3.99988 11.375V9.62502L14.6504 9.62502L9.95688 4.93152L11.1941 3.69427L17.9999 10.5L11.1941 17.3058L9.95688 16.0685L14.6504 11.375Z" fill="white"/>
                </svg>  
            </div>
        </div>

        <div class="office_data_container">
        <div class="office_data">
            <p class="contacts_headline h1">Контактная информация</p>
            
            <div class="office_data_wrapper">
                <div class="office_address_container">
                    <p class="office_headline manrope_h3">Наш адрес</p>
                    <p class="office_address_data text-bold-24">297420, Республика Крым, <br>город Евпатория, ул. Чапаева, д. 47 </p>
                </div>

                <div class="office_address_container">
                    <p class="office_headline manrope_h3">Связаться</p>
                    <p class="office_address_data text-bold-24">isso14@mail.ru</p>
                    <p class="office_address_data text-bold-24">+7 (978) 710-60-80</p>
                </div>
            </div>
        </div>
        <div id="ymap" class="office_map_container" data-latitude="45.20930608647298" data-longitude="33.35244889814757">

        </div>
    </div>
    </div>

    @if(session('success'))
    <div id="popup" class="popup white_bg">
        <div class="popup__content">
            <div class="sucess_popup_data">
                <svg height="20xp" width="20px" fill="#007BFB" version="1.1" id="Layer_1" xmlns="{{ asset('images/ui/success.svg') }}" 
                viewBox="0 0 511.755 511.755" xml:space="preserve">
                <g>
            	    <g>
            		    <path d="M436.891,74.867c-99.819-99.819-262.208-99.819-362.027,0c-99.819,99.797-99.819,262.229,0,362.027
            			    c49.899,49.92,115.456,74.859,181.013,74.859s131.093-24.939,181.013-74.859C536.709,337.096,536.709,174.664,436.891,74.867z
            			    M398.96,185.629L249.627,334.963c-4.16,4.16-9.621,6.251-15.083,6.251c-5.461,0-10.923-2.091-15.083-6.251l-85.333-85.333
            			    c-8.341-8.341-8.341-21.824,0-30.165c8.341-8.341,21.824-8.341,30.165,0l70.251,70.251l134.251-134.251
            			    c8.341-8.341,21.824-8.341,30.165,0C407.301,163.805,407.301,177.288,398.96,185.629z"/>
            	    </g>
                </g>
                </svg>
                <p class="manrope_regular">Вы успешно вошли в систему</p>
            </div>
            <div class="popup__progress"></div>
        </div>
    </div>
    @endif

</script>
@endsection
