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

?>

<?//блок с чекбоксами?>
<?$this->SetViewTarget('catalogFilter');?>
<div class="checkbox_group">

    <?foreach ($arResult['SECTIONS'] as $arSection)
        {?>

        <input class="catalogSectionBox" type="checkbox" name="par<?=$arSection["ID"]?>" id="par<?=$arSection["ID"]?>" value="<?=$arSection["ID"]?>" autocomplete="off">
        <label for="par<?=$arSection["ID"]?>"><?=$arSection["NAME"]?></label>

        <?}?>

</div>
<?$this->EndViewTarget();?>         

<div class="catalog_wrapper">
    <?     	
        foreach ($arResult['SECTIONS'] as $arSection)
        {

            $subsections = CIBLockSection::GetList(array(),array("IBLOCK_ID"=>$arParams["IBLOCK_ID"],"SECTION_ID"=>$arSection["ID"],"ACTIVE"=>"Y"),true,array("UF_*"));
            if ($subsections->SelectedRowsCount() > 0) {
                //если есть подразделы
                while ($arSubsection = $subsections->GetNext()) {?>

                <?//arshow($arSubsection)?>
                <div class="catalog_wrapper__item" rel="<?=$arSubsection["IBLOCK_SECTION_ID"]?>">
                    <div class="catalog_wrapper__item__image">
                        <div class="arrow_white"><img src="/img/ico_arrow_white.png" alt=""></div>
                        <?
                            $img = CFile::ResizeImageGet($arSubsection["PICTURE"], array("width"=>600,"height"=>600), BX_RESIZE_IMAGE_EXACT,false);
                        ?>
                        <img src="<?=$img["src"]?>" alt="" class="main_bg" class="main_bg">
                        <div class="catalog_wrapper__item__image__quickview_wrapper">
                            <div class="catalog_wrapper__item__image__quickview">
                                <span><a href="#catalog-window" class="quickview btn_ico fancy" onclick="loadSection(<?=$arSubsection["ID"]?>)">Быстрый просмотр</a></span>
                            </div>    
                        </div>
                    </div>

                    <div class="catalog_wrapper__item__info">
                        <span class="item_info__title"><a href="<?=$arSubsection["SECTION_PAGE_URL"]?>"><?=$arSubsection["NAME"]?></a></span>
                        <?$parent = getTopParent($arSection["ID"]);?>
                        <span class="item_info__description"><?=$parent["NAME"]?></span>
                        <div class="item_info__colors">
                            <?if (is_array($arSubsection["UF_COLORS"]) && count($arSubsection["UF_COLORS"]) > 0){?>
                                <div class="color_slider">
                                    <div class="color_slider_mask"></div>

                                    <ul class="slides">
                                        <?
                                            $color = CIBlockElement::GetList(array(),array("IBLOCK_ID"=>7,"ID"=>$arSubsection["UF_COLORS"]),false,false,array("ID","PREVIEW_PICTURE","NAME"));
                                            while($arColor = $color->Fetch()) {
                                            ?>
                                            <li><a href="#" class="fancy" title="<?=$arColor["NAME"]?>"><img src="<?=CFile::GetPath($arColor["PREVIEW_PICTURE"])?>" alt=""></a></li>
                                            <?}?>      
                                    </ul>

                                </div>
                                <span class="btn_color"></span>
                                <?}?>
                        </div>

                        <div class="clearboth"></div>
                        <div class="item_info__parametrs">
                            <div class="item_info__parametrs__item">
                                <span>Элементы:</span><span><?=$arSubsection["ELEMENT_CNT"]?></span>
                            </div>
                            <div class="item_info__parametrs__item">
                                <span>Сегмент:</span><span><?=$arSection["NAME"]?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <?}
            }


            else {              
                //если нет подразделов
                //arshow($arSection);
            ?>

            <div class="catalog_wrapper__item" rel="<?=$arSection["ID"]?>">
                <div class="catalog_wrapper__item__image">
                    <div class="arrow_white"><img src="/img/ico_arrow_white.png" alt=""></div>
                    <?
                        $img = CFile::ResizeImageGet($arSection["PICTURE"], array("width"=>600,"height"=>600), BX_RESIZE_IMAGE_EXACT,false);
                    ?>
                    <img src="<?=$img["src"]?>" alt="" class="main_bg" class="main_bg">
                    <div class="catalog_wrapper__item__image__quickview_wrapper">
                        <div class="catalog_wrapper__item__image__quickview">
                            <span><a href="#catalog-window" class="quickview btn_ico fancy" onclick="loadSection(<?=$arSection["ID"]?>)">Быстрый просмотр</a></span>
                        </div>    
                    </div>
                </div>

                <div class="catalog_wrapper__item__info">
                    <span class="item_info__title"><a href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["NAME"]?></a></span>

                    <?$parent = getTopParent($arSection["ID"]);?>
                    <span class="item_info__description"><?=$parent["NAME"]?></span>

                    <?$sectionColors = CIBLockSection::GetList(array(),array("IBLOCK_ID"=>$arParams["IBLOCK_ID"],"ID"=>$arSection["ID"],"ACTIVE"=>"Y"),true,array("UF_*"))->Fetch();?>

                    <div class="item_info__colors">
                        <?if (is_array($sectionColors["UF_COLORS"]) && count($sectionColors["UF_COLORS"]) > 0){?>
                            <div class="color_slider">
                                <div class="color_slider_mask"></div>
                                <ul class="slides">
                                    <?
                                        $color = CIBlockElement::GetList(array("SORT"=>"ASC"),array("IBLOCK_ID"=>7,"ID"=>$sectionColors["UF_COLORS"]),false,false,array("ID","PREVIEW_PICTURE","NAME"));
                                        while($arColor = $color->Fetch()) {
                                        ?>
                                        <li><a href="#" class="fancy" title="<?=$arColor["NAME"]?>"><img src="<?=CFile::GetPath($arColor["PREVIEW_PICTURE"])?>" alt=""></a></li>
                                        <?}?>
                                </ul>
                            </div>
                            <span class="btn_color"></span>
                            <?}?>
                    </div>

                    <div class="clearboth"></div>
                    <div class="item_info__parametrs">
                        <div class="item_info__parametrs__item">
                            <span>Элементы:</span><span><?=$arSection["ELEMENT_CNT"]?></span>
                        </div>
                        <div class="item_info__parametrs__item">
                            <?
                                if ($arSection["IBLOCK_SECTION_ID"] > 0) {
                                    $arParent = CIBlockSection::GetById($arSection["IBLOCK_SECTION_ID"])->Fetch();
                                }
                            ?>
                            <span>Сегмент:</span><span><?=$arParent["NAME"]?></span>
                        </div>
                    </div>
                </div>
            </div>
            <?
            }  

        }

    ?>

</div>

<div id="catalog-window">

</div>