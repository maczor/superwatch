<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		
		{{ Lang::get('home.Hi, Thank you Newsletter') }}
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