/*
	Any site-specific scripts you might have.
*/


$(function() {
  
  if (!$(window).width() <= 767) {
  	//AdjustHomePage();
  }
  
  AdjustHomeSlider();
  
  $('#home-gallery').flexslider({
    animation: "fade",
    slideshow: true,
    controlNav: true,
    directionNav: false,
	keyboardNav: true,
	slideshowSpeed: 7000,
	pauseOnHover: false,	 				
	animationLoop: true,
	animationSpeed: 1500,
	after: function(){
	  var new_img = $('.flex-active-slide').children('img.this').attr('src');
	  $.backstretch('' + new_img + '');
	}
  });
  
  /*
   * Imagen de fondo
   */
  if ($('body').hasClass('home')) {
  	var new_img = $('.flex-active-slide').children('img.this').attr('src');
	$.backstretch(new_img, {duration: 1200, fade: 600});
	 
  } else if ($('body').hasClass('single-projectready')) {
  
   $('#container').css('background-color', 'rgba(255, 255, 255, 0.75)');
	 var new_img = $('#back-image').children('img').attr('src');
	 $.backstretch(new_img, {duration: 2000, fade: 750}); 
  
  } else if ($('body').hasClass('single-projectsale') ) {
     $('#container').css('background-color', 'rgba(255, 255, 255, 0.8)');
	 var new_img = $('#back-image').children('img').attr('src');
	 $.backstretch(new_img, {duration: 2000, fade: 750}); 

  } else {
     $('#container').css('background-color', 'rgba(255, 255, 255, 0.6)');
	 var new_img = $('#back-image').children('img').attr('src');
	 $.backstretch(new_img, {duration: 2000, fade: 750}); 
  }
  
  /*
  * Galerías
  */
  $('#project-gallery').flexslider({
     animation: "slide",
     controlNav: "thumbnails",
     startAt: 0, 
     slideshow: false,
     directionNav: false,
     start: function(slider){
       $('#product-gallery div').removeClass('loading');
     }
    });
    
   $('#entorno-gallery').flexslider({
    animation: "fade",
    slideshow: true,
    controlNav: false,
    directionNav: true,
	keyboardNav: true,
	slideshowSpeed: 7000,
	pauseOnHover: false,	 				
	animationLoop: true
  });
  
  $('.emplazamiento-gallery').flexslider({
    animation: "fade",
    slideshow: true,
    controlNav: false,
    directionNav: true,
	keyboardNav: true,
	slideshowSpeed: 7000,
	pauseOnHover: false,	 				
	animationLoop: true
  });
  
  $('#page-gallery').flexslider({
    animation: "fade",
    slideshow: true,
    controlNav: false,
    directionNav: true,
	keyboardNav: true,
	slideshowSpeed: 7000,
	pauseOnHover: false,	 				
	animationLoop: true
  });
   
   $('.carousel-gallery').flexslider({
    animation: "slide",
    animationLoop: false,
    controlNav: false,
    itemWidth: 145,
    itemMargin: 5
  });
  
  
	$('#list-modules a.title').click(function(e) {
		  e.preventDefault();
		  $(this).siblings(".text").slideToggle('slow');
		  $(this).parents('li').toggleClass('close');
		  $(this).parents('li').toggleClass('open');
	});
   
});

/*
* Ajustar tamaño ventana
*/
$( window ).resize(function() {
	AdjustHomeSlider()
});

/*
* Ajustar HomeGallery Slider
*/
function AdjustHomeSlider() {
  var WW = jQuery(window).width();
  var WH = jQuery(window).height();
  var footer = $('#footer').height();
  var totalHeight = WH - footer;
  //console.log(totalHeight);
  
  $('#home-gallery').css({width: WW,height: totalHeight});
  $('#home-gallery .slides li').css({height: totalHeight});
 
}

/*
* Efectos
*/
$(function() {
 if( !/Android|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent) ) { 
	var hw = $(window).height();
	var htop = $('.project-top').height();	
	var hbre = $('#breadcrumbs').height();
	var hfooter = $('#footer').height();
	var value = hfooter;
	$('article.projectsale .inner').css('height', hw-htop-hfooter-hbre-value);
	$('.project-content').css('height', hw-htop-hfooter-hbre-value);
	$('.section').css('min-height', hw-htop-hfooter-hbre-value-50);
  }
});

/*
* Iconos proyecots
*/
$(function() {
 	$('#list-projects .model.departamentos').prepend('<i class="icon-commerical-building"></i>');
 	$('#list-projects .model.casas').prepend('<i class="icon-home"></i>');
 	$('#list-projects .model.oficinas').prepend('<i class="icon-building"></i>');
 	$('#list-projects .model.comercial').prepend('<i class="icon-shop"></i>');
 	$('#list-projects .model.preventa').prepend('<i class="icon-key"></i>');
 	$('#list-projects .model.condominios').prepend('<i class="icon-warehouse"></i>');
 	
 	
 	$('.single h1.entry-title.departamentos').prepend('<i class="icon-commerical-building"></i>');
 	$('.single h1.entry-title.casas').prepend('<i class="icon-home"></i>');
 	$('.single h1.entry-title.oficinas').prepend('<i class="icon-building"></i>');
 	$('.single h1.entry-title.comercial').prepend('<i class="icon-shop"></i>');
 	$('.single h1.entry-title.preventa').prepend('<i class="icon-key"></i>');
 	$('.single h1.entry-title.condominios').prepend('<i class="icon-warehouse"></i>');
});


/*
* Menu proyectos ipad scroll
*/
$(function() {
// This one is important, many browsers don't reset scroll on refreshes
	// Reset all scrollable panes to (0,0)
	if( !/Android|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent) ) { 
		$('.project-content').scrollTo( 0 );
		// Reset the screen to (0,0)
		$.scrollTo( 0 );
	
	
		$('a.btn-s1').click(function(){
			$('.project-content').stop().scrollTo( '#section-1', 800 );
		});
		
		$('a.btn-s2').click(function(){
			$('.project-content').stop().scrollTo( '#section-2', 800 );
		});
		
		$('a.btn-s3').click(function(){
			$('.project-content').stop().scrollTo( '#section-3', 800 );
		});
		
		$('a.btn-s4').click(function(){
			$('.project-content').stop().scrollTo( '#section-4', 800 );
		});
		
		$('a.btn-s5').click(function(){
			$('.project-content').stop().scrollTo( '#section-5', 800 );
		});
		
		$('a.btn-s6').click(function(){
			$('.project-content').stop().scrollTo( '#section-6', 800 );
		});
		
		$('a.btn-s7').click(function(){
			$('.project-content').stop().scrollTo( '#section-7', 800 );
		});
	} else {
		$('a.btn-s2').click(function(){
			$.mobile.silentScroll($('#section-2').offset().top);
			return false;
		});
		$('a.btn-s3').click(function(){
			$.mobile.silentScroll($('#section-3').offset().top);
			return false;
		});
		$('a.btn-s4').click(function(){
			$.mobile.silentScroll($('#section-4').offset().top);
			return false;
		});
		$('a.btn-s5').click(function(){
			$.mobile.silentScroll($('#section-5').offset().top);
			return false;
		});
		$('a.btn-s6').click(function(){
			$.mobile.silentScroll($('#section-6').offset().top);
			return false;
		});
		$('a.btn-s7').click(function(){
			$.mobile.silentScroll($('#section-7').offset().top);
			return false;
		});
		$('a.btn-s1').click(function(){
			$.mobile.silentScroll($('#section-1').offset().top);
			return false;
		});
		
		$('.icon-angle-up').click(function(){
			$.mobile.silentScroll(200);
		});
	}
});
 
/*
* Menu "current" class - Proyectos
*/
$(function() {

	var $menu = $('#submenu.project'),
	$menuli = $menu.find('li');
	
	if( !/Android|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent) ) { 
	$menuli.click(function(){
        var $this = $(this);
        $this.siblings('li.current').removeClass('current');
        if ( $this.hasClass('current') ) {
         	return false;
        } 

        $this.addClass('current');
	});
	} else {
		$( $menuli ).bind( "tap", tapHandler );
 
	  function tapHandler( event ){
	    var $this = $(this);
        $this.siblings('li.current').removeClass('current');
        if ( $this.hasClass('current') ) {
         	return false;
        } 
        $this.addClass('current');
	  }
	}
	
	if( !/Android|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent) ) { 
	var opts = {
    offset: '-1',
    context: '.project-content'
	};
			
	$('#section-1').waypoint(function(event, direction) {
	    $('.btn-s1').parent('li').addClass('current');
	    $('.btn-s1').parent('li').siblings('li.current').removeClass('current');
	}, opts);
	
	//#section-2
	$('#section-2').waypoint(function(direction) {
		if (direction === "down") {
			$('.btn-s2').parent('li').addClass('current');
			$('.btn-s2').parent('li').siblings('li.current').removeClass('current');
	      }}, {offset: '10%', context: '.project-content'});
    
    $('#section-2').waypoint(function(direction) {
		if (direction === "up") {
			$('.btn-s2').parent('li').addClass('current');
			$('.btn-s2').parent('li').siblings('li.current').removeClass('current');
	      }}, {offset: '-1', context: '.project-content'});
	
	//#section-3
	$('#section-3').waypoint(function(direction) {
		if (direction === "down") {
			$('.btn-s3').parent('li').addClass('current');
			$('.btn-s3').parent('li').siblings('li.current').removeClass('current');
	      }}, { offset: '10%', context: '.project-content'});
	
	$('#section-3').waypoint(function(direction) {
		if (direction === "up") {
			$('.btn-s3').parent('li').addClass('current');
			$('.btn-s3').parent('li').siblings('li.current').removeClass('current');
	      }}, { offset: '-1', context: '.project-content'});      
	 
	
	//#section-4
	$('#section-4').waypoint(function(direction) {
		if (direction === "down") {
			$('.btn-s4').parent('li').addClass('current');
			$('.btn-s4').parent('li').siblings('li.current').removeClass('current');
	      }}, { offset: '10%', context: '.project-content'});
	
	$('#section-4').waypoint(function(direction) {
		if (direction === "up") {
			$('.btn-s4').parent('li').addClass('current');
			$('.btn-s4').parent('li').siblings('li.current').removeClass('current');
	      }}, { offset: '-1', context: '.project-content'}); 
	
	//#section-4
	$('#section-5').waypoint(function(direction) {
		if (direction === "down") {
			$('.btn-s5').parent('li').addClass('current');
			$('.btn-s5').parent('li').siblings('li.current').removeClass('current');
	      }}, { offset: '10%', context: '.project-content'});
	
	$('#section-5').waypoint(function(direction) {
		if (direction === "up") {
			$('.btn-s5').parent('li').addClass('current');
			$('.btn-s5').parent('li').siblings('li.current').removeClass('current');
	      }}, { offset: '-1', context: '.project-content'}); 
	
	//#section-6
	$('#section-6').waypoint(function(direction) {
		if (direction === "down") {
			$('.btn-s6').parent('li').addClass('current');
			$('.btn-s6').parent('li').siblings('li.current').removeClass('current');
	      }}, { offset: '10%', context: '.project-content'});
	
	$('#section-6').waypoint(function(direction) {
		if (direction === "up") {
			$('.btn-s6').parent('li').addClass('current');
			$('.btn-s6').parent('li').siblings('li.current').removeClass('current');
	      }}, { offset: '-1', context: '.project-content'}); 
	
	//#section-7
	$('#section-7').waypoint(function(direction) {
		if (direction === "down") {
			$('.btn-s7').parent('li').addClass('current');
			$('.btn-s7').parent('li').siblings('li.current').removeClass('current');
	      }}, { offset: '10%', context: '.project-content'});
	
	$('#section-7').waypoint(function(direction) {
		if (direction === "up") {
			$('.btn-s7').parent('li').addClass('current');
			$('.btn-s7').parent('li').siblings('li.current').removeClass('current');
	      }}, { offset: '-1', context: '.project-content'});

	}//end waypoint
	
});

/*
* Menu principal mobile
*/
$(function() {

   $('header')      
      .find('a.btn-menu')
         .bind('click focus', function(){
            $(this).toggleClass('expanded');
            $('#access').slideToggle();
         });   
});



/*
function AdjustHomePage() {

	var WH = jQuery(window).height();
	var WW = jQuery(window).width();
	var imgWidth = jQuery('ul.slides li img').width();
	var imgHeight = jQuery('ul.slides li img').height();
	var imgheaderHeight = jQuery('#header').height();
	var imgRatio = imgWidth / imgHeight;
	var Left = 0;
	var Top = 0;
	
	var rootWidth = WW;
	var rootHeight = WH;
	
	var finalHeight = rootHeight - imgheaderHeight;
	
	var bgWidth = parseInt(rootWidth);

	var bgHeight = bgWidth / imgRatio;

	if(bgHeight >= rootHeight) {
		bgOffset = (bgHeight - rootHeight) /2;
		Top = "-" + bgOffset + "px";
	} else {
		bgHeight = rootHeight;
		bgWidth = bgHeight * imgRatio;
		bgOffset = (bgWidth - rootWidth) / 2;
		Left = "-" + bgOffset + "px";
	}

	jQuery('#home-gallery.flexslider ul').css({width: rootWidth, height: finalHeight}).find("li").css({width: bgWidth, height: finalHeight, left: Left, top: Top});
	
	jQuery('.single .backstretch').css({width: rootWidth, height: rootHeight}).find("img").css({width: bgWidth, height: bgHeight, left: Left, top: Top});
	
}
*/


/*
* Fancybox img proyectos
*/
$(function() {
	$('a.fancybox').fancybox({padding : 4,
		helpers: {
		    overlay: {
		      locked: true
		    }
		},
		afterShow: function() {
	        if ('ontouchstart' in document.documentElement){
	            //$('.fancybox-nav').css('display','none');
	            $('.fancybox-wrap').swipe({
	                swipe : function(event, direction) {
	                    if (direction === 'left' || direction === 'up') {
	                        $.fancybox.prev( direction );
	                    } else {
	                        $.fancybox.next( direction );
	                    }
	                }
	            });
	        }
	    }
	});
});
	
 
/*
*  render_map - proyectos
*
*  This function will render a Google Map onto the selected jQuery element
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$el (jQuery element)
*  @return	n/a
*/

(function($) { 
	function render_map( $el ) {
	 
		// var
		var $markers = $el.find('.marker');
	 
		// vars
		var args = {
			zoom		: 16,
			center		: new google.maps.LatLng(0, 0),
			mapTypeId	: google.maps.MapTypeId.ROADMAP
		};
	 
		// create map	        	
		var map = new google.maps.Map( $el[0], args);
	 
		// add a markers reference
		map.markers = [];
	 
		// add markers
		$markers.each(function(){
	 
	    	add_marker( $(this), map );
	 
		});
	 
		// center map
		center_map( map );
	 
	}
 
/*
*  add_marker
*
*  This function will add a marker to the selected Google Map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$marker (jQuery element)
*  @param	map (Google Map object)
*  @return	n/a
*/
 
	function add_marker( $marker, map ) {
	 
		// var
		var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );
	 
		// create marker
		var marker = new google.maps.Marker({
			position	: latlng,
			map			: map
		});
	 
		// add to array
		map.markers.push( marker );
	 
		// if marker contains HTML, add it to an infoWindow
		if( $marker.html() )
		{
			// create info window
			var infowindow = new google.maps.InfoWindow({
				content		: $marker.html()
			});
	 
			// show info window when marker is clicked
			google.maps.event.addListener(marker, 'click', function() {
	 
				infowindow.open( map, marker );
	 
			});
		}
	 
	}
 
/*
*  center_map
*
*  This function will center the map, showing all markers attached to this map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	map (Google Map object)
*  @return	n/a
*/
 
	function center_map( map ) {
	 
		// vars
		var bounds = new google.maps.LatLngBounds();
	 
		// loop through all markers and create bounds
		$.each( map.markers, function( i, marker ){
	 
			var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );
	 
			bounds.extend( latlng );
	 
		});
	 
		// only 1 marker?
		if( map.markers.length == 1 )
		{
			// set center of map
		    map.setCenter( bounds.getCenter() );
		    map.setZoom( 16 );
		}
		else
		{
			// fit to bounds
			map.fitBounds( bounds );
		}
	 
	}
	 
/*
*  document ready
*
*  This function will render each map when the document is ready (page has loaded)
*
*  @type	function
*  @date	8/11/2013
*  @since	5.0.0
*
*  @param	n/a
*  @return	n/a
*/
 
	$(document).ready(function(){
	 
		$('.acf-map').each(function(){
	 
			render_map( $(this) );
	 
		});
	 
	});
 
})(jQuery);


/*! A fix for the iOS orientationchange zoom bug.
 Script by @scottjehl, rebound by @wilto.
 MIT License.
*/
(function(w){
	// This fix addresses an iOS bug, so return early if the UA claims it's something else.
	if( !( /iPhone|iPad|iPod/.test( navigator.platform ) && navigator.userAgent.indexOf( "AppleWebKit" ) > -1 ) ){ return; }
    var doc = w.document;
    if( !doc.querySelector ){ return; }
    var meta = doc.querySelector( "meta[name=viewport]" ),
        initialContent = meta && meta.getAttribute( "content" ),
        disabledZoom = initialContent + ",maximum-scale=1",
        enabledZoom = initialContent + ",maximum-scale=10",
        enabled = true,
		x, y, z, aig;
    if( !meta ){ return; }
    function restoreZoom(){
        meta.setAttribute( "content", enabledZoom );
        enabled = true; }
    function disableZoom(){
        meta.setAttribute( "content", disabledZoom );
        enabled = false; }
    function checkTilt( e ){
		aig = e.accelerationIncludingGravity;
		x = Math.abs( aig.x );
		y = Math.abs( aig.y );
		z = Math.abs( aig.z );
		// If portrait orientation and in one of the danger zones
        if( !w.orientation && ( x > 7 || ( ( z > 6 && y < 8 || z < 8 && y > 6 ) && x > 5 ) ) ){
			if( enabled ){ disableZoom(); } }
		else if( !enabled ){ restoreZoom(); } }
	w.addEventListener( "orientationchange", restoreZoom, false );
	w.addEventListener( "devicemotion", checkTilt, false );
})( this );


