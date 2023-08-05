@extends('layouts.admin')

@section('title', 'Админ-панель: Список пользователей')

@section('content_header')
    <h1>Админ-панель: Список пользователей</h1>
@endsection

@section('content')
    @php
        $heads = [
        'ID',
        'Email',
        'Создано',
        'Обновлено',
        ['Действия', 'no-export' => true, 'width' => 15],
        ];
    @endphp
    <a href="{{ route('users.create') }}">
        <x-adminlte-button class="mb-2" label="Добавить" theme="primary" icon="fas fa-plus"/>
    </a>
    <x-adminlte-datatable id="table1" :heads="$heads" head-theme="dark">
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at }}</td>
                <td>{{ $user->updated_at }}</td>
                <td class="p-0">
                    <a href="{{ route('users.edit', $user) }}">
                        <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Изменить">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </button>
                    </a>
                    <form class="btn" action="{{ route('users.destroy', $user) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Удалить">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>
                    </form>
                    <a href="{{ route('users.show', $user) }}">
                        <button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Посмотреть">
                            <i class="fa fa-lg fa-fw fa-eye"></i>
                        </button>
                    </a>
                </td>
            </tr>
        @endforeach
    </x-adminlte-datatable>
    <div>
        {{ $users->onEachSide(2)->links() }}
    </div>
@endsection
