// Browser detection
navigator.sayswho = (function () {
    var ua = navigator.userAgent, tem,
    M = ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || [];
    if (/trident/i.test(M[1])) {
        tem = /\brv[ :]+(\d+)/g.exec(ua) || [];
        return 'IE ' + (tem[1] || '');
    }
    if (M[1] === 'Chrome') {
        tem = ua.match(/\b(OPR|Edge)\/(\d+)/);
        if (tem != null) return tem.slice(1).join(' ').replace('OPR', 'Opera');
    }
    //M= M[2]? [M[1], M[2]]: [navigator.appName, navigator.appVersion, '-?'];
    M = M[2] ? [M[1], M[2]] : [navigator.appName, navigator, '-?'];
    //if((tem= ua.match(/version\/(\d+)/i))!= null) M.splice(1, 1, tem[1]);
    //return M.join(' ');
    return M[0];
})();

//var slidesCount = 6;
var sliderMode = 2;


var sliderArr = [
    {width1: 160, width2: 120, itemWidth: 40, itemWidthHalf: 20, count: 4},
    {width1: 200, width2: 160, itemWidth: 40, itemWidthHalf: 20, count: 5},
    {width1: 184, width2: 138, itemWidth: 46, itemWidthHalf: 23, count: 4},

    {width1: 212, width2: 170, itemWidth: 42, itemWidthHalf: 23, count: 5},
    {width1: 255, width2: 212, itemWidth: 42, itemWidthHalf: 23, count: 6}
];

function getSliderMode() {
    var documentWidth = $(document).width();
    var result = 0;

    if (documentWidth >= 1463) result = 1;
    if (documentWidth >= 1503) result = 2;
    if (documentWidth >= 1623) result = 3;
    if (documentWidth >= 1863) result = 4;

    return result;
}

function setSlider($_this) {
    $_this.find('.color_slider').css({'width': sliderArr[sliderMode].width1});
    $_this.find('.color_slider .color_slider_mask').show();
    $_this.find('.color_slider').flexslider({
        namespace: 'color-',
        animation: 'slide',
        directionNav: true,
        controlNav: false,
        slideshow: false,
        itemWidth: sliderArr[sliderMode].itemWidth,
        itemMargin: 0,
        minItems: sliderArr[sliderMode].count,
        maxItems: sliderArr[sliderMode].count,
        move: sliderArr[sliderMode].count - 1,

        start: function () {
            $_this.find('.color-prev').hide();
            $_this.find('.color-next').show();
            $_this.find('.color-prev').addClass('hidden');

            $_this.find('.color-prev').css('left', '-' + sliderArr[sliderMode].arrowOut + 'px');
            $_this.find('.color-next').css('right', '-' + sliderArr[sliderMode].arrowOut + 'px');

            $_this.find('.color_slider_mask').css('z-index', '0');

            $_this.find('.color-next').hover(function () {
                $_this.find('.color_slider_mask').css('z-index', '100');
                }, function () {
                    function zIndex() {
                        $_this.find('.color_slider_mask').css('z-index', '0');
                    }

                    setTimeout(zIndex, 400);
            });

            $_this.find('.color-prev').hover(function () {
                $_this.find('.color_slider_mask').css('z-index', '100');
                }, function () {
                    function zIndex() {
                        $_this.find('.color_slider_mask').css('z-index', '0');
                    }

                    setTimeout(zIndex, 400);
            });

        },

        before: function () {
            $_this.find('.color_slider_mask').css('z-index', '100');
            $_this.find('.color-prev').show();
            $_this.find('.color-next').show();
            $_this.find('.color-prev').removeClass('hidden');
            $_this.find('.color-next').removeClass('hidden');
        },

        after: function (slider) {
            if (slider.currentSlide == 0) {
                // STEP 1
                $_this.find('.color-prev').hide();
                $_this.find('.color-prev').addClass('hidden');
                $_this.find('.color_slider').css({'margin-left': '0px', 'width': sliderArr[sliderMode].width1});

            } else {
                // STEP EVERY
                //$_this.find('.color_slider_mask').css('z-index','0');
                $_this.find('.color-prev').show();
                $_this.find('.color-prev').removeClass('hidden');
                $_this.find('.color_slider').css({
                    'margin-left': sliderArr[sliderMode].itemWidth,
                    'width': sliderArr[sliderMode].width2
                });

                if ($_this.find('.color_slider').hasClass('isEnd')) {
                    // STEP LAST
                    $_this.find('.color-next').hide();
                    $_this.find('.color-next').addClass('hidden');
                    $_this.find('.color_slider').removeClass('isEnd');

                    var minusX = $_this.find('.slides').css('transform').split(', ');
                    if ((navigator.sayswho == 'IE 11') || (navigator.sayswho == 'IE 10')) {
                        minusX = -parseInt(minusX[12]);
                    } else {
                        minusX = -parseInt(minusX[4]);
                    }

                    var minusXDelta = minusX % sliderArr[sliderMode].itemWidth;
                    if (minusXDelta > 0) {
                        var minusXNew = minusX - minusXDelta + sliderArr[sliderMode].itemWidth;
                        if ((navigator.sayswho == 'IE 11') || (navigator.sayswho == 'IE 10')) {
                            $_this.find('.slides').css('transform', 'matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, ' + -minusXNew + ', 0, 0, 1)');
                        } else {
                            $_this.find('.slides').css('transform', 'matrix(1, 0, 0, 1, ' + -minusXNew + ', 0)');
                        }
                    }
                }
            }

            //setTimeout($_this.find('.color_slider_mask').css('z-index','0'), 500);
        },

        end: function () {
            $_this.find('.color_slider').addClass('isEnd');
        }
    });
}

// -----------------------------------------

function sliderCreate($_this) {
    // РѕС‚РєСЂС‹С‚РёРµ СЃР»Р°Р№РґРµСЂР° С†РІРµС‚Р°
    $_this.find('.color_slider').addClass('flex_active');
    $_this.find('.btn_color').addClass('close');
    $_this.find('.slides li').not('.slides li:nth-child(1)').stop(true, true);

    $_this.find('.slides li').animate({'margin-left': '0px'}, 500, function () {
        //$_this.find('.slides li').css('border-radius', '0');
        if ($_this.find('.slides li').length > sliderArr[sliderMode].count) {
            setSlider($_this);
        }
    });

    //if (documentWidth < 1510) {   $_this.find('.slides li').animate({'width' : '40px'}, 500);  }


}

// -----------------------------------------

function sliderDestroy($_this) {
    // Р·Р°РєСЂС‹С‚РёРµ СЃР»Р°Р№РґРµСЂР° С†РІРµС‚Р°
    $_this.find('.btn_color').removeClass('close');
    if ($_this.find('.slides li').length > sliderArr[sliderMode].count) {
        $_this.find('.slides li').not('.slides li:nth-child(1)').animate({'margin-left': '-' + sliderArr[sliderMode].itemWidthHalf + 'px'}, 500, function () {
            $_this.find('.color_slider').removeClass('flex_active');
            $_this.find('.color_slider .color_slider_mask').hide();
            if ($_this.find('.color-viewport').length) {
                $_this.find('.color_slider').flexslider('destroy');
            }
            $_this.find('.color_slider').css({'margin-left': '0', 'width': sliderArr[sliderMode].width1});
        });
    } else {
        $_this.find('.color_slider').removeClass('flex_active');
        $_this.find('.slides li').not('.slides li:nth-child(1)').animate({'margin-left': '-' + sliderArr[sliderMode].itemWidthHalf + 'px'}, 500);
        $_this.find('.color_slider').css({'margin-left': '0', 'width': sliderArr[sliderMode].width1});
    }
}

// -----------------------------------------

function setFooterMargins() {
    var documentWidth = $(window).width();

    if ((documentWidth >= 1263) && (documentWidth <= 1583)) {
        var footerWidth = $('.footer_menu').width();
        var footerElementsWidth = 0;
        var footerElementsWidthAll = '';
        $('.footer_menu > ul > li').each(function (index, el) {
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

    // -------------
    $('.catalog_wrapper__item').each(function (index, el) {
        if ($(this).find('.slides li').length > sliderArr[sliderMode].count) {
            if ($(this).find('.color-viewport').length) {
                $(this).find('.color_slider').flexslider('destroy');
                setSlider($(this).find('.color_slider'), sliderArr[sliderMode].count);
                $(this).find('.color_slider').css('width', sliderArr[sliderMode].width1);
            }
        }
    });

}

// -----------------------------------------
$(window).load(function(){
    catalogSeria();
    $('.catalog-seria .area1 .img-container,  .catalog-seria .area4 .img-container').jScrollPane({autoReinitialise: true,});

    /* $('.catalog-seria .fancy').fancybox({
    autoCenter: true,
    fixed: true,
    padding: 0,
    margin: 40});*/
});
$(document).ready(function () {

    /***************page404****************************/
    page404();
    /****************page news******************/
    var subStr = function(elT, title, rows){
        var j, h, newH, line = 0, lineArr = [], k = 0;
        //РѕР±СЂРµР·РєР° СЃС‚СЂРѕРєРё
        if (!title) return;
        elT.html("");
        h = 0;

        lineArr[0] = title;
        var wordsAll = title.split(' '), words = [];
        for (j = 0; j < wordsAll.length; j = j + 1) {
            if (wordsAll[j] !== "" && wordsAll[j] !== " " && wordsAll[j] !== "в†µ")
                words.push(wordsAll[j]);
        }


        for (j = 0; j <= words.length; j = j + 1) {
            if (line >= rows) continue;
            lineArr[line] = elT.text();
            elT.append(words[j] + " ");
            newH = elT.height();

            if (newH > h && j > 1) {
                if (line == rows - 1) {
                    lineArr[line] += "...";
                }
                line++;
                elT.html("");
                j--;
            }
            h = newH;
        }
        elT.html("");
        for (j = 0; j < rows; j++) {
            if (lineArr[j])
                elT.append("<span>"+lineArr[j]+"</span>");
        }
        i++;

    }
    var newsDataT = [], newsDataD = [], newsDataT1 = [];
    $(".page-news").css("opacity", "0");
    $(".page-news .item_info__title").each(function () {
      //  newsDataT.push($(this).text());   //Р·Р°РєРѕРјРјРµРЅС‚РёСЂРѕРІР°Р» 07.09.15
    });
    $(".page-news .item_info__description").each(function () {
        newsDataD.push($(this).text());
    });
    $(".page-downloads .item .text").each(function () {
        newsDataT1.push($(this).text());
    });

    setTimeout(function(){
        subStrInit();
        $(".page-news").css("opacity", "1");
        }, 20);


    var subStrInit = function () {
        var i = 0, j= 0, k =0;
        $(".page-news .item_info__title").each(function () {
            subStr($(this), newsDataT[i], 2);
            i++;
        });
        $(".page-news .item_info__description").each(function () {
            subStr($(this), newsDataD[j], 3);
            j++;
        });
        $(".page-downloads .item .text").each(function () {
            subStr($(this), newsDataT1[k], 1);
            k++
        });
    };

    $(window).resize(function(){

        setTimeout(function(){ subStrInit();}, 10);
    });

    /***************login popup****************************/
    $(".login-popup-link, .reg-popup-link").on("click", function(e){
        var targetForm = e.target.hash; 
        $(targetForm).fadeIn();
        $(".blurBackground").fadeIn();            
    });
    $(".popupCloseButton, .blurBackground").on("click", function(){
        $(".popupForm").fadeOut();
        $(".blurBackground").fadeOut();            
    });
    
    /*$(".login-popup-link").fancybox({padding: 0,
        afterLoad:function(){
            $(".fancybox-overlay").addClass("fancybox-gray");
            $(".wrapper").addClass("fancybox-blur");
        },
        afterShow:function(){
            $(".fancybox-close").addClass("fancybox-close-gray");
            $("body").css("overflow", "hidden");
        },
        afterClose:function(){
            $(".wrapper").removeClass("fancybox-blur");
            $("body").css("overflow", "auto");
        }
    });

    $(".reg-popup-link").fancybox({padding: 0, fixed:false, autoCenter: false,
        afterLoad:function(){
            $(".fancybox-overlay").addClass("fancybox-gray");
            $(".fancybox-inner, .fancybox-opened").addClass("fancybox-height-auto");
            var h = $(window).height();
            if (h > 620) h = 620;


            $(".wrapper").addClass("fancybox-blur");
        },
        afterShow:function(){
            $(".fancybox-close").addClass("fancybox-close-gray-reg");
            //   $("body").css("overflow", "hidden");
        },
        afterClose:function(){
            $(".wrapper").removeClass("fancybox-blur");

            //  $("body").css("overflow", "auto");
        }
    });   */
    // $(".login-popup-link").click();
    // $(".reg-popup-link").click();

    $(".dealer-link").click(function () {
        $(".form_error, .form_success").hide();
        $(".wrong_border").removeClass("wrong_border");
        var el = $(this);
        $(".dealer-link").removeClass("active");
        el.addClass("active");
        //$("#reg-popup input[name='dealer']").val((el.hasClass("new")) ? 1 : 2);
        if (el.hasClass("new")) {
            $(".dealer-new").show(); $(".dealer-2").hide();
            $("#newDealer").val("Y");
        } else {
            $(".dealer-new").hide(); $(".dealer-2").css("display", "block");
            $("#newDealer").val("N");
        }
    });
    /*e9e9e9*/


    /************info page***************************/
    $(".tabs a, .page-downloads-tabs a").on("click", function () {

        var el = $(this), id = el.attr("href");

        el.parent().parent().find(".tabs a, .page-downloads-tabs a").removeClass("active");
        el.addClass("active");
        el.parent().parent().find(".tab-content, .page-downloads").hide();
        $(id + "-content").show();
        return false;
    });

    $(".tabs a.active").click();

    /************************************/
    //СЃС‚СЂР°РЅРёС†Р° catalog-seria.html
    $(".catalog-seria .preview img").load(catalogSeria);

    var clf = function(){
        var href= $(this).attr("href");
        if (!$(this).hasClass("more")) {
            $(".catalog-seria .area1 a").removeClass("active");
            $(this).addClass("active");
            $(".catalog-seria .preview img").hide().attr("src", href).fadeIn(300);
        }


        return false;

    }


    var arrA = $(".catalog-seria .area1 .img-container a"), more1 = $(".catalog-seria .area1 .more");
    arrA.on("click",clf);
    for(i = 5; i <= arrA.length; i++) {
        $(arrA[i]).hide();
    }

    if (arrA.length > 6) { //(6 РїРѕС‚РѕРјСѓ С‡С‚Рѕ 5 РєР°СЂС‚РёРЅРѕРє Рё РєРЅРѕРїРєР° more) Рё РєРЅРѕРїРєСѓ more РІСЃРµРіРґР° РІС‹РІРѕРґРёС‚СЊ РІ РєРѕРЅС†Рµ, СЃРєСЂРёРїС‚РѕРј СЃРєСЂРѕРµС‚СЃСЏ РµСЃР»Рё СЌР»-С‚РѕРІ <=5
        more1.show(); $(arrA[4]).hide();
    } else more1.remove();

    var t, f = false;
    more1.hover(function(){ /*
        var a, img, data, el = $(this);
        if (f) return false;
        f = true;
        t = setTimeout(function(){
            for(i = 4; i <= arrA.length; i++) {
                $(arrA[i]).fadeIn(300);
            }
            el.fadeOut(300);
            catalogSeria();
            }, 300);

        return false;

        }, function(){
            clearTimeout(t);
            f = false;  */
         $(this).siblings("a:hidden").fadeIn();
         $(this).hide();

    });


    var t1, f1 = false;

    var arrA4 = $(".catalog-seria .area4 .img-container a"), more4 = $(".catalog-seria .area4 .more");
    for(i = 4; i <= arrA4.length; i++) {
        $(arrA4[i]).hide();
    }
    if (arrA4.length > 4) {
        more4.show(); $(arrA4[4]).hide();
    } else more4.remove();


    more4.hover(function(){
        var a, img, data, span, span1, el = $(this);

        if (f1) return false;
        f1 = true;

        t1 = setTimeout(function(){
            for(i = 5; i <= arrA4.length; i++) {
                $(arrA4[i]).fadeIn(300);
            }
            el.fadeOut(300);
            catalogSeria();
            }, 300);

        return false;
        }, function(){
            clearTimeout(t1);
            f1 = false;
    });



    $(".catalog-seria .area1 .img-container a").on("click",clf);

    var t, f = false;
    $(".catalog-seria .area1 .more").hover(function(){   /*
        var a, img, data, el = $(this);

        if (f) return false;

        f = true;
        t = setTimeout(function(){
            data = [
                {small: "files/2.jpg", preview: "files/2-big.jpg"},
                {small: "files/3.jpg", preview: "files/3-big.jpg"},
                {small: "files/4.jpg", preview: "files/4-big.jpg"},
                {small: "files/5.jpg", preview: "files/5-big.jpg"},
                {small: "files/2.jpg", preview: "files/2-big.jpg"}
            ];
            for(i = 0; i < 5; i++) {
                if (!data[i]) continue;
                a = $("<a />").attr("href", data[i].preview).on("click",clf);
                a.css("display", "none");
                img = $("<img />").attr("src", data[i].small);
                a.append(img);
                $(".catalog-seria .area1 .img-container .jspPane").append(a);
                a.fadeIn(300);
            }
            el.fadeOut(300, function(){

            });
            catalogSeria();
            }, 300);

        return false;

        }, function(){
            clearTimeout(t);
            f = false;        */

            $(this).siblings("a:hidden").fadeIn();
    });


    var t1, f1 = false;
    $(".catalog-seria .area4 .more").hover(function(){

        /*
        var a, img, data, span, span1, el = $(this);

        if (f1) return false;
        f1 = true;

        t1 = setTimeout(function(){
            data = [
                {img: "files/color_04.png", name: "Р”СѓР± СЃРѕСЃС‚Р°СЂРµРЅРЅС‹Р№"},
                {img: "files/color_02.png", name: "РњРѕРєРєРѕ Рё Р”Р¶Р°СЂР° Р“РѕСЃС„РѕСЂС‚"},
                {img: "files/color_05.png", name: "РћСЂРµС… Р’РёСЂРґР¶РёРЅРёСЏ"},
                {img: "files/color_01.png", name: "Р”СѓР± Р’РµСЂС†Р°СЃРєР° РљР°СЂР°РјРµР»СЊ"},
                {img: "files/color_04.png", name: "Р”СѓР± СЃРѕСЃС‚Р°СЂРµРЅРЅС‹Р№"}
            ];
            for(i = 0; i < 5; i++) {
                if (!data[i]) continue;
                a = $("<a />").attr("href", data[i].img).attr("class", "fancy");
                img = $("<img />").attr("src", data[i].img);
                span = $("<span />");
                a.append(span);
                span1 = $("<span />");
                span.append(span1);
                span1.append(img);
                a.append(data[i].name);
                $(".catalog-seria .area4 .img-container .jspPane").append(a);
            }

            });
            catalogSeria();
            }, 300);

        return false;
        }, function(){
            clearTimeout(t1);
            f1 = false;     */
    });




    /************************************/
    //СЃС‚СЂР°РЅРёС†Р° catalog-table.html
    $(".catalog_wrapper_top_link").click(function () {
        var href = $(this).attr("href");
        $('html, body').animate({
            scrollTop: 0
            }, 500);
        return false;
    });
    $(".catalog_top").append($(".catalog-table"));

    var data = [], sortF = function (i, ii) {
        if (i["title"] > ii["title"])
            return 1;
        else if (i["title"] < ii["title"])
            return -1;
            else
                return 0;
    };
    var table = $("#catalog_wrapper_table"), i = 0;
    data = [];
    table.find("tr").each(function () {
        data[i] = {title: $(this).find(".title").text()};
        i++;
    });
    var substrTitle = function () {
        i = 0;
        table.find("tr").each(function () {
            var elT = $(this).find(".title"), title = data[i].title || $(this).text(),
            j, h, newH, line = 0, lineArr = [], k = 0;
            //РѕР±СЂРµР·РєР° СЃС‚СЂРѕРєРё (РµСЃР»Рё СЃС‚СЂРѕРє Р±РѕР»СЊС€Рµ 2С…)
            if (!title) return;
            elT.html("");
            h = 0;

            lineArr[0] = title;
            var words = title.split(' ');

            for (j = 0; j <= words.length; j = j + 1) {
                lineArr[line] = elT.text();
                elT.append(words[j] + " ");
                newH = elT.height();
                if (newH > h && j > 1) {
                    if (line == 1) {
                        lineArr[line] += "...";
                    }
                    line++;
                    elT.html("");
                    j--;
                }
                h = newH;
            }
            elT.html("");
            for (j = 0; j < 2; j++) {
                if (lineArr[j])
                    elT.append("<span>" + lineArr[j] + "</span>");
            }
            data[i].html = $(this).html();
            i++;

        });
    };
    substrTitle();
    $(window).resize(function(){
        substrTitle();
    });
    //СЃРѕСЂС‚РёСЂРѕРІРєР° РІ С‚Р°Р±Р»РёС†Рµ
    $(".sort-name-link").click(function () {
        var el = $(this);
        if (el.hasClass("desc")) {
            el.removeClass("desc");
            data.reverse(sortF);
        } else {
            el.addClass("desc");
            data.sort(sortF);
        }
        $("#catalog_wrapper_table").html("");
        for (i = 0; i < data.length; i++) {
            table.append("<tr>" + data[i]["html"] + "</tr>");
        }
        return false;

    });
    /*******************************/


    /*$('.catalog_wrapper__item__image').each(function (index, el) {
        var backgroundImg = $(this).find('.main_bg').attr('src');
        if (backgroundImg) {
            $(this).css({'background-image': 'url(' + backgroundImg + ')'});
        }
    });*/

    $('.color_slider .fancy').on('click', function (event) {
        $(this).attr('href', $(this).find('img').attr('src'));
    });


    sliderMode = getSliderMode();

    // РїРѕРґРєР»СЋС‡РµРЅРёРµ СЃР»Р°Р№РґРµСЂРѕРІ
    $('.slider').flexslider({
        animation: 'fade',
        directionNav: false,
        slideshow: true,
        slideshowSpeed: 7000,
        animationSpeed: 1500
    });
    /*if($('.catalog_wrapper__item__image').width() <= 300){
      $('.catalog_wrapper__item__image img').css('width', '100%');
    }
    $(window).resize(function(){
        if($('.catalog_wrapper__item__image').width() <= 300){
          $('.catalog_wrapper__item__image img').css('width', '100%');
        }else{
          $('.catalog_wrapper__item__image img').css('width', 'auto');
        }
     });   */
    // HOVER
    $('.catalog_wrapper__item').hover(function (event) {
        var $_this = $(this);
        $_this.find('.color_slider_mask').css('z-index', '100');
        sliderCreate($_this);
        $_this.find('.catalog_wrapper__item__image__quickview_wrapper').fadeIn('200');
        }, function () {
            var $_this = $(this);
            sliderDestroy($_this);
            $_this.find('.catalog_wrapper__item__image__quickview_wrapper').fadeOut('200');
    });

    // BUTTON click
    $('body').on('click', '.catalog_wrapper__item .btn_color:not(.close)', function (event) {
        var $_this = $(this).parents('.catalog_wrapper__item');
        sliderCreate($_this);
    });

    $('body').on('click', '.catalog_wrapper__item .btn_color.close', function (event) {
        var $_this = $(this).parents('.catalog_wrapper__item');
        sliderDestroy($_this);
    });

    /*
    $('.catalog_wrapper__item .color_slider li').hover(function() {
    $(this).find('img').attr('src','')
    }, function() {

    });
    */
    // РїРѕРґРєР»СЋС‡РµРЅРёРµ fancybox
    var animated = false, slider;
    $('.fancy').fancybox({
        autoCenter: true,
        fixed: true,
        padding: 0,
        margin: 40,
        beforeShow: function () {
            $(".fancybox-wrap").css("visibility", "hidden");
        },
        afterShow: function () {
            $(".fancybox-close").css("display","block");
            $(".fancybox-wrap").css("visibility", "visible");
        },
        afterClose : function(){
            $("#catalog-window").html("");
        }
    });
    // $('.fancy:first').click();
    $("body").on("click",".catalog-window-right .small-preview li",function () {
        //console.log("!!!!", animated);
        //if (animated) slider.stop();
        // if (!animated) {
        $(".catalog-window-right .small-preview li").removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $($(".catalog-window-right .flex-control-nav li")[index]).find("a").click();
        // }


    });
    // РјР°СЃРєР° РІРІРѕРґР° РґР»СЏ С‚РµР»РµС„РѕРЅР°
    $('.phone').mask("+7 (999) 999-99-99", {placeholder: "_"});

    // РїРѕРґРєР»СЋС‡РµРЅРёРµ РєР°СЃС‚РѕРјРЅС‹С… РёРЅРїСѓС‚РѕРІ
    $('.catalog_filter').fancyfields();

    // Р’Р°Р»РёРґР°С†РёСЏ С„РѕСЂРјС‹
    $('.allform').each(function () {  /*
        $(this).unbind('submit').on('submit', function (e) {
        var emailPattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
        var isValid = true;
        $(this).find('.req').each(function () {
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
        */});


    var heightTile = $('.one .tile_wrapper__item:nth-child(2)').height() - 1;

    $('.one .tile_wrapper__item:nth-child(1), .one .tile_wrapper__item:nth-child(4)').css('height', heightTile);
    $('.two .tile_wrapper__item:nth-child(1), .two .tile_wrapper__item:nth-child(4)').css('height', heightTile);

    $('.color_slider .slides li').hover(function (event) {
        var currentZindex = $(this).attr('z-index');
        //$(this).css('z-index','101');
        }, function () {
            //$(this).css('z-index','currentZindex')
    });

    /***************expro_catalog_tovar_verstka***********************/
    $(".item_info__parametrs_more-close").click(function(){
        var el = $(this), more = el.parents(".catalog_wrapper__item__info").find(".item_info__parametrs_more");
        more.animate({"margin-top": 202},300);
        setTimeout(function(){
            $(".item_info__parametrs_more-colors, .item_info__parametrs_more-table").hide();
            /* setTimeout(function(){*/
            more.hide();
            $(".item_info__parametrs__item .plus").show();
            el.parents(".catalog_wrapper__item__info").find(".item_info__title").fadeIn(200);
            el.parents(".catalog_wrapper__item__info").find(".item_info__parametrs").show();
            /*}, 50);*/

            }, 300);


    });

    $(".item_info__parametrs__item .plus").click(function(){
        var el = $(this), c = el.parent().parent().parent(), cl = c.find(".item_info__parametrs_more-close");
        c.find(".item_info__parametrs_more").css("margin-top", 320).show();
        cl.hide().css({
            "margin": "-115px 2px 0 0"
        }).show();
        el.hide();

        c.find(".item_info__title, .item_info__parametrs").hide();
        /*setTimeout(function(){*/
        $(".item_info__parametrs_more-colors, .item_info__parametrs_more-table").show();
        c.find(".item_info__parametrs_more").css("margin-top", 180).show().animate({"margin-top": 0}, 300);
        cl.hide().css({"margin": "7px 15px 0 0"}).show();
        /*}, 200);*/



    });


    /*******************************/


});

$(window).resize(function () {

    page404();

    var documentWidth = $(document).width();

    sliderMode = getSliderMode();

    var heightTile = $('.one .tile_wrapper__item:nth-child(2)').height() - 1;

    $('.slider').css('max-height', $('.slider li img').height());

    $('.tile_wrapper.one').css('margin-top', '0');

    $('.one .tile_wrapper__item:nth-child(1), .one .tile_wrapper__item:nth-child(4)').css('height', heightTile);
    $('.two .tile_wrapper__item:nth-child(1), .two .tile_wrapper__item:nth-child(4)').css('height', heightTile);


    setFooterMargins();


    /************************************/
    //СЃС‚СЂР°РЅРёС†Р° catalog-seria.html
    catalogSeria();




});

function catalogSeria(){

    var documentHeight = $(".catalog-seria .preview").width()*0.88, documentWidth =  $(".catalog-seria").width()-180;
    if (documentHeight <= 0) return;
    //$(".catalog-seria").css("height", documentHeight);


    /*var el = $(".catalog-seria .preview"), el1 = $(".catalog-seria .preview img"), w = (el1.width()- el1.width()) /2;
    if (w < 0) w = 0;
    el1.css("margin-left", w);*/
    /*$(".catalog-seria .area2, .catalog-seria .area3, .catalog-seria .area4, .catalog-seria .area3 .area3-container, " +
    ".catalog-seria .area2 .area2-container, .catalog-seria .area4 .area4-container").css("height", "auto");*/

    var itemH = (documentHeight+20)/5 - 23;
    $(".catalog-seria .area1").css("width", itemH);
    $(".catalog-seria .area1 .img-container").css("height", documentHeight +3);
    $(".catalog-seria .area1 .img-container a").css({width: itemH-1, height: itemH, "line-height": itemH+"px"});

    $(".catalog-seria .area-container").css("width", $(".catalog-seria").width() - $(".catalog-seria .preview").width() - $(".catalog-seria .area1").width() - 120);


    var h = Math.floor((documentHeight/2 - 65) / 50);
    if (h < 2) h = 2;
    if (h > 5) h = 5;

    //$(" .catalog-seria .area4 .img-container").css("height", (h)*50);
    h = h*50+65;
    $(".catalog-seria .area3").css("width",  $(".catalog-seria .area-container").width()-270);
    var h1 = $(".catalog-seria .area3 table").height() + 60;
    if (h1 > documentHeight*2/3 && h1 > h) {
        h1 = h;
        //$(".catalog-seria .area3").css("height",  h);
        var h2 = 0;
        $(".catalog-seria .area3 tr").each(function(){
            var oldH1 = h2;
            if (h2 < (h-58)) { h2 += $(this).height(); }
            if (h2 > (h-58)) { h2= oldH1; return; }
        });
        //$(".catalog-seria .area3 .area3-container").css("height",  h2);
    } else {
        //$(".catalog-seria .area3 .area3-container").css("height",  $(".catalog-seria .area3 table").height());
    }
    //$(".catalog-seria .area4").css("height",  h);
    /* if (documentHeight > 400)
    $(".catalog-seria .area2").css("height",  documentHeight - h1 -48 - 38);
    else */
    //$(".catalog-seria .area2").css("height",  documentHeight - h1 -48 );
    /*$(".catalog-seria .area2 .area2-container").css("height", $(".catalog-seria .area2").height()-132);*/


    //$(".catalog-seria .area-container").css("height", documentHeight);
    $(".catalog-seria").css("visibility", "visible");


}

$(window).load(function () {

    var heightTile = $('.one .tile_wrapper__item:nth-child(2)').height() - 1;

    $('.one .tile_wrapper__item:nth-child(1), .one .tile_wrapper__item:nth-child(4)').css('height', heightTile);
    $('.two .tile_wrapper__item:nth-child(1), .two .tile_wrapper__item:nth-child(4)').css('height', heightTile);

    setFooterMargins();
});

$(window).scroll(function () {
    var heightScrollTop = $('html,body').scrollTop();
    if ((navigator.sayswho == 'IE 11') || (navigator.sayswho == 'IE 10') || (navigator.sayswho == 'MSIE') || (navigator.sayswho == 'IE') || (navigator.sayswho == 'Firefox')) {
        var heightScrollTop = $('html,body').scrollTop();
    } else {
        var heightScrollTop = $('body').scrollTop();
    }
    if ($(".catalog_top").length == 0 ) return;
    if ($(".catalog_top")[0].offsetTop > 0)
        scrollTop = $(".catalog_top")[0].offsetTop;

    if (heightScrollTop > scrollTop) {
        $('.wrapper:first').addClass('scrolling').css("padding-top", $(".catalog_top")[0].offsetHeight);

    } else {
        $('.wrapper:first').css("padding-top", 0).removeClass('scrolling');
    }

    var l = 0, w = $(window).width();
    if (w - 1280 > 0) l = 0; else l = $(window).scrollLeft();
    if (w - 1920 > 0) l = (1920 - w ) / 2;
    $(".scrolling .catalog_top_wrapper").css("left", -l);
});

function page404(){
    var h = $(window).height();
    $(".page404").css("height", h);
}