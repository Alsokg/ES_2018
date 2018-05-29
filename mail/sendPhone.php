<?php



$to = "info.engstudent@gmail.com";


$message = "Ваш дзвінок отримано. Скоро звяжемось з вами." . "<br>";
$subject = "Замовлення English Student";

$messageAdmin = "Заказ дзвінка" . "<br>" . $_POST['phone-input'];
   
// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <englishstudent.net>' . "\r\n";


mail($to,$subject,$messageAdmin,$headers);
//mail($to,$subject,$messageAdmin,$headers);

?>