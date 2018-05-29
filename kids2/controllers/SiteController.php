<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Info;
use app\models\KidsLanding;
use app\models\Sale;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
     public $langIndex = 0;
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    private function setIndex(){
        $lang = Yii::$app->language;
        echo $lang;
        if ($lang == "uk")
            $langIndex = 0;
            else if ($lang == "ru")
                $lanfIndex = 1;
                else if ($lang == "en")
                    $langIndex = 2;
    }

    public function actionIndex()
    {
        
//         // Load all tables of the application in the schema
// Yii::app()->db->schema->getTables();
// // clear the cache of all loaded tables
// Yii::app()->db->schema->refresh();
//         Yii::app()->cache->flush();
        $this->view->params['val'] = 3;
        $siteInfo = Info::findOne(1);
        $this->view->params['site'] = $siteInfo;
        $this->setIndex();
        echo $langIndex;
        
        $kids = KidsLanding::find()->one(); // get info for kids
        
        

//var_dump($kids);
    
    $one_title = array($kids->one_title_uk, $kids->one_title_ru, $kids->one_title_en);
    $one_description = array($kids->one_description_uk, $kids->one_description_ru, $kids->one_description_en);
    
    $two_title = array($kids->two_title_uk, $kids->two_title_ru, $kids->two_title_en);
    
    $three_title = array($kids->three_title_uk, $kids->three_title_ru, $kids->three_title_en);
    $three_one = array($kids->three_one_uk, $kids->three_one_ru, $kids->three_one_en);
    $three_two = array($kids->three_two_uk, $kids->three_two_ru, $kids->three_two_en);
    $three_three = array($kids->three_three_uk, $kids->three_three_ru, $kids->three_three_en);
    $three_four = array($kids->three_four_uk, $kids->three_four_ru, $kids->three_four_en);
    $four_title = array($kids->four_title_uk, $kids->four_title_ru, $kids->four_title_en); 
    
    $six_title = array($kids->six_title_uk, $kids->six_title_ru, $kids->six_title_en);
    $six_description = array($kids->six_description_uk, $kids->six_description_ru, $kids->six_description_en);
    
    $seven_title = array($kids->seven_title_uk, $kids->seven_title_ru, $kids->seven_title_en);
    $seven_step1 = array($kids->seven_step1_uk, $kids->seven_step1_ru, $kids->seven_step1_en);
    $seven_step2 = array($kids->seven_step2_uk, $kids->seven_step2_ru, $kids->seven_step2_en);
    $seven_step3 = array($kids->seven_step3_uk, $kids->seven_step3_ru, $kids->seven_step3_en);
    
    $sale = Sale::find()->where(['active' => 1])->one();
    
    $sale_title = array($sale->title_uk, $sale->title_ru, $sale->title_en);
        
        
        return $this->render('index', [
            'siteInfo' => $siteInfo,
            'oneTitle' => $one_title[$this->langIndex],
            'oneDescription' => $one_description[$this->langIndex],
            'oneSrc' => $kids->one_bg_image,
            'twoSrc' => $kids->two_bg_image,
            'twoTitle' => $two_title[$this->langIndex],
            'threeTitle' => $three_title[$this->langIndex],
            'threeOne' => $three_one[$this->langIndex],
            'threeTwo' => $three_two[$this->langIndex],
            'threeThree' => $three_three[$this->langIndex],
            'threeFour' => $three_four[$this->langIndex],
            'fourTitle' => $four_title[$this->langIndex],
            'sale' => $sale_title[$this->langIndex],
            'sixTitle' => $six_title[$this->langIndex],
            'sixDescription' => $six_description[$this->langIndex],
            'picture_1' => $kids->picture_1,
            'picture_2' => $kids->picture_2,
            'picture_3' => $kids->picture_3,
            'picture_4' => $kids->picture_4,
            'picture_main' => $kids->picture_main,
            'sevenTitle' => $seven_title[$this->langIndex],
            'sevenStep1' => $seven_step1[$this->langIndex],
            'sevenStep2' => $seven_step2[$this->langIndex],
            'sevenStep3' => $seven_step3[$this->langIndex],
            'seven1Src' => $kids->seven_step1_src,
            'seven2Src' => $kids->seven_step2_src,
            'seven3Src' => $kids->seven_step3_src,
        ]);
    }
}
