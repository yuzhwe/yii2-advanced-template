<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\rbac\models\Menu */

$this->title = Yii::t('default', 'Create User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('default', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-create">


    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
