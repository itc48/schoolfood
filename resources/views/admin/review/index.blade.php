@extends('layouts.admin')

@section('content')

    <div class="data-table">
        <section class="sidebar-wrapper">
            <div class="title-wrapper">
                <h1 class="title">Список отзывов</h1>
            </div>
            <form class="filters-wrapper" id="filters-wrapper">
                <label for="district">
                    <span>Район:</span>

                    <select name="district" id="district">
                        <option value="null">
                            Все районы
                        </option>
                        @foreach($districts as $district)
                            <option value="{{ $district->id }}" {{ $meta['district'] == $district->id ? 'selected' : '' }}>
                                {{ $district->title }}
                            </option>
                        @endforeach
                    </select>
                </label>

                <label for="school">
                    <span>Школа:</span>

                    <select name="school" id="school">
                        <option value="null">
                            Все школы
                        </option>
                        @foreach($schools as $school)
                            <option value="{{ $school->uuid }}" {{ $meta['school'] == $school->uuid ? 'selected' : '' }}>
                                {{ $school->short_title ?? $school->title }}
                            </option>
                        @endforeach
                    </select>
                </label>

                <label for="score">
                    <span>Оценка:</span>

                    <select name="score" id="score">
                        <option value="null">
                            Характер оценки
                        </option>
                        <option value="-1" {{ $meta['score'] == '-1' ? 'selected' : '' }}>
                            Отрицательные
                        </option>
                        <option value="1" {{ $meta['score'] == '1' ? 'selected' : '' }}>
                            Положительные
                        </option>
                    </select>
                </label>

                <label for="dateStart">
                    <span>От:</span>

                    <input type="date" id="dateStart" name="dateStart" value="{{ $meta['dateStart'] }}">
                </label>

                <label for="dateEnd">
                    <span>До:</span>

                    <input type="date" id="dateEnd" name="dateEnd" value="{{ $meta['dateEnd'] }}">
                </label>

                <input type="submit" value="Показать" class="addschool-button">
            </form>

            <form method="GET" action="reviews/export">
                <input type="hidden" value="{{ $meta['district'] }}" name="district">
                <input type="hidden" value="{{ $meta['school'] }}" name="school">
                <input type="hidden" value="{{ $meta['score'] }}" name="score">
                <input type="hidden" value="{{ $meta['dateStart'] }}" name="dateStart">
                <input type="hidden" value="{{ $meta['dateEnd'] }}" name="dateEnd">

                <input type="submit" value="Скачать отчёт по отзывам" class="addschool-button2">
            </form>
        </section>

        <section class="sidebar-wrapper">
            <div class="filters-wrapper" id="filters-wrapper">
                <div class="filter-dashboard">
                    <p class="filter-dashboard-number">
                        {{ count($reviews) }}
                    </p>
                    <p class="filter-dashboard-text">
                        Всего проголосовало
                    </p>
                </div>

                <div class="filter-dashboard">
                    <p class="filter-dashboard-number">
                        {{ count($positive) }}
                    </p>
                    <p class="filter-dashboard-text">
                        Положительных
                    </p>
                </div>

                <div class="filter-dashboard">
                    <p class="filter-dashboard-number">
                        {{ count($negative) }}
                    </p>
                    <p class="filter-dashboard-text">
                        Отрицательных
                    </p>
                </div>
            </div>
        </section>

        <section class="table-wrapper">
            <div class="review__table">
                <ul class="review__table-header">
                    <li>
                        Дата
                    </li>
                    <li>
                        Время
                    </li>
                    <li>
                        Район
                    </li>
                    <li>
                        Школа
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
                </ul>
                @foreach($reviews as $review)
                    <ul class="review__table-row">
                        <li>
                            {{ $review->created_at['date']}}
                        </li>
                        <li>
                            {{ $review->created_at['time']}}
                        </li>
                        <li>
                            {{$review->district_title}}
                        </li>
                        <li>
                            {{$review->school_title}}
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
                    </ul>
                @endforeach
            </div>
        </section>
    </div>
@endsection
