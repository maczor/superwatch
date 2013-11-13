{{ Lang::get('conditions.intro') }}
@for ($i = 1; $i < 15; $i++)
	<div class="title" data-open="text{{$i}}">{{ Lang::get('conditions.title'.$i) }}<span class="swicon-open"></span></div>
	<div id="text{{$i}}" class="text">{{ Lang::get('conditions.text'.$i) }}</div>
@endfor