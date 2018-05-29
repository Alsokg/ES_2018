<?php
namespace app\components;

use yii;
use yii\base\Widget;
use yii\helpers\Html;

class ProductPreviewWidget extends Widget
{
    public $data = array();

    public function init()
    {
        parent::init();
        $data = array();
    }

    public function run(){
        return $this->render('Preview', [
            'data' => $this->data,
            'lang' => Yii::$app->language,
        ]);
    }
}
?>