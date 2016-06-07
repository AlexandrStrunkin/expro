<footer class="footer">
    <nav class="footer_menu">
        <ul>
            <li>
                <?$APPLICATION->IncludeFile(SITE_DIR."include/footer_menu_link_catalog.php",Array(), Array("MODE"=>"html"));?>

                <?$APPLICATION->IncludeComponent("bitrix:menu", "footer_submenu", Array(
                        "ROOT_MENU_TYPE" => "footer_catalog",    // Тип меню для первого уровня
                        "MENU_CACHE_TYPE" => "Y",    // Тип кеширования
                        "MENU_CACHE_TIME" => "36000000",    // Время кеширования (сек.)
                        "MENU_CACHE_USE_GROUPS" => "N",    // Учитывать права доступа
                        "MENU_CACHE_GET_VARS" => "",    // Значимые переменные запроса
                        "MAX_LEVEL" => "1",    // Уровень вложенности меню
                        "USE_EXT" => "N",    // Подключать файлы с именами вида .тип_меню.menu_ext.php
                        "ALLOW_MULTI_SELECT" => "N",    // Разрешить несколько активных пунктов одновременно
                        ),
                        false
                    );?>
            </li>

            <li>
                <?$APPLICATION->IncludeFile(SITE_DIR."include/footer_menu_link_company.php",Array(), Array("MODE"=>"html"));?>
                <?$APPLICATION->IncludeComponent("bitrix:menu", "footer_submenu", Array(
                        "ROOT_MENU_TYPE" => "footer_company",    // Тип меню для первого уровня
                        "MENU_CACHE_TYPE" => "Y",    // Тип кеширования
                        "MENU_CACHE_TIME" => "36000000",    // Время кеширования (сек.)
                        "MENU_CACHE_USE_GROUPS" => "N",    // Учитывать права доступа
                        "MENU_CACHE_GET_VARS" => "",    // Значимые переменные запроса
                        "MAX_LEVEL" => "1",    // Уровень вложенности меню
                        "USE_EXT" => "N",    // Подключать файлы с именами вида .тип_меню.menu_ext.php
                        "ALLOW_MULTI_SELECT" => "N",    // Разрешить несколько активных пунктов одновременно
                        ),
                        false
                    );?>
            </li>

            <li>
                <?$APPLICATION->IncludeFile(SITE_DIR."include/footer_menu_link_solutions.php",Array(), Array("MODE"=>"html"));?>
                <?$APPLICATION->IncludeComponent("bitrix:menu", "footer_submenu", Array(
                        "ROOT_MENU_TYPE" => "footer_solutions",    // Тип меню для первого уровня
                        "MENU_CACHE_TYPE" => "Y",    // Тип кеширования
                        "MENU_CACHE_TIME" => "36000000",    // Время кеширования (сек.)
                        "MENU_CACHE_USE_GROUPS" => "N",    // Учитывать права доступа
                        "MENU_CACHE_GET_VARS" => "",    // Значимые переменные запроса
                        "MAX_LEVEL" => "1",    // Уровень вложенности меню
                        "USE_EXT" => "N",    // Подключать файлы с именами вида .тип_меню.menu_ext.php
                        "ALLOW_MULTI_SELECT" => "N",    // Разрешить несколько активных пунктов одновременно
                        ),
                        false
                    );?>
            </li>

            <li>
                <?$APPLICATION->IncludeFile(SITE_DIR."include/footer_menu_link_news.php",Array(), Array("MODE"=>"html"));?>
            </li>

            <li>
                <?$APPLICATION->IncludeFile(SITE_DIR."include/footer_menu_link_contacts.php",Array(), Array("MODE"=>"html"));?>
                <?$APPLICATION->IncludeComponent("bitrix:menu", "footer_submenu", Array(
                        "ROOT_MENU_TYPE" => "footer_contacts",    // Тип меню для первого уровня
                        "MENU_CACHE_TYPE" => "Y",    // Тип кеширования
                        "MENU_CACHE_TIME" => "36000000",    // Время кеширования (сек.)
                        "MENU_CACHE_USE_GROUPS" => "N",    // Учитывать права доступа
                        "MENU_CACHE_GET_VARS" => "",    // Значимые переменные запроса
                        "MAX_LEVEL" => "1",    // Уровень вложенности меню
                        "USE_EXT" => "N",    // Подключать файлы с именами вида .тип_меню.menu_ext.php
                        "ALLOW_MULTI_SELECT" => "N",    // Разрешить несколько активных пунктов одновременно
                        ),
                        false
                    );?>
            </li>

            <li>
                <?  //показываем ссылку на раздел, если в инфоблоке есть активные на данный момент элементы
                    $res = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => INFO_IBLOCK_ID, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y"), false, Array("nPageSize" => 1), $arSelect);
                    if ($res -> GetNextElement()) {
                        $APPLICATION->IncludeFile(SITE_DIR."include/footer_menu_link_info.php",Array(), Array("MODE"=>"html"));
                    }
                ?>
            </li>
        </ul>
    </nav>

    <a href="#order-project" class="order_project btn_ico login-popup-link">Заказать проект</a>

    <div class="clearboth"></div>

    <div class="footer_info">
        <div class="footer_info__text">
            <p class="copy">
                <?$APPLICATION->IncludeFile(SITE_DIR."include/copyright.php",Array(), Array("MODE"=>"html"));?>
            </p>
            <p>
                <?$APPLICATION->IncludeFile(SITE_DIR."include/footer_text_1.php",Array(), Array("MODE"=>"html"));?>
            </p>
            <p>
                <?$APPLICATION->IncludeFile(SITE_DIR."include/footer_text_2.php",Array(), Array("MODE"=>"html"));?>
            </p>
        </div>
        <div class="footer_link">
            <span>Создание сайта — <a href="http://webgk.ru" target="_blank">компания WebGK</a></span>
        </div>
    </div>

</footer>


<div class="hidden">

    <!--login-popup-->
    <div id="login-popup" class="popupForm">
        <span class="h2">Авторизация</span>
        <form action="#" method="post" class="allform" id="authForm">
            <input type="hidden" name="form" value="authForm">
            <div class="form_error">Неверный логин или пароль!</div>
            <label><input type="text" class="req input" placeholder="Имя пользователя или e-mail" value="" id="auth_email" autocomplete="off"/></label>
            <label><input type="password" class="req input" placeholder="Пароль" value="" id="auth_password" autocomplete="off"/></label>

            <div class="btn-container">
                <a href="#reg-popup" class="reg-popup-link">регистрация</a>
                <button type="button" class="submit" onclick="personalFormSubmit('authForm')">войти</button>
            </div>

        </form>
    </div>
    <!--END login-popup-->
    <!--reg-popup-->
    <div id="reg-popup" class="popupForm">
        <span class="h2">Регистрация</span>

        <form action="#" method="post" class="allform" id="regForm">
            <div class="form-container">
                <h3>Выберите тип дилера</h3>
                <div class="dealer-link new active">
                    <span class="i"></span>
                    <span class="name">новый дилер</span>
                    Регистрация для компании, желающей стать дилером
                </div>
                <div class="or">или</div>
                <div class="dealer-link">
                    <span class="i"></span>
                    <span class="name">действующий дилер</span>
                    Регистрация для представителей компании-дилера
                </div>
                <h3>Заполните поля</h3>
                <div class="form_error"></div>
                <div class="form_success">Ваша заявка отправлена. Мы обязательно свяжемся с вами! Спасибо!</div>
                <input type="hidden" name="form" value="regForm">
                <input type="hidden" id="newDealer" value="Y" name="newDealer">
                <label class="dealer-new"><input type="text" class="req input1" placeholder="Введите банковские ревкизиты вашей организации, полные ФИО директора компании" value="" name="NEW_BANK_PROPS" autocomplete="off"/></label>
                <div class="col1">
                    <label class="dealer-new"><input type="text" class="input req" placeholder="Юридический адрес" value="" name="NEW_LEGAL_ADDRESS" autocomplete="off"/><span class="req-i"></span> </label>
                    <label class="dealer-new"><input type="text" class="input req" placeholder="ФИО контактного лица" value="" name="NEW_FIO" autocomplete="off"/><span class="req-i"></span></label>
                    <label class="dealer-new"><input type="text" class="input req" placeholder="E-mail контактного лица для связи" value="" name="NEW_EMAIL" autocomplete="off"/><span class="req-i"></span></label>
                    <label class="dealer-new"><input type="text" class="input" placeholder="Адрес сайта" value="" name="NEW_SITE" autocomplete="off"/></label>
                    <label class="dealer-2"><input type="text" class="input req" placeholder="Название компании" value="" name="NAME" autocomplete="off"/><span class="req-i"></span></label>
                    <label class="dealer-2"><input type="text" class="input phone req" placeholder="Телефон для связи" value="" name="PHONE" autocomplete="off"/><span class="req-i"></span></label>
                </div>
                <div class="col2">
                    <label class="dealer-new"><input type="text" class="input req" placeholder="Фактический адрес" value="" name="NEW_FACT_ADDRESS" autocomplete="off"/></label>
                    <label class="dealer-new"><input type="text" class="input req phone" placeholder="Телефон контактного лица для связи" value="" name="NEW_PHONE" autocomplete="off"/></label>
                    <label class="dealer-new"><input type="text" class="input req" placeholder="Введите название вашей организации" value="" name="NEW_NAME" autocomplete="off"/></label>
                    <label class="dealer-new"><input type="text" class="input" placeholder="Адрес склада (при наличии)" value="" name="NEW_WAREHOUSE" autocomplete="off"/></label>
                    <label class="dealer-2"><input type="text" class="input req" placeholder="Ваши ФИО" value="" name="FIO" autocomplete="off"/></label>
                    <label class="dealer-2"><input type="text" class="input email req" placeholder="E-mail для связи" value="" name="EMAIL" autocomplete="off"/></label>
                </div>
            </div>
            <div class="btn-container">
                <div class="mes">Отмеченные поля, являются обязательными для заполнения.</div>
                <button type="reset" class="reset">очистить</button>
                <button type="button" class="submit" onclick="personalFormSubmit('regForm'); yaCounter32903175.reachGoal('REGISTRACIYA'); ga('send', 'event', 'Button', 'Click', 'REGISTRACIYA');">отправить</button>
            </div>
        </form>

    </div>
    <!--END reg-popup-->


    <div id="order-project" class="popupForm">
        <span class="h2">Заказать проект</span>
        <form action="#" method="post" class="allform" id="orderProject">
            <input type="hidden" name="form" value="orderProject">
            <div class="form_error">Заполните все поля!</div>
            <div class="form_success">Ваша заявка отправлена. Мы обязательно свяжемся с вами! Спасибо!</div>
            <label><input type="text" class="req input" placeholder="*Название компании" value="" name="NAME" autocomplete="off"/></label>
            <label><textarea placeholder="Ваши комментарии или вопросы" name="COMMENT" autocomplete="off"></textarea></label>
            <label><input type="text" class="req input" placeholder="*ФИО контактного лица" value="" name="FIO" autocomplete="off"/></label>
            <label><input type="text" class="req input phone" placeholder="*Телефон контактного лица" value="" name="PHONE" autocomplete="off"/></label>
            <label><input type="text" class="req input" placeholder="*Email контактного лица" value="" name="EMAIL" autocomplete="off"/></label>

            <div class="btn-container">
                <button type="button" class="submit" onclick="personalFormSubmit('orderProject'); yaCounter32903175.reachGoal('PROEKT'); ga('send', 'event', 'Button', 'Click', 'PROEKT');">Заказать</button>
            </div>
        </form>
    </div>


    <div id="order-call" class="popupForm">
        <span class="h2">Заказать обратный звонок</span>
        <form action="#" method="post" class="allform" id="orderCall">
            <input type="hidden" name="form" value="orderCall">
            <div class="form_error">Заполните все поля!</div>
            <div class="form_success">Ваша заявка отправлена. Мы обязательно свяжемся с вами! Спасибо!</div>
            <label><input type="text" class="req input" placeholder="*Ваше имя" value="" name="NAME" autocomplete="off"/></label>
            <label><input type="text" class="req input phone" placeholder="*Ваш телефон" value="" name="PHONE" autocomplete="off"/></label>
            <label><textarea placeholder="Ваши комментарии или вопросы" name="COMMENT" autocomplete="off"></textarea></label>
            <div class="btn-container">
                <button type="button" class="submit" onclick="personalFormSubmit('orderCall'); yaCounter32903175.reachGoal('ZVONOK'); ga('send', 'event', 'Button', 'Click', 'ZVONOK');">Заказать</button>
            </div>
        </form>
    </div>


    <div id="get-opp-price" class="popupForm">
        <span class="h2">Узнать оптовую цену</span>
        <form action="#" method="post" class="allform" id="getOptPrice">
            <input type="hidden" name="form" value="getOptPrice">
            <div class="form_error">Заполните все поля!</div>
            <div class="form_success">Ваша заявка отправлена. Мы обязательно свяжемся с вами! Спасибо!</div>
            <input id="optProductID" type="hidden" class="req input" value="" name="OPT_PRODUCT_ID" autocomplete="off"/>
            <label><input type="text" class="req input" placeholder="*Товар" value="" name="PRODUCT" autocomplete="off" disabled="disabled"/></label>
            <label><input type="text" class="req input" placeholder="*Ваше имя" value="" name="NAME" autocomplete="off"/></label>
            <label><input type="text" class="req input phone" placeholder="*Ваш телефон" value="" name="PHONE" autocomplete="off"/></label>
            <label><input type="text" class="req input" placeholder="*Ваш Email" value="" name="EMAIL" autocomplete="off"/></label>

            <div class="btn-container">
                <button type="button" class="submit" onclick="personalFormSubmit('getOptPrice'); yaCounter32903175.reachGoal('UZNAT_CENU'); ga('send', 'event', 'Button', 'Click', 'UZNAT_CENU');">Отправить</button>
            </div>
        </form>
    </div>

</div>