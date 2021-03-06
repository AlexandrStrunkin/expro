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

<nav class="top_menu">
    <ul>         
        <?foreach($arResult as $itemIdex => $arItem):?>
        <?
            if ($arItem['LINK'] == "/info/") {
                $res = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => 25, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y"), false, Array("nPageSize" => 1), $arSelect);
                if (!$res -> GetNextElement()) {
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