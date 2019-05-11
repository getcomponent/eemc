<!DOCTYPE html>
<html>
<head>
	<title>PIY</title>
</head>
<body>
	@foreach($tests as $test)
		<div>
			<img src="{{$test->image}}">
			<p>
				@if ($test->id <= $lastPassed + 1)
					<a href="{{$test->path}}">
						{{$test->name}}
					</a>
				@else 
					{{$test->name}}
				@endif
			</p>
		</div>
	@endforeach	
</body>
</html>