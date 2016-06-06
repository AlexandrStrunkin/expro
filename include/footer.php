<footer class="footer">
    <nav class="footer_menu">
        <ul>
            <li>
                <?$APPLICATION->IncludeFile(SITE_DIR."include/footer_menu_link_catalog.php",Array(), Array("MODE"=>"html"));?>

                <?$APPLICATION->IncludeComponent("bitrix:menu", "footer_submenu", Array(
                        "ROOT_MENU_TYPE" => "footer_catalog",    // ��� ���� ��� ������� ������
                        "MENU_CACHE_TYPE" => "Y",    // ��� �����������
                        "MENU_CACHE_TIME" => "36000000",    // ����� ����������� (���.)
                        "MENU_CACHE_USE_GROUPS" => "N",    // ��������� ����� �������
                        "MENU_CACHE_GET_VARS" => "",    // �������� ���������� �������
                        "MAX_LEVEL" => "1",    // ������� ����������� ����
                        "USE_EXT" => "N",    // ���������� ����� � ������� ���� .���_����.menu_ext.php
                        "ALLOW_MULTI_SELECT" => "N",    // ��������� ��������� �������� ������� ������������
                        ),
                        false
                    );?>
            </li>

            <li>
                <?$APPLICATION->IncludeFile(SITE_DIR."include/footer_menu_link_company.php",Array(), Array("MODE"=>"html"));?>
                <?$APPLICATION->IncludeComponent("bitrix:menu", "footer_submenu", Array(
                        "ROOT_MENU_TYPE" => "footer_company",    // ��� ���� ��� ������� ������
                        "MENU_CACHE_TYPE" => "Y",    // ��� �����������
                        "MENU_CACHE_TIME" => "36000000",    // ����� ����������� (���.)
                        "MENU_CACHE_USE_GROUPS" => "N",    // ��������� ����� �������
                        "MENU_CACHE_GET_VARS" => "",    // �������� ���������� �������
                        "MAX_LEVEL" => "1",    // ������� ����������� ����
                        "USE_EXT" => "N",    // ���������� ����� � ������� ���� .���_����.menu_ext.php
                        "ALLOW_MULTI_SELECT" => "N",    // ��������� ��������� �������� ������� ������������
                        ),
                        false
                    );?>
            </li>

            <li>
                <?$APPLICATION->IncludeFile(SITE_DIR."include/footer_menu_link_solutions.php",Array(), Array("MODE"=>"html"));?>
                <?$APPLICATION->IncludeComponent("bitrix:menu", "footer_submenu", Array(
                        "ROOT_MENU_TYPE" => "footer_solutions",    // ��� ���� ��� ������� ������
                        "MENU_CACHE_TYPE" => "Y",    // ��� �����������
                        "MENU_CACHE_TIME" => "36000000",    // ����� ����������� (���.)
                        "MENU_CACHE_USE_GROUPS" => "N",    // ��������� ����� �������
                        "MENU_CACHE_GET_VARS" => "",    // �������� ���������� �������
                        "MAX_LEVEL" => "1",    // ������� ����������� ����
                        "USE_EXT" => "N",    // ���������� ����� � ������� ���� .���_����.menu_ext.php
                        "ALLOW_MULTI_SELECT" => "N",    // ��������� ��������� �������� ������� ������������
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
                        "ROOT_MENU_TYPE" => "footer_contacts",    // ��� ���� ��� ������� ������
                        "MENU_CACHE_TYPE" => "Y",    // ��� �����������
                        "MENU_CACHE_TIME" => "36000000",    // ����� ����������� (���.)
                        "MENU_CACHE_USE_GROUPS" => "N",    // ��������� ����� �������
                        "MENU_CACHE_GET_VARS" => "",    // �������� ���������� �������
                        "MAX_LEVEL" => "1",    // ������� ����������� ����
                        "USE_EXT" => "N",    // ���������� ����� � ������� ���� .���_����.menu_ext.php
                        "ALLOW_MULTI_SELECT" => "N",    // ��������� ��������� �������� ������� ������������
                        ),
                        false
                    );?>
            </li>

            <li>
                <?  //���������� ������ �� ������, ���� � ��������� ���� �������� �� ������ ������ ��������
                    $res = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => INFO_IBLOCK_ID, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y"), false, Array("nPageSize" => 1), $arSelect);
                    if ($res -> GetNextElement()) {
                        $APPLICATION->IncludeFile(SITE_DIR."include/footer_menu_link_info.php",Array(), Array("MODE"=>"html"));
                    }
                ?>
            </li>
        </ul>
    </nav>

    <a href="#order-project" class="order_project btn_ico login-popup-link">�������� ������</a>

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
            <span>�������� ����� � <a href="http://webgk.ru" target="_blank">�������� WebGK</a></span>
        </div>
    </div>

</footer>


<div class="hidden">

    <!--login-popup-->
    <div id="login-popup" class="popupForm">
        <span class="h2">�����������</span>
        <form action="#" method="post" class="allform" id="authForm">
            <input type="hidden" name="form" value="authForm">
            <div class="form_error">�������� ����� ��� ������!</div>
            <label><input type="text" class="req input" placeholder="��� ������������ ��� e-mail" value="" id="auth_email" autocomplete="off"/></label>
            <label><input type="password" class="req input" placeholder="������" value="" id="auth_password" autocomplete="off"/></label>

            <div class="btn-container">
                <a href="#reg-popup" class="reg-popup-link">�����������</a>
                <button type="button" class="submit" onclick="personalFormSubmit('authForm')">�����</button>
            </div>

        </form>
    </div>
    <!--END login-popup-->
    <!--reg-popup-->
    <div id="reg-popup" class="popupForm">
        <span class="h2">�����������</span>

        <form action="#" method="post" class="allform" id="regForm">
            <div class="form-container">
                <h3>�������� ��� ������</h3>
                <div class="dealer-link new active">
                    <span class="i"></span>
                    <span class="name">����� �����</span>
                    ����������� ��� ��������, �������� ����� �������
                </div>
                <div class="or">���</div>
                <div class="dealer-link">
                    <span class="i"></span>
                    <span class="name">����������� �����</span>
                    ����������� ��� �������������� ��������-������
                </div>
                <h3>��������� ����</h3>
                <div class="form_error"></div>
                <div class="form_success">���� ������ ����������. �� ����������� �������� � ����! �������!</div>
                <input type="hidden" name="form" value="regForm">
                <input type="hidden" id="newDealer" value="Y" name="newDealer">
                <label class="dealer-new"><input type="text" class="req input1" placeholder="������� ���������� ��������� ����� �����������, ������ ��� ��������� ��������" value="" name="NEW_BANK_PROPS" autocomplete="off"/></label>
                <div class="col1">
                    <label class="dealer-new"><input type="text" class="input req" placeholder="����������� �����" value="" name="NEW_LEGAL_ADDRESS" autocomplete="off"/><span class="req-i"></span> </label>
                    <label class="dealer-new"><input type="text" class="input req" placeholder="��� ����������� ����" value="" name="NEW_FIO" autocomplete="off"/><span class="req-i"></span></label>
                    <label class="dealer-new"><input type="text" class="input req" placeholder="E-mail ����������� ���� ��� �����" value="" name="NEW_EMAIL" autocomplete="off"/><span class="req-i"></span></label>
                    <label class="dealer-new"><input type="text" class="input" placeholder="����� �����" value="" name="NEW_SITE" autocomplete="off"/></label>
                    <label class="dealer-2"><input type="text" class="input req" placeholder="�������� ��������" value="" name="NAME" autocomplete="off"/><span class="req-i"></span></label>
                    <label class="dealer-2"><input type="text" class="input phone req" placeholder="������� ��� �����" value="" name="PHONE" autocomplete="off"/><span class="req-i"></span></label>
                </div>
                <div class="col2">
                    <label class="dealer-new"><input type="text" class="input req" placeholder="����������� �����" value="" name="NEW_FACT_ADDRESS" autocomplete="off"/></label>
                    <label class="dealer-new"><input type="text" class="input req phone" placeholder="������� ����������� ���� ��� �����" value="" name="NEW_PHONE" autocomplete="off"/></label>
                    <label class="dealer-new"><input type="text" class="input req" placeholder="������� �������� ����� �����������" value="" name="NEW_NAME" autocomplete="off"/></label>
                    <label class="dealer-new"><input type="text" class="input" placeholder="����� ������ (��� �������)" value="" name="NEW_WAREHOUSE" autocomplete="off"/></label>
                    <label class="dealer-2"><input type="text" class="input req" placeholder="���� ���" value="" name="FIO" autocomplete="off"/></label>
                    <label class="dealer-2"><input type="text" class="input email req" placeholder="E-mail ��� �����" value="" name="EMAIL" autocomplete="off"/></label>
                </div>
            </div>
            <div class="btn-container">
                <div class="mes">���������� ����, �������� ������������� ��� ����������.</div>
                <button type="reset" class="reset">��������</button>
                <button type="button" class="submit" onclick="personalFormSubmit('regForm'); yaCounter32903175.reachGoal('REGISTRACIYA'); ga('send', 'event', 'Button', 'Click', 'REGISTRACIYA');">���������</button>
            </div>
        </form>

    </div>
    <!--END reg-popup-->


    <div id="order-project" class="popupForm">
        <span class="h2">�������� ������</span>
        <form action="#" method="post" class="allform" id="orderProject">
            <input type="hidden" name="form" value="orderProject">
            <div class="form_error">��������� ��� ����!</div>
            <div class="form_success">���� ������ ����������. �� ����������� �������� � ����! �������!</div>
            <label><input type="text" class="req input" placeholder="*�������� ��������" value="" name="NAME" autocomplete="off"/></label>
            <label><textarea placeholder="���� ����������� ��� �������" name="COMMENT" autocomplete="off"></textarea></label>
            <label><input type="text" class="req input" placeholder="*��� ����������� ����" value="" name="FIO" autocomplete="off"/></label>
            <label><input type="text" class="req input phone" placeholder="*������� ����������� ����" value="" name="PHONE" autocomplete="off"/></label>
            <label><input type="text" class="req input" placeholder="*Email ����������� ����" value="" name="EMAIL" autocomplete="off"/></label>

            <div class="btn-container">
                <button type="button" class="submit" onclick="personalFormSubmit('orderProject'); yaCounter32903175.reachGoal('PROEKT'); ga('send', 'event', 'Button', 'Click', 'PROEKT');">��������</button>
            </div>
        </form>
    </div>


    <div id="order-call" class="popupForm">
        <span class="h2">�������� �������� ������</span>
        <form action="#" method="post" class="allform" id="orderCall">
            <input type="hidden" name="form" value="orderCall">
            <div class="form_error">��������� ��� ����!</div>
            <div class="form_success">���� ������ ����������. �� ����������� �������� � ����! �������!</div>
            <label><input type="text" class="req input" placeholder="*���� ���" value="" name="NAME" autocomplete="off"/></label>
            <label><input type="text" class="req input phone" placeholder="*��� �������" value="" name="PHONE" autocomplete="off"/></label>
            <label><textarea placeholder="���� ����������� ��� �������" name="COMMENT" autocomplete="off"></textarea></label>
            <div class="btn-container">
                <button type="button" class="submit" onclick="personalFormSubmit('orderCall'); yaCounter32903175.reachGoal('ZVONOK'); ga('send', 'event', 'Button', 'Click', 'ZVONOK');">��������</button>
            </div>
        </form>
    </div>


    <div id="get-opp-price" class="popupForm">
        <span class="h2">������ ������� ����</span>
        <form action="#" method="post" class="allform" id="getOptPrice">
            <input type="hidden" name="form" value="getOptPrice">
            <div class="form_error">��������� ��� ����!</div>
            <div class="form_success">���� ������ ����������. �� ����������� �������� � ����! �������!</div>
            <input id="optProductID" type="hidden" class="req input" value="" name="OPT_PRODUCT_ID" autocomplete="off"/>
            <label><input type="text" class="req input" placeholder="*�����" value="" name="PRODUCT" autocomplete="off" disabled="disabled"/></label>
            <label><input type="text" class="req input" placeholder="*���� ���" value="" name="NAME" autocomplete="off"/></label>
            <label><input type="text" class="req input phone" placeholder="*��� �������" value="" name="PHONE" autocomplete="off"/></label>
            <label><input type="text" class="req input" placeholder="*��� Email" value="" name="EMAIL" autocomplete="off"/></label>

            <div class="btn-container">
                <button type="button" class="submit" onclick="personalFormSubmit('getOptPrice'); yaCounter32903175.reachGoal('UZNAT_CENU'); ga('send', 'event', 'Button', 'Click', 'UZNAT_CENU');">���������</button>
            </div>
        </form>
    </div>

</div>