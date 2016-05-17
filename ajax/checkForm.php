<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>
<?
    switch ($_POST["form"]) {
        case "authForm":
            //����������� ������������
            if (!is_object($USER)) $USER = new CUser;
            $res = $USER->Login($_POST["email"],$_POST["pass"],'N','Y');
            if (!is_array($res)) {
                echo "OK";
            }   

            break;

            //////////////////////

            //����������� ������������
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
                case "Y":  //����� ����� 
                    $dealerType = "�����";
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

                case "N":  //����������� �����
                    $dealerType = "�����������";
                    $PROP["DEALER_TYPE"] = 8035;
                    $PROP["PHONE"] = $data["PHONE"];
                    $PROP["FIO"] = $data["FIO"];
                    $PROP["EMAIL"] = $data["EMAIL"];
                    $arLoadProductArray["NAME"] = $data["NAME"];

                    break;
            }      

            $arLoadProductArray["PROPERTY_VALUES"] = $PROP;


            if($PRODUCT_ID = $el->Add($arLoadProductArray)) {                  

                //////////�������� ������////////////
                $mesData = "";
                $mesData .= "��� ������: ".$dealerType."<br>";
                $mesData .= "�������� ��������: ".$arLoadProductArray["NAME"]."<br>";
                $mesData .= "��� ����������� ����: ".$PROP["FIO"]."<br>";
                $mesData .= "�������: ".$PROP["PHONE"]."<br>";
                $mesData .= "Email: ".$PROP["EMAIL"]."<br>";
                $mesData .= "���������� ���������: ".$PROP["BANK_PROPS"]."<br>";
                $mesData .= "����������� �����: ".$PROP["LEGAL_ADDRESS"]."<br>";
                $mesData .= "���������� �����: ".$PROP["FACT_ADDRESS"]."<br>";
                $mesData .= "����: ".$PROP["SITE"]."<br>";
                $mesData .= "����� ������: ".$PROP["WAREHOUSE"]."<br>";  

                $arData = array(
                    "THEME" => "����� ������ �� ����������� ������ �� ����� expro.ru",
                    "DATA" => $mesData,
                );   
                CEvent::Send("NEW_FORM_SUBMIT", SITE_ID, $arData, "Y", 38);
                //////////////////////////////////////

                echo "OK";
            }
            else {
                echo "������: ".$el->LAST_ERROR;
            }

            break;

            //�������� ������
        case "orderProject":
            $data = array();
            foreach ($_POST as $k=>$p) {
                $data[$k] = iconv("UTF-8","CP1251",$p); 
            } 

            $el = new CIBlockElement;    
            $PROP = array();
            $arLoadProductArray = Array(
                "MODIFIED_BY"    => $USER->GetID(), // ������� ������� ������� �������������
                "IBLOCK_SECTION_ID" => false,          // ������� ����� � ����� �������
                "IBLOCK_ID"      => 23,    
                "ACTIVE"         => "Y",            // �������
            );    

            $PROP["PHONE"] = $data["PHONE"];
            $PROP["FIO"] = $data["FIO"];
            $PROP["EMAIL"] = $data["EMAIL"]; 
            $arLoadProductArray["NAME"] = $data["NAME"];    
            $arLoadProductArray["PREVIEW_TEXT"] = $data["COMMENT"];   
            $arLoadProductArray["PROPERTY_VALUES"] = $PROP;


            if($PRODUCT_ID = $el->Add($arLoadProductArray)) {

                //////////�������� ������////////////
                $mesData = "";
                $mesData .= "�������� ��������: ".$arLoadProductArray["NAME"]."<br>";
                $mesData .= "��� ����������� ����: ".$PROP["FIO"]."<br>";
                $mesData .= "�������: ".$PROP["PHONE"]."<br>";
                $mesData .= "Email: ".$PROP["EMAIL"]."<br>";
                $mesData .= "�����������: ".$arLoadProductArray["PREVIEW_TEXT"]."<br>";  

                $arData = array(
                    "THEME" => "����� ������ '�������� ������' �� ����� expro.ru",
                    "DATA" => $mesData,
                );   
                CEvent::Send("NEW_FORM_SUBMIT", SITE_ID, $arData, "Y", 38);
                ///////////////////////////////////////

                echo "OK";
            }
            else {
                echo "������: ".$el->LAST_ERROR;
            }
            break;



            //�������� ������
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

                //////////�������� ������////////////
                $mesData = "";
                $mesData .= "��� ����������� ����: ".$arLoadProductArray["NAME"]."<br>";
                $mesData .= "�������: ".$PROP["PHONE"]."<br>";
                $mesData .= "�����������: ".$arLoadProductArray["PREVIEW_TEXT"]."<br>";  

                $arData = array(
                    "THEME" => "����� ������ '�������� ������' �� ����� expro.ru",
                    "DATA" => $mesData,
                );   
                CEvent::Send("NEW_FORM_SUBMIT", SITE_ID, $arData, "Y", 38);
                ///////////////////////////////////////

                echo "OK";
            }
            else {
                echo "������: ".$el->LAST_ERROR;
            }
            break;


            //�������� ������
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

                //////////�������� ������////////////
                $mesData = "";
                $mesData .= "�������� ��������: ".$arLoadProductArray["NAME"]."<br>";
                $mesData .= "��� ����������� ����: ".$arLoadProductArray["CONTACT_NAME"]."<br>";                    
                $mesData .= "������� ����������� ����: ".$PROP["CONTACT_PHONE"]."<br>";
                $mesData .= "Email ����������� ����: ".$PROP["CONTACT_EMAIL"]."<br>";
                $mesData .= "�����������: ".$arLoadProductArray["PREVIEW_TEXT"]."<br>";     

                $arData = array(
                    "THEME" => "����� ������ '�������� �����' �� ����� expro.ru",
                    "DATA" => $mesData,
                );   
                CEvent::Send("NEW_FORM_SUBMIT", SITE_ID, $arData, "Y", 38);
                ///////////////////////////////////////

                echo "OK";
            }
            else {
                echo "������: ".$el->LAST_ERROR;
            }
            break;



            //������ ������� ����    
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

                //////////�������� ������////////////
                $product = CIBLockElement::GetList(array(),array("ID"=>$PROP["PRODUCT"]))->GetNext(); 

                $mesData = "";
                $mesData .= "��� ����������� ����: ".$arLoadProductArray["NAME"]."<br>";
                $mesData .= "�������: ".$PROP["PHONE"]."<br>";
                $mesData .= "Email: ".$PROP["EMAIL"]."<br>";
                $mesData .= "�����: <a href='http://expro.ru".$product["DETAIL_PAGE_URL"]."'>".$product["NAME"]."</a><br>";

                $arData = array(
                    "THEME" => "����� ������ '������ ������� ����' �� ����� expro.ru",
                    "DATA" => $mesData,
                );   
                CEvent::Send("NEW_FORM_SUBMIT", SITE_ID, $arData, "Y", 38);
                ///////////////////////////////////////

                echo "OK";
            }
            else {
                echo "������: ".$el->LAST_ERROR;
            }



            break;   
    }        

?>