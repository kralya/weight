<?php
include_once('config.php');

$email = $_POST['email'];

if (isset($_POST['email']) && !Validate::email($email)) {
    $message = 'Email is not valid';
}

if (isset($_POST['email']) && Validate::email($email)) {
    if (!User::exists($email)) {
        User::create($email);
    }

    Auth::login($email);
    Utility::redirect('index.php');

}

Core::loadTemplate('header', array('title' => '������� ����', 'notLogged' => true));
Core::loadTemplate('welcome', array('message' => $message, 'email' => $email));
Core::loadTemplate('footer');