<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use common\modules\rbac\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\rbac\models\searchs\User */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('default', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'username',
            'email:email',
            'created_at:date',
            [
                'attribute' => 'status',
                'value' => function($model) {
                    return \backend\base\Utility::getUserStatusTextByKey($model->status);
                },
                'filter' => \backend\base\Utility::getUserStatusText()
            ],
            [
                'class' => 'common\grid\ActionColumn',
                'options' => ['width' => '15%',],
//                'template' => Helper::filterActionColumn(['view', 'activate', 'delete']),
                'template' => '{activate} {assign} {view} {update} {delete}',
                'buttons' => [
                    'activate' => function($url, $model) {
                        if ($model->status == \common\models\User::STATUS_ACTIVE) {
                            return '';
                        }
                        $options = [
                            'title' => Yii::t('default', 'Activate'),
                            'aria-label' => Yii::t('default', 'Activate'),
                            'data-confirm' => Yii::t('default', 'Are you sure you want to activate this user?'),
                            'data-method' => 'post',
                            'data-pjax' => '0',
                        ];
                        return Html::a('<span class="glyphicon">'.Yii::t('default', 'Activate').'</span>', $url, $options);
                    },
                    'assign' => function ($url, $model, $key) {
                        return \yii\helpers\Html::a('<span class="glyphicon">'.Yii::t('default', 'Assign').'</span>', \yii\helpers\Url::toRoute(['/rbac/assignment/view', 'id' => $model->id, 'redirect' => Yii::$app->request->get('redirect')]));
                    },
                ]
            ],
        ],

        'toolbar' =>  [
            ['content'=>
                \yii\helpers\Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['/'.Yii::$app->controller->action->getUniqueId()], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>Yii::t('kvgrid', 'Reset Grid')])
            ],
        ],
        'panel' => [
            'type' => GridView::TYPE_DEFAULT,
            'footer' => $this->render('/common/page-size-select', ['dataProvider' => $dataProvider])
        ],
        'filterSelector' => 'select[name="per_page"]',
    ]);
        ?>
</div>
