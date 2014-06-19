(function($){
	var main = {

		vars: {},

		init: function(){
			this.frontPageMenu.init();
			this.overlayMenu.init();
			this.aspectRatio();
			this.galleryMetaData();
			this.modal.lightbox();
			this.colorToggle();
			this.lightbox.init();
			this.lightbox.basket();
			
			Modernizr.addTest('firefox', function () {
 				return !!navigator.userAgent.match(/firefox/i);
			});

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
				gridItem = $('.album-items .item'),
				content = $('.gallery-content'),
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
				});

				//Frontpage grid trigger
				gridItem.on('click', function(){
					//Grabs id
					var id = $(this).data('id');
					//Appends id to url
					$(this).children('a').attr( 'href', function(index, value) {
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
			id = main.overlayMenu.vars.slider.data('flexslider').currentSlide;
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
				$('#main').toggleClass('black');
			});
		},

		lightbox: {

			vars: {},

			init: function(){
				this.vars.array = [];
				this.setCookie();
				this.triggers();

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
		var bLazy = new Blazy({
		     container: '.gallery'
	    });

		//Check whether page is single-albums and a query string is set.
		if($('body').hasClass('single-albums') && main.overlayMenu.queryId() ){
			$('.gallery-content').toggleClass('hide');
			$('.lightbox-actions').toggleClass('hide');
			$('.flexslider').toggleClass('visible');
		}

		//Splash
		$('.splash').delay(1000).fadeOut(1000);
	});

})(jQuery);
