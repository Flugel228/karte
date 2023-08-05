@extends('layouts.admin')

@section('title', "Админ-панель: Изменение цвета $color->title")

@section('content_header')
    <h1>Админ-панель: Изменение цвета {{ $color->title }}</h1>
@endsection

@section('content')
    <div class="pt-2 pb-3">
        <h4>Форма изменения цвета</h4>
        <form action="{{ route('colors.update', ['color' => $color->id]) }}" method="post">
            @csrf
            @method('PATCH')
            <div class="w-35">
                <x-adminlte-input name="title" label="Название" placeholder="Введите название" value="{{ $color->title }}"
                                  fgroup-class="col-md-6" disable-feedback/>
                @error('title')
                    <p class="text-red col">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-35">
                <x-adminlte-input name="code" type="color" label="Код" placeholder="Выберите код" value="{{ $color->code }}"
                                  fgroup-class="col-md-6" disable-feedback/>
                @error('code')
                    <p class="text-red col">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <x-adminlte-button type="submit" label="Изменить" theme="primary" icon="fas fa-plus"/>
            </div>
        </form>
    </div>
@endsection
