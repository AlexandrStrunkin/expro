

</div>

<?include($_SERVER["DOCUMENT_ROOT"]."/include/footer.php")?>

</div>

<?include($_SERVER["DOCUMENT_ROOT"]."/include/footerStrings.php")?>

<?if (!$USER->IsAuthorized()) {?>
    <script type="">
    //����� ����� ����������� � ������ ��������
        $(function() {$(".header .login-popup-link").click(); });             
    </script>
    <?}?>
      
    </body>
</html>