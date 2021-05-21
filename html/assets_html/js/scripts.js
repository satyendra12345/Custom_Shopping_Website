jQuery(document).ready(function() {
  "use strict";
  //Frntre Autocomplete Script
  var src = {
    'Bootstrap 4 Autocomplete example': 1,
    'Best example in the world': 2,
    'Bootstrap 4 Autocomplete is very nice': 3,
    'It contains neatly arranged example items': 4,
    'With many autocomplete values': 5,
    'And it uses default Bootstrap 4 components': 6,
    'You can use this example to test': 7,
  }
  $('#FindAnything').autocomplete ({
    source: src,
    highlightClass: 'strong',
  });

  //Frntre Slick Slider Script
  $('.frntre-banner').slick ({
    dots: true,
    autoplay: true,
    infinite: false,
    autoplaySpeed: 5000,
    prevArrow: '<button class="slick-prev" aria-label="Previous" type="button"><svg viewBox="0 0 28 28"><path d="M11.3 8.9c-.4.4-.4 1-.1 1.4l3.5 3.8-3.4 3.8c-.4.4-.3 1 .1 1.4.4.4 1 .3 1.4-.1l4-4.5c.2-.2.3-.4.3-.7s-.1-.5-.3-.7l-4-4.5c-.4-.3-1.1-.3-1.5.1z"></path></svg></button>',
    nextArrow: '<button class="slick-next" aria-label="Next" type="button"><svg viewBox="0 0 28 28"><path d="M11.3 8.9c-.4.4-.4 1-.1 1.4l3.5 3.8-3.4 3.8c-.4.4-.3 1 .1 1.4.4.4 1 .3 1.4-.1l4-4.5c.2-.2.3-.4.3-.7s-.1-.5-.3-.7l-4-4.5c-.4-.3-1.1-.3-1.5.1z"></path></svg></button>',
  });

  //Frntre Slick Thumb Slider Script
  $('.frntre-main-slider').slick ({
    infinite: false,
    asNavFor: '.frntre-thumb-slider',
    responsive: [{
      breakpoint: 992,
      settings: {
        dots: false,
      }
    }],
    prevArrow: '<button class="slick-prev" aria-label="Previous" type="button"><svg viewBox="0 0 28 28"><path d="M11.3 8.9c-.4.4-.4 1-.1 1.4l3.5 3.8-3.4 3.8c-.4.4-.3 1 .1 1.4.4.4 1 .3 1.4-.1l4-4.5c.2-.2.3-.4.3-.7s-.1-.5-.3-.7l-4-4.5c-.4-.3-1.1-.3-1.5.1z"></path></svg></button>',
    nextArrow: '<button class="slick-next" aria-label="Next" type="button"><svg viewBox="0 0 28 28"><path d="M11.3 8.9c-.4.4-.4 1-.1 1.4l3.5 3.8-3.4 3.8c-.4.4-.3 1 .1 1.4.4.4 1 .3 1.4-.1l4-4.5c.2-.2.3-.4.3-.7s-.1-.5-.3-.7l-4-4.5c-.4-.3-1.1-.3-1.5.1z"></path></svg></button>',
  });
  $('.frntre-thumb-slider').slick ({
    dots: false,
    vertical: true,
    customPaging: 0,
    slidesToShow: 9,
    infinite: false,
    focusOnSelect: true,
    asNavFor: '.frntre-main-slider',
    responsive: [
    {
      breakpoint: 1300,
      settings: {
        slidesToShow: 6,
      },
    },
    {
      breakpoint: 1200,
      settings: {
        vertical: false,
      },
    },
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 10,
        vertical: false,
      },
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 8,
        vertical: false,
      },
    },
    {
      breakpoint: 576,
      settings: {
        slidesToShow: 7,
        vertical: false,
      },
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 6,
        vertical: false,
      },
    },
    {
      breakpoint: 360,
      settings: {
        slidesToShow: 5,
        vertical: false,
      },
    }],
    prevArrow: '<button class="slick-prev" aria-label="Previous" type="button"><svg viewBox="0 0 28 28"><path d="M11.3 8.9c-.4.4-.4 1-.1 1.4l3.5 3.8-3.4 3.8c-.4.4-.3 1 .1 1.4.4.4 1 .3 1.4-.1l4-4.5c.2-.2.3-.4.3-.7s-.1-.5-.3-.7l-4-4.5c-.4-.3-1.1-.3-1.5.1z"></path></svg></button>',
    nextArrow: '<button class="slick-next" aria-label="Next" type="button"><svg viewBox="0 0 28 28"><path d="M11.3 8.9c-.4.4-.4 1-.1 1.4l3.5 3.8-3.4 3.8c-.4.4-.3 1 .1 1.4.4.4 1 .3 1.4-.1l4-4.5c.2-.2.3-.4.3-.7s-.1-.5-.3-.7l-4-4.5c-.4-.3-1.1-.3-1.5.1z"></path></svg></button>',
  });

  //Frntre On Checked Add And Remove Class Script
  $('.frequently-products input:checkbox').change(function() {
    if($(this).is(':checked')) {
      $(this).parents('.product-list').addClass('selected');
    }
    else {
      $(this).parents('.product-list').removeClass('selected');
    }
  });

  //Frntre On Hover Attract Text Script
  $('.product-colors ul li a').hover(function() {
    var DataColor = $(this).attr('data-color');
    $(this).data('', DataColor).removeAttr('data-color');
    $(this).addClass('active');
    $('.product-color-name').text(DataColor);
  },
  function() {
    $(this).attr('data-color', $(this).data(''));
    $(this).removeClass('active');
  });

  //Frntre Tooltip Script
  $('[data-toggle="tooltip"]').tooltip();

  //Frntre Popover Script
  $('[data-toggle="popover"]').popover ({
    content: function () {
      var clone = $($(this).data('popover-content')).clone(true).removeClass('d-none');
      return clone;
    }
  })
  $('[data-toggle="popover"]').popover();
  $('body').on('click', function (e) {
    $('[data-toggle="popover"]').each(function () {
      if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
        $(this).popover('hide');
      }
    });
  });

  //Frntre Get Inline CSS Script
  $(window).resize(function() {
    if (screen.width >= 768) {
      //Frntre Custom Popup Script
      $('[data-hover]').hover (
        function() {
          var dataHoverPopup = $(this).attr('data-hover');
          $('[data-hover-popup = '+dataHoverPopup+']').first().stop(false, false).fadeIn('fast').addClass('open');
          $('.frntre-hover-overlay').first().stop(false, false).fadeIn();
        },
        function() {
          var dataHoverPopup = $(this).attr('data-hover');
          $('[data-hover-popup = '+dataHoverPopup+']').first().stop(false, false).fadeOut('fast').removeClass('open');
          $('.frntre-hover-overlay').first().stop(false, false).fadeOut();
        }
      );
    }
    else {
      //Frntre Custom Popup Script
      $('[data-hover] > a').on('click', function() {
        var element = $(this).parent('[data-hover]');
        if (element.hasClass('open')) {
          element.removeClass('open');
          element.find('[data-hover]').removeClass('open');
          element.find('[data-hover-popup]').slideDown();
        }
        else {
          element.addClass('open');
          element.children('[data-hover-popup]').slideDown();
          element.siblings('[data-hover]').children('[data-hover-popup]').slideUp();
          element.siblings('[data-hover]').removeClass('open');
          element.siblings('[data-hover]').find('[data-hover]').removeClass('open');
          element.siblings('[data-hover]').find('[data-hover-popup]').slideUp();
        }
      });
      //Frntre Outside Click Remove Class Script
      $(document).on('click', function(e) {
        if ($(e.target).is('[data-hover] > a, [data-hover] > a *, [data-hover-popup], [data-hover-popup] *') === false) {
          $('html').removeClass('nav-open');
          $('[data-hover]').removeClass('open');
          $('[data-hover-popup]').slideUp();
        }
      });
      //Frntre Add And Remove Class Script
      $('.frntre-nav [data-hover]').on('click', function () {
        $('html').addClass('nav-open');
        $('.frntre-hover-overlay').fadeIn();
      });
    }
    if (screen.width >= 1500) {
      $('.frntre-scroll').css('height', $('.frequently-wrap').outerHeight());
    };
    if (screen.width <= 991) {
      $('.frequently-products').insertAfter('.product-info-wrap');
    };
    $('.sidebar-popup-body').css('padding-top', $('.sidebar-popup-header').outerHeight()+20);
    if (screen.width >= 1200) {
      //Frntre Elevate Zoom Image Script
      $('.frntre-zoom').elevateZoom ({
        easingAmount: 20,
        zoomWindowWidth: 500,
        zoomWindowHeight: 500,
        zoomWindowBgColour: '#ebebeb',
        zoomWindowPosition: 'zoomWindow',
      });
    }
    else if (screen.width >= 992) {
      //Frntre Elevate Zoom Image Script
      $('.frntre-zoom').elevateZoom ({
        easingAmount: 20,
        zoomWindowWidth: 400,
        zoomWindowHeight: 400,
        zoomWindowBgColour: '#ebebeb',
        zoomWindowPosition: 'zoomWindow',
      });
    }
    else {
      //Frntre Elevate Zoom Image Script
      $('.frntre-zoom').elevateZoom ({
        zoomType : 'inner',
        cursor: 'crosshair',
      });
    }
  });
  $(window).trigger('resize');

  //Frntre Malihu Custom Scrollbar Script
  $('.frntre-scroll').mCustomScrollbar ({
    mouseWheelPixels: 150,
    scrollInertia: 500,
  });

  //Frntre Slick Product Slider Script
  $('.related-products').slick ({
    dots: false,
    infinite: false,
    slidesToShow: 5,
    responsive: [{
      breakpoint: 1640,
      settings: {
        slidesToShow: 4,
      },
    },
    {
      breakpoint: 1200,
      settings: {
        slidesToShow: 3,
      },
    },
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 2,
      },
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
      },
    }],
    prevArrow: '<button class="slick-prev" aria-label="Previous" type="button"><svg viewBox="0 0 28 28"><path d="M11.3 8.9c-.4.4-.4 1-.1 1.4l3.5 3.8-3.4 3.8c-.4.4-.3 1 .1 1.4.4.4 1 .3 1.4-.1l4-4.5c.2-.2.3-.4.3-.7s-.1-.5-.3-.7l-4-4.5c-.4-.3-1.1-.3-1.5.1z"></path></svg></button>',
    nextArrow: '<button class="slick-next" aria-label="Next" type="button"><svg viewBox="0 0 28 28"><path d="M11.3 8.9c-.4.4-.4 1-.1 1.4l3.5 3.8-3.4 3.8c-.4.4-.3 1 .1 1.4.4.4 1 .3 1.4-.1l4-4.5c.2-.2.3-.4.3-.7s-.1-.5-.3-.7l-4-4.5c-.4-.3-1.1-.3-1.5.1z"></path></svg></button>',
  });

  //Frntre Add And Remove Class Script
  $('.filters-toggle').on('click', function () {
    $(this).toggleClass('active');
    $('.account-filters').slideToggle();
  });
  $('.zip-toggle').on('click', function () {
    $(this).toggleClass('active');
    $(this).next('.zip-update').slideToggle();
  });
  $('.frntre-hover-overlay').on('click', function () {
    $(this).fadeOut();
  });

  //Frntre Custom Sidebar Popup Script
  $('[data-sidebar]').click(function () {
    var dataSidebarPopup = $(this).attr('data-sidebar');
    var dataSidebarBackdrop = $(this).attr('data-sidebar');
    $('[data-sidebar-popup = '+dataSidebarPopup+']').addClass('open');
    $('[data-sidebar-backdrop = '+dataSidebarBackdrop+']').fadeIn();
    $('html').addClass('sidebar-popup-open');
  });
  $('[data-sidebar-closer]').click(function () {
    var dataSidebarPopup = $(this).attr('data-sidebar-closer');
    var dataSidebarBackdrop = $(this).attr('data-sidebar-closer');
    $('[data-sidebar-popup = '+dataSidebarPopup+']').removeClass('open');
    $('[data-sidebar-backdrop = '+dataSidebarBackdrop+']').fadeOut();
    $('html').removeClass('sidebar-popup-open');
  });
  $('[data-sidebar-backdrop]').click(function () {
    var dataSidebarPopup = $(this).attr('data-sidebar-backdrop');
    var dataSidebarBackdrop = $(this).attr('data-sidebar-backdrop');
    $('[data-sidebar-popup = '+dataSidebarPopup+']').removeClass('open');
    $('[data-sidebar-backdrop = '+dataSidebarBackdrop+']').fadeOut();
    $('html').removeClass('sidebar-popup-open');
  });
});