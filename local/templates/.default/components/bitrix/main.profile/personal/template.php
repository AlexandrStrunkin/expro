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
        <h3>Личные данные</h3>
        <form method="post" name="form1" class="allform" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">

            <?=$arResult["BX_SESSION_CHECK"]?>
            <input type="hidden" name="lang" value="<?=LANG?>" />
            <input type="hidden" name="ID" value=<?=$arResult["ID"]?> />

            <label class="label1">
                <span>Логин</span>
                <input type="text" name="LOGIN" class="input req" placeholder="ваш логин" value="<? echo $arResult["arUser"]["LOGIN"]?>" />
            </label>
            <label>
                <span>E-mail</span>
                <input type="text" name="EMAIL" class="input req" placeholder="контактныый email" value="<? echo $arResult["arUser"]["EMAIL"]?>" />
            </label>
            <h4>Изменить пароль</h4>
            <label class="label1">
                <span>Введите новый пароль</span>
                <input type="password" name="NEW_PASSWORD" class="input req" value="" autocomplete="off"/>
            </label>
            <label>
                <span>Подтвердите новый пароль</span>
                <input type="password" name="NEW_PASSWORD_CONFIRM" class="input req" value="" autocomplete="off" />
            </label>
            <input class="submit" type="submit" name="save" value="Сохранить">
            <button class="reset" type="reset">Отменить</button>                  
        </form>
    </div>
    <!--END personal-data-->
    <div class="info">
        <h3>Полезная информация</h3>
        <ul>
            <li><a href="/personal/download/" class="link1">
                    <span class="img"></span>
                    <span>Материалы для скачивания</span>
                </a>
            </li>
            <li><a href="/personal/subscribe/" class="link2">
                    <span class="img"></span>
                    <span>Управление подписками</span>
                </a>
            </li>
            <li><a href="/personal/news/" class="link3">
                    <span class="img"></span>
                    <span>Новости дилерам</span>
                </a>
            </li>
        </ul>
    </div>    

</div>