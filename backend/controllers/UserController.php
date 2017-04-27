<?php

namespace backend\controllers;

use backend\models\form\CreateUser;
use backend\models\form\UpdateUser;
use Yii;
use backend\models\form\Signup;
use common\models\User;
use backend\models\searchs\User as UserSearch;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\base\UserException;
use yii\mail\BaseMailer;

/**
 * 用户控制器
 *
 * @package backend\controllers
 */
class UserController extends BaseController
{
    private $_oldMailPath;

    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            if (Yii::$app->has('mailer') && ($mailer = Yii::$app->getMailer()) instanceof BaseMailer) {
                /* @var $mailer BaseMailer */
                $this->_oldMailPath = $mailer->getViewPath();
                $mailer->setViewPath('@common/mail');
            }
            return true;
        }
        return false;
    }

    /**
     * @inheritdoc
     */
    public function afterAction($action, $result)
    {
        if ($this->_oldMailPath !== null) {
            Yii::$app->getMailer()->setViewPath($this->_oldMailPath);
        }
        return parent::afterAction($action, $result);
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
                'model' => $this->findModel($id),
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Signup new user
     * @return string
     */
    public function actionCreate()
    {
        $model = new CreateUser();
        if ($model->load(Yii::$app->getRequest()->post())) {
            if ($user = $model->signup()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
                'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {

        $model = UpdateUser::findOne($id);
        if ($model->load(Yii::$app->request->post()) && $model->change())
        {
            return $this->redirect([
                'index'
            ]);
        }
        else
        {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }


    /**
     * Activate new user
     * @param integer $id
     * @return type
     * @throws UserException
     * @throws NotFoundHttpException
     */
    public function actionActivate($id)
    {
        /* @var $user User */
        $user = $this->findModel($id);
        if ($user->status == User::STATUS_INACTIVE) {
            $user->status = User::STATUS_ACTIVE;
            if ($user->save()) {
                return $this->redirect(['index']);
            } else {
                $errors = $user->firstErrors;
                throw new UserException(reset($errors));
            }
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
