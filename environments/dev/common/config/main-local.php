<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=seamobi',
            'username' => 'root',
            'password' => '555555',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'viewPath' => '@common/mail',
            'useFileTransport' => false,
            'class' => 'yii\swiftmailer\Mailer',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.exmail.qq.com',
                'username' => 'noreply@eskyfun.com',
                'password' => 'T*&^%$345678rtyu',
                'port' => '465',
                'encryption' => 'ssl'
            ]
        ],
    ],
];
