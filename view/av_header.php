<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Language" content="ru">
    <meta http-equiv="content-type" content="text/html; charset=windows-1251"/>

    <meta name="robots" content="INDEX, FOLLOW"/>
    <meta name="keywords" content="�������, ���, ������, ���������, ��������"/>
    <meta name="description" content="������� ����, ������ ���, ������� �� �����"/>
    <link rel="shortcut icon" href="/favicon.png" type="image/x-icon"/>

    <title><?php echo $title ?></title>

    <link rel="stylesheet" href="css/all.css">

    <script type="text/javascript" src="js/jquery.min.1.7.1.avjs"></script>

    <?php if (isset($useChartScript) && $useChartScript) Core::loadTemplate('chart-script', array('weights' => $weights)) ?>

    <script type="text/javascript">

        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-35394825-1']);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();

    </script>

</head>
<body>
<div class="wrapper">
    <!--header start -->
    <div class="header">
        <div class="left">
            <a href="<?php echo INDEX_PAGE ?>">
                <img width="200px" src="img/logo.png"/>
            </a>
        </div>
        <?php if (!isset($notLogged)) { ?>
        <div class="right-rail">
            <ul>
                <li class="wight">
                    <div class="bg-bt"><a href="<?php echo INDEX_PAGE ?>">������ ���</a></div>
                </li>
                <li class="chart">
                    <div class="bg-bt"><a href="<?php echo GRAPH_PAGE ?>">������</a></div>
                </li>
                <li class="quit">
                    <div class="bg-bt"><a href="<?php echo LOGOUT_PAGE ?>">�����</a></div>
                </li>
            </ul>
        </div>
        <?php } ?>
    </div>
    <!--header end -->
    <br class="clear"/>
    <!-- content start-->
