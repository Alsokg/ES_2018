<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="description" content="EnglishStudent — карточки для изучения английского языка. Помогают запомнить 95% слов. Оригинальный подарок. Настольная игра.">
<link href='//fonts.googleapis.com/css?family=Roboto+Slab:400,700,300&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700&subset=cyrillic" rel="stylesheet" type='text/css'>
<link rel="shortcut icon" href="" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <header>
        <div class="h1">
            <div class="h2">
        <div class="lang-wrapper">
            <a href="<?php echo Url::base();?>/uk">UA</a>
        </div>
        <nav>
            <ul>
                <?php if ($this->params['val'] == 1) { ?>
                    <li class="active"><a href="#"><?= Yii::t('yii', 'CARDS') ?></a></li>
                <?php } else { ?>
                <li><a href="#"><?= Yii::t('yii', 'CARDS') ?></a></li>
                <?php } if ($this->params['val'] == 2) { ?>
                    <li class="active"><a href="#"><?= Yii::t('yii', 'IOS APP') ?></a></li>
                <?php } else { ?>
                <li><a href="#"><?= Yii::t('yii', 'IOS APP') ?></a></li>
                <?php }if ($this->params['val'] == 3) { ?>
                    <li class="active"><a  href="/kids2/kids"><?= Yii::t('yii', 'For Kids') ?></a></li>
                <?php } else { ?>
                <li><a  href="/kids2/kids"><?= Yii::t('yii', 'For Kids') ?></a></li>
                <?php } if ($this->params['val'] == 4) { ?>
                    <li class="active"><a href="#"><?= Yii::t('yii', 'Contacts') ?></a></li>
                <?php } else {?>
                <li><a href="#"><?= Yii::t('yii', 'Contacts') ?></a></li>
                <?php } ?>
            </ul>
        </nav>
        <div class="phone-wrapper">
            <span><?php echo $this->params['site']->phone; ?></span>
        </div>
        </div>
        </div>
  
    </header>
    
    

    <div class="container">
        <?= $content ?>
    </div>

    <footer>
        <div class="wrapper flexbox">
            <ul class="link-list">
                <li><a href="#">Картки</a></li>
                <li><a href="#">Додаток IOS</a></li>
                <li><a href="#">Дитячі картки</a></li>
                <li><a href="#">Тест</a></li>
            </ul>
            <ul class="link-list second-list">
                <li><a href="#">Блог</a></li>
                <li><a href="#">Додаткова інформація</a></li>
                <li><a href="#">Поширені запитання</a></li>
            </ul>
            <div class="contacts">
                <ul class="link-list">
                    <li><a href="#">Контакти</a></li>
                </ul>
                <p class="phone">+38 (097) 357-22-81</p>
                <p class="phone">+38 (097) 357-22-81</p>
                <ul class="social-list">
                    <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                </ul>
            </div>
            <div class="callback">
                <form id="callback-form" method="POST" action="">
                    <input id="phone" type="text" name="phone" value="+380 (__) ___-__-__" data-valid="false">
                    <label for="phone">Невірний формат</label>
                    <div class="button-buy-wrapper">
                        <input type="submit" class="push-wide" id="phone-send" value="Замовити">
                    </div>    
                </form>
            </div>
        </div>
    </footer>
    
    <?php include("common/order-modal.tpl"); ?>
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
