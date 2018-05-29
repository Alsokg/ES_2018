<?php
namespace app\controllers;

use Yii;
use yii\helpers\Url;
use Yii\web\Controller;
use app\models\User;
use app\models\Sale;
use app\models\Products;
use app\models\ImageConnector;
use app\models\Images;
use app\models\AboutUs;
use app\models\KidsLanding;
use app\models\MainLanding;
use app\models\PartnersLanding;
use app\models\Info;
use app\models\Comments;
use app\models\order\Orders;
use app\models\order\OrderInfo;
use app\models\Partners;

use yii\data\ActiveDataProvider;
use yii\data\Pagination;

class AdminController extends \yii\web\Controller{

    public function beforeAction($event){
        $this->layout = 'admin';
	 $this->view->params['menu-active'] = 0;
        if( !($event->id == 'index') && !($event->id == 'login'))
        if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] == 0){ 
            $host  = $_SERVER['HTTP_HOST'];
            //$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $extra = 'uk/admin/index';
            header("Location: https://$host/$extra");
            exit();
            return true;
        }
        $this->view->params['links'] = $this->listUrls(); 
        $this->view->params['langs'] = ['uk', 'ru', 'en'];
        
        $countComments = Comments::find()->where(['viewed' => 1])->asArray()->all();
        $this->view->params['cViewed'] = count($countComments);
        
        $o = Orders::find()->where(['viewed' => 1])->asArray()->all();
        $this->view->params['oViewed'] = count($o);
        
        return parent::beforeAction($event);
    }
    public function actionIndex(){
        if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] == 0){ 
            return $this->render('login', [
                ]);
        } else {
            return $this->render('dashboard', [
                ]);
        }
    }
    public function listUrls(){
        $urls = array(
                array('Акції', Url::to(['admin/sale']), 0),
                array('Товари', Url::to(['admin/products']), 1),
                array('Сторінки', array(
                    array('Головна', Url::to(['admin/main']), 2),
                    array('Діти', Url::to(['admin/kids']), 3),
                    array('Партнери', Url::to(['admin/partners']), 4),
                    array('Видавництво', Url::to(['admin/publisher']), 5),
                    )),
                array ('Інформація', Url::to(['admin/site']), 6),
                array('Коментарі', array(
                    array('Головна', Url::to(['admin/comments/1']), 7),
                    array('Діти', Url::to(['admin/comments/3']), 8),
                    )),
                array('Замовлення', Url::to(['admin/orders/all']), 9),
                array('Зображення', Url::to(['admin/images']), 10),
                array('Лого партнерів', Url::to(['admin/logoes']), 11)
            ); 
        return $urls;
    }
    public function actionImages(){
         $this->view->params['menu-active'] = 10;
        $indir = scandir('kids/img');
        $files = array_slice($indir, 2);
        $files = array_diff($files, array('icons'));
        $files = array_diff($files, array('upload'));

        return $this->render('images',[
                'images' => $files,
            ]);
    }
    public function actionLogoes(){
        $this->view->params['menu-active'] = 11;
        $logo = Partners::find()->orderBy(['id' => SORT_DESC])->all();
        return $this->render('logoes',[
                'logoes' => $logo,
            ]);
    }
    public function actionRemovelogo(){
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = ['response' => "try"];
        
        $id = $_POST['id'];
        $comment = Partners::findOne($id);
        if ($comment){
            if ($comment->delete() !== false){
                $response->data = [
                    'success' => "Видалено Партнера",
                    'clearID' => $id
                ];
            }
            else
                $response->data = ['error' => "Помилка! Дані не можуть бути видалені!"];
        }else{
            $response->data = ['error' => "Помилка! Дані для видалення не знайдено!"];
        }
        
        $response->statusCode = 200;
        return $response;        
    }
    public function actionRemoveproduct(){
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = ['response' => "try"];
        
        $id = $_POST['id'];
        $comment = Products::findOne($id);
        $name = $comment->name_uk;
        if ($comment){
            if ($comment->delete() !== false){
                $response->data = [
                    'success' => "Видалено Товар " .$name,
                    'clearID' => $id
                ];
            }
            else
                $response->data = ['error' => "Помилка! Дані не можуть бути видалені!"];
        }else{
            $response->data = ['error' => "Помилка! Дані для видалення не знайдено!"];
        }
        
        $response->statusCode = 200;
        return $response;        
    }
    public function actionUpdatelogo(){
        
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = ['response' => "try"];
        
        $id = $_POST['id'];
        $partner = Partners::findOne($id);
        if ($partner){
            if(isset($_POST['src'])){
                $partner->image = $_POST['src'];
            }
            if(isset($_POST['alt'])){
                $partner->alt = $_POST['alt'];
            }
            if(isset($_POST['title'])){
                $partner->title = $_POST['title'];
            }
            if ($partner->update() !== false){
                $response->data = [
                    'success' => "Оновлено! Партнер номер: ".$id,
                    'refresh_src' => [
                        'src'.$id => $_POST['src']
                    ],
                ];
            }
            else
                $response->data = ['error' => "Помилка!"];
        }else{
            $response->data = ['error' => "Помилка! Партнера не знайдено!"];
        }
        
        $response->statusCode = 200;
        return $response; 
    }
    public function actionCreatelogo(){
        
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = ['response' => "try"];
        
        //$id = $_POST['id'];
        $partner = new Partners();
        if ($partner){
            if(isset($_POST['src'])){
                $partner->image = $_POST['src'];
            }
            if(isset($_POST['alt'])){
                $partner->alt = $_POST['alt'];
            }
            if(isset($_POST['title'])){
                $partner->title = $_POST['title'];
            }
            if ($partner->save() !== false){
                $response->data = [
                    'success' => "Додано нового партнера",
                    'refresh_src' => [
                        'src' => $_POST['src']
                    ],
                ];
            }
            else
                $response->data = ['error' => "Помилка!"];
        }else{
            $response->data = ['error' => "Помилка! Партнера не знайдено!"];
        }
        
        $response->statusCode = 200;
        return $response; 
    }
    public function actionUploadimages(){
        $this->view->params['menu-active'] = 10;
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $response = Yii::$app->response;
            $response->format = \yii\web\Response::FORMAT_JSON;
            if(isset($_FILES["files"])){
                $src = "File is set";
                $validextensions = array("jpeg", "jpg", "png");
               // $file_extension = end($temporary);
               $count = count($_FILES["files"]["name"]);
               for ($i = 0; $i < $count; $i++){
                  // echo $_FILES["files"]["name"][$i];
                    $temporary = explode(".", $_FILES["files"]["name"][$i]);
                    $file_extension = end($temporary);
               
                   if ((($_FILES["files"]["type"][$i] == "image/png") || ($_FILES["files"]["type"][$i] == "image/jpg") || ($_FILES["files"]["type"][$i] == "image/jpeg")
                     ) && ($_FILES["files"]["size"][$i] < 1000000)//Approx. 1000mb files can be uploaded.
                     && in_array($file_extension, $validextensions)) {
                
                     if ($_FILES["files"]["error"][$i] > 0){
                        // $response->data = ['error'][$i] => $_FILES["files"]["error"][$i];
                     }else{
                        if (file_exists("kids/img/" . $_FILES["files"]["name"][$i])) {
                           // $response['error'][$i] = $_FILES["files"]["name"][$i] . " <span id='invalid'><b>already exists.</b></span> ";
                        }else{
                            $sourcePath =  $_FILES['files']['tmp_name'][$i]; // Storing source path of the file in a variable
                                
                            $targetPath = "kids/img/" . $_FILES['files']['name'][$i]; // Target path where file is to be stored
                            //@mkdir("upload", 0777);
                            if (move_uploaded_file($sourcePath,$targetPath)){
                           //     $response['successs'][$i] = $_FILES['files']['name'][$i];// Moving Uploaded file
                            }
                        }
                   
                    }
                }
            }

            $response->statusCode = 200;
            return $response;
        }
        else throw new \yii\web\BadRequestHttpException;
    }
    }
    public function actionLogin(){
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        
        if (!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] == 0){
            $users = User::find()->asArray()->all();
            $isAdmin = false;
            $name = $_POST['username'];
            $pass = $_POST['password'];
            foreach ($users as $user){
                if ($user['name'] == $name && $user['password'] == $pass){
                    if ($user['role'] == 'Admin'){
                        $isAdmin = true;
                    }
                }
            }
            //collect data for database update
            if (!$isAdmin){
                $_SESSION['isLogged'] = 0;

                $response->data = ['error' => "failed"];
                $response->statusCode = 200;
                return $response;
            } else {
                $_SESSION['isLogged'] = 2;
                
                $response->data = ['response' => Url::to(['admin/products'])];
                $response->statusCode = 200;
                return $response;
                
            }
        } else {
                $response->data = ['response' => Url::to(['admin/products'])];
                $response->statusCode = 200;
                return $response;
        }
    }
    public function actionLogout(){
        $_SESSION['isLogged'] = 0;
        return $this->render('login', [
                ]);
    }
    public function actionDashboard(){
        return $this->render('dashboard', [
        ]);
    }
    public function actionMain(){
        $this->view->params['menu-active'] = 2;
        $Page = MainLanding::find(2)->asArray()->one();
        $page = MainLanding::find(2)->one();
        return $this->render('main', [
            'page' => $page,
            'Page' => $Page,
        ]);
    }
    public function actionSite(){
        $this->view->params['menu-active'] = 6;
        $Page = Info::find(1)->asArray()->one();
        $page = Info::find(1)->one();
        return $this->render('site', [
            'page' => $page,
            'Page' => $Page,
        ]);
    }
    public function actionKids(){
        $this->view->params['menu-active'] = 3;
        $kids = KidsLanding::find(1)->one();
        $Kids = KidsLanding::find(1)->asArray()->one();
        return $this->render('kids', [
            "page" => $kids,
            "Page" => $Kids,
            ]);
    }
    public function actionPartners(){
        $this->view->params['menu-active'] = 4;
        $page = PartnersLanding::find(1)->one();
        $Page = PartnersLanding::find(1)->asArray()->one();
        return $this->render('partners', [
                'page' => $page,
                'Page' => $Page,
            ]);
    }
        public function actionOrders($id){
            $this->view->params['menu-active'] = 9;
        
        if ($id != 'new') {
            $query = Orders::find()->orderBy(['date' => SORT_DESC]);
        } else {
            $query = Orders::find()->where(['viewed' => 1])->orderBy(['date' => SORT_DESC]);
        }
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 20]);

        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        
        $i = 0;
        
        $products = Products::find()->asArray()->all();
        foreach($models as $model){
            $orderInfo = OrderInfo::find()->where(['order_id' => $model->id])->asArray()->all();
            $models2[$i]['order'] = $model;
            $j = 0;
            foreach ($orderInfo as $info){
                $pr = Products::find()->where(['id' => $info['product_id']])->one();
                $orderInfo[$j]['product-name'] = $pr->name_uk;
                $j++;
            }
            $models2[$i]['order-info'] = $orderInfo;
            $i++;
        }

        return $this->render('orders', [
            'models' => $models2,
            'pages' => $pages,
        ]);
    }
    public function actionComments($id){

        if ($id != 'new') {
                    if ($id == 1){
            $this->view->params['menu-active'] = 7;
        } else if ($id == 3){
            $this->view->params['menu-active'] = 8;
        }
            $query = Comments::find()->where(['page_id' => $id])->orderBy(['date' => SORT_DESC]);
        } else {
            $this->view->params['menu-active'] = 7;
            $query = Comments::find()->where(['viewed' => 1])->orderBy(['date' => SORT_DESC]);
        }
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 20]);

        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        
        $i = 0;
        $products_name = array();
        foreach($models as $model){
            $product = Products::findOne($model->product_id);
            if(!$product){
                $product = Products::findOne(1);
            }
            $products[$i]['name'] = $product->name_uk;
            $products[$i]['id'] = $product->id;
            $i++;
        }

        return $this->render('comments', [
            'models' => $models,
            'pages' => $pages,
            'products' => $products,
        ]);
    }
    public function actionUpdatecommentviewed($id){
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = ['response' => "try"];
        
        //$id = $_POST['id'];
        $comment = Comments::findOne($id);
        if ($comment){
            if ($comment->viewed == 0) {
                $res = 0;
            } else {
                $res = 1;
            }
            $comment->viewed = 0;
            if ($comment->update() !== false){
                $response->data = [
                    'success' => $res
                ];
            }
            else
                $response->data = ['error' => "Помилка!"];
        }else{
            $response->data = ['error' => "Помилка! Коментар не знайдено!"];
        }
        
        $response->statusCode = 200;
        return $response; 
    }
    public function actionUpdateorderviewed($id){
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = ['response' => "try"];
        
        //$id = $_POST['id'];
        $comment = Orders::findOne($id);
        if ($comment){
            if ($comment->viewed == 0) {
                $res = 0;
            } else {
                $res = 1;
            }
            $comment->viewed = 0;
            if ($comment->update() !== false){
                $response->data = [
                    'success' => $res
                ];
            }
            else
                $response->data = ['error' => "Помилка!"];
        }else{
            $response->data = ['error' => "Помилка! Коментар не знайдено!"];
        }
        
        $response->statusCode = 200;
        return $response; 
    }
    public function actionUpdatecomment(){
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = ['response' => "try"];
        
        $id = $_POST['id'];
        $comment = Comments::findOne($id);
        if ($comment){
            if (isset($_POST['rating'])){
                $comment->rating = $_POST['rating'];
            }
            if (isset($_POST['name'])){
                $comment->name = $_POST['name'];
            }
            if (isset($_POST['email'])){
                $comment->email = $_POST['email'];
            }
            if (isset($_POST['text'])){
                $comment->text = $_POST['text'];
            }
            if (isset($_POST['featured'])){
                $comment->featured = 1;
            } else $comment->featured = 0;
            if (isset($_POST['who'])){
                $comment->who = $_POST['who'];
            }
            if (isset($_POST['publish'])){
                $comment->publish = 1;
            } else $comment->publish = 0;
            if (isset($_POST['image_src'])){
                $comment->img_src = $_POST['image_src'];
            }
            
            //comment update data where
            if ($comment->update() !== false){
                $response->data = [
                    'success' => "Оновлено коментар під номером: ".$id,
                    'refresh_src' => [
                            'image_src' => $_POST['image_src']
                        ],
                ];
            }
            else
                $response->data = ['error' => "Помилка! Дані не можуть бути видалені!"];
        }else{
            $response->data = ['error' => "Помилка! Дані для видалення не знайдено!"];
        }
        $response->statusCode = 200;
        return $response; 
    }
    public function actionRemovecomment(){
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = ['response' => "try"];
        
        $id = $_POST['id'];
        $comment = Comments::findOne($id);
        if ($comment){
            if ($comment->delete() !== false){
                $response->data = [
                    'success' => "Видалено коментар під номером: ".$id,
                    'clearID' => $id
                ];
            }
            else
                $response->data = ['error' => "Помилка! Дані не можуть бути видалені!"];
        }else{
            $response->data = ['error' => "Помилка! Дані для видалення не знайдено!"];
        }
        
        $response->statusCode = 200;
        return $response;        
    }
        public function actionRemoveorder(){
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = ['response' => "try"];
        
        $id = $_POST['id'];
        $comment = Orders::findOne($id);
        if ($comment){
            if ($comment->delete() !== false){
                $response->data = [
                    'success' => "Видалено Замовлення під номером: ".$id,
                    'clearID' => $id
                ];
            }
            else
                $response->data = ['error' => "Помилка! Дані не можуть бути видалені!"];
        }else{
            $response->data = ['error' => "Помилка! Дані для видалення не знайдено!"];
        }
        
        $response->statusCode = 200;
        return $response;        
    }
    public function actionPublisher(){
        $this->view->params['menu-active'] = 5;
        $about = AboutUs::findOne(1);
        return $this->render('publisher', [
                'about' => $about,
            ]);
    }
    public function actionSale(){
        $sales = Sale::find()->all();
        $this->view->params['menu-active'] = 0;
        return $this->render('sales',[
            'sales' => $sales,
            ]);
    }
    public function actionProducts(){
        $url = Url::home();
        $products = Products::find()->all();
        $this->view->params['menu-active'] = 1;
        
        if (!$products)
            throw new \yii\web\NotFoundHttpException();
            $productsArray = array();
            $i = 0;
        foreach ($products as $product) {
            $productsArray[$i]['id'] = $product->id;
            $productsArray[$i]['images'] = $product->images;
            $productsArray[$i]['name_uk'] = $product->name_uk;
            $productsArray[$i]['name_ru'] = $product->name_ru;
            $productsArray[$i]['name_en'] = $product->name_en;
            
            $productsArray[$i]['description_uk'] = $product->description_uk;
            $productsArray[$i]['description_ru'] = $product->description_ru;
            $productsArray[$i]['description_en'] = $product->description_en;
            
            $productsArray[$i]['price'] = $product->price;
            $productsArray[$i]['old_price'] = $product->old_price;
        
            $i++;
        }
        
        
        return $this->render('products', [
            'url' => $url,
            'products' => $productsArray,
            ]);
    }
    public function actionUpdatesite(){
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = ['response' => "try"];
        
      //  $id = $_POST['id'];
        $page = Info::findOne(1);
        if ($page){
         if (isset($_POST['address_uk'])){
                $page->address_uk = $_POST['address_uk'];
            }
            if (isset($_POST['address_ru'])){
                $page->address_ru = $_POST['address_ru'];
            }
            if (isset($_POST['address_en'])){
                $page->address_en = $_POST['address_en'];
            }            
            if (isset($_POST['phone'])){
                $page->phone = $_POST['phone'];
            }
            if (isset($_POST['email'])){
                $page->email = $_POST['email'];
            }
            if ($page->update() !== false)
                $response->data = ['success' => "Оновлено!"];
            else
                $response->data = ['error' => "Помилка! Дані не можуть бути оновлені!"];
        }else{
            $response->data = ['error' => "Помилка! Дані для оновлення не знайдено!"];
        }
        
        $response->statusCode = 200;
        return $response;
    }
    public function actionUpdateseopublisher(){
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = ['response' => "try"];
        
      //  $id = $_POST['id'];
        $about = AboutUs::findOne(1);
        if ($about){
         if (isset($_POST['title_seo_uk'])){
                $about->title_seo_uk = $_POST['title_seo_uk'];
            }
            if (isset($_POST['title_seo_ru'])){
                $about->title_seo_ru = $_POST['title_seo_ru'];
            }
            if (isset($_POST['title_seo_en'])){
                $about->title_seo_en = $_POST['title_seo_en'];
            }            
            if (isset($_POST['description_uk'])){
                $about->description_uk = $_POST['description_uk'];
            }
            if (isset($_POST['description_ru'])){
                $about->description_ru = $_POST['description_ru'];
            }
            if (isset($_POST['description_en'])){
                $about->description_en = $_POST['description_en'];
            }
            if ($about->update() !== false)
                $response->data = ['success' => "Оновлено!"];
            else
                $response->data = ['error' => "Помилка! Дані не можуть бути оновлені!"];
        }else{
            $response->data = ['error' => "Помилка! Дані для оновлення не знайдено!"];
        }
        
        $response->statusCode = 200;
        return $response;
    }
    public function actionUpdateseokids(){
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = ['response' => "try"];
        
      //  $id = $_POST['id'];
        $page = KidsLanding::findOne(1);
        if ($page){
         if (isset($_POST['site_title_uk'])){
                $page->site_title_uk = $_POST['site_title_uk'];
            }
            if (isset($_POST['site_title_ru'])){
                $page->site_title_ru = $_POST['site_title_ru'];
            }
            if (isset($_POST['site_title_en'])){
                $page->site_title_en = $_POST['site_title_en'];
            }            
            if (isset($_POST['site_description_uk'])){
                $page->site_description_uk = $_POST['site_description_uk'];
            }
            if (isset($_POST['site_description_ru'])){
                $page->site_description_ru = $_POST['site_description_ru'];
            }
            if (isset($_POST['site_description_en'])){
                $page->site_description_en = $_POST['site_description_en'];
            }
            if ($page->update() !== false)
                $response->data = ['success' => "Оновлено!"];
            else
                $response->data = ['error' => "Помилка! Дані не можуть бути оновлені!"];
        }else{
            $response->data = ['error' => "Помилка! Дані для оновлення не знайдено!"];
        }
        
        $response->statusCode = 200;
        return $response;
    }
    public function actionUpdateonekids(){
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = ['response' => "try"];
        
        $page = KidsLanding::findOne(1);
        if ($page){
            if (isset($_POST['one_title_uk'])){
                $page->one_title_uk = $_POST['one_title_uk'];
            }
            if (isset($_POST['one_title_ru'])){
                $page->one_title_ru = $_POST['one_title_ru'];
            }
            if (isset($_POST['one_title_en'])){
                $page->one_title_en = $_POST['one_title_en'];
            }            
            if (isset($_POST['one_description_uk'])){
                $page->one_description_uk = $_POST['one_description_uk'];
            }
            if (isset($_POST['one_description_ru'])){
                $page->one_description_ru = $_POST['one_description_ru'];
            }
            if (isset($_POST['one_description_en'])){
                $page->one_description_en = $_POST['one_description_en'];
            }
            if (isset($_POST['one_src'])){
                $page->one_bg_image = $_POST['one_src'];
            }
            if ($page->update() !== false){
                $response->data = [
                        'success' => "Оновлено!",
                        'refresh_src' => [
                            'one_src' => '/'.$_POST['one_src']
                        ]
                    ];
            }
            else
                $response->data = ['error' => "Помилка! Дані не можуть бути оновлені!"];
        }else{
            $response->data = ['error' => "Помилка! Дані для оновлення не знайдено!"];
        }
        
        $response->statusCode = 200;
        return $response;
    }
    public function actionUpdatetwokids(){
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = ['response' => "try"];
        
        $page = KidsLanding::findOne(1);
        if ($page){
            if (isset($_POST['two_title_uk'])){
                $page->two_title_uk = $_POST['two_title_uk'];
            }
            if (isset($_POST['two_title_ru'])){
                $page->two_title_ru = $_POST['two_title_ru'];
            }
            if (isset($_POST['two_title_en'])){
                $page->two_title_en = $_POST['two_title_en'];
            }            
            if (isset($_POST['two_src'])){
                $page->two_bg_image = $_POST['two_src'];
            }
            if ($page->update() !== false){
                $response->data = [
                        'success' => "Оновлено!",
                        'refresh_src' => [
                            'two_src' => '/'.$_POST['two_src']
                        ]
                    ];
            }
            else
                $response->data = ['error' => "Помилка! Дані не можуть бути оновлені!"];
        }else{
            $response->data = ['error' => "Помилка! Дані для оновлення не знайдено!"];
        }
        
        $response->statusCode = 200;
        return $response;
    }
    public function actionUpdatethreekids(){
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = ['response' => "try"];
        
        $page = KidsLanding::findOne(1);
        if ($page){
            if (isset($_POST['three_title_uk'])){
                $page->three_title_uk = $_POST['three_title_uk'];
            }
            if (isset($_POST['three_one_uk'])){
                $page->three_one_uk = $_POST['three_one_uk'];
            }
            if (isset($_POST['three_two_uk'])){
                $page->three_two_uk = $_POST['three_two_uk'];
            }
            if (isset($_POST['three_three_uk'])){
                $page->three_three_uk = $_POST['three_three_uk'];
            }
            if (isset($_POST['three_four_uk'])){
                $page->three_four_uk = $_POST['three_four_uk'];
            }
            if (isset($_POST['three_title_ru'])){
                $page->three_title_ru = $_POST['three_title_ru'];
            }
            if (isset($_POST['three_one_ru'])){
                $page->three_one_ru = $_POST['three_one_ru'];
            }
            if (isset($_POST['three_two_ru'])){
                $page->three_two_ru = $_POST['three_two_ru'];
            }
            if (isset($_POST['three_three_ru'])){
                $page->three_three_ru = $_POST['three_three_ru'];
            }
            if (isset($_POST['three_four_ru'])){
                $page->three_four_ru = $_POST['three_four_ru'];
            }
            if (isset($_POST['three_title_en'])){
                $page->three_title_en = $_POST['three_title_en'];
            }
            if (isset($_POST['three_one_en'])){
                $page->three_one_en = $_POST['three_one_en'];
            }
            if (isset($_POST['three_two_en'])){
                $page->three_two_en = $_POST['three_two_en'];
            }
            if (isset($_POST['three_three_en'])){
                $page->three_three_en = $_POST['three_three_en'];
            }
            if (isset($_POST['three_four_en'])){
                $page->three_four_en = $_POST['three_four_en'];
            }
            if ($page->update() !== false){
                $response->data = [
                        'success' => "Оновлено!",
                    ];
            }
            else
                $response->data = ['error' => "Помилка! Дані не можуть бути оновлені!"];
        }else{
            $response->data = ['error' => "Помилка! Дані для оновлення не знайдено!"];
        }
        
        $response->statusCode = 200;
        return $response;
    }
    
    public function actionUpdatesixkids(){
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = ['response' => "try"];
        
        $page = KidsLanding::findOne(1);
        if ($page){
            if (isset($_POST['six_title_uk'])){
                $page->six_title_uk = $_POST['six_title_uk'];
            }
            if (isset($_POST['six_title_ru'])){
                $page->six_title_ru = $_POST['six_title_ru'];
            }
            if (isset($_POST['six_title_en'])){
                $page->six_title_en = $_POST['six_title_en'];
            }            
            if (isset($_POST['six_description_uk'])){
                $page->six_description_uk = $_POST['six_description_uk'];
            }
            if (isset($_POST['six_description_ru'])){
                $page->six_description_ru = $_POST['six_description_ru'];
            }
            if (isset($_POST['six_description_en'])){
                $page->six_description_en = $_POST['six_description_en'];
            }
            if (isset($_POST['picture1_src'])){
                $page->picture_1 = $_POST['picture1_src'];
            }
            if (isset($_POST['picture2_src'])){
                $page->picture_2 = $_POST['picture2_src'];
            }
            if (isset($_POST['picture3_src'])){
                $page->picture_3 = $_POST['picture3_src'];
            }
            if (isset($_POST['picture4_src'])){
                $page->picture_4 = $_POST['picture4_src'];
            }
            if (isset($_POST['picturemain_src'])){
                $page->picture_main = $_POST['picturemain_src'];
            }
            if ($page->update() !== false){
                $response->data = [
                        'success' => "Оновлено!",
                        'refresh_src' => [
                            '1_src' => '/'.$_POST['picture1_src'],
                            '2_src' => '/'.$_POST['picture2_src'],
                            '3_src' => '/'.$_POST['picture3_src'],
                            '4_src' => '/'.$_POST['picture4_src'],
                            'main_src' => '/'.$_POST['picturemain_src'],
                        ]
                    ];
            }
            else
                $response->data = ['error' => "Помилка! Дані не можуть бути оновлені!"];
        }else{
            $response->data = ['error' => "Помилка! Дані для оновлення не знайдено!"];
        }
        
        $response->statusCode = 200;
        return $response;
    }
    public function actionUpdateonemain(){
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = ['response' => "try"];
        
        $page = MainLanding::findOne(2);
        if ($page){
            if (isset($_POST['one_title_uk'])){
                $page->one_title_uk = $_POST['one_title_uk'];
            }
            if (isset($_POST['one_title_ru'])){
                $page->one_title_ru = $_POST['one_title_ru'];
            }
            if (isset($_POST['one_title_en'])){
                $page->one_title_en = $_POST['one_title_en'];
            }            
            if (isset($_POST['one_description_uk'])){
                $page->one_description_uk = $_POST['one_description_uk'];
            }
            if (isset($_POST['one_description_ru'])){
                $page->one_description_ru = $_POST['one_description_ru'];
            }
            if (isset($_POST['one_description_en'])){
                $page->one_description_en = $_POST['one_description_en'];
            }

            if (isset($_POST['image_src'])){
                $page->image = $_POST['image_src'];
            }
            if ($page->update() !== false){
                $response->data = [
                        'success' => "Оновлено!",
                        'refresh_src' => [
                            'image_src' => '/'.$_POST['image_src'],
                        ]
                    ];
            }
            else
                $response->data = ['error' => "Помилка! Дані не можуть бути оновлені!"];
        }else{
            $response->data = ['error' => "Помилка! Дані для оновлення не знайдено!"];
        }
        
        $response->statusCode = 200;
        return $response;
    }
    public function actionUpdateonepartners(){
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = ['response' => "try"];
        
        $page = PartnersLanding::findOne(1);
        if ($page){
            if (isset($_POST['one_title_uk'])){
                $page->one_title_uk = $_POST['one_title_uk'];
            }
            if (isset($_POST['one_title_ru'])){
                $page->one_title_ru = $_POST['one_title_ru'];
            }
            if (isset($_POST['one_title_en'])){
                $page->one_title_en = $_POST['one_title_en'];
            }            
            if (isset($_POST['one_description_uk'])){
                $page->one_description_uk = $_POST['one_description_uk'];
            }
            if (isset($_POST['one_description_ru'])){
                $page->one_description_ru = $_POST['one_description_ru'];
            }
            if (isset($_POST['one_description_en'])){
                $page->one_description_en = $_POST['one_description_en'];
            }

            if (isset($_POST['image_src'])){
                $page->image = $_POST['image_src'];
            }
            if ($page->update() !== false){
                $response->data = [
                        'success' => "Оновлено!",
                        'refresh_src' => [
                            'image_src' => '/'.$_POST['image_src'],
                        ]
                    ];
            }
            else
                $response->data = ['error' => "Помилка! Дані не можуть бути оновлені!"];
        }else{
            $response->data = ['error' => "Помилка! Дані для оновлення не знайдено!"];
        }
        
        $response->statusCode = 200;
        return $response;
    }
public function actionUpdatewhopartners(){
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = ['response' => "try"];
        
        $page = PartnersLanding::findOne(1);
        if ($page){
            if (isset($_POST['list_uk'])){
                $page->list_uk = $_POST['list_uk'];
            }
            if (isset($_POST['list_ru'])){
                $page->list_ru = $_POST['list_ru'];
            }
            if (isset($_POST['list_en'])){
                $page->list_en = $_POST['list_en'];
            }            
            if ($page->update() !== false){
                $response->data = [
                        'success' => "Оновлено!",
                    ];
            }
            else
                $response->data = ['error' => "Помилка! Дані не можуть бути оновлені!"];
        }else{
            $response->data = ['error' => "Помилка! Дані для оновлення не знайдено!"];
        }
        
        $response->statusCode = 200;
        return $response;
    }
    public function actionUpdateseopartners(){
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = ['response' => "try"];
        
      //  $id = $_POST['id'];
        $page = PartnersLanding::findOne(1);
        if ($page){
         if (isset($_POST['page_title_uk'])){
                $page->page_title_uk = $_POST['page_title_uk'];
            }
            if (isset($_POST['page_title_ru'])){
                $page->page_title_ru = $_POST['page_title_ru'];
            }
            if (isset($_POST['page_title_en'])){
                $page->page_title_en = $_POST['page_title_en'];
            }            
            if (isset($_POST['page_description_uk'])){
                $page->page_description_uk = $_POST['page_description_uk'];
            }
            if (isset($_POST['page_description_ru'])){
                $page->page_description_ru = $_POST['page_description_ru'];
            }
            if (isset($_POST['page_description_en'])){
                $page->page_description_en = $_POST['page_description_en'];
            }
            if ($page->update() !== false)
                $response->data = ['success' => "Оновлено!"];
            else
                $response->data = ['error' => "Помилка! Дані не можуть бути оновлені!"];
        }else{
            $response->data = ['error' => "Помилка! Дані для оновлення не знайдено!"];
        }
        
        $response->statusCode = 200;
        return $response;
    }
    public function actionUpdatetwomain(){
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = ['response' => "try"];
        
      //  $id = $_POST['id'];
        $page = MainLanding::findOne(2);
        if ($page){
         if (isset($_POST['two_title_uk'])){
                $page->two_title_uk = $_POST['two_title_uk'];
            }
            if (isset($_POST['two_title_ru'])){
                $page->two_title_ru = $_POST['two_title_ru'];
            }
            if (isset($_POST['two_title_en'])){
                $page->two_title_en = $_POST['two_title_en'];
            }            
            if (isset($_POST['fone_title_uk'])){
                $page->fone_title_uk = $_POST['fone_title_uk'];
            }
            if (isset($_POST['fone_title_ru'])){
                $page->fone_title_ru = $_POST['fone_title_ru'];
            }
            if (isset($_POST['fone_title_en'])){
                $page->fone_title_en = $_POST['fone_title_en'];
            }   
            if ($page->update() !== false)
                $response->data = ['success' => "Оновлено!"];
            else
                $response->data = ['error' => "Помилка! Дані не можуть бути оновлені!"];
        }else{
            $response->data = ['error' => "Помилка! Дані для оновлення не знайдено!"];
        }
        
        $response->statusCode = 200;
        return $response;
    }
    public function actionUpdatethreemain(){
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = ['response' => "try"];
        
      //  $id = $_POST['id'];
        $page = MainLanding::findOne(2);
        if ($page){
         if (isset($_POST['products_title_uk'])){
                $page->products_title_uk = $_POST['products_title_uk'];
            }
            if (isset($_POST['products_title_ru'])){
                $page->products_title_ru = $_POST['products_title_ru'];
            }
            if (isset($_POST['products_title_en'])){
                $page->products_title_en = $_POST['products_title_en'];
            }            
            if (isset($_POST['products_notice_uk'])){
                $page->products_notice_uk = $_POST['products_notice_uk'];
            }
            if (isset($_POST['products_notice_ru'])){
                $page->products_notice_ru = $_POST['products_notice_ru'];
            }
            if (isset($_POST['products_notice_en'])){
                $page->products_notice_en = $_POST['products_notice_en'];
            }   
            if ($page->update() !== false)
                $response->data = ['success' => "Оновлено!"];
            else
                $response->data = ['error' => "Помилка! Дані не можуть бути оновлені!"];
        }else{
            $response->data = ['error' => "Помилка! Дані для оновлення не знайдено!"];
        }
        
        $response->statusCode = 200;
        return $response;
    }
    public function actionUpdateseomain(){
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = ['response' => "try"];
        
      //  $id = $_POST['id'];
        $page = MainLanding::findOne(2);
        if ($page){
         if (isset($_POST['site_title_uk'])){
                $page->site_title_uk = $_POST['site_title_uk'];
            }
            if (isset($_POST['site_title_ru'])){
                $page->site_title_ru = $_POST['site_title_ru'];
            }
            if (isset($_POST['site_title_en'])){
                $page->site_title_en = $_POST['site_title_en'];
            }            
            if (isset($_POST['site_description_uk'])){
                $page->site_description_uk = $_POST['site_description_uk'];
            }
            if (isset($_POST['site_description_ru'])){
                $page->site_description_ru = $_POST['site_description_ru'];
            }
            if (isset($_POST['site_description_en'])){
                $page->site_description_en = $_POST['site_description_en'];
            }
            if ($page->update() !== false)
                $response->data = ['success' => "Оновлено!"];
            else
                $response->data = ['error' => "Помилка! Дані не можуть бути оновлені!"];
        }else{
            $response->data = ['error' => "Помилка! Дані для оновлення не знайдено!"];
        }
        
        $response->statusCode = 200;
        return $response;
    }
    public function actionUpdatesevenkids(){
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = ['response' => "try"];
        
        $page = KidsLanding::findOne(1);
        if ($page){
            if (isset($_POST['seven_title_uk'])){
                $page->seven_title_uk = $_POST['seven_title_uk'];
            }
            if (isset($_POST['seven_title_ru'])){
                $page->seven_title_ru = $_POST['seven_title_ru'];
            }
            if (isset($_POST['seven_title_en'])){
                $page->seven_title_en = $_POST['seven_title_en'];
            }            
            if (isset($_POST['seven_step1_src'])){
                $page->seven_step1_src = $_POST['seven_step1_src'];
            }
            if (isset($_POST['seven_step2_src'])){
                $page->seven_step2_src = $_POST['seven_step2_src'];
            }
            if (isset($_POST['seven_step3_src'])){
                $page->seven_step3_src = $_POST['seven_step3_src'];
            }
            if (isset($_POST['seven_step1_uk'])){
                $page->seven_step1_uk = $_POST['seven_step1_uk'];
            }
            if (isset($_POST['seven_step1_ru'])){
                $page->seven_step1_ru = $_POST['seven_step1_ru'];
            }
            if (isset($_POST['seven_step1_en'])){
                $page->seven_step1_en = $_POST['seven_step1_en'];
            }       
            if (isset($_POST['seven_step2_uk'])){
                $page->seven_step2_uk = $_POST['seven_step2_uk'];
            }
            if (isset($_POST['seven_step2_ru'])){
                $page->seven_step2_ru = $_POST['seven_step2_ru'];
            }
            if (isset($_POST['seven_step2_en'])){
                $page->seven_step2_en = $_POST['seven_step2_en'];
            }            
            if (isset($_POST['seven_step3_uk'])){
                $page->seven_step3_uk = $_POST['seven_step3_uk'];
            }
            if (isset($_POST['seven_step3_ru'])){
                $page->seven_step3_ru = $_POST['seven_step3_ru'];
            }
            if (isset($_POST['seven_step3_en'])){
                $page->seven_step3_en = $_POST['seven_step3_en'];
            }            
            
            if ($page->update() !== false){
                $response->data = [
                        'success' => "Оновлено!",
                        'refresh_src' => [
                            'seven_step1_src' => '/'.$_POST['seven_step1_src'],
                            'seven_step2_src' => '/'.$_POST['seven_step2_src'],
                            'seven_step3_src' => '/'.$_POST['seven_step3_src'],
                        ]
                    ];
            }
            else
                $response->data = ['error' => "Помилка! Дані не можуть бути оновлені!"];
        }else{
            $response->data = ['error' => "Помилка! Дані для оновлення не знайдено!"];
        }
        
        $response->statusCode = 200;
        return $response;
    }
    public function actionUpdatepublisher(){
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = ['response' => "try"];
        
      //  $id = $_POST['id'];
        $about = AboutUs::findOne(1);
        if ($about){
            if (isset($_POST['title_uk'])){
                $about->title_uk = $_POST['title_uk'];
            }
            if (isset($_POST['title_ru'])){
                $about->title_ru = $_POST['title_ru'];
            }
            if (isset($_POST['title_en'])){
                $about->title_en = $_POST['title_en'];
            }            
            if (isset($_POST['content_uk'])){
                $about->content_uk = $_POST['content_uk'];
            }
            if (isset($_POST['content_ru'])){
                $about->content_ru = $_POST['content_ru'];
            }
            if (isset($_POST['content_en'])){
                $about->content_en = $_POST['content_en'];
            }
            if (isset($_POST['src'])){
                $about->image = $_POST['src'];
            }
            if ($about->update() !== false){
                $response->data = [
                        'success' => "Оновлено!",
                        'refresh_src' => [
                            'src' => substr($_POST['src'], 2)
                        ]
                    ];
            }
            else
                $response->data = ['error' => "Помилка! Дані не можуть бути оновлені!"];
        }else{
            $response->data = ['error' => "Помилка! Дані для оновлення не знайдено!"];
        }
        
        $response->statusCode = 200;
        return $response;
    }
    public function actionUpdatesales(){
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = ['response' => "try"];
        
        $id = $_POST['id'];
        $sale = Sale::findOne($id);
        if ($sale){
            if (isset($_POST['title_uk'])){
                $sale->title_uk = $_POST['title_uk'];
            }
            if (isset($_POST['title_ru'])){
                $sale->title_ru = $_POST['title_ru'];
            }
            if (isset($_POST['title_en'])){
                $sale->title_en = $_POST['title_en'];
            }
            if (isset($_POST['active'])){
                $sale->active = 1;
            } else $sale->active = 0;
            if (isset($_POST['page'])){
                $sale->for_page = $_POST['page'];
            }
            if (isset($_POST['discount'])){
                $sale->discount = $_POST['discount'];
            }
            if (isset($_POST['discount-number'])){
                $sale->products_for_discount = $_POST['discount-number'];
            }
            if ($sale->update() !== false)
                $response->data = ['success' => "Оновлено!"];
            else
                $response->data = ['error' => "Помилка! Дані не можуть бути оновлені!"];
        }else{
            $response->data = ['error' => "Помилка! Дані для оновлення не знайдено!"];
        }
        
        $response->statusCode = 200;
        return $response;
    }
    public function actionUpdateproduct(){
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = ['response' => "try"];
        
        $id = $_POST['id'];
        $product = Products::findOne($id);
        if ($product){
            if (isset($_POST['title_uk'])){
                $product->name_uk = $_POST['title_uk'];
            }
            if (isset($_POST['title_ru'])){
                $product->name_ru = $_POST['title_ru'];
            }
            if (isset($_POST['title_en'])){
                $product->name_en = $_POST['title_en'];
            }
            if (isset($_POST['description_uk'])){
                $product->description_uk = $_POST['description_uk'];
            }
            if (isset($_POST['description_ru'])){
                $product->description_ru = $_POST['description_en'];
            }
            if (isset($_POST['description_en'])){
                $product->description_en = $_POST['description_en'];
            }
            if (isset($_POST['price'])){
                $product->price = $_POST['price'];
            }
            if (isset($_POST['old_price'])){
                $product->old_price = $_POST['old_price'];
            }
            if (isset($_POST['src'])){
                $bridge = ImageConnector::findOne(['product_id' => $product->id]);
                if ($bridge){
                    $image = Images::findOne($bridge->id);
                    $image->src = $_POST['src'];
                    if (isset($_POST['alt'])){
                        $image->alt = $_POST['alt'];
                    }
                    if ($image->update() !== false)
                        $response->data = ['error' => "Помилка! Оновлення інформації картинки!"];
                }
                else {
                    $newImage = new Images();
                    $newImage->src = $_POST['src'];
                    $newImage->alt = $_POST['alt'];
                    $newImage->save();
                    $newBridge = new ImageConnector();
                    $newBridge->product_id = $product->id;
                    $newBridge->image_id = $newImage->id;
                    $newBridge->save();
                }
            }
            if ($product->update() !== false)
                $response->data = [
                    'success' => "Оновлено!",
                    'refresh_src' => [
                            'src'.$product->id => '/'.$_POST['src']
                        ]
                    ];
            else
                $response->data = ['error' => "Помилка! Дані не можуть бути оновлені!"];
        }else{
            $response->data = ['error' => "Помилка! Дані для оновлення не знайдено!"];
        }
        
        $response->statusCode = 200;
        return $response;
    }
    public function actionCreateproduct(){
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = ['response' => "try"];
        
        
        $product = new Products();
        
        if (isset($_POST['title_uk'])){
            $product->name_uk = $_POST['title_uk'];
        }
        if (isset($_POST['title_ru'])){
            $product->name_ru = $_POST['title_ru'];
        }
        if (isset($_POST['title_en'])){
            $product->name_en = $_POST['title_en'];
        }
        if (isset($_POST['description_uk'])){
            $product->description_uk = $_POST['description_uk'];
        }
        if (isset($_POST['description_ru'])){
            $product->description_ru = $_POST['description_en'];
        }
        if (isset($_POST['description_en'])){
            $product->description_en = $_POST['description_en'];
        }
        if (isset($_POST['price'])){
            $product->price = $_POST['price'];
        }
        if (isset($_POST['old_price'])){
            $product->old_price = $_POST['old_price'];
        }
        if ($product->save() !== false)
            $response->data = [
                'success' => "Додано!",
                'refresh_src' => [
                        'src'.$product->id => '/'.$_POST['src']
                    ]
                ];
        else
            $response->data = ['error' => "Помилка! Дані не можуть бути додані!"];
        if (isset($_POST['src'])){
                $newImage = new Images();
                $newImage->src = $_POST['src'];
                $newImage->alt = $_POST['alt'];
                $newImage->save();
                $newBridge = new ImageConnector();
                $newBridge->product_id = $product->id;
                $newBridge->image_id = $newImage->id;
                $newBridge->save();
        }

            $response->statusCode = 200;
        return $response;
    }
}