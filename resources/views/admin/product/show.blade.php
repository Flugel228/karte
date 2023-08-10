@extends('layouts.admin')

@section('title', "Админ-панель: Продукт $product->title")

@section('content_header')
    <h1>Админ-панель: Продукт {{ $product->title }}</h1>
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
            <td>{{ $product->id }}</td>
        </tr>
        <tr>
            <td>Название</td>
            <td>{{ $product->title }}</td>
        </tr>
        <tr>
            <td>Количество</td>
            <td>{{ $product->quantity }}</td>
        </tr>
        <tr>
            <td>Цена</td>
            <td>{{ $product->price }}</td>
        </tr>
        <tr>
            <td>Описание</td>
            <td>{{ $product->description }}</td>
        </tr>
        <tr>
            <td>Дополнение</td>
            <td>{{ $product->additional }}</td>
        </tr>
        <tr>
            <td>Категория</td>
            <td>{{ $product->category->title }}</td>
        </tr>
        <tr>
            <td>Цвета</td>
            <td>
                @foreach($product->colors as $color)
                    <div class="row"><div style="width: 5%; height: 20px; background: {{ $color->code }}"></div>{{ $color->title }}</div>
                @endforeach
            </td>
        </tr>
        <tr>
            <td>Теги</td>
            <td>
                @foreach($product->tags as $tag)
                    <div class="row">
                        {{ $tag->title }}
                    </div>
                @endforeach
            </td>
        </tr>
        <tr>
            <td>Изображения</td>
            <td>
                @foreach($product->images as $image)
                    <div class="row {{ $loop->last ? "" : "pb-3"}}">
                        <img src="{{ $image->url }}" alt="{{ $image->id }}">
                    </div>
                @endforeach
            </td>
        </tr>
        <tr>
            <td>Создан</td>
            <td>{{ $product->created_at }}</td>
        </tr>
        <tr>
            <td>Обновлен</td>
            <td>{{ $product->updated_at }}</td>
        </tr>
    </x-adminlte-datatable>
    <a href="{{ route('products.index') }}">
        <x-adminlte-button class="mb-2" label="Назад" theme="secondary" icon="fas fa-arrow-left"/>
    </a>
@endsection
