<?php
namespace app\components;

use yii;
use yii\base\Widget;
use yii\helpers\Html;

class AdvenWidget extends Widget
{
    public $advens = array();
    public $title;

    public function init()
    {
        parent::init();
        $advens = array();
        $title = "";
    }

    public function run(){
        return $this->render('Adven', [
            'advens' => $this->advens,
            'title' => $this->title,
            'lang' => Yii::$app->language,
        ]);
    }
}
?>