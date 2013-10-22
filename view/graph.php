<?php if (!$displayWeight) { ?>
    <div style="text-align: center; padding-top:140px">
        ������� ���� �� ��� �������� ����.
    </div>

<?php } else { ?>
<div id="chartdiv" style="width:100%; height:340px;"></div>
<?php } ?>

<div class="bottom-menu">
    <div class="sub-left">
        <fieldset class="trend">
            <legend>�����:</legend>
            <ul class="trend">
                <li>��������� ��� <input type="checkbox"
                                         id="checkbox-year" <?php if ($period == 'year') echo "checked" ?>
                                         onclick="window.location = '/graph-trend-year';"/></li>
                <li>��������� ����� <input type="checkbox"
                                           id="checkbox-month" <?php if ($period == 'month') echo "checked" ?>
                                           onclick="window.location = '/graph-trend-month';"/></li>
                <li>��������� ������ <input type="checkbox"
                                            id="checkbox-week" <?php if ($period == 'week') echo "checked" ?>
                                            onclick="window.location = '/graph-trend-week';"/></li>
                <li>�������� <input type="checkbox" id="checkbox-remove"
                                    onclick="window.location = '/graph';"/></li>
            </ul>
        </fieldset>
    </div>

    <div>
        <fieldset class="trend">
            <legend> ������� ������ ��:</legend>
            <ul class="trend">
                <li>��� ������:
                    <select style="width: 55px">
                        <option></option>
                        <option>��</option>
                        <option>��</option>
                        <option>��</option>
                        <option>��</option>
                        <option>��</option>
                        <option>��</option>
                        <option>��</option>
                    </select>
                </li>
                <li>� ������:
                    <select style="width: 55px">
                        <option></option>
                        <?php for($i=1;$i<13;$i++){ ?>
                        <option><?php echo $i ?></option>
                         <?php } ?>
                    </select>
                </li>

                <li>� ������:
                    <select style="width: 55px">
                        <option></option>
                        <?php for($i=1;$i<53;$i++){ ?>
                        <option><?php echo $i ?></option>
                        <?php } ?>
                    </select>
                </li>

                <li>�������� <input type="checkbox"
                                    onclick="window.location = '/graph';"/></li>
            </ul>

        </fieldset>
    </div>

    <div id="print">
        <input  type="button" value="������" onclick="window.print();">
    </div>

</div>