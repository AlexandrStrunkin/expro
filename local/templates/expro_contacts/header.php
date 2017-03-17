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

</head>
<body>


<div id="panel"><?$APPLICATION->ShowPanel();?></div>        

<div class="wrapper">   

<?include($_SERVER["DOCUMENT_ROOT"]."/include/header.php")?>

<div class="catalog_top_wrapper">
     <div class="catalog_top" style="padding-bottom: 0 !important;">

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

        <?$APPLICATION->IncludeComponent("bitrix:menu", "head_submenu", Array( 
                "ROOT_MENU_TYPE" => "footer_contacts",    // Тип меню для первого уровня
                "MENU_CACHE_TYPE" => "Y",    // Тип кеширования
                "MENU_CACHE_TIME" => "36000000",    // Время кеширования (сек.)
                "MENU_CACHE_USE_GROUPS" => "N",    // Учитывать права доступа
                "MENU_CACHE_GET_VARS" => "",    // Значимые переменные запроса
                "MAX_LEVEL" => "1",    // Уровень вложенности меню
                "USE_EXT" => "N",    // Подключать файлы с именами вида .тип_меню.menu_ext.php
                "ALLOW_MULTI_SELECT" => "N",    // Разрешить несколько активных пунктов одновременно
                ),
                false
            );?>
            <div class="clearboth"></div>
    </div> 
</div>  