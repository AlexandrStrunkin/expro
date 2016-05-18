<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
    $sectionsMain = array(); //разделы первого уровня
    $allSections = array(); //все разделы
    $rsSections = CIBlockSection::GetList(array("SORT"=>"ASC"),array("IBLOCK_ID"=>$arParams["IBLOCK_ID"],"ACTIVE"=>"Y"),false, array("UF_*"));
    while($arSection = $rsSections->Fetch()){
        if ($arSection["DEPTH_LEVEL"] == 1 ) {
            $sectionsMain[$arSection["ID"]] = $arSection; 
        }elseif($arSection["DEPTH_LEVEL"] == 2){
            $sectionsMain_leve_2[$arSection["ID"]] = $arSection;
        }
        $allSections[$arSection["ID"]] = $arSection;
    }

    //arshow($allSections);

    $arResult["TOP_SECTIONS"] = $sectionsMain;
    $arResult["TOP_SECTIONS_LEVEL_2"] = $sectionsMain_leve_2;
    $arResult["ALL_SECTIONS"] = $allSections;

    //функция сортировки разделов по полю "сортировка"
    function sectionSort($a, $b) {
        if ($a["SECTION"]["SORT"] == $b["SECTION"]["SORT"]) {
            return 0;
        }
        return ($a["SECTION"]["SORT"] < $b["SECTION"]["SORT"]) ? -1 : 1;
    }

    //собираем элементы по разделам
    foreach ($arResult["ITEMS"] as $item) {
        $sectionID = $allSections[$item["IBLOCK_SECTION_ID"]]["IBLOCK_SECTION_ID"];
        if (!$sectionID) {
            $sectionID = $allSections[$item["IBLOCK_SECTION_ID"]]["ID"];
        }
        $subSectionID = $item["IBLOCK_SECTION_ID"];
        $arResult["ITEMS_BY_SECTIONS"][$sectionID]["SECTION"] = $allSections[$item["IBLOCK_SECTION_ID"]];
        $arResult["ITEMS_BY_SECTIONS"][$sectionID]["ITEMS"][$subSectionID]["SECTION"] = $allSections[$item["IBLOCK_SECTION_ID"]];
        $arResult["ITEMS_BY_SECTIONS"][$sectionID]["ITEMS"][$subSectionID]["ITEMS"][] = $item;

        uasort($arResult["ITEMS_BY_SECTIONS"][$sectionID]["ITEMS"], "sectionSort");
        uasort($arResult["ITEMS_BY_SECTIONS"], "sectionSort");
    }

?>