@extends('layouts.admin')

@section('title', "Админ-панель: Тег $tag->title")

@section('content_header')
    <h1>Админ-панель: Тег {{ $tag->title }}</h1>
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
            <td>{{ $tag->id }}</td>
        </tr>
        <tr>
            <td>Название</td>
            <td>{{ $tag->title }}</td>
        </tr>
        <tr>
            <td>Создан</td>
            <td>{{ $tag->created_at }}</td>
        </tr>
        <tr>
            <td>Обновлен</td>
            <td>{{ $tag->updated_at }}</td>
        </tr>
    </x-adminlte-datatable>
    <a href="{{ route('tags.index') }}">
        <x-adminlte-button class="mb-2" label="Назад" theme="secondary" icon="fas fa-arrow-left"/>
    </a>
@endsection
