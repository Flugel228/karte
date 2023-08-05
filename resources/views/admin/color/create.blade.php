@extends('layouts.admin')

@section('title', 'Админ-панель: Добавление цвета')

@section('content_header')
    <h1>Админ-панель: Добавление цвета</h1>
@endsection

@section('content')
    <div class="pt-2 pb-3">
        <h4>Форма добавления цвета</h4>
        <form action="{{ route('colors.store') }}" method="post">
            @csrf
            <div class="w-35">
                <x-adminlte-input name="title" label="Название" placeholder="Введите название"
                                  fgroup-class="col-md-6" disable-feedback/>
                @error('title')
                <p class="text-red col">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-35">
                <x-adminlte-input name="code" type="color" label="Код" placeholder="Введите название"
                                  fgroup-class="col-md-6" disable-feedback/>
                @error('code')
                <p class="text-red col">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <x-adminlte-button type="submit" label="Добавить" theme="primary" icon="fas fa-plus"/>
            </div>
        </form>
    </div>
@endsection

