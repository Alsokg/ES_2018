<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'uk-UA',
    'modules' => [
        //...
    ],
    'components' => [
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => '91.234.33.240',
                'username' => 'info@englishstudent.net',
                'password' => 'Solia1993',
                'port' => '25',
                'encryption' => '',
            ],
 
            'useFileTransport' => false,
        ],
        
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'enableCookieValidation' => false,
            'enableCsrfValidation' => false,
            'baseUrl'=> '',
        ],
        'liqpay' => [
                              'class' => 'voskobovich\liqpay\LiqPay',
                              'public_key' => 'i65178062569',
                              'private_key' => 'dVLfgSSyOYH8naKRYiunnHhgzbbao1jYz7RqzET3',
                              'server_url' => 'https://kids-cloned-aloskg.c9users.io/liqpay/response',
                              'result_url' => 'https://kids-cloned-aloskg.c9users.io/liqpay/result',
                              'sandbox' => '1'
                    ],
        'urlManager' => [
            'class' => 'codemix\localeurls\UrlManager',

            // List all supported languages here
            // Make sure, you include your app's default language.
            'languages' => ['en', 'uk', 'ru'],
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                'mail' => 'mail/index',
                'test' => 'test/index',
                'test-dev' => 'test/dev',
                 'test/product' => 'test/product',
                'kids' => 'site/flash',
        '' => 'site/index',
        'new' => 'site/ab',
        'home' => 'home/index',
        'about-us' => 'info/index',
	    'helpfull' => 'all/index',
        'admin' => 'admin/index',
        'german' => 'landing/page',
        'business' => 'landing/page',
        'business-and-it' => 'landing/multypage',
        'polska' => 'landing/page',
        'admin/<action>/<id:>' => 'admin/<action>',
        'admin/<action>' => 'admin/<action>',
        'contacts' =>'contacts/contacts',
        'comment' => 'site/comment',
	'partners' => 'partners/index',
	'success' => 'success/index',
        'all/<id:\d+>' => 'site/all',
	'product/<id:>'=>'product/index',
        '<id:>'=>'site/info',
        'site/<action>/<id:>' => 'site/<action>',
        'faq' => 'site/faq',
        'cards/<action>/<id:>' => 'cards/<action>',
        'kids' => 'site/flash',
            ],
        // Ignore / Filter route pattern's

        ],
        'assetManager' => [
    'bundles' => [
        'yii\bootstrap\BootstrapPluginAsset' => [
            'js'=>[]
        ],
        'yii\bootstrap\BootstrapAsset' => [
            'css' => [],
        ],
                        'yii\web\JqueryAsset' => [
                    'sourcePath' => null,   // do not publish the bundle
                    'js' => []
                    
                ],

    ],
],
      // 'cache' => [
    //        'class' => 'yii\caching\FileCache',
     //   ],
        'user' => [
            'identityClass' => 'app\models\User',
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
        
        // 'urlManager' => [
        //     'enablePrettyUrl' => true,
        //     'showScriptName' => false,
        //     'rules' => [
        //                     'kids' => 'site/flash',
        // '' => 'site/index',
        // 'contacts' =>'contacts/contacts',
        //     ],
        // ],
        
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['82.207.41.30'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
       // 'allowedIPs' => ['82.207.41.30'],
    ];
}

return $config;
