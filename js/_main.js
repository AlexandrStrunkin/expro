/*
var slidesCount = 6;
var sliderArr = [];
    sliderArr[4] = {width1: 165, width2: 130, widthLi: 32, widthLi2: 16};
    sliderArr[5] = {width1: 212, width2: 200, widthLi: 36, widthLi2: 18};
    sliderArr[6] = {width1: 275, width2: 230, widthLi: 40, widthLi2: 20};


function setSlider($_this, itemsCount) {
  $_this.find('.color_slider').flexslider({
      namespace: 'color-',
      animation: 'slide',
      directionNav: true,
      controlNav: false,
      slideshow: false,
      itemWidth: 44,
      itemMargin: 0,
      minItems: itemsCount,
      maxItems: itemsCount,

      start: function(){
        $_this.find('.color-prev').hide('400');
        $_this.find('.color-prev').addClass('hidden');
      },

      before: function(){
        $_this.find('.color-prev').show('400');
        $_this.find('.color-next').show('400');
        $_this.find('.color-prev').removeClass('hidden');
        $_this.find('.color-next').removeClass('hidden');
      },

      after: function(){
        if (($('.slides').css('-webkit-transform') == 'matrix(1, 0, 0, 1, 0, 0)') || ($('.slides').css('transform') == 'matrix(1, 0, 0, 1, 0, 0)')) {
          // STEP 1
          $_this.find('.color-prev').hide('400');
          $_this.find('.color-prev').addClass('hidden');
          $_this.find('.color_slider').css({'margin-left': '0px', 'width': sliderArr[slidesCount].width1});
        } else {
          $_this.find('.color-prev').show('400');
          $_this.find('.color-prev').removeClass('hidden');
          if (!$_this.find('.color_slider').hasClass('isEnd')) {
            $_this.find('.color_slider').css({'margin-left': sliderArr[slidesCount].widthLi, 'width': sliderArr[slidesCount].width2});  
          } else {
            $_this.find('.color_slider').removeClass('isEnd');
          }
        }
      },

      end: function(){
        $_this.find('.color-next').hide('400');
        $_this.find('.color-next').addClass('hidden');
        //$_this.find('.color_slider').css('width', sliderArr[slidesCount].width1);
        $_this.find('.color_slider').addClass('isEnd');
      }

  });
}

// -----------------------------------------

function sliderCreate($_this) {
  // открытие слайдера цвета
  $_this.find('.color_slider').addClass('flex_active');
  $_this.find('.btn_color').addClass('close');
  $_this.find('.slides li').not('.slides li:nth-child(1)').stop(true, true);

  $_this.find('.slides li').animate({'margin-left' : '0px'}, 500, function() {
    if ($_this.find('.slides li').length > slidesCount) {
      setSlider($_this, slidesCount);
    }
  });
}

// -----------------------------------------

function sliderDestroy($_this) {
  // закрытие слайдера цвета
  $_this.find('.btn_color').removeClass('close');
  if ($_this.find('.slides li').length > slidesCount) {
    $_this.find('.slides li').not('.slides li:nth-child(1)').animate({'margin-left' : '-' + sliderArr[slidesCount].widthLi2 + 'px'}, 500, function(){
      $_this.find('.color_slider').removeClass('flex_active');
      if ($_this.find('.color-viewport').length) {
        $_this.find('.color_slider').flexslider('destroy');  
      }
      $_this.find('.color_slider').css({'margin-left' : '0', 'width' : sliderArr[slidesCount].width1});
    });
  } else {
    $_this.find('.color_slider').removeClass('flex_active');
    $_this.find('.slides li').not('.slides li:nth-child(1)').animate({'margin-left' : '-' + sliderArr[slidesCount].widthLi2 + 'px'}, 500);
    $_this.find('.color_slider').css({'margin-left' : '0', 'width' : sliderArr[slidesCount].width1});
  }
}

// -----------------------------------------
*/

function setFooterMargins() {
  var documentWidth = $(window).width();

  if ((documentWidth >= 1263) && (documentWidth <= 1583)) {
    var footerWidth = $('.footer_menu').width();
    var footerElementsWidth = 0;
    var footerElementsWidthAll = '';
  
    $('.footer_menu > ul > li').each(function(index, el) {
      footerElementsWidthAll = footerElementsWidthAll + ' - ' + $(this).width();
      footerElementsWidth += Math.ceil($(this).width());
    });
  
    var marginRight = ((footerWidth - footerElementsWidth) / 5) - 1;
  
    $('.footer_menu > ul > li').css('margin-right', marginRight);
    $('.footer_menu > ul > li').last().css('margin-right', '0');
  } else {
    $('.footer_menu > ul > li').css('margin-right', '80px');
    $('.footer_menu > ul > li').last().css('margin-right', '0');
  }

/*
  $('.catalog_wrapper__item').each(function(index, el) {
    if ($(this).find('.slides li').length > slidesCount) {
      if ($(this).find('.color-viewport').length) {
        $(this).find('.color_slider').flexslider('destroy');
        setSlider($_this, slidesCount);
        $_this.find('.color_slider').css('width', sliderArr[slidesCount].width1);
      }
    }
  });
*/
}


// -----------------------------------------
// -----------------------------------------


$(document).ready(function() {



/*
  if ($(document).width() < 1523) {
    slidesCount = 4;
  }

  if (($(document).width() >= 1523) && ($(document).width() < 1783)) {
    slidesCount = 5;
  }

  if ($(document).width() >= 1783) {
    slidesCount = 6;
  }
*/
	// подключение слайдеров
  $('.slider').flexslider({
    animation: 'fade',
    directionNav: false,
    slideshow: true,
    slideshowSpeed: 7000,
    animationSpeed: 1500
  });

  $('.catalog_wrapper__item__image img').css('height', $('.catalog_wrapper__item').height());

  // HOVER
  $('.catalog_wrapper__item').hover(function(event) {
    var $_this = $(this);
    /*
    sliderCreate($_this);
    */
    $_this.find('.catalog_wrapper__item__image__quickview_wrapper').fadeIn('200');
  }, function() {
    var $_this = $(this);
    /*
    sliderDestroy($_this);
    */
    $_this.find('.catalog_wrapper__item__image__quickview_wrapper').fadeOut('200');
  });


  // BUTTON click
  $('body').on('click', '.catalog_wrapper__item .btn_color:not(.close)', function(event) {    
    /*
    var $_this = $(this).parents('.catalog_wrapper__item');
    sliderCreate($_this);
    */
  });

  $('body').on('click', '.catalog_wrapper__item .btn_color.close', function(event) {
    /*
    var $_this = $(this).parents('.catalog_wrapper__item');
    sliderDestroy($_this);
    */
  });
  

	// подключение fancybox
	$('.fancy').fancybox({
		padding: 0
	})

	// маска ввода для телефона
	$('.phone').mask("+7 (999) 999-99-99", {placeholder:"_"});

  // подключение кастомных инпутов
  $('.catalog_filter').fancyfields();

	// Валидация формы
  	$('.allform').each(function(){
    	$(this).unbind('submit').on('submit', function(e){
    		var emailPattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
    	    var isValid = true;
        	$(this).find('.req').each(function() {
      			if ($(this).attr('name') == 'email') {
      				if (!emailPattern.test($(this).val())) {
            			$(this).addClass('error');
	           			isValid = false;	
     				} else {
     					$(this).removeClass('error');
     				}
      			} else {
          			if ($(this).val() == '') {
            			$(this).addClass('error');
            			isValid = false;	
            		} else {
            			$(this).removeClass('error');
            		}
      			}
       		});
       		return isValid;	
        });
    });

    
  var heightTile = $('.one .tile_wrapper__item:nth-child(2)').height() - 1;

  $('.one .tile_wrapper__item:nth-child(1), .one .tile_wrapper__item:nth-child(4)').css('height', heightTile);
  $('.two .tile_wrapper__item:nth-child(1), .two .tile_wrapper__item:nth-child(4)').css('height', heightTile);

  $('.color_slider .slides li').hover(function(event) {
    var currentZindex = $(this).attr('z-index');
    $(this).css('z-index','101');
  }, function(){
    $(this).css('z-index','currentZindex')
  });

 });


$(window).resize(function() { 


  /*
  if ($(document).width() < 1523) {
    slidesCount = 4;
  }
  if (($(document).width() >= 1523) && ($(document).width() < 1783)) {
    slidesCount = 5;
  }
  if ($(document).width() >= 1783) {
    slidesCount = 6;
  }
  */

  var heightTile = $('.one .tile_wrapper__item:nth-child(2)').height() - 1;

  $('.slider').css('max-height', $('.slider li img').height());

  $('.tile_wrapper.one').css('margin-top', '0');

  $('.one .tile_wrapper__item:nth-child(1), .one .tile_wrapper__item:nth-child(4)').css('height', heightTile);
  $('.two .tile_wrapper__item:nth-child(1), .two .tile_wrapper__item:nth-child(4)').css('height', heightTile);

  $('.catalog_wrapper__item__image img').css('height', $('.catalog_wrapper__item').height());

  setFooterMargins();
});



$(window).load(function() {

  var heightTile = $('.one .tile_wrapper__item:nth-child(2)').height() - 1;

  $('.one .tile_wrapper__item:nth-child(1), .one .tile_wrapper__item:nth-child(4)').css('height', heightTile);
  $('.two .tile_wrapper__item:nth-child(1), .two .tile_wrapper__item:nth-child(4)').css('height', heightTile);

    $('.slides').slick({
      infinite: false,
      speed: 300,
      slidesToShow: 6,
      slidesToScroll: 6,
      respondTo: 'window',
      responsive: [
        {
          breakpoint: 1880,
          settings: {
            slidesToShow: 5,
            slidesToScroll: 5
          }
        },
        {
          breakpoint: 1600,
          settings: {
            slidesToShow: 4,
            slidesToScroll: 4
          }
        },
        {
          breakpoint: 1400,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3
          }
        }
      ]
    });

    
    $('.slides').on('beforeChange', function(event, slick, currentSlide, nextSlide){
      $('.slick-prev').css('left','0');
    });


  setFooterMargins();

});

$(window).scroll(function () {
  
  var heightScrollTop = $('body').scrollTop();

  //console.log($('body').scrollTop());

  /*
  if (heightScrollTop > 315) {
    $('.wrapper').addClass('scrolling');
  } else {
    $('.wrapper').removeClass('scrolling');
  }
  */

});