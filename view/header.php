<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
    <meta http-equiv="Content-Language" content="ru">
    <meta http-equiv="content-type" content="text/html; charset="windows-1251"/>

    <meta name="robots" content="INDEX, FOLLOW" />
    <meta name="keywords" content="�������, ���, ������, ���������, ��������" />
    <meta name="description" content="������� ����, ������ ���, ������� �� �����" />

    <title><?php echo $title ?></title>

    <link rel="stylesheet" href="css/index.css">

        <script type="text/javascript" src="js/jquery.min.1.7.1.js"></script>

<?php if(isset($useChartScript) && $useChartScript) Core::loadTemplate('chart-script', array('weights' => $weights)) ?>

</head>
<body>

<!--header start -->
<div class="header">
    <div style="float: left">
        <img src="img/logo.png"/>
    </div>
    <div class="header-menu">
        <a href='index.php'>View</a>
        <a href='graph.php'>Graph</a>
        <a href='logout.php'>Logout</a>
    </div>
</div>
<!--header end -->
<!-- content start-->
<div id="content" >