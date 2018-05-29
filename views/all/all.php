<?php

/* @var $this yii\web\View */

$this->title = $title_seo;

use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AppAsset;
?>

    <div class="site-wrapper">
        <div class="screen screen-1">
            <div class="mom-bg" style="background-image: url(<?= $image ?>)"></div>
            <div class="info-mom title-main">
                <div class="header">
                    <?= $title ?>
                </div>
                <div class="separator"></div>
                <div class="description">
                    <?= $description ?>
                </div>
                <div class="button-buy-wrapper">
                    <a class="pr" data-product="box-kids" href="/"><?= Yii::t('yii', 'Order') ?></a>
                </div>
                
            </div>
        </div>
        <div class="links">
            <div class="screen screen-3 screen-title">
                <p><?= Yii::t('yii', 'All-links') ?></p>
                <div class="separator"></div>
            </div>
            <div class="list">
                <ul class="link-list" style="text-align: center; padding-bottom: 100px; margin-top: -60px;">
                <?php foreach($pages as $page) { ?>
                    <li><a href="<?= "https://englishstudent.net/".Yii::$app->language."/".$page['id']; ?>"><?= $page['link_'.Yii::$app->language.'']; ?></a></li>
                <?php } ?>
                </ul>
            </div>
        </div>
    </div>