<?php
namespace common\rbac\rules;

use yii\base\InvalidCallException;
use yii\rbac\Rule;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PostAuthorRule extends Rule
{
    public $name = 'postAuthor';
    
    public function execute($userId, $item, $params)
    {
        if (empty($params['post'])) {
            throw new InvalidCallException('Specify post.');
        }
        
        return $params['post']->user_id == $userId;
    }
}