@extends('layouts.schoolchildren')

@section('content')

    <section class="sidebar-wrapper">
        <div class="title-wrapper">
            <h1 class="title">Список школ</h1>
        </div>
    </section>

    <section class="table-wrapper">
        <div class="table">
            <ul class="table-header-row">
                <li>
                    Название
                </li>
                <li>
                    Адрес
                </li>
                <li>
                    Количество голосов
                </li>
                <li>
                    Рейтинг
                </li>
                <li>
                    Действие
                </li>
            </ul>
            @foreach($schools as $school)
                <ul class="table-row">
                    <li>
                        <a href="/schoolchildren/schools/{{ $school->uuid }}/reviews" class="link-in">
                            {{ $school->title }}
                        </a>
                    </li>
                    <li>
                        {{ $school->address }}
                    </li>
                    <li>
                        {{ count($school->reviews) }}
                    </li>
                    <li>
                        {{ $school->reviewsSum() }}
                    </li>
                    <li>
                        <div class="action-zone">
                            <a href="/schoolchildren/schools/{{ $school->uuid }}/edit" class="qr-button-action">
                                <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M21.2408 6.13006C21.6308 6.52006 21.6308 7.15006 21.2408 7.54006L19.4108 9.37006L15.6608 5.62006L17.4908 3.79006C17.8808 3.40006 18.5108 3.40006 18.9008 3.79006L21.2408 6.13006ZM3.53076 21.5001V17.7501L14.5908 6.69006L18.3408 10.4401L7.28076 21.5001H3.53076Z"/>
                                </svg>
                            </a>
                        </div>
                    </li>
                </ul>
            @endforeach
        </div>
    </section>

@endsection
