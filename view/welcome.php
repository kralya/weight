<div class="welcome-block">
    ������� ����� ����������� �����:
    <form action="welcome.php" method="post">
        <input type="text" name="email" id="email">
        <input type="submit" name="submit" value="�����"/>
    </form>

    <div class="welcome-error"><?php echo $message ?></div>
</div>
