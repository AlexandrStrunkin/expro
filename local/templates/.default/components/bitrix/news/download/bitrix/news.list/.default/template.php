<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?//arshow($arResult["ITEMS_BY_SECTIONS"])?>
<?//верхние табы?>
<?$this->SetViewTarget('downloadSections');?>
<?global $USER;?>
<div class="page-downloads-tabs">
    <?
        $i = 0;
        $activeTabID = 0;
        foreach ($arResult["TOP_SECTIONS"] as $id => $s){?>
        <?
            $active = "";
            if ($i == 0) {
                $active = "active";  
                $activeTabID = $s["ID"];
            }
        ?> 
        <?
           if ($USER->IsAuthorized()){
             $arGroups = CUser::GetUserGroup($USER->GetID());
             foreach($arGroups as $group_id){
                 if($group_id == 8){    // принадлежност пользователя к 1 группе
                      $group_1_item = $s["UF_GROUP_1"];
                 }elseif($group_id == 9){ // принадлежност пользователя ко 2 группе
                      $group_2_item = $s["UF_GROUP_2"];
                 }elseif($group_id == 10){  // принадлежност пользователя к 3 группе
                      $group_3_item = $s["UF_GROUP_3"]; 
                 }elseif($USER->IsAdmin()){
                      $group_1_item = 1;
                      $group_2_item = 1;
                      $group_3_item = 1;
                 } 
             }
          } 
          
          
          if($group_1_item == 1 or 
             $group_2_item == 1 or
             $group_3_item == 1 ){
          ?> 
        <a href="#tab<?=$s["ID"]?>" class="<?=$active?>"><?=$s["NAME"]?></a>
        <?$i++;
             }?>
        <?}?>
</div>


<?$this->EndViewTarget();?> 



<div class="tabsWrapper">
     
            <? 
            CModule::IncludeModule("iblock");
            $arFilter = array('ACTIVE' => 'Y', 'IBLOCK_ID' => $arResult['IBLOCK_ID'], "ID" => $arResult["TOP_SECTIONS"][$tID]);
                  $dbRes = CIBlockSection::GetList(array('SORT'=>'ASC'), $arFilter, false, Array("UF_GROUP_1"));
                  while ($arRes = $dbRes->GetNext())
                  {
                     //arshow($arRes);
                  }
            ?>
    <?foreach($arResult["ITEMS_BY_SECTIONS"] as $tID=>$arTopSection):?>

    <?if ($tID != $activeTabID) {$style= "display:none";} else {$style="";}?>
    
        <div class="page-downloads" id="tab<?=$tID?>-content" style="<?=$style?>"> 

            <?
                $i = 1;
                foreach ($arTopSection["ITEMS"] as $sID=>$subsection) {?>
                <?
                    if ($i%2 == 0) {$p = 2;}
                    else {$p = 1;}
                    //если в блоке нечетное количество элементов - последний блок растягиваем на всю ширину
                    if  (count($arTopSection)%2 != 0 && $i == count($arTopSection)) {
                        $p = 3;
                    }
                ?>
                <?
                   if ($USER->IsAuthorized()){
                     $arGroups = CUser::GetUserGroup($USER->GetID());
                     foreach($arGroups as $group_id){
                         if($group_id == 8){    // принадлежност пользователя к 1 группе
                              $group_1 = $arResult["TOP_SECTIONS_LEVEL_2"][$sID]["UF_GROUP_1"];
                         }elseif($group_id == 9){ // принадлежност пользователя ко 2 группе
                              $group_2 = $arResult["TOP_SECTIONS_LEVEL_2"][$sID]["UF_GROUP_2"];
                         }elseif($group_id == 10){  // принадлежност пользователя к 3 группе
                              $group_3 = $arResult["TOP_SECTIONS_LEVEL_2"][$sID]["UF_GROUP_3"]; 
                         }elseif($USER->IsAdmin()){
                              $group_1 = 1;
                              $group_2 = 1;
                              $group_3 = 1;
                         }
                     }
                  } 
                  if($group_1 == 1 or 
                     $group_2 == 1 or
                     $group_3 == 1 ){
                  ?> 
                        <div class="col<?=$p?>">
                            <h3><?=$arResult["ALL_SECTIONS"][$sID]["NAME"]?></h3>
                            <div>
                                <?
                                    foreach ($subsection["ITEMS"] as $arItem) {

                                        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
                                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('NEWS_ELEMENT_DELETE_CONFIRM')));

                                    ?>
                                    <?
                                        $fileLink = CFile::GetPath($arItem["PROPERTIES"]["FILE"]["VALUE"]);
                                        $fileData = CFile::MakeFileArray($arItem["PROPERTIES"]["FILE"]["VALUE"]);
                                    ?>
                                    <a href="<?=$fileLink?>" class="item" id="<?=$this->GetEditAreaId($arItem['ID']);?>" download title="скачать прайс лист"><span class="text"><?=$arItem["NAME"]?></span><span class="size"><?=round($fileData["size"]/1024/1024,2)?> MB</span></a>
                                    <?}?>
                            </div>
                            <?
                            //ссылка для скачивание прайс листа всего раздела
                            if ($arResult["ALL_SECTIONS"][$sID]["UF_FULL_PRICELIST"] > 0) {
                                $fullPricePath = CFile::GetPath($arResult["ALL_SECTIONS"][$sID]["UF_FULL_PRICELIST"]);
                                $fullPriceData = CFile::MakeFileArray($arResult["ALL_SECTIONS"][$sID]["UF_FULL_PRICELIST"]);                             
                            ?>
                            <a href="<?=$fullPricePath?>" class="all" download title="скачать все"><span class="text">Скачать все</span><span class="size"><?=round($fullPriceData["size"]/1024/1024,2)?> MB</span></a>
                            <?}?>
                        </div>
               
                   <?$i++;}?>
                <?}?>


        </div>

        <?endforeach;?> 
    <div class="clearboth"></div>
</div>