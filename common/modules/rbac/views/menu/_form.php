<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\modules\rbac\models\Menu;
use yii\helpers\Json;
use common\modules\rbac\AutocompleteAsset;

/* @var $this yii\web\View */
/* @var $model common\modules\rbac\models\Menu */
/* @var $form yii\widgets\ActiveForm */
AutocompleteAsset::register($this);
$opts = Json::htmlEncode([
        'menus' => Menu::getMenuSource(),
        'routes' => Menu::getSavedRoutes(),
    ]);
$this->registerJs("var _opts = $opts;");
$this->registerJs($this->render('_script.js'));
?>

<div class="menu-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= Html::activeHiddenInput($model, 'parent', ['id' => 'parent_id']); ?>
    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'name')->textInput(['maxlength' => 128]) ?>

            <?= $form->field($model, 'parent_name')->textInput(['id' => 'parent_name']) ?>

            <?= $form->field($model, 'icon')->textInput()->hint('一级菜单请填icon样式名，请参考<a href="https://almsaeedstudio.com/themes/AdminLTE/pages/UI/icons.html" target="_blank">这里</a>') ?>
            <?= $form->field($model, 'route')->textInput(['id' => 'route']) ?>
            <?= $form->field($model, 'order')->input('number') ?>
        </div>
    </div>

    <div class="form-group">
        <?=
        Html::submitButton($model->isNewRecord ? Yii::t('rbac-admin', 'Create') : Yii::t('rbac-admin', 'Update'), ['class' => $model->isNewRecord
                    ? 'btn btn-success' : 'btn btn-primary'])
        ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
