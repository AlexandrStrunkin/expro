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
<div class="advantages">
    <h3>���� ������ �� ������ � ����</h3>
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
        <li class="feedback-li">
            <h3>��������� � ����</h3>
            <div class="phone"> <?$APPLICATION->IncludeFile(SITE_DIR."include/feedback_phone.php",Array(), Array("MODE"=>"html"));?></div>
            <div class="bottom">
                <p>������� ��� <span>�� ��������</span> ��� ��������� <br />
                    ����� �������� �����.</p>
                <div class="mes">������������ ���� ��� ����������</div>
            </div>
        </li>
    </ul>
</div>

<!--become-dealer-->
<div class="become-dealer">
    <h3>�� ���������� ����� ������</h3>
    <div class="become-dealer-block1">
        <ul>
            <li><img src="/files/26.jpg" alt="" /></li>
            <li>
                <h3>���� ������</h3>
                <div class="text"> 20 +</div>
                <p>������ <span>��������</span> ��� <br />
                    ������ ��� ��������� ������ ���������</p>
            </li>
            <li>
                <h3>������� �����</h3>
                <div class="text"> 30 <span>1000 +</span></div>
                <p>����� �������� ���� ����������
                    ������������� �������. �� <span>��������</span>
                    ������� ���� �� <span>������ �����.</span></p>
            </li>
            <li><img src="/files/27.jpg" alt="" /></li>

        </ul>

    </div>   

    <div class="become-dealer-block2">

        <form action="#" method="post" class="allform" id="feedBack">
            <div class="form_error"></div>
            <div class="form_success">���� ������ ����������. �� ����������� �������� � ����! �������!</div>
            <input type="hidden" name="form" value="feedBack">
            <label class="left">
                <input type="text" class="req input" placeholder="�������� ����� �����������" value="" name="NAME"/><span class="i">*</span>
            </label>
            <label class="right">
                <input type="text" class="req input" placeholder="��� ����������� ����" value="" name="CONTACT_NAME"/><span class="i">*</span>
            </label>
            <label class="center">
                <input type="text" class="input" placeholder="���� ����������� ��� �������" value="" name="COMMENT"/>
            </label>
            <label class="left">
                <input type="text" class="req phone input" placeholder="������� ����������� ���� ��� �����" value="" name="CONTACT_PHONE"/><span class="i">*</span>
            </label>
            <label class="right">
                <input type="text" class="req input" placeholder="E-mail ����������� ���� ��� �����" value="" name="CONTACT_EMAIL"/><span class="i">*</span>
            </label>                                                                                                                 
            <button type="button" class="submit" onclick="personalFormSubmit('feedBack'); yaCounter32903175.reachGoal('SVYAZHITES'); ga('send', 'event', 'Button', 'Click', 'SVYAZHITES');">���������</button>
            <button type="reset" class="reset">��������</button>
        </form>
    </div>
    </div>

   
        


