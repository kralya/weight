<?php if (!$displayWeight) { ?>
    <div style="text-align: center; padding-top:140px">
        ������� ���� �� ��� �������� ����.
    </div>

<?php } else { ?>
<div id="chartdiv" style="width:100%; height:290px;"></div>
<?php } ?>

<fieldset class="trend">
    <legend>�����:</legend>
    <ul class="trend">
        <li>��������� ��� <input type="checkbox" id="checkbox-year" /></li>
        <li>��������� ����� <input type="checkbox" id="checkbox-month" /></li>
        <li>��������� ������ <input type="checkbox" id="checkbox-week" /></li>
        <li>�������� <input type="checkbox" id="checkbox-remove" /></li>
    </ul>
    <br/>
</fieldset>