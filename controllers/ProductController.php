<?php

namespace app\controllers;

use Yii;
use Yii\web\Controller;
use yii\helpers\Url;
use app\models\Products;
use app\models\Comments;

class ProductController extends BasicController{
    public function actionIndex($id){
        
        $url = Url::home();
        $this->view->params['val'] = 10;
        $this->setIndex();
        
        $product = Products::find($id)->where(['seo_url' => $id])->one();
	if (!$product)
            throw new \yii\web\NotFoundHttpException();
    $image = $product->images;
    $product_name = array($product->name_uk, $product->name_ru, $product->name_en);
    $product_description = array($product->description_uk, $product->description_ru, $product->description_en);
    
    
    //kids ratting for main
    $comments = Comments::find()->where(['product_id' => $product->id, 'publish' => 1, 'parent_id' => 0])->asArray()->all();

    $rating = 0;
    foreach($comments as $comment){
        $rating += $comment['rating'];
    }
    if (count($comments) > 0) {
        $rating = round($rating/count($comments), 0, PHP_ROUND_HALF_UP);
    } else { $rating = 0; }
         Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $product_description[$this->langIndex]
        ]);
        
        return $this->render('product',[
                'title' => $product_name[$this->langIndex],
                'url' => $url,
                'productImages' => $image,
                'productName' => $product_name[$this->langIndex],
                'rating' => $rating,
                'countReviews' => count($comments),
                'productDescription' => $product_description[$this->langIndex],
                'price' => $product->price,
            ]);
    }
}
