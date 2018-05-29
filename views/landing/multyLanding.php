<?php

/* @var $this yii\web\View */
use app\components\ProductWidget;
$this->title = $title_seo;

use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AppAsset;
?>
<div class="site-wrapper <?=$class_cards?>-page">
    <?=$block1?>
    <?php $counter = 0; ?>
    <div class="screen screen-41 screen-title <?=$class_cards?>-themes">
        <?php foreach ($themes_list as $tl) { ?>
        <div class="multy-themes-container">
            <?php include($tl['filePath']); ?>
            <p><?= $tl['name']." ".count($themes)." ".Yii::t('yii', 'themes_title')?></p>
            <div class="separator"></div>
            
            
            <?php
                $count = floor(count($themes)/4);
                $divide = count($themes) - $count*4;
                $add = 0;
                if ($divide > 0){
                    $add = 1;
                }
                $step = 0;
            ?>
            <div class="themes-list themes-list-main flexbox">
                <?php $i = 0; for ($i = 0; $i < 4; $i++) { ?>
                    <ul>
                        <?php for ($j = ($count*($i) + $step); $j < ($count*($i+1)+$add+$step); $j++){?>
                            <li>
                                <i class="sprite-icon <?=$themes[$j]['alt']?>"></i>
                                <span><?= Yii::t('yii', $themes[$j]['text']); ?></span>
                            </li>
                        <?php } if ($add > 0) $step++; $divide--; if ($divide < 1) $add = 0;?>
                    </ul>
                <?php } ?>
            </div>
        </div>
        <?php $counter++; if ($counter <  count($themes_list)) {echo "<br><br><br>";}?>
        <?php } ?>
    </div>
    <div class="screen screen-4 screen-title <?=$class_cards?>">
            <p><span class="bold"><?=$random?></span></p>
            <div class="separator"></div>
            <?=$cardsWidget?>
    </div>
    <?=$productWidget?>
</div>
<script>
$(document).ready(function(){
    $('.landing-slider').cbpFWSlider();
});
</script>

