
//ajax фильтрация в каталоге при смене чекбоксов вверху каталога
function showCatalogSections() {
    $(".catalogSectionBox").parent(".ffCheckboxWrapper").on("click",function(){  
        filterItems();
    })
}

//фильтр элементов
function filterItems() {
    if ($(".catalogSectionBox:checked").length > 0) {
        $(".catalog_wrapper__item, .catalog_wrapper__item_table").each(function(){
            var id = $(this).attr("rel");
            if (!$("#par" + id).prop("checked")) {
                $(this).hide();
            }
            else if ($(this).css("display") == "none") {
                $(this).fadeIn();
            }
        })

        var i = 1;
        $(".catalog_wrapper__item:visible").each(function(){
            if (i%2 != 0) {
                $(this).css("margin-right","2.2%");
            }
            else {
                $(this).css("margin-right","0");
            }
            i++;
        })

    }
    else {
        $(".catalog_wrapper__item, .catalog_wrapper__item_table").fadeIn(); 
    }
}


//всплывающее окно с каталогом
function catalogPopupBlock() {
    $(".catalogPopupWrapper > ul > li > div > a").click(function(e){
        var display = $(this).parent().siblings("ul").css("display");
        if ($(this).parent().siblings("ul").length > 0) { 
            e.preventDefault();
            $(".catalogPopupWrapper > ul > li > ul").slideUp();
            $("a.realSectionHref").css("display","none");
            if (display != "block") {
                $(this).parent().siblings("ul").slideDown();
                $(this).parent().siblings("a.realSectionHref").toggle();
            }
        }                                                 
    })   
}


//вещаем обработку всех ссылок с адресом /catalog/
function catchCatalog() {
    $("a").on("click",function(e){
        //если ссылка на корень каталога, то вместо перехода показываем всплывающее окно каталога           
        if ($(this).attr("href") == "/catalog/") {
            e.preventDefault();
            $('.mainCatalogPopup').fadeIn()
        }

        //если ссылка на корень о компании, то вместо перехода показываем всплывающее окно о компании           
        if ($(this).attr("href") == "/about/") {
            e.preventDefault();
            $('.mainAboutPopup').fadeIn()
        }

        //если ссылка на корень о компании, то вместо перехода показываем всплывающее окно о компании           
        if ($(this).attr("href") == "/contacts/") {
            e.preventDefault();
            $('.mainContactsPopup').fadeIn()
        }
    })
}  


//подгрузка инфы о разделе в popup
function loadSection(ID) {

    $.post("/ajax/fastView.php",{ID:ID},function(data){ 
        $("#catalog-window").html(data);

        //реинициализация fancybox

        $(".login-popup-link").fancybox({padding: 0,
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

        ////

        sliderMode = getSliderMode();

        // подключение слайдеров
        $('.slider').flexslider({
            animation: 'fade',
            directionNav: false,
            slideshow: true,
            slideshowSpeed: 7000,
            animationSpeed: 1500
        });

        //$('.catalog-window-left-bg, .catalog-window-center-characters').jScrollPane({autoReinitialise: true});

        //  $.fancybox.resize;

        $(".fancybox-inner").css("height","723px");
        /*var h = $(".fancybox-inner").height();
        if (h < 500) h = 500;
        if (h > 723) h = 723;*/
        var h = 723;

        //высота
        var h1 = h - $(".catalog-window-center-top").height() - $(".catalog-window-center-bottom").height() - 53;
        var a = h1 / 39;

        $(".catalog-window-center-characters").css({
            height: Math.floor(a) * 39,
            "margin-bottom": h1 - Math.floor(a) * 39 + a - Math.floor(a)
        });
        $(".catalog-window-right-slider").css("height", h);
        $(".catalog-window-left-bg").css("height", h - 20);

        //прокрутка блоков
        $('.catalog-window-left-bg, .catalog-window-center-characters').jScrollPane({autoReinitialise: true});

        // подключение слайдера
        slider = $('.catalog-window-right-slider').flexslider({
            animation: 'fade',
            slideshow: false,
            animationSpeed: 200,
            before: function (e) {
                animated = true;
                // var index = $(".catalog-window-right .flex-active").parent().index();
                $(".catalog-window-right .small-preview li").removeClass("active");
                $($(".catalog-window-right .small-preview li")[e.animatingTo]).addClass("active");

            }, after: function () {
                animated = false;
            }
        });
        $(".catalog-window-left, .catalog-window-right, .catalog-window-center, .fancybox-close").css("visibility", "visible").fadeIn(10);
        $(".fancybox-wrap").css("visibility", "visible");


        var li = $(".small-preview li"), li1 = $(".catalog-window-right .flex-control-nav li"), l = li.length, curSlide = 4,
        next = $(".catalog-window-right .flex-direction-nav1 .flex-next"), prev = $(".catalog-window-right .flex-direction-nav1 .flex-prev");

        $(".catalog-window-right .flex-control-nav li").hide();
        for (var i = 0; i < 5; i++) {
            $(li[i]).show();
            $(li1[i]).show();
        }
        if (l <= (curSlide + 1)) {
            next.addClass("inactive");
        }

        next.click(function () {
            var i;


            if (l > curSlide + 1) {
                curSlide++;
                $(li[curSlide - 5]).hide();
                $(li1[curSlide - 5]).hide();
                $(li[curSlide]).fadeIn(500);
                $(li1[curSlide]).fadeIn(500);

            }
            next.removeClass("inactive");
            prev.removeClass("inactive");

            if (l <= (curSlide + 1)) {
                next.addClass("inactive");
            }
            if (curSlide <= 4) {
                prev.addClass("inactive");
            }
            return false;
        });
        prev.click(function () {
            var i;


            if (curSlide > 4) {
                curSlide--;
                $(li[curSlide + 1]).hide();
                $(li1[curSlide + 1]).hide();
                $(li[curSlide - 4]).fadeIn(500);
                $(li1[curSlide - 4]).fadeIn(500);

            }
            next.removeClass("inactive");
            prev.removeClass("inactive");

            if (l <= (curSlide + 1)) {
                next.addClass("inactive");
            }
            if (curSlide <= 4) {
                prev.addClass("inactive");
            }
            return false;
        });    

    })


}



//ajax подгрузка каталога
function loadCatalogAjax() {
    processing = false;
    $(document).scroll(function(){  
        if ($(document).scrollTop() > (parseInt($(".wrapper").outerHeight()) - parseInt($(".footer").outerHeight()) - 450) && processing == false && $("#catalog_wrapper_table").length > 0 && cur_page < $("#pageCount").val()) {
            processing = true;
            $(".loadingProcess").show();
            var navNum = $("#pageNavNum").val();  //номер постраничной навигации $_PAGEN_N  (N)
            cur_page = cur_page*1 + 1;    //глобальная переменная - номер текущей загружаемой страницы
            $("#tempData").load("?PAGEN_" + navNum + "=" + cur_page + " #catalog_wrapper_table > *", function(){
                var html = $("#tempData").html();
                $("#catalog_wrapper_table").append(html);
                $("#tempData").html("");
                filterItems();
                var loadedVisibleItems = 0;
                var loadedPage = "p" + cur_page;
                $(".catalog_wrapper__item:visible, .catalog_wrapper__item_table:visible").each(function(){
                    if ($(this).attr("data") == "p" + cur_page) {
                        loadedVisibleItems++;
                    }                        
                })
                if (loadedVisibleItems == 0) {
                    loadCatalogAjax(); 
                }
                else {   
                    $(".loadingProcess").hide()
                }
                processing = false;
                if (cur_page == $("#pageCount").val()) {
                    $(".loadingProcess").hide()
                    $(".catalog_wrapper_top_link").fadeIn();
                }

            });                 

        }
    })
}


//авторизация / регистрация

function personalFormSubmit(form) { 

    //отправка формы в обработчик
    function submitForm(form) {
        var formData = $("#" + form).serialize();    
        $.ajax({
            url: "/ajax/checkForm.php",
            type: "POST",
            data: formData,
            success: function(data){
                if (data == "OK") {
                    $(".form_error").hide(); 
                    $(".wrong_border").removeClass("wrong_border");
                    $(".form_success").show();
                    $("#" + form).find("input[type=text]").val("");
                    $("#" + form).find("textarea").val("");
                }
                else {
                    $("#" + form + " .form_error").show();  
                    $("#" + form + " .form_error").html(data);
                }
            },
        });
    }   


    $(".form_error, .form_success").hide();
    $(".wrong_border").removeClass("wrong_border");  

    //паттерн для валидации email
    var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i; 

    var res = true;

    //проверка заполнения всех полей
    $("#" + form + " .req:visible").each(function(){
        if ($(this).val() == "") {  
            $(this).addClass("wrong_border");                                                
            $("#" + form + " .form_error").show();  
            $("#" + form + " .form_error").html("Заполните все поля!");  
            res = false
        }             
    });

    if (res == false) {
        return false;      
    }

    switch(form) {
        case "authForm":  
            var email = $("#auth_email").val();
            var pass = $("#auth_password").val();

            $.post("/ajax/checkForm.php",{email:email,pass:pass,form:form},function(data){
                if (data == "OK") {
                    document.location.reload();
                }
                else {
                    $("#" + form + " .form_error").css("display","block").html("Неверный логин или пароль!");
                }                          
            })
            break;

        case "regForm":

        //валидация email
        var email;
        var emailInput;
        $("#" + form + " .form_error").html("");

        switch ($("#newDealer").val()) {
            case "Y": email = $("#" + form + " input[name=NEW_EMAIL]").val(); emailInput = $("#" + form + " input[name=NEW_EMAIL]");  break;
            case "N": email = $("#" + form + " input[name=EMAIL]").val(); emailInput = $("#" + form + " input[name=EMAIL]");  break; 
        }  

        console.log(email);
              
        if (!pattern.test(email)) {
            $("#" + form + " .form_error").show();  
            $("#" + form + " .form_error").html("Неверный email!"); 
            emailInput.addClass("wrong_border");
            return false;
        }    

        //отправляем на регистрацию
        else {

            submitForm(form);
            
        }

        break;


        //заказать проект
        case "orderProject" : 

            //проверка email
            var emailInput = $("#" + form + " input[name=EMAIL]");
            var email = $(emailInput).val();   
            if (!pattern.test(email)) {
                $("#" + form + " .form_error").show();  
                $("#" + form + " .form_error").html("Неверный email!"); 
                emailInput.addClass("wrong_border");
                return false;
            }         

            //отправка формы
            submitForm(form); 

            break;


        //заказать звонок
        case "orderCall": 

            submitForm(form);

            break;

        case "getOptPrice":

            //проверка email
            var emailInput = $("#" + form + " input[name=EMAIL]");
            var email = $(emailInput).val();   
            if (!pattern.test(email)) {
                $("#" + form + " .form_error").show();  
                $("#" + form + " .form_error").html("Неверный email!"); 
                emailInput.addClass("wrong_border");
                return false;
            }       

            submitForm(form);

            break;

        case "feedBack":

            //проверка email
            var emailInput = $("#" + form + " input[name=CONTACT_EMAIL]");
            var email = $(emailInput).val();   
            if (!pattern.test(email)) {
                $("#" + form + " .form_error").show();  
                $("#" + form + " .form_error").html("Неверный email!"); 
                emailInput.addClass("wrong_border");
                return false;
            }       

            submitForm(form);

            break;    




    } 
}


//подстановка в форму "узнать оптовую цену" ID и названия товара
function setOptProduct(id, name) {
    if (parseInt(id) > 0 && name != "") {
        $("#optProductID").val(id);
        $("#get-opp-price input[name=PRODUCT]").val(name); 
    }
}


//показать/скрыть описание серии
function showHideDescription(){

    var height = $(".seriaDescription").css("height");       


    //скрываем ссылку "показать полностью", если описание слишком маленькое
    if (parseInt(height) < 200) {
        $("#showAllDesc").hide();
    }
    //показ/скрытие блока "особенности" для серий
    $("#showAllDesc").on("click",function(){
        var link = $(this);
        if ($(link).hasClass("closed")) {  
            $(".area2-container").animate({"height":height}, 500, function(){$(link).html("свернуть");});
            $(link).removeClass("closed");

        }
        else {
            console.log(200);
            $(link).addClass("closed");
            $(".area2-container").animate({"height":"200px"}, 500, function(){$(link).html("показать полностью");});

        }
    })
}

//установка отображения каталога (таблицей/блоками)
function setCatalogView(view) {
    $.post("/ajax/setCatalogView.php",{set_catalog_view:view},function(data){
        if(data=="OK"){
            document.location.reload();
        }
    })
}



$(function(){
    //все функции описаны выше 
    showCatalogSections();

    catalogPopupBlock();

    catchCatalog();   

    cur_page = 1; //параметр для ajax-подгрузки каталога
    loadCatalogAjax();

    showHideDescription();  
}) 