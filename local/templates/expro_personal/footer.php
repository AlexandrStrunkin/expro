

</div>

<?include($_SERVER["DOCUMENT_ROOT"]."/include/footer.php")?>

</div>

<?include($_SERVER["DOCUMENT_ROOT"]."/include/footerStrings.php")?>

<?if (!$USER->IsAuthorized()) {?>
    <script type="">
    //вывод формы авторизации в личном кабинете
        $(function() {$(".header .login-popup-link").click(); });             
    </script>
    <?}?>
      
    </body>
</html>