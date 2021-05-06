(function () {
	'use strict';

	window.addEventListener('DOMContentLoaded', function (ev) {
	  $ = jQuery.noConflict();
	  typeof $().modal == 'function'; // MENU

	  var $menuWithChildren = $('.menu-item-has-children ');
	  $menuWithChildren.each(function () {
	    var $this = $(this);
	    $this.find('> a');
	    $this.find('.sub-menu');
	    $this.find('a::after'); // $link.click(function(e){
	    // 	e.preventDefault();
	    // 	e.stopPropagation();
	    // 	$subMenu.toggleClass('active');
	    // 	$subMenu.parent().siblings().find('.sub-menu').removeClass('active');
	    // });
	    // $(document).on('click', function closeMenu (e){
	    // 	if($this.has(e.target).length === 0){
	    // 		$this.find('.sub-menu').removeClass('active');
	    // 	} else {
	    // 		$(document).one('click', closeMenu);
	    // 	}
	    // });
	  }); // move image

	  $('.um-field-image').insertBefore($('.um-profile-nav'));
	  $('.um-profile-edit').insertAfter($('.um-field-image')); // Search Pets

	  $('.searchandfilter').each(function () {
	    var $lis = $(this).find('[data-sf-field-type="post_meta"]');
	    $lis.each(function () {
	      $(this).on('click', function () {
	        $(this).toggleClass('active');
	      });
	    });
	  });
	  $('.woof_shortcode_output').each(function () {
	    var $product_length = $(this).find('.products').children().length; // console.log($product_length > 0);

	    if ($product_length > 0) {
	      // Hide Empty Image
	      $('.search-pets__empty').removeClass('active');
	    }
	  });
	  $('.site-header__user-menu-search').one('click', function () {
	    var $this = $(this);
	    $this.toggleClass('active');
	  }); // Sign Up Form

	  $('.um.um-register').each(function () {
	    // console.log($(this).find('.um-field[data-key="confirm_user_password"]'));
	    var $thisSubmit = $(this).find('#um-submit-btn');
	    var $thisRecaptcha = $(this).find('.g-recaptcha');
	    var $thisSubmit = $(this).find('#um-submit-btn');
	    var $thisConfirmPwd = $(this).find('.um-field[data-key="confirm_user_password"]');
	    $thisSubmit.insertAfter($thisConfirmPwd);
	    $thisRecaptcha.insertBefore($thisSubmit);
	  }); // Login Form

	  $('.um.um-login').each(function () {
	    // console.log($(this).find('.um-field[data-key="confirm_user_password"]'));
	    var $thisForgetPwd = $(this).find('.um-col-alt-b');
	    var $thisRecaptcha = $(this).find('.g-recaptcha');
	    var $thisSubmit = $(this).find('#um-submit-btn');
	    var $thisKeepSignedIn = $(this).find('.um-field.um-field-c');
	    var $thisSubmitBlock = $thisKeepSignedIn.parent();
	    var $thisPwd = $(this).find('.um-field.um-field-password'); // console.log($thisSubmitBlock);

	    $thisForgetPwd.insertAfter($thisKeepSignedIn);
	    $thisSubmitBlock.insertAfter($thisPwd);
	    $thisRecaptcha.insertBefore($thisSubmit);
	  }); // Profile Page

	  $('[data-switch]').each(function () {
	    var $switchTo = $(this).data('switch');
	    $(this).on('click', function () {
	      $(this).addClass('active').siblings().removeClass('active');
	      $('body').find('#' + $switchTo).addClass('active').siblings().removeClass('active');
	    });
	  });
	  $('.profile__contact-button .um-members-messaging-btn .um-message-btn').text('Message This Breeder'); // Breeder Search

	  var $searchFilterSidebar = $('#search-filters');
	  $searchFilterSidebar.find('.um-search-filter');
	  $searchFilterSidebar.each(function () {
	    var $this = $(this);
	    var $select = $this.find('select');

	    if ($select.attr("id") == "Dogs" || $select.attr("id") == "Cats" || $select.attr("id") == "Birds") {
	      $this.css('display', 'none');
	    }
	  }); // Animals Page

	  var $animalsBG = $('.animals__bg');

	  if ($animalsBG.length > 0) {
	    $(window).scroll(function () {
	      $('.animals__bg-top').each(function () {
	        if ($(this).offset().top < $(window).scrollTop()) {
	          var difference = $(window).scrollTop() - $(this).offset().top;
	          var half = difference / 2 + 'px',
	              transform = 'translate3d( 0, ' + half + ',0)';
	          $(this).find('svg').css('transform', transform);
	        } else {
	          $(this).find('svg').css('transform', 'translate3d(0,0,0)');
	        }
	      });
	    });
	  } // Close Button


	  var $pop = jQuery('.footer-list-pet');
	  $pop.each(function () {
	    var $this = jQuery(this);
	    var cookie = Cookies.get('list-pet-close');

	    if (cookie !== 'true') {
	      $this.addClass('footer-list-pet--active');
	    }

	    var $btn = $this.find('.footer-list-pet__close');
	    $btn.on('click', function () {
	      $this.removeClass('footer-list-pet--active');
	      Cookies.set('list-pet-close', true, {
	        expires: 1,
	        path: ''
	      });
	    });
	    $this.on('click', function () {
	      $this.removeClass('footer-list-pet--active');
	      Cookies.set('list-pet-close', true, {
	        expires: 1,
	        path: ''
	      });
	    });
	  }); // Image Previews

	  var $add_listing = $(".pet-listing__add-listing"); // console.log($add_listing);

	  $add_listing.each(function () {
	    var $this = $(this);
	    var $sections = $this.find('.gsection');
	    $sections.each(function () {
	      $(this); // $section.html('<div >');
	    }); // $this.on('change', function(){
	    // 	console.log('YAS', $this);
	    // })
	  }); // Searc

	  $(".pet-listing__trunc").each(function () {
	    var $this = $(this);
	    var $sections = $this.find('.breeder-details__tab-card');
	    var $more = $this.find('.breeder-details__tab-card-action-more');
	    var $less = $this.find('.breeder-details__tab-card-action-less');
	    $less.hide();
	    $sections.each(function (index) {
	      var $section = $(this);

	      if (index > 0) {
	        $section.hide();
	      }
	    });
	    $more.on('click', function () {
	      $sections.each(function (index) {
	        var $section = $(this);
	        $section.show();
	      });
	      $(this).hide();
	      $less.show();
	    });
	    $less.on('click', function () {
	      $sections.each(function (index) {
	        var $section = $(this);

	        if (index > 0) {
	          $section.hide();
	        }
	      });
	      $(this).hide();
	      $more.show();
	    });
	  });
	});

}());
//# sourceMappingURL=app.js.map
