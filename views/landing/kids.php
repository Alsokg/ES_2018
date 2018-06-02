<?php

/* @var $this yii\web\View */

$this->title = $title;
$lang = Yii::$app->language;
?>

    <div class="site-wrapper">
        <div class="screen screen-1 screen-1-slider">
            <div class="mom-bg slider-style kids-slider-first"><?=$mainSlider?></div>
            <div class="info-mom title-main kids-title-first">
                <div class="header">
                    <?= $oneTitle ?>
                </div>
                <div class="separator"></div>
                <div class="description">
                    <?= $oneDescription ?>
                </div>
                <div class="button-buy-wrapper">
                    <a class="to-product" data-product="box-kids" href="#box-kids"><?= Yii::t('yii', 'Order') ?></a>
                </div>
                
            </div>
        </div>
        <div class="screen screen-2 screen-title">
            <p><?= $twoTitle ?></p>
            <div class="separator"></div>
        </div>
        <div class="screen screen-2 pazzles">
            <?php $i = 1; foreach ($pazzles as $pazzle) { ?>
                <img class="pazzle" src="<?= $pazzle ?>" alt="pazzle<?=$i++?>">
            <?php } ?>
        </div>
        
        <?=$advens?>
        
        <div class="screen screen-6 screen-title">
            <p><?= $sixTitle ?></p>
            <div class="separator"></div>
            <p class="description"><?= $sixDescription ?></p>
            <div class="img-container flexbox">
                <div class="left">
                    <img src="<?= $url.$picture_1 ?>" alt="image1">
                    <img src="<?= $url.$picture_2 ?>" alt="image2">
                </div>
                <div class="ty-ty">
                    <img src="<?= $url.$picture_main ?>" alt="train image">
                </div>
                <div class="right">
                    <img src="<?= $url.$picture_3 ?>" alt="jump girl image">
                    <img src="<?= $url.$picture_4 ?>" alt="bear image">
                </div>
            </div>
        </div>

<div style="display: none">
        <?php include('blocks/comment-block.php'); ?>
</div>
    <?php if ($sale){ ?>
        <div class="screen screen-5 screen-title kids-promo">
            <div class="kids-promo-section">
                <div><?=$sale?></div>
            </div>    
        </div>
    <?php } ?>
    
    <div class="multy-product-container">
        <?=$productWidget?>
    </div>
    
    </div>

    <script>
    $(document).ready(function(){
        
        $('.to-product').on('click', function(e){
            e.preventDefault();
            var el = $('#' + $(this).data('product'));
            var p = el.offset();
            var t = p.top - 66;
           var body = $("html, body");
            body.stop().animate({scrollTop: t}, 300, 'swing'); 
        });
    });
</script>