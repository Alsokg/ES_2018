<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\helpers\Url;
use yii\filters\VerbFilter;

use app\models\Sale;
use app\models\Products;
use app\models\Comments;

use app\models\order\Orders;
use app\models\order\OrderInfo;
use app\models\order\OrderConnector;

use app\models\Success;
use app\models\TestSeo;

class TestController extends BasicController{
    public function actionIndex(){
        $url = Url::home();
        $this->view->params['val'] = "test";
        $this->setIndex();
        $lang = Yii::$app->language;
        
        $test = TestSeo::find()->asArray()->all();
        
         Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $test['description_'.$lang]
        ]);
        
        $sale = Sale::find()->where(['active' => 1, 'for_page' => 1])->one();
    
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
        $product = Products::find()->where(['publish' => 1, 'for_page' => '1'])->asArray()->all();
        
        $products = array();
        $i = 1;
        for ($k = 1; $k < count($product); $k++){
            if ($product[$i]){
                $arrName = array($product[$i]['name_uk'],$product[$i]['name_ru'],$product[$i]['name_en']);
                $products[$i - 1] = $product[$i];
                $pr = Products::findOne($i + 1);
                $images = $pr->images;
                $products[$i - 1]['images'] = $images;
                $products[$i - 1]['name'] = $arrName[$this->langIndex];
		$products[$i - 1]['new'] = $product[$i]['new'];
		$products[$i - 1]['popular'] = $product[$i]['popular'];
            }
            $i++;
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
        
        
        
        return $this->render('test', [
                'langID' => $this->langIndex,
                'title' => $test['title_'.$lang],
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
            ]);
    }
    public function actionDev(){
                $url = Url::home();
        $this->view->params['val'] = "test";
        $this->setIndex();
        $lang = Yii::$app->language;
        
        $test = TestSeo::find()->asArray()->one();
        
         Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $test['description_'.$lang]
        ]);
        
        $sale = Sale::find()->where(['active' => 1, 'for_page' => 1])->one();
    
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
        $product = Products::find()->where(['publish' => 1, 'for_page' => '1'])->asArray()->all();
        
        $products = array();
        $i = 1;
        for ($k = 1; $k < count($product); $k++){
            if ($product[$i]){
                $arrName = array($product[$i]['name_uk'],$product[$i]['name_ru'],$product[$i]['name_en']);
                $products[$i - 1] = $product[$i];
                $pr = Products::findOne($i + 1);
                $images = $pr->images;
                $products[$i - 1]['images'] = $images;
                $products[$i - 1]['name'] = $arrName[$this->langIndex];
		$products[$i - 1]['new'] = $product[$i]['new'];
		$products[$i - 1]['popular'] = $product[$i]['popular'];
            }
            $i++;
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
        
        
        
        return $this->render('dev', [
                'langID' => $this->langIndex,
                'title' => $test['title_'.$lang],
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
            ]);
    }
    public function actionProduct(){
        if (Yii::$app->request->isAjax) {
            //product builder
            $seoUrl = "";
            if (isset($_POST['product'])){
                $seoUrl = $_POST['product'];
            } else throw new \yii\web\BadRequestHttpException;
            
            if ($seoUrl == "b1"){
                $seoUrl = array();
                $seoUrl[0] = "b11";
                $seoUrl[1] = "b12";
            } else if ($seoUrl == "b2"){
                $seoUrl = array();
                $seoUrl[0] = "b21";
                $seoUrl[1] = "b22";
            } else {
                //shit code
                $product = Products::find()->where(['seo_url' => $seoUrl])->one();
                $images = $product->images;
                $product = Products::find()->where(['seo_url' => $seoUrl])->asArray()->one();

                $lang = Yii::$app->language;
                $result = array();
                $result[0] = array();
                $result[0]['title'] = $product['name_'.$lang];
                $result[0]['id'] = $product['id'];
                $result[0]['description'] = $product['description_'.$lang];
                $result[0]['old'] = $product['old_price'];
                $result[0]['price'] = $product['price'];
                $result[0]['img'] = $images;
                
                $response = Yii::$app->response;
                $response->format = \yii\web\Response::FORMAT_JSON;
                $response->data = ['response' => $result];
                $response->statusCode = 200;
                return $response;
            }
            if (is_array($seoUrl)){
                //process multiply products
               //process multiply products
                $images2 = array();
                //some bug
                $images2[0] = array();
                $images2[0][0] = array();
                $images2[1] = array();
                $images2[1][0] = array();
                
                if ($seoUrl[0] == "b11"){
                    $images2[0][0]['src'] = "img/b11.jpg";
                    $images2[0][0]['alt'] = "box-b11";
                } else if ($seoUrl[1] == "b12"){
                    $images2[0][0]['src'] = "img/b12.jpg";
                    $images2[0][0]['alt'] = "box-b12";
                }
                if ($seoUrl[0] == "b21"){
                    $images2[1][0]['src'] = "img/b21.jpg";
                    $images2[1][0]['alt'] = "box-b21";
                } else if ($seoUrl[1] == "b22"){
                    $images2[1][0]['src'] = "img/b222.jpg";
                    $images2[1][0]['alt'] = "box-b212";
                }
                $product2 = Products::find()->orWhere(['and', ['seo_url'=> $seoUrl[0]]])->orWhere(['and', ['seo_url'=> $seoUrl[1]]])->asArray()->all();
                
                $lang = Yii::$app->language;
                $result = array();
                $i = 0;
                foreach($product2 as $pr){
                    $result[$i]['title'] = $pr['name_'.$lang];
                    $result[$i]['description'] = $pr['description_'.$lang];
                    $result[$i]['old'] = $pr['old_price'];
                    $result[$i]['price'] = $pr['price'];
                    $result[$i]['img'] = $images2[$i];
                    $result[$i]['id'] = $pr['id'];
                    $i = $i + 1;
                }
                
                $response = Yii::$app->response;
                $response->format = \yii\web\Response::FORMAT_JSON;
                $response->data = ['response' => $result];
                $response->statusCode = 200;
                return $response;
            }
        } else throw new \yii\web\BadRequestHttpException;
        
    }
}
