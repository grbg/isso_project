@extends('layouts.app')

@section('page_name', 'Список проектов')
@vite(['resources/css/pages/project_list.css'])
@vite(['resources/js/all_projects/project_filtration.js'])
@vite(['resources/js/filters.js'])
@vite(['resources/js/all_projects/drop_down_city.js'])
@vite(['resources/js/all_projects/apartment_review.js'])
@section('content')

@php
    $typeLabels = [
        'studio' => 'студий',
        '1_room' => '1-км квартира',
        '2_room' => '2-км квартира',
        '3_room' => '3-км квартира',
    ];
@endphp

<div class="all_projects_wrapper">
    <h1 class="h1">Наши проекты</h1>
    
    
    <div class="project_filter_container">
        @if ($cities->isNotEmpty())
        <div class="custom_dropdown" id="cityDropdown">
            <div class="dropdown_selected manrope_medium" id="selectedCity">
                Все
                <span class="dropdown_arrow">&#9662;</span> {{-- ▼ вниз --}}
            </div>
            <ul class="dropdown_list">
                    <li class="manrope_medium" data-value="">Все</li>
                @foreach ($cities as $city)
                    <li class="manrope_medium" data-value="{{ $city }}">{{ $city }}</li>
                @endforeach
            </ul>
            <input type="hidden" name="city" id="cityInput" value="{{ $cities[0] }}">
        </div>
        @endif

        {{-- Фильтр по типу квартиры --}}
        <div class="flat_type_filter">
            <button data-type="" class="filter_button active">
                <span class="label manrope_bold">Все</span>
                <span class="fill"></span>
            </button>
            <button data-type="1_room" class="filter_button">
                <span class="label manrope_bold">1-комн</span>
                <span class="fill"></span>
            </button>
            <button data-type="2_room" class="filter_button">
                <span class="label manrope_bold">2-комн</span>
                <span class="fill"></span>
            </button>
            <button data-type="3_room" class="filter_button">
                <span class="label manrope_bold">3-комн</span>
                <span class="fill"></span>
            </button>
            <button data-type="studio" class="filter_button">
                <span class="label manrope_bold">Студия</span>
                <span class="fill"></span>
            </button>
        </div>

    </div>

    <div class="project_list_container">
        @foreach($projects as $project)
        <div class="project_item">
            <a href="{{ route('project', $project->id) }}" class="project_item_img">
                <img src="{{ Storage:: url($project->titleImage?->media_path) }}"
                alt="{{ $project->name }}">
            </a>
            <div class="project_item_data">
                <p class="project_item_name manrope_bold">{{ $project->name }}</p>
                <p class="project_item_location manrope_medium">
                    {{ $project->location->city ?? 'Город не указан' }},
                    {{ $project->location->street ?? 'Адрес не указан' }}
                </p>

                <div class="apartment_types">
                    <div class="apartment_summary">
                        <p class="manrope_regular">Найдено {{ $project->totalApartments }} квартир</p>
                    </div>
                    @foreach ($project->apartmentStats as $type => $stats)
                        <div class="apartment_type_item">
                            <p class="manrope_regular blue_text">{{ $typeLabels[$type] ?? $type }}</p>
                            <p class="manrope_regular grey_text">от {{ $stats['avg_area'] }} м²</p>
                            <p class="manrope_regular">{{ $stats['count'] }} квартиры</p>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
        @endforeach
    </div>
</div>
@endsection