<?php
$ch = curl_init();

// ��������� URL � ������ ����������� ����������
$token = $_POST['token'];
$secret = '93585dea7e26f4f215c549bae2b3e30b';
$skey = md5($token.$secret);
$url = 'http://loginza.ru/api/authinfo?token='.$token.'&id=34567&sig='.$skey;

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, 0);

// �������� �������� � ������ � ��������
$result = curl_exec($ch);

// ���������� ������ � ������������ ��������
curl_close($ch);

//echo $result;
$decoded = json_decode($result, true);

if(isset($decoded['email'])){
    header('Location: http://www.deposit.zp.ua/welcome?email='.$decoded['email']);
    return;
}

//if(isset($decoded['identity'])){
//    header('Location: http://www.deposit.zp.ua/welcome?identity='.$decoded['identity']);
//    return;
//}

// redirect to welcome.php with 'sorry' message
header('Location: http://www.deposit.zp.ua/welcome');
return;

echo 'HEY, SOMETHING IS WRONG! NO EMAIL RESULTS, REDIRECT ME FROM hERE!';
var_dump($decoded);