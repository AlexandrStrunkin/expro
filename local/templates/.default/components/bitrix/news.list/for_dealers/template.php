<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
    /** @var array $arParams */
    /** @var array $arResult */
    /** @global CMain $APPLICATION */
    /** @global CUser $USER */
    /** @global CDatabase $DB */
    /** @var CBitrixComponentTemplate $this */
    /** @var string $templateName */
    /** @var string $templateFile */
    /** @var string $templateFolder */
    /** @var string $componentPath */
    /** @var CBitrixComponent $component */
    $this->setFrameMode(true);
?>

 <div class="dialer">
<div class="advantages">
    <h3>Преимущества работы с нами</h3>
    <ul>
        <?foreach($arResult["ITEMS"] as $arItem):?>
            <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>              
            <li id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <div class="img"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="" /></div>
                <div class="title">
                    <?=$arItem["NAME"]?>
                </div>
            </li>
            <?endforeach;?>
    </ul>
 </div>
 
 
 <div class="become-dealer">
        <h3>Как стать дилером</h3>
        <div class="become-dealer-block1">
            <ol>
                <li>Заполните заявку.</li>
                <li>В течение <span>одного рабочего дня</span> с Вами свяжется наш <br /> менеджер.</li>
                <li>Вы получите:</li>
            </ol>
            <ul>
                <li>Оптовые прайс-листы нашей продукции</li>
                <li>Условия работы и образцы необходимой документации</li>
                <li>Материалы для размещения на сайте</li>
                <li>Инструкции для сборки</li>
                <li>Техническую информацию для участия в тендерах</li>
                <li>Каталоги, буклеты и другие рекламные материалы</li>
                <li>Нашу поддержку и внимание</li>
            </ul>
        </div>
        <div class="become-dealer-block2">
            <h3>Оформление заявки</h3>
            
            <form action="#" method="post" class="allform" id="regForm">
                <div class="form_error"></div>
                <div class="form_success">Ваша заявка отправлена. Мы обязательно свяжемся с вами! Спасибо!</div>
                <input type="hidden" name="form" value="regForm">    
                <input type="hidden" id="newDealer" value="Y" name="newDealer">               
                <label class="left">
                    <input type="text" class="req input" placeholder="Введите название вашей организации" value="" name="NEW_NAME" autocomplete="off"/><span class="i">*</span>
                </label>
                <label class="right">
                    <input type="text" class="req input" placeholder="Юридический адрес" value="" name="NEW_LEGAL_ADDRESS" autocomplete="off"/><span class="i">*</span>
                </label>
                <label class="center">
                    <input type="text" class="input" placeholder="Введите банковские ревкизиты вашей организации" value="" name="NEW_BANK_PROPS" autocomplete="off"/>
                </label>
                <label class="left">
                    <input type="text" class="req input" placeholder="Фактический адрес" value="" name="NEW_FACT_ADDRESS" autocomplete="off"/><span class="i">*</span>
                </label>
                <label class="right">
                    <input type="text" class="req input" placeholder="Адрес склада (при наличии)" value="" name="NEW_WAREHOUSE" autocomplete="off"/>
                </label>
                <label class="left">
                    <input type="text" class="input" placeholder="Адрес сайта" value="" name="NEW_SITE" autocomplete="off"/><span class="i">*</span>
                </label>
                <label class="right">
                    <input type="text" class="req input" placeholder="ФИО контактного лица" value="" name="NEW_FIO" autocomplete="off"/><span class="i">*</span>
                </label>
                <label class="left">
                    <input type="text" class="phone input" placeholder="Телефон контактного лица для связи" value="" name="NEW_PHONE" autocomplete="off"/><span class="i">*</span>
                </label>
                <label class="right">
                    <input type="text" class="req input" placeholder="E-mail контактного лица для связи" value="" name="NEW_EMAIL" autocomplete="off"/><span class="i">*</span>
                </label>
                <div class="mes">Отмеченные поля, обязательны для заполнения</div>
                <button type="button" class="submit" onclick="personalFormSubmit('regForm')">Отправить</button>
                <button type="reset" class="reset">Очистить</button>
            </form>
        </div>
    </div>

    </div>
   
        


