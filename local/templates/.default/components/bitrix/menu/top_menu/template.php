<?
    if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
        die();
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
    $this -> setFrameMode(true);

    if (empty($arResult))
        return;
?>

<?
    //массив разделов, для которых нужно проверять наличие контента, и при его отсутствии не показывать ссылку  (ссылка=>IBLOCK_ID)
    $checkContent = array(
        "/portfolio/" => 22, //портфолио
        "/info/"  => 25, 
    );
?>

<nav class="top_menu">
    <ul>         
        <?foreach($arResult as $itemIdex => $arItem):?>
            <?
                if(array_key_exists($arItem["LINK"],$checkContent)) {
                    $checkIblock = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => $checkContent[$arItem["LINK"]], "ACTIVE_DATE" => "Y", "ACTIVE" => "Y"), false, Array("nPageSize" => 1), array("ID"));
                    if ($checkIblock->SelectedRowsCount() <= 0) {
                        continue;
                    }
                }

            ?>
            <?if ($arItem["SELECTED"] == "Y"){?>
                <li class="active"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
                <? } else { ?>
                <li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
                <? } ?>   
            <?endforeach; ?>
    </ul>
</nav>