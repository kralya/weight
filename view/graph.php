<?php if (!$displayWeight) { ?>
    <div style="text-align: center; padding-top:140px">
        ¬ведите хот€ бы две значени€ веса.
    </div>

<?php } else { ?>
<div id="chartdiv" style="width:100%; height:290px;"></div>
<?php } ?>

<fieldset class="trend">
    <legend>Trend line:</legend>
    <ul class="trend">
        <li>Last year<input type="checkbox"/></li>
        <li>Last month<input type="checkbox"/></li>
        <li><span>Last week</span><input type="checkbox"/></li>
    </ul>
    <br/>
</fieldset>