!function(a){var t={vars:{},init:function(){t.vars.html=a("html"),t.vars.imageRatio=a(".gallery .column img, .slides img"),t.vars.image=a(".gallery .column"),this.frontPageMenu.init(),this.overlayMenu.init(),this.aspectRatio(),this.lightbox.init(),this.lightbox.basket(),a(window).resize(function(){t.aspectRatio()})},frontPageMenu:{vars:{},init:function(){this.vars.links=a(".category-links a"),this.vars.album=a(".album"),this.triggers()},triggers:function(){a("html").hasClass("no-touch")?t.frontPageMenu.vars.album.on("hover",function(){a(this).toggleClass("active")}):a(".album").addClass("active"),t.frontPageMenu.vars.links.mouseover(function(){var t=a(this).parent().data("bg");a(this).closest(".album").find(".background").toggleClass("visible"),a(this).closest(".album").find(".background").css("background-image","url("+t+")")}).mouseout(function(){a(this).closest(".album").find(".background").toggleClass("visible")})}},overlayMenu:{init:function(){this.triggers()},triggers:function(){var e=a("#overlaymenu"),i=a(".menu-button"),s=a("#gallery-content"),l=a(".gallery .column"),o=a(".toggle-gallery");i.on("click",function(a){a.preventDefault(),e.toggleClass("visible")}),l.on("click",function(e){e.preventDefault();var i=a(this).index();a(".flexslider").flexslider(i),t.galleryMetaData(),s.toggleClass("hide"),a(".lightbox-actions").toggleClass("hide")}),o.on("click",function(t){t.preventDefault(),s.toggleClass("hide"),a(".lightbox-actions").toggleClass("hide")})}},aspectRatio:function(){t.vars.imageRatio.each(function(){var t=a(this),e=parseInt(t.attr("height")),i=parseInt(t.attr("width"));t.addClass(e>i?"portrait":"landscape")});var e=t.vars.image.width();t.vars.image.css({height:e+"px"})},galleryMetaData:function(){var t=a(".flexslider"),e=t.data("flexslider"),i=a(".flex-active-slide img"),s=i.attr("alt"),l=a("span.count"),o=a("span.title"),r=e.currentSlide+1;l.html(r),o.html(s)},modal:{vars:{},timeout:function(){var t=a(".modal"),e=a(".modal .message");setTimeout(function(){t.removeClass("visible")},3e3)},message:function(e){var i=a(".modal"),s=a(".modal .message");"success"===e?(s.removeClass("fail"),s.addClass("success").html("Image successfully added to lightbox."),i.toggleClass("visible"),t.modal.timeout()):(s.removeClass("success"),s.addClass("fail").html("Image already exists in the lightbox."),i.toggleClass("visible"),t.modal.timeout())}},lightbox:{vars:{},init:function(){this.vars.array=[],this.setCookie(),this.triggers();var e=a("#field_1_2 input").val();a("#field_1_2 input").val(e+"?id="+t.lightbox.vars.array)},setCookie:function(){if("undefined"==typeof a.cookie("lightbox"))a.cookie("lightbox","0",{expires:7});else{t.lightbox.vars.array=a.cookie("lightbox").split(",");for(var e=0;e<t.lightbox.vars.array.length;e++)t.lightbox.vars.array[e]=parseInt(t.lightbox.vars.array[e])}},triggers:function(){var e=a(".lightbox-btn"),i=a(".lightbox-remove"),s=a(".clear-selection");e.on("click",function(e){e.preventDefault();var i=a(this).data("id");t.lightbox.addToArray(i)}),i.on("click",function(e){e.preventDefault();var i=a(this).data("id");t.lightbox.removeFromArray(i)}),s.on("click",function(a){a.preventDefault(),t.lightbox.clearArray()})},addToArray:function(e){var i=t.lightbox.vars.array;if(-1==i.indexOf(e)){i.push(e);var s=i.toString();a.cookie("lightbox",s),t.modal.message("success"),t.lightbox.basket()}else t.modal.message("fail")},removeFromArray:function(e){var i=t.lightbox.vars.array,s=i.indexOf(e);if(-1!==s){i.splice(s,1);var l=i.toString();a.cookie("lightbox",l),location.reload()}t.lightbox.basket()},basket:function(){var e=t.lightbox.vars.array.length-1;e>0&&(a("span.counter").html(e),a("span.counter").addClass("bounce"))},clearArray:function(){a.removeCookie("lightbox"),location.reload()}}};t.init(),a(window).load(function(){a(".flexslider").flexslider({animation:"fade",animationSpeed:850,controlNav:!1,slideshow:!1,after:function(){t.galleryMetaData()}}),a(".splash").delay(1e3).fadeOut(1e3)})}(jQuery);