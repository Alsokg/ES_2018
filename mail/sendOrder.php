<?php

$phone = $_POST['phone'];
$email = $_POST['email'];
$name = $_POST['name'];
$q1 = $_POST['qty1'];


$p1 = $_POST['price-kids'];


$paid = $_POST['delivery1'];

$price = $q1*$p1;
$guid = $_POST['guid'];
$to = "info.engstudent@gmail.com";


$subjectReply = "Замовлення English Student";

$subject = "HTML email";
$box = array(0,0,0,0,0);
$boxPrice = array(0,0,0,0,0);
$boxName = array("Junior","A1", "A2", "B1", "B2",);
$start = 0;

$box[0] = $q1;


$boxPrice[0] = $p1;



$index = 0;

$message = '<table border="1" bordercolor="#666" cellpadding="2" cellspacing="2" height="100%" width="100%"><tr bgcolor="#eee"><td>';
$message .= "ID</td><td>";
$message .= "Замовлення від</td><td>";
$message .= "Телефон</td><td>e-mail</td><td>";
$message .= "Рівень</td><td>";
$message .= "К-сть</td><td>";
$message .= "$</td><td>";
$message .= "Оплата</td></tr><tr><td>";
$message .= $guid . "</td><td>";
$message .= $name . "</td><td>";
$message .= $phone . "</td><td>" . $email . "</td><td>";

if($q1 > 0){
	$message .= "Junior</td><td>";
	$message .= $q1 . "</td><td>";
	$message .= $q1*$p1 . "</td><td>";
	$start = 1;
}
//else{
//$paidTXT = "Приват банк";
//$message .= "ПБ</td><td>";
//}
$message .= $paid;
//if ($sending == 1){
//$sendTXT = "Нова Пошта";
//$message .= "НП</td><td>";

//}else{
  //$sendTXT = "Доставка курєром";
//$message .= "КР</td><td>";
//}
$message .= "</td></tr><tr>";
if($start < 5){
	for ($i = $start; $i < 5; $i++){
		if($box[$i] > 0)
			$message .= "<td></td><td></td><td></td><td>$boxName[$i]</td><td>" . $box[$i] . "</td><td>" . $box[$i]*$boxPrice[$i] . "</td><td></td><td></td></tr><tr>";	
			//$price += $box[$i]*$boxPrice[$i];
	}

}
$message .= "<td></td><td></td><td></td><td></td><td></td><td>Сумма</td><td>" . $price . "</td></tr></table>"; 

$messageReply = "";
$messageReply .= " Ваше замовлення  прийнято." . "<br>" . "Ми зв’яжемось з Вами найближчим часом для підтвердження. " . "<br><br>" . "Дані замовлення" . "<br><br>";
//$messageReply .= "Товар" . "<br>";
if($q1 != 0){
   // $messageReply .= "Junior: " . $q1 . "\r\n" . "<br>";
}

//$messageReply .= "Ім’я: " . $_POST['name'] . "<br>";
//$messageReply .= "Телефон: " . $phone  . "<br>";
//$messageReply .= "Спосіб оплати: " . $paid . "<br><br>" . "-" . "<br>";

$messageReply .= $message;

$messageReply .= "Команда English Student<br>";
$messageReply .= "+38 (066) 638 74 30<br>+38 (073) 227 14 65<br>";
	$messageReply .= "Сума: " . $price . "грн" . "\r\n" . "<br>";
    

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <englishstudent.net>' . "\r\n";

mail($email,$subjectReply,$messageReply,$headers);

mail($to,$subject,$message,$headers);

return 'success'
?>