<?php

$email = $_POST['email'];
// if mail was entered and is not valid: display message, stop
if(!isset($_POST['email'])){
    return;
}

// if mail was not entered: stop
if(!Validate::email($email)){
    $message = 'Email is not valid';
    return;
}

// if mail is new: create user
if(!User::exists($email)){
    User::create($email);
}

Auth::login($email);
// get user for mail
// log user in
// redirect to index
Utility::redirect('index.php');