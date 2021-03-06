<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'gallery',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
		'@mysite'	 => 'http://gallery/',
    ],
	'language' => 'ru-RU',
	'modules' => [
		'rbac' => 'dektrium\rbac\RbacWebModule',
		'comment' => [
			'class' => 'yii2mod\comments\Module',
		],
	],
	'components' => [	
		'i18n' => [
			'translations' => [
				'*' => [
					'class' => 'yii\i18n\PhpMessageSource',
					'basePath' => '@app/modules/users/messages',
					'sourceLanguage' => 'ru',
					'fileMap' => [
						'main' => 'main.php',
					],
				],
			],
		],
		'assetManager' => [
			'appendTimestamp' => true,	
		],
		
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
			'cookieValidationKey' => 'ZDY96PDNizzP_SA8qPikyTOxh8C5_8RX',
			'baseUrl' => '',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
			'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
			
        ],
		'authManager' => [
            'class' => 'yii\rbac\DbManager',
            // 'cache' => 'cache' //Включаем кеширование 
        ],
		'errorHandler' => [
            'errorAction' => 'site/error',
        ],
		'mailer' => [
			'class' => 'yii\swiftmailer\Mailer',
			// send all mails to a file by default. You have to set
			// 'useFileTransport' to false and configure a transport
			// for the mailer to send real emails.
			'viewPath' => '@app/mailer',
			'useFileTransport' => false,
			'transport' => [
				'class' => 'Swift_SmtpTransport',
				'host' => 'smtp.gmail.com',
				'username' => '',
				'password' => '',
				'port' => '587',
				'encryption' => 'tls',
							],
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
				'<controller>/<action>' => '<controller>/<action>',
                '' => 'site/index',
                'GET site/gallery/category=<category:\w+>' => 'site/gallery/',
                'GET uploads/<path:\w+>' => 'uploads/gallery/',
				'site/about' => 'about',
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache', 
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
