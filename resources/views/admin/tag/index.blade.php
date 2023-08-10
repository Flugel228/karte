@extends('layouts.admin')

@section('title', 'Админ-панель: Список тегов')

@section('content_header')
    <h1>Админ-панель: Список тегов</h1>
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
    <a href="{{ route('tags.create') }}">
        <x-adminlte-button class="mb-2" label="Добавить" theme="primary" icon="fas fa-plus"/>
    </a>
    <x-adminlte-datatable id="table1" :heads="$heads" head-theme="dark">
        @foreach($tags as $tag)
            <tr>
                <td>{{ $tag->id }}</td>
                <td>{{ $tag->title }}</td>
                <td>{{ $tag->created_at }}</td>
                <td>{{ $tag->updated_at }}</td>
                <td class="p-0">
                    <a href="{{ route('tags.edit', $tag) }}">
                        <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Изменить">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </button>
                    </a>
                    <form class="btn" action="{{ route('tags.destroy', $tag) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Удалить">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>
                    </form>
                    <a href="{{ route('tags.show', $tag) }}">
                        <button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Посмотреть">
                            <i class="fa fa-lg fa-fw fa-eye"></i>
                        </button>
                    </a>
                </td>
            </tr>
        @endforeach
    </x-adminlte-datatable>
    <div class="pt-1 pb-1">
        {{ $tags->onEachSide(2)->links() }}
    </div>
@endsection
