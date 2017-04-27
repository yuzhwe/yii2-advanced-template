<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use common\modules\rbac\components\RouteRule;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel common\modules\rbac\models\searchs\AuthItem */
/* @var $context common\modules\rbac\components\ItemController */

$context = $this->context;
$labels = $context->labels();
$this->title = Yii::t('rbac-admin', $labels['Items']);
$this->params['breadcrumbs'][] = $this->title;

$rules = array_keys(Yii::$app->getAuthManager()->getRules());
$rules = array_combine($rules, $rules);
unset($rules[RouteRule::RULE_NAME]);
?>
<div class="role-index">
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'name',
                'label' => Yii::t('rbac-admin', 'Name'),
            ],
//            [
//                'attribute' => 'ruleName',
//                'label' => Yii::t('rbac-admin', 'Rule Name'),
//                'filter' => $rules
//            ],
            [
                'attribute' => 'description',
                'label' => Yii::t('rbac-admin', 'Description'),
            ],
            ['class' => 'common\grid\ActionColumn',],
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
    ])
    ?>

</div>
