<div class="welcome-block">
    ������� ����� ����������� �����:
    <form action="welcome.php" method="post">
        <input type="text" name="email" id="email" value="<?php echo $email ?>">
        <input type="submit" name="submit" value="�����"/>
        <br/>
        <input type="checkbox" id="remember" name="remember"/> <label for="remember">���������</label>
    </form>

    <div class="welcome-error"><?php echo $message ?></div>
</div>
