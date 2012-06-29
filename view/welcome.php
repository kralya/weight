<div class="welcome-block">
    Введите адрес электронной почты:
    <form action="welcome.php" method="post">
        <input type="text" name="email" id="email">
        <input type="submit" name="submit" value="Войти"/>
    </form>

    <div class="welcome-error"><?php echo $message ?></div>
</div>
