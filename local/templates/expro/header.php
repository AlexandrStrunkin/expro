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
        "IBLOCK_TYPE" => "content",	// ��� ��������������� ����� (������������ ������ ��� ��������)
        "IBLOCK_ID" => "4",	// ��� ��������������� �����
        "NEWS_COUNT" => "5",	// ���������� �������� �� ��������
        "SORT_BY1" => "ID",	// ���� ��� ������ ���������� ��������
        "SORT_ORDER1" => "DESC",	// ����������� ��� ������ ���������� ��������
        "SORT_BY2" => "SORT",	// ���� ��� ������ ���������� ��������
        "SORT_ORDER2" => "ASC",	// ����������� ��� ������ ���������� ��������
        "FILTER_NAME" => "",	// ������
        "FIELD_CODE" => array(	// ����
            0 => "NAME",
            1 => "DETAIL_TEXT",
            2 => "DETAIL_PICTURE",
            3 => "",
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
        "INCLUDE_SUBSECTIONS" => "N",	// ���������� �������� ����������� �������
        "DISPLAY_DATE" => "N",	// �������� ���� ��������
        "DISPLAY_NAME" => "N",	// �������� �������� ��������
        "DISPLAY_PICTURE" => "N",	// �������� ����������� ��� ������
        "DISPLAY_PREVIEW_TEXT" => "Y",	// �������� ����� ������
        "PAGER_TEMPLATE" => ".default",	// ������ ������������ ���������
        "DISPLAY_TOP_PAGER" => "N",	// �������� ��� �������
        "DISPLAY_BOTTOM_PAGER" => "N",	// �������� ��� �������
        "PAGER_TITLE" => "�������",	// �������� ���������
        "PAGER_SHOW_ALWAYS" => "N",	// �������� ������
        "PAGER_DESC_NUMBERING" => "N",	// ������������ �������� ���������
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// ����� ����������� ������� ��� �������� ���������
        "PAGER_SHOW_ALL" => "N",	// ���������� ������ "���"
        "AJAX_OPTION_ADDITIONAL" => "",	// �������������� �������������
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
