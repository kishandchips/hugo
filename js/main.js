(function($){
	var main = {

		vars: {},

		init: function(){
			main.vars.html = $('html'),
			main.vars.imageRatio = $('.gallery .column img, .slides img'),
			main.vars.image = $('.gallery .column');
			this.frontPageMenu.init();
			this.overlayMenu.init();
			this.aspectRatio();
			this.lightbox.init();
			this.lightbox.basket();

			$(window).resize(function(){
				main.aspectRatio();
			});
		},

		frontPageMenu: {
			vars:{},

			init: function(){
				this.vars.links = $('.category-links a');
				this.vars.album = $('.album');
				
				this.triggers();
			},

			triggers: function(){
				// album hover only for non-touch devices
				if($('html').hasClass('no-touch')){
					main.frontPageMenu.vars.album.on('hover', function(){
						$(this).toggleClass('active');
					});						
				} else {
					$('.album').addClass('active');
				}

				// links hover
				main.frontPageMenu.vars.links.mouseover(function(){
					//get background url from data-bg
					var newBg = $(this).parent().data('bg');
					//apply bg to .background and toggleClass
					$(this).closest('.album').find('.background').toggleClass('visible');
					$(this).closest('.album').find('.background').css('background-image', 'url('+newBg+')');
				}).mouseout(function(){
					//remove bg
					$(this).closest('.album').find('.background').toggleClass('visible');
				});
			},
		},

		overlayMenu: {

			init: function(){
				this.triggers();
			},

			triggers: function(){
				var overlay = $('#overlaymenu'),
				menu = $('.menu-button'),
				content = $('#gallery-content'),
				image = $('.gallery .column'),
				toggleButton = $('.toggle-gallery');

				menu.on('click',function(e){
					e.preventDefault();
					overlay.toggleClass('visible');
				});

				image.on('click',function(e){
					e.preventDefault();
					var target = $(this).index();
					$('.flexslider').flexslider(target);
					main.galleryMetaData();
					content.toggleClass('hide');
					$('.lightbox-actions').toggleClass('hide');
				});

				toggleButton.on('click', function(e){
					e.preventDefault();
					content.toggleClass('hide');
					$('.lightbox-actions').toggleClass('hide');
				});

			}
		},//overlayMenu

		aspectRatio: function(){

			main.vars.imageRatio.each(function(){
				var image = $(this),
				h = parseInt(image.attr('height')),
				w = parseInt(image.attr('width'));

				if(w < h){
					image.addClass('portrait');
				
				} else {
					image.addClass('landscape');
				}
			});

			var width = main.vars.image.width();
			main.vars.image.css({'height':width+'px'});
		},//aspectRation

		galleryMetaData: function(){
			var flexslider = $('.flexslider'),
			slider = flexslider.data('flexslider'),
			slide = $('.flex-active-slide img'),
			title = slide.attr('alt'),
			countSpan = $('span.count'),
			titleSpan = $('span.title'),
			id = slider.currentSlide + 1;
			countSpan.html(id);
			titleSpan.html(title);
		},//galleryMetaData

		modal: {
			vars: {},

			timeout: function(){
				var modal = $('.modal'),
				message = $('.modal .message');
				
				setTimeout(function(){
					modal.removeClass('visible');
				},3000);
			},

			message: function(status){
				var modal = $('.modal'),
				message = $('.modal .message');

				if(status === 'success'){
					message.removeClass('fail');
					message.addClass('success').html('Image successfully added to lightbox.');
					modal.toggleClass('visible');
					main.modal.timeout();

				} else {
					message.removeClass('success');
					message.addClass('fail').html('Image already exists in the lightbox.');
					modal.toggleClass('visible');
					main.modal.timeout();
				}
			}
		},

		lightbox: {

			vars: {},

			init: function(){
				this.vars.array = [];
				this.setCookie();
				this.triggers();

				var url = $('#field_1_2 input').val();
				$('#field_1_2 input').val(url + '?id=' + main.lightbox.vars.array);
			},

			setCookie: function(){
				if (typeof $.cookie('lightbox') == 'undefined'){
					$.cookie('lightbox', '0', { expires: 7});
				} else {
					//split array from cookie and assign to variable as strings
					main.lightbox.vars.array = $.cookie('lightbox').split(',');
					
					for(var i=0; i < main.lightbox.vars.array.length; i++){
						//convert to int array
						main.lightbox.vars.array[i] = parseInt(main.lightbox.vars.array[i]);
					}
				}
			},

			triggers: function(){
				var btn = $('.lightbox-btn'),
					btn2 = $('.lightbox-remove'),
					btn3 = $('.clear-selection');

				btn.on('click', function(e){
					e.preventDefault();
					var id = $(this).data('id');
					main.lightbox.addToArray(id);
				});

				btn2.on('click', function(e){
					e.preventDefault();
					var id = $(this).data('id');
					main.lightbox.removeFromArray(id);
				});

				btn3.on('click', function(e){
					e.preventDefault();
					main.lightbox.clearArray();
				});
			},

			addToArray: function(id){
				var array = main.lightbox.vars.array;

				if(array.indexOf(id) == -1){
					//add id to array
					array.push(id);
					//convert int array to string array
					var string = array.toString();
					//set cookie to string
					$.cookie('lightbox', string);
					main.modal.message('success');
					main.lightbox.basket();
				} else{
					main.modal.message('fail');
				}
			},

			removeFromArray: function(id){
				var array = main.lightbox.vars.array;
				// locate id in array
				var index = array.indexOf(id);
				if(index !== -1){
					// remove id from array
					array.splice(index,1);
					//convert int array to string array
					var string = array.toString();
					//set cookie to string
					$.cookie('lightbox', string);
					//reload page
					location.reload();
				}
				main.lightbox.basket();
			},

			basket: function(){
				var count = main.lightbox.vars.array.length - 1;
				if(count > 0){
					$('span.counter').html(count);
					$('span.counter').addClass('bounce');					
				}
			},

			clearArray: function(){
				$.removeCookie('lightbox');
				location.reload();
			}
		}//lightbox

	};//main
	
	main.init();

	$(window).load(function() {
		$('.flexslider').flexslider({
			animation: "fade",
			animationSpeed: 850,
			controlNav: false,
			slideshow: false,
			after:function(){
				main.galleryMetaData();
			}
		});
		$('.splash').delay(1000).fadeOut(1000);
	});
})(jQuery);
