<?php

namespace app\controllers;

use Yii;
use Yii\web\Controller;
use yii\helpers\Url;
use app\models\MainLanding;
use app\models\Pages;

class AllController extends BasicController{
    public function actionIndex(){
        
        $this->view->params['val'] = 111;
        $this->setIndex();
        
        $main = MainLanding::find()->one();
        
        $title = array($main->one_title_uk,$main->one_title_ru,$main->one_title_en);
        $description = array($main->one_description_uk, $main->one_description_ru, $main->one_description_en);
        
        $description_seo = array($main->site_description_uk,$main->site_description_ru,$main->site_description_en);
        
        $title_seo = array($main->site_title_uk,$main->site_title_ru,$main->site_title_en);
        Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $description_seo[$this->langIndex]
        ]);
        
        $pages = Pages::find()->all();
        
        
        return $this->render('all',[
                'image' => $main->image,
                'title' => $title[$this->langIndex],
                'title_seo' => $title_seo[$this->langIndex],
                'description' => $description[$this->langIndex],
                'pages' => $pages,
            ]);
    }
}
    ?>