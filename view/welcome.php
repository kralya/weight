<div class="wr">
    <h2>������� ����� ����������� �����:</h2>

    <form action="welcome.php" method="post" id="my-form">
        <input type="text" name="email" class="tx" value="<?php echo $email ?>">
        <input type="submit" name="submit" class="entr" value="�����"/>
        <br/>
        <input type="checkbox" class="chec" name="remember"/> <label>���������</label>
    </form>

    <div class="welcome-error"><?php echo $message ?></div>
</div>