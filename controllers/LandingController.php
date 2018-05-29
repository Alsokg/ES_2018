<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\helpers\Url;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Info;
use app\models\Pages;
use app\models\KidsLanding;
use app\models\MainLanding;
use app\models\Sale;
use app\models\Products;
use app\models\Comments;
use app\models\Images;
use app\models\LandingPages;
use app\models\MultyLandingPages;
use app\models\PolskaCards;

use app\models\order\Orders;
use app\models\order\OrderInfo;
use app\models\order\OrderConnector;

//custom components
use app\components\helpers\Rating;
use app\components\ProductWidget;
use app\components\MultyProductWidget;
use app\components\blocks\Block1Widget;
use app\components\CardsWidget;

class LandingController extends BasicController{
    public $sl;
    public function actionIndex(){
        
        $this->view->params['val'] = 10;
        $this->setIndex();
        
        return $this->render('landing', [
            ]);
    }
    public function actionPage(){
        
        $lang = Yii::$app->language;
        
        $pageSeoUrl = $_SERVER['REQUEST_URI'];
        $this->sl = $pageSeoUrl;
        while (strpos($pageSeoUrl, '?') !== false){
            $pageSeoUrl = substr($pageSeoUrl, 0, strpos($pageSeoUrl, '?'));
        }
        
        while (strpos($pageSeoUrl, '/') !== false){
            $pageSeoUrl = substr($pageSeoUrl, strpos($pageSeoUrl, '/') + 1);
        }
        $this->view->params['val'] = $pageSeoUrl;
        $this->setIndex();
        $_SESSION['seo_url'] = $pageSeoUrl;
        $_SESSION['pageimg'] = $pageSeoUrl;
        
        
        $products = Products::find()->where(['publish' => 1, 'for_page' => $pageSeoUrl])->asArray()->all();
        
        //bind products data to view
        $productsArray = array();
        $singleProduct = array();
        foreach ($products as $product){
            $singleProduct = $product;
            $image_url = Images::find()->where(['id' => $product['image_connector']])->asArray()->one();
            $singleProduct['image_url'] = $image_url;
        }
        
        //Rating::getRating($products);
        $comments = $this->getCommentsByProductId($singleProduct['id']);
        //use single widget
        
        //blocks select
        $page = LandingPages::find()->where(['for_page' => $pageSeoUrl])->asArray()->one();

        
        $cards = array();
        $fileName = "";
        if ($pageSeoUrl == 'polska'){
            $cards = PolskaCards::find()->asArray()->all();
            $fileName = "common/polska-themes.php";
        } else if ($pageSeoUrl == 'german'){
            //$cards = PolskaCards::find()->asArray()->all();
            $cards = include('common/german-cards.php');
            $fileName = "common/german-themes.php";
        } else {
            $cards = include('common/'.$pageSeoUrl.'-cards.php');
            $fileName = "common/".$pageSeoUrl."-themes.php";
        }
        
        $this->view->params['seo'] = $page['seo_text_'.$lang];
        
        
        
        Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $page['page_description_'.$lang],
        ]);
        
        return $this->render('landing', [
            'title_seo' => $page['page_title_'.$lang],
            'productWidget' => ProductWidget::widget([
                'message' => $singleProduct,
                'preorder' => $page['preorder'],
                'seo_slag' => $pageSeoUrl,
                'comments' => $comments,
                ]),
            'block1' => Block1Widget::widget([
                'title' => $page['block1_title_'.$lang],
                'description' => $page['block1_description_'.$lang],
                'image_bg_url' => $page['image_bg_url'],
                'preorder' => $page['preorder'],
                'slag2' => $page['for_page'],
                'class_cards' => $pageSeoUrl,
                ]),
            'themes_title' => $page['block2_title_'.$lang],
            'cardsWidget' => CardsWidget::widget([
                'message' => $cards,
                ]),
            'random' => $page['random_'.$lang],
            'themes_list' => $fileName,
            'class_cards' => $pageSeoUrl,
            'pre' => $page['preorder'],
            ]);
    }
    
    public function actionMultypage(){
        
        $lang = Yii::$app->language;
        
        $pageSeoUrl = $_SERVER['REQUEST_URI'];
        
        $this->sl = $pageSeoUrl;
        while (strpos($pageSeoUrl, '?') !== false){
            $pageSeoUrl = substr($pageSeoUrl, 0, strpos($pageSeoUrl, '?'));
        }
        
        while (strpos($pageSeoUrl, '/') !== false){
            $pageSeoUrl = substr($pageSeoUrl, strpos($pageSeoUrl, '/') + 1);
        }
        $this->view->params['val'] = $pageSeoUrl;
        $this->setIndex();
        $_SESSION['seo_url'] = $pageSeoUrl;
        $_SESSION['pageimg'] = $pageSeoUrl;
        
        $page = MultyLandingPages::find()->where(['for_page' => $pageSeoUrl])->asArray()->one();
        
        $pagesProducts = explode(",", $page['productIds']);
        $products = array();
        
        $sale = Sale::find()->where(["slag" => $pageSeoUrl, "active" => 1])->asArray()->one();
        
        $i = 0;
        foreach ($pagesProducts as $id) {
            $products[$i] = Products::find()->where(['publish' => 1, 'id' => $id])->asArray()->one();
            
            $image = Images::find()->where(['id' => $products[$i]['image_connector']])->asArray()->one();
            $products[$i]['image-src'] = "/".$image["src"];
            $products[$i]['image-alt'] = $image["alt"];
            $i++;
        }
        
        
        //bind products data to view
        
        //Rating::getRating($products);
        //use single widget
        
        //blocks select
        

        
        $cards = array();
        $fileName = array();
        $cards = include('common/business-cards.php');
        
        $themesMulty = explode("-and-", $pageSeoUrl);
        $it = 0;
        foreach ($themesMulty as $id) {
            $fileName[] = array(
                'filePath' => "common/".$id."-themes.php",
                'name' => $products[$it]['name_en'],
                );
            $it++;
        }
        
        $this->view->params['seo'] = $page['seo_text_'.$lang];
        
        Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $page['page_description_'.$lang],
        ]);
        
        return $this->render('multyLanding', [
            'title_seo' => $page['page_title_'.$lang],
            'productWidget' => MultyProductWidget::widget([
                'slag' => $pageSeoUrl,
                'products' => $products,
                'sale' => $sale,
                ]),
            'block1' => Block1Widget::widget([
                'title' => $page['block1_title_'.$lang],
                'description' => $page['block1_description_'.$lang],
                'image_bg_url' => $page['image_bg_url'],
                'preorder' => $page['preorder'],
                'slag2' => $page['for_page'],
                'class_cards' => $pageSeoUrl,
                ]),
            'themes_title' => $page['block2_title_'.$lang],
            'cardsWidget' => CardsWidget::widget([
                'message' => $cards,
                ]),
            'random' => $page['random_'.$lang],
            'themes_list' => $fileName,
            'class_cards' => $pageSeoUrl,
            'pre' => $page['preorder'],
            ]);
    }
    
    public function actionOrder(){
        if (Yii::$app->request->isAjax) {
            $q = array();
            $p = array();
            $q[0] = 0;
            $p[0] = 0;
            
            if (isset($_POST['phone'])){
                $phone = $_POST['phone'];
            } else $phone = "";
            if (isset($_POST['email'])){
                $email = $_POST['email'];
            } else $email = "";
            if (isset($_POST['name'])){
                $name = $_POST['name'];
            } else $name = "";
            if(isset($_POST['qty1'])){
                $q[0] = $_POST['qty1']; 
            } else $q[0] = 0;
            if(isset($_POST['price-kids'])){
                $p[0] = $_POST['price-kids'];
            } else $p[0] = 0;

            if (isset($_POST['delivery1']))
                $paid = $_POST['delivery1'];
            else $paid = "";
            
                $price = $q[0]*$p[0];
            
            $lastOrder = Orders::find()->orderBy(['id' => SORT_DESC])->one();
            
            $Order = new Orders();
            $Order->id = $lastOrder->id + 1;
            $Order->date = date("Y-m-d H:i:s");
            $Order->shipping = 0;
            $Order->payment = $paid;
            $Order->phone = $phone;
            $Order->comment = 0;
            $Order->total_price = $price;
            $Order->email = $email;
            $Order->name = $name;
            $Order->guid = $_POST['guid'];
            $Order->save();

		    $_SESSION['price'] = $price;
            $_SESSION['guid'] = $_POST['guid'];
            $_SESSION['name0'] = $name;
            
            $lastOrderInfo = OrderInfo::find()->orderBy(['id' => SORT_DESC])->one();
            $lastOrderInfoID = $lastOrderInfo->id;
            
            for ($i = 0; $i < count($q); $i++){
                if ($q[$i] > 0){
                    $info = new OrderInfo();
                    //$info->id = $i; AUTO INCREMENT is enought
                    $info->product_id = $_POST['product_id'];
                    $info->order_id = $lastOrder->id + 1;
                    $info->qty_product = $q[$i];
                    $info->price = $p[$i];
                    $info->save();
                }
            }
            
            // CRM
            $eacher = 0;
		$products_list[] = array( 
            		'product_id' => 1,    //код товара (из каталога CRM)
            		'price'      => 0, //цена товара 1
            		'count'      => 0                      //количество товара 1
	);

			$prId = $eacher - 1;
			$prCRM = $eacher + 1;
			$products_list[] = array( 
            			'product_id' => $_POST['product_id'],    //код товара (из каталога CRM)
            			'price'      => $p[0], //цена товара 1
            			'count'      => $q[0]                      //количество товара 1
			);
		

$products = urlencode(serialize($products_list));
 
// параметры запроса
$data = array(
    'key'             => '5ff80341f20ca14e228488c1cfb59318', //Ваш секретный токен
    'order_id'        => number_format(round(microtime(true)*10),0,'.',''), //идентификатор (код) заказа (*автоматически*)
    'country'         => 'UA',                      // Географическое направление заказа
    'office'          => '',                   // Офис (id в CRM)
    'products'        => $products,                 // массив с товарами в заказе
    'bayer_name'      => $name,             // покупатель (Ф.И.О)
    'phone'           => $phone,           // телефон
    'email'           => $email,           // электронка
    'comment'         => '',    // комментарий
    'site'            => $_SERVER['SERVER_NAME'],  // сайт отправляющий запрос
    'ip'              => $_SERVER['REMOTE_ADDR'],  // IP адрес покупателя
    'delivery'        => 1,        // способ доставки (id в CRM)
    'delivery_adress' => '', // адрес доставки
    'payment'         => '',          // вариант оплаты (id в CRM)
    'utm_source'      => $_SESSION['utms']['utm_source'],  // utm_source 
    'utm_medium'      => $_SESSION['utms']['utm_medium'],  // utm_medium 
    'utm_term'        => $_SESSION['utms']['utm_term'],    // utm_term   
    'utm_content'     => $_SESSION['utms']['utm_content'], // utm_content    
    'utm_campaign'    => $_SESSION['utms']['utm_campaign'] // utm_campaign
);
 
// запрос
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'http://englishstudent.lp-crm.biz/api/addNewOrder.html');
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$out = curl_exec($curl);
curl_close($curl);
//CRM end
            
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
$boxName = array($_SESSION['seo_url'],"A1", "A2", "B1", "B2",);
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
	$message .= $_SESSION['seo_url']."</td><td>";
	$message .= $q1 . "</td><td>";
	$message .= $q1*$p1 . "</td><td>";
	$start = 1;
}

$message .= $paid;

$message .= "</td></tr><tr>";
if($start < 5){
	for ($i = $start; $i < 5; $i++){
		if($box[$i] > 0)
			$message .= "<td></td><td></td><td></td><td>$boxName[$i]</td><td>" . $box[$i] . "</td><td>" . $box[$i]*$boxPrice[$i] . "</td><td></td><td></td></tr><tr>";
	}

}
$message .= "<td></td><td></td><td></td><td></td><td></td><td>Сумма</td><td>" . $price . "</td></tr></table>"; 

$messageReply = "";
$messageReply .= " Ваше замовлення  прийнято." . "<br>" . "Ми зв’яжемось з Вами найближчим часом для підтвердження. " . "<br><br>" . "Дані замовлення" . "<br><br>";

$messageReply .= $message;

$messageReply .= "Команда English Student<br>";
$messageReply .= "+38 (066) 638 74 30<br>+38 (073) 227 14 65<br>";
$messageReply .= "Сума: " . $price . "грн" . "\r\n" . "<br>";
    
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

$headers .= 'From: <englishstudent.net>' . "\r\n";

mail($email,$subjectReply,$messageReply,$headers);

mail($to,$subject,$message,$headers);
            $response = Yii::$app->response;
            $response->format = \yii\web\Response::FORMAT_JSON;
            $response->data = ['echo' => "good"];
            $response->statusCode = 200;
            return $response;
        } else {
            throw new \yii\web\BadRequestHttpException;
        }
    }
}