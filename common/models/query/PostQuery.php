<?php

namespace common\models\query;

use yii\db\ActiveQuery;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PostQuery extends ActiveQuery
{
    public function forUser($userId)
    {
        return $this->andWhere(['user_id' => $userId]);
    }
    
    public function latest($limit)
    {
        return $this->limit($limit)->orderBy(['id' => SORT_DESC]);
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