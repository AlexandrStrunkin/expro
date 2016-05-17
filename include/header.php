<div class="mainCatalogPopup">
    <div class="mainCatalogPopupContainer">
        <div class="mainCatalogPopupTitle">Каталог продукции</div> 

        <?$APPLICATION->IncludeComponent(
                "bitrix:catalog.section.list", 
                "popupCatalog", 
                array(
                    "IBLOCK_ID" => "6",
                    "COMPONENT_TEMPLATE" => ".default",
                    "IBLOCK_TYPE" => "catalog",
                    "SECTION_ID" => $_REQUEST["SECTION_ID"],
                    "SECTION_CODE" => "",
                    "COUNT_ELEMENTS" => "N",
                    "TOP_DEPTH" => "3",
                    "SECTION_FIELDS" => array(
                        0 => "",
                        1 => "",
                    ),
                    "SECTION_USER_FIELDS" => array(
                        0 => "",
                        1 => "",
                    ),
                    "VIEW_MODE" => "LIST",
                    "SHOW_PARENT_NAME" => "Y",
                    "SECTION_URL" => "/catalog/#SECTION_CODE_PATH#/",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "36000000",
                    "CACHE_GROUPS" => "N",
                    "ADD_SECTIONS_CHAIN" => "Y"
                ),
                false
            );?>
    </div>

    <div class="mainCatalogPopupClose" onclick="$('.mainCatalogPopup').fadeOut()">&#10005;</div>
</div>


<div class="mainAboutPopup">
    <div class="mainCatalogPopupContainer">
        <div class="mainCatalogPopupTitle">О компании</div>

        <?$APPLICATION->IncludeComponent(
                "bitrix:menu", 
                "about_popup", 
                array(
                    "ROOT_MENU_TYPE" => "footer_company",
                    "MENU_CACHE_TYPE" => "Y",
                    "MENU_CACHE_TIME" => "36000000",
                    "MENU_CACHE_USE_GROUPS" => "N",
                    "MENU_CACHE_GET_VARS" => array(
                    ),
                    "MAX_LEVEL" => "1",
                    "USE_EXT" => "N",
                    "ALLOW_MULTI_SELECT" => "N",
                    "COMPONENT_TEMPLATE" => "about_popup",
                    "CHILD_MENU_TYPE" => "left",
                    "DELAY" => "N"
                ),
                false
            );?>     


    </div>

    <div class="mainCatalogPopupClose" onclick="$('.mainAboutPopup').fadeOut()">&#10005;</div>
</div>   


<div class="mainContactsPopup">
    <div class="mainCatalogPopupContainer">
        <div class="mainCatalogPopupTitle">Контакты</div>

        <?$APPLICATION->IncludeComponent(
                "bitrix:menu", 
                "about_popup", 
                array(
                    "ROOT_MENU_TYPE" => "footer_contacts",
                    "MENU_CACHE_TYPE" => "Y",
                    "MENU_CACHE_TIME" => "36000000",
                    "MENU_CACHE_USE_GROUPS" => "N",
                    "MENU_CACHE_GET_VARS" => array(
                    ),
                    "MAX_LEVEL" => "1",
                    "USE_EXT" => "N",
                    "ALLOW_MULTI_SELECT" => "N",
                    "COMPONENT_TEMPLATE" => "about_popup",
                    "CHILD_MENU_TYPE" => "left",
                    "DELAY" => "N"
                ),
                false
            );?>     


    </div>

    <div class="mainCatalogPopupClose" onclick="$('.mainContactsPopup').fadeOut()">&#10005;</div>
</div>         

<header class="header">
    <div class="header__wrapper">
        <?
            if ($USER->IsAuthorized()) {
                $name = trim($USER->GetFullName());
                if (! $name)
                    $name = trim($USER->GetLogin());
                if (strlen($name) > 15)
                    $name = substr($name, 0, 12).'...';
            ?>
            <div class="header__wrapper__buttons" >
            
                <div class="private_office1 btn_ico"><a href="/personal/"  style="width:130px"><?=htmlspecialcharsbx($name)?></a> <a class="logout" href="?logout=yes">Выйти</a></div>    
                <a class="client" href="http://market.expro.ru">Для розничных покупателей</a>
            </div>
            <?} else {?>
            <div class="header__wrapper__buttons">
                <a href="#login-popup" class="private_office2 btn_ico login-popup-link" >Войти</a>    
                <a class="client" href="http://market.expro.ru">Для розничных покупателей</a>
            </div>
            <?}?>

        <div class="header__wrapper__contacts_language">
            <div class="header__wrapper__contacts">
                <span class="address">
                    <?$APPLICATION->IncludeFile(SITE_DIR."include/address.php",Array(), Array("MODE"=>"html"));?>                    
                </span>
                <span class="topphone">
                    <?$APPLICATION->IncludeFile(SITE_DIR."include/top_phone.php",Array(), Array("MODE"=>"html"));?>
                </span>
            </div>

            <div class="header__wrapper__language">
                <!--<a href="#" class="active">RU</a>
                <a href="#">EN</a>-->
            </div>
        </div>      
    </div>     
    <div class="logotype">
        <a href="/">
            <?$APPLICATION->IncludeFile(SITE_DIR."include/name.php",Array(), Array("MODE"=>"html"));?>            
        </a>
    </div>

    <div class="clearboth"></div>

    <div class="main_link">
        <a href="#" class="main_link1"><span>Офисная мебель</span></a>
        <a href="http://hoteldsn.ru/" class="main_link2"><span>Гостиничная мебель</span></a>
    </div>       

    <?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"top_menu", 
	array(
		"ROOT_MENU_TYPE" => "top",
		"MENU_CACHE_TYPE" => "Y",
		"MENU_CACHE_TIME" => "36000000",
		"MENU_CACHE_USE_GROUPS" => "N",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "3",
		"USE_EXT" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"COMPONENT_TEMPLATE" => "top_menu",
		"CHILD_MENU_TYPE" => "submenu",
		"DELAY" => "N"
	),
	false
);?>
    
</header>