<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    $APPLICATION->SetTitle("Интернет-магазин \"Одежда\"");
    //header('Content-Type: text/html; charset=utf-8');
    if (!$USER->IsAdmin()) {
        die();
    }  
    
    die(); //блокировка скрипта.                       
?>
Получение файла на сервере<br>
<?
    function download($url, $target) {
        if(!$hfile = fopen($target, "a+"))return false;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.95 Safari/537.11');

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FILE, $hfile);

        if(!curl_exec($ch)){
            curl_close($ch);
            fclose($hfile);
            unlink($target);
            return false;
        }

        fflush($hfile);
        fclose($hfile);
        curl_close($ch);
        return true;
    }
    
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, 'http://expro.ru/exportYML.php?view=true'); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    $data=curl_exec($ch);
    $objXML = new CDataXML();
    $objXML->LoadString(iconv('utf-8','windows-1251',$data));
    $arData = $objXML->GetArray();
    $ACTIVE = "Y";
    $IBLOCK_ID = 6;
    //Добавление разделов
    /*
    foreach ($arData["yml_catalog"]["#"]["categories"]["0"]["#"]["category"] as $category) {
    $bs = new CIBlockSection;
    $CODE='';
    $arParams = array("replace_space"=>"_","replace_other"=>"-");
    $CODE = Cutil::translit($category["#"],"ru",$arParams);
    if(count(array_keys($arCode, $CODE))>=1){
    $arCode[]=$CODE;
    $postFix=count(array_keys($arCode, $CODE))-1;
    $CODE=$CODE.'_'.$postFix;
    } else {
    $arCode[]=$CODE;
    }
    //arshow($arCode);
    //arshow($CODE);
    if ($category["@"]["parentId"]==0){
    echo 'Добавляем в корень';
    //arshow($category);
    $arFields = Array("ACTIVE" => $ACTIVE, "IBLOCK_ID" => $IBLOCK_ID, "NAME" => $category["#"], "CODE"=>$CODE);
    $IDroot = $bs->Add($arFields);
    } else {
    echo 'Добавляем в раздел '.$category["@"]["parentId"];
    $arFields = Array("ACTIVE" => $ACTIVE, "IBLOCK_SECTION_ID" => $IDroot, "IBLOCK_ID" => $IBLOCK_ID, "NAME" => $category["#"], "CODE"=>$CODE);
    $ID = $bs->Add($arFields);
    }
    arshow($ID);

    }*/

    //Массив соответствий разделов
    $arSection = array(
      /*  "1" => "276",
        "26" => "277",
        "27" => "278",
        "21" => "279",
        "9" => "280",
        "12" => "281",
        "8" => "282",
        "29" => "283",
        "2" => "284",  */
        "10" => "306",
      /*  "3" => "286",
        "15" => "287",
        "4" => "288",
        "17" => "289", 
        "7" => "290", 
        "22" => "291", 
        "24" => "292", 
        "25" => "293",  */
    );

    foreach ($arData["yml_catalog"]["#"]["offers"]["0"]["#"]["offer"] as $offerPar) {
        //Собираем параметры
        foreach ($offerPar["#"]["param"] as $param ) {
            $arPar[$param["@"]["name"]][]=$param["#"];
        }
    }
    foreach ($arPar as $key=>$par) {
        $uniPar[$key]=array_unique($par); 
    }
    //arshow($uniPar);
    /*
    foreach ($uniPar["Цвет"] as $color) {
        arshow($color);
        $ibpenum = new CIBlockPropertyEnum;
        if($PropID = $ibpenum->Add(Array('PROPERTY_ID'=>'90', 'VALUE'=>$color)))
            echo $color.' ID:'.$PropID;
    }
    
    foreach ($uniPar["Направление"] as $color) {
        arshow($color);
        $ibpenum = new CIBlockPropertyEnum;
        if($PropID = $ibpenum->Add(Array('PROPERTY_ID'=>'91', 'VALUE'=>$color)))
            echo $color.' ID:'.$PropID;
    }
    
    foreach ($uniPar["dimensions"] as $color1) {
        arshow($color1);
        $ibpenum = new CIBlockPropertyEnum;
        if($PropID = $ibpenum->Add(Array('PROPERTY_ID'=>'92', 'VALUE'=>$color)))
            echo $color.' ID:'.$PropID;
    }
    
    foreach ($uniPar["Ширина"] as $color) {
        arshow($color);
        $ibpenum = new CIBlockPropertyEnum;
        if($PropID = $ibpenum->Add(Array('PROPERTY_ID'=>'93', 'VALUE'=>$color)))
            echo $color.' ID:'.$PropID;
    }
    
    foreach ($uniPar["Глубина"] as $color) {
        arshow($color);
        $ibpenum = new CIBlockPropertyEnum;
        if($PropID = $ibpenum->Add(Array('PROPERTY_ID'=>'94', 'VALUE'=>$color)))
            echo $color.' ID:'.$PropID;
    }
    
    foreach ($uniPar["Высота"] as $color) {
        arshow($color);
        $ibpenum = new CIBlockPropertyEnum;
        if($PropID = $ibpenum->Add(Array('PROPERTY_ID'=>'95', 'VALUE'=>$color)))
            echo $color.' ID:'.$PropID;
    } 
    
    foreach ($uniPar["Материал"] as $color) {
        arshow($color);
        $ibpenum = new CIBlockPropertyEnum;
        if($PropID = $ibpenum->Add(Array('PROPERTY_ID'=>'96', 'VALUE'=>$color)))
            echo $color.' ID:'.$PropID;
    }
    */
    $arPar='';
    //Цвет
    $property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$IBLOCK_ID, "CODE"=>"COLOR"));
    while($enum_fields = $property_enums->GetNext())    {
        $arEnumColor[$enum_fields["ID"]]=$enum_fields["VALUE"];
    }
    //Направление
    $property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$IBLOCK_ID, "CODE"=>"LINE"));
    while($enum_fields = $property_enums->GetNext())    {
        $arEnumLine[$enum_fields["ID"]]=$enum_fields["VALUE"];
    }
    //Материал
    $property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$IBLOCK_ID, "CODE"=>"MATERIAL"));
    while($enum_fields = $property_enums->GetNext())    {
        $arEnumMaterial[$enum_fields["ID"]]=$enum_fields["VALUE"];
    }
    
    $colors = array();
    
    $rsColors = CIBlockElement::GetList(array(),array("IBLOCK_ID"=>7),false,false,array("ID","NAME"));
    while($arColor = $rsColors->Fetch()) {
       $colors[$arColor["NAME"]] = $arColor["ID"]; 
    }

    foreach ($arData["yml_catalog"]["#"]["offers"]["0"]["#"]["offer"] as $offer) {
        
        if ($arSection[$offer["#"]["categoryId"]["0"]["#"]] != 306) {
            continue;
        }
         $arPar = array();
        //Собираем параметры
        foreach ($offer["#"]["param"] as $param ) {
            //arshow($param);
            $arPar[$param["@"]["name"]][]=$param["#"];
        }
        //arshow($arPar);



        $PROP = array();

        foreach ($arPar["Цвет"] as $arrProp) {
           // $PROP[90][] = array_keys($arEnumColor, $arrProp)["0"];
            $PROP[98][] = $colors[$arrProp];
           
        }
        
        foreach ($arPar["Направление"] as $arrProp) {
            $PROP[91][]=array_keys($arEnumLine, $arrProp)["0"];
        }
        
        $PROP[92]=$arPar["dimensions"][0];
        $PROP[93]=$arPar["Ширина"][0];
        $PROP[94]=$arPar["Глубина"][0];
        $PROP[95]=$arPar["Высота"][0];
        foreach ($arPar["Материал"] as $arrProp) {
            $PROP[96][]=array_keys($arEnumMaterial, $arrProp)["0"];
        }
        $PROP[97] = $offer["#"]["vendorCode"]["0"]["#"]; 

        $CODE='';
        
        $name = trim($offer["#"]["name"]["0"]["#"]);
        
        $arParams = array("replace_space"=>"_","replace_other"=>"-");
        $CODE = Cutil::translit($name,"ru",$arParams);
        if(count(array_keys($arCode, $CODE))>=1){
            $arCode[]=$CODE;
            $postFix=count(array_keys($arCode, $CODE))-1;
            $CODE=$CODE.'_'.$postFix;
        } else {
            $arCode[]=$CODE;
        }
        /* $current_img=file_get_contents($offer["#"]["picture"]["0"]["#"]);
        $file='http://expro.webgk.net/img/catalog/'.$CODE.'.jpg';
        file_put_contents($file, $current_img);*/

        /* $file =  './img/catalog/'.$CODE.'.jpg';
        $ch = curl_init($offer["#"]["picture"]["0"]["#"]);
        $fp = fopen($file, 'a+');
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);*/

        /*  $url = $offer["#"]["picture"]["0"]["#"];
        $path = './img/catalog/'.$CODE.'.jpg';
        file_put_contents($path, file_get_contents($url));*/

        $url = $offer["#"]["picture"]["0"]["#"];
        $path = $_SERVER["DOCUMENT_ROOT"].'/img/catalog/'.$CODE.'.jpg';
        if (!file_exists($path)) {
            download($url, $path);
        }
        $arFile = CFile::MakeFileArray($path);

        //arshow($arCode);
        //arshow($CODE);

        $arFields = Array(
            "ACTIVE" => "Y",
            "NAME" => $name,
            "CODE" => $CODE,
            "IBLOCK_ID" => $IBLOCK_ID,
            "IBLOCK_SECTION_ID" => $arSection[$offer["#"]["categoryId"]["0"]["#"]],  
            "PROPERTY_VALUES" => $PROP,       
            "DETAIL_PICTURE" => $arFile  
        );
        arshow($arFields);
        //Добавляем элемент в инфоблок
        $el = new CIBlockElement;
        if($PRODUCT_ID = $el->Add($arFields))
            echo "New ID: ".$PRODUCT_ID;
        else
            echo "Error: ".$el->LAST_ERROR;
        //Добавляем товар
        $arCatFields = array(
            "ID" => $PRODUCT_ID, 
            "VAT_ID" => 1, //выставляем тип ндс (задается в админке)  
            "VAT_INCLUDED" => "Y" //НДС входит в стоимость
        );
        if(CCatalogProduct::Add($arCatFields))
            echo "Добавили параметры товара к элементу каталога ".$PRODUCT_ID.'<br>';
        else
            echo 'Ошибка добавления параметров<br>';

        //Добавляем цену
        $PRICE_TYPE_ID = 1;
        $priceFields = Array(
            "PRODUCT_ID" => $PRODUCT_ID,
            "CATALOG_GROUP_ID" => $PRICE_TYPE_ID,
            "PRICE" => $offer["#"]["price"]["0"]["#"],
            "CURRENCY" => "RUB",
        );
        CPrice::Add($priceFields);
        $arPar='';    
    }

    //arshow($arFields);
    echo 'еке'; 
    curl_close($ch);
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>