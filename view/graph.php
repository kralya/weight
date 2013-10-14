<?php if (!$displayWeight) { ?>
    <div style="text-align: center; padding-top:140px">
        Введите хотя бы две значения веса.
    </div>

<?php } else { ?>
<div id="chartdiv" style="width:100%; height:290px;"></div>
<?php } ?>

<fieldset class="trend">
    <legend>Тренд:</legend>
    <ul class="trend">
        <li>Последний год <input type="checkbox" id="checkbox-year" /></li>
        <li>Последний месяц <input type="checkbox" id="checkbox-month" /></li>
        <li>Последняя неделя <input type="checkbox" id="checkbox-week" /></li>
        <li>Очистить <input type="checkbox" id="checkbox-remove" /></li>
    </ul>
    <br/>
</fieldset>