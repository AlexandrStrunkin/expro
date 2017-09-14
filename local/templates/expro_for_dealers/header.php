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
            <a class="table-view changeView" href="?set_catalog_view=blocks" title="���������� �������" style="display: none;"></a>
            <?} else if ($_SESSION["CATALOG_VIEW"] == "blocks"){?>
            <a class="table-view1 changeView" href="?set_catalog_view=table" title="���������� ��������" style="display: none;"></a> 
            <?}?>

        <h1 class="main_title"><?$APPLICATION->ShowTitle()?></h1>

        <div class="catalog_filter">

            <?if ($APPLICATION->GetCurDir() != "/catalog/") {?>

                <?$APPLICATION->ShowViewContent('catalogFilter'); // ������� ��������� � ������� ������ �������� /bitrix/catalog/exproCatalog/bitrix/catalog.section.list/.default/template.php � ����� � �������� ���������� bitrix:catalog.section - table � blocks?>

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


                                
<div class="dialer projects">   

    <?$APPLICATION->IncludeComponent("bitrix:news.list", "solutions", Array(
            "COMPONENT_TEMPLATE" => ".default",
            "IBLOCK_TYPE" => "content",	// ��� ��������������� ����� (������������ ������ ��� ��������)
            "IBLOCK_ID" => "15",	// ��� ��������������� �����
            "NEWS_COUNT" => "20",	// ���������� �������� �� ��������
            "SORT_BY1" => "SORT",	// ���� ��� ������ ���������� ��������
            "SORT_ORDER1" => "ASC",	// ����������� ��� ������ ���������� ��������
            "SORT_BY2" => "SORT",	// ���� ��� ������ ���������� ��������
            "SORT_ORDER2" => "ASC",	// ����������� ��� ������ ���������� ��������
            "FILTER_NAME" => "",	// ������
            "FIELD_CODE" => array(	// ����
                0 => "",
                1 => "",
            ),
            "PROPERTY_CODE" => array(	// ��������
                0 => "",
                1 => "",
            ),
            "CHECK_DATES" => "Y",	// ���������� ������ �������� �� ������ ������ ��������
            "DETAIL_URL" => "",	// URL �������� ���������� ��������� (�� ��������� - �� �������� ���������)
            "AJAX_MODE" => "N",	// �������� ����� AJAX
            "AJAX_OPTION_JUMP" => "N",	// �������� ��������� � ������ ����������
            "AJAX_OPTION_STYLE" => "Y",	// �������� ��������� ������
            "AJAX_OPTION_HISTORY" => "N",	// �������� �������� ��������� ��������
            "AJAX_OPTION_ADDITIONAL" => "",	// �������������� �������������
            "CACHE_TYPE" => "A",	// ��� �����������
            "CACHE_TIME" => "36000000",	// ����� ����������� (���.)
            "CACHE_FILTER" => "N",	// ���������� ��� ������������� �������
            "CACHE_GROUPS" => "N",	// ��������� ����� �������
            "PREVIEW_TRUNCATE_LEN" => "",	// ������������ ����� ������ ��� ������ (������ ��� ���� �����)
            "ACTIVE_DATE_FORMAT" => "d.m.Y",	// ������ ������ ����
            "SET_TITLE" => "N",	// ������������� ��������� ��������
            "SET_BROWSER_TITLE" => "N",	// ������������� ��������� ���� ��������
            "SET_META_KEYWORDS" => "N",	// ������������� �������� ����� ��������
            "SET_META_DESCRIPTION" => "N",	// ������������� �������� ��������
            "SET_STATUS_404" => "N",	// ������������� ������ 404, ���� �� ������� ������� ��� ������
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// �������� �������� � ������� ���������
            "ADD_SECTIONS_CHAIN" => "N",	// �������� ������ � ������� ���������
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",	// �������� ������, ���� ��� ���������� ��������
            "PARENT_SECTION" => "",	// ID �������
            "PARENT_SECTION_CODE" => "",	// ��� �������
            "INCLUDE_SUBSECTIONS" => "Y",	// ���������� �������� ����������� �������
            "DISPLAY_DATE" => "Y",	// �������� ���� ��������
            "DISPLAY_NAME" => "Y",	// �������� �������� ��������
            "DISPLAY_PICTURE" => "Y",	// �������� ����������� ��� ������
            "DISPLAY_PREVIEW_TEXT" => "Y",	// �������� ����� ������
            "PAGER_TEMPLATE" => ".default",	// ������ ������������ ���������
            "DISPLAY_TOP_PAGER" => "N",	// �������� ��� �������
            "DISPLAY_BOTTOM_PAGER" => "Y",	// �������� ��� �������
            "PAGER_TITLE" => "������������ �������",	// �������� ���������
            "PAGER_SHOW_ALWAYS" => "N",	// �������� ������
            "PAGER_DESC_NUMBERING" => "N",	// ������������ �������� ���������
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// ����� ����������� ������� ��� �������� ���������
            "PAGER_SHOW_ALL" => "N",	// ���������� ������ "���"
            ),
            false
        );?>
    <!--END advantages-->
   


            
