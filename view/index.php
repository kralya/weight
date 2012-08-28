<div class="layout">
    <input type="hidden" id="email" value="<?php echo $email ?>"/>

    <h1>Ввести вес ( в КГ, с точностью до десятых ):</h1>
    <ul class="calculation">
        <?php foreach ($weights as $key => $value) { ?>


        <li>
            <div class="wg">
                <div class="h box" id="box-<?php echo $key ?>">

                    <?php echo $value['weight'] ? $value['weight'] : '...' ?>

                    <div class="first">
                        <div class="second"></div>
                    </div>

                    <!--                    <div class="active">-->
                    <!--                        <input type="text" id="input_selected" value="' + $.trim(text) + '"  onfocus="this.value = this.value;" />-->
                    <!--                        <input type="submit" class="input_submit" value="Сохранить"/>-->
                    <!--                    </div>-->

                    <div style="margin-top: 10px; display: none;" id="box-<?php echo $key ?>-form" class="forms">
                        <form action="">
                            <input class="tx" type="text" id="box-<?php echo $key ?>-input_selected" onfocus="this.value = this.value"/>
                            <input class="bt input_submit" value="Сохранить" id="box-<?php echo $key ?>-button" type="button"/>
                        </form>
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