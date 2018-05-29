<?php
namespace app\components;

use yii;
use yii\base\Widget;
use yii\helpers\Html;

class SliderWidget extends Widget
{
    public $data = array();
    public $className;

    public function init()
    {
        parent::init();
        $data = array();
    }

    public function run(){
        return $this->render('Slider', [
            'className' => $this->className,
            'data' => explode(',', $this->data['images']),
            'lang' => Yii::$app->language,
        ]);
    }
}
?>