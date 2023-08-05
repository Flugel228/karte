@extends('layouts.admin')

@section('title', "Админ-панель: Цвет $color->title")

@section('content_header')
    <h1>Админ-панель: Цвет {{ $color->title }}</h1>
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
            <td>{{ $color->id }}</td>
        </tr>
        <tr>
            <td>Название</td>
            <td>{{ $color->title }}</td>
        </tr>
        <tr>
            <td>Код</td>
            <td>{{ $color->code }}</td>
        </tr>
        <tr>
            <td>Цвет</td>
            <td style="background: {{ $color->code }}"></td>
        </tr>
        <tr>
            <td>Создан</td>
            <td>{{ $color->created_at }}</td>
        </tr>
        <tr>
            <td>Обновлен</td>
            <td>{{ $color->updated_at }}</td>
        </tr>
    </x-adminlte-datatable>
    <a href="{{ route('colors.index') }}">
        <x-adminlte-button class="mb-2" label="Назад" theme="secondary" icon="fas fa-arrow-left"/>
    </a>
@endsection
