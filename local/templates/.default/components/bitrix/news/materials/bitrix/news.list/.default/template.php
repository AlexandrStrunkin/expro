<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
    if (count($arResult["ITEMS"]) < 1)
        return;
?>
      
      <div class="catalog_wrapper_seria">
      
    <?foreach($arResult["ITEMS"] as $arItem):?>
        <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('NEWS_ELEMENT_DELETE_CONFIRM')));

        ?>

        <?              
            $pic = $arItem["DETAIL_PICTURE"];
            if (!$pic["ID"]) {
                $pic = $arItem["PREVIEW_PICTURE"];
            } 
        ?>    
        <div class="catalog_wrapper__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>" >

            <div class="catalog_wrapper__item__left">
                <?
                    $imgPrev = CFile::ResizeImageGet($pic["ID"], array("width"=>425,"height"=>280), BX_RESIZE_IMAGE_PROPORTIONAL,false);
                    $imgBig = $pic;
                ?>
                <a href="<?=$imgBig['SRC']?>" class="catalog_wrapper__item__image_1 fancyImg" >                       
                    <img src="<?=$imgPrev['src']?>" alt="" class="" style="display: block;  margin: 0 auto; float:none">
                </a>
            </div>

            <div class="catalog_wrapper__item__info">
                <span class="item_info__title"><a href="<?=$imgBig['SRC']?>" class="fancyImg"><?=$arItem["NAME"]?></a></span>

                <div class="clearboth"></div>
                <div class="item_info__parametrs">


                    <div class="item_info__parametrs__item">
                        <?$size = round($imgBig["FILE_SIZE"]/1024/1024,2);?>
                        <span>Размер:</span><span><?=$size?> Мб <a href="<?=$imgBig['SRC']?>" download>(скачать)</a></span>
                    </div>

                    <div class="item_info__parametrs__item">
                        <span>Дата добавления:</span><span><?=$arItem["DATE_CREATE"]?></span>
                    </div>                            

                </div>
            </div>
        </div>

        <?endforeach;?> 

  </div>
<script>
    $(function(){
        $('.fancyImg').fancybox({
            type: "image",
            fixed: true,
            padding: 0,
            margin: 40,
            afterShow:function(){
                $(".fancybox-close").addClass("fancybox-close-gray");
                $("body").css("overflow", "hidden");
            },       
        });
    });

</script>