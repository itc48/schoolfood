@extends('layouts.admin')

@section('content')

    <div class="data-table">
        <section class="sidebar-wrapper">
            <div class="title-wrapper">
                <h1 class="title">Список школ</h1>
                <a href="/admin/schools/create" class="addschool-button"><span>Добавить</span> +</a>
            <!--                <form action="/admin/schools/import" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file">
                    <input type="submit" value="отправить">
                </form>-->
            </div>
            <form class="filters-wrapper" id="filters-wrapper">
                <select name="district">
                    <option value="null">
                        Все районы
                    </option>
                    @foreach($districts as $district)
                        <option value="{{$district->id}}">
                            {{ $district->title }}
                        </option>
                    @endforeach
                </select>

                <input type="submit" value="Показать" class="addschool-button">
            </form>
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
                            <a href="/admin/schools/{{ $school->uuid }}/reviews" class="link-in">
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
                                <a href="/admin/schools/{{ $school->uuid }}/edit" class="qr-button-action">
                                    <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M21.2408 6.13006C21.6308 6.52006 21.6308 7.15006 21.2408 7.54006L19.4108 9.37006L15.6608 5.62006L17.4908 3.79006C17.8808 3.40006 18.5108 3.40006 18.9008 3.79006L21.2408 6.13006ZM3.53076 21.5001V17.7501L14.5908 6.69006L18.3408 10.4401L7.28076 21.5001H3.53076Z"/>
                                    </svg>

                                </a>

                                <form action="/admin/schools/{{ $school->uuid }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button>
                                        <a href="" class="qr-button-action">
                                            <svg width="25" height="25" viewBox="0 0 25 25"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                      d="M16.0308 4.5H19.5308V6.5H5.53076V4.5H9.03076L10.0308 3.5H15.0308L16.0308 4.5ZM8.53076 21.5C7.43076 21.5 6.53076 20.6 6.53076 19.5V7.5H18.5308V19.5C18.5308 20.6 17.6308 21.5 16.5308 21.5H8.53076Z"/>
                                            </svg>
                                        </a>
                                    </button>
                                </form>

                                <a href="{{route('qr-generate',['uid' => $school->uuid])}}" target="_blank"
                                   class="qr-button-action fix-button">
                                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
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
                            </div>
                        </li>
                    </ul>
                @endforeach
            </div>
        </section>
    </div>
@endsection
