<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\helpers\Url;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Info;
use app\models\KidsLanding;
use app\models\Sale;
use app\models\Products;

class OrderController extends Controller{
    public function actionIndex(){
    echo Yii::$app->request->isAjax;
    }
}



?>