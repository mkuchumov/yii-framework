<?php

namespace common\models\query;

use yii\db\ActiveQuery;
use common\models\User;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserQuery extends ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['status' => User::STATUS_ACTIVE]);
    }
    
    /**
     * @param null $db
     * @return array|User[]
     */
    public function all($db = null)
    {
        return parent::all($db);
    }
    /**
     * @param null $db
     * @return array|null|User
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}