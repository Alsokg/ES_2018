<?php

if (isset($_POST['phone']))
	$phone = $_POST['phone'];
else
	$phone = 0;

if (isset($_POST['email']))
	$email = $_POST['email'];
else
	$email = 0;
if (isset($_POST['name']))
	$name = $_POST['name'];
else
	$name = 0;
if (isset($_POST['qty11']))
	$q1 = $_POST['qty11'];
else $q1 = 0;
if (isset($_POST['qty12']))
	$q2 = $_POST['qty12'];
else
	$q2 = 0;
if (isset($_POST['qty13']))
	$q3 = $_POST['qty13'];
else
	$q3 = 0;
if (isset($_POST['qty14']))
	$q4 = $_POST['qty14'];
else
	$q4 = 0;
if (isset($_POST['qty15']))
	$q5 = $_POST['qty15'];
else
	$q5 = 0;
if (isset($_POST['qty16']))
	$q6 = $_POST['qty16'];
else
	$q6 = 0;
if (isset($_POST['qty17']))
	$q7 = $_POST['qty17'];
else
	$q7 = 0;
if (isset($_POST['qty18']))
	$q8 = $_POST['qty18'];
else
	$q8 = 0;
if (isset($_POST['qty19']))
	$q9 = $_POST['qty19'];
else
	$q9 = 0;
if (isset($_POST['price1']))
	$p1 = $_POST['price1'];
else $p1 = 0;
if (isset($_POST['price2']))
	$p2 = $_POST['price2'];
else $p2 = 0;
if (isset($_POST['price3']))
	$p3 = $_POST['price3'];
else $p3 = 0;
if (isset($_POST['price4']))
	$p4 = $_POST['price4'];
else $p4 = 0;
if (isset($_POST['price5']))
	$p5 = $_POST['price5'];
else $p5 = 0;
if (isset($_POST['price6']))
	$p6 = $_POST['price6'];
else $p6 = 0;
if (isset($_POST['price7']))
	$p7 = $_POST['price7'];
else $p7 = 0;
if (isset($_POST['price8']))
	$p8 = $_POST['price8'];
else $p8 = 0;
if (isset($_POST['price9']))
	$p9 = $_POST['price9'];
else $p9 = 0;

if (isset($_POST['guid']))
	$guid = $_POST['guid'];
else
	$guid = 0;
if (isset($_POST['delivery1']))
	$paid = $_POST['delivery1'];
else
	$paid = 0;


$qTotal = $q1 + $q2 + $q3 + $q4 + $q5 + $q6 + $q7 + $q8 + $q9;
$price = $q1*$p1 + $q2*$p2 + $q3*$p3 + $q4*$p4 + $q6*$p6 + $q5*$p5 + $q7*$p7 + $q8*$p8 + $q9*$p9;
if ($qTotal > 3){
$price = $price - $qTotal*30;
}
$price = $_POST['ttl'];

$to = "info.engstudent@gmail.com";


$subjectReply = "Замовлення English Student";

$subject = "HTML email";
$box = array(0,0,0,0,0,0,0,0,0);
$boxPrice = array(0,0,0,0,0,0,0,0,0);
$boxName = array("Junior","A1", "A2", "B11", "B12","B21", "B22", "C1", "C2");
$start = 0;

$box[0] = $q1;
$box[1] = $q2;
$box[2] = $q3;
$box[3] = $q4;
$box[4] = $q5;
$box[5] = $q6;
$box[6] = $q7;
$box[7] = $q8;
$box[8] = $q9;

$boxPrice[0] = $p1;
$boxPrice[1] = $p2;
$boxPrice[2] = $p3;
$boxPrice[3] = $p4;
$boxPrice[4] = $p5;
$boxPrice[5] = $p6;
$boxPrice[6] = $p7;
$boxPrice[7] = $p8;
$boxPrice[8] = $p9;

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
}else if($q2 > 0){
	$message .= "A1</td><td>";
	$message .= $q2 . "</td><td>";
	$message .= $q2*$p2 . "</td><td>";
	$start = 2;
}else if($q3 > 0){
	$message .= "A2</td><td>";
	$message .= $q3 . "</td><td>";
	$message .= $q3*$p3 . "</td><td>";
	$start = 3;
}else if($q4 > 0){
	$message .= "B1.1</td><td>";
	$message .= $q4 . "</td><td>";
	$message .= $q4*$p4 . "</td><td>";
	$start = 4;
}
else if($q5 > 0){
	$message .= "B1.2</td><td>";
	$message .= $q5 . "</td><td>";
	$message .= $q5*$p5 . "</td><td>";
	$start = 5;
}
else if($q6 > 0){
	$message .= "B2.1</td><td>";
	$message .= $q6 . "</td><td>";
	$message .= $q6*$p6 . "</td><td>";
	$start = 6;
}
else if($q7 > 0){
	$message .= "B2.2</td><td>";
	$message .= $q7 . "</td><td>";
	$message .= $q7*$p7 . "</td><td>";
	$start = 7;
}else if($q8 > 0){
	$message .= "C1</td><td>";
	$message .= $q8 . "</td><td>";
	$message .= $q8*$p8 . "</td><td>";
	$start = 8;
}else if($q9 > 0){
	$message .= "C2</td><td>";
	$message .= $q9 . "</td><td>";
	$message .= $q9*$p9 . "</td><td>";
	$start = 9;
}
if ($paid == 2){
$message .= "НП</td><td>";
$paidTXT = "При отриманні";
}
$message .= $paid;

$message .= "</td></tr><tr>";
if($start < 9){
	for ($i = $start; $i < 9; $i++){
		if($box[$i] > 0)
			$message .= "<td></td><td></td><td></td><td></td><td>$boxName[$i]</td><td>" . $box[$i] . "</td><td>" . $box[$i]*$boxPrice[$i] . "</td><td></td><td></td></tr><tr>";	
			//$price += $box[$i]*$boxPrice[$i];
	}

}
$message .= "<td></td><td></td><td></td><td></td><td></td><td>Сумма</td><td>" . $price . "</td></tr></table>"; 


$messageReply = "";
$messageReply .= " Ваше замовлення  прийнято." . "<br>" . "Ми зв’яжемось з Вами найближчим часом для підтвердження. " . "<br><br>" . "Дані замовлення" . "<br><br>";



$messageReply .= $message;

if (isset($_POST['promo-code'])){
$message .= "Промо-код:" . $_POST['promo-code'];
}

$messageReply .= "Команда English Student<br>";
$messageReply .= "+38 (066) 638 74 30<br>+38 (073) 227 14 65<br>";
	$messageReply .= "Сума: " . $price . "грн" . "\r\n" . "<br>";
    

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <englishstudent.net>' . "\r\n";

mail($email,$subjectReply,$messageReply,$headers);

$status = mail($to,$subject,$message,$headers);

return $status;
?>
