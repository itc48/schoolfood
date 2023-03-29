@extends('layouts.admin')

@section('content')

    <section class="sidebar-wrapper">
        <div class="title-wrapper">
            <a href="/admin/users/" class="back-to-school-button">
                <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M20.3853 11H8.18525L13.7853 5.4L12.3853 4L4.38525 12L12.3853 20L13.7853 18.6L8.18525 13H20.3853V11Z"/>
                </svg>
            </a>
            <h1 class="title fix-title">Редактирование пользователя {{ $user->name }}</h1>
        </div>
    </section>
    <br/><br/>

    <section class="form-wrapper">
        <form action="/admin/users/{{ $user->id }}" method="POST" class="create-form">
            <fieldset>
                @csrf
                @method('PUT')

                <label for="district-name">Имя <i>*</i><br><br>
                <input type="text" name="name" value="{{ $user->name }}" id="district-name" required>
                </label><br><br>

                <label for="role_id">Роль <i>*</i>
                    <br>
                    <br>
                    <select name="role_id" id="role_id" class="form__input">
                        <option>

                        </option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" @if($user->role_id === $role->id) selected @endif>
                                {{ $role->code  }}
                            </option>
                        @endforeach
                    </select>
                </label><br><br><br>

                <label for="district_id">Район
                    <br>
                    <br>
                    <select name="district_id" id="district_id" class="form__input">
                        <option>

                        </option>
                        @foreach($districts as $district)
                            <option value="{{ $district->id }}"
                                    @if($user->district_id === $district->id) selected @endif>
                                {{ $district->title }}
                            </option>
                        @endforeach
                    </select>
                </label><br><br><br>

                <label for="school_uuid">Школа
                    <br>
                    <br>
                    <select name="school_uuid" id="school_uuid" class="form__input">
                        <option>

                        </option>
                        @foreach($schools as $school)
                            <option value="{{ $school->uuid }}"
                                    @if($user->school_uuid === $school->uuid) selected @endif>
                                {{ $school->title }}
                            </option>
                        @endforeach
                    </select>
                </label><br><br><br>

                <input type="submit" value="Создать" class="button-form-district">
            </fieldset>
        </form>
    </section>
@endsection
