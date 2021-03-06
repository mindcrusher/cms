<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'name' => 'Интернет магазин товаров для здоровья и косметики',
    'id' => 'basic',
    'language' => 'ru-RU',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
        'cms' => [
            'class' => 'app\modules\admin\Module',
        ],
        'catalog' => [
            'class' => 'app\modules\catalog\Module',
        ],
        'cart' => [
            'class' => 'app\modules\cart\Module',
        ],
        'treemanager' =>  [
            'class' => '\kartik\tree\Module',
        ],
        'redactor' => [
            'class' => 'yii\redactor\RedactorModule',
            'uploadDir' => $params['storageDirectory'] . '/files/storage/images/',
            'uploadUrl' => '@web/files/storage/images/',
            'imageAllowExtensions'=>['jpg','png','gif']
        ],
        'user' => [
            'class' => 'dektrium\user\Module',
            'enableUnconfirmedLogin' => false,
            'confirmWithin' => 60*60*24,
            'cost' => 12,
            'admins' => ['admin','ivan']
        ],
    ],
    'components' => [
        'cart' => [
            'class' => 'yz\shoppingcart\ShoppingCart',
            'cartId' => 'cart',
        ],
        'assetManager' => [
            'linkAssets' => true,
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'jOgCCKREGYoAUMOxGhDzUcLrabftZRxO',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => '\dektrium\user\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            //'useFileTransport' => true,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'suffix' => '/',
            'rules' => [
                'login' => '/user/security/login',
                'logout' => '/user/security/logout',
                'info/<alias>' => 'site/info',
                'catalog/<slug>' => 'catalog/default/category',
                'catalog/product/<slug>' => 'catalog/default/product',
                ['class' => 'yii\rest\UrlRule',
                    'controller' => [
                        'cart/api' => 'cart/api',
                        'catalog/api' => 'catalog/api',
                    ]
                ],
            ]
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
        
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    //'sourceLanguage' => 'ru-RU',
                    'fileMap' => [
                        'app' => 'app.php',
                    //    'app/error' => 'error.php',
                    ],
                ],
            ],
        ],
        
        'db' => require(__DIR__ . '/db.php'),
    ],
    'params' => $params,
    'on beforeRequest' => function( ) {
        return \app\components\PreRequest::control();
    },
];


if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii']['class'] = 'yii\gii\Module';
    $config['modules']['gii']['allowedIPs'] = ['127.0.0.1', '::1', '192.168.0.80'];
}
return $config;
