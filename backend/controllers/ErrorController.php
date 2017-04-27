<?php
namespace backend\controllers;

class ErrorController extends BaseController
{
    public function init()
    {
        parent::init();
    }


    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }
}
