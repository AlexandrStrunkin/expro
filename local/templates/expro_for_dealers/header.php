<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
    IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/".SITE_TEMPLATE_ID."/header.php");
    $wizTemplateId = COption::GetOptionString("main", "wizard_template_id", "eshop_adapt_horizontal", SITE_ID);
    CUtil::InitJSCore();
    CJSCore::Init(array("fx"));
    $curPage = $APPLICATION->GetCurPage(true);

	if($_SERVER["HTTP_HOST"] ==  "expro.ru"){
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
    <link rel="stylesheet" type="text/css" href="<?=CUtil::GetAdditionalFileURL(SITE_TEMPLATE_PATH."/jquery.jscrollpane.css")?>" />
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
<script charset="UTF-8" src="//cdn.sendpulse.com/28edd3380a1c17cf65b137fe96516659/js/push/5561ee5475d7c57266def73279791f2b_1.js" async></script>

</head>
<body>


<div id="panel"><?$APPLICATION->ShowPanel();?></div>          

<div class="wrapper">             

<?include($_SERVER["DOCUMENT_ROOT"]."/include/header.php")?>

<div class="catalog_top_wrapper">
    <div class="catalog_top">

        <?$APPLICATION->IncludeComponent("bitrix:breadcrumb","breadcrumb",array())?>
        <?
            if (!$_SESSION["CATALOG_VIEW"]) {
                $_SESSION["CATALOG_VIEW"] = "blocks";
            }

            if ($_REQUEST["set_catalog_view"] == "table" || $_REQUEST["set_catalog_view"] == "blocks") {
                $_SESSION["CATALOG_VIEW"] = $_REQUEST["set_catalog_view"];
                header("location: ".$APPLICATION->GetCurPage());
            }
        ?>
        <?
            if ($_SESSION["CATALOG_VIEW"] == "table"){
            ?>
            <a class="table-view changeView" href="?set_catalog_view=blocks" title="отображать плиткой" style="display: none;"></a>
            <?} else if ($_SESSION["CATALOG_VIEW"] == "blocks"){?>
            <a class="table-view1 changeView" href="?set_catalog_view=table" title="отображать таблицей" style="display: none;"></a> 
            <?}?>

        <h1 class="main_title"><?$APPLICATION->ShowTitle()?></h1>

        <div class="catalog_filter">

            <?if ($APPLICATION->GetCurDir() != "/catalog/") {?>

                <?$APPLICATION->ShowViewContent('catalogFilter'); // контент находится в шаблоне списка разделов /bitrix/catalog/exproCatalog/bitrix/catalog.section.list/.default/template.php а также в шаблонах компонента bitrix:catalog.section - table и blocks?>

                <?}?>

            <?/*
                <div class="select_group">
                <select name="sortable">
                <option value="все ценовые категории">Все ценовые категории</option>
                <option value="от дешевых к дорогим">От дешевых к дорогим</option>
                <option value="от дорогих к дешевым">От дорогих к дешевым</option>
                </select>
                </div>
            */?>
            <div class="clearboth"></div>
        </div>
    </div>
</div>


                                
<div class="dialer projects">   

    <?$APPLICATION->IncludeComponent("bitrix:news.list", "solutions", Array(
            "COMPONENT_TEMPLATE" => ".default",
            "IBLOCK_TYPE" => "content",	// Тип информационного блока (используется только для проверки)
            "IBLOCK_ID" => "15",	// Код информационного блока
            "NEWS_COUNT" => "20",	// Количество новостей на странице
            "SORT_BY1" => "SORT",	// Поле для первой сортировки новостей
            "SORT_ORDER1" => "ASC",	// Направление для первой сортировки новостей
            "SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
            "SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
            "FILTER_NAME" => "",	// Фильтр
            "FIELD_CODE" => array(	// Поля
                0 => "",
                1 => "",
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
            "AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
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
            "INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
            "DISPLAY_DATE" => "Y",	// Выводить дату элемента
            "DISPLAY_NAME" => "Y",	// Выводить название элемента
            "DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса
            "DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
            "PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
            "DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
            "DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
            "PAGER_TITLE" => "Преимущества дилеров",	// Название категорий
            "PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
            "PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
            "PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
            ),
            false
        );?>
    <!--END advantages-->
   


            
