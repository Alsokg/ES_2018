<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\helpers\Url;
use yii\filters\VerbFilter;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use app\models\Success;
use app\models\TestLiqpayCallback;
use app\models\order\Orders;
use app\models\LandingPages;
class LiqpayController extends BasicController{
    public function beforeAction($action) {
    $this->enableCsrfValidation = false;
    return parent::beforeAction($action);
    }
    public function actionIndex(){
        $url = Url::home();
        $this->view->params['val'] = 100;
        $this->setIndex();
        
        $main = Success::find()->one();
        
        $one_title = array($main->one_title_uk,$main->one_title_ru,$main->one_title_en);
        $one_description = array($main->one_description_uk, $main->one_description_ru, $main->one_description_en);
        
        $siteTitle = array($main->one_title_uk,$main->one_title_ru,$main->one_title_en);
        $siteDescription = array($main->one_description_uk,$main->one_description_ru,$main->one_description_en);
         Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $siteDescription[$this->langIndex]
        ]);
        
        return $this->render('liqpay', [
                'langID' => $this->langIndex,
                'oneTitle' => $one_title[$this->langIndex],
                'oneDescription' => $one_description[$this->langIndex],
                'image' => $main->image,
                'title' => 'Оплата Liqpay',
            ]);
    }
    public function actionResponse(){
        
        $this->view->params['val'] = 100;
        $this->setIndex();
      $myfile = fopen("testfile.txt", "w");
        $private_key = 'dVLfgSSyOYH8naKRYiunnHhgzbbao1jYz7RqzET3';
        $post = $_POST['data'];
        if (empty($_POST['data']) || empty($_POST['signature'])) {
            throw new BadRequestHttpException();
        }
        $sign = base64_encode( sha1($private_key . $post . $private_key, 1 ));
        if ($sign != $_POST['signature']){
            fwrite($myfile, "SIGNATURE ERROR!");
        }
        $data = json_decode(base64_decode($post), true);
        //fwrite($myfile, $data['order_id']);
        
        $order = Orders::find()->where(['guid' => $data['order_id']])->one();
        $order->payment_status = $data['status'];
        $nam = $order->name;
        $order->update();
        
        
         $token    = 'YOUR_TOKEN_HERE';
        $domain   = 'english-student';
        $channel  = '#customers';
        $bot_name = 'Webhook';
        $icon     = ':alien:';
        $message  = 'Зміна статусу оплати';
        
        $attachments = array([
            'fallback' => 'LIQPAY',
            'pretext'  => 'Відповідь від LIQPAY',
            'color'    => '#ff6600',
            'fields'   => array(
                [
                    'title' => 'Статус: ',
                    'value' => $data['status'],
                    'short' => true
                ],
                [
                    'title' => 'Від: ',
                    'value' => $nam,
                    'short' => false
                ],
                [
                    'title' => 'GUID: ',
                    'value' => $data['order_id'],
                    'short' => false
                ]
            )
        ]);
        $data = array(
            'channel'     => $channel,
            'username'    => $bot_name,
            'text'        => $message,
            'icon_emoji'  => $icon,
            'attachments' => $attachments
        );
        $data_string = json_encode($data);
        $ch = curl_init('https://hooks.slack.com/services/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');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string))
            );
        //Execute CURL
        $result = curl_exec($ch);

    }

    public function actionResult(){
        
        $url = Url::home();
        $this->view->params['val'] = 100;
        $this->setIndex();
        
        $main = Success::find()->one();
        
        $one_title = array($main->one_title_uk,$main->one_title_ru,$main->one_title_en);
        $one_description = array($main->one_description_uk, $main->one_description_ru, $main->one_description_en);
        
        $siteTitle = array($main->one_title_uk,$main->one_title_ru,$main->one_title_en);
        $siteDescription = array($main->one_description_uk,$main->one_description_ru,$main->one_description_en);
         Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $siteDescription[$this->langIndex]
        ]);
        
        $status_liqpay = "";
        $isStatus = 0;
        $status_text = Yii::t('yii', 'liqpay_status');
        
        if (isset($_SESSION['pageimg'])){
            $hash = $_SESSION['pageimg'];
        }
        
        if (isset($_SESSION['pageimg'])){
            $lp = LandingPages::find()->where(['for_page' => $hash])->asArray()->one();
            $image = $lp['image_bg_url'];
        }
        
        if (isset($_SESSION['guid'])){
            $order = Orders::find()->where(['guid' => $_SESSION['guid']])->one();
            $status_liqpay = $order->payment_status;
            $isStatus = 1;
            if ($status_liqpay == 'sandbox'){
                $status_text .= Yii::t('yii', 'liqpay_sandbox');
            } else if ($status_liqpay == 'error'){
                $status_text .= Yii::t('yii', 'liqpay_error');
            } else if ($status_liqpay == 'failure'){
                $status_text .= Yii::t('yii', 'liqpay_failure');
            } else if ($status_liqpay == 'reversed'){
                $status_text .= Yii::t('yii', 'liqpay_reverse');
            } else if ($status_liqpay == 'subscribed'){
                $status_text .= Yii::t('yii', 'liqpay_subscribedx');
            } else if ($status_liqpay == 'success'){
                $status_text .= Yii::t('yii', 'liqpay_succsess');
            }  else if ($status_liqpay == 'wait'){
                $status_text .= Yii::t('yii', 'liqpay_wait');
            }  else if ($status_liqpay == 'proc'){
                $status_text .= Yii::t('yii', 'liqpay_proc');
            }  else {
                $status_text .= Yii::t('yii', 'liqpay_default');
            }
        
        }
        
        return $this->render('liqpayconfirm', [
                'langID' => $this->langIndex,
                'oneTitle' => $one_title[$this->langIndex],
                'oneDescription' => $one_description[$this->langIndex],
                'image' => $main->image,
                'title' => 'Оплата Liqpay',
                'isStatus' => $isStatus,
                'status' => $status_liqpay,
                'status_text' => $status_text,
            ]);
    }
}
