@extends('layouts.admin')

@section('title', "Админ-панель: Категория $category->title")

@section('content_header')
    <h1>Админ-панель: Категория {{ $category->title }}</h1>
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
            <td>{{ $category->id }}</td>
        </tr>
        <tr>
            <td>Название</td>
            <td>{{ $category->title }}</td>
        </tr>
        <tr>
            <td>Создан</td>
            <td>{{ $category->created_at }}</td>
        </tr>
        <tr>
            <td>Обновлен</td>
            <td>{{ $category->updated_at }}</td>
        </tr>
    </x-adminlte-datatable>
    <a href="{{ route('categories.index') }}">
        <x-adminlte-button class="mb-2" label="Назад" theme="secondary" icon="fas fa-arrow-left"/>
    </a>
@endsection
