<?php

namespace app\components\helpers;
use Yii;
use app\models\Info;
class MailBuilder{


    public static function build($details){
        
            function smtpmail($to='', $mail_to, $subject, $message, $headers='') {
	$config['smtp_username'] = 'info@englishstudent.net';  //Смените на адрес своего почтового ящика.
$config['smtp_port'] = '587'; // Порт работы.
$config['smtp_host'] =  's7.thehost.com.ua';  //сервер для отправки почты
$config['smtp_password'] = 'Solia1993';  //Измените пароль
$config['smtp_debug'] = true;  //Если Вы хотите видеть сообщения ошибок, укажите true вместо false
$config['smtp_charset'] = 'utf-8';	//кодировка сообщений. (windows-1251 или utf-8, итд)
$config['smtp_from'] = 'info@englishstudent.net'; //Ваше имя - или имя Вашего сайта. Будет показывать при прочтении в поле "От кого"
	$SEND =	"Date: ".date("D, d M Y H:i:s") . " UT\r\n";
	$SEND .= 'Subject: =?'.$config['smtp_charset'].'?B?'.base64_encode($subject)."=?=\r\n";
	if ($headers) $SEND .= $headers."\r\n\r\n";
	else
	{
			$SEND .= "Reply-To: ".$config['smtp_username']."\r\n";
			$SEND .= "To: \"=?".$config['smtp_charset']."?B?".base64_encode($to)."=?=\" <$mail_to>\r\n";
			$SEND .= "MIME-Version: 1.0\r\n";
			$SEND .= "Content-Type: text/html; charset=\"".$config['smtp_charset']."\"\r\n";
			$SEND .= "Content-Transfer-Encoding: 8bit\r\n";
			$SEND .= "From: \"=?".$config['smtp_charset']."?B?".base64_encode($config['smtp_from'])."=?=\" <".$config['smtp_username'].">\r\n";
			$SEND .= "X-Priority: 3\r\n\r\n";
	}
	$SEND .=  $message."\r\n";
	 if( !$socket = fsockopen($config['smtp_host'], $config['smtp_port'], $errno, $errstr, 30) ) {
		if ($config['smtp_debug']) echo $errno."<br>".$errstr;
		return false;
	 }
 
	if (!server_parse($socket, "220", __LINE__)) return false;
 
	fputs($socket, "HELO " . $config['smtp_host'] . "\r\n");
	if (!server_parse($socket, "250", __LINE__)) {
		if ($config['smtp_debug']) echo '<p>Не могу отправить HELO!</p>';
		fclose($socket);
		return false;
	}
//	fputs($socket, "AUTH LOGIN\r\n");
//	if (!server_parse($socket, "334", __LINE__)) {
//		if ($config['smtp_debug']) echo '<p>Не могу найти ответ на запрос авторизаци.</p>';
//		fclose($socket);
//		return false;
//	}
//	fputs($socket, base64_encode($config['smtp_username']) . "\r\n");
//	if (!server_parse($socket, "334", __LINE__)) {
//		if ($config['smtp_debug']) echo '<p>Логин авторизации не был принят сервером!</p>';
//		fclose($socket);
//		return false;
//	}
//	fputs($socket, base64_encode($config['smtp_password']) . "\r\n");
//	if (!server_parse($socket, "235", __LINE__)) {
//		if ($config['smtp_debug']) echo '<p>Пароль не был принят сервером как верный! Ошибка авторизации!</p>';
//		fclose($socket);
//		return false;
//	}
	fputs($socket, "MAIL FROM: <".$config['smtp_username'].">\r\n");
	if (!server_parse($socket, "250", __LINE__)) {
		if ($config['smtp_debug']) echo '<p>Не могу отправить комманду MAIL FROM: </p>';
		fclose($socket);
		return false;
	}
	fputs($socket, "RCPT TO: <" . $mail_to . ">\r\n");
 
	if (!server_parse($socket, "250", __LINE__)) {
		if ($config['smtp_debug']) echo '<p>Не могу отправить комманду RCPT TO: </p>';
		fclose($socket);
		return false;
	}
	fputs($socket, "DATA\r\n");
 
	if (!server_parse($socket, "354", __LINE__)) {
		if ($config['smtp_debug']) echo '<p>Не могу отправить комманду DATA</p>';
		fclose($socket);
		return false;
	}
	fputs($socket, $SEND."\r\n.\r\n");
 
	if (!server_parse($socket, "250", __LINE__)) {
		if ($config['smtp_debug']) echo '<p>Не смог отправить тело письма. Письмо не было отправленно!</p>';
		fclose($socket);
		return false;
	}
	fputs($socket, "QUIT\r\n");
	fclose($socket);
	return TRUE;
}
 
function server_parse($socket, $response, $line = __LINE__) {
	$config['smtp_username'] = 'info@englishstudent.net';  //Смените на адрес своего почтового ящика.
$config['smtp_port'] = '465'; // Порт работы.
$config['smtp_host'] =  's7.thehost.com.ua';  //сервер для отправки почты
$config['smtp_password'] = 'Solia1993';  //Измените пароль
$config['smtp_debug'] = true;  //Если Вы хотите видеть сообщения ошибок, укажите true вместо false
$config['smtp_charset'] = 'utf-8';	//кодировка сообщений. (windows-1251 или utf-8, итд)
$config['smtp_from'] = 'info@englishstudent.net'; //Ваше имя - или имя Вашего сайта. Будет показывать при прочтении в поле "От кого"
	while (@substr($server_response, 3, 1) != ' ') {
		if (!($server_response = fgets($socket, 256))) {
			if ($config['smtp_debug']) echo "<p>Проблемы с отправкой почты!</p>$response<br>$line<br>";
 			return false;
 		}
	}
	if (!(substr($server_response, 0, 3) == $response)) {
		if ($config['smtp_debug']) echo "<p>Проблемы с отправкой почты!</p>$response<br>$line<br>";
		return false;
	}
	return true;
}
        
        $lang = Yii::$app->language;
        
        $msg_time = Yii::t("yii", "msg_offline");
        $fromTime ="10:00:00";
        $toTime ="18:00:00";
        $time = time();
        if ($time > strtotime($fromTime) && $time < strtotime($toTime)) {
            $msg_time = Yii::t("yii", "msg_work");
        }
        
        if (date('w') == 6 || date('w') == 0){
            $msg_time = Yii::t("yii", "msg_holiday");
        } else if(date('w') == 5 && $time > strtotime($toTime)){
            $msg_time = Yii::t("yii", "msg_holiday");
        }
        
        $to = "info.engstudent@gmail.com";
        $subjectReply = "Замовлення English Student";
        $subject = "HTML email";
        
        
        $headers = "CC: info.engstudent@gmail.com\r\n";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <englishstudent.net>' . "\r\n";
        $email = "<html><head>\r\n";
        $email .= '<meta name="viewport" content="width=device-width, initial scale=1.0"/>' . "\r\n";
                $email .= '<style type="text/css">
    #main{font-family:"Open Sans", "Helvetica Neue", Helvetica, sans-serif;}
    .header-link{color: #00abff; font-size: 24px; text-decoration: none}
    table{width: 100%;}
    hr{margin: 16px 0;}
    .product-mail td, .product-mail th{padding: 8px}
    .title{color: #747474; margin-top: 24px;margin-bottom: 2px}
    #contacts{margin-top: 20px; padding-bottom: 4px;}
    #contacts td{font-size: 14px; color: #747474;}
    #social a{display: inline-block;border-radius: 50%;width: 48px;height: 48px;border: 2px solid #00abff; margin: 0 8px;}
    #gplus{width: 40px; margin: 4px; height: 40px;}
</style>';
        //head code where
        $email .= "</head><body style='background-color: #00abff; padding-top: 32px; padding-bottom:32px;'>\r\n";
        //main table start
        $email .= '<table  style="max-width:768px; margin: 16px auto; padding:16px;width:100%; background-color: #fff; border: 1px solid #aaa; border-radius: 4px;box-shadow: 0px 2px 10px 1px rgba(0,0,0,.2);" border="0" cellpadding="0" cellspacing="0" width="600" id="main">';
        $email .= "\r\n";
        $email .= '<tr><td style="width: 100%">';
        $email .= "\r\n";
        //global td where
        
        //header
        $email .= '<table style="padding: 0 16px">';
          $email .= '<tr>';
          $email .=  '<td width="120" rowspan="3"><a href="https://englishstudent.net"><img style="max-width: 100px" src="https://englishstudent.net/img/logo-email.png" alt="English Student" width="100"></a></td>';
          $email .= '</tr>';
          $email .= '<tr style="width: 100%" align="center">';
           $email .= '<td style="width: 50%"><a class="header-link" href="https://englishstudent.net">'.Yii::t("yii", "link_eng").'</a></td>';
            $email .= '<td style="width: 50%"><a class="header-link" href="https://englishstudent.net/kids">'.Yii::t("yii", "link_kids").'</a></td>';
          $email .='</tr>';
          $email .='<tr style="width: 100%" align="center">';
            $email .='<td style="width: 50%"><a class="header-link" href="https://englishstudent.net/polska">'.Yii::t("yii", "link_polska").'</a></td>';
            $email .='<td style="width: 50%"><a class="header-link" href="https://englishstudent.net/german">'.Yii::t("yii", "link_german").'</a></td>';
          $email .='</tr>';
        $email .='</table>';
        //header end
        $email .= '<hr style="height:1px;border:none;color:#ccc;background-color:#ccc;">';
        //ty msg start
        $email .= '<table style="padding: 0 16px">';
          $email .= '<tr>';
            $email .= '<td style="font-size: 24px;">'.Yii::t("yii", "msg_ty").'</td>';
          $email .= '</tr>';
          $email .= '<tr>';
            $email .= '<td style="font-style: 18px; color: #747474;">'.$msg_time.'</td>';
          $email .= '</tr>';
        $email .= '</table>';
        //ty msg end
        $email .= '<hr style="height:1px;border:none;color:#ccc;background-color:#ccc;">';
        $email .= '<p class="title">'.Yii::t("yii", "order_details").'</p>';
        //products table
           $email .= '   <table style="width: 100%" class="product-mail" cellspacing="1" bgcolor="#ccc">';
           $email .= '<tr height="32" bgcolor="#f0f0f0" align="left">';
            $email .= ' <th style="width: 25%;">'.Yii::t("yii", "order_image").'</th>';
            $email .= ' <th style="width: 25%;">'.Yii::t("yii", "order_article").'</th>';
            $email .= ' <th style="width: 15%;">'.Yii::t("yii", "order_count").'</th>';
            $email .= ' <th style="width: 17.5%;">'.Yii::t("yii", "order_price").'</th>';
           $email .= '  <th style="width: 17.5%;">'.Yii::t("yii", "order_total").'</th>';
          $email .= ' </tr>';
          $realPrice = 0;
        foreach($details['products'] as $product){
           
         $email .= ' <tr bgcolor="#fff">';
         $email .= '<td style="width: 25%;" align="center"><img style="max-width: 82px" src="https://englishstudent.net'.$product['image'].'" alt="product"></td>';
          $email .= '  <td style="width: 25%;">'.$product['name'].'</td>';
          $email .= '  <td style="width: 15%;">'.$product['qty1'].'</td>';
          $email .= '  <td style="width: 17.5%;">'.$product['price'].'</td>';
          $email .= '  <td style="width: 17.5%;">'.$product['qty1']*$product['price'].'</td>';
          $email .= '</tr>';
        
            $realPrice += $product['qty1']*$product['price'];
        }
                   $email .= '<tr rowspan="2" bgcolor="#fff">';
             $email .= '<td colspan="3" rowspan="2"></td>';
             $email .= '<td>'.Yii::t("yii", "discount_size").'</td>';
             $discount =  $realPrice - $details['total'];
             $email .= '<td>'.$discount.'</td>';
           $email .= '</tr>';
          $email .= ' <tr bgcolor="#fff">';
             $email .= '<td>'.Yii::t("yii", "total_price").'</td>';
             $email .= '<td>'.$details['total'].'</td>';
           $email .= '</tr>';
         $email .= '</table>';
        //products table
        $email .= '<p class="title">'.Yii::t("yii", "customer_details").'</p>';
        //customer info
        $email .= '<table style="width: 100%" class="product-mail" cellspacing="1" bgcolor="#ccc">';
          $email .= '<tr height="32" bgcolor="#f0f0f0" align="left">';
            $email .= '<th style="width: 30%;">'.Yii::t("yii", "customer_name").'</th>';
            $email .= '<th style="width: 30%;">'.Yii::t("yii", "customer_contacts").'</th>';
            $email .= '<th style="width: 20%;">'.Yii::t("yii", "customer_paid").'</th>';
            $email .= '<th style="width: 20%;">'.Yii::t("yii", "customer_shipping").'</th>';
          $email .= '</tr>';
          $email .= '<tr bgcolor="#fff">';
            $email .= '<td style="width: 30%;">'.$details['name'].'</td>';
            $email .= '<td style="width: 30%;">'.$details['email'].'<br>'.$details['phone'].'</td>';
            $email .= '<td style="width: 20%;">'.$details['paid'].'</td>';
            $email .= '<td style="width: 20%;">'.$details['shipping'].'</td>';
          $email .= '</tr>';
        $email .= '</table>';
        //customer info
        $info = Info::find(1)->asArray()->one();
        $siteInfo = Info::findOne(1);
        
        $esPhones = explode(",",$siteInfo->phone);
        $esEmail = $siteInfo->email;
        //table contacts
        $email .= '<table id="contacts">';
          $email .= '<tr>';
            $email .= '<td>'.$info['address_'.$lang].'</td>';
            $email .= '<td>'.$esPhones[0].'</td>';
          $email .= '</tr>';
          $email .= '<tr>';
            $email .= '<td>'.$esEmail.'</td>';
            $email .= '<td>'.$esPhones[1].'</td>';
          $email .= '</tr>';
        $email .= '</table>';
        //table contacts
         $email .= '<hr style="height:1px;border:none;color:#ccc;background-color:#ccc;">';
         //social
                 $email .= '<table id="social">';
          $email .= '<tr>';
            $email .= '<td align="center">';
              $email .= '<a href="https://www.facebook.com/englishstudentflashcards"><img src="https://englishstudent.net/img/fb-mail2.png" alt="fb"></a>';
              $email .= '<a href="https://plus.google.com/u/0/101890302520258498295"><img id="gplus" src="https://englishstudent.net/img/g-mail2.png" alt="g+"></a>';
              $email .= '<a href="https://www.instagram.com/english_student2016"><img src="https://englishstudent.net/img/in-mail2.png" alt="instagramm"></a>';
            $email .= '</td>';
          $email .= '</tr>';
        $email .= '</table>';
        $email .= '<table id="video" style="width: 720px; max-width: 100%">';
            $email .= '<tr style="width: 720px; max-width: 100%">';
                $email .= '<td align="center" style="width: 720px; max-width: 100%">';
                    $email .= '<a href="https://www.youtube.com/watch?v=ZZSKx_IZDYM"><img style="width: 720px; max-width: 100%" src="https://englishstudent.net/img/video-preview.jpg" alt="youtube-review"></a>';
                $email .= '</td>';
            $email .= '</tr>';
        $email .= '</table>';
         //social
        //global td end;
        $emailAdmin .= $email;
        $emailAdmin .= '<p class="title">GUID: '.$details['guid'].'</p>';
        $email .= '</td></tr>';
        $email .= "\r\n";
        $email .= '</table>';
        $email .= "\r\n";
        
        $emailAdmin .= '</td></tr>';
        $emailAdmin .= "\r\n";
        $emailAdmin .= '</table>';
        $emailAdmin .= "\r\n";
        //main table end
        $emailAdmin .= '';
        //mail($details['email'],$subjectReply,$email,$headers);

        //mail($to,$subjectReply,$emailAdmin,$headers);
        
        //smtpmail($details['name'], $details['email'], $subjectReply, $email);
        //smtpmail("ES owner", $to, $subjectReply, $emailAdmin);
        
        return $email;
        //body code where

        
    }
}
?>