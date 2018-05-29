<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
//use yii\models\Images;
use yii\models\ImageConnector;
/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class Products extends ActiveRecord{

    public static function tableName()
    {
        return 'Products';
    }
    
    public function getImages(){
        return $this->hasMany(Images::className(), ['id' => 'image_id'])
            ->viaTable('image_connector', ['product_id' => 'id'])
            ->asArray(true);
    }
    public function getMainImage(){
        
    }

}
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