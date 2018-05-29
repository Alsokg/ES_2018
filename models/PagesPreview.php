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
class PagesPreview extends ActiveRecord{

    public static function tableName()
    {
        return 'pages_preview';
    }
    


}