<?php

namespace app\models\order;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class OrderConnector extends ActiveRecord{

    public static function tableName()
    {
        return 'order_connector';
    }

}