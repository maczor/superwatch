@extends('layouts.masteradmin')
@section('langs')
	{{ Form::button('EN', ['class'=>'btn btn-default btn-primary changelang en', 'data-langto'=>'en']) }}
	{{ Form::button('FR', ['class'=>'btn btn-default changelang fr', 'data-langto'=>'fr']) }}
@stop
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
<div class="row">
	{{ Form::model($watch, ['id'=>'update_form', 'route' => ['watches.update', $watch->id], 'method' => 'PUT', 'class'=>'form-horizontal', 'role'=>'form']) }}
	{{ Form::hidden('watchid', $watch->id) }}
	<div class="col-md-6">
		<div class="row">
			<div class="form-group">
				{{ Form::label('model' ,'<!--:en-->MODEL<!--:fr-->MODÈLE', ['id'=>'model_label', 'class'=>'langspl col-md-4 control-label']) }}
					<button id="addmodel" class="btn btn-success"><b class="glyphicon glyphicon-plus"></b></button>
				<div class="col-md-6">
					{{ Form::select('model_id', $model, $watch->model_id, ['class'=>'selectpicker', 'data-width'=>'100%', 'data-live-search'=>'true']) }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('brand' ,'<!--:en-->BRAND<!--:fr-->MARQUE', ['id'=>'brand_label', 'class'=>'langspl col-md-4 control-label']) }}
				<div class="col-md-6">
					{{ Form::select('brand_id', $brand, $watch->brand_id, ['class'=>'selectpicker', 'data-width'=>'100%', 'data-live-search'=>'true']) }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('year', '<!--:en-->Year<!--:fr-->ANNÉE', ['id'=>'year_label', 'class'=>'langspl col-md-4 control-label']) }}
				<div class="col-md-6">
					{{ Form::text('year', $watch->year, ['class'=>'form-control']) }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('reference' ,'<!--:en-->REFERENCE<!--:fr-->RÉFÉRENCE', ['id'=>'reference_label', 'class'=>'langspl col-md-4 control-label']) }}
				<div class="col-md-6">
					{{ Form::text('reference', $watch->reference, ['class'=>'form-control']) }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('sellingprice', '<!--:en-->SELLING PRICE<!--:fr-->PRIX DE VENTE', ['id'=>'sellingprice_label', 'class'=>'langspl col-md-4 control-label']) }}
				<div class="col-md-6">
					{{ Form::text('sellingprice', $watch->sellingprice, ['class'=>'form-control']) }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('buyingprice', '<!--:en-->BUYING PRICE<!--:fr-->PRIX D’ACHAT', ['id'=>'buyingprice_label', 'class'=>'langspl col-md-4 control-label']) }}
				<div class="col-md-6">
					{{ Form::text('buyingprice', $watch->buyingprice, ['class'=>'form-control']) }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('movement' ,'<!--:en-->MOVEMENT<!--:fr-->MOUVEMENT', ['id'=>'movement_label', 'class'=>'langspl col-md-4 control-label']) }}
				<div class="col-md-6">
					{{ Form::select('movement_id', $movement, $watch->movement_id, ['id'=>'movement_id', 'class'=>'selectpicker', 'data-width'=>'100%']) }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('casebox' ,'<!--:en-->CASE<!--:fr-->BOÎTIER', ['id'=>'casebox_label', 'class'=>'langspl col-md-4 control-label']) }}
				<div class="col-md-6">
					{{ Form::select('casebox_id', $casebox, $watch->casebox_id, ['id'=>'casebox_id', 'class'=>'selectpicker', 'data-width'=>'100%']) }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('size', '<!--:en-->SIZE<!--:fr-->TAILLE', ['id'=>'size_label', 'class'=>'langspl col-md-4 control-label']) }}
				<div class="col-md-6">
					{{ Form::text('size', $watch->size, ['class'=>'form-control']) }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('band' ,'<!--:en-->BAND<!--:fr-->BRACELET', ['id'=>'band_label', 'class'=>'langspl col-md-4 control-label']) }}
				<div class="col-md-6">
					{{ Form::select('band_id', $band, $watch->band_id, ['id'=>'band_id', 'class'=>'selectpicker', 'data-width'=>'100%']) }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('buckle' ,'<!--:en-->BUCKLE<!--:fr-->BOUCLE', ['id'=>'buckle_label', 'class'=>'langspl col-md-4 control-label']) }}
				<div class="col-md-6">
					{{ Form::select('buckle_id', $buckle, $watch->buckle_id, ['id'=>'buckle_id', 'class'=>'selectpicker', 'data-width'=>'100%']) }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('paper' ,'<!--:en-->ORIGINAL PAPERS<!--:fr-->PAPIERS D’ORIGINE', ['id'=>'paper_label', 'class'=>'langspl col-md-4 control-label']) }}
				<div class="col-md-6">
					{{ Form::select('paper_id', $paper, $watch->paper_id, ['id'=>'paper_id', 'class'=>'selectpicker', 'data-width'=>'100%']) }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('box' ,'<!--:en-->ORIGINAL BOX<!--:fr-->BOÎTE D’ORIGINE', ['id'=>'box_label', 'class'=>'langspl col-md-4 control-label']) }}
				<div class="col-md-6">
					{{ Form::checkbox('box', 1, $watch->box) }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('keywords_en' ,'<!--:en-->SEO KEYWORDS EN<!--:fr-->MOTS-CLÉS SEO EN', ['id'=>'keywords_label_en', 'class'=>'col-md-4 control-label langspl filllangs']) }}
				<div class="col-md-6">
					{{ Form::textarea('keywords_en', $watch->keywords->en, ['id'=>'keywords_en', 'rows'=>6, 'class'=>'form-control']) }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('keywords_fr' ,'<!--:en-->SEO KEYWORDS FR<!--:fr-->MOTS-CLÉS SEO FR', ['id'=>'keywords_label_fr', 'class'=>'col-md-4 control-label langspl filllangs']) }}
				<div class="col-md-6">
					{{ Form::textarea('keywords_fr', $watch->keywords->fr, ['id'=>'keywords_fr', 'rows'=>6, 'class'=>'form-control']) }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('descriptions_en' ,'DESCRIPTION EN', ['id'=>'description_label_en', 'class'=>'col-md-4 control-label filllangs']) }}
				<div class="col-md-6">
					{{ Form::textarea('descriptions_en', $watch->descriptions->en, ['id'=>'descriptions_en', 'rows'=>6, 'class'=>'form-control']) }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('descriptions_fr' ,'DESCRIPTION FR', ['id'=>'description_label_fr', 'class'=>'col-md-4 control-label filllangs']) }}
				<div class="col-md-6">
					{{ Form::textarea('descriptions_fr', $watch->descriptions->fr, ['id'=>'descriptions_fr', 'rows'=>6, 'class'=>'form-control']) }}
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-offset-4 col-md-6">
					<button type="submit" class="btn btn-primary btn-lg">Save <b class="glyphicon white glyphicon-hdd"></b></button>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="row">
			<div class="form-group">
				<div class="col-md-offset-3 col-md-6">
					<button type="submit" class="btn btn-primary btn-lg">Save <b class="glyphicon white glyphicon-hdd"></b></button>
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('status' ,'<!--:en-->STATUS<!--:fr-->STATUT', ['id'=>'status_label', 'class'=>'langspl col-md-3 control-label']) }}
				<div class="col-md-6">
					{{ Form::select('status_id', $status, $watch->status_id, ['id'=>'status_id', 'data-style'=>'btn-'.$watch->status_id, 'data-width'=>'100%', 'class'=>'sel_status_edit']) }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('payment' ,'<!--:en-->PAYMENT<!--:fr-->PAIEMENT', ['id'=>'payment_label', 'class'=>'langspl col-md-3 control-label']) }}
				<div class="col-md-6">
					{{ Form::select('payment_id', $payment, $watch->payment_id, ['id'=>'payment_id', 'data-width'=>'100%', 'class'=>'selectpicker']) }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('entrydate', '<!--:en-->ENTRY DATE<!--:fr-->DATE D’ENTRÉE', ['id'=>'entrydate_label', 'class'=>'langspl col-md-3 control-label']) }}
				<div class="col-md-6">
					{{ Form::text('entrydate', $watch->created_at, ['class'=>'form-control', 'disabled']) }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('sellingdate', '<!--:en-->SELLING DATE<!--:fr-->DATE DE SORTIE', ['id'=>'sellingdate_label', 'class'=>'langspl col-md-3 control-label']) }}
				<div class="col-md-6">
					{{ Form::text('sellingdate', $watch->sellingdate, ['class'=>'form-control', 'readonly']) }}
				</div>
			</div>

		</div>
		<div class="row">
			<div class="form-group">
			<div class="col-md-offset-3 col-md-6">
				<button id="addImages" class="btn btn-success btn-lg">Add images <b class="glyphicon white glyphicon-plus"></b></button>
				<div id="images" class="images-container">
				@foreach ($images as $image)
					<div data-image-id="{{ $image->id }}" data-image-order="{{ $image->order }}">
						<img src="/uploaded/files/thumbnail/
						{{ $image->filename }}
						" />
						<button class="btn-xs btn-danger">Del <b class="glyphicon white glyphicon-remove"></b></button>
					</div>
				@endforeach
				</div>
			</div>
			</div>
		</div>
	</div>
	{{ Form::close() }}
</div>
@stop
@section('modals')
<div class="modal fade" id="addModelModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Add Model</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal">
					<div class="form-group">
						{{ Form::label('modelname' ,'<!--:en-->Model name<!--:fr-->MODÈLE NOME', ['class'=>'col-md-4 control-label langspl']) }}
						<div class="col-md-6">
							{{ Form::text('name', '', ['id'=>'modelname', 'class'=>'form-control']) }}
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button id="savemodel" type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="addImagesModal">
</div><!-- /.modal -->
@stop