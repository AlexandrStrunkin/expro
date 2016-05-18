<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
    IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/".SITE_TEMPLATE_ID."/header.php");
    $wizTemplateId = COption::GetOptionString("main", "wizard_template_id", "eshop_adapt_horizontal", SITE_ID);
    CUtil::InitJSCore();
    CJSCore::Init(array("fx"));
    $curPage = $APPLICATION->GetCurPage(true);
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>" class="no-js">
<head>
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
    <div class="catalog_top">

        <?$APPLICATION->IncludeComponent("bitrix:breadcrumb","breadcrumb",array())?>             

        <? 
            if (!$_SESSION["CATALOG_VIEW"]) {
                $_SESSION["CATALOG_VIEW"] = "blocks";
            }          

            if ($_SESSION["CATALOG_VIEW"] == "table"){
            ?>
            <a class="table-view changeView" href="javascript:void(0)" onclick="setCatalogView('blocks')" title="���������� �������" style="display: none;"></a>
            <?} else if ($_SESSION["CATALOG_VIEW"] == "blocks"){?>
            <a class="table-view1 changeView" href="javascript:void(0)" onclick="setCatalogView('table')" title="���������� ��������" style="display: none;"></a> 
            <?}?>



        <h1 class="main_title"> 
            <?
                if (stripos($APPLICATION->GetCurPageParam(), "/catalog/")===false) {   
                    $APPLICATION->ShowTitle();
                } else {
                    $APPLICATION->ShowViewContent('elementH1'); 
                } 
            ?>
        </h1>

        <div class="catalog_filter">

            <?if ($APPLICATION->GetCurDir() != "/catalog/") {?>

                <?$APPLICATION->ShowViewContent('catalogFilter'); // ������� ��������� � ������� ������ �������� /bitrix/catalog/exproCatalog/bitrix/catalog.section.list/.default/template.php � � ������� blocks ���������� bitrix:catalog.section?>

                <?}?>
            <?/*
                <div class="select_group">
                <select name="sortable">
                <option value="��� ������� ���������">��� ������� ���������</option>
                <option value="�� ������� � �������">�� ������� � �������</option>
                <option value="�� ������� � �������">�� ������� � �������</option>
                </select>
                </div>
            */?>

            <div class="clearboth"></div>
        </div>
    </div>
</div>