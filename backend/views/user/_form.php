<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>
<div class="row">
    <div class="col-lg-5">
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'username') ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'status')->dropDownList(\backend\base\Utility::getUserStatusText()) ?>
        <div class="form-group">
            <?php
            echo Html::submitButton($model->isNewRecord ? Yii::t('default', 'Create') : Yii::t('default', 'Update'), [
                'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
                'name' => 'submit-button'])
            ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
