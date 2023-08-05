@extends('layouts.admin')

@section('title', 'Админ-панель: Список цветов')

@section('content_header')
    <h1>Админ-панель: Список цветов</h1>
@endsection

@section('content')
    @php
        $heads = [
        'ID',
        'Название',
        'Код',
        'Цвет',
        'Создано',
        'Обновлено',
        ['Действия', 'no-export' => true, 'width' => 15],
        ];
    @endphp
    <a href="{{ route('colors.create') }}">
        <x-adminlte-button class="mb-2" label="Добавить" theme="primary" icon="fas fa-plus"/>
    </a>
    <x-adminlte-datatable id="table1" :heads="$heads" head-theme="dark">
        @foreach($colors as $color)
            <tr>
                <td>{{ $color->id }}</td>
                <td>{{ $color->title }}</td>
                <td>{{ $color->code }}</td>
                <td style="background: {{ $color->code }}"></td>
                <td>{{ $color->created_at }}</td>
                <td>{{ $color->updated_at }}</td>
                <td class="p-0">
                    <a href="{{ route('colors.edit', $color) }}">
                        <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Изменить">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </button>
                    </a>
                    <form class="btn" action="{{ route('colors.destroy', $color) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Удалить">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>
                    </form>
                    <a href="{{ route('colors.show', $color) }}">
                        <button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Посмотреть">
                            <i class="fa fa-lg fa-fw fa-eye"></i>
                        </button>
                    </a>
                </td>
            </tr>
        @endforeach
    </x-adminlte-datatable>
    <div class="pt-1 pb-1">
        {{ $colors->onEachSide(2)->links() }}
    </div>
@endsection
