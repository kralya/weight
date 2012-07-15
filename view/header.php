<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
    <meta http-equiv="Content-Language" content="ru">
    <meta http-equiv="content-type" content="text/html; charset="windows-1251"/>

    <meta name="robots" content="INDEX, FOLLOW"/>
    <meta name="keywords" content="дневник, вес, график, изменение, похудеть"/>
    <meta name="description" content="Дневник веса, онлайн вес, следить за весом"/>

    <title><?php echo $title ?></title>

    <link rel="stylesheet" href="css/index.css">

    <script type="text/javascript" src="js/jquery.min.1.7.1.js"></script>

    <?php if (isset($useChartScript) && $useChartScript) Core::loadTemplate('chart-script', array('weights' => $weights)) ?>

</head>
<body>

<!--header start -->
<div class="header">
    <div style="float: left">
        <a href="index.php">
            <img src="img/logo.png"/>
        </a>
    </div>
    <?php if (!isset($notLogged)) { ?>
    <div class="header-menu">
        <span><a href='index.php'>Ввести вес</a></span>
        <span><a href='graph.php'>График</a></span>
        <span><a href='logout.php'>Выйти</a></span>
    </div>
    <?php } ?>
</div>
<!--header end -->
<!-- content start-->
<div id="content">