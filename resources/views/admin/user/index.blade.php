@extends('layouts.admin')

@section('content')

    <section class="sidebar-wrapper">
        <div class="title-wrapper">
            <h1 class="title">Список пользователей</h1>
            <a href="/admin/users/create" class="addschool-button"><span>Добавить</span> +</a>
        </div>
    </section>

    <section class="table-wrapper">
        <div class="district-table">
            <ul class="district-table-header-row">
                <li>
                    Название
                </li>
                <li>
                    Действие
                </li>
            </ul>
            @foreach($users as $user)
                <ul class="district-table-row">
                    <li>
                        <a href="" class="link-in">{{ $user->name }}</a>
                    </li>
                    <li>
                        <a href="" class="link-in">{{ $user->role ? $user->role->code : ''}}</a>
                    </li>
                    <li>
                        <a href="" class="link-in">{{ $user->district ? $user->district->title : ''}}</a>
                    </li>
                    <li>
                        <div class="action-zone">
                            <a href="/admin/users/{{ $user->id }}/edit" class="qr-button-action">
                                <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M21.2408 6.13006C21.6308 6.52006 21.6308 7.15006 21.2408 7.54006L19.4108 9.37006L15.6608 5.62006L17.4908 3.79006C17.8808 3.40006 18.5108 3.40006 18.9008 3.79006L21.2408 6.13006ZM3.53076 21.5001V17.7501L14.5908 6.69006L18.3408 10.4401L7.28076 21.5001H3.53076Z"/>
                                </svg>

                                Редактировать
                            </a>
                            <form action="/admin/users/{{ $user->id }}" method="POST" class="button">
                                @csrf
                                @method('DELETE')

                                <button>
                                    <span class="qr-button-action">
                                        <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M16.0308 4.5H19.5308V6.5H5.53076V4.5H9.03076L10.0308 3.5H15.0308L16.0308 4.5ZM8.53076 21.5C7.43076 21.5 6.53076 20.6 6.53076 19.5V7.5H18.5308V19.5C18.5308 20.6 17.6308 21.5 16.5308 21.5H8.53076Z"/>
                                        </svg>
                                        Удалить
                                    </span>

                                    {{--Удалить--}}
                                </button>
                            </form>
                        </div>
                    </li>
                </ul>
            @endforeach
        </div>
    </section>

@endsection
