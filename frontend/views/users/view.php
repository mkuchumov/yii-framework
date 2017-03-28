<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">
    
    <?php if (Yii::$app->user->can(Rbac::MANAGE_PROFILE, ['user' => $model])) : ?>
        <p class="pull-right">
            <?= Html::A('Profile', ['profile/index'], ['class' => 'btn btn-primary']) ?>
        </p>
    <?php endif; ?>
        
    <h1><?= Html::encode($this->title) ?></h1>
    
    <div class="panel panel-default">
        <div class="panel-body">
            <?= Yii::$app->formatter->asNtext($model->description) ?>
        </div>
    </div>    
   

</div>
