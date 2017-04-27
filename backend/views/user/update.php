<?php

$this->title = Yii::t('default', 'Update User') . ': ' . ' ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('default', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('default', 'Update');
?>
<div class="menu-update">


    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
