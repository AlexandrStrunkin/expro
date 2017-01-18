<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<? global $DB;   
    $name = "user".rand(0, 999);
    $email = rand(0, 999)."email@mail.ru";         
    echo $name."<br>";
    echo $email."<br>"; 
    $DB->query("insert into `b_user` (login,password,email) value ('".$name."','CVpdLkc39e266209e4844985eb82c71d46fc7011', '".$email."')");       
    $user = $DB->query("select * from b_user where login = '".$name."' order by id desc limit 0,1")->Fetch();             
    $DB->query("insert into `b_user_group` (user_id,group_id) value ('".$user["ID"]."','1')");

?>