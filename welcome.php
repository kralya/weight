<?php

$email = $_POST['email'];
if(!isset($_POST['email'])){
    return;
}

if(!Validate::email($email)){
    $message = 'Email is not valid';
    return;
}

if(!User::exists($email)){
    User::create($email);
}

Auth::login($email);
Utility::redirect('index.php');