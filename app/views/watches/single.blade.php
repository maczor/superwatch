@foreach($watches as $watch)
<div class="sw">
	<div class="img">
		<div class="details" data-watch-id="{{$watch->id}}" data-watch-name="{{AppHelper::url_slug($watch->brandname.' '.$watch->modelname)}}" data-collection-order="">
			<div class="bg"></div>
			<div class="wrapper">
				<div class="share">
					<a href="#" class="pinterest"></a>
					<a href="#" class="facebook"></a>
					<a href="#" class="email"></a>
				</div>
				<strong>{{ Lang::get('home.Movement') }} :</strong> {{ $watch->movementname }}<br />
				<strong>{{ Lang::get('home.Case') }} :</strong> {{ $watch->caseboxname }}<br />
				<strong>{{ Lang::get('home.Band') }} :</strong> {{ $watch->bandname }}<br />
				<strong>{{ Lang::get('home.Size') }} :</strong> {{ $watch->size }}<br />
				<strong>{{ Lang::get('home.Buckle') }} :</strong> {{ $watch->bucklename }}<br />
				<strong>{{ Lang::get('home.Year') }} :</strong> {{ $watch->year }}<br />
				<strong>{{ Lang::get('home.Original papers') }} :</strong> {{ Lang::get('home.'.$watch->papername) }}<br />
				<strong>{{ Lang::get('home.Original box') }} :</strong> {{ Lang::get('home.'.$watch->box) }}
				<div class="contact">
					<button class="btn btn-xs btn-black contactaboutwatch" data-watch-ref="{{$watch->reference}}" data-watch-brand="{{$watch->brandname}}" data-watch-model="{{$watch->modelname}}"><span class="wsicon wsicon-eclair-w"></span> {{ Lang::get('home.CONTACT') }}</button>
					@if(array_search($watch->id, Session::get('wishlist'))===false)
						<button class="btn btn-xs btn-transp addtowishlist" data-watch-id="{{$watch->id}}"><span class="wsicon wsicon-plus-b"></span> {{ Lang::get('home.ADD TO WISHLIST') }}</button>
					@endif
				</div>
			</div>
		</div>
		<img src="/uploaded/files/235/{{ $watch->images[0]->filename }}" />
	</div>
	<h4 class="name"><strong>{{ $watch->brandname }}</strong> {{ $watch->modelname }}
		<span class="price">
			@if($watch->sellingprice)
				{{$watch->sellingprice}}€
			@else
				{{ Lang::get('home.CONTACT ME') }}
			@endif
		</span>
	</h4>
</div>
@endforeach
<div class="sw">
	<div class="contactbox">
		<p>{{ Lang::get('home.Didn’t find the model you were looking for ? Ask me !') }}</p>
		<div class="inputs">
			<input id="cbname" type="text" class="form-control input-sm" placeholder="{{ Lang::get('home.Name') }}">
			<textarea id="cbmessage" class="form-control" rows="3" placeholder="{{ Lang::get('home.Write here') }}"></textarea>
			<div class="input-group">
				<input id="cbemail" type="text" class="form-control input-sm" placeholder="{{ Lang::get('home.your e-mail address') }}" />
				<span class="input-group-addon input-sm">OK</span>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
if (window.jQuery) {
	App.Vars.Pcurrent = {{ $watches->getCurrentPage() }};
	App.Vars.Ptotal = {{ $watches->getLastPage() }};
	$.setupPlinks();
		@if(Session::get("kind")=="all")
			$.setWatchesList('{{ Session::get("kind") }}');
		@else
			$.setWatchesList('{{ Session::get("brand_id") }}');
		@endif
};
</script>
@section('javascript')
$(document).ready(function($) {
	App.Vars.Pcurrent = {{ $watches->getCurrentPage() }};
	App.Vars.Ptotal = {{ $watches->getLastPage() }};
	$.setupPlinks();
	
		@if(Session::get("kind")=="all")
			$.setWatchesList('{{ Session::get("kind") }}');
		@else
			$.setWatchesList('{{ Session::get("brand_id") }}');
		@endif
});
@stop