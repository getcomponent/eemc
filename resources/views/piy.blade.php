<!DOCTYPE html>
<html>
<head>
	<title>PIY</title>
</head>
<body>
	@foreach($docs as $doc)
		<div>
			<img src="{{$doc->image}}">
			<p>
				<a href="{{$doc->path}}">
					{{$doc->name}}
				</a>
			</p>
			<p>{{$doc->description}}</p>
		</div>
	@endforeach	
</body>
</html>