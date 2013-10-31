@extends('layouts.master')
@section('javascript')
App.Options.section = 'watches';
@stop
@section('pageclass')
wishlist @stop
@section('content')
<section id="watches">
	<div id="menu2">
		<div class="container">
			<div class="logo">SuperWatch</div>
			<ul class="mitems">
				<li class="menulnk home"><a href="/{{ Session::get('language') }}/##home">{{Lang::get('home.HOME')}}</a></li>
				<li class="menulnk watches"><a href="/{{ Session::get('language') }}/##watches">{{Lang::get('home.WATCHES')}}</a></li>
				<li class="menulnk guaranty‎"><a href="/{{ Session::get('language') }}/##guaranty‎">{{Lang::get('home.GUARANTEE')}}</a></li>
				<li class="menulnk philosophy"><a href="/{{ Session::get('language') }}/##philosophy">{{Lang::get('home.PHILOSOPHY')}}</a></li>
				<li class="menulnk sell"><a href="/{{ Session::get('language') }}/##sell">{{Lang::get('home.SELL MY WATCH')}}</a></li>
				<li class="menulnk contact"><a href="#contact">{{Lang::get('home.CONTACT')}}</a></li>
				<li class="wishlist"><a href="#"><span class="wsicon wsicon-plus"></span> {{Lang::get('home.MY WISHLIST')}} <span class="wishnum">@if(count(Session::get('wishlist'))) ({{count(Session::get('wishlist'))}}) @else (0) @endif</span></a></li>
				<li class="search"><input type="text" class="watchsearch" placeholder="{{Lang::get('home.Search for a Watch')}}" /></li>
			</ul>
			<div class="marker"></div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="wlwrapper">
				<h3 class="white"><span class="hr"></span>{{ Lang::get('home.MY WISHLIST') }}<span class="hr"></span></h3>
				<div class="th watches">WATCHES</div>
				<div class="th price">PRICE</div>
				<div class="th remove">REMOVE</div>
				@foreach($watches as $watch)
				<div class="wlsingle">
					<div class="wlimg"><a href="/{{Config::get('application.language')}}/watch/{{ $watch->id }}"><img src="/uploaded/files/176/{{ $watch->images[0]->filename }}"></a></div>
					<div class="wlmain">
						<div class="brandmodel"><strong>{{ $watch->brandname }}</strong> {{ $watch->modelname }}</div>
						<div class="desc">{{ $watch->descriptions->{Config::get('application.language')} }}</div>
						<div class="logo"><img src="/img/logo-b/{{ $watch->logo }}" width="{{ $watch->width*0.6 }}" height="{{ $watch->height*0.6 }}"></div>
						<div class="contactbtns">
							<div class="btncontact" data-watch-ref="{{$watch->reference}}" data-watch-brand="{{$watch->brandname}}" data-watch-model="{{$watch->modelname}}">
								<div class="contact-top">
									<div class="cleft"></div>
									<div class="cmid"></div>
									<div class="cright"></div>
								</div>
								<div class="contact-main">
									<div class="wrapper">
										<span class="wsicon wsicon-eclair-w"></span>
										{{ Lang::get('home.CONTACT ME ABOUT THIS WATCH') }}
									</div>
								</div>
							</div>
							<button class="btn facebook"></button>
							<button class="btn pinterest"></button>
							<button class="btn email"></button>
						</div>
					</div>
					<div class="wlprice">{{ $watch->sellingprice }}€</div>
					<div class="wlremove">
						<a class="btn btn-transp btn-lg" href="/removefromwishlist/{{ $watch->id }}">
							<span class="glyphicon glyphicon-remove"></span>
						</a>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</section>
<section id="contact">
	<div class="container">
		<div class="row">
			<div class="wlwrapper wlcontact">
				<div class="btncontact" data-watch-ref="{{$watch->reference}}" data-watch-brand="{{$watch->brandname}}" data-watch-model="{{$watch->modelname}}">
					<div class="contact-top">
						<div class="cleft"></div>
						<div class="cmid"></div>
						<div class="cright"></div>
					</div>
					<div class="contact-main">
						<div class="wrapper">
							{{ Lang::get('home.CONTACT ME ABOUT THESE WATCHES') }}
						</div>
					</div>
				</div>
				<div class="wlcontactform">
					<div class="row">
						<div class="col-xs-4 info">
							<p>{{ Lang::get('home.contact watches') }}</p>
							<button class="btn btn-primary btn-lg send">SEND</button>
						</div>
						<div class="col-xs-8">
							<form id="contact-wishlist" role="form">
								<div class="row">
									<div class="col-xs-5">
										<div class="form-group">
											<label for="wlname">{{ Lang::get('home.Name') }}</label>
											<input type="text" class="form-control" id="wlname" name="wlname" placeholder="">
										</div>
										<div class="form-group">
											<label for="wlemail">{{ Lang::get('home.Email') }}</label>
											<input type="text" class="form-control" id="wlemail" name="wlemail" placeholder="">
										</div>
										<div class="form-group">
											<label for="wlphone">{{ Lang::get('home.Phone') }}</label>
											<input type="text" class="form-control" id="wlphone" name="wlphone" placeholder="">
										</div>
									</div>
									<div class="col-xs-7">
										<div class="form-group">
											<label for="wltext">{{ Lang::get('home.Your message') }}</label>
											<textarea type="text" class="form-control" id="wltext" name="wltext" placeholder=""></textarea>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
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
@stop
@section('modals')
<div id="contactModal" class="modal fade">
	<div class="modal-dialog">
		<div class="contact-top">
			<div class="cleft"></div>
			<div class="cmid"></div>
			<div class="cright"></div>
		</div>
		<div class="contact-main">
			<div class="wrapper">
				<h4>{{ Lang::get('home.CONTACT ME ABOUT THIS WATCH') }}</h4>
				<div class="hrsm"></div>
				<form id="contact-watch" role="form">
					<input type="hidden" name="creference">
					<input type="hidden" name="cbrand">
					<input type="hidden" name="cmodel">
					<div class="row">
						<div class="col-xs-5">
							<div class="form-group">
								<label for="cname">{{ Lang::get('home.Name') }}</label>
								<input type="text" class="form-control" id="cname" name="cname" placeholder="">
							</div>
							<div class="form-group">
								<label for="cemail">{{ Lang::get('home.Email') }}</label>
								<input type="text" class="form-control" id="cemail" name="cemail" placeholder="">
							</div>
							<div class="form-group">
								<label for="cphone">{{ Lang::get('home.Phone') }}</label>
								<input type="text" class="form-control" id="cphone" name="cphone" placeholder="">
							</div>
						</div>
						<div class="col-xs-7">
							<div class="form-group">
								<label for="ctext">{{ Lang::get('home.Your message') }}</label>
								<textarea type="text" class="form-control" id="ctext" name="ctext" placeholder=""></textarea>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 center">
							<button class="btn btn-primary">{{ Lang::get('home.Send message') }}</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@stop