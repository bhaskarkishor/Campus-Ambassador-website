(function($) {
	"use strict";

	// Vars
	var body = $('body'),
		animated = $('.animated'),
		headerNav = $('nav.header-nav'),
		headerNavElem = $('nav.header-nav li'),
		headerNavElemHome = $('nav.header-nav li a[href="#home"]'),
		navToggle = $('.nav-toggle'),
		EDHomeBlock = $('div.ed-homeblock'),
		EDSideBlock = $('div.ed-sideblock'),
		target,
		preloader = $('#preloader'),
		preloaderDelay = 350,
		preloaderFadeOutTime = 800,
		btnLoadContent = $('a.load-content');

	// Mobile
	if( /Android|iPhone|iPad/i.test(navigator.userAgent) ) {
		body.addClass('mobile');
	}

	function detectIE() {
		if (navigator.userAgent.indexOf('MSIE') != -1)
			var detectIEregexp = /MSIE (\d+\.\d+);/ // test for MSIE x.x
		else // if no "MSIE" string in userAgent
			var detectIEregexp = /Trident.*rv[ :]*(\d+\.\d+)/ // test for rv:x.x or rv x.x where Trident string exists

		if (detectIEregexp.test(navigator.userAgent)){ // if some form of IE
			var ieversion=new Number(RegExp.$1) // capture x.x portion and store as a number
			if (ieversion >= 9) {
				return true;
			}
		}
		return false;
	}

	function getWindowWidth() {
		return Math.max( $(window).width(), window.innerWidth);
	}

	function getWindowHeight() {
		return Math.max( $(window).height(), window.innerHeight);
	}

	// Preloader
	function init_ED_Preloader() {

		// Hide Preloader
		preloader.delay(preloaderDelay).fadeOut(preloaderFadeOutTime);

	}


	// Animations
	function init_ED_Animations() {
		if( !body.hasClass('mobile') ) {
			if( detectIE() ) {
				animated.css({
					'display':'block',
					'visibility':'visible'
				});
			} else {
				/* Starting Animation on Load */
				$('.onstart').each( function() {
					var elem = $(this);
					if ( !elem.hasClass('visible') ) {
						var animationDelay = elem.data('animation-delay');
						var animation = elem.data('animation');
						if ( animationDelay ) {
							setTimeout(function(){
								elem.addClass( animation + " visible" );
							}, animationDelay);
						} else {
							elem.addClass( animation + " visible" );
						}
					}
				});
			}
		}
	}

	//	Backgrounds
	function init_ED_PageBackground() {	}
	
	// Parallax Background
	function init_ED_Parallax(el) {
		var windowHeight = window.innerHeight || document.documentElement.clientHeight,
			scrollTop = el.mcs.top,
			bottomWindow = scrollTop + windowHeight,
			speedDivider = 0.25;
		
		$('.parallax-background').each(function() {
			var parallaxElement = $(this),
				parallaxHeight = parallaxElement.outerHeight(),
				parallaxTop = parallaxElement.offset().top,
				parallaxBottom = parallaxTop + parallaxHeight,
				parallaxWrapper = parallaxElement.parents('.parallax-wrapper'),
				
				section = parallaxElement.parents('section'),
				sectionHeight = parallaxElement.parents('section').outerHeight(),
				offSetTop = scrollTop + section[0].getBoundingClientRect().top,
				offSetPosition = windowHeight + scrollTop - offSetTop;
				
			if (offSetPosition > 0 && offSetPosition < (sectionHeight + windowHeight)) {
				var value = ((offSetPosition - windowHeight) * speedDivider);

				if (Math.abs(value) < (parallaxHeight - sectionHeight)) {
					parallaxElement.css({
						"transform" : "translate3d(0px, " + value + "px, 0px)",
						"-webkit-transform" : "translate3d(0px, " + value + "px, 0px)"
					});
				} else {
					parallaxElement.css({
						"transform" : "translate3d(0px, " + parallaxHeight - sectionHeight + "px, 0px)",
						"-webkit-transform" : "translate3d(0px, " + parallaxHeight - sectionHeight + "px, 0px)"
					});
				}
			}
		});
	}
		
	// Fullscreen Sections Fix
	function init_ED_FullscreenFix() {		
		if(!(1024 >= getWindowWidth() || body.hasClass('mobile'))) {
			$('.section.fullscreen-element').each(function(){
				var elem = $(this),
					elemHeight = getWindowHeight(),
					elemContent = elem.find('.table-container'),
					elemContentHeight = elemContent.outerHeight(),
					elemPaddingTop = parseInt(elem.css('padding-top'), 10),
					elemPaddingBottom = parseInt(elem.css('padding-bottom'), 10),
					elemTrueHeight = elemContentHeight + elemPaddingTop + elemPaddingBottom;

				if( elemHeight >= elemTrueHeight ){
					elem.css('height', '100vh');
				} else if( elemHeight < elemTrueHeight ){
					elem.css('height', 'auto');
				}

			});
		} else {
			$('.section.fullscreen-element').each(function(){
				$(this).css('height', 'auto');
			});
		}
	}
		
	// Navigation - only for oneblock and onepage layout
	function init_ED_WaypointsNav(el) {
		var scrollblock = el.mcs.content;
		
		scrollblock.find('.section').each(function(){
			var section = $(this);

			var waypoints = section.waypoint(function(direction) {
				var activeSection = section.attr('id');

				if (direction === 'down') {
					init_ED_UpdateWaypointsNav(activeSection);
				}
				
			},{
				offset: '30%',
				context: body,
			});
			
			var waypoints = section.waypoint(function(direction) {
				var activeSection = section.attr('id');
				
				if (direction === 'up') {
					init_ED_UpdateWaypointsNav(activeSection);
				}

			},{
				offset: '-30%',
				context: body,
			});
							
		});
	}
	
	// Select target in navigation
	function init_ED_UpdateWaypointsNav(activeSection) {
		if($('.header-nav a[href="#'+ activeSection +'"]').hasClass('load-content')){
			headerNavElem.removeClass('active');
			headerNav.find('a[href="#'+ activeSection +'"]').parents('li').addClass('active');
		}
	}
	
	function init_ED_Navigation() {
		navToggle.off('click');
		btnLoadContent.off('click');
		
		if(!(1024 >= getWindowWidth() || body.hasClass('mobile'))) {
		
			if(body.hasClass('mCS_destroyed') || !body.hasClass('mCustomScrollbar')){
				body.mCustomScrollbar({
					axis: 'y',
					scrollbarPosition: 'inside',
					scrollInertia: 150,
					mouseWheel:{
						enable: true,
						scrollAmount: 100,
						axis: 'y'
					},
					autoHideScrollbar: false,
					alwaysShowScrollbar: 1,
					callbacks:{
						onInit: function(){
							init_ED_Parallax(this);
						},
						onScrollStart: function(){
							init_ED_Parallax(this);
						},
						whileScrolling: function(){
							
							// Show 'back to top' button
							if(this.mcs.top <= -100){
								$('a.backtotop-block').addClass('active');
							} else {
								$('a.backtotop-block').removeClass('active');
							};
							
							init_ED_Parallax(this);
							
						},
						onScroll: function(){
							init_ED_Parallax(this);
							init_ED_WaypointsNav(this);
						}
					}
				});
			}

			if(headerNav.css('display', 'none')){
				headerNav.css('display', 'block');
			}
			
			if(navToggle.hasClass('open')){
				navToggle.removeClass('open');
			}

			// Back to Top in sideblock
			$('a.backtotop-block').on('click', function(e) {
				e.preventDefault();
				if(body.hasClass('sideblock-active')){
					$('body.sideblock-active').mCustomScrollbar('scrollTo',['top',null],{
						scrollInertia: 800
					});
				}
			});
			
			btnLoadContent.on('click', function(e) {
				e.preventDefault();

				var target = $(this).attr('href');

				// Return if target is active
				if($(target).hasClass('active')){
					return true;
				}
				
				if($(target).hasClass('ed-homeblock')){
					body.removeClass('sideblock-active');
					EDSideBlock.removeClass('active');
					$(target).addClass('active');
					if(!body.hasClass('sideblock-active')){
						setTimeout(function(){
							body.mCustomScrollbar('scrollTo',['top',null],{
								scrollInertia: 150
							});
						}, 500);
					}
				} else {
					EDHomeBlock.removeClass('active');
					if(!EDSideBlock.hasClass('active')){
						body.addClass('sideblock-active');
						EDSideBlock.addClass('active');
					}
				}
				
				$('body.sideblock-active').mCustomScrollbar( 'scrollTo', $('body.sideblock-active').find('.mCSB_container').find(target), {
					scrollInertia: 800
				});
				
				// Select target in navigation
				if(headerNav.find('a[href="'+ target +'"]')){
					headerNavElem.removeClass('active');
					headerNav.find('a[href="'+ target +'"]').parents('li').addClass('active');
				}
				
			});
				
		} else {

			if(body.hasClass('mCustomScrollbar')){
				body.mCustomScrollbar('destroy');
			}

			if(headerNav.css('display', 'block')){
				headerNav.css('display', 'none');
			}
			
			if(navToggle.hasClass('open')){
				headerNav.css('display', 'block');
			}
		
			navToggle.on('click', function(e) {
				e.preventDefault();
				if(!$(this).hasClass('open')){
					$(this).addClass('open');
					headerNav.slideDown(500);
				} else {
					headerNav.slideUp(500);
					$(this).removeClass('open');
				}
			});
		
			// Smooth Scroll
			btnLoadContent.on('click', function() {	
				var sScroll = $(this),
					sScroll_target = sScroll.attr('href');					
				if(sScroll_target == null){ sScroll_target = '#'; }
				
				$.smoothScroll({
					offset: 0,
					easing: 'swing',
					speed: 800,
					scrollTarget: sScroll_target,
					preventDefault: false
				});
			});
			
		}
	}

	function init_ED_Plugins() {
		// Tooltip
		$('[data-toggle="tooltip"]').tooltip();
		
		// Popover
		$('[data-toggle="popover"]').popover();
	}

	// window load function
	$(window).on('load', function() {
		init_ED_FullscreenFix();
		init_ED_Preloader();
		init_ED_Animations();

		body.addClass('loaded');
	});
	
	// document.ready function
	jQuery(document).ready(function($) {
		init_ED_PageBackground();
		init_ED_Navigation();
		init_ED_Plugins();
	});
	
	// window.resize function
	$(window).on('resize', function () {		
		init_ED_Navigation();
		init_ED_FullscreenFix();

	});

})(jQuery);