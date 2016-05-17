<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");?>
<?
    if ($_REQUEST["set_catalog_view"] == "table" || $_REQUEST["set_catalog_view"] == "blocks") {
        $_SESSION["CATALOG_VIEW"] = $_REQUEST["set_catalog_view"]; 
        echo "OK";        
    }
    else {
        echo "error";
    }
?>