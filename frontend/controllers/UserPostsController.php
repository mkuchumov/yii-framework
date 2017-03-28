<?php
namespace frontend\controllers;

use common\rbac\Rbac;
use common\models\User;
use Yii;
use common\models\Post;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserPostsController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'update', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    
    public function actionIndex($user_id)
    {
        $user = $this->findUserModel($user_id);
        
        $dataProvider = new ActiveDataProvider([
            'query' => Post::find()->forUser($user->id)->orderBy(['id' => SORT_DESC]),
        ]);
        
        return $this->render('index', [
            'user' => $user,
            'dataProvider' => $dataProvider,
        ]);
                
    }
    
    public function actionView($user_id, $id)
    {
        return $this->render('view', [
            'user' => $this->findUserModel($user_id),
            'model' => $this->findPostModel($user_id, $id),
        ]);
    }
    
    public function actionCreate($user_id)
    {
        $user = $this->findUserModel($user_id);
        
        if ($user->id != Yii::$app->user->id) {
            throw new \yii\web\ForbiddenHttpException('Forbidden.');
        }
        
        $model = new Post();
        $model->user_id = $user_id;
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'user_id' => $user->id, 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'user' => $user,
                'model' => $model
            ]);
        }
    }
    
    public function actionUpdate($user_id, $id)
    {
        $user = $this->findUserModel($user_id);
        $model = $this->findPostModel($user_id, $id);
        
        if (!Yii::$app->user->can(Rbac::MANAGE_POST, ['post' => $model])) {
            throw new \yii\web\ForbiddenHttpException('Forbidden');
        }
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'user_id' => $user->id, 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'user' => $user,
                'model' => $model,
            ]);
        }
    }
    
    public function actionDelete($user_id, $id)
    {
        $user = $this->findUserModel($user_id);
        $model = $this->findPostModel($user_id, $id);
        
        if (!Yii::$app->user->can(Rbac::MANAGE_POST, ['post' => $model])) {
            throw new ForbiddenHttpException('Forbiddden.');
        }
        
        $model->delete();
        
        return $this->redirect(['index', 'user_id' => $user->id]);
    }
    
    private function findUserModel($user_id)
    {
        if (($model = User::findOne($user_id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    private function findPostModel($user_id, $id)
    {
        if (($model = Post::find()->forUser($user_id)->andWhere(['id' => $id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
}