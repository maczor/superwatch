<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<p>{{ Lang::get('emails.Hi name,', array('name' => $input['wlname'])) }}</p>
		<p>{{ Lang::get('emails.Thank you for contacting me about the') }}</p>
		<ul>
		@foreach ($watches as $watch)
			<li><strong>{{ $watch->brandname }}</strong> {{ $watch->modelname }}, Ref. {{ $watch->reference }}</li>
		@endforeach
		</ul>
		<p>{{ Lang::get('emails.I will come back to you as soon as I can!') }}</p>
		<p>{{ Lang::get('emails.Your devoted') }} <span style="color: #006494;">SuperWatch</span>, Adrien Finkelstein</p>
		<div>
			 <img src="<?php echo $message->embed(public_path().'/img/sw.png'); ?>" width="82" height="157">
		</div>
		<h3 style="color: #006494;">SUPERWATCH</h3>
		<p>(+32) 2 319 89 90<br>
		<a href="mailto:contact@superwatch.be">contact@superwatch.be</a></p>
		<p>19 rue Lebeau<br>
		1000 Brussels<br>
		{{ Lang::get('emails.By appointment only') }}</p>
	</body>
</html>