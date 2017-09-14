<?
    include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

    CHTTP::SetStatus("404 Not Found");
    @define("ERROR_404","Y");
?>

<?/*require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

    $APPLICATION->SetTitle("Страница не найдена");

    $APPLICATION->IncludeComponent("bitrix:main.map", ".default", array(
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "36000000",
    "SET_TITLE" => "Y",
    "LEVEL"    =>    "3",
    "COL_NUM"    =>    "2",
    "SHOW_DESCRIPTION" => "Y"
    ),
    false
    );

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");*/?>
<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
    <!-- head -->
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Expro Grade</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <meta name="format-detection" content="telephone=no">


        <?include($_SERVER["DOCUMENT_ROOT"]."/include/headerStrings.php")?>
    </head>
    <!-- end head -->

    <body>
        <div class="wrapper">
            <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
            your browser</a> to improve your experience.</p>
            <![endif]-->
                   
            <div class="page404">
                <div class="logotype">
                    <a href="/"><img src="/img/expro_grade_logo.jpg"></a>
                </div>
                <div class="center">
                    <img src="/img/404.png" alt="" />
                    <p>Запрашиваемая страница <span>не найдена</span></p>
                </div>

                <a href="/" class="link">вернуться назад</a>
            </div>



        </div>


        <?include($_SERVER["DOCUMENT_ROOT"]."/include/footerStrings.php")?>
    </body>
</html>