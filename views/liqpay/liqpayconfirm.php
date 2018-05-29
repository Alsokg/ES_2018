<?php

/* @var $this yii\web\View */
use voskobovich\liqpay\forms;
$this->title = strip_tags($title);
?>
<div class="site-wrapper">
    <div class="screen screen-1 success">
        <div class="mom-bg" style="background-image: url(../../img/bg-1-min.jpg)"></div>
        <div class="info-mom title-main">
            <div class="ok-icon-wrapper">
                <div class="ok-icon small-ok"></div>
                <div class="ok-icon big-ok"></div>
            </div>
	    <div class="header">
                <?= $oneTitle ?>
            </div>
            <div class="description">
                <?= Yii::t('yii', 'liqpay_confirm') ?>
            </div>
            <div class="description">
                <?= $status_text ?>
            </div>
            <div class="button-buy-wrapper">
                <a class="buy-kids to-product" href="https://englishstudent.net/"><?=Yii::t('yii', 'Next')?></a>
            </div>
        </div>
    </div>