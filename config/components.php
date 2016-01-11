<?php

$routes = require(__DIR__.'/routes.php');

return [
    'authManager' => [
        'class' => 'yii\rbac\DbManager'
    ],
    'urlManager' => [
        'enablePrettyUrl' => true,
        'showScriptName' => false,
        'enableStrictParsing' => false,
        'rules' => $routes,
    ],
    'request' => [
        // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
        'cookieValidationKey' => 'ALZtAf5hEbJ3wUXIxboDCIg0z09Z5-gv',
        'baseUrl' => ''
    ],
    'cache' => [
        'class' => 'yii\caching\FileCache',

    ],
    'user' => [
        'identityClass' => 'app\modules\admin\identity\Admin',
        'enableAutoLogin' => true,
    ],
    'errorHandler' => [
        'errorAction' => 'shop/error',
    ],
    'mailer' => [
        'class' => 'yii\swiftmailer\Mailer',
        // send all mails to a file by default. You have to set
        // 'useFileTransport' to false and configure a transport
        // for the mailer to send real emails.
        'useFileTransport' => true,
    ],
    'log' => [
        'traceLevel' => YII_DEBUG ? 3 : 0,
        'targets' => [
            [
                'class' => 'yii\log\FileTarget',
                'levels' => ['error', 'warning'],
            ],
        ],
    ],
    'db' => require(__DIR__ . '/db.php'),
];