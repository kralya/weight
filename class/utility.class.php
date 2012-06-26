<?php

class Utility{
    public static function redirect($url){
        header('Location: '.$url);
        die();
    }
}