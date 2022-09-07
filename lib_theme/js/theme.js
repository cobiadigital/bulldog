/*
* Slides, A Slideshow Plugin for jQuery
* Intructions: http://slidesjs.com
* By: Nathan Searles, http://nathansearles.com
* Version: 1.1.5
* Updated: March 7th, 2011
*/
jQuery.noConflict();
(function($){$.fn.slides=function(g){g=$.extend({},$.fn.slides.option,g);return this.each(function(){$('.'+g.container,$(this)).children().wrapAll('<div class="slides_control"/>');var d=$(this),control=$('.slides_control',d),total=control.children().size(),width=control.children().outerWidth(),height=control.children().outerHeight(),start=g.start-1,effect=g.effect.indexOf(',')<0?g.effect:g.effect.replace(' ','').split(',')[0],paginationEffect=g.effect.indexOf(',')<0?effect:g.effect.replace(' ','').split(',')[1],next=0,prev=0,number=0,current=0,loaded,active,clicked,position,direction,imageParent,pauseTimeout,playInterval;function animate(a,b,c){if(!active&&loaded){active=true;g.animationStart(current+1);switch(a){case'next':prev=current;next=current+1;next=total===next?0:next;position=width*2;a=-width*2;current=next;break;case'prev':prev=current;next=current-1;next=next===-1?total-1:next;position=0;a=0;current=next;break;case'pagination':next=parseInt(c,10);prev=$('.'+g.paginationClass+' li.current a',d).attr('href').match('[^#/]+$');if(next>prev){position=width*2;a=-width*2}else{position=0;a=0}current=next;break}if(b==='fade'){if(g.crossfade){control.children(':eq('+next+')',d).css({zIndex:10}).fadeIn(g.fadeSpeed,g.fadeEasing,function(){if(g.autoHeight){control.animate({height:control.children(':eq('+next+')',d).outerHeight()},g.autoHeightSpeed,function(){control.children(':eq('+prev+')',d).css({display:'none',zIndex:0});control.children(':eq('+next+')',d).css({zIndex:0});g.animationComplete(next+1);active=false})}else{control.children(':eq('+prev+')',d).css({display:'none',zIndex:0});control.children(':eq('+next+')',d).css({zIndex:0});g.animationComplete(next+1);active=false}})}else{control.children(':eq('+prev+')',d).fadeOut(g.fadeSpeed,g.fadeEasing,function(){if(g.autoHeight){control.animate({height:control.children(':eq('+next+')',d).outerHeight()},g.autoHeightSpeed,function(){control.children(':eq('+next+')',d).fadeIn(g.fadeSpeed,g.fadeEasing)})}else{control.children(':eq('+next+')',d).fadeIn(g.fadeSpeed,g.fadeEasing,function(){if($.browser.msie){$(this).get(0).style.removeAttribute('filter')}})}g.animationComplete(next+1);active=false})}}else{control.children(':eq('+next+')').css({left:position,display:'block'});if(g.autoHeight){control.animate({left:a,height:control.children(':eq('+next+')').outerHeight()},g.slideSpeed,g.slideEasing,function(){control.css({left:-width});control.children(':eq('+next+')').css({left:width,zIndex:5});control.children(':eq('+prev+')').css({left:width,display:'none',zIndex:0});g.animationComplete(next+1);active=false})}else{control.animate({left:a},g.slideSpeed,g.slideEasing,function(){control.css({left:-width});control.children(':eq('+next+')').css({left:width,zIndex:5});control.children(':eq('+prev+')').css({left:width,display:'none',zIndex:0});g.animationComplete(next+1);active=false})}}if(g.pagination){$('.'+g.paginationClass+' li.current',d).removeClass('current');$('.'+g.paginationClass+' li:eq('+next+')',d).addClass('current')}}}function stop(){clearInterval(d.data('interval'))}function pause(){if(g.pause){clearTimeout(d.data('pause'));clearInterval(d.data('interval'));pauseTimeout=setTimeout(function(){clearTimeout(d.data('pause'));playInterval=setInterval(function(){animate("next",effect)},g.play);d.data('interval',playInterval)},g.pause);d.data('pause',pauseTimeout)}else{stop()}}if(total<2){return}if(start<0){start=0}if(start>total){start=total-1}if(g.start){current=start}if(g.randomize){control.randomize()}$('.'+g.container,d).css({overflow:'hidden',position:'relative'});control.children().css({position:'absolute',top:0,left:control.children().outerWidth(),zIndex:0,display:'none'});control.css({position:'relative',width:(width*3),height:height,left:-width});$('.'+g.container,d).css({display:'block'});if(g.autoHeight){control.children().css({height:'auto'});control.animate({height:control.children(':eq('+start+')').outerHeight()},g.autoHeightSpeed)}if(g.preload&&control.find('img').length){$('.'+g.container,d).css({background:'url('+g.preloadImage+') no-repeat 50% 50%'});var f=control.find('img:eq('+start+')').attr('src')+'?'+(new Date()).getTime();if($('img',d).parent().attr('class')!='slides_control'){imageParent=control.children(':eq(0)')[0].tagName.toLowerCase()}else{imageParent=control.find('img:eq('+start+')')}control.find('img:eq('+start+')').attr('src',f).load(function(){control.find(imageParent+':eq('+start+')').fadeIn(g.fadeSpeed,g.fadeEasing,function(){$(this).css({zIndex:5});$('.'+g.container,d).css({background:''});loaded=true;g.slidesLoaded()})})}else{control.children(':eq('+start+')').fadeIn(g.fadeSpeed,g.fadeEasing,function(){loaded=true;g.slidesLoaded()})}if(g.bigTarget){control.children().css({cursor:'pointer'});control.children().click(function(){animate('next',effect);return false})}if(g.hoverPause&&g.play){control.bind('mouseover',function(){stop()});control.bind('mouseleave',function(){pause()})}if(g.generateNextPrev){$('.'+g.container,d).after('<a href="#" class="'+g.prev+'">Prev</a>');$('.'+g.prev,d).after('<a href="#" class="'+g.next+'">Next</a>')}$('.'+g.next,d).click(function(e){e.preventDefault();if(g.play){pause()}animate('next',effect)});$('.'+g.prev,d).click(function(e){e.preventDefault();if(g.play){pause()}animate('prev',effect)});if(g.generatePagination){d.append('<ul class='+g.paginationClass+'></ul>');control.children().each(function(){$('.'+g.paginationClass,d).append('<li><a href="#'+number+'">'+(number+1)+'</a></li>');number++})}else{$('.'+g.paginationClass+' li a',d).each(function(){$(this).attr('href','#'+number);number++})}$('.'+g.paginationClass+' li:eq('+start+')',d).addClass('current');$('.'+g.paginationClass+' li a',d).click(function(){if(g.play){pause()}clicked=$(this).attr('href').match('[^#/]+$');if(current!=clicked){animate('pagination',paginationEffect,clicked)}return false});$('a.link',d).click(function(){if(g.play){pause()}clicked=$(this).attr('href').match('[^#/]+$')-1;if(current!=clicked){animate('pagination',paginationEffect,clicked)}return false});if(g.play){playInterval=setInterval(function(){animate('next',effect)},g.play);d.data('interval',playInterval)}})};$.fn.slides.option={preload:false,preloadImage:'/img/loading.gif',container:'slides_container',generateNextPrev:false,next:'next',prev:'prev',pagination:true,generatePagination:true,paginationClass:'pagination',fadeSpeed:350,fadeEasing:'',slideSpeed:350,slideEasing:'',start:1,effect:'slide',crossfade:false,randomize:false,play:0,pause:0,hoverPause:false,autoHeight:false,autoHeightSpeed:350,bigTarget:false,animationStart:function(){},animationComplete:function(){},slidesLoaded:function(){}};$.fn.randomize=function(c){function randomizeOrder(){return(Math.round(Math.random())-0.5)}return($(this).each(function(){var $this=$(this);var $children=$this.children();var a=$children.length;if(a>1){$children.hide();var b=[];for(i=0;i<a;i++){b[b.length]=i}b=b.sort(randomizeOrder);$.each(b,function(j,k){var $child=$children.eq(k);var $clone=$child.clone(true);$clone.show().appendTo($this);if(c!==undefined){c($child,$clone)}$child.remove()})}}))}})(jQuery);
/*
 *	Equal height script
 */
jQuery.noConflict();
function equalHeight(group) {
	var tallest = 0;
	group.each(function() {
		var thisHeight = jQuery(this).height();
		if(thisHeight > tallest) {
			tallest = thisHeight;
		}
	});
	group.height(tallest);
}

/*
 *	theme jQuery goodies
 */
jQuery.noConflict();
jQuery(document).ready(function($) {

    // Initiate $ Dropdown navigation
    $('ul.nav-menu').superfish();
	
	// Initiate looped slider
	$(".loopedSlider").each(function() {
	    
		// fix ie6 width
		var divwidth = $(this).width();
		$(this).find('.slider-inner, .slider-inner div.slide').css( "width", divwidth );
		
		// load saved options
		var slider_id = $(this).find('input[class][class="slider-id"]').val(),
			slider_effect = $(this).find('input[class][class="slider-effect"]').val(),
			slider_start = $(this).find('input[class][class="slider-start"]').val(),
			slider_crossfade = $(this).find('input[class][class="slider-crossfade"]').val(),
			slider_bigtarget = $(this).find('input[class][class="slider-bigtarget"]').val(),
			slider_autoheight = $(this).find('input[class][class="slider-autoheight"]').val(),
			slider_pagination = $(this).find('input[class][class="slider-pagination"]').val(),
			slider_fadespeed = $(this).find('input[class][class="slider-fadespeed"]').val(),
			slider_slidespeed = $(this).find('input[class][class="slider-slidespeed"]').val(),
			slider_autoplay = $(this).find('input[class][class="slider-autoplay"]').val(),
			slider_pause = $(this).find('input[class][class="slider-pause"]').val();
			slider_loadingimg = $(this).find('input[class][class="slider-loadingimg"]').val();
		
		// match effect
		if (slider_effect == false){ slider_effect = false; } else { slider_effect = slider_effect; }
		// match start
		if (slider_start == false){ slider_start = false; } else { slider_start = slider_start; }
		// match crossfade
		if (slider_crossfade == false){ slider_crossfade = false; } else { slider_crossfade = slider_crossfade; }
		// match autoheight
		if (slider_autoheight == false){ slider_autoheight = false; } else { slider_autoheight = slider_autoheight; }
		// match bigtarget
		if (slider_bigtarget == false){ slider_bigtarget = false; } else { slider_bigtarget = slider_bigtarget; }
		// match pagination
		if (slider_pagination == false){ slider_pagination = false; } else { slider_pagination = slider_pagination; }
		// match fade speed
		if (slider_fadespeed == 0){ slider_fadespeed = 0; } 
		else if (slider_fadespeed == 500){ slider_fadespeed = 500; } else if (slider_fadespeed == 1000){ slider_fadespeed = 1000; }
		else if (slider_fadespeed == 1500){ slider_fadespeed = 1500; } else if (slider_fadespeed == 2000){ slider_fadespeed = 2000; }
		else if (slider_fadespeed == 2500){ slider_fadespeed = 2500; } else if (slider_fadespeed == 3000){ slider_fadespeed = 3000; }
		else if (slider_fadespeed == 3500){ slider_fadespeed = 3500; } else if (slider_fadespeed == 4000){ slider_fadespeed = 4000; }
		else if (slider_fadespeed == 4500){ slider_fadespeed = 4500; } else { slider_fadespeed = slider_fadespeed; }
		// match fade speed
		if (slider_slidespeed == 0){ slider_slidespeed = 0; } 
		else if (slider_slidespeed == 500){ slider_slidespeed = 500; } else if (slider_slidespeed == 1000){ slider_slidespeed = 1000; }
		else if (slider_slidespeed == 1500){ slider_slidespeed = 1500; } else if (slider_slidespeed == 2000){ slider_slidespeed = 2000; }
		else if (slider_slidespeed == 2500){ slider_slidespeed = 2500; } else if (slider_slidespeed == 3000){ slider_slidespeed = 3000; }
		else if (slider_slidespeed == 3500){ slider_slidespeed = 3500; } else if (slider_slidespeed == 4000){ slider_slidespeed = 4000; }
		else if (slider_slidespeed == 4500){ slider_slidespeed = 4500; } else { slider_slidespeed = slider_slidespeed; }
		// match autoplay
		if (slider_autoplay == 0){ slider_autoplay = 0; } 
		else if (slider_autoplay == 500){ slider_autoplay = 500; } else if (slider_autoplay == 1000){ slider_autoplay = 1000; }
		else if (slider_autoplay == 1500){ slider_autoplay = 1500; } else if (slider_autoplay == 2000){ slider_autoplay = 2000; }
		else if (slider_autoplay == 2500){ slider_autoplay = 2500; } else if (slider_autoplay == 3000){ slider_autoplay = 3000; }
		else if (slider_autoplay == 3500){ slider_autoplay = 3500; } else if (slider_autoplay == 4000){ slider_autoplay = 4000; }
		else if (slider_autoplay == 4500){ slider_autoplay = 4500; } else { slider_autoplay = slider_autoplay; }
		// match autorestart
		if (slider_pause == 0){ slider_pause = 0; } 
		else if (slider_pause == 500){ slider_pause = 500; } else if (slider_pause == 1000){ slider_pause = 1000; }
		else if (slider_pause == 1500){ slider_pause = 1500; } else if (slider_pause == 2000){ slider_pause = 2000; }
		else if (slider_pause == 2500){ slider_pause = 2500; } else if (slider_pause == 3000){ slider_pause = 3000; }
		else if (slider_pause == 3500){ slider_pause = 3500; } else if (slider_pause == 4000){ slider_pause = 4000; }
		else if (slider_pause == 4500){ slider_pause = 4500; } else { slider_pause = slider_pause; }
						
		
		$("#"+slider_id).slides({
		    container: 				'slider-inner', 		// Class name for slides container.
			preload: 				false,					// preload images
			preloadImage: 			slider_loadingimg,		// string, Name and location of loading image for preloader
			generateNextPrev: 		false, 					// Auto generate next/prev buttons.
			next: 					'nxt', 					// next button class.
			prev: 					'prev', 				// previous button class.
			pagination: 			true, 					// If you're not using pagination you can set to false, but don't have to.
			paginationClass: 		'pagination',			// Class name for pagination.
			generatePagination: 	slider_pagination, 		// Auto generate pagination.
			fadeSpeed: 				slider_fadespeed, 		// Set the speed of the fading animation in milliseconds.
			slideSpeed: 			slider_slidespeed, 		// Set the speed of the sliding animation in milliseconds.
			start: 					slider_start,			// Set which slide you'd like to start with.
			effect: 				slider_effect,			// The first name will be for next/prev and the second will be for pagination.
			crossfade: 				slider_crossfade, 		// Crossfade images in a image based slideshow.
			randomize: 				false, 					// Set to true to randomize slides.
			play: 					slider_autoplay, 		// Autoplay slideshow
			pause: 					slider_pause,			// Pause slideshow on click of next/prev or pagination.
			hoverPause: 			true,					// Set to true and hovering over slideshow will pause it.
			autoHeight: 			slider_autoheight, 		// Set to true to auto adjust height.
			autoHeightSpeed: 		350,					// Set auto height animation time in milliseconds.
			bigTarget: 				slider_bigtarget 		// Set to true and the whole slide will link to next slide on click.
		});
		
		// Slider forward/back show/hide
		$("#"+slider_id).mouseover(function() {
		    $(this).find('.prev').stop().fadeTo(300, 1);
			$(this).find('.nxt').stop().fadeTo(300, 1);
		});
		$("#"+slider_id).mouseout(function() {
		    $(this).find('.prev').stop().fadeTo(800, 0);
			$(this).find('.nxt').stop().fadeTo(800, 0);
		});
	
	});
			
	// Animate onhover	
	$('a[href*=gif] img, a[href*=jpg] img, a[href*=jpeg] img, a[href*=png] img, a[href*=tif] img,').each(function() {
		$(this).hover(function() {
            $(this).stop().animate({ opacity: 0.8 }, 400);
        },
        function() {
            $(this).stop().animate({ opacity: 1.0 }, 400);
        });
    });
	
	// equal height
	// equalHeight($(".equalh"));
	
	// Remove the borders from certain last list items.
	$( '.header_one .widget:last, .header_two .widget:last, .main_one .widget:last, .main_two .widget:last, .footer_one .widget:last, .footer_two .widget:last, #footer_area .last .powered:nth-child(1)' ).css( 'border', '0' );
	// Remove the backgrounds from certain last list items.
	$( '.main_one .widget:last, .main_two .widget:last' ).css( 'background', 'none' );
	
});