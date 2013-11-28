/*
	Any site-specific scripts you might have.
	Note that <html> innately gets a class of "no-js".
	This is to allow you to react to non-JS users.
	Recommend removing that and adding "js" as one of the first things your script does.
	Note that if you are using Modernizr, it already does this for you. :-)
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
	  var new_img = $('.flex-active-slide').children('img.this').attr('title');
	  $.backstretch('' + new_img + '');
	  //showimg();
	}
  });
  
  // Home
  if ($('body').hasClass('home')) {
  
  	var new_img = $('.flex-active-slide').children('img.this').attr('title');
	 $.backstretch(new_img, {duration: 3000, fade: 750});
	//showimg();
  }
  
  function showimg() {
	  $('.backstretch img').bind('load', function() {
	    $(this).fadeTo( "fast", 1);
	  });
  }
      
});
 