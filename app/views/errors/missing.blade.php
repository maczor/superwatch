@extends('layouts.master')
@section('javascript')
App.Options.section = 'watches';
@stop
@section('pageclass')
missing @stop
@section('content')
<section id="watches">
	<div id="menu2">
		<div class="container">
			<div class="logo">SuperWatch</div>
			<ul class="mitems">
				<li class="menulnk home"><a href="/{{ Session::get('language') }}/#home">{{Lang::get('home.HOME')}}</a></li>
				<li class="menulnk watches"><a href="#watches">{{Lang::get('home.WATCHES')}}</a></li>
				<li class="menulnk guaranty‎"><a href="#guaranty‎">{{Lang::get('home.GUARANTEE')}}</a></li>
				<li class="menulnk philosophy"><a href="/{{ Session::get('language') }}/#philosophy">{{Lang::get('home.PHILOSOPHY')}}</a></li>
				<li class="menulnk sell"><a href="/{{ Session::get('language') }}/#sell">{{Lang::get('home.SELL MY WATCH')}}</a></li>
				<li class="menulnk contact"><a href="#contact">{{Lang::get('home.CONTACT')}}</a></li>
				<li class="wishlist"><a href="#"><span class="wsicon wsicon-plus"></span> {{Lang::get('home.MY WISHLIST')}}</a></li>
				<li class="search"><input type="text" class="menusearch" placeholder="{{Lang::get('home.Search for a Watch')}}" /></li>
			</ul>
			<div class="marker"></div>
		</div>
	</div>
	<div class="container">
		<div class="col-xs-12 main">
			<img src="/img/404.png" alt="404" />
			<h3>{{ Lang::get('home.Oops !  You’re lost in Space !') }}</h3>
			<button class="btn btn-primary">GO BACK HOME</button>
		</div>
	</div>
</section>
<section id="contact">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<h3 class="black"><span class="hr"></span>{{ Lang::get('home.CONTACT') }}<span class="hr"></span></h3>				
			</div>
		</div>
		<div class="row">
			<div class="col-xs-4 location">
				<img class="icon" src="/img/location.png">
				<h5>SUPERWATCH</h5>
				<p>{{ Lang::get('home.By appointment only') }}</p>
			</div>
			<div class="col-xs-4 newsletter">
				<img class="icon" src="/img/newsletter.png">
				<p>{{ Lang::get('home.Subscribe to the Newsletter here') }}</p>
				<div class="input-group">
					<input id="nemail" type="text" class="form-control input-sm" placeholder="{{ Lang::get('home.your e-mail address') }}" />
					<span class="input-group-addon input-sm">OK</span>
				</div>
				<a href="#" class="faceinsta"><img src="/img/facebook2.png"></a><a href="#" class="faceinsta"><img src="/img/instagram.png"></a>
				<p>{{ Lang::get('home.Or follow me on social networks !') }}</p>
				<img class="pin" src="/img/pin_map.png" />
			</div>
			<div class="col-xs-4 available">
					<img class="icon" src="/img/available.png">
				<p>{{ Lang::get('home.Looking for a watch?') }}</p>
				<h5>(+32) 2 319 89 90</h5>
				<a href='mailt&#111;&#58;&#99;ont&#97;c%&#55;4%40s%75%&#55;&#48;e&#114;w%&#54;&#49;tc%&#54;8%2E&#98;%6&#53;'>&#99;ont&#97;c&#116;&#64;&#115;&#117;perwatch&#46;b&#101;</a>
			</div>
		</div>
	</div>
	<div class="frame"></div>
	<div class="planets"></div>
	<div class="footer">
		<div class="bg"></div>
		<div class="container">
			<div class="col-xs-3 copy">
				<p>&copy; SuperWatch 2013</p>
				<h6>{{ Lang::get('home.Website by') }} <a href="http://www.arts-square.com" target="_blank">Arts Square</a></h6>
			</div>
			<div class="col-xs-6 logo">
				<img src="/img/sw-logo-s.png" />
			</div>
			<div class="col-xs-3 upconditions">
				<a href="#top" id="up"><h6><span class="glyphicon glyphicon-arrow-up"></span> {{ Lang::get('home.TOP') }}</h6></a>
				<p><a href="#">{{ Lang::get('home.Terms & Conditions') }}</a></p>
			</div>
		</div>
	</div>
</section>
<div id="bottombg"></div>
<div id="bottombg2"></div>
@stop