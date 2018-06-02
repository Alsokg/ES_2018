<?php
namespace app\components;

use yii;
use yii\base\Widget;
use yii\helpers\Html;
use app\components\helpers\Rating;

class MultyProductWidget extends Widget
{
    public $products = array();
    public $slag = "";
    public $notice;
    public $sale;
    public $title;


    public function init()
    {
        parent::init();
    }

    public function run(){
        $lang = Yii::$app->language;
        
        return $this->render('MultyProduct', [
            'slag' => $this->slag,
            'productsArray' => $this->products,
            'sale' => $this->sale,
            'lang' => $lang,
            'notice' => $this->notice,
            'title' => $this->title
        ]);
    }
}
?>