<?php
namespace app\components\blocks;

use yii;
use yii\base\Widget;
use yii\helpers\Html;

class Block1Widget extends Widget{

    public $title;
    public $description;
    public $image_bg_url;
    public $preorder;
    public $slag2;
    public $class_cards;
    
    public function init()    {
        parent::init();

    }

    public function run(){
            return $this->render('Block1', [
                'title' => $this->title,
                'pre' => $this->preorder,
                'description' => $this->description,
                'bg' => $this->image_bg_url,
                'slag2' => $this->slag2,
                'class_cards' => $this->class_cards,
            ]);
    }
}
?>