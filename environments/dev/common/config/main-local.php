<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=yii2',
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'viewPath' => '@common/mail',
            'useFileTransport' => false,
            'class' => 'yii\swiftmailer\Mailer',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.163.com',
                'username' => 'xxx@163.com',
                'password' => 'xxx',
                'port' => '25',
//                'encryption' => 'ssl',
            ]
        ],
    ],
];
