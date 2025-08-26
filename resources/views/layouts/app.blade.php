<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        @vite(['resources/css/fonts.css'])
        @vite(['resources/css/colors.css'])
        @vite(['resources/css/app.css']) 
    <style>
    </style>        
</head>
<body>
    @include('components.header')

    <main>
        @yield('content')
    </main>
    
    @include('components.footer')

</body>
</html>