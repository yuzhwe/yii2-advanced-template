<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\modules\rbac\components\Helper;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('default', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$controllerId = $this->context->uniqueId . '/';
?>
<div class="user-view">

    <p>
        <?php
        if ($model->status == \common\models\User::STATUS_INACTIVE && Helper::checkRoute($controllerId . 'activate')) {
            echo Html::a(Yii::t('default', 'Activate'), ['activate', 'id' => $model->id], [
                'class' => 'btn btn-primary',
                'data' => [
                    'confirm' => Yii::t('rbac-admin', 'Are you sure you want to activate this user?'),
                    'method' => 'post',
                ],
            ]);
        }
        ?>
        <?php
        if (Helper::checkRoute($controllerId . 'delete')) {
            echo Html::a(Yii::t('default', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]);
        }
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'email:email',
            'created_at:date',
            [
                'label' => $model->attributeLabels()['status'],
                'value' => \backend\base\Utility::getUserStatusTextByKey($model->status)
            ]
        ],
    ])
    ?>

</div>
