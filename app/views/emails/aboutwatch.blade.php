<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h4>The client requests contact about the watch:</h4>
		<p><strong>{{ $cbrand }}</strong> {{ $cmodel }}, Ref. {{ $creference }}</p>
		<h4>More details:</h4>
		<p>Name: {{$cname}}</p>
		<p>Email: {{$cemail}}</p>
		<p>Phone: {{$cphone}}</p>
		<p>Message: {{$ctext}}</p>
	</body>
</html>