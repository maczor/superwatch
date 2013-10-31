@extends('layouts.master')
@section('content')

				@foreach ($brands as $brand)
					<div class="" style="border-bottom: solid 1px white; padding:10px;"><span style="display: inline-block; width: 200px;">{{ $brand->name }}</span> <img src="img/logo-w/{{ $brand->logo }}"></div>
				@endforeach
@stop