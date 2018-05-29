<?php

namespace app\controllers;

use Yii;
use Yii\web\Controller;
use app\models\Info;

class ContactsController extends BasicController{
    public function actionContacts(){
        $info = Info::findOne(1);
        $this->view->params['val'] = $info->contacts_page_id;
        $this->setIndex();
        
        $address = array($info->address_uk,$info->address_ru, $info->address_en);
        
        return $this->render('contacts', [
            'address' => $address[$this->langIndex],
            ]);
    }
}
