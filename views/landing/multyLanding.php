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
    <div class="screen screen-4 screen-title <?=$class_cards?> nav-tab-widget-wrapper">
            <p><span class="bold"><?=$random?></span></p>
            <div class="separator"></div>
            <div class="nav-tab flexbox nav-tab-widget">
                <?php $i = 0; foreach ($cardsNav as $nav) { ?>
                    <span class="<?= $i == 0 ? "active" : "" ?> <?= $nav['id']?>" data-content="<?=$i?>" data-loaded="1">
                        <?= $nav['name']?>
                    </span>
                <?php $i++; } ?>
            </div>
            <?php foreach ($cardsWidget as $cardWidget) {
                echo $cardWidget; 
            } ?>
        
    </div>
    <div class="multy-product-container">
    <?=$productWidget?>
    </div>
</div>
<script>
$(document).ready(function(){
    $('.landing-slider').cbpFWSlider();
    
    var tabs = $('.tab-content').toArray();
    var navs = $(".nav-tab-widget span").toArray();
    
    $(tabs[0]).css("display", "block");
    
    for (var i = 0; i < tabs.length; i++) {
        $(navs[i]).on('click', function(){
            if ($(this).hasClass("active")) return false;
            var id = parseInt($(this).data("content"));
            for (var j = 0; j < tabs.length; j++) {
                $(tabs[j]).css("display", "none");
                $(navs[j]).removeClass("active");
            }
            $(tabs[id]).css("display", "block");
            $(navs[id]).addClass("active");
        })
    }
});

</script>

