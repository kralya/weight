<div style="text-align: center; font-size: 200%">¬вести вес:</div>

<div class="container">

    <div>

        <input type="hidden" id="email" value="<?php echo $email ?>"/>

        <?php foreach ($weights as $key => $value) { ?>

        <div class="box" id="box-<?php echo $key ?>">
            <?php echo $value ? $value : '...' ?>
        </div>

        <?php } ?>

    </div>

    <div>

        <?php foreach ($weights as $key => $value) { ?>

        <div class="box-date">
            <?php echo (isset($show[$key]) ? $show[$key] : '') ?>
            <?php echo $key ?>
        </div>

        <?php } ?>
    </div>


</div>
<script type="text/javascript" src="js/index-weight.js"></script>