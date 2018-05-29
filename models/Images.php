<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class Images extends ActiveRecord{

    public static function tableName()
    {
        return 'images';
    }
    
    public function getProducts(){
        return $this->hasMany(Products::className(), ['id' => 'product_id'])
            ->viaTable('image_connector', ['image_id' => 'id']);
    }

}