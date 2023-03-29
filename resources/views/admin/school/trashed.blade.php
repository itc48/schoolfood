@extends('layouts.admin')

@section('content')

    <section class="sidebar-wrapper">
        <div class="title-wrapper">
            <a href="/admin/schools/{{ $school->uuid }}/reviews" class="back-to-school-button">
                <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M20.3853 11H8.18525L13.7853 5.4L12.3853 4L4.38525 12L12.3853 20L13.7853 18.6L8.18525 13H20.3853V11Z"/>
                </svg>
            </a>
            <h1 class="title">
                {{ $school->title }}<br/>
                <span class="subtitle">Удаленные комментарии</span>
            </h1>
        </div>
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

            @foreach($reviews_trashed as $review)
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
                        <a href="/storage/files/{{ $review->file }}" target="_blank">
                            <img src="/storage/files/{{ $review->file }}" class="review__img">
                        </a>
                    </li>
                    <li>
                    </li>
                </ul>
            @endforeach
        </div>
    </section>

@endsection