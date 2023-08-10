@extends('layouts.admin')

@section('title', 'Админ-панель: Добавление продукта')

@section('content_header')
    <h1>Админ-панель: Добавление продукта</h1>
@endsection

@section('content')
    <div class="pt-2 pb-3">
        <h4>Форма добавления продукта</h4>
        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="w-35">
                <x-adminlte-input name="title" label="Название" placeholder="Введите название"
                                  fgroup-class="col-md-6" disable-feedback enctype='multipart/form-data'/>
                @error('title')
                <p class="text-red col">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-10 ml-2">
                <x-adminlte-input name="quantity" label="Количество" placeholder="Число" type="number"
                                  igroup-size="sm" min=0 max=10000000000>
                </x-adminlte-input>
                @error('quantity')
                <p class="text-red col">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-10 ml-2">
                <x-adminlte-input name="price" label="Цена" placeholder="Число" type="number"
                                  igroup-size="sm" min=0 max=10000000000 step="0.01">
                </x-adminlte-input>
                @error('price')
                <p class="text-red col">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-35">
                @php
                    $config = [
                        "height" => "100",
                        "toolbar" => [
                            ['style', ['bold', 'italic', 'underline', 'clear'],],
                            ['font', ['strikethrough', 'superscript', 'subscript'],],
                            ['fontsize', ['fontsize'],],
                            ['color', ['color'],],
                            ['para', ['ul', 'ol', 'paragraph'],],
                            ['height', ['height'],],
                            ['table', ['table'],],
                            ['insert', ['link',],],
                            ['view', ['fullscreen', 'help']],
                        ],
                    ]
                @endphp
                <x-adminlte-text-editor name="description" label="Описание"
                                        igroup-size="sm" placeholder="Напишите какой-нибудь текст..."
                                        :config="$config"/>
                @error('description')
                <p class="text-red col">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-35">
                <x-adminlte-text-editor name="additional" label="Дополнительно"
                                        igroup-size="sm" placeholder="Напишите какой-нибудь текст..."
                                        :config="$config"/>
                @error('additional')
                <p class="text-red col">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-35">
                <x-adminlte-select name="category_id" label="Категория">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </x-adminlte-select>
                @error('category_id')
                <p class="text-red col">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-35">
                <x-adminlte-select name="color_ids[]" id="color_ids" label="Цвет" multiple>
                    @foreach($colors as $color)
                        <option
                            value="{{ $color->id }}"
                        >
                            {{ $color->title}}
                        </option>
                    @endforeach
                </x-adminlte-select>
                @error('color_ids')
                <p class="text-red col">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-35">
                <x-adminlte-select name="tag_ids[]" id="tag_ids" label="Теги" multiple>
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->title }}</option>
                    @endforeach
                </x-adminlte-select>
                @error('tag_ids')
                <p class="text-red col">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-35">
                <x-adminlte-input-file id="images" name="images[]" label="Фотографии"
                                       placeholder="Выберите файлы..." igroup-size="lg" legend="Выбрать" multiple>
                    <x-slot name="appendSlot">
                        <x-adminlte-button theme="primary" label="Загрузить"/>
                    </x-slot>
                    <x-slot name="prependSlot">
                        <div class="input-group-text text-primary">
                            <i class="fas fa-file-upload"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input-file>
                @error('images')
                <p class="text-red col">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <x-adminlte-button type="submit" label="Добавить" theme="primary" icon="fas fa-plus"/>
            </div>
        </form>
    </div>
@endsection

