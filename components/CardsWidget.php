<?php
namespace app\components;

use yii;
use yii\base\Widget;
use yii\helpers\Html;

class CardsWidget extends Widget
{
    public $message = array();

    public function init()
    {
        parent::init();
        if ($this->message === null) {
            $this->message = 'Hello World';
        }
    }

    public function run(){
        return $this->render('Cards', [
            'cards' => $this->message,
        ]);
    }
}
?>