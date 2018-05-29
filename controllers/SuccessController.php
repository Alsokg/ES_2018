<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\helpers\Url;
use yii\filters\VerbFilter;

use app\models\Success;
use app\models\LandingPages;

class SuccessController extends BasicController{
    public function actionIndex(){
        $url = Url::home();
        $this->view->params['val'] = 100;
        $this->setIndex();
        
        //block url parser for detect correct image on page
        $hash = Url::current();
        $hash = substr($hash, strpos($hash, '?') + 1);
        if (strlen($hash) > 0){
            $hash = substr($hash, 0, -1);
        }
        //block end
        
        $image = "";
        if (isset($_SESSION['pageimg'])){
            $hash = $_SESSION['pageimg'];
        }
        
        $main = Success::find()->one();
        $image = $main->image;
        
        if ($_SESSION['pageimg']){
            if ($_SESSION['pageimg'] != "kids"){
                $lp = LandingPages::find()->where(['for_page' => $hash])->asArray()->one();
                $image = $lp['image_bg_url'];
            } else {
                $image = "/img/mom.jpg";
            }
        }
        unset($_SESSION['pageimg']);
        
        $one_title = array($main->one_title_uk,$main->one_title_ru,$main->one_title_en);
        $one_description = array($main->one_description_uk, $main->one_description_ru, $main->one_description_en);
        
        $siteTitle = array($main->one_title_uk,$main->one_title_ru,$main->one_title_en);
        $siteDescription = array($main->one_description_uk,$main->one_description_ru,$main->one_description_en);
         Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $siteDescription[$this->langIndex]
        ]);
        
        return $this->render('success', [
                'langID' => $this->langIndex,
                'oneTitle' => $one_title[$this->langIndex],
                'oneDescription' => $one_description[$this->langIndex],
                'image' => $image,
                'title' => $hash,
            ]);
    }
}
