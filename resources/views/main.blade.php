<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Мониторинг питания</title>

    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" href="{{ asset('/favicon.png') }}"/>
</head>
<body>
<section class="main__page">
    <h1>
        Оставить отзыв об обеде
    </h1>
    <img src="{{ asset('media/img/backgroundimages/onsoup_rating.svg') }}" alt="">
    <a href="https://dewiar.com/scan">
        Сканировать новый QR-код
    </a>
</section>
</body>
</html>
