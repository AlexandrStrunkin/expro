<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
    IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/".SITE_TEMPLATE_ID."/header.php");
    $wizTemplateId = COption::GetOptionString("main", "wizard_template_id", "eshop_adapt_horizontal", SITE_ID);
    CUtil::InitJSCore();
    CJSCore::Init(array("fx"));
    $curPage = $APPLICATION->GetCurPage(true);

	if($_SERVER["HTTP_HOST"] ==  "expro-mebel.ru"){
		$directory = $APPLICATION->GetCurDir();
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>" class="no-js">
<head>
	<?if($directory){?><link rel="canonical" href="http://expro-mebel.ru<?=$directory?>" />
    <?}?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">
    <link rel="shortcut icon" type="image/x-icon" href="<?=SITE_DIR?>favicon.ico" />
    <?//$APPLICATION->ShowHead();
        echo '<meta http-equiv="Content-Type" content="text/html; charset='.LANG_CHARSET.'"'.(true ? ' /':'').'>'."\n";
        $APPLICATION->ShowMeta("robots", false, true);
        $APPLICATION->ShowMeta("keywords", false, true);
        $APPLICATION->ShowMeta("description", false, true);
        $APPLICATION->ShowCSS(true, true);
    ?>
    <link rel="stylesheet" type="text/css" href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/colors.css")?>" />
    <?
        $APPLICATION->ShowHeadStrings();
        $APPLICATION->ShowHeadScripts();
        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/script.js");
    ?>
    <title><?$APPLICATION->ShowTitle()?></title>

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    <meta name="format-detection" content="telephone=no">
    
    
    <?include($_SERVER["DOCUMENT_ROOT"]."/include/headerStrings.php")?>
    <meta name="google-site-verification" content="3oXRHY4SGpxUgg5ge8XqeiqOwfLvPNtWUhTeVTnAmPw" />
</head>
<body>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-59914285-1', 'auto');
  ga('send', 'pageview');

</script>
<div id="panel"><?$APPLICATION->ShowPanel();?></div>



<div class="wrapper"> 

<?include($_SERVER["DOCUMENT_ROOT"]."/include/header.php")?>  
      

<?$APPLICATION->IncludeComponent("bitrix:news.list", "main_banner", Array(
        "IBLOCK_TYPE" => "content",	// Тип информационного блока (используется только для проверки)
        "IBLOCK_ID" => "4",	// Код информационного блока
        "NEWS_COUNT" => "5",	// Количество новостей на странице
        "SORT_BY1" => "ID",	// Поле для первой сортировки новостей
        "SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
        "SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
        "SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
        "FILTER_NAME" => "",	// Фильтр
        "FIELD_CODE" => array(	// Поля
            0 => "NAME",
            1 => "DETAIL_TEXT",
            2 => "DETAIL_PICTURE",
            3 => "",
        ),
        "PROPERTY_CODE" => array(	// Свойства
            0 => "",
            1 => "",
        ),
        "CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
        "DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
        "AJAX_MODE" => "N",	// Включить режим AJAX
        "AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
        "AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
        "AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
        "CACHE_TYPE" => "A",	// Тип кеширования
        "CACHE_TIME" => "36000000",	// Время кеширования (сек.)
        "CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
        "CACHE_GROUPS" => "N",	// Учитывать права доступа
        "PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
        "ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
        "SET_TITLE" => "N",	// Устанавливать заголовок страницы
        "SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
        "SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
        "SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
        "SET_STATUS_404" => "N",	// Устанавливать статус 404, если не найдены элемент или раздел
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
        "ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
        "PARENT_SECTION" => "",	// ID раздела
        "PARENT_SECTION_CODE" => "",	// Код раздела
        "INCLUDE_SUBSECTIONS" => "N",	// Показывать элементы подразделов раздела
        "DISPLAY_DATE" => "N",	// Выводить дату элемента
        "DISPLAY_NAME" => "N",	// Выводить название элемента
        "DISPLAY_PICTURE" => "N",	// Выводить изображение для анонса
        "DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
        "PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
        "DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
        "DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
        "PAGER_TITLE" => "Новости",	// Название категорий
        "PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
        "PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
        "PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
        "AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
        ),
        false
    );?>

<div class="tile_wrapper one">

    <div class="tile_wrapper__item">
        <div class="tile_wrapper__item__wrapper_for_text">
            <span>
                <?$APPLICATION->IncludeFile(SITE_DIR."include/main_block1_text1.php",Array(), Array("MODE"=>"html"));?>                  
            </span>
            <span class="tile_wrapper__item__dop">
                <?$APPLICATION->IncludeFile(SITE_DIR."include/main_block1_text2.php",Array(), Array("MODE"=>"html"));?>                  
            </span>
        </div>
    </div>

    <div class="tile_wrapper__item">
        <?$APPLICATION->IncludeFile(SITE_DIR."include/main_block2_img.php",Array(), Array("MODE"=>"html"));?>         
    </div>

    <div class="tile_wrapper__item">
        <?$APPLICATION->IncludeFile(SITE_DIR."include/main_block3_img.php",Array(), Array("MODE"=>"html"));?>
    </div>

    <div class="tile_wrapper__item">
        <div class="tile_wrapper__item__wrapper_for_text">
            <span>
                <?$APPLICATION->IncludeFile(SITE_DIR."include/main_block4_text.php",Array(), Array("MODE"=>"html"));?>  
            </span>
        </div>
    </div>
</div>

<div class="garant">
    <div class="garant_text">
        <?$APPLICATION->IncludeFile(SITE_DIR."include/slogan.php",Array(), Array("MODE"=>"html"));?>          
    </div>

    <div class="carant_title">
        <?$APPLICATION->IncludeFile(SITE_DIR."include/warranty_text.php",Array(), Array("MODE"=>"html"));?>
    </div>

    <?$APPLICATION->IncludeFile(SITE_DIR."include/warranty_img.php",Array(), Array("MODE"=>"html"));?>                                                               



</div>

<div class="tile_wrapper two">
    <div class="tile_wrapper__item hidden_block">
        <div class="tile_wrapper__item__wrapper_for_text">
            <span>
                <?$APPLICATION->IncludeFile(SITE_DIR."include/main_block5_text1.php",Array(), Array("MODE"=>"html"));?>  
            </span>
            <span class="tile_wrapper__item__dop">                     
                <?$APPLICATION->IncludeFile(SITE_DIR."include/main_block5_text2.php",Array(), Array("MODE"=>"html"));?>
            </span>
        </div>        
    </div>

    <div class="tile_wrapper__item hidden_block">
        <?$APPLICATION->IncludeFile(SITE_DIR."include/main_block6_img.php",Array(), Array("MODE"=>"html"));?>
    </div>

    <div class="tile_wrapper__item">
        <?$APPLICATION->IncludeFile(SITE_DIR."include/main_block7_img.php",Array(), Array("MODE"=>"html"));?>             
    </div>

    <div class="tile_wrapper__item">
        <div class="tile_wrapper__item__wrapper_for_text">
            <span>
                <?$APPLICATION->IncludeFile(SITE_DIR."include/main_block8_text.php",Array(), Array("MODE"=>"html"));?> 
            </span>
        </div>
    </div>
</div>
