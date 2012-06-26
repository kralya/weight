<?php

class Core{
    public static function loadTemplate($template){
        include('view//'.$template.'.php');
    }

    public static function loadConfig(){
        include('config.php');
    }
}