<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;
use common\rbac\Rbac;
use common\rbac\rules\ProfileOwnerRule;
use common\rbac\rules\PostAuthorRule;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
        
        $rule = new ProfileOwnerRule();
        $auth->add($rule);
        
        $manageProfile = $auth->createPermission(Rbac::MANAGE_PROFILE);
        $manageProfile->ruleName = $rule->name;
        $auth->add($manageProfile);
        
        $rule = new PostAuthorRule();
        $auth->add($rule);
        
        $managePost = $auth->createPermission(Rbac::MANAGE_POST);
        $managePost->ruleName = $rule->name;
        $auth->add($managePost);        
        
        $user = $auth->createRole('user');
        $auth->add($user);
        $auth->addChild($user, $manageProfile);
        $auth->addChild($user, $managePost);
    }
}