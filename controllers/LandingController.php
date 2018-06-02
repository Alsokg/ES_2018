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

use app\models\Sliders;
use app\models\Adven;

use app\models\order\Orders;
use app\models\order\OrderInfo;
use app\models\order\OrderConnector;

//custom components
use app\components\helpers\Rating;
use app\components\ProductWidget;
use app\components\MultyProductWidget;
use app\components\blocks\Block1Widget;
use app\components\CardsWidget;
use app\components\SliderWidget;
use app\components\AdvenWidget;

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
        
        
        $themesMulty = explode("-and-", $pageSeoUrl);
        $it = 0;
        $cardsWidget = array();
        
        $cardsNav = array();
        
        foreach ($themesMulty as $id) {
            $fileName[] = array(
                'filePath' => "common/".$id."-themes.php",
                'name' => $products[$it]['name_'.$lang],
                );
            $cardsWidget[$it] = CardsWidget::widget([
                    'message' => include("common/".$id."-cards.php"),
                ]);
            $cardsNav[] = array(
                    'id' => $id,
                    'name' => $products[$it]['name_'.$lang]
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
                'notice' => true,
                'title' => Yii::t('yii', 'multy-pr-title'),
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
            'cardsWidget' => $cardsWidget,
            'cardsNav' => $cardsNav,
            'random' => $page['random_'.$lang],
            'themes_list' => $fileName,
            'class_cards' => $pageSeoUrl,
            'pre' => $page['preorder'],
            ]);
    }
    
    public function actionKids(){
        
       
        $url = Url::home();
       // echo $url;
       $this->view->params['val'] = 3;

        $this->setIndex();
        
        $kids = KidsLanding::find()->one(); // get info for kids
    $one_title = array($kids->one_title_uk, $kids->one_title_ru, $kids->one_title_en);
    $one_description = array($kids->one_description_uk, $kids->one_description_ru, $kids->one_description_en);
    
    $two_title = array($kids->two_title_uk, $kids->two_title_ru, $kids->two_title_en);
    
    $three_title = array($kids->three_title_uk, $kids->three_title_ru, $kids->three_title_en);
    $three_one = array($kids->three_one_uk, $kids->three_one_ru, $kids->three_one_en);
    $three_two = array($kids->three_two_uk, $kids->three_two_ru, $kids->three_two_en);
    $three_three = array($kids->three_three_uk, $kids->three_three_ru, $kids->three_three_en);
    $three_four = array($kids->three_four_uk, $kids->three_four_ru, $kids->three_four_en);
    $four_title = array($kids->four_title_uk, $kids->four_title_ru, $kids->four_title_en); 
    
    $six_title = array($kids->six_title_uk, $kids->six_title_ru, $kids->six_title_en);
    $six_description = array($kids->six_description_uk, $kids->six_description_ru, $kids->six_description_en);
    
    $seven_title = array($kids->seven_title_uk, $kids->seven_title_ru, $kids->seven_title_en);
    $seven_step1 = array($kids->seven_step1_uk, $kids->seven_step1_ru, $kids->seven_step1_en);
    $seven_step2 = array($kids->seven_step2_uk, $kids->seven_step2_ru, $kids->seven_step2_en);
    $seven_step3 = array($kids->seven_step3_uk, $kids->seven_step3_ru, $kids->seven_step3_en);
    
    $seven1Src = $url.$kids->seven_step1_src;
    $seven2Src = $url.$kids->seven_step2_src;
    $seven3Src = $url.$kids->seven_step3_src;
    
    //sale section
    $sale = Sale::find()->where(['active' => 1, 'for_page' => 3])->one();
    
    $sale_title = array($sale->title_uk, $sale->title_ru, $sale->title_en);
    
    //product section
    $product = Products::findOne(1);
    $images = $product->images;
    $product_name = array($product->name_uk, $product->name_ru, $product->name_en);
    $procut_description = array($product->description_uk, $product->description_ru, $product->description_en);
        
        
    $siteTitle = array($kids->site_title_uk,$kids->site_title_ru,$kids->site_title_en);
    $siteDescription = array($kids->site_description_uk,$kids->site_description_ru,$kids->site_description_en);
    
    
    if ($this->langIndex == 0){
        
$this->view->params['seo'] = $kids->seo_text_uk;
    } else if ($this->langIndex == 1){
        
$this->view->params['seo'] = $kids->seo_text_ru;
    } else if ($this->langIndex == 2){
        
$this->view->params['seo'] = $kids->seo_text_en;
    }
    Yii::$app->view->registerMetaTag([
        'name' => 'description',
        'content' => $siteDescription[$this->langIndex]
    ]);
$siteInfo = Info::findOne(1);

$formComment = $this->renderPartial('comment', []);

$comments = $this->getRawComments($this->view->params['val']);

$this->allCommentsCount = count($this->getPageRatings($this->view->params['val']));

$sorted = array();
$childs = array();
$i = 0;
foreach ($comments as $com){
    if($com['parent_id'] == 0){
        $sorted[$com['id']] = $com;
    } else {
        $childs[$com['id']] = $com;
    }
}

foreach ($childs as $child){
    $sorted[$child['parent_id']]['childs'][$child['id']] = $child;
}
//var_dump($sorted);
$this->allPageComments = $sorted;

$rating = 0;
$commentsR = Comments::find()->where(['page_id' => $this->view->params['val'], 'publish' => 1, 'parent_id' => 0])->asArray()->all();
foreach($commentsR as $comment){
    $rating += $comment['rating'];
}
if (count($commentsR) > 0){
$rating = round($rating/count($commentsR), 0, PHP_ROUND_HALF_UP);
} else { $rating = 0; }

//new kids code 

$sliderData = Sliders::find()->where(['page' => 'kids'])->asArray()->one();

$slider = SliderWidget::widget([
                    'className' => 'kids-main-slider',
                    'data' => $sliderData,
                ]);
                
        
$pazzles = explode(",", $kids->two_bg_image);

$advenData = Adven::find()->where(['page_id' => $kids->page_id])->asArray()->all();

$advens = AdvenWidget::widget([
        'title' => $three_title[$this->langIndex],
        'advens' => $advenData,
    ]);
    
    $products = Products::find()->where(['publish' => 1, 'for_page' => 'kids'])->asArray()->all();
    
    $i = 0;
foreach ($products as $pr) {
            
            
            $image = Images::find()->where(['id' => $products[$i]['image_connector']])->asArray()->one();
            $products[$i]['image-src'] = "/".$image["src"];
            $products[$i]['image-alt'] = $image["alt"];
            $i++;
        }
//new kids code end



        return $this->render('kids', [
            'langID' => $this->langIndex,
            'siteInfo' => $siteInfo,
            'title' => $siteTitle[$this->langIndex],
            'oneTitle' => $one_title[$this->langIndex],
            'oneDescription' => $one_description[$this->langIndex],
            'oneSrc' => $kids->one_bg_image,
            'pazzles' => $pazzles,
            'twoTitle' => $two_title[$this->langIndex],
            'threeTitle' => $three_title[$this->langIndex],
            'threeOne' => $three_one[$this->langIndex],
            'threeTwo' => $three_two[$this->langIndex],
            'threeThree' => $three_three[$this->langIndex],
            'threeFour' => $three_four[$this->langIndex],
            'fourTitle' => $four_title[$this->langIndex],
            'sale' => $sale_title[$this->langIndex],
            'sixTitle' => $six_title[$this->langIndex],
            'sixDescription' => $six_description[$this->langIndex],
            'picture_1' => $kids->picture_1,
            'picture_2' => $kids->picture_2,
            'picture_3' => $kids->picture_3,
            'picture_4' => $kids->picture_4,
            'picture_main' => $kids->picture_main,
            'sevenTitle' => $seven_title[$this->langIndex],
            'sevenStep1' => $seven_step1[$this->langIndex],
            'sevenStep2' => $seven_step2[$this->langIndex],
            'sevenStep3' => $seven_step3[$this->langIndex],
            'seven1Src' => $seven1Src,
            'seven2Src' => $seven2Src,
            'seven3Src' => $seven3Src,
            'productImages' => $images,
            'productName' => $product_name[$this->langIndex],
            'productDescription' => $procut_description[$this->langIndex],
            'price' => $product->price,
            'url' => $url,
            'productID' => $product->id,
            'comments' => $this->getFeaturedComments($this->view->params['val']),
            'formComment' => $formComment,
            'rating' => $rating,
            'countReviews' => count($commentsR),
            'allComments' => $this->allPageComments,
            'globalCount' => $this->allCommentsCount,
            'mainSlider' => $slider,
            'advens' => $advens,
            'productWidget' => MultyProductWidget::widget([
                'slag' => $pageSeoUrl,
                'products' => $products,
                'sale' => '',
                'notice' => false,
                'title' => 'kids',
            ]),
            
        ]);
    }
    // import this to heloer
    public $allPageComments = "";
     public $allCommentsCount = "";
     
        public function getRawComments($id){
        return Comments::find()->where(['page_id' => $id, 'publish' => 1])->orderBy(['date' => SORT_DESC])->asArray()->all();
    }
    
    public function actionAll($id){
        //if (Yii::$app->request->isAjax) {
            $comments = Comments::find()->where(['page_id' => $id, 'publish' => 1])->asArray()->all();

         $len = 50;
         $i = 0;
         foreach ($comments as $comment){
            if (strlen($comment['text']) > $len){
                $comment['text'] = substr($comment['text'], 0, $len - 3) . "...";
                $comment['cut'] = 1;
            } else {
                $comment['cut'] = 0;
            }
            $comments[$i++] = $comment;
         }

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                        return  json_encode($comments);
        //}
        //else throw new \yii\web\BadRequestHttpException;
    }    
        public function getProductRatings($id){
        return Comments::find()->where(['product_id' => $id, 'publish' => 1, 'parent_id' => 0])->asArray()->all();
    }
    public function getPageRatings($id){
        return Comments::find()->where(['page_id' => $id, 'publish' => 1, 'parent_id' => 0])->asArray()->all();
    }
    public function actionPositive($id){
        if (Yii::$app->request->isAjax) {
            
            $response = Yii::$app->response;
            $response->format = \yii\web\Response::FORMAT_JSON;
            $comment = Comments::findOne($id);
            
            if (array_key_exists('negative'.$id, $_SESSION)){
                if ($_SESSION['negative'.$id] == 1){
                      $comment->positive += 1;
                }
                
                $_SESSION['negative'.$id] = 0;
                $_SESSION['positive'.$id] = 1;
            } else {

                $_SESSION['positive'.$id] = 1;
                $comment->total_reviews += 1;
                $comment->positive += 1;
            }
            $comment->update();
            $response->data = [$comment->total_reviews, $comment->positive];
            return $response;
        }else throw new \yii\web\BadRequestHttpException;
    }
    public function actionNegative($id){
        if (Yii::$app->request->isAjax) {
                        $response = Yii::$app->response;
            $response->format = \yii\web\Response::FORMAT_JSON;
            $comment = Comments::findOne($id);
            
            if (array_key_exists('positive'.$id, $_SESSION)){
                if ($_SESSION['positive'.$id] == 1){
                      $comment->positive -= 1;
                }
                
                $_SESSION['positive'.$id] = 0;
                $_SESSION['negative'.$id] = 1;
            } else {

                $_SESSION['negative'.$id] = 1;
                $comment->total_reviews += 1;
                //$comment->positive += 1;
            }
            $comment->update();
             $response->data = [$comment->total_reviews, $comment->positive];

            return $response;
        }else throw new \yii\web\BadRequestHttpException;
    }
    
    //helper ends


public function splitDate($date){
    $time = explode('-',($date));
    $comment = array();
    $comment['day'] = $time[0];
    $comment['month'] = $time[1];
    $comment['year'] = $time[2];
    return $comment;
}

public function getFeaturedComments($id){
        $len = 150;
         $i = 0;
         $comments = Comments::find()->where(['page_id' => $id,  'publish' => 1, 'featured' => 1])->asArray()->limit(5)->all();
         foreach ($comments as $comment){

            $comment['time'] = $this->splitDate($comment['date']);
             $comment['full_text'] = $comment['text'];//save full text
            if (strlen($comment['text']) > $len){
                $comment['text'] = substr($comment['text'], 0, $len - 10) . "...";
                $comment['cut'] = 1;
            } else {
                $comment['cut'] = 0;
            }
            $comments[$i++] = $comment;
         }
    return $comments;
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