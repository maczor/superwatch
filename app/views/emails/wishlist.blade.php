<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h4>The client requests contact about this watches:</h4>
		<ul>
		@foreach ($watches as $watch)
			<li><strong>{{ $watch->brandname }}</strong> {{ $watch->modelname }}, Ref. {{ $watch->reference }}</li>
		@endforeach
		</ul>
		<h4>Client details:</h4>
		<p>Name: {{$input['wlname']}}</p>
		<p>Email: {{$input['wlemail']}}</p>
		<p>Phone: {{$input['wlphone']}}</p>
		<p>Message: {{$input['wltext']}}</p>
	</body>
</html>