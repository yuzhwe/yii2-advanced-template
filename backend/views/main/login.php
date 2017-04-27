<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model backend\models\form\Login */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<div class="login-box">
    <div class="login-logo">
        <b><?=Yii::t('default', 'Sign in')?></b>
    </div>
    <div class="login-box-body">
        <?php $form = ActiveForm::begin([]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?
        echo $form->field($model,'verifyCode')->widget(\yii\captcha\Captcha::className(), [
            'options' => [
                'class' => 'form-control',
                'style' => 'width:150px;',
                'placeholder' => Yii::t('default', 'Please enter the verification code')
            ],
            'captchaAction' => 'main/captcha',
            'imageOptions' => ['title' => Yii::t('default', 'Click Refresh')],
            'template' => "{input} {image}",
        ]);
        ?>

        <?= $form->field($model, 'rememberMe')->checkbox() ?>
        <div class="form-group">
            <?= Html::submitButton(Yii::t('default', 'Login'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            <a href="<?=\yii\helpers\Url::toRoute(['password/request-password-reset'])?>"><?=Yii::t('default', 'I forgot my password')?></a><br>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
