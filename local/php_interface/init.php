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



    //������� ��������� ����������� ���� ��� ��������� �������� 
    //$name - ��� ������, $num - ��������, ���� ����, �� ������ �� ����������, ���� > 0, �� ���������� ��� � �����: ���_$num
    function getSymbolCode($name,$num=0) {             
        //������� ���������� ���
        if ($num <= 0) {
            $code = Cutil::translit($name, "ru", array());
        }           
        else  {
            $code = Cutil::translit($name, "ru", array())."_".$num;
        }            

        //��������� ������������� �������� � ��������
        $el = CIBlockElement::GetList(array(), array("IBLOCK_ID"=>23,"CODE"=>$code),false, false, array("ID"));
        //���� ������� � ������� ���������� ����� ����������, �� �������� ������� ��� ���, ������� � ����������� ���� ������� 

        if ($el->SelectedRowsCount() > 0) {
            //  echo "count: ".$el->SelectedRowsCount()."<br>";    
            $code = getSymbolCode($name,$num+1);   
        }       

        return $code;

    } 
?>