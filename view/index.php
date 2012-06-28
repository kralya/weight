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
        $(this).before('<div class="active"> <input type="text" class="input_box" value="' + $.trim(text) + '"/> <input type="submit" class="input_submit" value="Save"/></div>');
        $(this).hide();

        $('.input_box').click(function () {
            return false;
        });

        $('.input_submit').click(function () {
            $.post('save.php', {email:1, weight:2, date: 3, sid:Math.random()}, function (response) {
//                $('#vote_res_' + vid).html(data);

            });

        });

        return false;
    });

    $('body').click(function () {
        hideBoxes();
    });

</script>
</html>