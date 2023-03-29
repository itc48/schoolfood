@extends('layouts.admin')

@section('content')

    <div class="header-wrapper">
        <h1>Список школ</h1>
    </div>

    <div class="data-table">
        <div class="row">
            <div class="col">
                <strong>Название</strong>
            </div>
            <div class="col">
                <strong>Адрес</strong>
            </div>
            <div class="col">
                <strong>Количество голосов</strong>
            </div>
            <div class="col">
                <strong>Сумма</strong>
            </div>
        </div>
        @foreach($schools as $school)
            <div class="row">
                <div class="col">
                    <b>{{ $school->title }}</b>
                </div>
                <div class="col">
                    <b>{{ $school->address }}</b>
                </div>
                <div class="col">
                    <b>{{ count($school->reviews) }}</b>
                </div>
                <div class="col">
                    <b>{{ $school->reviewsSum() }}</b>
                </div>
            </div>
            @foreach($school->reviews as $review)
                <div class="row">
                    <div class="col">
                        {{ $review->created_at['date']}}
                    </div>
                    <div class="col">
                        {{ $review->created_at['time']}}
                    </div>
                    <div class="col text-col">
                        {{ $review->text }}
                    </div>
                    <div class="col {{ $review->score === -1 ? 'negative' : 'positive' }}-color">
                        {{ $review->score === -1 ? 'Отрицательно' : 'Положительно' }}
                    </div>
                    <div class="col">
                        @if($review->file)
                            <img src="/storage/files/{{ $review->file }}" alt="">
                        @endif
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>

@endsection
