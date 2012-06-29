<div class="container">
    <input type="hidden" id="email" value="<?php echo $email ?>" />

    <?php foreach ($weights as $key => $value) { ?>

    <div class="box" id="box-<?php echo $key ?>">
        <?php echo $value ? $value : '...' ?>
    </div>

    <?php } ?>
</div>
</body>
<script type="text/javascript" src="js/index-weight.js"></script>
</html>