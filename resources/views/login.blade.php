<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мониторинг питания</title>
    {{--    <link rel="stylesheet" href="{{ asset('css/main.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('/favicon.png') }}"/>
</head>
<body class="login-body">
<div class="login-form-wrapper">

    <form class="login-form" action="/login" method="POST">
        @csrf

        <h2>Авторизация</h2>

        <section>
            <label for="name">
                Логин:
            </label>
            <input type="text" name="name" placeholder="Логин" id="name">

            <label for="password">
                Пароль:
            </label>
            <input type="password" name="password" placeholder="Пароль" id="password">

            <div class="remember-me__wrapper">
                <input type="checkbox" name="rememberMe" id="rememberMe">
                <label for="rememberMe">
                    Запомнить меня
                </label>
            </div>

            <input type="submit" value="Войти">
        </section>
    </form>
</div>
</body>
</html>
