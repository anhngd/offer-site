(function($){	
	
	$(document).ready(function(){
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////						   
								
		// -------------------------------------------------------------------------------------------------------
		// Dropdown Menu
		// -------------------------------------------------------------------------------------------------------
		
		if ( ! ( $.browser.msie && ($.browser.version == 6) ) ){
			$("ul#topnav li:has(ul)").addClass("dropdown");
		}
		
		$("ul#topnav li.dropdown").hover(function () {
												 
			$('ul:first', this).css({visibility: "visible",display: "none"}).slideDown('normal');
		}, function () {
			
			$('ul:first', this).css({visibility: "hidden"});
		});
		
		
		$("div.prod_hold").hover(function () {
												 
			$('.info', this).css({visibility: "visible",display: "none"}).slideDown('normal');
		}, function () {
			
			$('.info', this).css({visibility: "hidden"});
		});
		
		$("li.cat_hold").hover(function () {
												 
			$('.info', this).fadeIn(300);
		}, function () {
			
			$('.info', this).fadeOut(200);
		});
		
		$("li.side_cart").hover(function () {
												 
			$('#cart', this).fadeIn(500);
			
			$('#cart').addClass('active');
		
		$('#cart').load('index.php?route=module/cart #cart > *');
		
		$.ajax({
			url: 'index.php?route=checkout/cart/update',
			dataType: 'json',
			success: function(json) {
				if (json['output']) {
					$('#cart .content').html(json['output']);
				}
			}
		});			
		
		$('#cart').live('mouseleave', function() {
			$(this).removeClass('active');
		});	
			
			
		}, function () {
			
			$('#cart', this).fadeOut(200);
		});
		
		$("li.side_currency").hover(function () {
												 
			$('#currency', this).fadeIn(500);
		}, function () {
			
			$('#currency', this).fadeOut(200);
		});
		
		$("li.side_lang").hover(function () {
												 
			$('#language', this).fadeIn(500);
		}, function () {
			
			$('#language', this).fadeOut(200);
		});
		
		$("li.side_search").hover(function () {
												 
			$('#search', this).fadeIn(500);
		}, function () {
			
			$('#search', this).fadeOut(200);
		});
		
		$(".main_menu li").hover(function () {
												 
			$('.secondary', this).fadeIn(500);
		}, function () {
			
			$('.secondary', this).fadeOut(200);
		});
		


		
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	});
	
})(window.jQuery);	

// non jQuery scripts below