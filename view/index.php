<html>
<head>
    <link rel="stylesheet" href="css/index.css">
    <script type="text/javascript" src="js/jquery.min.1.7.1.js"></script>
</head>
<body>
home page here

<div class="container">
    <?php foreach ($weights as $key => $value) { ?>

    <div class="box">
        <?php echo $value ? $value : '...' ?>
    </div>

    <?php } ?>
</div>


</body>
<script type="text/javascript">
    function hideBoxes() {
        $('.box').show();
        $('.active').hide();
    }

    $('.box').click(function () {
        hideBoxes();

        var text = $(this).text();
        $(this).before('<div class="active"> <input type="text" class="input_box" value="' + $.trim(text) + '"/> <input type="submit" value="Save"/></div>');
        $(this).hide();

        return false;
    });

    $('html').click(function () {
        hideBoxes();
    });

</script>
</html>