@extends('layouts.master')
@section('javascript')
App.Options.section = 'watches';
$.setWatchesList();
@stop
@section('pageclass')
show @stop
@section('content')
<section id="watches">
	<div id="menu2">
		<div class="container">
			<a href="#home" class="scrolllnk"><div class="logo">SuperWatch</div></a>
			<ul class="mitems">
				<li class="menulnk home"><a href="/{{ Session::get('language') }}/?section=home">{{Lang::get('home.HOME')}}</a></li>
				<li class="menulnk watches"><a href="/{{ Session::get('language') }}/?watches=all">{{Lang::get('home.WATCHES')}}</a></li>
				<li class="menulnk guaranty‎"><a href="#guaranty‎">{{Lang::get('home.GUARANTEE')}}</a></li>
				<li class="menulnk philosophy"><a href="/{{ Session::get('language') }}/?section=philosophy">{{Lang::get('home.PHILOSOPHY')}}</a></li>
				<li class="menulnk sell"><a href="/{{ Session::get('language') }}/?section=sell">{{Lang::get('home.SELL MY WATCH')}}</a></li>
				<li class="menulnk contact"><a href="#contact">{{Lang::get('home.CONTACT')}}</a></li>
				<li class="wishlist"><a href="/{{ Config::get('application.language') }}/wishlist"><span class="wsicon wsicon-plus"></span> {{Lang::get('home.MY WISHLIST')}} 
				<span class="wishnum">@if(count(Session::get('wishlist'))) ({{count(Session::get('wishlist'))}}) @else (0) @endif</span></a></li>
				<li class="search"><input type="text" class="watchsearch" placeholder="{{Lang::get('home.Search for a Watch')}}" /></li>
			</ul>
			<div class="marker"></div>
		</div>
	</div>
	<div class="container">
		<div class="row main_info">
			<p><a href="/{{ Session::get('language') }}/?watches=go" class="back">BACK</a></p>
			@if($current>0)
				<a href="
				/{{ Session::get('language') }}/watch/{{ Session::get('watchesall')[$current-1]->id }}?{{ AppHelper::url_slug(Session::get('watchesall')[$current-1]->brandname) }}-{{ AppHelper::url_slug(Session::get('watchesall')[$current-1]->modelname) }}
				"><div class="left"></div></a>
			@else
				<div class="left empty"></div>
			@endif
			<div class="brandname">
				<div class="brand">{{ $brandslist[$watch->brand_id] }}</div>
				<div class="name">{{ $modelslist[$watch->model_id] }}</div>
			</div>
			<div class="logo"><img src="/img/logo-w/{{ $brands[$watch->brand_id-1]->logo }}" width="{{ $brands[$watch->brand_id-1]->width*0.9 }}" height="{{ $brands[$watch->brand_id-1]->height*0.9 }}"></div>
			<div class="pricewish">
				<div class="price">
					@if($watch->sellingprice)
						{{number_format($watch->sellingprice, 0, ',', ' ')}}€
					@else
						{{ Lang::get('home.CONTACT ME') }}
					@endif
				</div>
				<div class="addtowishlist" data-watch-id="{{ $watch->id }}">+ {{ Lang::get('home.ADD TO WISHLIST') }}</div>
			</div>
			@if($current<count(Session::get('watchesall'))-1)
				<a href="
				/{{ Session::get('language') }}/watch/{{ Session::get('watchesall')[$current+1]->id }}?{{ AppHelper::url_slug(Session::get('watchesall')[$current+1]->brandname) }}-{{ AppHelper::url_slug(Session::get('watchesall')[$current+1]->modelname) }}
				"><div class="right"></div></a>
			@else
				<div class="right empty"></div>
			@endif
		</div>
		<div class="row watch">
			<div class="first showprev" data-index="0">
				<img src="/uploaded/files/{{ $watch->images[0]->filename }}" width="456" height="456" />
			</div>
			@if (isset($watch->images[1]))
			<div class="second showprev" data-index="1">
					<img src="/uploaded/files/235/{{ $watch->images[1]->filename }}" width="224" height="224" />
			</div>
			@else
			<div class="second" data-index="1">
			</div>
			@endif
			<div class="third">
				<strong>{{ Lang::get('home.Movement') }} :</strong> {{ $movements[$watch->movement_id] }}<br />
				<strong>{{ Lang::get('home.Case') }} :</strong> {{ $caseboxes[$watch->casebox_id] }}<br />
				<strong>{{ Lang::get('home.Band') }} :</strong> {{ $bands[$watch->band_id] }}<br />
				<strong>{{ Lang::get('home.Size') }} :</strong> {{ $watch->size }}<br />
				<strong>{{ Lang::get('home.Buckle') }} :</strong> {{ $buckles[$watch->buckle_id] }}<br />
				<strong>{{ Lang::get('home.Year') }} :</strong> {{ $watch->year }}<br />
				<strong>{{ Lang::get('home.Original papers') }} :</strong> {{ Lang::get('home.'.$papers[$watch->paper_id]) }}<br />
				<strong>{{ Lang::get('home.Original box') }} :</strong> {{ Lang::get('home.'.$watch->box) }}
			</div>
			<div class="fourth">
				<strong>Ref. {{ $watch->reference }}</strong>
				{{ $watch->descriptions->{Config::get('application.language')} }}
				<div class="more_info">
					<div class="brandmodel">
						<div class="brand">{{ $brandslist[$watch->brand_id] }}</div>
						<div class="model">{{ $modelslist[$watch->model_id] }}</div>
					</div>
					<div class="price">
						@if($watch->sellingprice)
							{{number_format($watch->sellingprice, 0, ',', ' ')}}€
						@else
							{{ Lang::get('home.CONTACT ME') }}
						@endif
					</div>
					<div class="contactbtns">
						<div class="btncontact" data-watch-ref="{{$watch->reference}}" data-watch-brand="{{$brandslist[$watch->brand_id]}}" data-watch-model="{{$modelslist[$watch->model_id]}}">
							<div class="contact-top">
								<div class="cleft"></div>
								<div class="cmid"></div>
								<div class="cright"></div>
							</div>
							<div class="contact-main">
								<div class="wrapper">
									<!-- <span class="wsicon wsicon-eclair-w"></span> -->
									{{ Lang::get('home.CONTACT ME ABOUT THIS WATCH') }}
								</div>
							</div>
						</div>
						<button class="btn addtowishlist" data-watch-id="{{ $watch->id }}"></button>
						<button class="btn facebook"></button>
						<button class="btn pinterest"></button>
						<button class="btn email"></button>
					</div>
				</div>
			</div>
			@if (isset($watch->images[2]))
				<div class="fifth showprev" data-index="2">
					<img src="/uploaded/files/235/{{ $watch->images[2]->filename }}" width="224" height="224" />
				</div>
			@endif
			@if (isset($watch->images[3]))
				<div class="sixth showprev" data-index="3">
					<img src="/uploaded/files/235/{{ $watch->images[3]->filename }}" width="224" height="224" />
				</div>
			@endif
			@if (isset($watch->images[5]))
				<div class="eight showprev" data-index="5">
					<img src="/uploaded/files/{{ $watch->images[5]->filename }}" width="456" height="456" />
				</div>
			@else
				<div class="spacer"></div>
			@endif
			@if (isset($watch->images[4]))
				<div class="seventh showprev" data-index="4">
					<img src="/uploaded/files/{{ $watch->images[4]->filename }}" width="456" height="456" />
				</div>
			@endif
			@if (isset($watch->images[6]))
				<div class="ninth showprev" data-index="6">
					<img src="/uploaded/files/235/{{ $watch->images[6]->filename }}" width="224" height="224" />
				</div>
			@endif
			@if (isset($watch->images[7]))
				<div class="tenth showprev" data-index="7">
					<img src="/uploaded/files/235/{{ $watch->images[7]->filename }}" width="224" height="224" />
				</div>
			@endif
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
<section id="brands">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<h3 class="black"><span class="hr"></span>{{ Lang::get('home.THE BRANDS') }}<span class="hr"></span></h3>
				<div class="row">
					@foreach ($brands as $brand)
						<div class="single">
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
<div id="lightboxModal" class="modal fade" data-keyboard="true" role="dialog" aria-hidden="true" tabindex="-1">
	<div class="prevclose"></div>
	<div class="modal-dialog">
		<div class="lightboxWrapper">
			@foreach ($watch->images as $image)
				<div class="preview"><img src="/uploaded/files/{{ $image->filename }}"></div>
			@endforeach
		</div>
	</div>
</div>
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
<section id="debug">
	{{ Session::get("kind_input")["brand_id"] }}
</section>
@stop