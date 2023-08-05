@extends('layouts.admin')

@section('title', 'Админ-панель: Добавление пользователя')

@section('content_header')
    <h1>Админ-панель: Добавление пользователя</h1>
@endsection

@section('content')
    <div class="pt-2 pb-3">
        <h4>Форма добавления пользователя</h4>
        <form action="{{ route('users.store') }}" method="post">
            @csrf
            <div class="w-35">
                <x-adminlte-input name="first_name" label="Имя" placeholder="Введите имя"
                                  fgroup-class="col-md-6" disable-feedback/>
                @error('first_name')
                    <p class="text-red col">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-35">
                <x-adminlte-input name="last_name" label="Фамилия" placeholder="Введите фамилию"
                                  fgroup-class="col-md-6" disable-feedback/>
                @error('last_name')
                <p class="text-red col">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-10">
                <x-adminlte-select name="role" label="Роль">
                    @foreach($roles as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </x-adminlte-select>
                @error('role')
                <p class="text-red col">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-10">
                <x-adminlte-select name="gender" label="Пол">
                    @foreach($genders as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </x-adminlte-select>
                @error('gender')
                <p class="text-red col">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-50">
                <x-adminlte-input name="address" label="Адрес" placeholder="Введите адрес"
                                  fgroup-class="col-md-6" disable-feedback/>
                @error('address')
                <p class="text-red col">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-50">
                <x-adminlte-input name="telephone" type="tel" label="Номер телефона" placeholder="+1-(23)-456-78-90"
                                  fgroup-class="col-md-6" disable-feedback/>
                @error('telephone')
                <p class="text-red col">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-50">
                <x-adminlte-input name="email" type="email" label="Email" placeholder="mail@example.com"
                                  fgroup-class="col-md-6" disable-feedback/>
                @error('email')
                <p class="text-red col">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-35">
                <x-adminlte-input name="password" type="password" label="Пароль" placeholder="Введите пароль"
                                  fgroup-class="col-md-6" disable-feedback/>
                @error('password')
                <p class="text-red col">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-35">
                <x-adminlte-input name="confirm_password" type="password" label="Подтверждение пароля"
                                  placeholder="Повторите пароль"
                                  fgroup-class="col-md-6" disable-feedback/>
                @error('confirm_password')
                <p class="text-red col">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <x-adminlte-button type="submit" label="Добавить" theme="primary" icon="fas fa-plus"/>
            </div>
        </form>
    </div>
@endsection

