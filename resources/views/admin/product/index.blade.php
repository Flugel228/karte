@extends('layouts.admin')

@section('title', 'Админ-панель: Список продуктов')

@section('content_header')
    <h1>Админ-панель: Список продуктов</h1>
@endsection

@section('content')
    @php
        $heads = [
        'ID',
        'Название',
        'Создано',
        'Обновлено',
        ['Действия', 'no-export' => true, 'width' => 15],
        ];
    @endphp
    <a href="{{ route('products.create') }}">
        <x-adminlte-button class="mb-2" label="Добавить" theme="primary" icon="fas fa-plus"/>
    </a>
    <x-adminlte-datatable id="table1" :heads="$heads" head-theme="dark">
        @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->title }}</td>
                <td>{{ $product->created_at }}</td>
                <td>{{ $product->updated_at }}</td>
                <td>
                    <a href="{{ route('products.edit', $product) }}">
                        <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Изменить">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </button>
                    </a>
                    <form class="btn" action="{{ route('products.destroy', $product) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Удалить">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>
                    </form>
                    <a href="{{ route('products.show', $product) }}">
                        <button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Посмотреть">
                            <i class="fa fa-lg fa-fw fa-eye"></i>
                        </button>
                    </a>
                </td>
            </tr>
        @endforeach
    </x-adminlte-datatable>
    <div class="pt-1 pb-1">
        {{ $products->onEachSide(2)->links() }}
    </div>
@endsection
