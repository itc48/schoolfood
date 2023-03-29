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
<div id="app"></div>
</body>
</html>

<script src="{{ asset('js/printf.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script>

</script>
