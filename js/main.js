(function($){
	var main = {

		vars: {},

		init: function(){
			this.frontPage.init();
			this.flexslider.init();
			this.aspectRatio();
			this.modal.lightbox();
			this.colorToggle();
			this.lightbox.init();
			this.lightbox.basket();
			
			Modernizr.addTest('firefox', function () {
 				return !!navigator.userAgent.match(/firefox/i);
			});

			//OVERLAY MENU
			var overlay = $('#overlaymenu'),
			menu = $('.menu-button'),
			body = $('#weezy');

			menu.on('click',function(e){
				e.preventDefault();
				body.toggleClass('no-scroll');
				overlay.toggleClass('visible');
			});

			//SPLASH
			if ($.cookie('hasSeenAnimation') == null){
				$('.splash').addClass('visible');
			  	$('.splash').delay(1000).fadeOut(1000);
			  	// set cookie to stop next visit
			  	$.cookie('hasSeenAnimation','true');
			}

			//RESIZE
			$(window).resize(function(){
				main.aspectRatio();
			});
		},

		frontPage: {
			vars:{},

			init: function(){
				var element = main.vars.home = $('#home');
				if(!element.length){return false;}

				this.vars.links = $('.category-links a'),
				this.vars.album = $('.album'),
				this.vars.item = $('.album-items .item');
				this.triggers();
			},

			triggers: function(){
				// album hover only for non-touch devices
				if($('html').hasClass('no-touch')){
					main.frontPage.vars.album.on('hover', function(){
						$(this).toggleClass('active');
					});						
				} else {
					$('.album').addClass('active');
				}

				// links hover
				main.frontPage.vars.links.mouseover(function(){
					//get background url from data-bg
					var newBg = $(this).parent().data('bg');
					//apply bg to .background and toggleClass
					$(this).closest('.album').find('.background').toggleClass('visible');
					$(this).closest('.album').find('.background').css('background-image', 'url('+newBg+')');

				}).mouseout(function(){
					//remove bg
					$(this).closest('.album').find('.background').toggleClass('visible');
				});

				//Frontpage grid trigger
				main.frontPage.vars.item.on('click', function(){
					//Grabs id
					var id = $(this).data('id');
					//Appends id to url
					$(this).children('a').attr( 'href', function(index, value) {
					  return value + "#"+ id;
					});
				});
			},
		},

		hash: {

			query: function(){
				var target = $('.gallery li').filter("[data-id="+ main.hash.get() + "]").index();
				
				if(target !== -1){
					return target;
				}
			},

			get: function(){
				return window.location.hash.substring(1);
			},

			set: function(){
				var id = $('.flex-active-slide').data('id');
				if(id !== '#'){
					window.location.hash = id;					
				}
			},
		},//overlayMenu

		flexslider: {
			vars:{},

			init:function(){
				//CHECK
				var element = main.vars.lightbox = $('#slider');
				if(!element.length) {return false;}
				//VARIABLES
				this.vars.content = $('#gallery-content'),
				this.vars.image = $('.gallery .column'),
				this.vars.toggle = $('.toggle-gallery');

				this.triggers();
				//FLEXSLIDER
				var slider = main.flexslider.vars.slider = $('#slider');

				slider.flexslider({
					animation: "slide",
					animationSpeed: 850,
					controlNav: false,
					slideshow: false,
					startAt: main.hash.query(),
					start: function(){
						main.galleryMetaData();
					},
					after:function(){
						main.hash.set();
						main.galleryMetaData();
					}
				});
			},

			triggers:function(){

				//Gallery trigger
				main.flexslider.vars.image.on('click',function(e){
					e.preventDefault();
					var btn = $(this),
						target = $('.gallery li').filter("[data-id="+ btn.data('id') + "]").index(),
						slider = $('#slider'),
						flexslider = slider.data('flexslider'),
						speed = flexslider.vars.animationSpeed;

					flexslider.vars.animationSpeed = 0;
					flexslider.flexAnimate(target);
					flexslider.vars.animationSpeed = speed;

					main.galleryMetaData();
					main.flexslider.vars.content.toggleClass('hide');
					$('#slider').toggleClass('visible');
				});

				//Gallery toggle
				main.flexslider.vars.toggle.on('click', function(e){
					e.preventDefault();

					main.flexslider.vars.content.toggleClass('hide');
					$('#slider').toggleClass('visible');
					$('.lightbox-actions').toggleClass('hide');
				});
			},

		},//flexslider

		aspectRatio: function(){
			main.vars.imageRatio = $('.gallery .column img'),
			main.vars.image = $('.gallery .column');

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
			var slide = $('.flex-active-slide img'),
			title = slide.attr('alt'),
			countSpan = $('span.count'),
			titleSpan = $('span.title'),
			slider = $('#slider'),
			id = slider.data('flexslider').currentSlide;
			countSpan.html(id+1);
			titleSpan.html(title);
		},//galleryMetaData

		modal: {

			lightbox: function(){
				$('.lightbox-toggle').on('click', function(){
					$('.lightbox-form-wrapper').toggleClass('visible');
				});
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
			},

			timeout: function(){
				clearTimeout(foo);
				var modal = $('.modal');
				var foo = setTimeout(function(){
					modal.toggleClass('visible');
				},3000);
			}
		},// Modal popup

		colorToggle: function(){
			$('.color-toggle').on('click', function(){
				$('#weezy').toggleClass('black');
			});
		},

		lightbox: {

			vars: {},

			init: function(){
				this.vars.array = [];
				this.setCookie();
				this.triggers();

				//add counter span
				$('.lightbox-cart').append("<span class='counter'></span>")
				//set gform hidden field to array values
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
				var btn = $('.lightbox-add'),
					btn2 = $('.lightbox-remove'),
					btn3 = $('.lightbox-clear'),
					img= $('.slides li');

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

				img.on('hover', function(){
					$(this).children('.lightbox-btn, .lightbox-remove').toggleClass('visible');
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
					$('.counter').html(count);
					$('.counter').addClass('bounce');					
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
		//Lazy Load
		$("img.lazy").lazyload({
			container: $('.gallery'),
			effect : "fadeIn"
		});

		//Check whether page is single-albums and a query string is set.
		if($('#single-albums') && main.hash.query() ){
			$('#gallery-content').toggleClass('hide');
			$('.lightbox-actions').toggleClass('hide');
			$('#slider').toggleClass('visible');
		}
		
	});

})(jQuery);
