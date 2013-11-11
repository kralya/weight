<div class="layout" xmlns="http://www.w3.org/1999/html">
    <input type="hidden" id="email" value="<?php echo $email ?>"/>

    <h1>Ввести вес ( в КГ, с точностью до десятых ):</h1>
    <ul class="calculation">
        <?php foreach ($weights as $key => $value) { ?>


        <li>

            <div class="wg <?php echo $value['display-date']['weekend'] ? 'weekend' : '' ?>">
                <div class="h box" id="box-<?php echo $key ?>">

                    <div id="text-<?php echo $key ?>">
                        <span style="font-size: 9px"><?php echo $value['display-date']['valueWeekAgo'] ?>&nbsp;</span>
                        <div class="common"><?php echo $value['weight'] ? $value['weight'] : '...' ?></div>
                    </div>

                    <div class="first">

                        <div class="second"></div>
                    </div>

                    <div style="margin-top: 10px; display: none;" id="box-<?php echo $key ?>-form" class="forms">
                        <input class="tx" type="text" id="box-<?php echo $key ?>-input_selected"/>
                        <input class="bt input_submit" value="Сохранить" id="box-<?php echo $key ?>-button" type="button"/>
                    </div>

                </div>
            </div>
            <div id="date-<?php echo $key ?>" class="dates">
                <span class="weekday"><?php echo $value['display-date']['text'] ?>&nbsp;</span>
                <span class="weekday <?php echo $value['display-date']['weekend'] ? 'weekend' : '' ?> ">
                    <?php echo $value['display-date']['weekday'] ?>,
                </span>
                <span><?php echo $value['display-date']['date'] ?></span>

            </div>

        </li>

        <?php } ?>
    </ul>

    <script type="text/javascript" src="js/index-weight.js"></script>
</div>