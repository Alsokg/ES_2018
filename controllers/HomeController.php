<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\helpers\Url;
use yii\filters\VerbFilter;

use app\models\PagesPreview;
use app\models\PreviewBlock;

use app\components\ProductPreviewWidget;

class HomeController extends BasicController{

    public function actionIndex(){
        
        $this->view->params['val'] = 1111;
        $this->setIndex();
        
        $lang = Yii::$app->language;
        
        $title = "title 2";
        Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => 'description',
        ]);
        
        
        $home = PagesPreview::find()->where(['id' => 1])->asArray()->one();
        
        $content = PreviewBlock::find()->where(['page_id' => $home['pages_id']])->asArray()->all();
        
        $previews = array();
        foreach ($content as $preview){
            $previews[] = ProductPreviewWidget::widget([
                    'data' => $preview,
                ]);
        }
        
        return $this->render('home',[
            'title' => $title,
            'content' => $previews,
            'h1' => $home['title_'.$lang],
        ]);
    }
    
}