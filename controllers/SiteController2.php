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

use app\models\order\Orders;
use app\models\order\OrderInfo;
use app\models\order\OrderConnector;

class SiteController extends BasicController
{
    /**
     * @inheritdoc
     */
     
     public $allPageComments = "";
     public $allCommentsCount = "";
     
        public function actionLog()
        {
            $dateGlobal = date("Y-m-d H:i:s");
            $prefix = explode(' ', $dateGlobal);
            if (Yii::$app->request->isAjax) {
                $data = Yii::$app->request->post();
                $src = $_POST['image-src'];
                if(isset($_FILES["ava-file"])){
                    $src = "File is set";
                    $validextensions = array("jpeg", "jpg", "png");
                    $temporary = explode(".", $_FILES["ava-file"]["name"]);
                    $file_extension = end($temporary);
                    if ((($_FILES["ava-file"]["type"] == "image/png") || ($_FILES["ava-file"]["type"] == "image/jpg") || ($_FILES["ava-file"]["type"] == "image/jpeg")
                        ) && ($_FILES["ava-file"]["size"] < 100000)//Approx. 100kb files can be uploaded.
                        && in_array($file_extension, $validextensions)) {
                        
                        if ($_FILES["ava-file"]["error"] > 0){
                            $src = "Return Code: " . $_FILES["ava-file"]["error"] . "<br/><br/>";
                        }else{
                            if (file_exists("upload/" . $prefix[0] . $_FILES["ava-file"]["name"])) {
                                $src = $_FILES["ava-file"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
                            }else{
                                $sourcePath =  $_FILES['ava-file']['tmp_name']; // Storing source path of the file in a variable
                                
                                $targetPath = "upload/" . $prefix[0] . $_FILES['ava-file']['name']; // Target path where file is to be stored
                                //@mkdir("upload", 0777);
                                if (move_uploaded_file($sourcePath,$targetPath)){
                                    $src = $prefix[0] . $_FILES['ava-file']['name'];// Moving Uploaded file
                                } else {
                                    $src = $_POST['image-src'];
                                }
                            }
                        }
                    }else{
                       $src = $_POST['image-src'];
                    }
                }
                        $name = $data['name-comment'];
                        $text = $data['comment-comment'];
                        $email = $data['email-comment'];
                        $rating = $data['rating'];
                        $page_id = $data['page-id'];
                        if (array_key_exists('box-input', $data))
                            $product_id = $data['box-input'];
                            else
                            $product_id = 0;
                        $who = $data['who-comment'];
                        $public = 0;
                        $featured = 0;
                        if ($src[0] == 'h'){
                            $url = $src;
                            ini_set('allow_url_fopen' , 1);
                            
                            $imgName =  str_replace(' ', '', $name);
                            $fileName = 'upload/'.$imgName.'.jpg';
                           copy($url, $fileName);
                            $imgSrc = '/'.$fileName; 
                        } else {
                            $imgSrc = "/upload/".$src;
                        }
                        
                        //$log = new History();
                        //$log->name = $filename;
                        //$log->save();
                        $comment = new Comments();
                        $comment->name = $name;
                        $comment->text = $text;
                        $comment->email = $email;
                        $comment->publish = $public;
                        $comment->featured = $featured;
                        $comment->img_src = $imgSrc;
                        $comment->date = $dateGlobal;
                        $comment->positive = 0;
                        $comment->total_reviews = 0;
                        $comment->rating = $rating;
                        $comment->lang_id = Yii::$app->language;
                        $comment->page_id = $page_id;
                        $comment->who = $who;
                        $comment->product_id = $product_id;
                        $comment->parent_id = $data['parent-id'];
                        
                        $comment->save();
                        
                        $result = include("mail/sendComment.php");
                
                        $response = Yii::$app->response;
                        $response->format = \yii\web\Response::FORMAT_JSON;
                        $response->data = ['src' => $src];
                        $response->statusCode = 200;
                        return $response;
                }
                else throw new \yii\web\BadRequestHttpException;
        }
    public function actionFull(){
        if (Yii::$app->request->isAjax) {
            //collect data for database update
            $data = Yii::$app->request->post();
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
            if(isset($_POST['qty11'])){
                $q[1] = $_POST['qty11']; 
            } else $q[1] = 0;
            if(isset($_POST['qty12'])){
                $q[2] = $_POST['qty12'];
            } else $q[2]  =0;
            if(isset($_POST['qty13'])){
                $q[3] = $_POST['qty13'];
            } else $q[3] = 0;
            if(isset($_POST['qty14'])){
                $q[4] = $_POST['qty14'];
            } else $q[4] = 0;
            if(isset($_POST['qty15'])){
                $q[5] = $_POST['qty15'];
            } else $q[5] = 0;
            if(isset($_POST['price1'])){
                $p[1] = $_POST['price1'];
            } else $p[1] = 0;
            if(isset($_POST['price2'])){
                $p[2] = $_POST['price2'];
            } else $p[2] = 0;
            if(isset($_POST['price3'])){
                $p[3] = $_POST['price3'];
            } else $p[3] = 0;
            if(isset($_POST['price4'])){
                $p[4] = $_POST['price4'];
            } else $p[4] = 0;
            if(isset($_POST['price5'])){
                $p[5] = $_POST['price5'];
            } else $p[5] = 0;

            if (isset($_POST['delivery1']))
                $paid = $_POST['delivery1'];
            else $paid = "";
            if (isset($_POST['ttl']))
                $price = $_POST['ttl'];
            else $price = 0;
            
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
            
            
            $lastOrderInfo = OrderInfo::find()->orderBy(['id' => SORT_DESC])->one();
            $lastOrderInfoID = $lastOrderInfo->id;
            
            for ($i = 1; $i < count($q); $i++){
                if ($q[$i] > 0){
                    $info = new OrderInfo();
                    //$info->id = $i; AUTO INCREMENT is enought
                    $info->product_id = $i;
                    $info->order_id = $lastOrder->id + 1;
                    $info->qty_product = $q[$i];
                    $info->price = $p[$i];
                    $info->save();
                }
            }
            
            $result = include("mail/sendFull.php");
            $response = Yii::$app->response;
            $response->format = \yii\web\Response::FORMAT_JSON;
            $response->data = ['echo' => $result];
            $response->statusCode = 200;
            return $response;
        }else throw new \yii\web\BadRequestHttpException;
    }
    public function actionOrderkids(){
        if (Yii::$app->request->isAjax) {
            //collect data for database update
            $data = Yii::$app->request->post();
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
                $q[1] = $_POST['qty1']; 
            } else $q[1] = 0;
            if(isset($_POST['price-kids'])){
                $p[1] = $_POST['price-kids'];
            } else $p[1] = 0;

            if (isset($_POST['delivery1']))
                $paid = $_POST['delivery1'];
            else $paid = "";
            
                $price = $q[1]*$p[1];
            
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
            
            $lastOrderInfo = OrderInfo::find()->orderBy(['id' => SORT_DESC])->one();
            $lastOrderInfoID = $lastOrderInfo->id;
            
            for ($i = 1; $i < count($q); $i++){
                if ($q[$i] > 0){
                    $info = new OrderInfo();
                    //$info->id = $i; AUTO INCREMENT is enought
                    $info->product_id = $i;
                    $info->order_id = $lastOrder->id + 1;
                    $info->qty_product = $q[$i];
                    $info->price = $p[$i];
                    $info->save();
                }
            }
            
            $result = include("mail/sendOrder.php");
            $response = Yii::$app->response;
            $response->format = \yii\web\Response::FORMAT_JSON;
            $response->data = ['echo' => "good"];
            $response->statusCode = 200;
            return $response;
        }else throw new \yii\web\BadRequestHttpException;
    }    
     

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
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

    
    public function actionFlash(){
        
       
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

        return $this->render('index', [
            'langID' => $this->langIndex,
            'siteInfo' => $siteInfo,
            'title' => $siteTitle[$this->langIndex],
            'oneTitle' => $one_title[$this->langIndex],
            'oneDescription' => $one_description[$this->langIndex],
            'oneSrc' => $kids->one_bg_image,
            'twoSrc' => $kids->two_bg_image,
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
            
        ]);
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
    public function actionIndex()
    { $url = Url::home();
       // echo $url;
        $this->view->params['val'] = 1;
        $this->setIndex();
        
        $main = MainLanding::find()->one();
        
        $one_title = array($main->one_title_uk,$main->one_title_ru,$main->one_title_en);
        $one_description = array($main->one_description_uk, $main->one_description_ru, $main->one_description_en);
        
        $two_title = array($main->two_title_uk, $main->two_title_ru, $main->two_title_en);
        
        $fone_title = array($main->fone_title_uk, $main->fone_title_ru, $main->fone_title_en);
        $products_title = array($main->products_title_uk, $main->products_title_ru, $main->products_title_en);
        $products_notice = array($main->products_notice_uk, $main->products_notice_ru, $main->products_notice_en);
        
            $siteTitle = array($main->site_title_uk,$main->site_title_ru,$main->site_title_en);
    $siteDescription = array($main->site_description_uk,$main->site_description_ru,$main->site_description_en);
         Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $siteDescription[$this->langIndex]
        ]);
        
        $sale = Sale::find()->where(['active' => 1, 'for_page' => 1])->one();
    $salePr = 0;
      //  $sale_title = array($sale->title_uk, $sale->title_ru, $sale->title_en);
                if ($sale){
            $sale_title = array($sale->title_uk, $sale->title_ru, $sale->title_en);
            $salePr = $sale->products_for_discount;
            $saleDiscount = $sale->discount; 
        } else {
            $sale_title = array("", "", "");
            $salePr = 0;
            $saleDiscount = 0; 
        }
        $product = Products::find()->asArray()->all();
        
        $products = array();
        $i = 1;
        for ($i = 1; $i < 5; $i++){
            if ($product[$i]){
                $arrName = array($product[$i]['name_uk'],$product[$i]['name_ru'],$product[$i]['name_en']);
                $products[$i - 1] = $product[$i];
                $pr = Products::findOne($i + 1);
                $images = $pr->images;
                $products[$i - 1]['images'] = $images;
                $products[$i - 1]['name'] = $arrName[$this->langIndex];
            }
        }
        
            //product section
    $product1 = Products::findOne(1);
    $images1 = $product1->images;
    $product_name1 = array($product1->name_uk, $product1->name_ru, $product1->name_en);
    $procut_description1 = array($product1->description_uk, $product1->description_ru, $product1->description_en);
    if ($this->langIndex == 0){
        
$this->view->params['seo'] = $main->seo_text_uk;
    } else if ($this->langIndex == 1){
        
$this->view->params['seo'] = $main->seo_text_ru;
    } else if ($this->langIndex == 2){
        
$this->view->params['seo'] = $main->seo_text_en;
    }
    
    $productComments = array();
    $ratings = array();
    
    for ($i = 2; $i < 6; $i++){
        $productComments[$i] = $this->getProductRatings($i);
        $ratings[$i] = array();
        $ratings[$i]['total_rating'] = 0;
        foreach($productComments[$i] as $comment){
            $ratings[$i]['total_rating'] += $comment['rating'];
        }
        if (count($productComments[$i]) > 0){
            $ratings[$i]['total'] = count($productComments[$i]);
            $ratings[$i]['rating'] = round($ratings[$i]['total_rating']/count($productComments[$i]), 0, PHP_ROUND_HALF_UP);
        } else {
            $ratings[$i]['total'] = 0;
            $ratings[$i]['rating'] = 0;
        }
    }
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
    
    //kids ratting for main
    $comments_kids = Comments::find()->where(['page_id' => 3, 'publish' => 1, 'parent_id' => 0])->asArray()->all();

    $rating_kids = 0;
    foreach($comments_kids as $comment){
        $rating_kids += $comment['rating'];
    }
    if (count($comments_kids) > 0) {
    $rating_kids = round($rating_kids/count($comments_kids), 0, PHP_ROUND_HALF_UP);
    } else { $rating_kids = 0; }
    
    $formComment = $this->renderPartial('comment', [
            'productsArray' => $products,
        ]);
        return $this->render('flash', [
            'langID' => $this->langIndex,
            'oneTitle' => $one_title[$this->langIndex],
            'oneDescription' => $one_description[$this->langIndex],
            'twoTitle' => $two_title[$this->langIndex],
            'foneTitle' => $fone_title[$this->langIndex],
            'productsTitle' => $products_title[$this->langIndex],
            'productsNotice' => $products_notice[$this->langIndex],
            'productsArray' => $products,
            'url' => $url,
            'productImages' => $images1,
            'productName' => $product_name1[$this->langIndex],
            'productDescription' => $procut_description1[$this->langIndex],
            'title' => $siteTitle[$this->langIndex],
            'price' => $product1->price,
            'kidsID' =>$product1->id,
            'sale' => $sale_title[$this->langIndex],
            'saleCount' => $salePr,
            'discount' => $saleDiscount,            
            'formComment' => $formComment,
            'comments' => $this->getFeaturedComments($this->view->params['val']),
            'allRatings' => $ratings,
            'rating' => $rating_kids,
		'commentsKids' => count($comments_kids),
            'countReviews' => count($this->getPageRatings($this->view->params['val'])),
            'allComments' => $this->allPageComments,
            'globalCount' => $this->allCommentsCount,
            ]);
    }
    
    public function actionFaq(){
        
        $info = Pages::findOne('faq');
        
        $this->view->params['val'] = 0;
        $this->setIndex();
        $content = array($info->content_uk,$info->content_ru, $info->content_en);
        
        return $this->render('faq', [
                'content' => $content[$this->langIndex],
            ]);
    }
    
    public function actionInfo($id){
        
        $info = Pages::findOne($id);
        
        $this->view->params['val'] = 1;
        $this->setIndex();
        if (!$info)
            throw new \yii\web\NotFoundHttpException();
        $content = array($info->content_uk,$info->content_ru, $info->content_en);

         $url = Url::home();
       // echo $url;

        
        $main = MainLanding::find()->one();
        
        $one_title = array($main->one_title_uk,$main->one_title_ru,$main->one_title_en);
        $one_description = array($main->one_description_uk, $main->one_description_ru, $main->one_description_en);
        
        $two_title = array($main->two_title_uk, $main->two_title_ru, $main->two_title_en);
        
        $fone_title = array($main->fone_title_uk, $main->fone_title_ru, $main->fone_title_en);
        $products_title = array($main->products_title_uk, $main->products_title_ru, $main->products_title_en);
        $products_notice = array($main->products_notice_uk, $main->products_notice_ru, $main->products_notice_en);
        
            $siteTitle = array($main->site_title_uk,$main->site_title_ru,$main->site_title_en);
    $siteDescription = array($main->site_description_uk,$main->site_description_ru,$main->site_description_en);
         Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $siteDescription[$this->langIndex]
        ]);
        
        $sale = Sale::find()->where(['active' => 1, 'for_page' => 1])->one();
    
        $sale_title = array($sale->title_uk, $sale->title_ru, $sale->title_en);
                        if ($sale){
            $sale_title = array($sale->title_uk, $sale->title_ru, $sale->title_en);
            $salePr = $sale->products_for_discount;
            $saleDiscount = $sale->discount; 
        } else {
            $sale_title = array("", "", "");
            $salePr = 0;
            $saleDiscount = 0; 
        }
        $product = Products::find()->asArray()->all();
        
        $products = array();
        $i = 1;
        for ($i = 1; $i < 5; $i++){
            if ($product[$i]){
                $arrName = array($product[$i]['name_uk'],$product[$i]['name_ru'],$product[$i]['name_en']);
                $products[$i - 1] = $product[$i];
                $pr = Products::findOne($i + 1);
                $images = $pr->images;
                $products[$i - 1]['images'] = $images;
                $products[$i - 1]['name'] = $arrName[$this->langIndex];
            }
        }
        
            //product section
    $product1 = Products::findOne(1);
    $images1 = $product1->images;
    $product_name1 = array($product1->name_uk, $product1->name_ru, $product1->name_en);
    $procut_description1 = array($product1->description_uk, $product1->description_ru, $product1->description_en);
    $productComments = array();
    $ratings = array();
    
    for ($i = 2; $i < 6; $i++){
        $productComments[$i] = $this->getProductRatings($i);
        $ratings[$i] = array();
        $ratings[$i]['total_rating'] = 0;
        foreach($productComments[$i] as $comment){
            $ratings[$i]['total_rating'] += $comment['rating'];
        }
        if (count($productComments[$i]) > 0){
            $ratings[$i]['total'] = count($productComments[$i]);
            $ratings[$i]['rating'] = round($ratings[$i]['total_rating']/count($productComments[$i]), 0, PHP_ROUND_HALF_UP);
        } else {
            $ratings[$i]['total'] = 0;
            $ratings[$i]['rating'] = 0;
        }
    }
    $comments = $this->getRawComments(1);
    
    $this->allCommentsCount = count($this->getPageRatings(1));
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
    
    //kids ratting for main
    $comments_kids = Comments::find()->where(['page_id' => 3, 'publish' => 1, 'parent_id' => 0])->asArray()->all();

    $rating_kids = 0;
    foreach($comments_kids as $comment){
        $rating_kids += $comment['rating'];
    }
    if (count($comments_kids) > 0){
    $rating_kids = round($rating_kids/count($comments_kids), 0, PHP_ROUND_HALF_UP);
    } else{
        $rating_kids = 0;
    }
    
    $formComment = $this->renderPartial('comment', [
            'productsArray' => $products,
        ]);
        return $this->render('flash', [
            'langID' => $this->langIndex,
            'oneTitle' => $one_title[$this->langIndex],
            'oneDescription' => $one_description[$this->langIndex],
            'twoTitle' => $two_title[$this->langIndex],
            'foneTitle' => $fone_title[$this->langIndex],
            'productsTitle' => $products_title[$this->langIndex],
            'productsNotice' => $products_notice[$this->langIndex],
            'productsArray' => $products,
            'url' => $url,
            'productImages' => $images1,
            'productName' => $product_name1[$this->langIndex],
            'productDescription' => $procut_description1[$this->langIndex],
            'title' => $siteTitle[$this->langIndex],
            'price' => $product1->price,
            'kidsID' =>$product1->id,
            'sale' => $sale_title[$this->langIndex],
            'saleCount' => $salePr,
            'discount' => $saleDiscount, 
            'formComment' => $formComment,
            'comments' => $this->getFeaturedComments(1),
            'allRatings' => $ratings,
'commentsKids' => count($comments_kids),
            'rating' => $rating_kids,
            'countReviews' => count($comments_kids),
            'allComments' => $this->allPageComments,
            'globalCount' => $this->allCommentsCount,
            ]);
    }
}
