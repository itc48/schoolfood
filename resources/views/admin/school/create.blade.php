@extends('layouts.admin')

@section('content')
    <script src="https://api-maps.yandex.ru/2.1/?apikey=2877dea4-a9b5-41b9-867b-0202ead2c3cd&lang=ru_RU"
            type="text/javascript">
    </script>

    <section class="sidebar-wrapper">
        <div class="title-wrapper">
            <a href="/admin/schools" class="back-to-school-button">
                <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M20.3853 11H8.18525L13.7853 5.4L12.3853 4L4.38525 12L12.3853 20L13.7853 18.6L8.18525 13H20.3853V11Z"/>
                </svg>
            </a>
            <h1 class="title">Добавить школу</h1>
        </div>
    </section>

    <section class="form-wrapper">
        <form action="/admin/schools" method="POST">
            @csrf

            <fieldset>
                <label for="school-name">Название школы: <i>*</i></label>
                <br>
                <br>
                <textarea name="title" id="school-name" required></textarea>
                <br>

                <label for="school-short">Краткое наименование организации:</label>
                <br>
                <br>
                <input name="short_title" id="school-short"/>
                <br>

                <label for="school-status">Статус:</label>
                <br>
                <br>
                <select name="status" id="school-status">
                    <option value="Юридическое лицо">
                        Юридическое лицо
                    </option>
                    <option value="Филиал общеобразовательной организации (ООО)">
                        Филиал общеобразовательной организации (ООО)
                    </option>
                </select>
                <br>

                <label for="school-address">Адрес: <i>*</i></label>
                <br>
                <br>
                <input name="address" id="school-address" required>
                <br>

                <div class="form-input-wrapper">
                    <label for="school-district">Район:
                        <br>
                        <br>
                        <select name="district_id" id="school-district">
                            <option>

                            </option>
                            @foreach($districts as $district)
                                <option value="{{ $district->id }}">
                                    {{ $district->title }}
                                </option>
                            @endforeach
                        </select>
                    </label><br>
                    <div class="coords">
                        <label for="school-h">Широта: <i>*</i>
                            <br>
                            <br>
                            <input name="latitude" id="school-h" required>
                        </label><br>
                        <label for="school-w">Долгота: <i>*</i>
                            <br>
                            <br>
                            <input name="longitude" id="school-w" required>
                        </label>
                    </div>
                </div>

                <br/>

                <div class="user-wrapper">
                    <h3>Создание учётной записи модератора</h3>
                    <br>
                    <br>
                    <br>
                </div>

                <div class="user-wrapper">
                    <label for="user-name">Имя:
                        <br>
                        <br>
                        <input name="name" id="user-name">
                    </label>
                    <br>

                    <label for="user-password">Пароль:
                        <br>
                        <br>
                        <input name="password" id="user-password" type="password">
                    </label>
                    <br>
                </div>

                <input type="submit" value="Добавить" id="submitButton" class="submit-button">
            </fieldset>
        </form>
    </section>

    <script src="{{ asset('/js/geocoder.js') }}"></script>
    <script src="{{ asset('/js/inputLengthLimit.js') }}"></script>
@endsection