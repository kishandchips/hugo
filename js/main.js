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
			    // Example
    		var bLazy = new Blazy({ 
        		selector: '.lazy', // all images
        		container: '.gallery, #gallery-content, .album-items',
    		});

			//RESIZE
			$(window).resize(function(){
				main.aspectRatio();
			});
		},

		frontPage: {
			vars:{},

			init: function(){
				var element = main.vars.home = $('#home, #home2');
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
					var index = $(this).parent().data('bg');
					$(this).closest('.album').find('.bg[data-bg="'+index+'"]').toggleClass('visible');

				}).mouseout(function(){
					//remove bg
					var index = $(this).parent().data('bg');
					$(this).closest('.album').find('.bg[data-bg="'+index+'"]').toggleClass('visible');
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
					animationSpeed: 1000,
					controlNav: false,
					slideshow: false,
					startAt: main.hash.query(),
					start: function(){
						$(window).trigger('resize');
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
					$(window).trigger('resize');
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
			main.vars.imageRatio = $('.gallery .column'),
			main.vars.image = $('.gallery .column');

			main.vars.imageRatio.each(function(){
				var image = $(this).find('img');
				var h = parseInt(image.attr('height'));
				var w = parseInt(image.attr('width'));

				if(w < h){
					$(this).addClass('portrait');
				
				} else if(w > h){
					$(this).addClass('landscape');
				} else {
					$(this).addClass('square');
				}
			});

			var width = main.vars.image.outerWidth();
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

			activeID = $('.flex-active-slide').data('id');
			$('button.add').attr('data-id', activeID);
			$('button.remove').attr('data-id', activeID);

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
					// for(var i=0; i < main.lightbox.vars.array.length; i++){
					// 	//convert to int array
					// 	main.lightbox.vars.array[i] = parseInt(main.lightbox.vars.array[i]);
					// }
				}
			},

			triggers: function(){
				var btn = $('.lightbox-add'),
					add = $('.add'),
					remove = $('.remove'),
					btn2 = $('.lightbox-remove'),
					btn3 = $('.lightbox-clear'),
					img= $('.slides li');

				btn.on('click', function(e){
					e.preventDefault();
					// var id = $(this).data('id');
					var id = $(this).attr('data-id');
					main.lightbox.addToArray(id);
				});
				add.on('click', function(e){
					e.preventDefault();
					// var id = $(this).data('id');
					var id = $(this).attr('data-id');
					main.lightbox.addToArray(id);
				});

				btn2.on('click', function(e){
					e.preventDefault();
					// var id = $(this).data('id');
					var id = $(this).attr('data-id');
					main.lightbox.removeFromArray(id);
				});
				remove.on('click', function(e){
					e.preventDefault();
					// var id = $(this).data('id');
					var id = $(this).attr('data-id');
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
				if($.inArray(id, array) == -1){
					//add id to array
					array.push(id);
					//convert int array to string array
					// var string = array.toString();
					//set cookie to string
					$.cookie('lightbox', array);
					main.modal.message('success');
					main.lightbox.basket();
				} else{
					main.modal.message('fail');
				}
			},

			removeFromArray: function(id){
				var array = main.lightbox.vars.array;
				// locate id in array
				var index = $.inArray(id, array);
				if(index !== -1){
					// remove id from array
					array.splice(index,1);
					//convert int array to string array
					// var string = array.toString();
					//set cookie to string
					$.cookie('lightbox', array);
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

		//Check whether page is single-albums and a query string is set.
		if($('#single-albums') && main.hash.query() ){
			$('#gallery-content').toggleClass('hide');
			$('.lightbox-actions').toggleClass('hide');
			$('#slider').toggleClass('visible');
		}

		//SPLASH
		if ($.cookie('hasSeenAnimation') == null){
			$('.splash').addClass('visible');	
		  	setTimeout(function(){
		  		$('.splash').removeClass('visible');
		  		$('.fadeIn').addClass('invisible');
		  	}, 2000);
		  	// set cookie to stop next visit
		  	$.cookie('hasSeenAnimation','true');
		} else{
			setTimeout(function(){
		  		$('.fadeIn').addClass('invisible');
		  	}, 1000);
		}
			//PRELOAD
		    //appends the images to the DOM for caching
		    $('.category-links .bg').each(function(){
		        $('<img/>', {src: $(this).data('bg'), class: 'precachedImg', style: 'display:none;'}).appendTo('body');
		    });

		    //clean up the DOM as the images are loaded and cached
		    $('.precachedImg').load(function() {
		        $(this).remove();
		    });

	});



})(jQuery);
