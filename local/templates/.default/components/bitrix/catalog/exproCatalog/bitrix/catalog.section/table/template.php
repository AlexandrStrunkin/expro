<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
    /** @var array $arParams */
    /** @var array $arResult */
    /** @global CMain $APPLICATION */
    /** @global CUser $USER */
    /** @global CDatabase $DB */
    /** @var CBitrixComponentTemplate $this */
    /** @var string $templateName */
    /** @var string $templateFile */
    /** @var string $templateFolder */
    /** @var string $componentPath */
    /** @var CBitrixComponent $component */
    $this->setFrameMode(true);

    if (!empty($arResult['ITEMS']))
    {
        $templateLibrary = array('popup');
        $currencyList = '';
        if (!empty($arResult['CURRENCIES']))
        {
            $templateLibrary[] = 'currency';
            $currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
        }
        $templateData = array(
            'TEMPLATE_THEME' => $this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css',
            'TEMPLATE_CLASS' => 'bx_'.$arParams['TEMPLATE_THEME'],
            'TEMPLATE_LIBRARY' => $templateLibrary,
            'CURRENCIES' => $currencyList
        );
        unset($currencyList, $templateLibrary);

        $arSkuTemplate = array();
        if (!empty($arResult['SKU_PROPS']))
        {
            foreach ($arResult['SKU_PROPS'] as &$arProp)
            {
                $templateRow = '';
                if ('TEXT' == $arProp['SHOW_MODE'])
                {
                    if (5 < $arProp['VALUES_COUNT'])
                    {
                        $strClass = 'bx_item_detail_size full';
                        $strWidth = ($arProp['VALUES_COUNT']*20).'%';
                        $strOneWidth = (100/$arProp['VALUES_COUNT']).'%';
                        $strSlideStyle = '';
                    }
                    else
                    {
                        $strClass = 'bx_item_detail_size';
                        $strWidth = '100%';
                        $strOneWidth = '20%';
                        $strSlideStyle = 'display: none;';
                    }
                    $templateRow .= '<div class="'.$strClass.'" id="#ITEM#_prop_'.$arProp['ID'].'_cont">'.
                    '<span class="bx_item_section_name_gray">'.htmlspecialcharsex($arProp['NAME']).'</span>'.
                    '<div class="bx_size_scroller_container"><div class="bx_size"><ul id="#ITEM#_prop_'.$arProp['ID'].'_list" style="width: '.$strWidth.';">';
                    foreach ($arProp['VALUES'] as $arOneValue)
                    {
                        $arOneValue['NAME'] = htmlspecialcharsbx($arOneValue['NAME']);
                        $templateRow .= '<li data-treevalue="'.$arProp['ID'].'_'.$arOneValue['ID'].'" data-onevalue="'.$arOneValue['ID'].'" style="width: '.$strOneWidth.';" title="'.$arOneValue['NAME'].'"><i></i><span class="cnt">'.$arOneValue['NAME'].'</span></li>';
                    }
                    $templateRow .= '</ul></div>'.
                    '<div class="bx_slide_left" id="#ITEM#_prop_'.$arProp['ID'].'_left" data-treevalue="'.$arProp['ID'].'" style="'.$strSlideStyle.'"></div>'.
                    '<div class="bx_slide_right" id="#ITEM#_prop_'.$arProp['ID'].'_right" data-treevalue="'.$arProp['ID'].'" style="'.$strSlideStyle.'"></div>'.
                    '</div></div>';
                }
                elseif ('PICT' == $arProp['SHOW_MODE'])
                {
                    if (5 < $arProp['VALUES_COUNT'])
                    {
                        $strClass = 'bx_item_detail_scu full';
                        $strWidth = ($arProp['VALUES_COUNT']*20).'%';
                        $strOneWidth = (100/$arProp['VALUES_COUNT']).'%';
                        $strSlideStyle = '';
                    }
                    else
                    {
                        $strClass = 'bx_item_detail_scu';
                        $strWidth = '100%';
                        $strOneWidth = '20%';
                        $strSlideStyle = 'display: none;';
                    }
                    $templateRow .= '<div class="'.$strClass.'" id="#ITEM#_prop_'.$arProp['ID'].'_cont">'.
                    '<span class="bx_item_section_name_gray">'.htmlspecialcharsex($arProp['NAME']).'</span>'.
                    '<div class="bx_scu_scroller_container"><div class="bx_scu"><ul id="#ITEM#_prop_'.$arProp['ID'].'_list" style="width: '.$strWidth.';">';
                    foreach ($arProp['VALUES'] as $arOneValue)
                    {
                        $arOneValue['NAME'] = htmlspecialcharsbx($arOneValue['NAME']);
                        $templateRow .= '<li data-treevalue="'.$arProp['ID'].'_'.$arOneValue['ID'].'" data-onevalue="'.$arOneValue['ID'].'" style="width: '.$strOneWidth.'; padding-top: '.$strOneWidth.';"><i title="'.$arOneValue['NAME'].'"></i>'.
                        '<span class="cnt"><span class="cnt_item" style="background-image:url(\''.$arOneValue['PICT']['SRC'].'\');" title="'.$arOneValue['NAME'].'"></span></span></li>';
                    }
                    $templateRow .= '</ul></div>'.
                    '<div class="bx_slide_left" id="#ITEM#_prop_'.$arProp['ID'].'_left" data-treevalue="'.$arProp['ID'].'" style="'.$strSlideStyle.'"></div>'.
                    '<div class="bx_slide_right" id="#ITEM#_prop_'.$arProp['ID'].'_right" data-treevalue="'.$arProp['ID'].'" style="'.$strSlideStyle.'"></div>'.
                    '</div></div>';
                }
                $arSkuTemplate[$arProp['CODE']] = $templateRow;
            }
            unset($templateRow, $arProp);
        }

        if ($arParams["DISPLAY_TOP_PAGER"])
        {
        ?><? echo $arResult["NAV_STRING"]; ?><?
        }

        $strElementEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT");
        $strElementDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE");
        $arElementDeleteParams = array("CONFIRM" => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));
    ?> 
    <?
        //arshow($arResult);
    ?>

    <?/*$this->SetViewTarget('elementH1');?>
    <?=$arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"]?>
    <?$this->EndViewTarget();*/?>  

    <?$this->SetViewTarget('catalogFilter');?>
    <div class="checkbox_group">

        <?
            $prop = CIBlockProperty::GetPropertyEnum( "TYPE", Array("SORT"=>"asc"),Array("IBLOCK_ID"=>6));
            while($arProp = $prop->Fetch()) {               
            ?>

            <input class="catalogSectionBox" type="checkbox" name="par<?=$arProp["ID"]?>" id="par<?=$arProp["ID"]?>" value="<?=$arProp["ID"]?>" autocomplete="off">
            <label for="par<?=$arProp["ID"]?>"><?=$arProp["VALUE"]?></label>

            <?}?>

    </div>
    <?$this->EndViewTarget();?>        


    <div class="catalog_wrapper_table">
        <table class="catalog-table">
            <tr>
                <td>Фотография</td>
                <td><a href="#" class="sort-name-link" id="sort-name-link">Название <span class="i"></span></a></td>
                <td>стоимость <img src="/img/rub.png" alt="" /></td>
                <td>Артикул</td>
                <td>Размеры <span class="text">(Ш х Г х В)</span></td>
                <td>модификации</td>
                <td>Вес <span class="text">(кг)</span></td>
            </tr>
        </table>

        <div id="tempData"></div>
        <input type="hidden" id="pageCount" value="<?=$arResult["NAV_RESULT"]->NavPageCount?>">
        <input type="hidden" id="pageNavNum" value="<?=$arResult["NAV_RESULT"]->NavNum?>">

        <table id="catalog_wrapper_table">
            <?
                foreach ($arResult['ITEMS'] as $key => $arItem)
                {
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strElementEdit);
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strElementDelete, $arElementDeleteParams);
                    $strMainID = $this->GetEditAreaId($arItem['ID']);

                    $arItemIDs = array(
                        'ID' => $strMainID,
                        'PICT' => $strMainID.'_pict',
                        'SECOND_PICT' => $strMainID.'_secondpict',
                        'STICKER_ID' => $strMainID.'_sticker',
                        'SECOND_STICKER_ID' => $strMainID.'_secondsticker',
                        'QUANTITY' => $strMainID.'_quantity',
                        'QUANTITY_DOWN' => $strMainID.'_quant_down',
                        'QUANTITY_UP' => $strMainID.'_quant_up',
                        'QUANTITY_MEASURE' => $strMainID.'_quant_measure',
                        'BUY_LINK' => $strMainID.'_buy_link',
                        'BASKET_ACTIONS' => $strMainID.'_basket_actions',
                        'NOT_AVAILABLE_MESS' => $strMainID.'_not_avail',
                        'SUBSCRIBE_LINK' => $strMainID.'_subscribe',
                        'COMPARE_LINK' => $strMainID.'_compare_link',

                        'PRICE' => $strMainID.'_price',
                        'DSC_PERC' => $strMainID.'_dsc_perc',
                        'SECOND_DSC_PERC' => $strMainID.'_second_dsc_perc',
                        'PROP_DIV' => $strMainID.'_sku_tree',
                        'PROP' => $strMainID.'_prop_',
                        'DISPLAY_PROP_DIV' => $strMainID.'_sku_prop',
                        'BASKET_PROP_DIV' => $strMainID.'_basket_prop',
                    );

                    $strObName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);

                    $productTitle = (
                        isset($arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])&& $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] != ''
                        ? $arItem['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
                        : $arItem['NAME']
                    );
                    $imgTitle = (
                        isset($arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']) && $arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE'] != ''
                        ? $arItem['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']
                        : $arItem['NAME']
                    );
                ?>

                <?              
                    $pic = $arItem["DETAIL_PICTURE"];
                    if (!$pic["ID"]) {
                        $pic = $arItem["PREVIEW_PICTURE"];
                    } 
                ?> 
                <tr onclick="window.location.href='<?=$arItem["DETAIL_PAGE_URL"]?>'" id="<? echo $strMainID; ?>" rel="<?=$arItem["PROPERTIES"]["TYPE"]["VALUE_ENUM_ID"]?>" class="catalog_wrapper__item_table" data="p<?=$_GET["PAGEN_1"]?>">
                    <td>
                        <span class="img"><img src="<?=$pic["SRC"]?>" alt="<?=$pic["ALT"]?>" /><span></span></span></td>
                    <td><a class="title" href="<?=$arItem["DETAIL_PAGE_URL"]?>" title="<?=$arItem["NAME"]?>"><span><?=$arItem["NAME"]?></span></a></td>
                    <td>
                        <?  
                            $offersPrices = array();
                            if(count($arItem['JS_OFFERS'])>1){ // --- if item have SKU
                                foreach ($arItem['JS_OFFERS'] as $key => $value) {
                                    array_push($offersPrices,$value['PRICE']['VALUE']); // --- collect all price values without RUB sign                     
                                }
                                if (count(array_unique($offersPrices)) === 1){
                                    $block_price = $offersPrices[0];
                                } else {
                                    $block_price = "от ".min($offersPrices);   
                                }
                            } else {
                                $block_price = $arItem["PRICES"][$arParams["PRICE_CODE"][0]]["VALUE"];
                            }
                        ?>
                        <?=$block_price?>
                    </td>
                    <td><?=$arItem["PROPERTIES"]["ARTICLE"]["VALUE"]?></td>
                    <td><?=$arItem["PROPERTIES"]["DIMENSION"]["VALUE"]?></td>
                    <td>
                        <?if (count($arItem["OFFERS"]) > 0){?>
                            <?=count($arItem["OFFERS"])?>
                            <?} else {?>
                            -
                            <?}?>
                    </td>
                    <td><?=$arItem["PROPERTIES"]["WEIGHT"]["VALUE"]?></td>
                </tr>
                <?}?>

        </table>
        <p align="center" class="loadingProcess" style="display: none;">загрузка...<br></p>
        <a href="#" class="catalog_wrapper_top_link" style="display: none;"> <span class="i"></span> все товары загружены, вернуться к началу</a>
    </div>

    <div style="clear: both;"></div>

    <script type="text/javascript">
        BX.message({
            BTN_MESSAGE_BASKET_REDIRECT: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_BASKET_REDIRECT'); ?>',
            BASKET_URL: '<? echo $arParams["BASKET_URL"]; ?>',
            ADD_TO_BASKET_OK: '<? echo GetMessageJS('ADD_TO_BASKET_OK'); ?>',
            TITLE_ERROR: '<? echo GetMessageJS('CT_BCS_CATALOG_TITLE_ERROR') ?>',
            TITLE_BASKET_PROPS: '<? echo GetMessageJS('CT_BCS_CATALOG_TITLE_BASKET_PROPS') ?>',
            TITLE_SUCCESSFUL: '<? echo GetMessageJS('ADD_TO_BASKET_OK'); ?>',
            BASKET_UNKNOWN_ERROR: '<? echo GetMessageJS('CT_BCS_CATALOG_BASKET_UNKNOWN_ERROR') ?>',
            BTN_MESSAGE_SEND_PROPS: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_SEND_PROPS'); ?>',
            BTN_MESSAGE_CLOSE: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_CLOSE') ?>',
            BTN_MESSAGE_CLOSE_POPUP: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_CLOSE_POPUP'); ?>',
            BTN_MESSAGE_BASKET_REDIRECT: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_BASKET_REDIRECT') ?>',
            COMPARE_MESSAGE_OK: '<? echo GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_OK') ?>',
            COMPARE_UNKNOWN_ERROR: '<? echo GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_UNKNOWN_ERROR') ?>',
            COMPARE_TITLE: '<? echo GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_TITLE') ?>',
            BTN_MESSAGE_COMPARE_REDIRECT: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT') ?>',
            SITE_ID: '<? echo SITE_ID; ?>'
        });
    </script>

    <script>
        $(function(){
            $(".changeView").show();
        })
    </script>
    <?
        if ($arParams["DISPLAY_BOTTOM_PAGER"])
        {
        ?><noindex><div style="display:none"><? echo $arResult["NAV_STRING"]; ?></div></noindex><?
        }
    }
?>