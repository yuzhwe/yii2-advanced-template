<?
$this->title = Yii::t('default', 'Reset Password');
$this->params['breadcrumbs'][] = $this->title;
$hashValid = true;
if(isset(Yii::$app->user->identity->password_hash)) {
    $hash = Yii::$app->user->identity->password_hash;

    if (!preg_match('/^\$2[axy]\$(\d\d)\$[\.\/0-9A-Za-z]{22}/', $hash, $matches)
        || $matches[1] < 4
        || $matches[1] > 30
    ) {
        $hashValid = false;
    }
}

if($hashValid) {
    ?>
    <div class="row col-md-3">
        <?php $form = \yii\widgets\ActiveForm::begin(); ?>
        <?= $form->field($model, 'currentPassword')->passwordInput() ?>
        <?= $form->field($model, 'newPassword')->passwordInput() ?>
        <?= $form->field($model, 'confirmPassword')->passwordInput() ?>
        <div class="form-group">
            <label style="color: red;"><?= Yii::$app->session->getFlash('password_tips'); ?></label>
            <?= \yii\helpers\Html::submitButton(Yii::t('default', 'Update'), ['class' => 'btn btn-primary']) ?>
        </div>
        <?php \yii\widgets\ActiveForm::end(); ?>
    </div>
    <?
} else {
?>
    <div>
        <?=Yii::t('default', 'Change the password for the first time, please click the "send password reset E-mail.')?>
        <br/>
        <br/>
    </div>

    <a href="<?=\yii\helpers\Url::toRoute(['user/password-reset-send-mail'])?>" class="btn btn-success reset-password"><?=Yii::t('default', 'Send a reset password email')?></a>

    <script>
        var sending = false;
        $('.reset-password').click(function () {
            if(!sending) {
                sending = true;
                $('.reset-password').text('<?=Yii::t('default', 'Send a reset password email')?>...');
                $.post($(this).attr('href'), {id : '<?=Yii::$app->user->identity->getId()?>'}, function (r) {
                    if(r.result == true) {
                        $('.reset-password').text('<?=Yii::t('default', 'Sent successfully')?>');
                    } else {
                        $('.reset-password').text('<?=Yii::t('default', 'Sent failure')?>');
                    }
                    sending = false;
                });
            }
            return false;
        });
    </script>
<?
}
?>