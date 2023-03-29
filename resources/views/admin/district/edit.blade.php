@extends('layouts.admin')

@section('content')

    <section class="sidebar-wrapper">
        <div class="title-wrapper">
            <a href="/admin/districts/" class="back-to-school-button">
                <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M20.3853 11H8.18525L13.7853 5.4L12.3853 4L4.38525 12L12.3853 20L13.7853 18.6L8.18525 13H20.3853V11Z"/>
                </svg>
            </a>
            <h1 class="title fix-title">Редактирование района {{ $district->title }}</h1>
        </div>
    </section>
    <br/><br/>
    <section class="form-wrapper">
        <form action="/admin/districts/{{ $district->id }}" method="POST" class="create-form">
            <fieldset>
                @csrf
                @method('PUT')
                <label for="district-name">Название района: <i>*</i></label><br><br>
                <input type="text" name="title" id="district-name" value="{{ $district->title }}" required>

                <input type="submit" value="Сохранить" class="button-form-district">
            </fieldset>
        </form>
    </section>

@endsection
