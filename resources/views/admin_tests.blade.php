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
            Раздел контроля знаний
        </li>
    </ol>
    <h1 class="mt-4 mb-3"><a name="u">Раздел контроля знаний</a></h1>
    <a href="tests/add"><input type="button" value="Добавить"></a>
    <table style="width: 100%">
        <tr class="card-header">
            <th>Номер теста</th>
            <th>Тема теста</th>
            <th>Количество вопросов</th>
            <th></th>
            <th></th>
        </tr>
        @foreach ($tests as $test)
        <tr id="test{{$test->id}}">
            <td>{{$test->id}}</td>
            <td>{{$test->name}}</td>
            <td>{{$test->questions_count}}</td>
            <td><button type="submit" onclick="deleteTest({{$test->id}})">Удалить</button></td>
        </tr>
        @endforeach
    </table>
    <hr>
</div>
@endsection
