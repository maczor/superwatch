@extends('layouts.master')
@section('pageclass')
home @stop
@section('menu2')
<div id="menu2">
	<div class="container">
		<a href="#home" class="scrolllnk"><div class="logo">SuperWatch</div></a>
		<ul class="mitems">
			<li class="menulnk home"><a href="#home">{{Lang::get('home.HOME')}}</a></li>
			<li class="menulnk watches"><a href="#watches">{{Lang::get('home.WATCHES')}}</a></li>
			<li class="menulnk guaranty‎"><a href="#guaranty‎">{{Lang::get('home.GUARANTEE')}}</a></li>
			<li class="menulnk philosophy"><a href="#philosophy">{{Lang::get('home.PHILOSOPHY')}}</a></li>
			<li class="menulnk sell"><a href="#sell">{{Lang::get('home.SELL MY WATCH')}}</a></li>
			<li class="menulnk contact"><a href="#contact">{{Lang::get('home.CONTACT')}}</a></li>
			<li class="wishlist"><a href="/{{ Config::get('application.language') }}/wishlist"><span class="wsicon wsicon-plus"></span> {{Lang::get('home.MY WISHLIST')}} 
				<span class="wishnum">@if(count(Session::get('wishlist'))) ({{count(Session::get('wishlist'))}}) @else (0) @endif</span></a></li>
			<li class="search"><input type="text" class="form-control watchsearch" placeholder="{{Lang::get('home.Search for a Watch')}}" /></li>
		</ul>
		<div class="marker"></div>
	</div>
</div>
@stop
@section('content')
<div id="topbg2"></div>
<div id="topbg"></div>
<section id="home">
	<div id="menu1">
		<div class="divider"></div>
		<div class="container">
			<div class="row">
				<!-- <div class="col-xs-2 langs"> -->
				<div class="col-xs-2">
					{{ LaravelLocalization::getLanguageBar(true) }}
				</div>
				<div class="col-xs-8 logo">
					<img src="/img/sw-logo.png" />
				</div>
				<div class="col-xs-2 share">
					<a href="#"><img src="/img/facebook.png" /></a><a href="#"><img src="/img/pinterest.png" /></a><a href="#"><img src="/img/email.png" /></a>
					<div class="text">
						{{ Lang::get('home.Help me help others') }}
					</div>
				</div>
			</div>
			<ul class="mitems">
				<li class="search"><input type="text" class="form-control watchsearch" placeholder="{{Lang::get('home.Search for a Watch')}}" /></li>
				<li class="menulnk home"><a href="#home">{{Lang::get('home.HOME')}}</a></li>
				<li class="menulnk watches"><a href="#watches">{{Lang::get('home.WATCHES')}}</a></li>
				<li class="menulnk guaranty‎"><a href="#guaranty‎">{{Lang::get('home.GUARANTEE')}}</a></li>
				<li class="menulnk philosophy"><a href="#philosophy">{{Lang::get('home.PHILOSOPHY')}}</a></li>
				<li class="menulnk sell"><a href="#sell">{{Lang::get('home.SELL MY WATCH')}}</a></li>
				<li class="menulnk contact"><a href="#contact">{{Lang::get('home.CONTACT')}}</a></li>
				<li class="wishlist"><a href="/{{ Config::get('application.language') }}/wishlist"><span class="wsicon wsicon-plus"></span> {{Lang::get('home.MY WISHLIST')}} <span class="wishnum">@if(count(Session::get('wishlist'))) ({{count(Session::get('wishlist'))}}) @else (0) @endif</span></a></li>
			</ul>
			<div class="marker"></div>
		</div>
	</div>
	<div class="welcome">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="superw"></div>
					<h2>{{Lang::get('home.Welcome to SUPERWATCH.be')}}</h2>
					<h1>{{Lang::get('home.The watch expert from space who came to help you find your dream watch !')}}</h1>
				</div>
			</div>
		</div>
	</div>
	<div class="brands">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<h3 class="white"><span class="hr"></span>{{ Lang::get('home.BRANDS IN STORE') }}<span class="hr"></span></h3>
					<div class="brands_available">
						<div id="left"></div>
						<div id="right"></div>
						<div class="caro">
							<div class="caro-inner" style="width: {{ $brands->count()*180 }}px">
							@foreach ($brands as $brand)
								@if ($brand->watches()->count())
									<div class="single" data-brand-id="{{ $brand->id }}" href="/{{Config::get('application.language')}}/brand/{{ $brand->id }}/{{ $brand->name }}">
										<div class="wrapper"><img src="/img/logo-w/{{ $brand->logo }}" width="{{ $brand->width*0.7 }}" height="{{ $brand->height*0.7 }}"></div>
										<div class="no">{{ $brand->watches()->count() }}</div>
									</div>
								@endif
							@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section id="watches">
	<div class="container">
		<div class="row">
			<div class="col-xs-2"></div>
			<div class="col-xs-8">
				<h3 class="white"><span class="hr"></span>{{ Lang::get('home.THE SUPER COLLECTION') }}<span class="hr"></span></h3>
			</div>
			<div class="col-xs-2">
				<select id="orderby_dir" name="orderby_dir" class="orderby selectpicker" data-width="100%" data-style="btn-xs btn-transp-w">
					<option value="created_at-desc" selected="selected">most recent</option>
					<option value="sellingprice-asc">price - low to high</option>
					<option value="sellingprice-desc">price - high to low</option>
					<option value="modelname-asc">A-Z</option>
					<option value="modelname-desc">Z-A</option>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-2 brands">
				<input type="text" class="form-control watchsearch" placeholder="{{ Lang::get('home.Search for a Watch') }}" />
				<h4>{{ Lang::get('home.Brands') }}</h4>
				<ul>
					<li class="active"><a data-brand-id="all" href="/{{Config::get('application.language')}}/getwatches/all">{{ Lang::get('home.All') }}</a></li>
					@foreach ($brands as $brand)
						@if ($brand->watches()->count())
							<li
								@if ($brand->name=="Others")
									 class="others"
								@endif
							><a data-brand-id="{{ $brand->id }}" href="/{{Config::get('application.language')}}/getwatches/{{ $brand->id }}/{{ $brand->name }}">{{ $brand->name }} ({{ $brand->watches()->count() }})</a></li>
						@endif
					@endforeach
				</ul>
			</div>
			<div class="col-xs-10 watchlist">
				@include('watches.single', ['watches'=>$watches])
			</div>
		</div>
		<div class="row">
			<div class="col-xs-2"></div>
			<div class="col-xs-10" style="text-align: center; padding-right: 31px; padding-top: 24px; padding-bottom: 50px;">
				<ul class="pager">
					<li id="prev"><a href="prev">« Previous</a></li>
					<li id="next"><a href="next">Next »</a></li>
				</ul>
			</div>
		</div>
	</div>
</section>
<section id="guaranty‎">
	<div class="container">
		<div class="row">
			<div class="col-xs-1"></div>
			<div class="col-xs-10">
				<h3 class="black"><span class="hr"></span>{{ Lang::get('home.GUARANTEE') }}<span class="hr"></span></h3>
				<p style="text-align:center;">{{ Lang::get('home.I certify') }}</p>
				<div class="row">
					<div class="col-xs-3 authentic">{{ Lang::get('home.100% Authentic') }}</div>
					<div class="col-xs-3 certificate">{{ Lang::get('home.Certified Origin') }}</div>
					<div class="col-xs-3 warranty">{{ Lang::get('home.12 Months Guarantee - for parts and labour') }}</div>
					<div class="col-xs-3 security">{{ Lang::get('home.Secure Shipping') }}</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section id="philosophy">
	<div class="container">
		<div class="col-xs-1"></div>
		<div class="col-xs-10">
			<h3 class="black"><span class="hr"></span>{{ Lang::get('home.PHILOSOPHY') }}<span class="hr"></span></h3>
			<div class="row">
				<div class="col-xs-3">
					<div class="sw"></div>
				</div>
				<div class="col-xs-9">
					{{ Lang::get('home.Dear collectors') }}
				</div>
			</div>
		</div>
	</div>
</section>
<section id="sell">
	<div class="container">
		<div class="row">
			<div class="col-xs-2"></div>
			<div class="col-xs-8">
				<h3 class="black"><span class="hr"></span>{{ Lang::get('home.I WANT TO SELL MY WATCH') }}<span class="hr"></span></h3>
				<p style="text-align:center;">{{ Lang::get('home.You want to sell your watch?') }}</p>
				<form id="watch-submit" class="form-horizontal col-sm-offset-1" method="POST" action="/sellmywatch" role="form" enctype="multipart/form-data" target="upload_target">
					<div class="form-group brand-select">
						<label for="brand" class="col-xs-4 control-label">{{ Lang::get('home.Brand') }}</label>
						<div class="col-xs-6">
							<select class="selectpicker2 show-tick input-sm" id="brand" name="brand" data-live-search="true" data-width="100%">
								<option>{{ Lang::get('home.choose a brand') }}</option>
									<option class="others" value="44">{{ Lang::get('home.Others') }}</option>
								@foreach ($brands as $brand)
										@unless ($brand->name=="Others")
											<option value="{{ $brand->name }}">{{ $brand->name }}</option>
										@endunless
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="model" class="col-xs-4 control-label">{{ Lang::get('home.Model') }}</label>
						<div class="col-xs-6">
							<input class="form-control input-sm" type="text" id="model" name="model" placeholder="{{ Lang::get('home.type here') }}" />
						</div>
					</div>
					<div class="form-group">
						<label for="age" class="col-xs-4 control-label">{{ Lang::get('home.Age') }}</label>
						<div class="col-xs-6">
							<input class="form-control input-sm" type="text" id="age" name="age" placeholder="{{ Lang::get('home.choose a year') }}" />
						</div>
					</div>
					<div class="form-group">
						<label for="papers" class="col-xs-4 control-label">{{ Lang::get('home.Original papers') }}</label>
						<div class="col-xs-6">
							<label class="radio-inline">
								<input type="radio" name="papers" value="yes"> {{ Lang::get('home.yes') }}
							</label>
							<label class="radio-inline">
								<input type="radio" name="papers" value="no" checked="checked"> {{ Lang::get('home.no') }}
							</label>
						</div>
					</div>
					<div class="form-group">
						<label for="box" class="col-xs-4 control-label">{{ Lang::get('home.Original box') }}</label>
						<div class="col-xs-6">
							<label class="radio-inline">
								<input type="radio" name="box" value="yes"> {{ Lang::get('home.yes') }}
							</label>
							<label class="radio-inline">
								<input type="radio" name="box" value="no" checked="checked"> {{ Lang::get('home.no') }}
							</label>
						</div>
					</div>
					<div class="form-group">
						<label for="price" class="col-xs-4 control-label">{{ Lang::get('home.Desired price') }}</label>
						<div class="col-xs-6">
							<input class="form-control input-sm" type="text" id="price" name="price" placeholder="{{ Lang::get('home.type here') }}" />
						</div>
					</div>
					<div class="form-group">
						<label for="phone" class="col-xs-4 control-label">{{ Lang::get('home.Phone') }}</label>
						<div class="col-xs-6">
							<input class="form-control input-sm" type="text" id="phone" name="phone" placeholder="{{ Lang::get('home.your phone number') }}" />
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-xs-4 control-label">Email</label>
						<div class="col-xs-6">
							<input class="form-control input-sm" type="text" id="email" name="email" placeholder="{{ Lang::get('home.your e-mail address') }}" />
						</div>
					</div>
					<div class="form-group">
						<label for="pictures" class="col-xs-4 control-label">{{ Lang::get('home.Pictures') }}</label>
						<div class="col-xs-6">
							<div class="pictures-selected">
								<div class="info">{{ Lang::get('home.Files selected:') }}</div>
								<ul id="pictures-list"></ul>
							</div>
							<input class="form-control btn btn-primary" name="filesToUpload[]" id="filesToUpload" type="file" multiple="" />
							<button id="pictures-upload" class="form-control btn btn-primary">{{ Lang::get('home.upload - your picture') }}</button>
						</div>
					</div>
<!-- 					<div class="form-group">
						<label for="pictures" class="col-xs-4 control-label">{{ Lang::get('home.Pictures') }}</label>
						<div class="col-xs-6">
							<button id="pictures-upload" class="form-control btn btn-primary">{{ Lang::get('home.upload - your picture') }}</button>
						</div>
					</div>
 -->					<div class="form-group">
						<label class="col-xs-4 control-label"></label>
						<div class="col-xs-6">
							<div id="sell-info"></div>
							<button type="submit" class="btn btn-lg btn-primary">{{ Lang::get('home.SEND') }} <span class="glyphicon glyphicon-chevron-right"></span></button>
						</div>
					</div>
				</form>
				<iframe id="upload_target" name="upload_target" src="" style="width:0;height:0;border:0px solid #fff;"></iframe>
			</div>
		</div>
	</div>
</section>
<section id="brands">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<h3 class="black"><span class="hr"></span>{{ Lang::get('home.THE BRANDS') }}<span class="hr"></span></h3>
				<div class="row">
					@foreach ($brands as $brand)
						<div class="single
						@if ($brand->watches()->count()>0)
						 lnk 
						@endif
						" data-count="{{ $brand->watches()->count() }}" data-brand-id="{{ $brand->id }}" href="/{{Config::get('application.language')}}/brand/{{ $brand->id }}/{{ $brand->name }}">
							<img src="/img/logo-b/{{ $brand->logo }}" width="{{ $brand->width*0.5 }}" height="{{ $brand->height*0.5 }}">
							<div class="no">{{ $brand->watches()->count() }}</div>
						</div>
					@endforeach
				</div>
			</div>
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
				<p><a href="#" class="conditions">{{ Lang::get('home.Terms & Conditions') }}</a></p>
			</div>
		</div>
	</div>
</section>
<div id="bottombg"></div>
<div id="bottombg2"></div>
@stop
@section('modals')
<div id="contactModal" class="modal fade" data-keyboard="true" role="dialog" aria-hidden="true" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-top">
			<div class="cleft"></div>
			<div class="cmid"></div>
			<div class="cright"></div>
		</div>
		<div class="modal-main">
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
<div id="conditionsModal" class="modal fade" data-keyboard="true" role="dialog" aria-hidden="true" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-top">
			<div class="cleft"></div>
			<div class="cmid"></div>
			<div class="cright"></div>
		</div>
		<div class="modal-main">
			<div class="wrapper">
				<h4>{{ Lang::get('conditions.title') }}</h4>
				<div class="hrsm"></div>
				<div class="modal-body"></div>
			</div>
		</div>
	</div>
</div>
@stop