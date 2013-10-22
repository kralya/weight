<?php if (!$displayWeight) { ?>
    <div style="text-align: center; padding-top:140px">
        Введите хотя бы две значения веса.
    </div>

<?php } else { ?>
<div id="chartdiv" style="width:100%; height:340px;"></div>
<?php } ?>

<div class="bottom-menu">
    <div class="sub-left">
        <fieldset class="trend">
            <legend>Тренд:</legend>
            <ul class="trend">
                <li>Последний год <input type="checkbox"
                                         id="checkbox-year" <?php if ($period == 'year') echo "checked" ?>
                                         onclick="window.location = '/graph-trend-year';"/></li>
                <li>Последний месяц <input type="checkbox"
                                           id="checkbox-month" <?php if ($period == 'month') echo "checked" ?>
                                           onclick="window.location = '/graph-trend-month';"/></li>
                <li>Последняя неделя <input type="checkbox"
                                            id="checkbox-week" <?php if ($period == 'week') echo "checked" ?>
                                            onclick="window.location = '/graph-trend-week';"/></li>
                <li>Очистить <input type="checkbox" id="checkbox-remove"
                                    onclick="window.location = '/graph';"/></li>
            </ul>
        </fieldset>
    </div>

    <div>
        <fieldset class="trend">
            <legend> Строить график по:</legend>
            <ul class="trend">
                <li>Дню недели:
                    <select onchange="if (this.selectedIndex) window.location = '/graph-for-weekday/' + this.options[this.selectedIndex].value;">
                        <option></option>
                        <option value="1">Пн</option>
                        <option value="2">Вт</option>
                        <option value="3">Ср</option>
                        <option value="4">Чт</option>
                        <option value="5">Пт</option>
                        <option value="6">Сб</option>
                        <option value="7">Вс</option>
                    </select>
                </li>
                <li>№ месяца:
                    <select onchange="if (this.selectedIndex) window.location = '/graph-for-month/' + this.options[this.selectedIndex].value;">
                        <option></option>
                        <?php for($i=1;$i<13;$i++){ ?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                         <?php } ?>
                    </select>
                </li>

                <li>№ недели:
                    <select onchange="if (this.selectedIndex) window.location = '/graph-for-week/' + this.options[this.selectedIndex].value;">
                        <option></option>
                        <?php for($i=1;$i<53;$i++){ ?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                        <?php } ?>
                    </select>
                </li>

                <li>Очистить <input type="checkbox"
                                    onclick="window.location = '/graph';"/></li>
            </ul>

        </fieldset>
    </div>

    <div id="print">
        <input  type="button" value="Печать" onclick="window.print();">
    </div>

</div>