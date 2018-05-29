<?php

namespace app\controllers;

use Yii;
use app\components\helpers\MailBuilder;
class MailController extends BasicController{

    public function actionIndex(){
        $this->view->params['val'] = 123;
        $this->setIndex();
        $array = array();
        $array['email'] = "aloskg@gmail.com";
        $array['guid'] = "18aec505-f2d8-bc5e-a5e0-bdcfcab5c0d1";
        $array['name'] = "mykola zubekhin";
        $array['paid'] = "Оплата при отриманні";
        $array['phone'] = "985848843";
        $array['shipping'] = "lviv 39";
        $array['total'] = "800";
        
        $productsArr = array();
            
                $arr = array();
                $arr['price'] = "290";
                $arr['qty1'] = "1";
                $arr['name'] = "A1 iodfgdio";
                $arr['id'] = "6";
                $arr['image'] = "/img/8.png";
                $productsArr[0] = $arr;
                                $arr2 = array();
                $arr2['price'] = "290";
                $arr2['qty1'] = "1";
                $arr2['name'] = "A2 iodfgdio";
                $arr2['id'] = "7";
                $arr2['image'] = "/img/8.png";
                $productsArr[1] = $arr2;
                                $arr3 = array();
                $arr3['price'] = "290";
                $arr3['qty1'] = "1";
                $arr3['name'] = "A3 iodfgdio";
                $arr3['id'] = "8";
                $arr3['image'] = "/img/b1_big2.jpg";
                $productsArr[2] = $arr3;
            
         $array['products'] = $productsArr;    
        
        $mail = MailBuilder::build($array);
            return $this->render('mail',[
                'mail' => $mail,
            ]);
    }
    
     
}
?>