<?php
namespace app\components;

use yii;
use yii\base\Widget;
use yii\helpers\Html;
use app\components\helpers\Rating;

class ProductWidget extends Widget
{
    public $message = array();
    public $seo_slag = "";
    public $comments = array();
    public $preorder;
    public $id;

    public function init()
    {
        parent::init();
        if ($this->message === null) {
            $this->message = 'Hello World';
        }
    }

    public function run(){
        $lang = Yii::$app->language;
        
        $productRating = 0;
        if (count($this->comments) > 0){
            $productRating = Rating::getRating($this->comments);
        }
        
        
        return $this->render('Product', [
            'slag' => $this->seo_slag,
            'name' => $this->message['name_'.$lang],
            'description' => $this->message['description_'.$lang],
            'rating' => $productRating,
            'countReviews' => count($this->comments),
            'price' => $this->message['price'],
            'oldPrice' => $this->message['old_price'],
            'mainImage' => $this->message['image_url'],
            'product_id' => $this->message['id'],
            'for_page' => $this->message['for_page'],
            'level' => $this->message['seo_url'],
            'pre' => $this->preorder,
            'id' => $this->message['id']
        ]);
    }
}
?>