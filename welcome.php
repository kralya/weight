<?php
include_once('config.php');

if(empty($_POST['email'])){
    $_POST['email'] = $_GET['email'];
}

$email = $_POST['email'];

if (isset($_POST['email']) && !Validate::email($email)) {
    $message = 'Неверный формат';
}

if (isset($_POST['email']) && Validate::email($email) || isset($_COOKIE['login']) && !empty($_COOKIE['login']) ) {

    if(isset($_COOKIE['login'])){
        $email = $_COOKIE['login'];
    }

    if (!User::exists($email)) {
        User::create($email);
    }

    if(isset($_POST['remember'])){
        setcookie("login", $email, time() + 3600 * 24 * 7 );
    }

    Auth::login($email);
    Utility::redirect('index.php');

}

Core::loadTemplate('header', array('title' => 'Дневник веса', 'notLogged' => true));
Core::loadTemplate('welcome', array('message' => $message, 'email' => $email));
Core::loadTemplate('footer');