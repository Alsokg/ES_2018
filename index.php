<?php

session_start();
if(!isset($_SESSION['utms'])) {
    $_SESSION['utms'] = array();
    $_SESSION['utms']['utm_source'] = '';
    $_SESSION['utms']['utm_medium'] = '';
    $_SESSION['utms']['utm_term'] = '';
    $_SESSION['utms']['utm_content'] = '';
    $_SESSION['utms']['utm_campaign'] = '';
}

$_SESSION['utms']['utm_source'] = $_GET['utm_source'];
if (isset($_GET['gclid'])) $_SESSION['utms']['utm_source'] = Google_Adwords;
$_SESSION['utms']['utm_medium'] = $_GET['utm_medium'];
$_SESSION['utms']['utm_term'] = $_GET['utm_term'];
$_SESSION['utms']['utm_content'] = $_GET['utm_content'];
$_SESSION['utms']['utm_campaign'] = $_GET['utm_campaign'];
// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/vendor/autoload.php');
require(__DIR__ . '/vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/components/helpers/Rating.php');
require(__DIR__ . '/components/helpers/MailBuilder.php');
require(__DIR__ . '/components/helpers/CRM.php');

$config = require(__DIR__ . '/config/web.php');

(new yii\web\Application($config))->run();


