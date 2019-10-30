@extends('base')
@section('content')
<div class="container">
    <h1 class="mt-4 mb-3">Администрирование</h1>
    <h1 class="mt-4 mb-3"><a name="u">Создание теста</a></h1>
    <form method="POST" action="/admin/tests/add">
        @csrf
        <input type="text" name="test_name">
        <br>
        <div id="questions">
        </div>
        <br>
        <input type="button" value="Добавить вопрос" onclick="addQuestion()">
        <input type="submit">
    </form>
    <hr>
</div>
@endsection
