<?php
session_start();
$token = "6360188883:AAHqzntxoIXgpCCDzuCVtxBeh1atod8WZAQ";
$firstname = $_POST['username'];
$lastname  = $_POST['lastname'];
$phone     = $_POST['number'];
$email     = $_POST['email'];
$nameOrganization   = $_POST['nameOrganization'];
$viewOrganization   = $_POST['viewOrganization'];


$chat_id = -4256980149;

$textMessage = "Имя: ".$firstname."\n"."Фамилия: ".$lastname."\n"."Номер телефона: ".$phone."\n"."email: ".$email."\n"."Название организации: ".$nameOrganization."\n"."Вид организации: ".$viewOrganization."\n";
$textMessage = urlencode($textMessage);

$urlQuery = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chat_id . "&text=" . $textMessage;

$result = file_get_contents($urlQuery);

$_SESSION['message'] = "Ваша заявка принята! скоро наш специалист с вами свяжется!";
header('location: ../index.php');
exit();