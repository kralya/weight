<script>
    window.onload = function() {
        var input = document.getElementById("email").focus();
    }
</script>

<div class="wr">
    <h2>Введите адрес электронной почты:</h2>

    <form action="welcome.php" method="post" id="my-form">
        <input type="text" name="email" class="tx" id="email" value="<?php echo $email ?>" autofocus>
        <input type="submit" name="submit" class="entr" value="Войти"/>
        <br/>
        <input type="checkbox" class="chec" name="remember"/> <label>Запомнить</label>
        <br/>
    </form>

    <br/>

    <script src="http://loginza.ru/js/widget.js" type="text/javascript"></script>
    <a href="http://loginza.ru/api/widget?token_url=http://www.deposit.zp.ua/auth.php" class="loginza">
        <img src="http://loginza.ru/img/sign_in_button_gray.gif" alt="Войти через loginza"/>
    </a>


    <div class="welcome-error"><?php echo $message ?></div>
</div>