@extends('layouts.admin')

@section('content')

    <section class="sidebar-wrapper">
        <div class="title-wrapper">
            <a href="/admin/schools" class="back-to-school-button">
                <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M20.3853 11H8.18525L13.7853 5.4L12.3853 4L4.38525 12L12.3853 20L13.7853 18.6L8.18525 13H20.3853V11Z"/>
                </svg>
            </a>
            <h1 class="title fix-title">
                Редактирование школы "{{ $school->title }}"
            </h1>
        </div>
    </section>

    <section class="form-wrapper">
        <form action="/admin/schools/{{ $school->uuid }}" method="POST">
            @csrf
            @method('PUT')

            <fieldset>
                <label for="school-name">Название школы: <i>*</i></label>
                <br>
                <br>
                <textarea name="title" id="school-name" required>{{ $school->title }}</textarea>
                <br>

                <label for="school-short">Краткое наименование организации:</label>
                <br>
                <br>
                <input name="short_title" id="school-short" value="{{ $school->short_title }}"/>
                <br>

                <label for="school-status">Статус:</label>
                <br>
                <br>
                <select name="status" id="school-status">
                    <option value="Юридическое лицо" {{ $school->status === 'JURIDICAL' ? 'selected' : '' }}>
                        Юридическое лицо
                    </option>
                    <option value="Филиал общеобразовательной организации (ООО)" {{ $school->status === 'GENERAL_EDUCATIONAL' ? 'selected' : '' }}>
                        Филиал общеобразовательной организации (ООО)
                    </option>
                </select>
                <br>

                <label for="school-address">Адрес: <i>*</i></label>
                <br>
                <br>
                <input name="address" id="school-address" required value="{{ $school->address }}">
                <br>

                <div class="form-input-wrapper">
                    <label for="school-district">Район:
                        <br>
                        <br>
                        <select name="district_id" id="school-district">
                            <option>

                            </option>
                            @foreach($districts as $district)
                                <option value="{{ $district->id }}" @if($school->district_id === $district->id) selected @endif>
                                    {{ $district->title }}
                                </option>
                            @endforeach
                        </select>
                    </label><br>
                    <div class="coords">
                        <label for="school-h">Широта: <i>*</i>
                            <br>
                            <br>
                            <input name="latitude" id="school-h" required value="{{ $school->latitude }}">
                        </label><br>
                        <label for="school-w">Долгота: <i>*</i>
                            <br>
                            <br>
                            <input name="longitude" id="school-w" required value="{{ $school->longitude }}">
                        </label>
                    </div>
                </div>

                <br/>
                <br/>

                <input type="submit" value="Изменить" id="submitButton" class="submit-button">
            </fieldset>
        </form>
    </section>

    <script src="{{ asset('/js/inputLengthLimit.js') }}"></script>
@endsection
