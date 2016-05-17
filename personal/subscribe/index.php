<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Рассылки");       
if (!$USER->IsAuthorized()) {
    header("location: /personal/");
}
?><?$APPLICATION->IncludeComponent(
	"webgk:subscribe.edit", 
	"subscribe", 
	array(
		"AJAX_MODE" => "N",
		"SHOW_HIDDEN" => "N",
		"ALLOW_ANONYMOUS" => "N",
		"SHOW_AUTH_LINKS" => "N",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "36000000",
		"SET_TITLE" => "N",
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"COMPONENT_TEMPLATE" => "subscribe",
		"AJAX_OPTION_ADDITIONAL" => "undefined"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>