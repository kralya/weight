<?php
include_once('config.php');

$email = $_POST['email'];
$weight = (float)$_POST['weight'];
$date = $_POST['date'];

Auth::redirectUnlogged();

if (!User::exists($email)) {
    echo 'wrong email';
    return;
}

if ((int)$weight <= 0 || (int)$weight > 300) {
    echo 'wrong weight';
    return;
}

$weights = Weight::getForDaysAgo(DAYS_AGO_INDEX);
if(!array_key_exists($date, $weights)){
    echo 'wrong date';
    return;
}

// Fix JS
$parts = explode('-', $date);
$date = $parts[0].'-'.$parts[1].'-'.$parts[2];

// 2. update / insert values to DB
Weight::set($date, $weight);

// 3. send weight received back as success response

echo $weight;