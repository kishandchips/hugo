(function($){
	var main = {

		vars: {},

		init: function(){
			this.frontPageMenu.init();
			this.overlayMenu.init();
			this.lightbox.init();
			this.lightbox.basket();
			this.colorToggle();
			this.centerImage();
			this.aspectRatio();

			$(window).resize(function(){
				main.aspectRatio();
				main.centerImage();
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
			vars:{},

			init: function(){
				this.triggers();

				//Flexslider
				var slider = main.overlayMenu.vars.slider = $('.flexslider');

				slider.flexslider({
					animation: "fade",
					animationSpeed: 850,
					controlNav: false,
					slideshow: false,
					startAt: main.overlayMenu.queryId(),
					after:function(){
						main.overlayMenu.setHash();
						main.galleryMetaData();
					}
				});

				//Check whether page is single-albums and a query string is set.
				if($('body').hasClass('single-albums') && main.overlayMenu.queryId() ){
					$('#gallery-content').toggleClass('hide');
					$('.lightbox-actions').toggleClass('hide');
					$('.flexslider').toggleClass('visible');
				}
			},

			queryId: function(){
				//Get query string and trigger flexslider
				var id = window.location.hash.substring(1);
				var target = $('.gallery li').filter("[data-id="+ id + "]").index();
				if(target !== -1){
					return target;					
				}
			},

			setHash: function(){
				var id = $('.flex-active-slide').data('id');
				if(id !== '#'){
					window.location.hash = id;					
				}
			},

			triggers: function(){
				var overlay = $('#overlaymenu'),
				menu = $('.menu-button'),
				gridItem = $('.album-grid .item'),
				content = $('#gallery-content'),
				image = $('.gallery .column'),
				toggleButton = $('.toggle-gallery');

				//Overlay menu toggle
				menu.on('click',function(e){
					e.preventDefault();
					overlay.toggleClass('visible');
				});

				//Gallery trigger
				image.on('click',function(e){
					e.preventDefault();
					var btn = $(this),
						target = $('.gallery li').filter("[data-id="+ btn.data('id') + "]").index();

					$('.flexslider').flexslider(target);
					main.galleryMetaData();
					content.toggleClass('hide');
					$('.flexslider').toggleClass('visible');
					$('.lightbox-actions').toggleClass('hide');
				});

				//Frontpage grid trigger
				gridItem.on('click', function(){
					//Grabs id
					var id = $(this).data('id');
					//Appends id to url
					$(this).parent().attr( 'href', function(index, value) {
					  return value + "#"+ id;
					});
				});

				//Gallery toggle
				toggleButton.on('click', function(e){
					e.preventDefault();

					content.toggleClass('hide');
					$('.flexslider').toggleClass('visible');
					$('.lightbox-actions').toggleClass('hide');
				});

			}
		},//overlayMenu

		centerImage: function(){
	    	var el = $('.slides .image'),
	    	img = $('.slides img'),
	    	imgHeight = img.height()/2,
	    	imgWidth = img.width()/2,
	    	width = $('.slides li').width()/2,
	    	height = $('.slides li').height()/2;
	    	
	    	var newTop = height-imgHeight;
	    	var newLeft = width-imgWidth;
	    	el.css({position: 'absolute', top: newTop, left: newLeft});
	    },//centerImage

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
				setTimeout(function(){
					modal = $('.modal'),
					$(modal).toggleClass('visible');
				},3000);
			}
		},

		colorToggle: function(){
			$('.color-toggle').on('click', function(){
				$('#main').toggleClass('black');
			});
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
		//Lazy Load
		var bLazy = new Blazy({
		     container: '.gallery'
	    });

		//Splash
		$('.splash').delay(1000).fadeOut(1000);
	});

})(jQuery);
