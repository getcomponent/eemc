@extends('base')
@section('content')
<div class="container">
    <h1 class="mt-4 mb-3">Раздел контроля знаний</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/">Главная</a>
        </li>
        <li class="breadcrumb-item active">Раздел контроля знаний</li>
    </ol>
    <h2>Выбор теста</h2>
    <div class="row">
        @foreach($tests as $test)
        <div class="col-lg-4 col-sm-6 portfolio-item">
            <div class="card h-100">
                @if($test->image == null)
                <img src="11.png">
                @else
                <img src="{{$test->image}}">
                @endif
                <div class="card-body">
                    @if ($test->id == 1 || ($lastPassed != null && ($test->id <= $lastPassed->test_id || ($test->id == $lastPassed->test_id + 1 && $lastPassed->mark >= 5))))
                        <h4 class="card-title">
                            <a href="tests/{{$test->path}}">
                                {{$test->name}}
                            </a>
                        </h4>
                        @else
                        {{$test->name}}
                        @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
