<?php
namespace common\models;

use Yii;

/**
 * This is the model class for table "token".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $token
 * @property integer $expired_at
 *
 * @property User $user
 */
class Token extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%token}}';
    }

    public function generateToken($expire)
    {
        $this->expired_at = $expire;
        $this->token = \Yii::$app->security->generateRandomString();
    }
}

