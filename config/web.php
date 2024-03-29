<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'language'=>'ru-RU',
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules' => [
        'master' => [
            'class' => 'app\modules\master\Master',
            'layout' => 'main'
        ],
    ],
    'components' => [
        'assetManager' => [
            'bundles' => [
                /*'yii\web\JqueryAsset' => [
                    'sourcePath' => '@frontend/assets/app',
                    'js' => [
                        'js/jquery-3.3.1.min.js',
                    ],
                ],*/
                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => null,
                    'css' => ['/'],
                ],
            ],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'PGFVkGNHJ4Z4Wl3DJYRvPlE0aFTcanRu',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl'=>array('login'),
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'mail.sfu-kras.ru',
                'username' => 'expo@sfu-kras.ru',
                'password' => '36dc30d0',
                //'port' => '587',
                //'encryption' => 'tls',
                'port'=>'465',
                'encryption'=>'ssl',
                'timeout' => 5
            ],
            'useFileTransport' => false,
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

        'db' => $db,        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'login' => 'site/login',
                'master/<controller>'=>'master/<controller>/index',
                'master/<controller>/<id:\d+>'=>'master/<controller>/view',
                'master/<controller>/<action>'=>'master/<controller>/<action>',
                'master/<controller>/<action>/<id:\d+>'=>'master/<controller>/<action>',
                'site/<action>'=>'site/<action>',
                '<controller:(cart)>'=>'<controller>/index',
                '<controller:(place|cart|event)>/<id:\d+>'=>'<controller>/view',
                '<controller:(place|cart|event)>/<action:(view|event|modal|remove)>'=>'<controller>/<action>',
                '<controller:(place|cart|event)>/<alias>'=>'<controller>/view',
                '<controller:(place|cart|event)>/<action>/<id:\d+>'=>'<controller>/<action>',
                '<url:.*>'=>'site/page',
            ],
        ],        
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
