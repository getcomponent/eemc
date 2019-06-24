@extends('base')
@section('content')
<div class="container">
    <h1 class="mt-4 mb-3">Администрирование</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/">Главная</a>
        </li>
        <li class="breadcrumb-item">
            <a href="/admin">Администрирование</a>
        </li>
        <li class="breadcrumb-item active">
            Теоретические материалы
        </li>
    </ol>
    <h1 class="mt-4 mb-3"><a name="t">Теоретические материалы</a></h1>
    <form id="doc_form">
        <p>Название: <input type="text" name="name"></p>
        <textarea name="description" cols="50">Описание материала</textarea>
        <p>Документ: <input type="file" name="doc" enctype="multipart/form-data" accept=".doc,.docx,.pdf"></p>
        <p>Изображение: <input type="file" name="image" enctype="multipart/form-data" accept="image/*"></p>
        <p>Раздел: <select name="section">
                @foreach ($sections as $s)
                <option value="{{$s->id}}">{{$s->ru_name}}</option>
                @endforeach
            </select></p>
        <input type="button" onclick="addDoc()" value="Добавить">
    </form>
    <hr>
    <table style="width: 100%">
        <tr class="card-header">
            <th>№</th>
            <th>Название</th>
            <th>Описание</th>
            <th>Раздел</th>
            <th>Документ</th>
            <th>Изображение</th>
            <th></th>
            <th></th>
        </tr>
        @foreach ($docs as $doc)
        <tr id="doc{{$doc->id}}">
            <td>{{$doc->id}}</td>
            <td>{{$doc->name}}</td>
            <td>{{$doc->description}}</td>
            @foreach ($sections as $s)
            @if($s->id == $doc->section_id)
            <td id="{{$s->id}}">{{$s->ru_name}}</td>
            @endif
            @endforeach
            <td>{{$doc->path}}</td>
            <td>{{$doc->image}}</td>
            <td><button type="submit" onclick="deleteDoc({{$doc->id}})">Удалить</button></td>
            <td>
                <div class="container">
                    <button onclick="openDoc({{$doc->id}})">Изменить</button>
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Изменить теоретический материал</h4>
                                    <button class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body" id="res">
                                    <form id="change_doc_form">
                                        <p>Название: <input type="text" name="name"></p>
                                        <textarea name="description" cols="50">Описание материала</textarea>
                                        <p>Документ: <input type="file" name="doc" enctype="multipart/form-data" accept=".doc,.docx,.pdf"></p>
                                        <p>Изображение: <input type="file" name="image" enctype="multipart/form-data" accept="image/*"></p>
                                        <p>Раздел: <select name="section">
                                                @foreach ($sections as $s)
                                                <option value="{{$s->id}}">{{$s->ru_name}}</option>
                                                @endforeach
                                            </select></p>
                                        <input id="change_doc" type="button" value="Изменить">
                                    </form>
                                </div>
                                <div class="modal-footer">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </table>
    <hr>
</div>
@endsection
