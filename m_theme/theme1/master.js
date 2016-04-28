//
// Automatically calls all functions in SLAB.init
//

var sidebar = $('#sidebar');
var sidebar_height=$('#sidebar_inner').outerHeight();
var main_height=$('#main').outerHeight();
var angle = window.orientation;
var body = $('body');
var body_width = body.outerWidth();
var body_height = body.outerHeight();
var myWidth;
var myHeight;

function innerBlock () {
	if ( $('#home').css('left')=='-100%'){
		$('.navigation').hide();
		$('.logo').hide();
		$('#pageTitle').show();
		
	}
	else {
			
		$('.navigation').show();
		$('.logo').show();
		$('#pageTitle').hide();
	};
};

function outBlock () {
		$('.navigation').show();
		$('.logo').show();
		$('#pageTitle').hide();
};

$(document).ready(function(){
	setTimeout(function(){
		innerBlock ();
	}, 2000);
	
});

$('.back').click(function() {
	outBlock ();
});

$('#sidebar').hide();

$('#button_navigation').click(function() {
	
	if (sidebar_height >= window.innerHeight){
		myHeight = sidebar_height;
		}
	else {
		myHeight = window.innerHeight;
		}
	//iphone
	$('#main').css( 'min-height', myHeight );
	$('#main').css( 'max-height', myHeight );
	$('#mUser').css( 'min-height', myHeight );
	$('#mUser').css( 'max-height', myHeight );
	$('#sidebar_inner').css( 'min-height', myHeight );
	$('#sidebar_inner').css( 'max-height', myHeight );
	$('#sidebar').css( 'min-height', '100%' );
	$('#sidebar').css( 'max-height', '100%' );
	$('#main').addClass('slide_content');
	
	if (sidebar.is(':hidden')) {
		$('#sidebar').show();
		$('#button_navigation').addClass('button_active');
		$('#sidebar').css( 'left', '0' );
		$body = $('body').css( 'margin-left', '320' );
		$('#main').css('left', '320px');
		$('#main').css('position', 'absolute');
		$('.toolbar').css( 'left', '320px' );
		$('#topbar').css( 'left', '320px' );
		$('.header_lower').css( 'left', '320' );
	}
	else {
		$('#button_navigation').removeClass('button_active');
		$('#sidebar').hide();
		$('#sidebar').css( 'left', '-320' );
		
		$body = $('body').css( 'margin-left', '0' );
		$('#main').css('left', '0')
		$('#main').css('position', 'relative');
		$('.toolbar').css( 'left', '0' );
		$('#topbar').css( 'left', '0' );
		$('.header_lower').css( 'left', '0' );
	 $('#main').css( 'min-height', '100%' );
	$('#main').css( 'max-height', '100%' );
	$('#main').removeClass('slide_content');
	}
	//end iphone
	

});

//Back menu left
$('#button_back').click(function() {
	
	$('#main').css( 'min-height', '100%' );
	$('#main').css( 'max-height', '100%' );
	$('#main').removeClass('slide_content');
	$('#topbar').css( 'left', '0' );
	$('#button_navigation').removeClass('button_active');
	$('#sidebar').css( 'left', '-320px' );
	$body = $('body').css( 'margin-left', '0' );
	$('#main').css('left', '0')
	$('#main').css('position', 'relative');
	$('.header_upper').css( 'left', '0' );
	$('.header_lower').css( 'left', '0' );
	$('#sidebar').hide();
	
});

$('#napSMS').click(function() {
	$('.toolbar').css( 'left', '0' );
	$('.navigation').hide();
	
});

$('#napCard').click(function() {
	$('.toolbar').css( 'left', '0' );
	$('.navigation').hide();
	
});
$('#napBank').click(function() {
	$('.toolbar').css( 'left', '0' );
	$('.navigation').hide();
	
});
$('#napBank').click(function() {
	$('.toolbar').css( 'left', '0' );
	$('.navigation').hide();

});

$('.back').click(function() {
	$('.toolbar').css( 'left', '320' );
});	

$(':input[placeholder]').each(function() {
	var el = $(this);
	var text = el.attr('placeholder');

	if (!el.val() || el.val() === text) {
	el.val(text).addClass('placeholder_text');
	}

	el.focus(function() {
	if (el.val() === text) {
		el.val('').removeClass('placeholder_text');;
	}
	}).blur(function() {
	if (!el.val()) {
		el.val(text).addClass('placeholder_text');;
	}
	});
});

function adjust_angle() {
	if (body_width <= 320){
		body.removeClass('is_landscape');
		body.addClass('is_portrait');
		$('#picOtherapp').removeClass('sliderApp-h');
		$('#picOtherapp').addClass('sliderApp-v');
		$('#picThumb').removeClass('flexslider-h');
		$('#picThumb').addClass('flexslider-v');
	}
	else {
		body.removeClass('is_portrait');
		body.addClass('is_landscape');
		$('#picOtherapp').removeClass('sliderApp-v');
		$('#picOtherapp').addClass('sliderApp-h');
		$('#picThumb').removeClass('flexslider-v');
		$('#picThumb').addClass('flexslider-h');
	}
 
	if ( body_width >= 0) {
		//$('.header_upper').css( 'left', '0' );
		$('.header_lower').css( 'left', '0' );
		
	}
	else {
		//sidebar.show();
		$('#sidebar').css( 'left', '0' );
		
	
	}
	
	if (sidebar.is(':hidden')){	
		$("#pageslide").css( 'display', 'none' );
	}
	else {
		body.addClass('is_landscape');
		
	}
	
}

adjust_angle();

$(window).bind('resize orientationchange', function() {
	adjust_angle();
});
	    


//Slide left page

//Slide popup left tym



//$(function(){
//    SyntaxHighlighter.all();
//});

$(window).load(function(){
    $('.flexslider-v').flexslider({
	animation: "slide",
	animationLoop: true,
	itemWidth: 240,
	itemMargin: 0,
	start: function(slider){
	    $('body').removeClass('loading');
	}
    });
});

$(window).load(function(){
    $('.flexslider-h').flexslider({
	animation: "slide",
	animationLoop: true,
	itemWidth: 160,
	itemMargin: 0,
	start: function(slider){
	    $('body').removeClass('loading');
	}
    });
});

$(window).load(function(){
    $('.sliderMenu').flexslider({
	animation: "slide",
	animationLoop: false,
	itemWidth: 108 ,
	itemMargin: 0,
	start: function(slider){
	    $('body').removeClass('loading');
	}
    });
});

$(window).load(function(){
    $('.sliderBanner').flexslider({
	animation: "slide",
	animationLoop: true,
	itemWidth: 320 ,
	itemMargin: 0,
	start: function(slider){
	    $('body').removeClass('loading');
	}
    });
});

$(window).load(function(){
    $('.sliderApp-v').flexslider({
	animation: "slide",
	animationLoop: true,
	itemWidth: 300,
	itemMargin: 0,
	slideshow: false,  
	start: function(slider){
	    $('body').removeClass('loading');
	}
    });
});

$(window).load(function(){
    $('.sliderApp-h').flexslider({
	animation: "slide",
	animationLoop: true,
	itemWidth: 460,
	itemMargin: 0,
	slideshow: false,  
	start: function(slider){
	    $('body').removeClass('loading');
	}
    });
	
	 $('.sliderApp').flexslider({
	animation: "slide",
	animationLoop: true,
	itemWidth: 979,
	itemMargin: 0,
	slideshow: false, 
	start: function(slider){
	    $('body').removeClass('loading');
	}
    });
	
	
});



$(document).ready(function(){
	setTimeout(function(){
		var height = $('#anhdautien').height();
		var width = $('#anhdautien').width();
		if(height>width){
			$('.list_carousel').attr('id','typepic1'); 
		} else {
			$('.list_carousel').attr('id','typepic2'); 
		}
		
	}, 1000);
	
});
                                                    
                                                    