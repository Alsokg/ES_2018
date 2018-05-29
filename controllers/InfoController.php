<?php

namespace app\controllers;

use Yii;
use Yii\web\Controller;
use yii\helpers\Url;
use app\models\AboutUs;


class InfoController extends BasicController{
    public function actionIndex(){
        $this->view->params['val'] = 0;
        $this->setIndex();
        
        $about = AboutUs::findOne(1);
        
        $title = array($about->title_uk,$about->title_ru,$about->title_en);
        $description = array($about->content_uk,$about->content_ru,$about->content_en);
        
        $description_seo = array($about->title_seo_uk,$about->title_seo_ru,$about->title_seo_en);
        
        $title_seo = array($about->title_seo_uk,$about->title_seo_ru,$about->title_seo_en);
        
        Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $description_seo[$this->langIndex]
        ]);
        return $this->render('info',[
                'image' => $about->image,
                'title' => $title[$this->langIndex],
                'title_seo' => $title_seo[$this->langIndex],
                'description' => $description[$this->langIndex],
            ]);
    }
}
