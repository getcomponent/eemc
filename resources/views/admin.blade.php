@extends('base')
@section('content')
<div class="container">
    <h1 class="mt-4 mb-3">Администрирование</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/">Главная</a>
        </li>
        <li class="breadcrumb-item active">Администрирование</li>
    </ol>
    <div class="container">
        <br>
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="card h-100">
                    <h4 class="card-header">Учащиеся</h4>
                    <div class="card-body">
                        <p class="card-text">Добавление, изменение и удаление учащихся</p>
                    </div>
                    <div class="card-footer">
                        <a href="admin/users" class="btn btn-primary">Перейти</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card h-100">
                    <h4 class="card-header">Теоретические разделы</h4>
                    <div class="card-body">
                        <p class="card-text">Добавление, изменение и удаление теоретических материалов</p>
                    </div>
                    <div class="card-footer">
                        <a href="admin/theory" class="btn btn-primary">Перейти</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card h-100">
                    <h4 class="card-header">Раздел контроля знаний</h4>
                    <div class="card-body">
                        <p class="card-text">Добавление и удаление тестовых материалов</p>
                    </div>
                    <div class="card-footer">
                        <a href="admin/tests" class="btn btn-primary">Перейти</a>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </div>
</div>
@endsection
