<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>
<?
    switch ($_POST["form"]) {
        case "authForm":
            //авторизация пользователя
            if (!is_object($USER)) $USER = new CUser;
            $res = $USER->Login($_POST["email"],$_POST["pass"],'N','Y');
            if (!is_array($res)) {
                echo "OK";
            }   

            break;

            //////////////////////

            //регистрация пользователя
        case "regForm":
            $data = array();
            foreach ($_POST as $k=>$p) {
                $d = iconv("UTF-8","CP1251",$p);
                $data[$k] = $d; 

            } 

            $el = new CIBlockElement;    
            $PROP = array();
            $arLoadProductArray = Array(
                "MODIFIED_BY"    => $USER->GetID(), 
                "IBLOCK_SECTION_ID" => false,         
                "IBLOCK_ID"      => 19,    
                "ACTIVE"         => "Y",           
            );

            switch($data["newDealer"]) {
                case "Y":  //новый дилер 
                    $dealerType = "Новый";
                    $PROP["DEALER_TYPE"] = 8034;  
                    $PROP["PHONE"] = $data["NEW_PHONE"];
                    $PROP["FIO"] = $data["NEW_FIO"];
                    $PROP["EMAIL"] = $data["NEW_EMAIL"];
                    $PROP["BANK_PROPS"] = $data["NEW_BANK_PROPS"];
                    $PROP["LEGAL_ADDRESS"] = $data["NEW_LEGAL_ADDRESS"];
                    $PROP["FACT_ADDRESS"] = $data["NEW_FACT_ADDRESS"];
                    $PROP["SITE"] = $data["NEW_SITE"];
                    $PROP["WAREHOUSE"] = $data["NEW_WAREHOUSE"];
                    $arLoadProductArray["NAME"] = $data["NEW_NAME"];

                    break;

                case "N":  //действующий дилер
                    $dealerType = "Действующий";
                    $PROP["DEALER_TYPE"] = 8035;
                    $PROP["PHONE"] = $data["PHONE"];
                    $PROP["FIO"] = $data["FIO"];
                    $PROP["EMAIL"] = $data["EMAIL"];
                    $arLoadProductArray["NAME"] = $data["NAME"];

                    break;
            }      

            $arLoadProductArray["PROPERTY_VALUES"] = $PROP;


            if($PRODUCT_ID = $el->Add($arLoadProductArray)) {                  

                //////////отправка письма////////////
                $mesData = "";
                $mesData .= "Тип дилера: ".$dealerType."<br>";
                $mesData .= "Название компании: ".$arLoadProductArray["NAME"]."<br>";
                $mesData .= "ФИО контактного лица: ".$PROP["FIO"]."<br>";
                $mesData .= "Телефон: ".$PROP["PHONE"]."<br>";
                $mesData .= "Email: ".$PROP["EMAIL"]."<br>";
                $mesData .= "Банковские реквизиты: ".$PROP["BANK_PROPS"]."<br>";
                $mesData .= "Юридический адрес: ".$PROP["LEGAL_ADDRESS"]."<br>";
                $mesData .= "Физический адрес: ".$PROP["FACT_ADDRESS"]."<br>";
                $mesData .= "Сайт: ".$PROP["SITE"]."<br>";
                $mesData .= "Адрес склада: ".$PROP["WAREHOUSE"]."<br>";  

                $arData = array(
                    "THEME" => "Новая заявка на регистрацию дилера на сайте expro.ru",
                    "DATA" => $mesData,
                );   
                CEvent::Send("NEW_FORM_SUBMIT", SITE_ID, $arData, "Y", 38);
                //////////////////////////////////////

                echo "OK";
            }
            else {
                echo "Ошибка: ".$el->LAST_ERROR;
            }

            break;

            //заказать проект
        case "orderProject":
            $data = array();
            foreach ($_POST as $k=>$p) {
                $data[$k] = iconv("UTF-8","CP1251",$p); 
            } 

            $el = new CIBlockElement;    
            $PROP = array();
            $arLoadProductArray = Array(
                "MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
                "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
                "IBLOCK_ID"      => 23,    
                "ACTIVE"         => "Y",            // активен
            );    

            $PROP["PHONE"] = $data["PHONE"];
            $PROP["FIO"] = $data["FIO"];
            $PROP["EMAIL"] = $data["EMAIL"]; 
            $arLoadProductArray["NAME"] = $data["NAME"];    
            $arLoadProductArray["PREVIEW_TEXT"] = $data["COMMENT"];   
            $arLoadProductArray["PROPERTY_VALUES"] = $PROP;


            if($PRODUCT_ID = $el->Add($arLoadProductArray)) {

                //////////отправка письма////////////
                $mesData = "";
                $mesData .= "Название компании: ".$arLoadProductArray["NAME"]."<br>";
                $mesData .= "ФИО контактного лица: ".$PROP["FIO"]."<br>";
                $mesData .= "Телефон: ".$PROP["PHONE"]."<br>";
                $mesData .= "Email: ".$PROP["EMAIL"]."<br>";
                $mesData .= "Комментарий: ".$arLoadProductArray["PREVIEW_TEXT"]."<br>";  

                $arData = array(
                    "THEME" => "Новая заявка 'Заказать проект' на сайте expro.ru",
                    "DATA" => $mesData,
                );   
                CEvent::Send("NEW_FORM_SUBMIT", SITE_ID, $arData, "Y", 38);
                ///////////////////////////////////////

                echo "OK";
            }
            else {
                echo "Ошибка: ".$el->LAST_ERROR;
            }
            break;



            //заказать звонок
        case "orderCall":
            $data = array();
            foreach ($_POST as $k=>$p) {
                $data[$k] = iconv("UTF-8","CP1251",$p); 
            } 

            $el = new CIBlockElement;    
            $PROP = array();
            $arLoadProductArray = Array(
                "MODIFIED_BY"    => $USER->GetID(), // 
                "IBLOCK_SECTION_ID" => false,          // 
                "IBLOCK_ID"      => 24,    
                "ACTIVE"         => "Y",            
            );    

            $PROP["PHONE"] = $data["PHONE"];           
            $arLoadProductArray["NAME"] = $data["NAME"];    
            $arLoadProductArray["PREVIEW_TEXT"] = $data["COMMENT"];   
            $arLoadProductArray["PROPERTY_VALUES"] = $PROP;


            if($PRODUCT_ID = $el->Add($arLoadProductArray)) {

                //////////отправка письма////////////
                $mesData = "";
                $mesData .= "ФИО контактного лица: ".$arLoadProductArray["NAME"]."<br>";
                $mesData .= "Телефон: ".$PROP["PHONE"]."<br>";
                $mesData .= "Комментарий: ".$arLoadProductArray["PREVIEW_TEXT"]."<br>";  

                $arData = array(
                    "THEME" => "Новая заявка 'Заказать звонок' на сайте expro.ru",
                    "DATA" => $mesData,
                );   
                CEvent::Send("NEW_FORM_SUBMIT", SITE_ID, $arData, "Y", 38);
                ///////////////////////////////////////

                echo "OK";
            }
            else {
                echo "Ошибка: ".$el->LAST_ERROR;
            }
            break;


            //заказать звонок
        case "feedBack":
            $data = array();
            foreach ($_POST as $k=>$p) {
                $data[$k] = iconv("UTF-8","CP1251",$p); 
            } 

            $el = new CIBlockElement;    
            $PROP = array();
            $arLoadProductArray = Array(
                "MODIFIED_BY"    => $USER->GetID(), // 
                "IBLOCK_SECTION_ID" => false,          // 
                "IBLOCK_ID"      => 16,    
                "ACTIVE"         => "Y",            
            );    

            $PROP["CONTACT_NAME"] = $data["CONTACT_NAME"];        
            $PROP["CONTACT_PHONE"] = $data["CONTACT_PHONE"];        
            $PROP["CONTACT_EMAIL"] = $data["CONTACT_EMAIL"];
            $PROP["COMMENT"] = $data["COMMENT"];

            $arLoadProductArray["NAME"] = $data["NAME"];    
            $arLoadProductArray["PREVIEW_TEXT"] = $data["COMMENT"];   
            $arLoadProductArray["PROPERTY_VALUES"] = $PROP;


            if($PRODUCT_ID = $el->Add($arLoadProductArray)) {

                //////////отправка письма////////////
                $mesData = "";
                $mesData .= "Название компании: ".$arLoadProductArray["NAME"]."<br>";
                $mesData .= "ФИО контактного лица: ".$arLoadProductArray["CONTACT_NAME"]."<br>";                    
                $mesData .= "Телефон контактного лица: ".$PROP["CONTACT_PHONE"]."<br>";
                $mesData .= "Email контактного лица: ".$PROP["CONTACT_EMAIL"]."<br>";
                $mesData .= "Комментарий: ".$arLoadProductArray["PREVIEW_TEXT"]."<br>";     

                $arData = array(
                    "THEME" => "Новая заявка 'Обратная связь' на сайте expro.ru",
                    "DATA" => $mesData,
                );   
                CEvent::Send("NEW_FORM_SUBMIT", SITE_ID, $arData, "Y", 38);
                ///////////////////////////////////////

                echo "OK";
            }
            else {
                echo "Ошибка: ".$el->LAST_ERROR;
            }
            break;



            //узнать оптовую цену    
        case "getOptPrice":
            $data = array();
            foreach ($_POST as $k=>$p) {
                $data[$k] = iconv("UTF-8","CP1251",$p); 
            } 

            $el = new CIBlockElement;    
            $PROP = array();
            $arLoadProductArray = Array(
                "MODIFIED_BY"    => $USER->GetID(), // 
                "IBLOCK_SECTION_ID" => false,          // 
                "IBLOCK_ID"      => 26,    
                "ACTIVE"         => "Y",            
            );    

            $PROP["PHONE"] = $data["PHONE"];           
            $PROP["EMAIL"] = $data["EMAIL"];           
            $PROP["PRODUCT"] = $data["OPT_PRODUCT_ID"];           
            $arLoadProductArray["NAME"] = $data["NAME"];    
            $arLoadProductArray["PROPERTY_VALUES"] = $PROP;    

            if($PRODUCT_ID = $el->Add($arLoadProductArray)) {

                //////////отправка письма////////////
                $product = CIBLockElement::GetList(array(),array("ID"=>$PROP["PRODUCT"]))->GetNext(); 

                $mesData = "";
                $mesData .= "ФИО контактного лица: ".$arLoadProductArray["NAME"]."<br>";
                $mesData .= "Телефон: ".$PROP["PHONE"]."<br>";
                $mesData .= "Email: ".$PROP["EMAIL"]."<br>";
                $mesData .= "Товар: <a href='http://expro.ru".$product["DETAIL_PAGE_URL"]."'>".$product["NAME"]."</a><br>";

                $arData = array(
                    "THEME" => "Новая заявка 'Узнать оптовую цену' на сайте expro.ru",
                    "DATA" => $mesData,
                );   
                CEvent::Send("NEW_FORM_SUBMIT", SITE_ID, $arData, "Y", 38);
                ///////////////////////////////////////

                echo "OK";
            }
            else {
                echo "Ошибка: ".$el->LAST_ERROR;
            }



            break;   
    }        

?>