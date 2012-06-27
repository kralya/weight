<?php

class Core{
    public static function loadTemplate($template, $vars = array()){
        foreach($vars as $key => $value){
            $$key = $value;
        }

        include('view//'.$template.'.php');
    }

    public static function loadConfig(){
        include('config.php');
    }
}