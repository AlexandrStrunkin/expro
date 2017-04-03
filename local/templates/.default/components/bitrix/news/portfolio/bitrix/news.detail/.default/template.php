<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="catalog_wrapper catalog_wrapper_seria catalog_wrapper_tovar" >
    <!--catalog-seria-->
    <div class="catalog-seria" id="<? echo $arItemIDs['ID']; ?>">
        <!--preview-->
        <?
            if ($arResult["DETAIL_PICTURE"]["SRC"]) {
                $preview = $arResult["DETAIL_PICTURE"];
            }
            else if ($arResult["PREVIEW_PICTURE"]["SRC"]) {
                $preview = $arResult["PREVIEW_PICTURE"];
            }              

        ?>
        <?
            if ($preview["WIDTH"] > 800 || $preview["HEIGHT"] > 700){
                $firstPreviewBig = CFile::ResizeImageGet($preview["ID"], array("width"=>800,"height"=>700), BX_RESIZE_IMAGE_PROPORTIONAL ,false);
                // echo "1111";
            }              
            else {
                $firstPreviewBig["src"] = $preview["SRC"];
            }
            $firstPreviewSmall = CFile::ResizeImageGet($preview["ID"], array("width"=>110,"height"=>110), BX_RESIZE_IMAGE_PROPORTIONAL ,false);
        ?>
        <div class="preview">
            <img src="<?=$firstPreviewBig["src"]?>" alt="" />
        </div>

        <!--END preview-->
        <!--area1-->
        <?
            foreach ($arResult['MORE_PHOTO'] as $k=>$foto) {
                if ($foto["ID"] == $preview["ID"]) {
                    unset($arResult['MORE_PHOTO'][$k]);
                }
            }
        ?>
        <?
            //arshow($arResult['MORE_PHOTO']);
            //arshow($arResult["OFFERS"]);
            foreach ($arResult["OFFERS"] as $offer) {
                $arResult['PROPERTIES']['FOTO']['VALUE'][] = $offer["DETAIL_PICTURE"];
            }
            
        ?>

        <div class="area1">
            <div class="img-container">     

                <?if (is_array($arResult['PROPERTIES']['FOTO']['VALUE']) && count($arResult['PROPERTIES']['FOTO']['VALUE']) > 0) {?> 
                    <? 
                        foreach ($arResult['PROPERTIES']['FOTO']['VALUE'] as $pic) {?>
                        <?
                            $big = CFile::ResizeImageGet($pic, array("width"=>800,"height"=>700), BX_RESIZE_IMAGE_PROPORTIONAL ,false);
                            $small = CFile::ResizeImageGet($pic, array("width"=>110,"height"=>110), BX_RESIZE_IMAGE_PROPORTIONAL ,false);
                        ?> 
                        <a href="<?=$big['src']?>"><img src="<?=$small['src']?>" alt=""/></a>
                        <?}?>
                    <a href="#" class="more">+<?=(count($arResult['PROPERTIES']['FOTO']['VALUE'])-3)?></a>  
                    <?} else {/*?>
                        <a href="<?=$firstPreviewBig['src']?>"><img src="<?=$firstPreviewSmall['src']?>" alt=""/></a>
                <?*/}?> 
            </div>                                                                          
        </div>


        <!--END area1-->
        <!--area-container-->
        <div class="area-container">
            <!--area2-->
            <?
                if ($arResult["DETAIL_TEXT"]) {
                    $description = $arResult["DETAIL_TEXT"];
                }
                else if ($arResult["PREVIEW_TEXT"]) {
                    $description = $arResult["PREVIEW_TEXT"];
                }
            ?>
            <div class="area2" <?if (!$description) {?> style="max-height:45px !important;"<?}?>>
                <h2><?=$arResult["NAME"]?></h2>                            

                <?if ($description != "") {?>
                    <h3>Особенности</h3>
                    <div class="portfolio_description">
                        <?=$description?>
                    </div>
                    <?}?>
                    
                    <a class="orderProject login-popup-link" type="button" href="#order-project">Заказать проект</a>
            </div>       
            <!--END area2-->
            
        </div>
        <!--END area-container-->
    </div>
    <!--END catalog-seria-->

   

</div> 