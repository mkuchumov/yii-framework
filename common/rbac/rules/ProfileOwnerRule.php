<?php
namespace common\rbac\rules;

use yii\base\InvalidCallException;
use yii\rbac\Rule;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ProfileOwnerRule extends Rule
{
    public $name = 'profileOwner';
    
    public function execute($userId, $item, $params)
    {
        if (empty($params['user'])) {
            throw new InvalidCallException('Specify user.');
        }
        
        return $params['user']->id == $userId;
    }
}