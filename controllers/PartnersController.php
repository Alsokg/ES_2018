<?php

namespace app\controllers;

use Yii;
use Yii\web\Controller;
use yii\helpers\Url;
use app\models\PartnersLanding;
use app\models\Partners;


class PartnersController extends BasicController{
    public function actionIndex(){
        $this->view->params['val'] = 0;
        $this->setIndex();
        
        $page = PartnersLanding::findOne(1);
        $siteDescription = array($page->page_description_uk,$page->page_description_ru,$page->page_description_en);
         Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $siteDescription[$this->langIndex]
        ]);
        
        $title = array($page->one_title_uk,$page->one_title_ru,$page->one_title_en);
        $description = array($page->one_description_uk,$page->one_description_ru,$page->one_description_en);
        
        $two_title = array($page->two_title_uk,$page->two_title_ru,$page->two_title_en);
        $list = array($page->list_uk, $page->list_ru, $page->list_en);
        
        $listArray = array();
        $listArray = explode(',',$list[$this->langIndex]);
        $title_seo = array($page->page_title_uk,$page->page_title_ru,$page->page_title_en);
        $partners = Partners::find()->asArray()->all();
        
        return $this->render('partners',[
                'image' => $page->image,
                'title' => $title[$this->langIndex],
                'title_seo' => $title_seo[$this->langIndex],
                'description' => $description[$this->langIndex],
                'twoTitle' => $two_title[$this->langIndex],
                'listPartners' => $listArray,
                'partners' => $partners,
            ]);
    }
    public function actionOrder(){
        if (Yii::$app->request->isAjax) {
           
            $result = include("mail/sendPartner.php");
            $result = include("mail/sendClientP.php");
            $response = Yii::$app->response;
            $response->format = \yii\web\Response::FORMAT_JSON;
            $response->data = ['echo' => "good"];
            $response->statusCode = 200;
            return $response;
        }else throw new \yii\web\BadRequestHttpException;
    }
}
