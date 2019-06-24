@extends('base')
@section('content')
<div class="container">
    <br> <br> <br> <br> <br>
    <br> <br>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Результаты:
                </div>
                <div class="card-body">
                    @if($percent >= 50) Поздравляю, вы прошли тест на {{ $percent }} % ! Ваша оценка {{ $mark }} @else Вы прошли всего на {{ $percent }}. Попробуйте еще раз! @endif </div>
            </div>
        </div>
    </div> <br> <br> <br> <br> <br>
    <br> <br> <br> <br> <br>
</div>
@endsection
