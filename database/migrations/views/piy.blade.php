<!DOCTYPE html>
<html>
<head>
	<title>PIY</title>
</head>
<body>
		@foreach($docs as $doc)
			<div>
				<a href="{{$doc->path}}" download>
				{{$doc->name}}
				</a>
			</div>
		@endforeach	
</body>
</html>