home page here
<style type="text/css">
    div.box {
        /*border: 1px solid #f00;*/
        width: 50px;
        height: 20px;
        display: block;
        margin-left: 100px;
    }

    div.container div{
        float: left;
    }

    div.container{
        margin-top: 150px;
        padding-left: 200px;
        /*border: 1px dotted black;*/
        height: 30px;
    }
</style>

<div class="container">
    <?php foreach ($weights as $key => $value) { ?>

    <div class="box">
        <?php echo $value?$value:'...' ?>
    </div>

    <?php } ?>
</div>