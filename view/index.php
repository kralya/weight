<div class="layout">
    <input type="hidden" id="email" value="<?php echo $email ?>"/>

    <h1>Ввести вес ( в КГ, с точностью до десятых ):</h1>
    <ul class="calculation">
        <?php foreach ($weights as $key => $value) { ?>


        <li>
            <div class="wg">
                <div class="h" id="box-<?php echo $key ?>">
                    <?php echo $value['weight'] ? $value['weight'] : '...' ?>
                    <div class="first">
                        <div class="second"></div>
                    </div>
                </div>
            </div>
<?php $parts = explode(',', $value['display-date']) ?>
            <span><?php echo $parts[0] ?>,</span><span class="date"><?php echo $parts[1] ?></span>
        </li>

        <?php } ?>
    </ul>

    <script type="text/javascript" src="js/index-weight.js"></script>
</div>