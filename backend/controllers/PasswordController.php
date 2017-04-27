<?php

namespace backend\controllers;

use backend\models\form\ChangePassword;
use backend\models\form\PasswordResetRequest;
use backend\models\form\ResetPassword;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;

/**
 * 密码操作控制器
 *
 * @package backend\controllers
 */
class PasswordController extends BaseController
{

    /**
     * 登录后台变更密码
     *
     * @return string
     */
    public function actionChangePassword()
    {
        $form = new ChangePassword();

        if(\Yii::$app->request->isPost) {
            if ($form->load(\Yii::$app->request->post())) {
                if($form->updatePassword()){
                    \Yii::$app->session->setFlash('success', \Yii::t('default', 'Update Successful'));
                }
            }
        }

        return $this->render('changePassword', [
            'model' => $form
        ]);
    }

    /**
     * 忘记密码，使用邮箱找回
     *
     * @return string
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequest();
        if ($model->load(Yii::$app->getRequest()->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', \Yii::t('default', 'Check your email for further instructions.'));
            } else {
                Yii::$app->getSession()->setFlash('error', \Yii::t('default', 'Sorry, we are unable to reset password for email provided.'));
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * 使用token验证变更密码
     *
     * @param $token
     * @return string|\yii\web\Response
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPassword($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->getRequest()->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

}
