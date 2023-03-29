@extends('layouts.admin')

@section('content')

    <section class="sidebar-wrapper">
        <div class="title-wrapper">
            <h1 class="title">Входы пользователей за последние сутки</h1>
        </div>
        <div class="filters-wrapper" id="filters-wrapper">
            <div class="filter-dashboard">
                <p class="filter-dashboard-number">
                    {{ count($unique) }}
                </p>
                <p class="filter-dashboard-text">
                    Уникальных входов
                </p>
            </div>
        </div>
        <form class="filters-wrapper" id="filters-wrapper" action="logins/export" method="GET">
            <label for="date_from">
                <span>
                    От:
                </span>
                <input type="date" name="date_from" id="date_from">
            </label>
            <label for="date_to">
                <span>
                    До:
                </span>
                <input type="date" name="date_to" id="date_to">
            </label>
            <input type="submit" value="Скачать входы" class="addschool-button">
        </form>
    </section>

    <section class="table-wrapper">
        <div class="district-table">
            <ul class="district-table-header-row">
                <li>
                    Школа
                </li>
                <li>
                    Дата
                </li>
                <li>
                    Время
                </li>
                <li>
                    #
                </li>
            </ul>
            @foreach($users_logins as $login)
                <ul class="district-table-row">
                    <li>
                        {{ $login->user->school->title ?? '-' }}
                    </li>
                    <li>
                        {{ $login->created_at['date'] }}
                    </li>
                    <li>
                        {{ $login->created_at['time'] }}
                    </li>
                    <li>
                        {{ $login->id }}
                    </li>
                </ul>
            @endforeach
        </div>
    </section>

@endsection
