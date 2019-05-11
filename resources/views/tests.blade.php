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
				@if (1 === 1)
					<a href="{{$test->path}}">
						{{$test->name}}
					</a>
				@endif
			</p>
		</div>
	@endforeach	
</body>
</html>