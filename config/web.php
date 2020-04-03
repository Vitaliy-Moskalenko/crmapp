<?php

return [
	'id' => 'crmapp',
	'basePath' => realpath(__DIR__ . '/../'),
	'modules' => [
		'gii' => [
			'class'      => 'yii\gii\Module',
			'allowedIPs' => ['*']
		]
	],	
	'components' => [
		'urlManager' => [
			'enablePrettyUrl' => true,
			'showScriptName'  => false
		],
		'request' => [
			'cookieValidationKey' => 'kdsjafkjdfj_fd_kjgjgdkjdfgjjjjfr',		
		],
		'db' => require(__DIR__ . '/db.php'),
		'user' => [
            'identityClass' => 'app\models\user\UserRecord'
        ],
	],
	'extensions' => require(__DIR__ . '/../vendor/yiisoft/extensions.php'),
	'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
];