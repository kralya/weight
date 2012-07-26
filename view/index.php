<div style="text-align: center; font-size: 200%">Ввести вес ( в КГ, с точностью до десятых ):</div>

<div class="container">

    <div>

        <input type="hidden" id="email" value="<?php echo $email ?>"/>

        <?php foreach ($weights as $key => $value) { ?>

        <div class="box" id="box-<?php echo $key ?>">
            <?php echo $value['weight'] ? $value['weight'] : '...' ?>
        </div>

        <?php } ?>

    </div>

    <div>

        <?php foreach ($weights as $key => $value) { ?>

        <div class="box-date">
            <?php echo $value['display-date'] ?>
        </div>

        <?php } ?>
    </div>


</div>
<script type="text/javascript" src="js/index-weight.js"></script>