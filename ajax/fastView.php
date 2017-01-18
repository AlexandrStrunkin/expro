<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>
<?
    $ID = intval($_POST["ID"]);

    $section = CIBlockSection::GetList(array(),array("IBLOCK_ID"=>6,"ID"=>$ID),true,array("UF_*"));
    $arSection = $section->Fetch();   
    if ($arSection["IBLOCK_SECTION_ID"] > 0) {
        $arParent = CIBlockSection::GetById($arSection["IBLOCK_SECTION_ID"])->Fetch();
    }
?>    

<!--catalog-window-left-->
<div class="catalog-window-left">
    <!--catalog-window-left-bg-->
    <div class="catalog-window-left-bg">
        <div>
            <ul>             
                <? $color = CIBlockElement::GetList(array(),array("IBLOCK_ID"=>7,"ID"=>$arSection["UF_COLORS"]),false,false,array("ID","PREVIEW_PICTURE","NAME"));
                    while($arColor = $color->Fetch()) {?>                 
                    <li>
                        <a href="javascript:void(0)"><span class="img"><img src="<?=CFile::GetPath($arColor["PREVIEW_PICTURE"])?>" alt="" title="<?=$arColor["NAME"]?>"/></span>
                            <span class="title"><?=$arColor["NAME"]?></span></a>
                    </li>
                    <?}?>   
            </ul>
        </div>
    </div>
    <!--END catalog-window-left-bg-->
</div>
<!--END catalog-window-left-->

<!--catalog-window-right-->
<div class="catalog-window-right">
    <ul class="small-preview">  
        <?
            if (is_array($arSection["UF_PICTURES"]) && count($arSection["UF_PICTURES"] > 0)) {
                $i = 1;
                foreach ($arSection["UF_PICTURES"] as $pic) {?>
                <?
                $img = CFile::ResizeImageGet($pic, array("width"=>60,"height"=>60), BX_RESIZE_IMAGE_EXACT,false); 
                ?>
                <li <?if ($i == 1) {?> class="active"<?}?>>
                    <img src="<?=$img["src"]?>" alt="" />
                </li> 
                <?$i++;}
            }
        ?>
        
    </ul>
    <ul class="flex-direction-nav1"><li><a class="flex-prev inactive" href="#"></a></li><li><a class="flex-next" href="#"></a></li></ul>
    <div class="mask"></div>
    <div class="catalog-window-right-slider">
        <ul class="slides">
        <?
            if (is_array($arSection["UF_PICTURES"]) && count($arSection["UF_PICTURES"] > 0)) {
                foreach ($arSection["UF_PICTURES"] as $pic) {?> 
                <?
                $img = CFile::ResizeImageGet($pic, array("width"=>450,"height"=>725), BX_RESIZE_IMAGE_EXACT,false); 
                ?>
                <li>
                    <img src="<?=$img['src']?>" alt="" />
                </li> 
                <?$i++;}
            }
        ?>                

        </ul>
    </div>
</div>
<!--END catalog-window-right-->

<!--catalog-window-center-->
<div class="catalog-window-center">
    <!--catalog-window-center-top-->
    <div class="catalog-window-center-top">
        <a href="#" class="title-link"><?=$arSection["NAME"]?></a>
        <?$parent = getTopParent($arSection["ID"]);?>
        <p><?=$parent["NAME"]?></p>
        <h3>Характеристики</h3>
    </div>
    <!--END catalog-window-center-top-->
    <!--catalog-window-center-characters-->
    <div class="catalog-window-center-characters">
        <div>
            <table>
                <tr><td class="data">Сегмент:</td><td class="value"><?=$arParent["NAME"]?></td></tr>
               <?if ($arSection["UF_PLATE_THICKNESS"]) {?> 
                <tr><td class="data">Столешница:</td><td class="value"><?=$arSection["UF_PLATE_THICKNESS"]?></td></tr>
                <?}?>
                <?if ($arSection["UF_EDGE"]) {?>
                <tr><td class="data">Кромка:</td><td class="value"><?=$arSection["UF_EDGE"]?></td></tr>
                <?}?>
                <?if ($arSection["UF_COVER"]) {?>
                <tr><td class="data">Покрытие:</td><td class="value"><?=$arSection["UF_COVER"]?></td></tr>
                 <?}?>
                <?if ($arSection["UF_GLASS"]) {?>
                <tr><td class="data">Стекло:</td><td class="value"><?=$arSection["UF_GLASS"]?></td></tr>
                 <?}?>
                 <?if ($arSection["UF_MATERIALS"]) {?>
                <tr><td class="data">Материалы:</td><td class="value"><?=$arSection["UF_MATERIALS"]?></td></tr>
                 <?}?>
                <tr><td class="data">Элементы:</td><td class="value"><?=$arSection["ELEMENT_CNT"]?></td></tr>                      
            </table>
        </div>
    </div>
    <!--END catalog-window-center-characters-->
    <div class="catalog-window-center-bottom">
        <a href="#order-call" class="call-btn login-popup-link">заказать обратный звонок</a>
        <div class="link-container">
            <a href="/contacts/where_buy/" class="link1">Точки продажи</a><!--
            --><a href="/about/for_dealers/" class="link2" target="_blank">Стать дилером</a>
        </div>
    </div>
        </div>     
        <!--END catalog-window-center-->
