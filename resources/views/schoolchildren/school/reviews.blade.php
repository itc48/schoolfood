@extends('layouts.schoolchildren')

@section('content')

    <section class="sidebar-wrapper">
        <div class="title-wrapper">
            <a href="/schoolchildren/schools" class="back-to-school-button"> {{-- исправил кнопку назад 25.02.2022 --}}
                <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M20.3853 11H8.18525L13.7853 5.4L12.3853 4L4.38525 12L12.3853 20L13.7853 18.6L8.18525 13H20.3853V11Z"/>
                </svg>
            </a>
            <h1 class="title">
                {{ $school->title }}
            </h1>
        </div>
        <div class="filters-wrapper" id="filters-wrapper">
            <div class="filter-dashboard">
                <p class="filter-dashboard-number">
                    {{ count($school->reviews) }}
                </p>
                <p class="filter-dashboard-text">
                    Всего проголосовало
                </p>
            </div>

            <div class="filter-dashboard">
                <p class="filter-dashboard-number">
                    {{ $school->reviewsSum() }}
                </p>
                <p class="filter-dashboard-text">
                    Рейтинг школы
                </p>
            </div>
        </div>
    </section>

    <section class="tools-wrapper">
    <a href="{{route('qr-generate',['uid' => $school->uuid])}}" class="qr-button-action" target="_blank">
            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="9.47803" y="9.22656" width="1.76314" height="1.73698" fill="#868E96"/>
                <rect x="11.2412" y="10.9635" width="1.76314" height="1.73698" fill="#868E96"/>
                <rect x="13.0044" y="9.22656" width="1.76314" height="1.73698" fill="#868E96"/>
                <rect x="14.7676" y="10.9635" width="1.76314" height="1.73698" fill="#868E96"/>
                <rect x="13.1538" y="14.7631" width="1.76314" height="1.73698" fill="#868E96"/>
                <rect x="9.47803" y="12.7006" width="1.76314" height="1.73698" fill="#868E96"/>
                <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M1.71891 0.5C1.06272 0.5 0.530762 1.03195 0.530762 1.68815V6.37366C0.530762 7.02986 1.06272 7.56182 1.71892 7.56182H6.51077C7.16697 7.56182 7.69892 7.02986 7.69892 6.37366V1.68815C7.69892 1.03195 7.16697 0.5 6.51077 0.5H1.71891ZM6.51935 1.66202H1.71028V6.39974H6.51935V1.66202Z"
                      fill="#868E96"/>
                <rect x="3.23315" y="3.16235" width="1.76314" height="1.73698" fill="#868E96"/>
                <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M10.3788 0.5C9.72263 0.5 9.19067 1.03195 9.19067 1.68815V6.37366C9.19067 7.02986 9.72263 7.56182 10.3788 7.56182H15.1707C15.8269 7.56182 16.3588 7.02986 16.3588 6.37366V1.68815C16.3588 1.03195 15.8269 0.5 15.1707 0.5H10.3788ZM15.1794 1.66202H10.3703V6.39974H15.1794V1.66202Z"
                      fill="#868E96"/>
                <rect x="11.8933" y="3.16235" width="1.76314" height="1.73698" fill="#868E96"/>
                <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M1.71891 9.00928C1.06272 9.00928 0.530762 9.54123 0.530762 10.1974V14.8829C0.530762 15.5391 1.06272 16.0711 1.71892 16.0711H6.51077C7.16697 16.0711 7.69892 15.5391 7.69892 14.8829V10.1974C7.69892 9.54123 7.16697 9.00928 6.51077 9.00928H1.71891ZM6.51935 10.1713H1.71028V14.9091H6.51935V10.1713Z"
                      fill="#868E96"/>
                <rect x="3.23315" y="11.6716" width="1.76314" height="1.73699" fill="#868E96"/>
            </svg>
            QR Код
        </a>

        <a href="/review/{{ $school->uuid }}" class="qr-button-action">
            Ссылка на школу
        </a>
        <label>
            <span>Показать</span>
            <select>
                <option>
                    100
                </option>
            </select>
        </label>
    </section>

    <section class="table-wrapper">
        <div class="appeal-table">
            <ul class="appeal-table-header-row">
                <li>
                    Дата
                </li>
                <li>
                    Время
                </li>
                <li>
                    Текст
                </li>
                <li>
                    Отзыв
                </li>
                <li>
                    Файл
                </li>
                <li>
                    Действие
                </li>
            </ul>

            @foreach($school->reviews as $review)
                <ul class="appeal-table-row">
                    <li>
                        {{ $review->created_at['date']}}
                    </li>
                    <li>
                        {{ $review->created_at['time']}}
                    </li>
                    <li>
                        {{ $review->text }}
                    </li>
                    <li>
                    <span class="estimation-{{ $review->score === -1 ? 'red' : 'green' }}">
                        {{ $review->score === -1 ? 'Отрицательно' : 'Положительно' }}
                    </span>
                    </li>
                    <li>
                        @if(!is_null($review->file))
                            <a href="/storage/files/{{ $review->file }}" target="_blank">
                                <img src="/storage/files/{{ $review->file }}" class="review__img">
                            </a>
                        @endif
                    </li>
                    <li>

                    </li>
                </ul>
            @endforeach
        </div>
    </section>

@endsection