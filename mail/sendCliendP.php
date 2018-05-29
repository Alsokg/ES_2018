<?php



$to = "info.engstudent@gmail.com";


$messageReply = "Вашу заявку прийнято. <br>Звяжимось з вами протягом 24 год.<br>";
$subject = "Заявка English Student";
$messageReply .= "Команда English Student<br>";
$messageReply .= "+38 (066) 638 74 30<br>+38 (073) 227 14 65<br>";
// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <englishstudent.net>' . "\r\n";


mail($to,$subject,$messageReply,$headers);
//mail($to,$subject,$messageAdmin,$headers);

?>