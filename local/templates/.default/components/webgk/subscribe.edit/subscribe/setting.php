<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
    //***********************************
    //setting section
    //***********************************
?>
<?
    $checkedRubrics = array();
    foreach ($arResult["RUBRICS"] as $rub) {
        $checkedRubrics[$rub["ID"]] = $rub["CHECKED"]; 
    }

?>  
<div class="sub">
    <script>
        $(function(){
            $(".back").click(function(){
                $(".rubLabel input").each(function(){
                    if ($(this).prop("checked") == true) {
                        $(this).parents(".rubLabel").mousedown();
                    }
                }) 
            })
        })
    </script>

    <form action="<?=$arResult["FORM_ACTION"]?>" method="post">
        <?echo bitrix_sessid_post();?>        

        <label class="label1 rubLabel" ><span class="text">Следить за новостями для <span>компании</span></span> <span class="niceCheck" ><input type="checkbox" name="RUB_ID[]" id="rub_1" value="1" <?if ($checkedRubrics[1]){?> checked="checked"<?}?> autocomplete="off"/></span></label>
        <label class="label2 rubLabel" ><span class="text">Следить за новостями для <span>дилеров</span></span> <span class="niceCheck" ><input type="checkbox" name="RUB_ID[]" id="rub_2" value="2" <?if ($checkedRubrics[2]){?> checked="checked"<?}?> autocomplete="off"/></span></label>

        <input style="display:none" type="text" name="EMAIL" value="<?=$arResult["SUBSCRIPTION"]["EMAIL"]!=""?$arResult["SUBSCRIPTION"]["EMAIL"]:$arResult["REQUEST"]["EMAIL"];?>" size="30" maxlength="255" /></p>

        <?/*foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
            <label><input type="checkbox" name="RUB_ID[]" value="<?=$itemValue["ID"]?>"<?if($itemValue["CHECKED"]) echo " checked"?> /><?=$itemValue["NAME"]?></label><br />
        <?endforeach;*/?>

        <?/*<label><input type="radio" name="FORMAT" value="text"<?if($arResult["SUBSCRIPTION"]["FORMAT"] == "text") echo " checked"?> /><?echo GetMessage("subscr_text")?></label>*/?>
        <label style="display: none;"><input type="radio" name="FORMAT" value="html" checked /></label>

        <div class="btn-container">
            <?/*
                <button type="submit" class="submit">Сохранить изменения</button>
                <a href="#" class="back">Отменить</a>
            */?>
            <input type="submit" class="submit" name="Save" value="<?echo ($arResult["ID"] > 0? GetMessage("subscr_upd"):GetMessage("subscr_add"))?>" />
            <input type="reset" class="back" value="<?echo GetMessage("subscr_reset")?>" name="reset" />
        </div> 



        <input type="hidden" name="PostAction" value="<?echo ($arResult["ID"]>0? "Update":"Add")?>" />
        <input type="hidden" name="ID" value="<?echo $arResult["SUBSCRIPTION"]["ID"];?>" />
        <?if($_REQUEST["register"] == "YES"):?>
            <input type="hidden" name="register" value="YES" />
            <?endif;?>
        <?if($_REQUEST["authorize"]=="YES"):?>
            <input type="hidden" name="authorize" value="YES" />
            <?endif;?>
    </form>
</div>
