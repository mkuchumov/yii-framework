<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$this->title = 'Update Profile';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['users/index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['users/view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = ['label' => 'Profile', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-update">
    
    <?php $form = ActiveForm::begin(); ?>
    
    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>
        <?= Html::a('View', ['index', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>
    
    <?php $from = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'description')->textarea(['rows' => 5]) ?>
    
    <div class="form-group">
        <?= Html::submitButton('Update' , ['class' => 'btn btn-success']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>
    
</div>