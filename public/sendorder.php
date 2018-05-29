<?php
header('Access-Control-Allow-Origin: *'); 
$phone = $_POST['phone'];
$name = $_POST['fio'];
$email = $_POST['email'];
$adress = $_POST['adress'];
$day = $_POST['day'];
$month = $_POST['month'];
$year = $_POST['year'];
$wish = $_POST['wish'];

$to = "aloskg@gmail.com, info@narscars.com.ua ";
$subject = "Бронь с facebook страницы";

$message = "Заказ от: " . $name . "\r\n" . "<br>";

    
$message .= "\r\n" . " Телефон: " . $phone . "\r\n" . "<br>";
$message .= "\r\n" . " Email: " . $email . "\r\n" . "<br>";
$message .= "\r\n" . " Прописка: " . $adress . "\r\n" . "<br>";
$message .= "\r\n" . " Дата рождения: " . $day . " " . $month . " " . $year . "\r\n" . "<br>";
$message .= "\r\n" . " Пожелания: " . $wish . "\r\n" . "<br>";
// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <facebook-page.com>' . "\r\n";

mail($to,$subject,$message,$headers);

echo 'success-call'
?>