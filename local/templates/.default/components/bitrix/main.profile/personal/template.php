<?
    /**
    * @global CMain $APPLICATION
    * @param array $arParams
    * @param array $arResult
    */
    if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
        die();
?>

<?ShowError($arResult["strProfileError"]);?>
<?
    if ($arResult['DATA_SAVED'] == 'Y') {?>          
    <p>
        <br>
        <?  ShowNote(GetMessage('PROFILE_DATA_SAVED')); ?>
        <br>
    </p>
    <?}?>
<script type="text/javascript">
    <!--
    var opened_sections = [<?
        $arResult["opened"] = $_COOKIE[$arResult["COOKIE_PREFIX"]."_user_profile_open"];
        $arResult["opened"] = preg_replace("/[^a-z0-9_,]/i", "", $arResult["opened"]);
        if (strlen($arResult["opened"]) > 0)
        {
            echo "'".implode("', '", explode(",", $arResult["opened"]))."'";
        }
        else
        {
            $arResult["opened"] = "reg";
            echo "'reg'";
        }
    ?>];
    //-->

    var cookie_prefix = '<?=$arResult["COOKIE_PREFIX"]?>';
</script>


<div class="col1">
    <!--personal-data-->
    <div class="personal-data">
        <h3>������ ������</h3>
        <form method="post" name="form1" class="allform" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">

            <?=$arResult["BX_SESSION_CHECK"]?>
            <input type="hidden" name="lang" value="<?=LANG?>" />
            <input type="hidden" name="ID" value=<?=$arResult["ID"]?> />

            <label class="label1">
                <span>�����</span>
                <input type="text" name="LOGIN" class="input req" placeholder="��� �����" value="<? echo $arResult["arUser"]["LOGIN"]?>" />
            </label>
            <label>
                <span>E-mail</span>
                <input type="text" name="EMAIL" class="input req" placeholder="����������� email" value="<? echo $arResult["arUser"]["EMAIL"]?>" />
            </label>
            <h4>�������� ������</h4>
            <label class="label1">
                <span>������� ����� ������</span>
                <input type="password" name="NEW_PASSWORD" class="input req" value="" autocomplete="off"/>
            </label>
            <label>
                <span>����������� ����� ������</span>
                <input type="password" name="NEW_PASSWORD_CONFIRM" class="input req" value="" autocomplete="off" />
            </label>
            <input class="submit" type="submit" name="save" value="���������">
            <button class="reset" type="reset">��������</button>                  
        </form>
    </div>
    <!--END personal-data-->
    <div class="info">
        <h3>�������� ����������</h3>
        <ul>
            <li><a href="/personal/download/" class="link1">
                    <span class="img"></span>
                    <span>��������� ��� ����������</span>
                </a>
            </li>
            <li><a href="/personal/subscribe/" class="link2">
                    <span class="img"></span>
                    <span>���������� ����������</span>
                </a>
            </li>
            <li><a href="/personal/news/" class="link3">
                    <span class="img"></span>
                    <span>������� �������</span>
                </a>
            </li>
        </ul>
    </div>    

</div>