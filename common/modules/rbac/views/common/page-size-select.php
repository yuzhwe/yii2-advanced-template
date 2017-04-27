<?
$request = new \yii\web\Request;
if($dataProvider->totalCount > $dataProvider->pagination->pageSize)
echo '<div style="position:absolute; top:10px; right:10px;" class="dataTables_length"><label>'.\Yii::t('default', 'Show').' '.\yii\helpers\Html::dropDownList('per_page', isset($request->get()['per_page']) ? $request->get()['per_page'] : $dataProvider->getPagination()->pageSize,  [10 => 10, 20 => 20, 50 => 50, 100 => 100, 200 => 200, 500 => 500], ['class' => 'form-control', 'style' => 'width:auto;display: inline-block;vertical-align: middle;']).' '.\Yii::t('default', 'entries').'</label></div>';
?>