<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */     

use Bitrix\Main\Context;
use Bitrix\Main\Type\DateTime;                                        

if(!isset($arParams["CACHE_TIME"]))
    $arParams["CACHE_TIME"] = 36000000;
                           
$curPage = $APPLICATION->GetCurPage();  

$arSelect = Array("ID", "DETAIL_TEXT");
$arFilter = Array("IBLOCK_ID"=>IntVal($arParams['IBLOCK_ID']), "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", 'NAME' => $curPage);

if($this->StartResultCache(false, array(($arParams["CACHE_GROUPS"]==="N"? false: $USER->GetGroups()),$bUSER_HAVE_ACCESS, $arNavigation, $pagerParameters)))
{        
    if(!CModule::IncludeModule("iblock"))
    {
        $this->AbortResultCache();
        ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
        return;
    }

    $arSelect = Array("ID", "DETAIL_TEXT");
    $arFilter = Array("IBLOCK_ID"=>IntVal($arParams['IBLOCK_ID']), "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", 'NAME' => $curPage);
    
    $rsElement = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);       
    if($obElement = $rsElement->GetNextElement())
    {
        $arResult = $obElement->GetFields();                                                  

        $this->SetResultCacheKeys(array(
            "ID",              
            "NAME",    
            "DETAIL_TEXT"       
        ));

        $this->IncludeComponentTemplate();
    }   
    else
    {      
        $this->AbortResultCache();
    }
}
                                                                     
if(CModule::IncludeModule("iblock"))       {                                                
    CIBlockElement::CounterInc($arResult["ID"]); 
    if($USER->IsAuthorized())
    {
        if($APPLICATION->GetShowIncludeAreas())
        {
            $arButtons = CIBlock::GetPanelButtons(
                $arResult["IBLOCK_ID"],        
                $arResult["ID"],
                $arResult["IBLOCK_SECTION_ID"],
                Array(
                    "RETURN_URL" => $arReturnUrl,
                    "SECTION_BUTTONS" => false,
                )
            );                                                                                                              

            if($APPLICATION->GetShowIncludeAreas())
                $this->AddIncludeAreaIcons(CIBlock::GetComponentMenu($APPLICATION->GetPublicShowMode(), $arButtons));   
        }
    }
}                                          
?>