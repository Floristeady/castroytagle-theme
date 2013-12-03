/*
	Any site-specific scripts you might have.
*/

/*****Flexislider Home*****/
$(function() {
  
  $('#home-gallery').flexslider({
    animation: "fade",
    slideshow: true,
    controlNav: true,
    directionNav: false,
	keyboardNav: true,
	slideshowSpeed: 7000,
	pauseOnHover: false,	 				
	animationLoop: true,
	after: function(){
	  var new_img = $('.flex-active-slide').children('img.this').attr('src');
	  $.backstretch('' + new_img + '');
	}
  });
  
  $('#home-gallery .flex-control-nav').prepend('<li class="title">PROYECTOS</li>');
  
  // Home
  if ($('body').hasClass('home')) {
  	var new_img = $('.flex-active-slide').children('img.this').attr('src');
	 $.backstretch(new_img, {duration: 3000, fade: 750});
	 
  } else if ($('body').hasClass('single-projectready') || $('body').hasClass('single-projectsale')  ){
     $('#container').css('background-color', 'rgba(255, 255, 255, 0.85)');
	 var new_img = $('#back-image').children('img').attr('src');
	 $.backstretch(new_img, {duration: 3000, fade: 750}); 

  } else {
     $('#container').css('background-color', 'rgba(255, 255, 255, 0.6)');
	 var new_img = $('#back-image').children('img').attr('src');
	 $.backstretch(new_img, {duration: 3000, fade: 750}); 
  }
  
  $('#project-gallery').flexslider({
     animation: "slide",
     controlNav: "thumbnails",
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
   
   $('.carousel-gallery').flexslider({
    animation: "slide",
    animationLoop: false,
    controlNav: false,
    itemWidth: 145,
    itemMargin: 5
  });
   
});

//Efectos 
$(function() {
 if( !/Android|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent) ) { 
	var hw = $(window).height();
	var htop = $('.project-top').height();	
	var hbre = $('#breadcrumbs').height();
	var hfooter = $('#footer').height();
	//console.log(hfooter);
	var value = hfooter;
	$('article.projectsale .inner').css('height', hw-htop-hfooter-hbre-value);
	$('.project-content').css('height', hw-htop-hfooter-hbre-value);
	$('.section').css('height', hw-htop-hfooter-hbre-value-50);
  }
});

//Add Icons
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


$(function() {
// This one is important, many browsers don't reset scroll on refreshes
	// Reset all scrollable panes to (0,0)
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
});
 
/*menu current page*/
$(function() {

	var $menu = $('#submenu.project'),
	$menuli = $menu.find('li');
	
	$menuli.click(function(){
        var $this = $(this);
        $this.siblings('li.current').removeClass('current');
        // don't proceed if already selected
        if ( $this.hasClass('current') ) {
         	return false;
        } 

        $this.addClass('current');
	});
});


$(function() {
	$('a.fancybox').fancybox();
});
	
 
/*
*  render_map
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

