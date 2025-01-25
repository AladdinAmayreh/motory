<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'components' => [
        'language' => 'en-US',
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    'fileMap' => [
                        'app' => 'app.php',
                    ],
                ],
            ],
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'currencyCode' => 'SAR',
            'locale' => 'ar-SA',
        ],

        'request' => [
            'baseUrl' => '',
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'tnxtuufu_XBkhTrR50cOBwn4yRnDswem',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning', 'info'],

                ],
            ],
        ],
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [

                'admin/categories' => 'category/index',
                'admin/categories/create' => 'category/create',
                'admin/categories/update/<id:\d+>' => 'category/update',
                'admin/categories/view/<id:\d+>' => 'category/view',
                'admin/categories/delete/<id:\d+>' => 'category/delete',

                'admin/services' => 'service/index',
                'admin/services/create' => 'service/create',
                'admin/services/update/<id:\d+>' => 'service/update',
                'admin/services/view/<id:\d+>' => 'service/view',
                'admin/services/delete/<id:\d+>' => 'service/delete',
                '<action:\w+>' => 'site/<action>', // User routes
                'GET services' => 'service/index', // Existing endpoint for listing services in the web interface
                'GET services/<id:\d+>' => 'service/view', // Existing endpoint for viewing service details in the web interface

                // New API endpoints
                'GET api/services' => 'service/api-index', // Endpoint to list services (API)
                'GET api/services/<id:\d+>' => 'service/api-view', // Endpoint to get service details (API)
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
