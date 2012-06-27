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
    $('.box').click(function(){
//        alert('hello!');
    });
</script>
</html>