@extends('base')
@section('content')
<div class="container">
    <br>
    <div class="row">
        <div>
            <form method="post" action="{{$test->path}}/result">
                @csrf
                <h2 class="breadcrumb" style="font-size: 16pt">
                    @foreach($questions as $question)
                    <div>
                        {{$question->text}}
                        <br><br>
                        <ul type="a">
                            @foreach($answers as $answer)
                            @if($answer->question_id == $question->id)
                            <li style="list-style-type: none">
                                <p>
                                    <input style="width:20px; height:20px;" name="{{ $question->id }}_{{ $answer->id }}" type="checkbox">
                                    {{$answer->text}}
                                </p>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                    @endforeach
                </h2>
                <div>
                </div>
                <button class="btn btn-primary" onclick="">Узнать результат</button>
            </form>
        </div>
    </div>
    <br>
</div>
@endsection
