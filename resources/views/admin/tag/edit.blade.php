@extends('layouts.admin')

@section('title', "Админ-панель: Изменение тега $tag->title")

@section('content_header')
    <h1>Админ-панель: Изменение тега {{ $tag->title }}</h1>
@endsection

@section('content')
    <div class="pt-2 pb-3">
        <h4>Форма изменения категории</h4>
        <form action="{{ route('tags.update', ['tag' => $tag->id]) }}" method="post">
            @csrf
            @method('PATCH')
            <div class="w-35">
                <x-adminlte-input name="title" label="Название" placeholder="Введите название" value="{{ $tag->title }}"
                                  fgroup-class="col-md-6" disable-feedback/>
                @error('title')
                    <p class="text-red col">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <x-adminlte-button type="submit" label="Изменить" theme="primary" icon="fas fa-plus"/>
            </div>
        </form>
    </div>
@endsection
