<?php



$to = "info.engstudent@gmail.com";


$messageAdmin = "Нова заявка партнерів." . "<br>";
$subject = "Заявка партнерів English Student";

$messageAdmin .= '<table width="100%" border="1" cellpadding="8" cellspacing="0" bgcolor="#FFFFFF">';
$messageAdmin .= "<thead><tr><td>Імя</td><td>Email</td><td>Телефон</td><td>Що вас цікавить?</td></tr></thead>";
$messageAdmin .= "<tbody><tr><td>".$_POST['name-partner']."</td><td>".$_POST['email-partner']."</td><td>".$_POST['phone-partner']."</td><td>".$_POST['request-partner']."</td></tr></tbody>";
$messageAdmin .= "</table>";
// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <englishstudent.net>' . "\r\n";


mail($to,$subject,$messageAdmin,$headers);
//mail($to,$subject,$messageAdmin,$headers);

?>