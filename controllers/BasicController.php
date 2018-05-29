<?php
namespace app\controllers;

use Yii;
use app\models\Info;
use app\models\Comments;

    class BasicController extends \yii\web\Controller
    {
        public function init(){
            parent::init();

        }
        public $langIndex = 0;
            public function setIndex(){
        $lang = Yii::$app->language;
      //  echo $lang;
       
        if ($lang == 'uk')
            $this->langIndex = 0;
            else if ($lang == 'ru')
                $this->langIndex = 1;
                else if ($lang == 'en')
                    $this->langIndex = 2;
           $this->view->params['langID'] = $this->langIndex;     
                   
        $siteInfo = Info::findOne(1);
        $this->view->params['site'] = $siteInfo;
        $this->view->params['phones'] = explode(",",$siteInfo->phone);
        $this->view->params['email'] = $siteInfo->email;
                   // echo $langIndex;
    }
    
    public function getCommentsByProductId($id){
      return Comments::find()->where(['product_id' => $id, 'publish' => 1, 'parent_id' => 0])->asArray()->all();
    }
     
}