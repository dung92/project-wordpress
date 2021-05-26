function vw_furniture_carpenter_menu_open_nav() {
	window.vw_furniture_carpenter_responsiveMenu=true;
	jQuery(".sidenav").addClass('show');
}
function vw_furniture_carpenter_menu_close_nav() {
	window.vw_furniture_carpenter_responsiveMenu=false;
 	jQuery(".sidenav").removeClass('show');
}

jQuery(function($){
 	"use strict";
   	jQuery('.main-menu > ul').superfish({
		delay:       500,
		animation:   {opacity:'show',height:'show'},
		speed:       'fast'
   	});
});

jQuery(document).ready(function () {
	window.vw_furniture_carpenter_currentfocus=null;
  	vw_furniture_carpenter_checkfocusdElement();
	var vw_furniture_carpenter_body = document.querySelector('body');
	vw_furniture_carpenter_body.addEventListener('keyup', vw_furniture_carpenter_check_tab_press);
	var vw_furniture_carpenter_gotoHome = false;
	var vw_furniture_carpenter_gotoClose = false;
	window.vw_furniture_carpenter_responsiveMenu=false;
 	function vw_furniture_carpenter_checkfocusdElement(){
	 	if(window.vw_furniture_carpenter_currentfocus=document.activeElement.className){
		 	window.vw_furniture_carpenter_currentfocus=document.activeElement.className;
	 	}
 	}
 	function vw_furniture_carpenter_check_tab_press(e) {
		"use strict";
		e = e || event;
		var activeElement;
		if(window.innerWidth < 999){
		if (e.keyCode == 9) {
			if(window.vw_furniture_carpenter_responsiveMenu){
			if (!e.shiftKey) {
				if(vw_furniture_carpenter_gotoHome) {
					jQuery( ".main-menu ul:first li:first a:first-child" ).focus();
				}
			}
			if (jQuery("a.closebtn.mobile-menu").is(":focus")) {
				vw_furniture_carpenter_gotoHome = true;
			} else {
				vw_furniture_carpenter_gotoHome = false;
			}

		}else{

			if(window.vw_furniture_carpenter_currentfocus=="responsivetoggle"){
				jQuery( "" ).focus();
			}}}
		}
		if (e.shiftKey && e.keyCode == 9) {
		if(window.innerWidth < 999){
			if(window.vw_furniture_carpenter_currentfocus=="header-search"){
				jQuery(".responsivetoggle").focus();
			}else{
				if(window.vw_furniture_carpenter_responsiveMenu){
				if(vw_furniture_carpenter_gotoClose){
					jQuery("a.closebtn.mobile-menu").focus();
				}
				if (jQuery( ".main-menu ul:first li:first a:first-child" ).is(":focus")) {
					vw_furniture_carpenter_gotoClose = true;
				} else {
					vw_furniture_carpenter_gotoClose = false;
				}
			
			}else{

			if(window.vw_furniture_carpenter_responsiveMenu){
			}}}}
		}
	 	vw_furniture_carpenter_checkfocusdElement();
	}
});

(function( $ ) {
	jQuery(window).load(function() {
	    jQuery(".loader-inner").delay(1000).fadeOut("slow");
	    jQuery("#preloader").delay(1000).fadeOut("slow");
	})
	$(window).scroll(function(){
		var sticky = $('.header-sticky'),
			scroll = $(window).scrollTop();

		if (scroll >= 100) sticky.addClass('header-fixed');
		else sticky.removeClass('header-fixed');
	});
	$(document).ready(function () {
		$(window).scroll(function () {
		    if ($(this).scrollTop() > 100) {
		        $('.scrollup i').fadeIn();
		    } else {
		        $('.scrollup i').fadeOut();
		    }
		});
		$('.scrollup i').click(function () {
		    $("html, body").animate({
		        scrollTop: 0
		    }, 600);
		    return false;
		});
	});
})( jQuery );

jQuery(document).ready(function () {
  	function vw_furniture_carpenter_search_loop_focus(element) {
	  var vw_furniture_carpenter_focus = element.find('select, input, textarea, button, a[href]');
	  var vw_furniture_carpenter_firstFocus = vw_furniture_carpenter_focus[0];  
	  var vw_furniture_carpenter_lastFocus = vw_furniture_carpenter_focus[vw_furniture_carpenter_focus.length - 1];
	  var KEYCODE_TAB = 9;

	  element.on('keydown', function vw_furniture_carpenter_search_loop_focus(e) {
	    var isTabPressed = (e.key === 'Tab' || e.keyCode === KEYCODE_TAB);

	    if (!isTabPressed) { 
	      return; 
	    }

	    if ( e.shiftKey ) /* shift + tab */ {
	      if (document.activeElement === vw_furniture_carpenter_firstFocus) {
	        vw_furniture_carpenter_lastFocus.focus();
	          e.preventDefault();
	        }
	      } else /* tab */ {
	      if (document.activeElement === vw_furniture_carpenter_lastFocus) {
	        vw_furniture_carpenter_firstFocus.focus();
	          e.preventDefault();
	        }
	      }
	  });
	}
	jQuery('.search-box span a').click(function(){
        jQuery(".serach_outer").slideDown(1000);
    	vw_furniture_carpenter_search_loop_focus(jQuery('.serach_outer'));
    });

    jQuery('.closepop a').click(function(){
        jQuery(".serach_outer").slideUp(1000);
    });
});