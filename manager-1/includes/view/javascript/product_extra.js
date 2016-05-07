/* Cookie functions*/  
function setCookie(name,value,days) {
  if (days) {
    var date = new Date();
    date.setTime(date.getTime()+(days*24*60*60*1000));
    var expires = "; expires="+date.toGMTString();
  }
  else var expires = "";
  document.cookie = name+"="+value+expires+"; path=/";
}

function getCookie(name) {
  var nameEQ = name + "=";
  var ca = document.cookie.split(';');
  for(var i=0;i < ca.length;i++) {
    var c = ca[i];
    while (c.charAt(0)==' ') c = c.substring(1,c.length);
    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
  }
  return null;
}

function deleteCookie(name) {
  setCookie(name,"",-1);
}

$.extend({
  getUrlVars: function(){
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
      hash = hashes[i].split('=');
      vars.push(hash[0]);
      vars[hash[0]] = hash[1];
    }
    return vars;
  },
  getUrlVar: function(name){
    return $.getUrlVars()[name];
  }
});

if($.getUrlVar('route') == 'catalog/product'){
  var l = window.location.toString();
  var newL = l.replace('catalog/product', 'catalog/product_extra')
  location = newL
}
if($.getUrlVar('iframed') == 1){
    //$('script[src="view/javascript/product_extra.js"]').append('<div class="test"></div>');
    $('head').append('<link rel="stylesheet" href="view/stylesheet/product_extra.css" type="text/css" />');
}
$(document).ready(function() {
    
    //Product stores
    $('td.stores a').live('click', function(e){
	e.preventDefault();
	var a = $(this);
	
	$.get($(this).attr('href'), function(){
	    if(a.hasClass('included')){
		a.removeClass('included').addClass('excluded');
	    } else {
		a.removeClass('excluded').addClass('included');
	    }
	    a.parents('td').addClass('updated');
	    setTimeout(function(){a.parents('td').removeClass('updated')}, 1500);
	})
    })
    
    $('td.status a').live('click', function(e){
	e.preventDefault();
	var a = $(this);
	
	$.get($(this).attr('href'), function(){
	    if(a.hasClass('included')){
		a.removeClass('included').addClass('excluded');
		a.html($('span.disabled').html());
	    } else {
		a.removeClass('excluded').addClass('included');
		a.html($('span.enabled').html());
	    }
	    a.parents('td').addClass('updated');
	    setTimeout(function(){a.parents('td').removeClass('updated')}, 1500);
	})
    })
    $('td.product-model input').live('focusout', function(){
	var input = $(this);
	if(input.attr('value') != input.attr('orig')){
	    $.get(input.attr('rel')+'&model='+input.val(), function(result){
		//input.val(result);
		input.attr('orig', result);
		input.parents('td').addClass('updated');
		setTimeout(function(){input.parents('td').removeClass('updated')}, 1500);
	    })
	}
    });
    $('td.product-name').live('click', function(){
      var wrapper = $(this).find('.product-name-wrapper');
      wrapper.hide();
      wrapper.next().show();
      wrapper.next().focus();
    })
    
    $('td.product-name input').live('focusout', function(){
	var input = $(this);
	var td = input.parents('td');
	if(input.attr('value') != input.attr('orig')){
	    $.get(input.attr('rel')+'&name='+input.val(), function(result){
		//input.val(result);
		input.attr('orig', result);		
		td.addClass('updated');
		input.prev().html(result);
		input.prev().show();
		input.hide();
		setTimeout(function(){td.removeClass('updated')}, 1500);
	    })
	}
    });
    
    $('td.quantity input').live('focusout', function(){
	var input = $(this);
	if(input.attr('value') != input.attr('orig')){
	    $.get(input.attr('rel')+'&quantity='+input.val(), function(result){
		input.val(result);
		input.attr('orig', result);
		input.parents('td').addClass('updated');
		setTimeout(function(){input.parents('td').removeClass('updated')}, 1500);
	    })
	}
    });
    $('td.quantity input').live('keyup', function(){
	$(this).removeClass();
	if($(this).val() <= 0){
	    $(this).addClass('red');
	} else if ($(this).val() <= 5){
	    $(this).addClass('yellow');
	} else {
	    $(this).addClass('green');
	}
    });
    
    $('td.price input').live('focusout', function(){
	var input = $(this);
	if(input.attr('value') != input.attr('orig')){
	    $.get(input.attr('rel')+'&price='+input.val(), function(result){
		input.val(result);
		input.attr('orig', result);
		input.parents('td').addClass('updated');
		setTimeout(function(){input.parents('td').removeClass('updated')}, 1500);
	    })
	}
    });
    
    $('td.sort_order input').live('focusout', function(){
	var input = $(this);
	if(input.attr('value') != input.attr('orig')){
	    $.get(input.attr('rel')+'&sort_order='+input.val(), function(result){
		input.val(result);
		input.attr('orig', result);
		input.parents('td').addClass('updated');
		setTimeout(function(){input.parents('td').removeClass('updated')}, 1500);
	    })
	}
    });
    $("td.product-image").live("mouseover mouseout", function(event) {
      if ( event.type == "mouseover" ) {
	$(this).find('.remove-image').show();
      } else {
	$(this).find('.remove-image').hide();
      }
    });
    
    $('td a.remove-image').live('click', function(e){
      e.preventDefault();
      if(!confirm('Are you sure?')){
	return false;
      }
      var thumb = $(this).next().children().attr('id');
      var field = $(this).next().next().attr('id');
      $('#' + thumb).replaceWith('<img src="' + no_image + '" alt="" id="' + thumb + '" />');
      $('#' + field).val('');
      var td = $(this).parents('td');
      td.addClass('updated');
      $.get(td.attr('rel')+'&image=', function(){
	setTimeout(function(){td.removeClass('updated')}, 1500);
      })
    });
    
    $('td a.edit_link').live('click', function(e){
      if(getCookie('popup-edit') != 1){
	return true;
      }
      var rowTd = $(this).parents('tr');
      e.preventDefault();
      formUrl = $(this).attr('href');
      formUrl = formUrl.replace('product', 'product_extra');
      if($('#editor').length == 0){
	$('#editor').dialog("destroy");
	$('#editor').remove();
      }
      $('#content').prepend('<div id="editor" style="padding: 3px 0px 0px 0px;"><iframe src="'+$(this).attr('href')+'&iframed=1" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
      
      $('#editor').dialog({
		title: 'Product Manager',
		buttons: {
		  "Save": function() {
		    $.post(formUrl, $('#editor iframe').contents().find('form').serialize(), function(data){
		      if(data == "OK"){
			$('#editor').dialog({title:'<span style="color:red">Saved</span>'});
			reloadRow(formUrl);
			setTimeout(function(){
			  $('#editor').dialog({title:"Product Manager"});
			}, 1500)
		      } else {
			$('#editor').dialog({title:'<span style="color:red">Error. Cannot save data.</span>'});
			setTimeout(function(){
			  $('#editor').dialog({title:"Product Manager"});
			}, 3500)
		      }
		    })
		  },
		  "Close": function(){
		    $(this).dialog("close"); $(this).remove()
		  }
		},
		close: function(){$(this).remove()},
		bgiframe: false,
		width: 950,
		height: 550,
		resizable: false,
		modal: true
	});
      
      var reloadRow = function(url){
	url = url.replace('update', 'ajaxify');
	$.get(url, function(data){
	  rowTd.html(data);
	})
      }
    })
    
    $('td a.change-image').live('click', function(e){
      e.preventDefault();
      var thumb = $(this).children().attr('id');
      var field = $(this).next().attr('id');
      $('#popup-window').remove();
      $('#dialog').remove();
      $('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&token='+token+'&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
      
      $('#dialog').dialog({
		title: 'Image Manager',
		close: function (event, ui) {
			if ($('#' + field).attr('value')) {
				$.ajax({
					url: 'index.php?route=common/filemanager/image&token='+token+'&image=' + encodeURIComponent($('#' + field).attr('value')),
					dataType: 'text',
					success: function(text) {
						if(text != ''){
						  $('#' + thumb).replaceWith('<img src="' + text + '" alt="" id="' + thumb + '" />');
						  var td = $('#' + field).parents('td')
						  td.addClass('updated');
						  $.get(td.attr('rel')+'&image='+encodeURIComponent($('#' + field).attr('value')), function(){
						    setTimeout(function(){td.removeClass('updated')}, 1500);
						  })
						}
					}
				});
			}
		},	
		bgiframe: false,
		width: 800,
		height: 400,
		resizable: false,
		modal: false
	});
    });
    
    
    
    $('input.switcher').change(function(){
      if(typeof($(this).attr('checked')) != 'undefined'){
	$('.'+$(this).attr('name')).removeClass('hide-column');
	setCookie($(this).attr('name'), 1, 365);
      } else {
	$('.'+$(this).attr('name')).addClass('hide-column');
	deleteCookie($(this).attr('name'));
      }
    })
    
    var columnStates = function(){
      var active_columns = new Array();
      $('input.switcher').each(function(){
	if(getCookie($(this).attr('name')) == 1){
	  $(this).attr('checked', true);
	} else {
	  $(this).attr('checked', false);
	}
	if(typeof($(this).attr('checked')) != 'undefined'){
	  $('.'+$(this).attr('name')).removeClass('hide-column');
	} else {
	  $('.'+$(this).attr('name')).addClass('hide-column');
	}
      })
    }
    
    var initCookies = function(){
      $('input.switcher').each(function(){
	setCookie($(this).attr('name'), 1, 365);
      });
      setCookie('show-column-checkboxes', 1, 365);
      $('.column-switcher').removeClass('hide-column');
    }
      
    if(getCookie('show-column-checkboxes') >= 1){
      columnStates();
    } else {
      initCookies();
    }
    
    if(getCookie('show-column-checkboxes') == 1){
      $('.column-switcher').show();
    } else {
      $('.column-switcher').hide();
    }
    
    $('.columns-button').live('click', function(e){
      e.preventDefault();
      if(getCookie('show-column-checkboxes') == 1){
	$('.column-switcher').hide();
	setCookie('show-column-checkboxes', 2, 365);
      } else {
	$('.column-switcher').show();
	setCookie('show-column-checkboxes', 1, 365);
      }
    })
    
    $('td.product-manufacturer').live('click', function(){
      if($(this).find('select').length == 0){
	var manufacturerSelect = $('.filter select[name="filter_manufacturer"]').clone();
	$(this).attr('mname', $(this).html());
	$(this).html('');
	manufacturerSelect.val($(this).attr('rel'))
	$(this).append(manufacturerSelect);
      }
    })
    
    $('td.product-manufacturer select').live('change', function(){
      var td = $(this).parents('td');
      var tds = $(this).parents('tr').children('td');
      var product_id = $(tds[0]).find('input').val();
      $.get(td.attr('loc')+'&manufacturer_id='+$(this).val(), function(){
	td.addClass('updated');
	setTimeout(function(){td.removeClass('updated')}, 1500);
      })
    })
    
    $('td.product-manufacturer select').live('focusout', function(){
      var td = $(this).parents('td');
      var text = $(this).find('option:selected').text();
      var id = $(this).find('option:selected').val();
      td.attr('rel', id);
      td.html(text);
    });
    
    $('select.language-selector').live('change', function(){
      location = $(this).attr("rel")+'&type=change_language&language='+$(this).val();
    })
});