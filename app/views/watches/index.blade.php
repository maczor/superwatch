@extends('layouts.masteradmin')
@section('navi')
	<button class="btn btn-default" onmouseover="$('.color-codes').removeClass('hidden');" onmouseout="$('.color-codes').addClass('hidden');">Color codes <span class="glyphicon glyphicon-info-sign"></span></button>
	<div class="col-sm-1 color-codes hidden" style="position:absolute; z-index:10;">
		<h3>
			<span class="label label-info">Not published</span><br>
			<span class="label label-default">In repair</span><br>
			<span class="label label-success">To Sell</span><br>
			<span class="label label-warning">Reserved</span><br>
			<span class="label label-danger">Sold</span>
		</h3>
	</div>
@stop
@section('content')
<table class="list table table-bordered table-striped table-condensed table-hover">
<thead>
	<tr>
		<th>ID</th>
		<th></th>
		<th>BRAND</th>
		<th>MODEL</th>
		<th>YEAR</th>
		<th>REFERENCE</th>
		<th>S. PRICE</th>
		<th class="invisible4user">S. DATE</th>
		<th class="invisible4user">B. PRICE</th>
		<th class="invisible4user">B. DATE</th>
		<th class="invisible4user">PAYMENT M.</th>
		<th>STATUS</th>
		<th></th>
	</tr>
</thead>
<tbody>
@foreach ($watches as $watch)
	<tr>
		<td>
			{{ $watch->id }}
		</td>
		<td class="thumb">
			<a href="/watches/{{ $watch->id }}/edit">
			@foreach ($watch->images as $image)
				{{ HTML::image('/uploaded/files/xs/'.$image->filename, '', ['width'=>'30', 'height'=>'30']) }}
			@endforeach
			</a>
		</td>
		<td>
			{{ $brand[$watch->brand_id] }}
		</td>
		<td>
			{{ $model[$watch->model_id] }}
		</td>
		<td>
			{{ $watch->year }}
		</td>
		<td>
			{{ $watch->reference }}
		</td>
		<td>
			{{ $watch->sellingprice }} &euro;
		</td>
		<td>
			{{ $watch->sellingdate }}
		</td>
		<td>
			{{ $watch->buyingprice }} &euro;
		</td>
		<td>
			{{ explode(' ', $watch->created_at)[0] }}
		</td>
		<td class="sel">
			{{ Form::select('payment_id', $payment, $watch->payment_id, ['class'=>'sel_payment', 'data-style'=>'btn-0', 'data-watchid' => $watch->id]) }}
		</td>
		<td class="sel">
			{{ Form::select('status_id', $status, $watch->status_id, ['class'=>'sel_status', 'data-style'=>'btn-'.$watch->status_id, 'data-watchid' => $watch->id]) }}
		</td>
		<td>
			<a href="/watches/{{ $watch->id }}/edit">Edit <span class="glyphicon glyphicon-edit"></span></a>
		</td>
	</tr>
@endforeach
</tbody>
</table>
@stop