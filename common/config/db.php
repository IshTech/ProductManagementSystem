<?php

$db_name = 'XXX';//'test_prodms';
$db_user = 'XXX';//'test_prodms';
$db_pass = 'XXX';//'test_prodms';

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
