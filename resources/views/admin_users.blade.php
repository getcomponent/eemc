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
            Учащиеся
        </li>
    </ol>
    <h1 class="mt-4 mb-3"><a name="u">Учащиеся</a></h1>
    <form>
        <p>Имя: <input type="text" id="user_name"></p>
        <p>E-mail: <input type="email" id="user_email"></p>
        <p>Пароль: <input type="password" id="user_password"></p>
        <p>Группа: <input type="group" id="user_group"></p>
        <input type="button" onclick="addUser()" value="Добавить">
    </form>
    <hr>
    <table style="width: 100%">
        <tr class="card-header">
            <th>ФИО пользователя</th>
            <th>Группа</th>
            <th>Статус пользователя</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        @foreach ($users as $u)
        <tr id="u{{$u->id}}">
            <td>{{$u->name}}</td>
            @if (isset($u->group))
            <td>{{$u->group}}</td>
            @else
            <td>нет</td>
            @endif
            <td>{{$u->status}}</td>
            <td><button onclick="deleteUser({{$u->id}})">Удалить</button></td>
            <td>
                <div class="container">
                    <button onclick="openUser({{$u->id}})">Изменить</button>
                    <div class="modal fade" id="changeUserModal" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Изменить пользователя</h4>
                                    <button class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body" id="res">
                                    <form id="change_user_form">
                                        <p>ФИО: <input type="text" name="name"></p>
                                        <p>Группа: <input type="text" name="group"></p>
                                        <p>Статус: <input type="text" name="status"></p>
                                        <input id="change_user" type="button" value="Изменить">
                                    </form>
                                </div>
                                <div class="modal-footer">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
            <td>
                <div class="container">
                    <button onclick="viewTests({{$u->id}})" data-toggle="modal">Тесты</button>
                    <div class="modal fade" id="testsModal" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Пройденные тесты</h4>
                                    <button class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body" id="res">
                                </div>
                                <div class="modal-footer">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
            @endforeach
    </table>
    <hr>
</div>
@endsection
