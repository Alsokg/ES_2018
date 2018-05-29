<?php



$to = "info.engstudent@gmail.com";

if (isset($_POST['who-comment'])) $who = $_POST['who-comment'];
else $who = " ";
$messageAdmin = "Новий коментар." . "<br>";
$subject = "Коментар English Student";
$message = "Ваш коментар відправлений на модерацію. Найближчим часом він буде опублікований на сайті (email не публікується)." . "<br>";
$messageAdmin .= '<table width="100%" border="1" cellpadding="8" cellspacing="0" bgcolor="#FFFFFF">';
$messageAdmin .= "<thead><tr><td>Імя</td><td>Email</td><td>Коментар</td><td>Хто</td></tr></thead>";
$messageAdmin .= "<tbody><tr><td>".$_POST['name-comment']."</td><td>".$_POST['email-comment']."</td><td>".$_POST['comment-comment']."</td><td>".$who."</td></tr></tbody>";
$messageAdmin .= "</table>";
$message .= '<table width="100%" border="1" cellpadding="8" cellspacing="0" bgcolor="#FFFFFF">';
$message .= "<thead><tr><td>Імя</td><td>Email</td><td>Коментар</td><td>Хто</td></tr></thead>";
$message .= "<tbody><tr><td>".$_POST['name-comment']."</td><td>".$_POST['email-comment']."</td><td>".$_POST['comment-comment']."</td><td>".$who."</td></tr></tbody>";
$message .= "</table>";
// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <englishstudent.net>' . "\r\n";


mail($to,$subject,$messageAdmin,$headers);
mail($_POST['email-comment'],$subject,$message,$headers);

?>