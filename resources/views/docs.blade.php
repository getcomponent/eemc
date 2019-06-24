@extends('base')
@section('content')

 <div class="container">

    <h1 class="mt-4 mb-3">{{$section->ru_name}}</h1>

    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="/">Главная</a>
      </li>
      <li class="breadcrumb-item active">{{$section->ru_name}}</li>
    </ol>

    <h2>Выбор темы</h2>

    <div class="row">
      
      	@foreach($docs as $doc)
      	<div class="col-lg-4 col-sm-6 portfolio-item">
				<div class="card h-100">
					@if($doc->image == null)
					<img src="11.png">
					@else
					<img src="{{$doc->image}}">
					@endif
          			<div class="card-body">
            			<h4 class="card-title">
              				<a href="{{$doc->path}}">
							{{$doc->name}}
							</a>
            			</h4>
            			<p>{{$doc->description}}</p>
          			</div>
        		</div>
        </div>
		@endforeach	
        
    </div>
  </div>

	
@endsection