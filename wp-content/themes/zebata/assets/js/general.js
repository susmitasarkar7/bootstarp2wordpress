// JavaScript Document
jQuery(document).ready(function() {
	
	var zebataViewPortWidth = '',
		zebataViewPortHeight = '';

	function zebataViewport(){

		zebataViewPortWidth = jQuery(window).width(),
		zebataViewPortHeight = jQuery(window).outerHeight(true);	
		
		if( zebataViewPortWidth > 1200 ){
			
			jQuery('.main-navigation').removeAttr('style');
			
			var zebataSiteHeaderHeight = jQuery('.site-header').outerHeight();
			var zebataSiteHeaderWidth = jQuery('.site-header').width();
			var zebataSiteHeaderPadding = ( zebataSiteHeaderWidth * 2 )/100;
			var zebataMenuHeight = jQuery('.menu-container').height();
			
			var zebataMenuButtonsHeight = jQuery('.site-buttons').height();
			
			var zebataMenuPadding = ( zebataSiteHeaderHeight - ( (zebataSiteHeaderPadding * 2) + zebataMenuHeight ) )/2;
			var zebataMenuButtonsPadding = ( zebataSiteHeaderHeight - ( (zebataSiteHeaderPadding * 2) + zebataMenuButtonsHeight ) )/2;
		
			
			jQuery('.menu-container').css({'padding-top':zebataMenuPadding});
			jQuery('.site-buttons').css({'padding-top':zebataMenuButtonsPadding});
			
			
		}else{

			jQuery('.menu-container, .site-buttons, .header-container-overlay, .site-header').removeAttr('style');

		}	
	
	}

	jQuery(window).on("resize",function(){
		
		zebataViewport();
		
	});
	
	zebataViewport();


	jQuery('.site-branding .menu-button').on('click', function(){
				
		if( zebataViewPortWidth > 1200 ){

		}else{
			jQuery('.main-navigation').slideToggle();
		}				
		
				
	});	

    var owl = jQuery("#zebata-owl-basic");
         
    owl.owlCarousel({
             
      	slideSpeed : 300,
      	paginationSpeed : 400,
      	singleItem:true,
		navigation : true,
      	pagination : false,
      	navigationText : false,
         
    });			
	
});		