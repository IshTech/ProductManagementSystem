<?php

$db_name = 'test_prodms';
$db_user = 'test_prodms';
$db_pass = 'test_prodms';

return [
	'class' => 'yii\db\Connection',
	'dsn' => 'mysql:host=localhost;dbname=' . $db_name,
	'username' => $db_user,
	'password' => $db_pass,
	'charset' => 'utf8mb4',
	'tablePrefix' => 't_',
	//'enableSchemaCache' => true,
	//'schemaCacheDuration' => 1800,
];
?>
