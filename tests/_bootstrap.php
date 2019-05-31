<?php
define('YII_ENV', 'test');
defined('YII_DEBUG') or define('YII_DEBUG', true);

require_once __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
require __DIR__ .'/../vendor/autoload.php';

$dotenv = new Symfony\Component\Dotenv\Dotenv;
$dotenv->load(__DIR__.'/../.env.test');