@php
    $typeLabels = [
        'studio' => 'студий',
        '1_room' => '1-км квартира',
        '2_room' => '2-км квартира',
        '3_room' => '3-км квартира',
    ];
@endphp

@foreach($projects as $project)
    <div class="project_item">
        <div class="project_item_img">
            <img src="{{ Storage:: url($project->titleImage?->media_path) }}"
                alt="{{ $project->name }}">
        </div>
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
