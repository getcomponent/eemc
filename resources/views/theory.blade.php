@extends('base')
@section('content')
<p>PIY</p>
	@foreach($tests as $test)
		<div>
			<img src="{{$test->image}}">
			<p>
				@if ($test->id <= $lastPassed + 1)
					<a href="tests/{{$test->path}}">
						{{$test->name}}
					</a>
				@else 
					{{$test->name}}
				@endif
			</p>
		</div>
	@endforeach	
@endsection