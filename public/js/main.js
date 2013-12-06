// set App
(function(){
	window.App = {
		Models: {},
		Collections: {},
		Views: {},
		Options: {},
		Vars: {}
	};
	App.Options.section = 'home';
	App.Vars.currentitem = 0;
	App.Vars.i; // preview current item
	App.Vars.t; // preview total items
	App.Vars.Phref = 'getwatches?kind=all'; // all watches shown without paging
	App.found = {};
	App.found.brand = {};
	App.found.model = {};
})();
// email validation
isEmail = function(email) {
	var pattern = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return pattern.test(email);
}
// url params
parseURLParams = function(url) {
  var queryStart = url.indexOf("?") + 1;
  var queryEnd   = url.indexOf("#") + 1 || url.length + 1;
  var query      = url.slice(queryStart, queryEnd - 1);

  if (query === url || query === "") return;

  var params  = {};
  var nvPairs = query.replace(/\+/g, " ").split("&");

  for (var i=0; i<nvPairs.length; i++) {
    var nv = nvPairs[i].split("=");
    var n  = decodeURIComponent(nv[0]);
    var v  = decodeURIComponent(nv[1]);
    if ( !(n in params) ) {
      params[n] = [];
    }
    params[n].push(nv.length === 2 ? v : null);
  }
  return params;
}
// section
$.setSection = function() {
	if(!App.Options.newsection) {
		$center = $(window).height()/2;
		$('section').each(function(index, el) {
			if(($center+$(window).scrollTop()>$(this).offset().top-$center/4) && ($(window).scrollTop()<$(this).offset().top)) {
				if(App.Options.section != $(this).attr('id')) {
					App.Options.section = $(this).attr('id');
					$.moveM1pos();
					$.moveM2pos();
				}
			}
		});
	}
}
// set menu1 marker position
$.moveM1pos = function (item) {
	if($('#menu1').length){
		if(item==undefined) {
			if(App.Options.newsection) {
				App.Options.section = App.Options.newsection;
				App.Options.newsection = '';
			}
			// console.log(App.Options.section+'--'+$('#menu1 .mitems li.menulnk.'+App.Options.section).offset().left);
			left = $('#menu1 .mitems li.menulnk.'+App.Options.section).offset().left;
			width = $('#menu1 .mitems li.menulnk.'+App.Options.section).width();
		} else {
			left = item.offset().left;
			width = item.width();
		}
		top = $('#menu1 .marker').offset().top;
		moffset = $('#menu1 .marker').width();
		newleft = left+width/2-moffset/2;
		$('#menu1 .marker').stop().animate({
			left: newleft,
			top: top
		}, 500, function() {
			/* stuff to do after animation is complete */
		});
	}
}
$.moveM2pos = function (item) {
	if(item==undefined) {
		if(App.Options.newsection) {
			App.Options.section = App.Options.newsection;
			App.Options.newsection = '';
		}
		left = $('#menu2 .mitems li.menulnk.'+App.Options.section).offset().left;
		width = $('#menu2 .mitems li.menulnk.'+App.Options.section).width();
	} else {
		left = item.offset().left;
		width = item.width();
	}
	top = $('#menu2 .marker').offset().top;
	moffset = $('#menu2 .marker').width();
	newleft = left+width/2-moffset/2;
	$('#menu2 .marker').stop().animate({
		left: newleft,
		top: top
	}, 500, function() {
		/* stuff to do after animation is complete */
	});
}
$.resizeFunc = function () {
	// earth size
	$width = 1440;
	$height = 799;
	$winWidth = $(window).width();
	$newheight = $height*$winWidth/$width;
	$('div#topbg').height($newheight);
	$('div#topbg2').height($newheight);
	$.setSection();
}
$.setWatchesList = function(id) {
	// set marker in menu
	if(typeof(id)==='undefined') {
		id='all';
	} else if(id!=='nochange') {
		$('section#watches .brands li').removeClass('active');
		$('section#watches .brands a[data-brand-id='+id+']').parent().addClass('active');
	}
	// show watch detail
	$('section#watches div.sw .img').hover(function() {
		$(this).find('.details').fadeIn(100);
	}, function() {
		$(this).find('.details').fadeOut(100);
	});
	// show watch
	$('section#watches .details').on('click', function(event) {
		event.preventDefault();
		$id = $(this).data('watch-id');
		$name = $(this).data('watch-name');
		var pathname = window.location.href.split("?")[0];
		window.location = pathname+'/watch/'+$id+'?'+$name;
	});
	// contact for watch
	$('button.contactaboutwatch, .home .btncontact, .show .btncontact, .wishlist .btncontact').on('click', function(event) {
		event.preventDefault();
		event.stopPropagation();
		$ref = $(this).data('watch-ref');
		$brand = $(this).data('watch-brand');
		$model = $(this).data('watch-model');
		$('#contactModal input[name=creference]').val($ref);
		$('#contactModal input[name=cmodel]').val($model);
		$('#contactModal input[name=cbrand]').val($brand);
		$('#contactModal').modal();
	});
	// add to wishlist
	$('button.addtowishlist, div.addtowishlist').on('click', function(event) {
		event.preventDefault();
		event.stopPropagation();
		$t=$(this);
		$.get('/addtowishlist/'+$t.data('watch-id'), function(data) {
			$('span.wishnum').html('('+data+')');
			// $t.slideUp();
			$t.fadeOut('200');
		});
	});
	// select
	$('.selectpicker3').selectpicker();
	// contact
	$('.contactbox .input-group-addon').on('click', function(event) {
		event.preventDefault();
		if($('#cbemail').val() && isEmail($('#cbemail').val())) {
			$.post('/email/cbsent', {email: $('#cbemail').val(), name: $('#cbname').val(), text: $('#cbmessage').val()}, function(data, textStatus, xhr) {
				$('#cbemail').val('');
				$('#cbname').val('');
				$('#cbmessage').val('');
			});
		} else {
			$('#cbemail').parent().addClass('has-error').delay(1000).queue(function(next){
				$(this).removeClass('has-error');
				next();
			})
		}
	});
}
// setup search result events
$.setresultEvents = function() {
	$('.found').on('click', function(event) {
		event.preventDefault();
		$t = $(this);
		$('#result').remove();
		if($t.data('found')=='brand') {
			$.loadBrand($t.data('brand-id'),'/getwatches/'+$t.data('brand-id')+'/'+$t.data('brandname'));
		}
	});
}
$.setorderEvents = function() {
	$('#orderby_dir').on('change', function(event) {
		event.preventDefault();
		$.loadBrand(false,'/getwatches?orderby_dir='+$('#orderby_dir').selectpicker('val'));
	});
}
$.Next = function() {
	$('#lightboxModal .preview').eq(App.Vars.i+1).removeClass('right').addClass('center');
	$('#lightboxModal .preview').eq(App.Vars.i).removeClass('center').addClass('left');
	if(App.Vars.i>0) {
		$('#lightboxModal .preview').eq(App.Vars.i-1).addClass('hidden');
	}
	// setTimeout(function (){
		$('#lightboxModal .preview').eq(App.Vars.i+2).removeClass('hidden').addClass('right');
		App.Vars.i++;
		$.setupPreview();
	// }, 50);
}
$.Prev = function() {
	$('#lightboxModal .preview').eq(App.Vars.i).removeClass('center').addClass('right');
	$('#lightboxModal .preview').eq(App.Vars.i-1).removeClass('left').addClass('center');
	if(App.Vars.i>1) {
		$('#lightboxModal .preview').eq(App.Vars.i-2).removeClass('hidden').addClass('left');
	}
	$('#lightboxModal .preview').eq(App.Vars.i+1).addClass('hidden');
	App.Vars.i--;
	$.setupPreview();
}
$.setupPreview = function(num) {
	$('#lightboxModal').modal();
	// init
	if(typeof num !== 'undefined') {
		$('#lightboxModal .prevclose').on('click', function(event) {
			event.preventDefault();
			$('#lightboxModal').modal('hide');
		});
		App.Vars.i = num;
		App.Vars.t = $('#lightboxModal .preview').length;
		$('#lightboxModal .preview').each(function(index, el) {
			$(this).removeClass('hidden left right center');
			if(index<App.Vars.i-1 || index>App.Vars.i+1) $(this).addClass('hidden');
			if(index==App.Vars.i-1) $(this).addClass('left');
			if(index==App.Vars.i+1) $(this).addClass('right');
			if(index==App.Vars.i) $(this).addClass('center');
		});
	}
	// next
	$('#lightboxModal .right').off().on('click', function(event) {
		if(App.Vars.i<App.Vars.t) {
			$.Next();
		}
	});
	// previous
	$('#lightboxModal .left').off().on('click', function(event) {
		if(App.Vars.i>0) {
			$.Prev();
		}
	});
}
$.addHover = function(el){
	hoverdiv = $('<div />');
	hoverdiv.css('position', 'absolute');
	hoverdiv.css('top', '0');
	hoverdiv.css('left', '0');
	hoverdiv.css('width', '100%');
	hoverdiv.css('height', '100%');
	hoverdiv.css('opacity', '0.5');
	hoverdiv.css('background', 'black');
	hoverdiv2 = $('<div />');
	hoverdiv2.css('position', 'absolute');
	hoverdiv2.css('top', '0');
	hoverdiv2.css('left', '0');
	hoverdiv2.css('width', '100%');
	hoverdiv2.css('height', '100%');
	hoverdiv2.css('border', 'solid 2px #226494');
	if($(el).outerWidth()>300) {
		hoverdiv2.css('background', 'url("/img/sw-logo-m@4x.png") 50% no-repeat');
		hoverdiv2.css('background-size', '184px 156px');
	} else {
		hoverdiv2.css('background', 'url("/img/sw-logo-m@2x.png") 50% no-repeat');
		hoverdiv2.css('background-size', '64px 54px');
	}
	$(el).append(hoverdiv, hoverdiv2);
}
$.removeHover = function(el){
	$(el).find('div').remove();
}
$.setupPlinks = function() {
	// first
	if(App.Vars.Pcurrent==1) {
		$('#prev').addClass('disabled');
	}
	if(App.Vars.Pcurrent==App.Vars.Ptotal) {
		$('#next').addClass('disabled');
	}
	if(App.Vars.Pcurrent>1) {
		$('#prev').removeClass('disabled');
	}
	if(App.Vars.Pcurrent<App.Vars.Ptotal) {
		$('#next').removeClass('disabled');
	}
}
$.setupPicturesU = function() {
	var input = $('#filesToUpload')[0];
	var list = $('#pictures-list');
	var container = $('.pictures-selected');
	list.empty();
	$.each(input.files, function(index, el) {
		var li = $('<li />');
		li.html(input.files[index].name);
		list.append(li);
	});
	container.show();
}
$.setupConditions = function() {
	$('#conditionsModal .title').on('click', function(event) {
		event.preventDefault();
		var t = '#'+$(this).data('open');
		$(t).toggleClass('open');
		if($(t).hasClass('open')) {
			$(t).slideDown();
			$(this).find('span').addClass('open');
		} else {
			$(t).slideUp();
			$(this).find('span').removeClass('open');
		}
	});
}
stopSell = function(message) {
	$('.pictures-selected').hide();
	$('.glyphicon-refresh').removeClass('glyphicon-refresh').addClass('glyphicon-chevron-right');
	$('#sell-info').html(message);
	$('#sell-info').slideDown().delay(3000).slideUp();
	$('#brand').val('').selectpicker('refresh');
	$('#model').val('');
	$('#age').val('');
	$('input:radio[name=papers][value=no]').prop("checked", true);
	$('input:radio[name=box][value=no]').prop("checked", true);
	$('#price').val('');
	$('#phone').val('');
	$('#email').val('');
}
$.loadBrand = function(id,href) {
	// scroll to watches
	$("html, body").animate({ scrollTop: $("section#watches").offset().top-$('#menu2').height() }, 600, function(){
		$.moveM1pos();
		$.moveM2pos();
	});
	if(id) {
		App.Vars.Phref = href+'?brand_id='+id;
		if(id=='all') App.Vars.Phref += '&kind=all'; else App.Vars.Phref += '&kind=brand';
	} else App.Vars.Phref = href;
	console.log(App.Vars.Phref);
	$.get(App.Vars.Phref, function(data) {
		$('section#watches .watchlist').hide().html(data).fadeIn('slow');
	})
	.done(function(){
		if(id) $.setWatchesList(id);
	});
}
jQuery(document).ready(function($) {
	// setup order
	$.setorderEvents();
	// show preview
	$('.showprev').on('click', function(event) {
		event.preventDefault();
		$.setupPreview($(this).data('index'));
	}).hover(function() {
		$.addHover($(this));
	}, function() {
		$.removeHover($(this));
	});
	// search
	$('body').on('click', function() {
		$('#result').remove();
		$('.watchsearch').val('');
	});
	$('.watchsearch').on('keyup', function(e){
		$t = $(this);
		$left = $t.offset().left;
		$top = $t.offset().top+$t.outerHeight();
		if (e.keyCode == 27) {$(e.currentTarget).val('')}
		$('#result').remove();
		App.found.brand={};
		App.found.model={};
		// console.log($(e.currentTarget).val());
		if($(e.currentTarget).val().length>2) {
			$.get('/searchbrandmodel/'+$(e.currentTarget).val(), function(data) {
				if(data.length){
					var html='';
					$.each(data, function(index, el) {
						$f = $(this)[0];
						if($f.matchedtype=='brand') {
							if(App.found.brand[$f.brand_id]==undefined) App.found.brand[$f.brand_id]=$f.brandname;
						}
						if($f.matchedtype=='model') {
							if(App.found.model[$f.brand_id+$f.model_id]==undefined) {
								App.found.model[$f.brand_id+$f.model_id]={};
								App.found.model[$f.brand_id+$f.model_id].brandname=$f.brandname;
								App.found.model[$f.brand_id+$f.model_id].brandid=$f.brand_id;
								App.found.model[$f.brand_id+$f.model_id].modelname=$f.modelname;
								App.found.model[$f.brand_id+$f.model_id].modelid=$f.model_id;
							}
						}
					});
					$.each(App.found.brand, function(i,el){
						html+='<li class="found" data-found="brand" data-brand-id="'+i+'" data-brandname="'+App.found.brand[i]+'">'+App.found.brand[i]+'</li>';
					});
					$.each(App.found.model, function(i,el){
						html+='<li class="found" data-found="model" data-brand-id="'+App.found.model[i].brandid+'" data-model-id="'+App.found.model[i].modelid+'">'+App.found.model[i].modelname+' - '+App.found.model[i].brandname+'</li>';
					});
					resdiv = $('<div />');
					resdiv.attr('id', 'result');
					resdiv.css('top', $top-1);
					resdiv.css('left', $left);
					resdiv.html('<ul>'+html+'</ul>');
					$('body').append(resdiv);
					$.setresultEvents();
				}
			});
		};
	})
	// conditions
	$('.conditions').on('click', function(event) {
		event.preventDefault();
		$('#conditionsModal .modal-body').load('/conditions/', function(){
			$.setupConditions();
		});
		$('#conditionsModal').modal('show');
	});
	// sell watch
	$('form#watch-submit').submit(function(event) {
		if (isEmail($('form#watch-submit #email').val())) {
			$('.glyphicon-chevron-right').removeClass('glyphicon-chevron-right').addClass('glyphicon-refresh');
		} else {
			event.preventDefault();
			$('form#watch-submit #email').parent().addClass('has-error').delay(1000).queue(function(next){
				$(this).removeClass('has-error');
				next();
			})
		}
	});
	$('#filesToUpload').on('change', function(event) {
		$.setupPicturesU();
	});
	// contact watch
	$('form#contact-watch').submit(function(event) {
		event.preventDefault();
		if($('#cemail').val() && isEmail($('#cemail').val())) {
			$.post('/email/aboutwatch', $( this ).serialize(), function(data, textStatus, xhr) {
				$('#contactModal').modal('hide');
			});
		} else {
			$('#cemail').parent().addClass('has-error').delay(1000).queue(function(next){
				$(this).removeClass('has-error');
				next();
			})
		}
	});
	// wishlist
	$('.wlcontactform .send').click(function(event) {
		event.preventDefault();
		if($('#wlemail').val() && isEmail($('#wlemail').val())) {
			$.post('/email/wishlist', $('form#contact-wishlist').serialize(), function(data, textStatus, xhr) {
				$('#wlname').val('');
				$('#wlemail').val('');
				$('#wlphone').val('');
				$('#wltext').val('');
			});
		} else {
			$('#wlemail').parent().addClass('has-error').delay(1000).queue(function(next){
				$(this).removeClass('has-error');
				next();
			})
		}
	});
	// newsletter request
	$('.newsletter .input-group-addon').on('click', function(event) {
		event.preventDefault();
		if($('#nemail').val() && isEmail($('#nemail').val())) {
			$.post('/email/nsent', {email: $('#nemail').val()}, function(data, textStatus, xhr) {
				$('#nemail').val('');
			});
		} else {
			$('#nemail').parent().addClass('has-error').delay(1000).queue(function(next){
				$(this).removeClass('has-error');
				next();
			})
		}
	});
	// show brand
	$('section#watches .brands a, .brands_available .single, section#brands .single').on('click', function(event) {
		$t = $(this);
		$id = $t.data('brand-id');
		$count = $t.data('count');
		$href=$(this).attr('href');
		event.preventDefault();
		if($count===undefined || $count>0) $.loadBrand($id,$href);
	});
	// pagination on page
	$('.pager a').on('click', function(event) {
		event.preventDefault();
		$t = $(this);
		if(!$t.parent().hasClass('disabled')) {
			// scroll to watches
			$("html, body").animate({ scrollTop: $("section#watches").offset().top-$('#menu2').height() }, 600, function(){
				$.moveM1pos();
				$.moveM2pos();
			});
			if ($t.parent().attr('id')=='next') {
				page = parseInt(App.Vars.Pcurrent+1);
			} else {
				page = parseInt(App.Vars.Pcurrent-1);
			}
			$href = App.Vars.Phref+'&page='+page;
			console.log($href);
			$.get($href, function(data) {
				$('section#watches .watchlist').hide().html(data).fadeIn('slow');
			})
			.done(function(){
				$.setWatchesList('nochange');
				// setup prev/next links
				$.setupPlinks();
			});
		}
	});
	//  navigation
	$('.missing section#watches .main button').click(function(event) {
		event.preventDefault();
		var pathname = window.location.href.split("404")[0];
		window.location = pathname;
	});
	$('.menulnk a, a.scrolllnk').on('click', function(event) {
		var href=$(this).attr("href");
		var section = href.substring(href.indexOf("#")+1);
		App.Options.newsection = section;
		if($("section#"+section).length) {
			event.preventDefault();
			$("html, body").animate({ scrollTop: $("section#"+section).offset().top-$('#menu2').height() }, 600, function(){
				$.moveM1pos();
				$.moveM2pos();
			});
		}
	});
	$('#up').on('click', function(event) {
		event.preventDefault();
		$("html, body").animate({ scrollTop: 0 }, 600);
	});
	$.moveM1pos();
	$.moveM2pos();
	$('#menu1 .mitems li.menulnk').hover(function() {
		$.moveM1pos($(this));
	}, function() {
		$.moveM1pos($('#menu1 .mitems li.menulnk.'+App.Options.section));
	});
	$('#menu2 .mitems li.menulnk').hover(function() {
		$.moveM2pos($(this));
	}, function() {
		$.moveM2pos($('#menu2 .mitems li.menulnk.'+App.Options.section));
	});
	// brands carousel
	$('#right').on('click', function(event) {
		event.preventDefault();
		$items = $('.caro-inner .single').length;
		if(App.Vars.currentitem<($items-5)) {
			$('.caro-inner').animate({
				left: "-=865" // 173
				},
				300, function() {
				App.Vars.currentitem++;
			});
		}
	});
	$('#left').on('click', function(event) {
		event.preventDefault();
		if(App.Vars.currentitem>0) {
			$('.caro-inner').animate({
				left: "+=865"
				},
				300, function() {
				App.Vars.currentitem--;
			});
		}
	});
	// resize
	$(window).resize(function(){$.resizeFunc()});
	// scrollspy
	$('#menu1').on('scrollSpy:enter', function() {
		$('#menu2').slideUp('fast');
		App.Options.section='home';
		$.moveM1pos();
		$.moveM2pos();
	});
	$('#menu1').on('scrollSpy:exit', function() {
		$('#menu2').css({
			visibility: 'visible',
			display: 'none'
		});
		$('#menu2').slideDown('fast', function() {
			$.moveM2pos($('#menu2 .mitems li.menulnk.'+App.Options.section));
		});
	});
	$('#menu1').scrollSpy();
	$(window).scroll(function(){
		$.setSection();
		$('div#topbg2').css('background-position', "50% "+(328-$('body').scrollTop()*2)+"px");
	});
	// select
	$('.selectpicker').selectpicker();
	$('.selectpicker2').selectpicker();
	// init
	$(window).resize();
	$(window).scroll();
});
$(window).load(function() {
	// hash scroll
	var urlParams = parseURLParams(window.location.href);
	if(urlParams!==undefined) {
		var section=false;
		if (urlParams.watches=='all') {
		// 	$.loadBrand('all','/watch/all');
			section = 'watches';
		};
		if (urlParams.section!==undefined) {
			section=urlParams.section;
		};
		if(section) {
			$("html, body").animate({ scrollTop: $("section#"+section).offset().top-$('#menu2').height() }, 600, function(){
				$.moveM1pos();
				$.moveM2pos();
			});
			history.pushState("", document.title, window.location.pathname);
		}
	}
	if(window.location.hash) {
		section = window.location.hash.substring(2);
		App.Options.newsection = section;
		if($("section#"+section).length) {
		}
	}
});