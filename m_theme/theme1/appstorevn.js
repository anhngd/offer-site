			
		
//master
window.onload = function() {
    setTimeout(function(){
	window.scrollTo(0, 1);
    }, 100);
}
//Click

$(document).ready(function() {
    $('#pTYM').hide();
    $('#dTYM').hide();
    $('#cTYM').hide();
    $('#sUser').hide();
    $('.cancel').hide();
	$('.search').hide();
	
	if ($('.followMsg').is(':hidden')) {
		$('.info-follow').addClass('no-follow');
	}
	else {
		$('.info-follow').addClass('on-follow');
	}
	
	$('.tabSupport').click(function(){
	$("textarea.areaSupport:last").focus();
	});

	
	$('.smPost').hide();
	$('.txtStatus').click(function(){
	$("textarea.txtStatus:last").focus();
	$('.smPost').show();
	});
	
	$('.smPost').click(function(){
	  $('.smPost').hide();	
	  $('.txtStatus').val('');
	});
	
	$('.ipButton').hide();
	$('.ipText').click(function(){
	$(".ipText:last").focus();
	$('.ipButton').show();
	});
	$(".ipText:last").focusout(function() {
		$('.ipButton').hide();
	});
	
	$('#q').click(function(){
		$('.cancel').show();
		$("input#q:last").focus();
    });
	
	$("input#q:last").focusout(function() {
        $('.cancel').hide();
    });
	$('.t-share').click(function(){
			
	if ($('.share').is(':hidden')) {
		$('.share').show();
		$('.search').hide();
		}
	else {
		$('.share').hide();
		$('.search').hide();
		}
    });
	$('#a').click(function(){
	 $('.tabLine').addClass('s1');
	 $('.tabLine').removeClass('s2');
	 $('.tabLine').removeClass('s3');
		});
	$('.is_search').click(function(){
			
	if ($('.search').is(':hidden')) {
		$('.listTab').hide();
		$('#tabmenu').hide();
		$('.search').show();
		$('.is_search').show();
		$('.no_search').hide();
		$(".share").hide();
		$("input#search:last").focus();
		}
	else {
		$('.listTab').show();
		$('#tabmenu').show();
		$('.search').hide();
		$('.is_search').show();
		$('.no_search').hide();
		$(".share").hide();
		}
    });
$('#b').click(function(){
	 $('.tabLine').removeClass('s1');
	 $('.tabLine').addClass('s2');
	 $('.tabLine').removeClass('s3');
		});
	$('#c').click(function(){
	$('.tabLine').removeClass('s1');
	 $('.tabLine').removeClass('s2');
	 $('.tabLine').addClass('s3');
		});	
		
    $("#smsTYM").css( 'left', '300px' );
    $("#cardTYM").css( 'left', '300px' );
    $("#bankTYM").css( 'left', '300px' );
    $("#paypalTYM").css( 'left', '300px' );
   
    $('#napTYM').click(function(){
	$('#startTYM').show();
	$('#smsTYM').hide();
	$('#cardTYM').hide();
	$('#bankTYM').hide();
	$('#paypalTYM').hide();
	
	$('#dTYM').hide();
	$('#cTYM').hide();
	//$("#pTYM").css( 'height', '215px' );     
	
	
	if ($('#pTYM').is(':hidden')) {
		$('#pTYM').show();
		$('#pTYM').css('-webkit-transform', 'scale(1)');
		$('#pTYM').transition({
	    scale: 5	});
		}
	else {
		$('#pTYM').hide();
		$('#pTYM').css('-webkit-transform', 'scale(0)');
		$('#pTYM').transition({
	    scale: 0	});
		}
		
    });
   
    $('#doiTYM').click(function(){
	
	$('#pTYM').hide();
	$('#cTYM').hide();
	//$("#dTYM").css( 'height', '406px' );     
	
	if ($('#dTYM').is(':hidden')) {
		$('#dTYM').show();
		$('#dTYM').css('-webkit-transform', 'scale(1)');
		$('#dTYM').transition({
	    scale: 5
	});
		}
	else {
		$('#dTYM').hide();
		$('#dTYM').css('-webkit-transform', 'scale(0)');
		$('#dTYM').transition({
	    scale: 0
	});
		}
		
    });
    
    $('#napCODE').click(function(){
	$('#pTYM').hide();
	$('#dTYM').hide();
	//$("#cTYM").css( 'height', '202px' );     
	
	if ($('#cTYM').is(':hidden')) {
		$('#cTYM').show();
		$('#cTYM').css('-webkit-transform', 'scale(1)');
		$('#cTYM').transition({
	    scale: 5
	});
		}
	else {
		$('#cTYM').hide();
		$('#cTYM').css('-webkit-transform', 'scale(0)');
		$('#cTYM').transition({
	    scale: 0
	});
		}
	
    });
    
    $('#goSms').click(function(){
	//$("#pTYM").css( 'height', '315px' );
	
	$("#startTYM").animate({
	    left:"-300px"
	},"fast");
	$('#startTYM').hide();
	$('#smsTYM').show();
	$("#smsTYM").animate({
	    left:"0"
	},"fast");
    });
   
    $('#goCard').click(function(){
	//$("#pTYM").css( 'height', '368px' );
	$("#startTYM").animate({
	    left:"-300px"
	},"fast");
	$('#startTYM').hide();
	$('#cardTYM').show();
	$("#cardTYM").animate({
	    left:"0"
	},"fast");
    });
   
    $('#goBank').click(function(){
	//$("#pTYM").css( 'height', '198px' );
	$("#startTYM").animate({
	    left:"-300px"
	},"fast");
	$('#startTYM').hide();
	$('#bankTYM').show();
	$("#bankTYM").animate({
	    left:"0"
	},"fast");
    });
   
    $('#goPaypal').click(function(){
	//$("#pTYM").css( 'height', '198px' );
	$("#startTYM").animate({
	    left:"-300px"
	},"fast");
	$('#startTYM').hide();
	$('#paypalTYM').show();
	$("#paypalTYM").animate({
	    left:"0"
	},"fast");
    });
   
    $('.sign-in').click(function(){
	if ($('#iUser').is(':hidden')) {
			$('#iUser').show();
			$('#iUser').css('-webkit-transform', 'scale(1)');
			}
		else {
			$('#iUser').css('-webkit-transform', 'scale(0)');
			$('#iUser').hide();
			}
	
    });
    
    $('.sign-up').click(function(){
		if ($('#iUser').is(':hidden')) {
			$('#iUser').show();
			$('#iUser').css('-webkit-transform', 'scale(1)');
			}
		else {
			$('#iUser').css('-webkit-transform', 'scale(0)');
			$('#iUser').hide();
			}
    });
    
    $('.goSignUp').click(function(){
	$('#iUser').hide();
	$('#uUser').show();
	$('#uUser').css('-webkit-transform', 'scale(1)');
	
    });
    
    $('.goForgotPass').click(function(){
	$('#iUser').hide();
	$('#uUser').hide();
	$('#iforgotUser').show();
	$('#iforgotUser').css('-webkit-transform', 'scale(1)');
	
    });
    
    $('.goSignIn').click(function(){
	$('#uUser').hide();
	$('#iforgotUser').hide();
	$('#iUser').show();
	$('#iUser').css('-webkit-transform', 'scale(1)');
	
    });
    
    $('.closePopup').click(function(){
	//$("#pTYM").css( 'height', '215px' );
	$('#pTYM').hide();
	$('#dTYM').hide();
	$('#cTYM').hide();
	$('#iUser').hide();
	$('#uUser').hide();
	$('#iforgotUser').hide();
	
	$('#pTYM').css('-webkit-transform', 'scale(0)');
	$('#dTYM').css('-webkit-transform', 'scale(0)');
	$('#cTYM').css('-webkit-transform', 'scale(0)');
	$('#iUser').css('-webkit-transform', 'scale(0)');
	$('#uUser').css('-webkit-transform', 'scale(0)');
	$('#iforgotUser').css('-webkit-transform', 'scale(0)');
	
	$('#startTYM').show();
	$("#startTYM").animate({
	    left:"0"
	},"fast");
	$("#smsTYM").animate({
	    left:"300px"
	},"fast");
	$("#cardTYM").animate({
	    left:"300px"
	},"fast");
	$("#bankTYM").animate({
	    left:"300px"
	},"fast");
	$("#paypalTYM").animate({
	    left:"300px"
	},"fast");
    });
   
    $('.backPopup').click(function(){
	//$("#pTYM").css( 'height', '215px' );  
	$("#startTYM").animate({
	    left:"0"
	},"fast");
	$("#smsTYM").animate({
	    left:"300px"
	},"fast");
	$("#cardTYM").animate({
	    left:"300px"
	},"fast");
	$("#bankTYM").animate({
	    left:"300px"
	},"fast");
	$("#paypalTYM").animate({
	    left:"300px"
	},"fast");
	$("#startTYM").show();
	$("#smsTYM").hide();
	$("#cardTYM").hide();
	$("#bankTYM").hide();
	$("#paypalTYM").hide();
    });
   
 //  var content_height=$('#main_content').outerHeight();
 //  var bar_height=$('#sidebar_content').outerHeight();
 //  $('.home_content').css( 'min-height', content_height -101);
 //  $('.home_content').css( 'height', content_height -101);
 //  $('.detail_content').css( 'min-height', content_height -51);
 //  $('.detail_content').css( 'height', content_height -51);
 //  $('#sidebar_content').css( 'min-height', bar_height - 51);
 //  $('#sidebar_content').css( 'height', bar_height - 51);
});
 


$(document).ready(function(){
    
    $('.slideBanner').show();
    $('.app-screenshots').show();
    setTimeout(function(){
	$('.slideBanner').show();
	
	$('.app-screenshots').show();
    }, 1000);
});
                                                    
window.onload = function() {
		  setTimeout(function(){window.scrollTo(0, 1);}, 100);
		}                                           