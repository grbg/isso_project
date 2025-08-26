@extends('layouts.app')

@section('page_name', 'Главная')

@section('content')
@vite(['resources/css/pages/news.css'])
    <div class="news_container">
        <img src="{{ Storage::url( $news->media->media_path )}}">
        <p class="news_title bebas_h1">{{ $news->title}}</p>
        <p class="news_text manrope_medium grey_text">{!! nl2br(e($news->text)) !!}</p>
    </div>
@endsection