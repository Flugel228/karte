@extends('layouts.admin')

@section('title', 'Админ-панель: Список пользователей')

@section('content_header')
    <h1>Админ-панель: Список пользователей</h1>
@endsection

@section('content')
    @php
        $heads = [
        'Атрибут',
        'Значение',
        ];
    @endphp
    <x-adminlte-datatable id="table1" :heads="$heads" head-theme="dark">
        <tr>
            <td>ID</td>
            <td>{{ $user->id }}</td>
        </tr>
        <tr>
            <td>Имя</td>
            <td>{{ $user->first_name }}</td>
        </tr>
        <tr>
            <td>Фамилия</td>
            <td>{{ $user->last_name }}</td>
        </tr>
        <tr>
            <td>Роль</td>
            <td>
                @foreach($roles as $key => $value)
                    {{$key == $user->role ? $value : ''}}
                @endforeach
            </td>
        </tr>
        <tr>
            <td>Гендер</td>
            <td>
                @foreach($genders as $key => $value)
                    {{$key == $user->gender ? $value : ''}}
                @endforeach
            </td>
        </tr>
        <tr>
            <td>Email</td>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <td>Email подтвержден</td>
            <td>{{ $user->email_verified_at != null ? $user->email_verified_at : 'Нет'  }}</td>
        </tr>
        <tr>
            <td>Создан</td>
            <td>{{ $user->created_at }}</td>
        </tr>
        <tr>
            <td>Обновлен</td>
            <td>{{ $user->updated_at }}</td>
        </tr>
    </x-adminlte-datatable>
    <a href="{{ route('users.index') }}">
        <x-adminlte-button class="mb-2" label="Назад" theme="secondary" icon="fas fa-arrow-left"/>
    </a>
@endsection
