window.App = {
    data: {},
    trans: [],
    input: {},
    lang: 'en'
};
$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};
splitlang = function() {
	var reg= /<!--:(\w*)-->/igm,
		item;
	$('.langspl').each(function(){
		$t =$(this);
		App.trans[$t.attr('id')]=[];
		if($(this).get(0).tagName=='LABEL') {
			item = _.compact($t.text().split(reg));
			for(var i=0;i<item.length;i=i+2) {
				App.trans[$t.attr('id')][item[i]]=item[i+1];
			}
			$t.text(App.trans[$t.attr('id')][App.lang]);
		} else if($(this).get(0).tagName=='SELECT') {

			items = [];
			$t.find('option').each(function(index, el) {
				items.push(_.compact($(this).text().split(reg)));
			});
			$.each(items, function(index, el) {
				App.trans[$t.attr('id')][index]=[];
				for(var i=0;i<el.length;i=i+2) {
					App.trans[$t.attr('id')][index][el[i]]=el[i+1];
				}
			});
			i=0;
			$t.find('option').each(function(index, el) {
				$(this).text(App.trans[$t.attr('id')][i][App.lang]);
				i++;
			});
		} else {
			item = _.compact($t.val().split(reg));
			for(var i=0;i<item.length;i=i+2) {
				App.trans[$t.attr('id')][item[i]]=item[i+1];
			}
			if(App.trans[$t.attr('id')][App.lang]!=undefined) $t.val(App.trans[$t.attr('id')][App.lang]);
		}
	})
}
changelang = function(langto) {
	var fromlang = App.lang;
	App.lang = langto;
	$('.langspl').each(function(){
		if($(this).get(0).tagName=='LABEL') {
			$(this).text(App.trans[$(this).attr('id')][App.lang]);
		} else if($(this).get(0).tagName=='SELECT') {
			i=0;
			$t=$(this);
			$(this).find('option').each(function(index, el) {
				$(this).text(App.trans[$t.attr('id')][i][App.lang]);
				i++;
			});
		} else {
			App.trans[$(this).attr('id')][fromlang] = $(this).val(); // update current value
			$(this).val(App.trans[$(this).attr('id')][App.lang]);
		}
	})
	$('.selectpicker').selectpicker('render');
}

setchangelang = function() {
	splitlang();
	$('.changelang').on('click', function(){
		$('.changelang').toggleClass('btn-primary');
		changelang($(this).attr('data-langto'));
	})
}
combinelangs = function() {
	$('#update_form, #create_form').css('display','none');
	$('.langspl').each(function(index, el) {
		$t = $(this);
		if($t.get(0).tagName=='SELECT') {
			i=0;
			$(this).find('option').each(function(index, el) {
				var $value = '<!--:en-->' + App.trans[$t.attr('id')][i]['en'] + '<!--:fr-->' + App.trans[$t.attr('id')][i]['fr']
				$(this).text($value);
				i++;
			});
		} else if ($t.get(0).tagName!='LABEL') {
			var $value = '<!--:en-->' + App.trans[$t.attr('id')]['en'] + '<!--:fr-->' + App.trans[$t.attr('id')]['fr']
			$(this).val($value);
		};
	});
}
addImagesToWatch = function(file) {
	file.watch_id = $('input[name=watchid]').val();
	$.ajax({
		url: '/images',
		type: 'POST',
		data: JSON.stringify(file),
		contentType: "application/json; charset=utf-8",
		dataType: 'json'})
	.done(function(result) {
		App.data.images = result;
	})
	.fail(function(result) {
		console.log('error')
	})
}
updateWatchImagesView = function() {
	if(App.data.images!=undefined) {
		$('.images-container').html('');
		// console.log('this');
		$.each(App.data.images, function() {
			$this = $(this)[0];
			$('.images-container').append('<div data-image-id="'+$this.id+'" data-image-order="'+$this.order+'"><img src="/uploaded/files/thumbnail/'+$this.filename+'" /> <button class="btn-xs btn-danger">Del <b class="glyphicon white glyphicon-remove"></b></button></div>')
		})
		setupRemoveImage();
		setupSortable();
	}
}
setupSortable = function() {
	$('.images-container').sortable();
	$('.images-container').on('sortstop', function(){
		$order = $(this).sortable( "toArray", { attribute: "data-image-id" } );
		// console.log($order);
		$.ajax({
			url: '/images/reorder/'+$('input[name=watchid]').val(),
			type: 'POST',
			contentType: "application/json; charset=utf-8",
			// dataType: 'json',
			data: JSON.stringify($order)
		})
		.done(function(){})
		.fail(function(){
			console.log('error');
		})
	})
}
deleteImage = function(id) {
	$.ajax({
		url: '/images/'+id,
		type: 'DELETE'})
	.done(function(result) {
		$('div[data-image-id='+id+']').remove();
		$order = $('#images').find('div').attr("data-image-id");
		console.log($order);
		$.ajax({
			url: '/images/reorder/'+$('input[name=watchid]').val(),
			type: 'POST',
			contentType: "application/json; charset=utf-8",
			// dataType: 'json',
			data: JSON.stringify($order)
		})
		.done(function(){})
		.fail(function(){
			console.log('error');
		})
	})
	.fail(function() {
		console.log('error');
	})
}
setupRemoveImage = function() {
	// remove image
	$('.images-container div button').on('click', function(event) {
		event.preventDefault();
		$imageid = $(this).parent().attr('data-image-id');
		deleteImage($imageid);
	});
}
$(document).ready(function(){
	// thumbs
	$('.thumb img').hover(function(){
		$t = $(this);
		$left = $t.offset().left+$t.outerWidth();
		$top = $t.offset().top;
		thdiv = $('<div />');
		thdiv.addClass('thumb_prev');
		thdiv.css('top', $top);
		thdiv.css('left', $left);
		thdiv.html('<img src="/uploaded/files/thumbnail/'+$t.attr('src').split('/')[6]+'">');
		$('body').append(thdiv);
	}, function(){
		$('.thumb_prev').remove();
	})
	// navigation
	$('#add_new_watch').on('click', function(event) {
		event.preventDefault();
		window.location.assign("/watches/create");
	});
	$('#all_watches').on('click', function(event) {
		event.preventDefault();
		window.location.assign("/watches")
	});
	setchangelang();
	$('#update_form, #create_form').css('display','inherit');
	$('#update_form').submit(function(e) {
		$t=$(this);
		e.preventDefault();
		combinelangs();
		$.ajax({
			url: $(this).attr('action'),
			type: 'POST',
			data: $(this).serializeObject(),
		})
		.done(function() {
			splitlang();
			$('#update_form').css('display','inherit');
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
		});
	});
	setupSortable();
	$('#addmodel').on('click', function(event) {
		event.preventDefault();
		$('#addModelModal').modal({'backdrop':'static'});
	});
	$('#savemodel').on('click', function(event) {
		event.preventDefault();
		if($('#modelname').val()) {
			$.post('/models', {name: $('#modelname').val()}, function(data, textStatus, xhr) {
				if(data=='exists') {
					// pnotify
					alert('exists');
				} else {
					$('#modelname').val('');
					$('select[name="model_id"]').replaceWith(data);
					$('#addModelModal').modal('hide');
				}
			});
		}
	});
	// dates
	$('input[name=sellingdate]').datepicker({
		format: 'yyyy-dd-mm'
	});
	// upload images
	$('#addImages').on('click', function(){
		App.input.images = [];
		$('#addImagesModal').modal({backdrop: 'static', remote: '/jupload'});
		$('#addImagesModal').on('hide.bs.modal', function(event) {
			$('.progress-bar').css('width', 0);
			updateWatchImagesView();
		});
	});
	setupRemoveImage();
	$('.sel_payment').selectpicker().change(function(event) {
		$t = $(this);
		// update payment
		$watchid = $t.data('watchid');
		$.ajax({
			url: '/watches/payment/'+$watchid,
			type: 'POST',
			contentType: "application/json; charset=utf-8",
			data: '{ "payment_id":"'+$t.val()+'" }'
		})
		.done(function(){})
		.fail(function(){
			console.log('error');
		})
	});;
	$('.sel_status').selectpicker().change(function(event) {
		$t = $(this);
		$t.attr('data-style', 'btn-'+$t.val());
		$t.parent().find('button').removeClass('btn-1 btn-2 btn-3 btn-4 btn-5');
		$t.parent().find('button').addClass('btn-'+$t.val());
		// update status
		$watchid = $t.data('watchid');
		$.ajax({
			url: '/watches/status/'+$watchid,
			type: 'POST',
			contentType: "application/json; charset=utf-8",
			data: '{ "status_id":"'+$t.val()+'" }'
		})
		.done(function(){
			if($t.val()!=3) {
				$('.sel_payment[data-watchid='+$watchid+']'). selectpicker('val', '1');
			}
		})
		.fail(function(){
			console.log('error');
		})
	});
	$('.sel_status_edit').selectpicker().change(function(event) {
		$t = $(this);
		$t.attr('data-style', 'btn-'+$t.val());
		$t.parent().find('button').removeClass('btn-1 btn-2 btn-3 btn-4 btn-5');
		$t.parent().find('button').addClass('btn-'+$t.val());
	});
	$('.selectpicker').selectpicker();
})