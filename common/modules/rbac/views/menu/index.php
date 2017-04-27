<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel common\modules\rbac\models\searchs\Menu */

$this->title = Yii::t('rbac-admin', 'Menus');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-index">

    <?php Pjax::begin(); ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'name',
            [
                'attribute' => 'menuParent.name',
                'filter' => Html::activeTextInput($searchModel, 'parent_name', [
                    'class' => 'form-control', 'id' => null
                ]),
                'label' => Yii::t('rbac-admin', 'Parent'),
            ],
            'route',
            'order',
            ['class' => 'common\grid\ActionColumn'],
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
<?php Pjax::end(); ?>

</div>
