jQuery(function ($) {
  'use strict';

  /****======  Sticky Header ======*******/
  var scrollPosition = window.scrollY;
  if (scrollPosition >= 400) {
    $(".sticy-header").addClass("animated fadeInDown fixed");
  }
  var header = $(".sticy-header");
  $(window).on("scroll", function () {
    if ($(this).scrollTop() < 400) {
      header.removeClass("animated fadeInDown fixed");
    } else {
      header.addClass("animated fadeInDown fixed");
    }
  });


  /****======  newsLetter_popup ======*******/
  let selector = $(".modal-btn");
  selector.magnificPopup({
    type: "inline",
    closeBtnInside: true,
    autoFocusLast: true,
    focus: ".modal-title",
  });
  selector.click();

  /****======  Active class add Remove  ======*******/
  $(".menubar").on("click", function () {
    $(".mobile-menu__sidebar-menu ").addClass("active");
    $(".menu-closer").addClass("active");
  });

  $(".search-box.menu").on("click", function () {
    $(".search-box-popup").addClass("active");
  });
  $(".search-box-close").on("click", function () {
    $(".search-box-popup").removeClass("active");
  });

  $(".menu-closer").on("click", function () {
    $(".mobile-menu__sidebar-menu ").removeClass("active");
    $(".menu-closer").removeClass("active");
  });

  $(".mobile-menu__sidebar-menu .dropdown-list .menuarrow").on("click", function () {
    $(this).parent().parent().find(".dropdown").toggle(300);
    $(this).parent().parent().toggleClass("active");
  });

  $(".mobile-menu__sidebar-menu .dropdown .menuarrowtwo").on("click", function () {
    $(this).parent().parent().find(".subdropdown").toggle(300);
    $(this).parent().parent().toggleClass("active");
  });

  $(".cart-icon").on("click", function () {
    $(".side-cart").addClass("active");
    $(".side-cart-closer").addClass("active");
  });
  $(".cart-close").on("click", function () {
    $(".side-cart").removeClass("active");
    $(".side-cart-closer").removeClass("active");
  });

  $(".menubar").on("click", function () {
    $(".sidebar-content").addClass("active");
    $(".sidebar-content-closer").addClass("active");
  });
  $(".close-side-widget").on("click", function () {
    $(".sidebar-content").removeClass("active");
  });

  $(".sidebar-content-closer").on("click", function () {
    $(".sidebar-content-closer").removeClass("active");
    $(".sidebar-content").removeClass("active");
  });

  $(".close-side-widget").on("click", function () {
    $(".sidebar-content-closer").removeClass("active");
  });

  $(".side-cart-closer").on("click", function () {
    $(".side-cart").removeClass("active");
    $(".side-cart-closer").removeClass("active");
  });

  $(".slidebarfilter, .remove-sidebar").on("click", function () {
    $(".shop-grid-sidebar").toggleClass("active");
  });

  $(".varients li a").on("click", function () {
    $(".varients li a").removeClass("active");
    $(this).addClass("active");
  });


  /****====== Single Product Img Change  ======*******/
  if ($(".varients").length) {
    $(".varients li a").on("click", function () {
      var $this = $(this),
        img_src = $this.data('src');
      var target_slider = $('.single-product-box .big-product').find('.slick-slide.slick-current.slick-active');
      target_slider.find('img').attr('src', img_src);
    });
  };

  /****======  Product Image Change  ======*******/
  if ($(".products-grid-one__product-varient img").length) {
    $(".products-grid-one__product-varient img").on("click", function () {
      $(this).parent().parent().parent().find(".products-grid-one__hover-img").attr("src", $(this).attr("src"));
    });
  };


  /****======  banner-one__slider Slick  ======*******/
  $(".slick").slick({
    prevArrow: '<div class="slick-arrow arrow-back"> <i class="flaticon-left-arrow-2"></i> </div>',
    nextArrow: '<div class="slick-arrow arrow-next"> <i class="flaticon-right-arrow-2"></i> </div>'
  });


  /****======  banner-4 Slick  ======*******/
  $(".banner4slider").slick({
    dots: false,
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    autoplay: true,
    fade: true,
    autoplaySpeed: 7000,
    pauseOnHover: false,
  });


  /****======  Home 5 Banner Slider  ======*******/
  if ($(".hero-slider5").length) {
    $(".hero-slider5").slick({
      dots: true,
      arrows: false,
      infinite: false,
      vertical: true,
      speed: 700,
      slidesToShow: 1,
      slidesToScroll: 1,
      prevArrow: '<div class="slick-arrow slick-prev"><i class="mi-chevron-left" aria-hidden="true"></i></div>',
      nextArrow: '<div class="slick-arrow slick-next"><i class="mi-chevron-right" aria-hidden="true"></i></div>'
    }).on('beforeChange', function () {
      $('.hero-slider__title').removeClass("aos-animate");
      $('.hero-slider__content').removeClass("aos-animate");
      $('.hero-slider__btn').removeClass("aos-animate");
    }).on('afterChange', function (event, slick, currentSlide) {
      $('.hero-slider__title').addClass("aos-animate");
      $('.hero-slider__content').addClass("aos-animate");
      $('.hero-slider__btn').addClass("aos-animate");

    });
  };

  /****======  product 5  CAtagory ======*******/
  if ($(".product-cat-slider").length) {
    $(".product-cat-slider").slick({
      dots: false,
      arrows: true,
      infinite: true,
      speed: 700,
      slidesToShow: 6,
      slidesToScroll: 1,
      centerMode: true,
      prevArrow: '<div class="slick-arrow slick-prev"><i class="flaticon-left-arrow-1" aria-hidden="true"></i></div>',
      nextArrow: '<div class="slick-arrow slick-next"><i class="flaticon-next-1" aria-hidden="true"></i></div>',
      responsive: [{
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    });
  };

  /****======  partnerslider Slick  ======*******/
  if ($(".partnerslider").length) {
    $(".partnerslider").slick({
      dots: false,
      infinite: true,
      speed: 300,
      slidesToShow: 5,
      slidesToScroll: 1,
      arrows: false,
      autoplay: true,
      autoplaySpeed: 2000,
      pauseOnHover: false,
      responsive: [{
          breakpoint: 992,
          settings: {
            slidesToShow: 4,
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 400,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 1,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    });
  };


  /****======  partnerslider-four Slick  ======*******/
  if ($(".partnerslider-four").length) {
    $(".partnerslider-four").slick({
      dots: false,
      infinite: true,
      speed: 300,
      slidesToShow: 4,
      slidesToScroll: 1,
      arrows: false,
      autoplay: true,
      autoplaySpeed: 2000,
      pauseOnHover: false,
      responsive: [{
          breakpoint: 992,
          settings: {
            slidesToShow: 3,
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 400,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 1,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    });
  };


  /****======  reviewOneSlider  ======*******/
  if ($(".reviewOneSlider").length) {
    $(".reviewOneSlider").slick({
      dots: false,
      infinite: true,
      speed: 300,
      slidesToShow: 3,
      slidesToScroll: 1,
      arrows: true,
      autoplay: true,
      prevArrow: '<button class="arrow-back"><i class="flaticon-back"></i> </button>',
      nextArrow: '<button class="arrow-next"><i class="flaticon-next"></i></button>',
      autoplaySpeed: 2000,
      pauseOnHover: false,
      responsive: [{
          breakpoint: 992,
          settings: {
            slidesToShow: 2,
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
          }
        }
      ]
    });
  };

  /****======  ftproductgr  ======*******/
  if ($(".ftproductgr").length) {
    $(".ftproductgr").slick({
      dots: false,
      infinite: true,
      speed: 300,
      slidesToShow: 3,
      slidesToScroll: 1,
      arrows: true,
      autoplay: true, 
      prevArrow: '<button class="arrow-back"> <img src="assets/images/home-six/arroe-left.png" alt=""></button>',
      nextArrow: '<button class="arrow-next"> <img src="assets/images/home-six/arroe-right.png" alt=""></button>',
      autoplaySpeed: 2000,
      pauseOnHover: false,
      responsive: [{
          breakpoint: 992,
          settings: {
            slidesToShow: 2,
          }
        } 
      ]
    });
  };


  /****======  testimonial-two__slider  ======*******/
  if ($(".testimonial-two__slider").length) {
    $(".testimonial-two__slider").slick({
      dots: false,
      infinite: true,
      speed: 300,
      slidesToShow: 3,
      slidesToScroll: 1,
      arrows: false,
      autoplay: true,
      autoplaySpeed: 2000,
      pauseOnHover: false,
      responsive: [{
          breakpoint: 992,
          settings: {
            slidesToShow: 2,
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
          }
        }
      ]
    });
  };

  /****======  product-two-slider-box  ======*******/
  if ($(".product-two-slider-box").length) {
    $(".product-two-slider-box").slick({
      dots: false,
      infinite: true,
      speed: 300,
      slidesToShow: 4,
      slidesToScroll: 1,
      arrows: true,
      autoplay: true,
      prevArrow: '<button class="arrow-back"><i class="flaticon-back"></i> </button>',
      nextArrow: '<button class="arrow-next"><i class="flaticon-next"></i></button>',
      autoplaySpeed: 2000,
      pauseOnHover: false,
      responsive: [{
          breakpoint: 768,
          settings: {
            slidesToShow: 2,
          }
        },
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 2,
          }
        },
        {
          breakpoint: 1200,
          settings: {
            slidesToShow: 3,
          }
        }
      ]
    });
  };


  /****====== Catagory_slider  ======*******/
  if ($(".catagory-slider").length) {
    $(".catagory-slider").slick({
      dots: false,
      infinite: false,
      speed: 300,
      slidesToShow: 4,
      slidesToScroll: 1,
      arrows: true,
      autoplay: true,
      prevArrow: '<button class="arrow-back"><i class="flaticon-back"></i> </button>',
      nextArrow: '<button class="arrow-next"><i class="flaticon-next"></i></button>',
      autoplaySpeed: 2000,
      pauseOnHover: false,
      responsive: [{
          breakpoint: 768,
          settings: {
            slidesToShow: 2,
          }
        },
        {
          breakpoint: 1199,
          settings: {
            slidesToShow: 3,
          }
        },
        {
          breakpoint: 1399,
          settings: {
            slidesToShow: 4,
          }
        }
      ]
    });
    $('.nav-pills button[data-bs-toggle="pill"]').on('shown.bs.tab', function (e) {
      e.target
      e.relatedTarget
      $('.catagory-slider').slick('setPosition');
    });
  }
  if ($(".categories-tab .nav-link").length) {
    $(".categories-tab .nav-link").click(function () {
      $("#overlay").fadeIn().delay(100).fadeOut();
    });
  };



  if ($(".catagory-slider-three").length) {
    $(".catagory-slider-three").slick({
      dots: false,
      infinite: false,
      speed: 300,
      slidesToShow: 5,
      slidesToScroll: 1,
      arrows: true,
      autoplay: true,
      prevArrow: '<button class="arrow-back"><i class="flaticon-back"></i> </button>',
      nextArrow: '<button class="arrow-next"><i class="flaticon-next"></i></button>',
      autoplaySpeed: 2000,
      pauseOnHover: false,
      responsive: [{
          breakpoint: 768,
          settings: {
            slidesToShow: 2,
          }
        },
        {
          breakpoint: 1199,
          settings: {
            slidesToShow: 3,
          }
        },
        {
          breakpoint: 1599,
          settings: {
            slidesToShow: 4,
          }
        }
      ]
    });
    $('.nav-pills button[data-bs-toggle="pill"]').on('shown.bs.tab', function (e) {
      e.target
      e.relatedTarget
      $('.catagory-slider-three').slick('setPosition');
    });
  }
  if ($(".categories-tab .nav-link").length) {
    $(".categories-tab .nav-link").click(function () {
      $("#overlay").fadeIn().delay(100).fadeOut();
    });
  };



  /****======  product-slider   ======*******/
  if ($(".product-slider-main").length) {
    $(".product-slider-main").slick({
      dots: false,
      infinite: true,
      speed: 300,
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: true,
      autoplay: true,
      prevArrow: '<button class="arrow-back"><i class="flaticon-back"></i> </button>',
      nextArrow: '<button class="arrow-next"><i class="flaticon-next"></i></button>',
      autoplaySpeed: 2000,
      pauseOnHover: false,
    });
  };


  /****====== Hero-Slider Start  ======*******/
  if ($(".hero-slider").length) {
    $(".hero-slider").slick({
      dots: false,
      infinite: false,
      speed: 300,
      slidesToShow: 4,
      slidesToScroll: 1,
      arrows: true,
      autoplay: true,
      prevArrow: '<button class="arrow-back"><img src="assets/images/home-four/arrow-left.png" alt="images"> </button>',
      nextArrow: '<button class="arrow-next"> <img src="assets/images/home-four/arrow-right.png" alt="images"></button>',
      autoplaySpeed: 2000,
      pauseOnHover: false,
      responsive: [{
          breakpoint: 576,
          settings: {
            slidesToShow: 1,
          }
        },
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 2,
          }
        },

        {
          breakpoint: 1400,
          settings: {
            slidesToShow: 3,
          }
        }
      ]
    });
  };


  /****====== product single 3  ======*******/
  $(".single-product-three").slick({
    dots: false,
    infinite: false,
    speed: 300,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    autoplay: true,
    prevArrow: '<button class="arrow-back"><i class="flaticon-left-arrow-1"></i> </button>',
    nextArrow: '<button class="arrow-next"><i class="flaticon-next-1"></i></button>',
    autoplaySpeed: 4000,
    asNavFor: '.slider-nav',
    pauseOnHover: false,
  });

  $(".single-product-three-nav").slick({
    slidesToShow: 5,
    slidesToScroll: 1,
    asNavFor: '.slider-for',
    dots: false,
    focusOnSelect: true,
    infinite: false,
    speed: 300,
    arrows: false,
    autoplay: true,
    autoplaySpeed: 4000,
    pauseOnHover: false,
  });


  /****====== product single 2  ======*******/
  $(".single-product-two").slick({
    dots: false,
    infinite: false,
    speed: 300,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    autoplay: true,
    prevArrow: '<button class="arrow-back"><i class="flaticon-left-arrow-1"></i> </button>',
    nextArrow: '<button class="arrow-next"><i class="flaticon-next-1"></i></button>',
    autoplaySpeed: 4000,
    asNavFor: '.slider-nav',
    pauseOnHover: false
  });
  $(".single-product-two-nav").slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    asNavFor: '.slider-for',
    dots: false,
    focusOnSelect: true,
    infinite: false,
    vertical: true,
    speed: 300,
    arrows: true,
    autoplay: true,
    autoplaySpeed: 4000,
    prevArrow: '<button class="arrow-back"><i class="flaticon-left-arrow-1"></i> </button>',
    nextArrow: '<button class="arrow-next"><i class="flaticon-next-1"></i></button>',
    pauseOnHover: false,
    responsive: [{
        breakpoint: 576,
        settings: {
          slidesToShow: 2,
        }
      },
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 3,
        }
      },

    ]
  });


  /****====== product single 1  ======*******/
  $(".single-product-one").slick({
    dots: false,
    infinite: false,
    speed: 300,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    autoplay: true,
    prevArrow: '<button class="arrow-back"><i class="flaticon-left-arrow-1"></i> </button>',
    nextArrow: '<button class="arrow-next"><i class="flaticon-next-1"></i></button>',
    autoplaySpeed: 4000,
    asNavFor: '.slider-nav',
    pauseOnHover: false
  });

  $(".single-product-one-nav").slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    asNavFor: '.slider-for',
    dots: false,
    focusOnSelect: true,
    infinite: false,
    speed: 300,
    arrows: true,
    autoplay: true,
    autoplaySpeed: 4000,
    prevArrow: '<button class="arrow-back"><i class="flaticon-left-arrow-1"></i> </button>',
    nextArrow: '<button class="arrow-next"><i class="flaticon-next-1"></i></button>',
    pauseOnHover: false
  });


  /****======  Zoom Product  ======*******/
  if ($(".single-product-two .single-item").length) {
    $(".single-product-two .single-item").zoom();
  };


  /****======  gallery-two__slider Start  ======*******/
  if ($(".gallery-two__slider").length) {
    $(".gallery-two__slider").slick({
      dots: false,
      infinite: true,
      speed: 300,
      slidesToShow: 6,
      slidesToScroll: 1,
      arrows: true,
      autoplay: true,
      prevArrow: '<button class="arrow-back"><i class="flaticon-back"></i> </button>',
      nextArrow: '<button class="arrow-next"><i class="flaticon-next"></i></button>',
      autoplaySpeed: 2000,
      pauseOnHover: false,
      responsive: [{
          breakpoint: 575,
          settings: {
            slidesToShow: 2,
          }
        },
        {
          breakpoint: 767,
          settings: {
            slidesToShow: 3,
          }
        },
        {
          breakpoint: 1200,
          settings: {
            slidesToShow: 4,
          }
        }
      ]
    });
  };


  if ($(".insta-slider").length) {
    $(".insta-slider").magnificPopup({
      delegate: 'a',
      type: 'image',
      mainClass: 'mfp-fade',
      removalDelay: 160,
      preloader: false,
      fixedContentPos: false,
      gallery: {
        enabled: true
      },
      zoom: {
        enabled: true,
        duration: 300,
        easing: 'ease-in-out',
        opener: function (openerElement) {
          return openerElement.is('img') ? openerElement : openerElement.find('img');
        }
      }
    });
  };


  if ($(".single-product-three .single-item").length) {
    $(".single-product-three .single-item").magnificPopup({
      delegate: 'a',
      type: 'image'
    });
  };


  /****======   Blog Page  ======*******/
  if ($(".blog-thumb-slider").length) {
    $(".blog-thumb-slider").slick({
      dots: false,
      infinite: true,
      speed: 1000,
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: true,
      autoplay: true,
      autoplaySpeed: 3000,
      prevArrow: '<button class="arrow-back"><i class="flaticon-back"></i> </button>',
      nextArrow: '<button class="arrow-next"><i class="flaticon-next"></i></button>',
      pauseOnHover: false
    });
  };




  /****======  partnerslider-four Slick  ======*******/
  if ($(".insta-slider").length) {
    $(".insta-slider").slick({
      dots: false,
      infinite: true,
      speed: 300,
      slidesToShow: 4,
      slidesToScroll: 1,
      arrows: false,
      autoplay: true,
      autoplaySpeed: 2000,
      pauseOnHover: false,
      responsive: [{
          breakpoint: 992,
          settings: {
            slidesToShow: 3,
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 400,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 1,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    });
  };












  //=== CountDownTimer===  
  if ($(".time-countdown-two").length) {
    $(".time-countdown-two").each(function () {
      var Self = $(this);
      var countDate = Self.data('countdown-time'); // getting date

      Self.countdown(countDate, function (event) {
        $(this).html('<li> <div class="box"> <span class="days">' + event.strftime('%D') + '</span> <span class="timeRef">days</span> </div> </li> <li> <div class="box"> <span class="hours">' + event.strftime('%H') + '</span> <span class="timeRef clr-1">hours</span> </div> </li> <li> <div class="box"> <span class="minutes">' + event.strftime('%M') + '</span> <span class="timeRef clr-2">min</span> </div> </li> <li> <div class="box"> <span class="seconds">' + event.strftime('%S') + '</span> <span class="timeRef clr-3">sec</span> </div> </li>');
      });
    });
  };

  /****======  niceSelect  ======*******/
  if ($("select").length) {
    $("select").niceSelect();
  };


  /****======  Wow  ======*******/
  new WOW().init();


  /****====== Magnific popup_link  ======*******/
  if ($(".popup_link").length) {
    $(".popup_link").magnificPopup({
      type: "inline",
      midClick: true,
      mainClass: "mfp-fade"
    });
  };

  /****====== Magnific popup video ======*******/
  if ($(".video-popup").length) {
    $(".video-popup").magnificPopup({
      type: 'iframe'
    });
  };


  /****====== MIXitup ======*******/
  if ($(".products-grid").length) {
    $('#grid').mixItUp();
  };



  /****======  Jquery tabs  ======*******/
  $(".tabs").tabs({
    neighbors: {
      prev: $("button.prev"),
      next: $("button.next")
    }
  });


  /****======  Increase and decrease number by click  ======*******/
  if ($(".increaseQty").length) {
    var minVal = 1,
      maxVal = 20;
    $(".increaseQty").on("click", function () {
      var $parentElm = $(this).parents(".qtySelector");
      $(this).addClass("clicked");
      setTimeout(function () {
        $(".clicked").removeClass("clicked");
      }, 100);
      var value = $parentElm.find(".qtyValue").val();
      if (value < maxVal) {
        value++;
      }
      $parentElm.find(".qtyValue").val(value);
    });
  };

  if ($(".decreaseQty").length) {
    $(".decreaseQty").on("click", function () {
      var $parentElm = $(this).parents(".qtySelector");
      $(this).addClass("clicked");
      setTimeout(function () {
        $(".clicked").removeClass("clicked");
      }, 100);
      var value = $parentElm.find(".qtyValue").val();
      if (value > 1) {
        value--;
      }
      $parentElm.find(".qtyValue").val(value);
    });
  };


  /****====== banner-one TweenMax Js  ======*******/
  if ($(".banner-one__single-slide").length) {
    $(".banner-one__single-slide").on("mousemove", function (e) {
      parallaxIt(e, ".banner-one__slideimg_two", -20);
      parallaxIt(e, ".banner-one__shape1", 10);
      parallaxIt(e, ".banner-one__shape2", 15);
      parallaxIt(e, ".banner-one__shape3", 25);
    });

    function parallaxIt(e, target, movement) {
      var $this = $(".banner-one__single-slide");
      var relX = e.pageX - $this.offset().left;
      var relY = e.pageY - $this.offset().top;

      TweenMax.to(target, 1, {
        x: (relX - $this.width() / 2) / $this.width() * movement,
        y: (relY - $this.height() / 2) / $this.height() * movement
      });
    }
  };

  /****====== upcoming-item TweenMax Js  ======*******/
  if ($(".upcoming-item").length) {
    $(".upcoming-item").on("mousemove", function (e) {
      parallaxIt(e, ".upcoming-item__signature", -50);
    });

    function parallaxIt(e, target, movement) {
      var $this = $(".upcoming-item");
      var relX = e.pageX - $this.offset().left;
      var relY = e.pageY - $this.offset().top;

      TweenMax.to(target, 1, {
        x: (relX - $this.width() / 2) / $this.width() * movement,
        y: (relY - $this.height() / 2) / $this.height() * movement
      });
    }
  };


  /* password show hide on form field  */
  if ($(".eye .icon-2").length) {
    $(".eye .icon-2").click(function () {
      var x = document.getElementById("password-field");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
      $(this).hide();
      $(".eye .icon-1").css("display", "block");
    });
  };

  if ($(".eye .icon-1").length) {
    $(".eye .icon-1").click(function () {
      var x = document.getElementById("password-field");
      if (x.type === "text") {
        x.type = "password";
      } else {
        x.type = "text";
      }
      $(this).hide();
      $(".eye .icon-2").css("display", "block");
    });
  };

  //  Price Filter 
  if ($("#price-range").length) {
    $("#price-range").slider({
      range: true,
      min: 0,
      max: 200000,
      values: [0, 200000],
      slide: function (event, ui) {
        $("#priceRange").val("$" + ui.values[0] + " - $" + ui.values[1]);
      }
    });
    $("#priceRange").val("$" + $("#price-range").slider("values", 0) + " - $" + $("#price-range").slider("values", 1));
  };


  /****======  Bottom to Top Scroll Js  ======*******/
  var ScrollTop = $(".scrollToTop");
  $(window).on("scroll", function () {
    if ($(this).scrollTop() < 500) {
      ScrollTop.removeClass("active");
    } else {
      ScrollTop.addClass("active");
    }
  });
  $(".scrollToTop").on("click", function () {
    $("html, body").animate({
      scrollTop: 0
    }, 250);
    return false;
  });

  $(window).on("load", function () {

    /****======  Preloader Js  ======*******/
    $(".loader").delay(500).animate({
      "opacity": "0"
    }, 500, function () {
      $(".loader").css("display", "none");
    });
  });

}(jQuery));