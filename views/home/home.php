<?php

/* @var $this yii\web\View */
use app\components\ProductWidget;
$this->title = $title;

use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AppAsset;
?>

<div class="site-wrapper bg-light">
<div class="block-title">
    <h1><?=$h1?></h1>
    <div class="separator"></div>
</div>

<div class="preview-container">
    <?php
        foreach($content as $preview){
            echo $preview;
        }
    ?>
</div>
</div>