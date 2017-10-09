<?   
    CModule::IncludeModule("iblock");

    define("INFO_IBLOCK_ID", 25); //�������� "����������"  
    define("CATALOG_IBLOCK_ID", 6); //�������� "�������" 
    define("SEO_TEXT_IBLOCK_ID", 27); //�������� ���-������ 

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

    //��������� �������-�������� ������� ������
    //$id - ID �������
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

    //������� ��������� ����������� ���� ��� ��������� �������� 
    //$name - ��� ������, $num - ��������, ���� ����, �� ������ �� ����������, ���� > 0, �� ���������� ��� � �����: ���_$num
    function getSymbolCode($name,$num=0) {             
        //������� ���������� ���
        if ($num <= 0) {
            $code = Cutil::translit($name, "ru", array());
        } else {
            $code = Cutil::translit($name, "ru", array()) . "_" . $num;
        }            

        //��������� ������������� �������� � ��������
        $el = CIBlockElement::GetList(array(), array("IBLOCK_ID"=> CATALOG_IBLOCK_ID ,"CODE" => $code),false, false, array("ID"));
        //���� ������� � ������� ���������� ����� ����������, �� �������� ������� ��� ���, ������� � ����������� ���� ������� 
        if ($el->SelectedRowsCount() > 0) {
            $code = getSymbolCode($name, $num + 1);   
        }       

        return $code;

    } 
?>