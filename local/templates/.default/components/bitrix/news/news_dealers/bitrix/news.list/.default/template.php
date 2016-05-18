<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
    if (count($arResult["ITEMS"]) < 1)
        return;
?>        

<?foreach($arResult["ITEMS"] as $arItem):?>
    <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('NEWS_ELEMENT_DELETE_CONFIRM')));

    ?>       

    <div class="catalog_wrapper__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="catalog_wrapper__item__image">
            <div class="arrow_white"><img src="/img/arrow1.png" alt=""></div>
            
            <?$src = "/files/24.jpg";?>
            
            <?
            if ($arItem["PREVIEW_PICTURE"]["ID"]) {
                $pic = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], array("width"=>400,"height"=>290), BX_RESIZE_IMAGE_EXACT,false);
                $src = $pic['src']; 
            }
            
            else if ($arItem["DETAIL_PICTURE"]["ID"]) {
                $pic = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"]["ID"], array("width"=>400,"height"=>290), BX_RESIZE_IMAGE_EXACT,false);
                $src = $pic['src']; 
            }
            ?>
            
            <img src="<?=$src?>" alt="" class="main_bg">   
        </a>

        <div class="catalog_wrapper__item__info">
            <span class="item_info__title"><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></span>

            <span class="item_info__description">
            <?=$arItem["PREVIEW_TEXT"]?>
                </span>
            <span class="item_info__date"><?=$arItem["DATE_CREATE"]?></span>
        </div>
    </div>           


    <?endforeach;?>     

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <?=$arResult["NAV_STRING"]?>
    <?endif;?>