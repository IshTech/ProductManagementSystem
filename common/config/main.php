<?php
$aliases = require(__DIR__ . '/aliases.php');
$components = require(__DIR__ . '/components.php');
$modules = require(__DIR__ . '/modules.php');

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
	'aliases' => $aliases,
	'modules' => $modules,
    'components' => array_merge([
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ], $components),
];
