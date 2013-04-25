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

    <script type="text/javascript" src="js/jquery.min.1.7.1.js"></script>

    <?php if (isset($useChartScript) && $useChartScript) Core::loadTemplate('chart-script', array('weights' => $weights)) ?>

</head>
<body>
<div class="wrapper">
    <!--header start -->
    <div class="header">
        <div class="left">
            <a href="index.php">
                <img width="200px" src="img/logo.png"/>
            </a>
        </div>
        <?php if (!isset($notLogged)) { ?>
        <div class="right-rail">
            <ul>
                <li class="wight">
                    <div class="bg-bt"><a href="index.php">������ ���</a></div>
                </li>
                <li class="chart">
                    <div class="bg-bt"><a href="graph.php">������</a></div>
                </li>
                <li class="quit">
                    <div class="bg-bt"><a href="logout.php">�����</a></div>
                </li>
            </ul>
        </div>
        <?php } ?>
    </div>
    <!--header end -->
    <br class="clear"/>
    <!-- content start-->
