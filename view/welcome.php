<div class="wr">
    <h2>������� ����� ����������� �����:</h2>

    <form action="welcome.php" method="post" id="my-form">
        <input type="text" name="email" class="tx" value="<?php echo $email ?>">
        <input type="submit" name="submit" class="entr" value="�����"/>
        <br/>
        <input type="checkbox" class="chec" name="remember"/> <label>���������</label>
        <br/>
    </form>

    <br/>

    <script src="http://loginza.ru/js/widget.js" type="text/javascript"></script>
    <a href="http://loginza.ru/api/widget?token_url=http://www.deposit.zp.ua/auth.php" class="loginza">
        <img src="http://loginza.ru/img/sign_in_button_gray.gif" alt="����� ����� loginza"/>
    </a>


    <div class="welcome-error"><?php echo $message ?></div>
</div>