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
    <h3>������������ ������ � ����</h3>
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
        <h3>��� ����� �������</h3>
        <div class="become-dealer-block1">
            <ol>
                <li>��������� ������.</li>
                <li>� ������� <span>������ �������� ���</span> � ���� �������� ��� <br /> ��������.</li>
                <li>�� ��������:</li>
            </ol>
            <ul>
                <li>������� �����-����� ����� ���������</li>
                <li>������� ������ � ������� ����������� ������������</li>
                <li>��������� ��� ���������� �� �����</li>
                <li>���������� ��� ������</li>
                <li>����������� ���������� ��� ������� � ��������</li>
                <li>��������, ������� � ������ ��������� ���������</li>
                <li>���� ��������� � ��������</li>
            </ul>
        </div>
        <div class="become-dealer-block2">
            <h3>���������� ������</h3>
            
            <form action="#" method="post" class="allform" id="regForm">
                <div class="form_error"></div>
                <div class="form_success">���� ������ ����������. �� ����������� �������� � ����! �������!</div>
                <input type="hidden" name="form" value="regForm">    
                <input type="hidden" id="newDealer" value="Y" name="newDealer">               
                <label class="left">
                    <input type="text" class="req input" placeholder="������� �������� ����� �����������" value="" name="NEW_NAME" autocomplete="off"/><span class="i">*</span>
                </label>
                <label class="right">
                    <input type="text" class="req input" placeholder="����������� �����" value="" name="NEW_LEGAL_ADDRESS" autocomplete="off"/><span class="i">*</span>
                </label>
                <label class="center">
                    <input type="text" class="input" placeholder="������� ���������� ��������� ����� �����������" value="" name="NEW_BANK_PROPS" autocomplete="off"/>
                </label>
                <label class="left">
                    <input type="text" class="req input" placeholder="����������� �����" value="" name="NEW_FACT_ADDRESS" autocomplete="off"/><span class="i">*</span>
                </label>
                <label class="right">
                    <input type="text" class="req input" placeholder="����� ������" value="" name="NEW_WAREHOUSE" autocomplete="off"/>
                </label>
                <label class="left">
                    <input type="text" class="input" placeholder="����� �����" value="" name="NEW_SITE" autocomplete="off"/><span class="i">*</span>
                </label>
                <label class="right">
                    <input type="text" class="req input" placeholder="��� ����������� ����" value="" name="NEW_FIO" autocomplete="off"/><span class="i">*</span>
                </label>
                <label class="left">
                    <input type="text" class="phone input" placeholder="������� ����������� ���� ��� �����" value="" name="NEW_PHONE" autocomplete="off"/><span class="i">*</span>
                </label>
                <label class="right">
                    <input type="text" class="req input" placeholder="E-mail ����������� ���� ��� �����" value="" name="NEW_EMAIL" autocomplete="off"/><span class="i">*</span>
                </label>
                <div class="mes">���������� ����, ����������� ��� ����������</div>
                <button type="button" class="submit" onclick="personalFormSubmit('regForm')">���������</button>
                <button type="reset" class="reset">��������</button>
            </form>
        </div>
    </div>

    </div>
   
        


