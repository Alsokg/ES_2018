<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AppAsset;

AppAsset::register($this);

$menuPostfix = "";
$blogPostfix = "";
if (Yii::$app->language == "ru"){
    $menuPostfix = "-ru";
    $blogPostfix = "ru";
} else if(Yii::$app->language == "en"){
        $menuPostfix = "-en";
        $blogPostfix = "ru";
}

$session = Yii::$app->session;

// проверяем что сессия уже открыта
if (!$session->isActive){
    $session->open();
}

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="format-detection" content="telephone=no">
<meta name="robots" content="noindex">
<link rel="shortcut icon" href="../img/EnStudent.ico" />
<?= Html::csrfMetaTags() ?>
    <title>ES Admin</title>
    <?php $this->head() ?>
    <link href="/kids/css/admin.css" rel="stylesheet" media="none" onload="if(media!='all')media='all'">
    <noscript><link rel="stylesheet" href="/kids/css/admin.css"></noscript>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="/kids/js/admin/admin.js"></script>
</head>
<body>
<?php $this->beginBody() ?>
<?php  if (isset($_SESSION['isLogged'])) {  if ($_SESSION['isLogged'] == 2) {?>
<nav>
    <ul class="main-menu">
        <li><h2>English Student</h2></li>
        <?php foreach($this->params['links'] as $url) {  ?>
            <?php if (!is_array($url[1])) { ?>
                <?php if ($this->params['menu-active'] == $url[2]) { ?>
                    <li class="menu-active"><a href="<?=$url[1]?>"><?=$url[0]?></a></li>
                <?php } else { ?>
                   <li><a href="<?=$url[1]?>"><?=$url[0]?></a></li> 
                <?php } ?>
            <?php } else { ?>
                <li>
                    <a href="javascript:void(0)"><span><?=$url[0]?></span> <i class="fa fa-angle-double-down" aria-hidden="true"></i></a>
                    <ul class="dropdown is-show-full">
                        <?php foreach ($url[1] as $dr) { ?>
                            <?php if ($this->params['menu-active'] == $dr[2]) { ?>
                                <li class="menu-active"><a href="<?=$dr[1]?>"><?=$dr[0]?></a></li>
                            <?php } else { ?>
                               <li><a href="<?=$dr[1]?>"><?=$dr[0]?></a></li> 
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
        <?php } ?>
    </ul>
</nav>
<?php } }?>
<div class="admin-wrapper">
    <?php if (isset($_SESSION['isLogged'])) { if ($_SESSION['isLogged'] == 2) {?>
        <div class="toolbar">
            <ul>
                <li class="comments"><a href="<?= Url::to(['admin/comments/new']); ?>"><span><?=$this->params['cViewed']?></span> <i class="fa fa-comments" aria-hidden="true"></i></a></li>
                <li class="orders"><a href="<?= Url::to(['admin/orders/new']); ?>"><span><?=$this->params['oViewed']?></span> <i class="fa fa-shopping-cart" aria-hidden="true"></i></li>
                <li><a href="<?= Url::to(['admin/logout']); ?>">Logout <i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
            </ul>
        </div>
        <div class="work-area">
    <?php }} ?>    
        <?= $content ?>
    <?php  if (isset($_SESSION['isLogged'])) { if ($_SESSION['isLogged'] == 2) {?>
        </div>
    <?php }} ?>
</div>
<div class="msg"></div>

<link href='//fonts.googleapis.com/css?family=Roboto+Slab:400,700,300&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700&subset=cyrillic" rel="stylesheet" type='text/css'>
<link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' rel="stylesheet" type='text/css'>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
