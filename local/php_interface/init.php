<?   
    CModule::IncludeModule("iblock");

    define("INFO_IBLOCK_ID", 25); //инфоблок "информация"  
    define("CATALOG_IBLOCK_ID", 6); //инфоблок "каталог" 
    define("SEO_TEXT_IBLOCK_ID", 27); //инфоблок сео-тексты 

    function arshow($array, $adminCheck = false) {
        global $USER;
        $USER = new Cuser;
        if ($adminCheck) {
            if (!$USER->IsAdmin()) {
                return false;
            } 
        }
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }                                            

    //получение раздела-родителя первого уровня
    //$id - ID раздела
    function getTopParent($id) {
        if (intval($id) > 0) {
            $rsSection = CIBlockSection::GetList(array(), array('ID' => $id));
            $arSection = $rsSection->Fetch();
            static $a;
            if($arSection['DEPTH_LEVEL'] == 1) {
                $a = $arSection;
            } else {         
                getTopParent($arSection['IBLOCK_SECTION_ID']);
            }
            return $a;
        } else {
            return false;
        }
    }         

    //функция генерации символьного кода для элементов каталога 
    //$name - имя товара, $num - постфикс, если ноль, то ничего не прибавляем, если > 0, то дописываем его к имени: имя_$num
    function getSymbolCode($name,$num=0) {             
        //генерим символьный код
        if ($num <= 0) {
            $code = Cutil::translit($name, "ru", array());
        } else {
            $code = Cutil::translit($name, "ru", array()) . "_" . $num;
        }            

        //проверяем существование элемента в каталоге
        $el = CIBlockElement::GetList(array(), array("IBLOCK_ID"=> CATALOG_IBLOCK_ID ,"CODE" => $code),false, false, array("ID"));
        //если элемент с текущим символьным кодом существует, то вызываем функцию еще раз, добавив к символьному коду единицу 
        if ($el->SelectedRowsCount() > 0) {
            $code = getSymbolCode($name, $num + 1);   
        }       

        return $code;

    } 
?>