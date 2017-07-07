<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'defaultRoute' => 'main/index',
    'modules' => [
        'rbac' => [
            'class' => 'common\modules\rbac\Module',
            'layout' => '@app/views/layouts/main',
            'controllerMap' => [
                'assignment' => [
                    'class' => 'common\modules\rbac\controllers\AssignmentController',
                    'userClassName' => 'common\models\User',
                    'idField' => 'id'
                ],
            ],
            'menus' => [
                'rule' => null, // disable menu rule
            ]
        ],
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ],
    ],

    //权限验证配置
    'as access' => [
        'class' => 'common\modules\rbac\components\AccessControl',
        'allowActions' => [
            'main/login',
            'main/logout',
            'error/error',
            'main/captcha',
            'password/request-password-reset',
            'password/reset-password'
        ]
    ],

    'components' => [
        'request' => [
            'csrfParam' => 'backend_csrf',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@root/messages',
                    'fileMap' => [
                        'defalut' => 'defalut.php',
                    ],
                ],
            ],
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-advanced-app'
                ],
            ],
        ],
        'assetManager' => [
            'hashCallback' => function ($path) {
                return hash('md4', $path);
            },
            'bundles' => [
                'dmstr\web\AdminLteAsset' => [
                    'skin' => "skin-red-light",
                ],
                'yii\web\JqueryAsset' => [
                    'jsOptions' => [
                        'position'=>\yii\web\View::POS_HEAD, //head中
                    ]
                ],
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => 'backend_identity', 'httpOnly' => true],
            'loginUrl' => ['main/login']
        ],
        'session' => [
            'name' => 'backend_session',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'info', 'warning'],
                    'logVars' => [],
                    'logFile' => '@runtime/logs/'.date('Y-m-d').'.log'
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'error/error',
        ],
    ],
    'params' => $params,
];
