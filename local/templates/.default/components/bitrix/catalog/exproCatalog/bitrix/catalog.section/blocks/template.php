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
    //arshow($arResult["NAV_RESULT"]);
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


    <div class="catalog_wrapper catalog_wrapper_seria">
        <!--catalog-seria-->

        <?if ($arResult["PICTURE"]["SRC"] || $arResult["DESCRIPTION"]) {?>
            <div class="catalog-seria">
                <!--preview-->
                <div class="preview">
                    <img src="<?=$arResult["PICTURE"]["SRC"]?>" alt="<?=$arResult["PICTURE"]["ALT"]?>" style="width: auto;"/>
                </div>

                <!--END preview-->
                <!--area1-->
                <div class="area1">
                    <div class="img-container">

                        <?
                            $section = CIBlockSection::GetList(array(),array("IBLOCK_ID"=>6,"ID"=>$arResult["ID"]),true,array("UF_*"));
                            $arSection = $section->Fetch();
                            if (is_array($arSection["UF_PICTURES"]) && count($arSection["UF_PICTURES"] > 0)) {
                                foreach ($arSection["UF_PICTURES"] as $pic) {?>
                                <?
                                    $big = CFile::ResizeImageGet($pic, array("width"=>800,"height"=>700), BX_RESIZE_IMAGE_EXACT,false);
                                    $small = CFile::ResizeImageGet($pic, array("width"=>110,"height"=>110), BX_RESIZE_IMAGE_EXACT,false);
                                ?>
                                <a href="<?=$big['src']?>"><img src="<?=$small['src']?>" alt=""/></a>
                                <?}?>
                            <?if (count($arSection["UF_PICTURES"]) > 5) {?>
                                <a href="#" class="more">+<?=count($arSection["UF_PICTURES"])-4?></a>
                                <?}?>

                            <?}?>
                    </div>

                </div>
                <!--END area1-->
                <!--area-container-->
                <div class="area-container">
                    <!--area2-->
                    <div class="area2">
                        <h2><?=$arResult["NAME"]?></h2>

                        <div class="area3">
                            <h3>Характеристики</h3>
                            <div class="area3-container">
                                <div class="characters-c">
                                    <table class="characters">
                                        <tr>
                                            <?
                                                if ($arSection["IBLOCK_SECTION_ID"] > 0) {
                                                    $arParent = CIBlockSection::GetById($arSection["IBLOCK_SECTION_ID"])->Fetch();
                                                }
                                            ?>
                                            <td class="data">Сегмент:</td>
                                            <td class="value"><?=$arParent["NAME"]?></td>
                                        </tr>
                                        <?if ($arSection["UF_PLATE_THICKNESS"]){?>
                                            <tr>
                                                <td class="data">Толщина плиты:</td>
                                                <td class="value"><?=$arSection["UF_PLATE_THICKNESS"]?></td>
                                            </tr>
                                            <?}?>

                                        <?if ($arSection["UF_EDGE"]){?>
                                            <tr>
                                                <td class="data">Кромка:</td>
                                                <td class="value"><?=$arSection["UF_EDGE"]?></td>
                                            </tr>
                                            <?}?>

                                        <?if ($arSection["UF_COVER"]){?>
                                            <tr>
                                                <td class="data">Покрытие:</td>
                                                <td class="value"><?=$arSection["UF_COVER"]?></td>
                                            </tr>
                                            <?}?>

                                        <?if ($arSection["UF_GLASS"]){?>
                                            <tr>
                                                <td class="data">Стекло:</td>
                                                <td class="value"><?=$arSection["UF_GLASS"]?></td>
                                            </tr>
                                            <?}?>

                                        <?if ($arSection["UF_MATERIALS"]){?>
                                            <tr>
                                                <td class="data">Материалы:</td>
                                                <td class="value"><?=$arSection["UF_MATERIALS"]?></td>
                                            </tr>
                                            <?}?>

                                        <tr>
                                            <td class="data">Элементы:</td>
                                            <td class="value"><?=$arSection["ELEMENT_CNT"]?></td>
                                        </tr>
                                    </table></div>
                            </div>
                        </div>
                        <!--END area3-->

                        <!--area4-->
                        <div class="area4">
                            <h3>Доступные цвета</h3>
                            <div class="img-container" style="overflow-x: hidden;">
                                <? $color = CIBlockElement::GetList(array("SORT"=>"ASC"),array("IBLOCK_ID"=>7,"ID"=>$arSection["UF_COLORS"]),false,false,array("ID","PREVIEW_PICTURE","NAME"));
                                    $colorCount = $color->SelectedRowsCount();
                                    while($arColor = $color->Fetch()) {?>
                                    <a href="<?=CFile::GetPath($arColor["PREVIEW_PICTURE"])?>" class="fancy" title="<?=$arColor["NAME"]?>"><span><span><img src="<?=CFile::GetPath($arColor["PREVIEW_PICTURE"])?>" alt=""/></span></span><?=$arColor["NAME"]?></a>
                                    <?}?>

                                <a href="javascript:void(0)" onmouseover="$(this).siblings('a.fancy').show(); $(this).fadeOut()" class="more"><span><span>+<?=(count($arSection["UF_COLORS"])-4)?></span></span>Цветовых сочетаний</a>
                            </div>

                        </div>

                        <div class="seriaBlocksSeparate"></div>

                        <?if (!empty($arResult["DOWNLOADABLE_FILES"]) && count($arResult["DOWNLOADABLE_FILES"]) > 0) {?>
                            <div class="dowloadable-files-container">
                                <h3>Материалы для скачивания</h3>
                                <?
                                    foreach ($arResult["DOWNLOADABLE_FILES"] as $file) {?>
                                    <div><a href="<?=$file["PATH"]?>" title="скачать <?=$file["NAME"]?>" download><?=$file["NAME"]?></a> <span>(<?=$file["FILE_SIZE"]?> мб)</span></div>
                                    <?}?>
                            </div>
                            <div class="seriaBlocksSeparate"></div>
                            <?}?>

                        <?if ($arResult["DESCRIPTION"]) {?>
                            <h3>Особенности</h3>
                            <div class="area2-container">
                                <div class="seriaDescription">
                                    <?=$arResult["DESCRIPTION"]?>
                                </div>
                            </div>
                            <div class="seriaShowAll"><span id="showAllDesc" class="closed" >показать полностью</span></div>
                            <br>
                            <?}?>
                        <!--END area2-->
                        <!--area3-->
                        <!--END area4-->
                    </div>
                    <!--END area-container-->
                </div>
            </div>

            <?}?>

        <!--END catalog-seria-->

        <div id="tempData"></div>
        <input type="hidden" id="pageCount" value="<?=$arResult["NAV_RESULT"]->NavPageCount?>">
        <input type="hidden" id="pageNavNum" value="<?=$arResult["NAV_RESULT"]->NavNum?>">
        <div id="catalog_wrapper_table">
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

                    //arshow($arItem["PROPERTIES"]["TYPE"]);
                ?>

                <?
                    $pic = $arItem["DETAIL_PICTURE"];
                    if (!$pic["ID"]) {
                        $pic = $arItem["PREVIEW_PICTURE"];
                    }
                ?>

                <div class="catalog_wrapper__item" id="<? echo $strMainID; ?>" rel="<?=$arItem["PROPERTIES"]["TYPE"]["VALUE_ENUM_ID"]?>" data="p<?=$_GET["PAGEN_1"]?>">

                    <div class="catalog_wrapper__item__left">
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
                        <div class="price"><?=$block_price?> <img src="/img/rub1.png" alt=""/></div>
                        <!--                        <a href="#get-opp-price" class="price-link login-popup-link" onclick="setOptProduct(<?=$arItem["ID"]?>,'<?=trim($arItem["NAME"])?>')"><span>Узнать оптовую цену</span></a>
                        -->
                        <a href="/about/for_dealers/" class="price-link login-popup-link" ><span>Узнать оптовую цену</span></a>
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="catalog_wrapper__item__image" >
                            <?$img = CFile::ResizeImageGet($pic["ID"], array("width"=>425,"height"=>425), BX_RESIZE_IMAGE_PROPORTIONAL,true);?>
                            <img src="<?=$img['src']?>" alt="<?=$arItem["DETAIL_PICTURE"]["ALT"]?>" class="" style="display: block; max-width: 100%; max-height: 100%; float:none">
                        </a>
                    </div>

                    <div class="catalog_wrapper__item__info">
                        <span class="item_info__title"><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></span>
                        <?if (count($arItem["OFFERS"]) > 0) {?>
                            <span class="item_info__description">модификации: <?=count($arItem["OFFERS"])?></span>
                            <?}?>

                        <div class="clearboth"></div>

                        <? if (!empty($arItem["DETAIL_TEXT"])) { ?>
                            <div class="detail_text">
                                <p><?=$arItem["DETAIL_TEXT"]?></p>
                            </div>
                            <? } ?>
                        <div class="item_info__parametrs">
                            <?if ($arItem["PROPERTIES"]["ARTICLE"]["VALUE"]) {?>
                                <div class="item_info__parametrs__item">
                                    <span>Артикул:</span><span><?=$arItem["PROPERTIES"]["ARTICLE"]["VALUE"]?></span>
                                </div>
                                <?}?>

                            <?if ($arItem["PROPERTIES"]["DIMENSION"]["VALUE"]){?>
                                <div class="item_info__parametrs__item">
                                    <span>ШxГxВ:</span><span><?=$arItem["PROPERTIES"]["DIMENSION"]["VALUE"]?></span>
                                </div>
                                <?}?>

                            <?if ($arItem["PROPERTIES"]["WEIGHT"]["VALUE"]){?>
                                <div class="item_info__parametrs__item">
                                    <span>Вес:</span><span><?=$arItem["PROPERTIES"]["WEIGHT"]["VALUE"]?></span>
                                </div>
                                <?}?>

                        </div>
                    </div>
                </div>
                <?
                }
            ?>
        </div>
        <p align="center" class="loadingProcess" style="display: none;">загрузка...<br></p>
        <a href="#" class="catalog_wrapper_top_link" style="display: none;"> <span class="i"></span> все товары загружены, вернуться к началу</a>
        <div style="clear: both;"></div>



    </div>


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