<?php
namespace frontend\widgets;

use common\models\Post;
use common\models\User;
use yii\base\InvalidConfigException;
use yii\base\Widget;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class LastUserPosts extends Widget 
{
    public $user;
    public $limit = 10;
    
    public function init()
    {
        if (!$this->user || !$this->user instanceof User) {
            throw new InvalidConfigException('Empty post.');
        }
    }
    
    public function run()
    {
        return $this->render('last-user-posts', [
            'user' => $this->user,
            'posts' => Post::find()->forUser($this->user->id)->latest($this->limit)->all(),
        ]);
    }
}
