<?
    if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

    //собираем инфо о разделах (это страны) и отдельно их ID
    $wrap_list = array(); //общий список разделов
    $countries = array(); //страны (разделы 1 уровня)
    $section = array(); // раздел между складом и салоном  (разделы 2 уровня)
    $cities = array(); //города (разделы 3 уровня)
    $rsSections = CIBlockSection::GetList(array("NAME" => "asc"),array("IBLOCK_ID"=>$arParams["IBLOCK_ID"],"ACTIVE"=>"Y"));
    while($arSection = $rsSections->Fetch()) {
        if ($arSection["DEPTH_LEVEL"] == 1) {    
            $countries[$arSection["ID"]] = $arSection;
        } elseif($arSection["DEPTH_LEVEL"] == 2) {      
            $section[$arSection["ID"]] = $arSection;
        } else {                                        
            $cities[$arSection["ID"]] = $arSection;
        }
        $wrap_list[$arSection["ID"]] = $arSection;
    }

    $arResult["COUNTRIES"] = $countries;
    $arResult["CITIES"] =  $cities;

    $arResult["SECTION"] =  $section;

    $arResult["WRAP_LIST"] = $wrap_list;

    $itemsBySection = array();

    //функция для сортировки магазинов по полю "сортировка"
    function shopSort($a, $b) {
        if ($a["SORT"] == $b["SORT"]) {
            return 0;
        }
        return ($a["SORT"] < $b["SORT"]) ? -1 : 1;
    }  

    //функция для сортировка городов пор полю "сортировка"
    function citySort($a, $b) {
        if ($a["CITY"]["SORT"] == $b["CITY"]["SORT"]) {
            return 0;
        }
        return ($a["CITY"]["SORT"] < $b["CITY"]["SORT"]) ? -1 : 1;
    }

    foreach ($arResult["ITEMS"] as $item) {
        $city = $cities[$item["IBLOCK_SECTION_ID"]]["NAME"];

        $sections = $section[$cities[$item["IBLOCK_SECTION_ID"]]["IBLOCK_SECTION_ID"]]["NAME"];

        /*if($item["PROPERTIES"]["shop"]["VALUE"]){
        $country = $countries[$sections[$item["IBLOCK_SECTION_ID"]]["IBLOCK_SECTION_ID"]]["NAME"];
        }else{
        $country = $countries[$sections[$item["IBLOCK_SECTION_ID"]]["IBLOCK_SECTION_ID"]]["NAME"];
        }
        if(!$item["PROPERTIES"]["shop"]["VALUE"]){
        $itemsBySection[$country][$city][] = $item;
        }else{
        $itemsBySection[$country][$city][] = $item;
        }    */

        $country = $countries[$section[$wrap_list[$item["IBLOCK_SECTION_ID"]]["IBLOCK_SECTION_ID"]]["IBLOCK_SECTION_ID"]]["NAME"];

        $itemsBySection[$country][$sections][$city]["CITY"] = $cities[$item["IBLOCK_SECTION_ID"]]; 
        $itemsBySection[$country][$sections][$city]["ITEMS"][] = $item;   
       
            usort($itemsBySection[$country][$sections][$city]["ITEMS"], "shopSort");
            uasort($itemsBySection[$country][$sections], "citySort");   
    }

    $arResult["SECTIONS_ITEMS"] = $itemsBySection;

   // arshow($arResult["SECTIONS_ITEMS"],true);

?>