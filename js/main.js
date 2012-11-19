$(function(){
	//Launch lightbox plugin for non-mobile
	if($(window).width() > 480)
		$('#container a').lightBox();
	//Launch Masonry plugin
	var $container = $('#container');
	$container.imagesLoaded( function(){
		$('#loader').fadeOut(500);
	  	$container.masonry({
	    	itemSelector : '.item',
	    	isFitWidth: true
	  	});
	});
});