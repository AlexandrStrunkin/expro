<?   
    CModule::IncludeModule("iblock");
    
    

    function arshow($array, $adminCheck = false){
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



    //get top parents
    function getTopParent($id){
        if ($id) {
            $tt = CIBlockSection::GetList(array(), array('ID'=>$id));
            $as=$tt->Fetch();
            static $a;
            if($as['DEPTH_LEVEL']==1) {$a = $as;}
            else{         
                getTopParent($as['IBLOCK_SECTION_ID']);
            }
            return $a;
        }
        else 
            return "";
    }



    //функция генерации символьного кода для элементов каталога 
    //$name - имя товара, $num - постфикс, если ноль, то ничего не прибавляем, если > 0, то дописываем его к имени: имя_$num
    function getSymbolCode($name,$num=0) {             
        //генерим символьный код
        if ($num <= 0) {
            $code = Cutil::translit($name, "ru", array());
        }           
        else  {
            $code = Cutil::translit($name, "ru", array())."_".$num;
        }            

        //проверяем существование элемента в каталоге
        $el = CIBlockElement::GetList(array(), array("IBLOCK_ID"=>23,"CODE"=>$code),false, false, array("ID"));
        //если элемент с текущим символьным кодом существует, то вызываем функцию еще раз, добавив к символьному коду единицу 

        if ($el->SelectedRowsCount() > 0) {
            //  echo "count: ".$el->SelectedRowsCount()."<br>";    
            $code = getSymbolCode($name,$num+1);   
        }       

        return $code;

    } 
?>