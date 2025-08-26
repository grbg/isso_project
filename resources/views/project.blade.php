@extends('layouts.app')

@section('page_name', 'Страничка проекта')

@section('content')
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
@vite(['resources/css/pages/project.css'])
@vite(['resources/css/dark_header.css'])
@vite(['resources/css/components/popup.css'])
@vite(['resources/js/render.js'])
@vite(['resources/js/animation.js'])
@vite(['resources/js/project_page.js'])
@vite(['resources/js/project/apartments_filter.js'])
@vite(['resources/js/project/apartment_review.js'])
@vite(['resources/js/project/swiper.js'])
@vite(['resources/js/project/plan_section.js'])
@vite(['resources/js/project/fullscreen_apartment.js'])
@vite(['resources/js/project/add_to_favorite.js'])
@vite(['resources/js/project/ymap.js'])

@if ($titleImage)
<div class="project_title_container" style="background-image: url('{{ Storage::url($titleImage->media_path) }}');">
    <p id="project_title" class="bebas_title white_text">{{ $project->name }}</p>
</div>
@endif

<div class="project_content_container white_bg">
    <div class="about_project_container ">
        <div class="about_project_text">
            <p class="about_title h1">О проекте</p>
            <div class="about_content">
                <div class="about_project_desc_container">
                    <p class="about_project_desc grey_text manrope_medium">{!! nl2br(e($project->description)) !!}</p>
                    
                    <div class="more_desc_btn btn_1 grey_bg desktop_only">
                        <p id="openModalBtn" class="manrope_bold ">Подробнее</p>
                    </div>

                    <div class="accordion_container mobile_view">
                        @if (!empty($project->infrastructures))
                        <div class="accordion_item" data-image="{{ Storage::url($project->infrastructures->media_path) }}">
                            <div class="accordion_header">
                                <p class="bebas_h2 blue_text">Инфраструктура</p>
                                <svg class="accordion_icon" width="24" height="24" viewBox="0 0 24 24">
                                    <path d="M6 9l6 6 6-6" stroke="#007BFB" stroke-width="2" fill="none"/>
                                </svg>
                            </div>
                            <div class="accordion_body">
                                <p class="manrope grey_text">{{ $project->infrastructures->text }}</p>
                            </div>            
                        </div>
                        @endif

                        @if (!empty($project->transports))
                        <div class="accordion_item" data-image="{{ Storage::url($project->transports->media_path) }}">
                            <div class="accordion_header">
                                <p class="bebas_h2 blue_text">Транспортная деятельность</p>
                                <svg class="accordion_icon" width="24" height="24" viewBox="0 0 24 24">
                                    <path d="M6 9l6 6 6-6" stroke="#007BFB" stroke-width="2" fill="none"/>
                                </svg>
                            </div>
                            <div class="accordion_body">
                                <p class="manrope grey_text">{{ $project->transports->text }}</p>
                            </div>            
                        </div>
                        @endif

                        @if (!empty($project->architectures))
                        <div class="accordion_item" data-image="{{ Storage::url($project->architectures->media_path) }}">
                            <div class="accordion_header" >
                                <p class="bebas_h2 blue_text">Архитектура</p>
                                <svg class="accordion_icon" width="24" height="24" viewBox="0 0 24 24">
                                    <path d="M6 9l6 6 6-6" stroke="#007BFB" stroke-width="2" fill="none"/>
                                </svg>
                            </div>
                            <div class="accordion_body">
                                <p class="manrope grey_text">{{ $project->architectures->text }}</p>
                            </div>            
                        </div>
                        @endif
                    </div>

                </div>
                @if ($descriptionImage)
                    <img id="accordionPreviewImg" src="{{ Storage::url($descriptionImage->media_path) }}"> 
                @endif
            </div>
        </div>
        </div>
    </div>

    <div class="about_project_container ">
        <p class="about_title h1">Особенности проекта</p>
        <div class="project_achives_container">
            <div class="project_achive">
                <div class="project_achive_title">
                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="{{ asset('images/ui/bus_icon.svg')}}">
                        <path d="M36 22H12V12H36M33 34C32.2044 34 31.4413 33.6839 30.8787 33.1213C30.3161 32.5587 30 31.7956 30 31C30 30.2044 30.3161 29.4413 30.8787 28.8787C31.4413 28.3161 32.2044 28 33 28C33.7956 28 34.5587 28.3161 35.1213 28.8787C35.6839 29.4413 36 30.2044 36 31C36 31.7956 35.6839 32.5587 35.1213 33.1213C34.5587 33.6839 33.7956 34 33 34ZM15 34C14.2044 34 13.4413 33.6839 12.8787 33.1213C12.3161 32.5587 12 31.7956 12 31C12 30.2044 12.3161 29.4413 12.8787 28.8787C13.4413 28.3161 14.2044 28 15 28C15.7956 28 16.5587 28.3161 17.1213 28.8787C17.6839 29.4413 18 30.2044 18 31C18 31.7956 17.6839 32.5587 17.1213 33.1213C16.5587 33.6839 15.7956 34 15 34ZM8 32C8 33.76 8.78 35.34 10 36.44V40C10 40.5304 10.2107 41.0391 10.5858 41.4142C10.9609 41.7893 11.4696 42 12 42H14C14.5304 42 15.0391 41.7893 15.4142 41.4142C15.7893 41.0391 16 40.5304 16 40V38H32V40C32 40.5304 32.2107 41.0391 32.5858 41.4142C32.9609 41.7893 33.4696 42 34 42H36C36.5304 42 37.0391 41.7893 37.4142 41.4142C37.7893 41.0391 38 40.5304 38 40V36.44C39.22 35.34 40 33.76 40 32V12C40 5 32.84 4 24 4C15.16 4 8 5 8 12V32Z"/>
                    </svg>
                    <p class="blue_text manrope_bold">Транспорт</p>
                </div>
                <div class="project_achive_desc manrope_medium grey_text">
                    {{ $project->transport_info }}
                </div>
            </div>
            <div class="project_achive">
                <div class="project_achive_title">
                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="{{ asset('images/ui/environment_icon.svg')}}">
                        <path d="M4 44V40C4 40 14 36 24 36C34 36 44 40 44 40V44H4ZM22.6 18.2C20.2 10.4 8 12.2 8 12.2C8 12.2 8.4 27.8 19.8 25.4C19 19.6 16 18 16 18C21.6 18 22 24.8 22 24.8V34H26V25.6C26 25.6 26 17.8 32 15.8C32 15.8 28 21.8 28 25.8C42 27.2 42 7.99998 42 7.99998C42 7.99998 24.2 5.99998 22.6 18.2Z" fill="#007BFB"/>
                    </svg>
                    <p class="blue_text manrope_bold">Окружение</p>
                </div>
                <div class="project_achive_desc manrope_medium grey_text">
                    {{ $project->environment_info }}
                </div>
            </div>
            <div class="project_achive">
                <div class="project_achive_title">
                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="{{ asset('images/ui/house_icon.svg')}}">
                        <path d="M25.4136 4.58606L43.4136 22.5861C44.6736 23.8461 43.7816 26.0001 41.9996 26.0001H39.9996V38.0001C39.9996 39.5914 39.3674 41.1175 38.2422 42.2427C37.117 43.3679 35.5909 44.0001 33.9996 44.0001H31.9996V30.0001C31.9997 28.4696 31.4149 26.997 30.365 25.8835C29.3151 24.77 27.8794 24.0998 26.3516 24.0101L25.9996 24.0001H21.9996C20.4083 24.0001 18.8822 24.6322 17.7569 25.7574C16.6317 26.8826 15.9996 28.4088 15.9996 30.0001V44.0001H13.9996C12.4083 44.0001 10.8822 43.3679 9.75695 42.2427C8.63173 41.1175 7.99959 39.5914 7.99959 38.0001V26.0001H5.99959C4.21959 26.0001 3.32559 23.8461 4.58559 22.5861L22.5856 4.58606C22.9606 4.21112 23.4693 4.00049 23.9996 4.00049C24.5299 4.00049 25.0385 4.21112 25.4136 4.58606ZM25.9996 28.0001C26.53 28.0001 27.0387 28.2108 27.4138 28.5858C27.7889 28.9609 27.9996 29.4696 27.9996 30.0001V44.0001H19.9996V30.0001C19.9997 29.5102 20.1795 29.0374 20.505 28.6713C20.8305 28.3052 21.2791 28.0714 21.7656 28.0141L21.9996 28.0001H25.9996Z" fill="#007BFB"/>
                    </svg>
                    <p class="blue_text manrope_bold">Архитектура</p>
                </div>
                <div class="project_achive_desc manrope_medium grey_text">
                    {{ $project->architecture_info }}
                </div>
            </div>
            <div class="project_achive">
                <div class="project_achive_title">
                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="{{ asset('images/ui/graduation_cap_icon.svg')}}">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.5 25.282V31.824C7.49999 32.8643 7.795 33.8832 8.35079 34.7626C8.90658 35.6419 9.70036 36.3456 10.64 36.792L20.64 41.54C21.3774 41.8903 22.1836 42.072 23 42.072C23.8164 42.072 24.6226 41.8903 25.36 41.54L35.36 36.792C36.2996 36.3456 37.0934 35.6419 37.6492 34.7626C38.205 33.8832 38.5 32.8643 38.5 31.824V25.284L25.55 31.758C24.7583 32.154 23.8852 32.3602 23 32.3602C22.1148 32.3602 21.2417 32.154 20.45 31.758L7.5 25.282Z" fill="#007BFB"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M21.7919 6.92794C22.5519 6.54794 23.4479 6.54794 24.2079 6.92794L41.5239 15.5859C43.5139 16.5799 43.5139 19.4199 41.5239 20.4159L24.2079 29.0759C23.4479 29.4559 22.5519 29.4559 21.7919 29.0759L4.4759 20.4159C2.4859 19.4199 2.4859 16.5799 4.4759 15.5859L21.7919 6.92794Z" fill="#007BFB"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M39.6599 16.3299C39.8376 15.974 40.1494 15.7033 40.5268 15.5773C40.9041 15.4512 41.316 15.4803 41.6719 15.6579L45.6719 17.6579C45.9209 17.7827 46.1303 17.9743 46.2765 18.2114C46.4228 18.4484 46.5001 18.7214 46.4999 18.9999V25.9999C46.4999 26.3978 46.3419 26.7793 46.0606 27.0606C45.7793 27.3419 45.3978 27.4999 44.9999 27.4999C44.6021 27.4999 44.2206 27.3419 43.9393 27.0606C43.658 26.7793 43.4999 26.3978 43.4999 25.9999V19.9279L40.3299 18.3419C39.974 18.1642 39.7033 17.8524 39.5773 17.4751C39.4512 17.0978 39.4823 16.6859 39.6599 16.3299Z" fill="#007BFB"/>
                    </svg>
                    <p class="blue_text manrope_bold">Инфраструктура</p>
                </div>
                <div class="project_achive_desc manrope_medium grey_text">
                    {{ $project->infrastucture_info }}
                </div>
            </div>
        </div>
    </div>

    <div class="about_project_container ">
        <div class="master_plan_title_container">
            <p class="h1">Генплан <br> проекта</p>
            <div class="master_plan_button_container">
                <div id="3d_btn" class="btn_1 grey_bg selected manrope_bold">
                    <p>3D макет</p>                
                </div>
                <div id="map_btn" class="btn_1 grey_bg black_text manrope_bold">
                    <p>Карта</p>                
                </div>
            </div>
        </div>

        <div class="project_section_container">
            <canvas id="project_section_model"></canvas>
            <div id="ymap"data-latitude="{{ $project->location->latitude}}" data-longitude="{{ $project->location->longitude}}"  class="ymap_container"></div>
            <div class="zoom_btn_container model_zoom_container">
                <div class="zoom_btn" id="zoomModelIn">
                    <svg width="30px" height="30px" viewBox="0 0 24 24"  xmlns="{{ asset('images/ui/plus.svg') }}">
                        <path d="M6 12H18M12 6V18" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                
                <div class="zoom_btn" id="zoomModelOut">
                    <svg width="30px" height="30px" viewBox="0 0 24 24"  xmlns="{{ asset('images/ui/minus.svg') }}">
                        <path d="M6 12L18 12" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>
        </div>
        
    </div>


    <div class="apartments_container">
        <div class="apartments_title_container">
            <p class="about_title h1 ">Выберите квартиру</p>
        </div>

    <div class="apartments_wrapper">
        <div class="apartments_filters white_bg">
            <div class="flat_type_filter">
                <button data-type="" class="filter_button active">
                    <span class="label manrope_bold">Все</span>
                    <span class="fill"></span>
                </button>
                <button data-type="1_room" class="filter_button">
                    <span class="label manrope_bold">1</span>
                    <span class="fill"></span>
                </button>
                <button data-type="2_room" class="filter_button">
                    <span class="label manrope_bold">2</span>
                    <span class="fill"></span>
                </button>
                <button data-type="3_room" class="filter_button">
                    <span class="label manrope_bold">3</span>
                    <span class="fill"></span>
                </button>
                <button data-type="studio" class="filter_button">
                    <span class="label manrope_bold">Студия</span>
                    <span class="fill"></span>
                </button>
            </div>

            <div class="apartments_list">
            </div>
        </div>

        <div class="apartments_preview white_bg">
            <div class="apartments_preview_img">
                <img src="" alt="Квартира">
                <div class="fullscreen_btn grey_bg">
                    <svg width="24px" height="24px" viewBox="0 0 24 24" xmlns="{{ asset('images/ui/fullscreen.svg') }}"><path fill-rule="evenodd" clip-rule="evenodd" d="M18 4.654v.291a10 10 0 0 0-1.763 1.404l-2.944 2.944a1 1 0 0 0 1.414 1.414l2.933-2.932A9.995 9.995 0 0 0 19.05 6h.296l-.09.39A9.998 9.998 0 0 0 19 8.64v.857a1 1 0 1 0 2 0V4.503a1.5 1.5 0 0 0-1.5-1.5L14.5 3a1 1 0 1 0 0 2h.861a10 10 0 0 0 2.249-.256l.39-.09zM4.95 18a10 10 0 0 1 1.41-1.775l2.933-2.932a1 1 0 0 1 1.414 1.414l-2.944 2.944A9.998 9.998 0 0 1 6 19.055v.291l.39-.09A9.998 9.998 0 0 1 8.64 19H9.5a1 1 0 1 1 0 2l-5-.003a1.5 1.5 0 0 1-1.5-1.5V14.5a1 1 0 1 1 2 0v.861a10 10 0 0 1-.256 2.249l-.09.39h.295z"/></svg>
                </div>
            </div>
            <div class="apartments_preview_stats">
                    <div class="preview_project_stats_item">
                        <p class="manrope_regular grey_text">Название проекта</p>
                        <p id="apartmentPreviewProjName" class="manrope_bold">{{ $project->name }}</p>
                    </div>
                    <div class="preview_project_stats_item">
                        <p class="manrope_regular grey_text">Площадь</p>
                        <p id="apartmentPreviewArea" class="manrope_bold">Название проекта м²</p>
                    </div>
                    <div class="preview_project_stats_item">
                        <p class="manrope_regular grey_text">Этаж</p>
                        <p id="apartmentPreviewFloor" class="manrope_bold">Название проекта</p>
                    </div>
            </div>
            @auth
            <button id="add_favorite_btn" class="add_apartment_container heart_button blue_bg white_text">
                    <p class="manrope_bold">Добавить в избранное</p>
                    <svg width="36" height="36" viewBox="0 0 36 36"  xmlns="{{ asset('images/ui/heart.svg') }}">
                        <path d="M11.3334 16.0913C11.3334 19.3333 14.0134 21.0607 15.9747 22.6073C16.6667 23.1527 17.3334 23.6667 18 23.6667C18.6667 23.6667 19.3334 23.1533 20.0254 22.6067C21.9874 21.0613 24.6667 19.3333 24.6667 16.092C24.6667 12.8507 21 10.55 18 13.6673C15 10.55 11.3334 12.8493 11.3334 16.0913Z" fill="#ffffff"/>
                    </svg>
            </button>  
            @endauth
        </div>
    </div>
</div>


<div class="more_info_modal_container desktop_only">
    <div class="more_info_modal_wrapper">
        <div class="more_info_btn_container">
            <div class="btn_1 more_info_btn selected" data-category="location">
                <p class="manrope_medium">Инфраструктура</p>
            </div>
            <div class="btn_1 more_info_btn white_bg" data-category="transport">
                <p class="manrope_medium">Транспортная деятельность</p>
            </div>
            <div class="btn_1 more_info_btn white_bg" data-category="architecture">
                <p class="manrope_medium">Архитектура</p>
            </div>
            <div class="btn_1 more_info_btn white_bg" data-category="family">
                <p class="manrope_medium">Для семей</p>
            </div>
        </div>

        <div class="more_info_content_container">
            @if (!empty($project->infrastructures))
            <div class="more_info_content" id="location_content" style="display: block;">
                <p class="h1 blue_text">Инфраструктура</p>
                <div class="more_info_content_desc grey_text">
                    <p class="manrope_medium">{{ $project->infrastructures->text }}</p>
                    <div class="more_info_img" style="background-image: url('{{ Storage::url($project->infrastructures->media_path) }}')"  ></div>
                </div>
            </div>
            @endif

            @if (!empty($project->transports))
            <div class="more_info_content" id="transport_content" style="display: none;">
                <p class="h1 blue_text">Транспортная деятельность</p>
                <div class="more_info_content_desc grey_text">
                    <p class="manrope_medium">{{ $project->transports->text }}</p>
                    <div class="more_info_img" style="background-image: url('{{ Storage::url($project->transports->media_path) }}')"  ></div>
                </div>
            </div>
            @endif

            @if (!empty($project->architectures))
            <div class="more_info_content" id="architecture_content" style="display: none;">
                <p class="h1 blue_text">Архитектура</p>
                <div class="more_info_content_desc grey_text">
                    <p class="manrope_medium">{{ $project->architectures->text }}</p>
                    <div class="more_info_img" style="background-image: url('{{ Storage::url($project->architectures->media_path) }}')"  ></div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <div class="fullscreen_apartment_container" style="display: none;">
        <svg class="close_modal_btn" width="62" height="62" viewBox="0 0 62 62" fill="none" xmlns="{{ asset('images/ui/cross_btn.svg') }}">
            <circle cx="31" cy="31" r="31" fill="white"/>
            <path d="M36.3327 36.3333L30.9994 31M30.9994 31L25.666 25.6667M30.9994 31L36.3327 25.6667M30.9994 31L25.666 36.3334" stroke="#007BFB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>

        <div class="fullscreen_apartment_content">
            <p class="h1 blue_text">Квартира</p>

            <div  id="imageWrapper" class="fullscreen_apartment_image zoomable_container">
                <img id="zoomableImage"  src="" alt="Квартира в полном размере">
            </div>

            <div class="fullscreen_apartment_stats">
                <div class="preview_project_stats_item">
                    <p class="manrope_regular grey_text">Название проекта</p>
                    <p class="manrope_bold" data-fs-project>—</p>
                </div>
                <div class="preview_project_stats_item">
                    <p class="manrope_regular grey_text">Площадь</p>
                    <p class="manrope_bold" data-fs-area>— м²</p>
                </div>
                <div class="preview_project_stats_item">
                    <p class="manrope_regular grey_text">Этаж</p>
                    <p class="manrope_bold" data-fs-floor>—</p>
                </div>
            </div>

            <div class="zoom_btn_container">
                <div class="zoom_btn" id="zoomInBtn">
                    <svg width="30px" height="30px" viewBox="0 0 24 24"  xmlns="{{ asset('images/ui/plus.svg') }}">
                        <path d="M6 12H18M12 6V18" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                
                <div class="zoom_btn" id="zoomOutBtn">
                    <svg width="30px" height="30px" viewBox="0 0 24 24"  xmlns="{{ asset('images/ui/minus.svg') }}">
                        <path d="M6 12L18 12" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal_overlay"></div>

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
            <p class="popup_message manrope_regular">Вы успешно вошли в систему</p>
        </div>
        <div class="popup__progress"></div>
    </div>
</div>

@endsection