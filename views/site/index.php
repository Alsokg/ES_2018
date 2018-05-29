<?php

/* @var $this yii\web\View */

$this->title = $title;
?>

    <div class="site-wrapper">
        <div class="screen screen-1">
            <div class="mom-bg slider-style"><?=$mainSlider?></div>
            <div class="info-mom title-main">
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
        <div class="screen screen-2 screen-title header-mobile">
            <p><?= $twoTitle ?></p>
            <div class="separator"></div>
        </div>
        <div class="screen screen-2 title-main">
            <img src="<?= $url.$twoSrc ?>" alt="room-items">
            <div class="plus zebra">
                <span class="pl">+</span>
                <span class="hover-bg"></span>
                <img src="<?php echo $url;?>img/52.png" alt="image">
            </div>
            <div class="plus blocks">
                <span class="pl">+</span>
                <span class="hover-bg"></span>
                <img src="<?php echo $url;?>img/405.png" alt="image">
            </div>
            <div class="plus pillow">
                <span class="pl">+</span>
                <span class="hover-bg"></span>
                <img src="<?php echo $url;?>img/354.png" alt="image">
            </div>
            <div class="plus picture">
                <span class="pl">+</span>
                <span class="hover-bg"></span>
                <img src="<?php echo $url;?>img/349.png" alt="image">
            </div>
            <div class="plus bike">
                <span class="pl">+</span>
                <span class="hover-bg"></span>
                <img src="<?php echo $url;?>img/201.png" alt="image">
            </div>
            <div class="half-right fake-aligner"></div>
            <div class="half-right">
            <div class="header">
                <?= $twoTitle ?>
            </div>
            <div class="separator"></div>
            </div>
        </div>
        <div class="screen screen-3 screen-title">
            <p><?= $threeTitle ?></p>
            <div class="separator"></div>
            <div class="flexbox">
                <div class="left-card">
                    <div class="info">
                        <span class="one"><?= $threeOne ?></span>
                        <span class="two"><?= $threeTwo ?></span>
                    </div>
                    <div class="img"></div>
                </div>
                <div class="right-card">
                    <div class="info">
                        <span class="one"><?= $threeThree ?></span>
                        <span class="two"><?= $threeFour ?></span>
                    </div>
                    <div class="img"></div>
                </div>
            </div>
        </div>
        <div class="screen screen-4 screen-title">
            <p><?= $fourTitle ?></p>
            <div class="separator"></div>
            <?php include("common/list.php") ?>
            <div class="themes-list themes-list-main flexbox">
                <?php $j = 0; for ($i = 0; $i < 4; $i++) { ?>
                    <ul>
                        <?php for ($j; $j < 7*($i+1); $j++){ if (array_key_exists($j,$themes)){?>
                            <li>
                                <i class="sprite-icon <?=$themes[$j]['alt']?>"></i>
                                <span><?= Yii::t('yii', $themes[$j]['text']); ?></span>
                            </li>
                        <?php }} ?>
                    </ul>
                <?php } ?>
            </div>
        </div>
        <?php if ($sale){ ?>
        <div class="screen screen-5 screen-title">
            <div class="promo-section">
                <span><?= $sale ?></span>
                <div class="button-buy-wrapper button-buy-inverse">
                    <a class="buy-kids" data-product="<?= $productID; ?>" href="#"><?= Yii::t('yii', 'Order') ?></a>
                </div>
            </div>    
        </div>
        <?php } ?>
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
        <div class="screen screen-7 screen-title">
            <p><?= $sevenTitle ?></p>
            <div class="separator"></div>
            <span class="dots-fake">. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .</span>
            <div class="cards-tutorial flexbox">
                <div class="step step-one" style="background-image: url(<?= $seven1Src ?>)">
                    <span class="title"><?= Yii::t('yii', 'Step 1') ?></span>
                    <span class="description"><?= $sevenStep1 ?></span>
                </div>
                <div class="step step-two" style="background-image: url(<?= $seven2Src ?>)">
                    <span class="title"><?= Yii::t('yii', 'Step 2') ?></span>
                    <span class="description"><?= $sevenStep2 ?></span>
                </div>
                <div class="step step-three" style="background-image: url(<?= $seven3Src ?>)">
                    <span class="title"><?= Yii::t('yii', 'Step 3') ?></span>
                    <span class="description"><?= $sevenStep3 ?></span>
                </div>
            </div>
        </div>
<div style="display: none">
        <?php include('blocks/comment-block.php'); ?>
</div>
        <div id="box-kids" class="screen screen-8 flexbox">
            <div class="half kids-img">
                <?php foreach ($productImages as $pImg) { ?>
                    <img src="<?= $url.$pImg['src'] ?>" alt="<?= $pImg['alt'] ?>">
                <?php } ?>
            </div>
            <div class="half ">
                <div class="product-wrapper">
                    <div class="title">
                        <p><?= $productName ?></p>
                    </div>
                    <div class="separator"></div>
                    <div class="rating-wrapper">
                        <div class="rating">
                            <?php for ($i = 1; $i <= 5; $i++) { ?>
                                <?php if ($rating < $i) { ?>
                                    <i class="fa fa-star"></i>
                                <?php } else { ?>
                                    <i class="fa fa-star active"></i>
                                <?php } ?>
                            <?php } ?>
                        </div>
                        <div class="reviews-count">
                            <span><?= Yii::t('yii', '{delta, plural, one{1 day} other{# days}}', ['delta' => $countReviews]);?></span>
                        </div>
                    </div>
                    <div class="description">
                        <p><?= $productDescription ?></p>
                    </div>
                    <div class="price">
                        <p><?= $price ?> <?= Yii::t('yii', 'UAH') ?></p>
                    </div>
			<?php if ($price > 0) { ?>
                     <div class="button-buy-wrapper">
                        <a class="buy-kids blue-btn" href="#" data-product="<?= $productID; ?>"><?= Yii::t('yii', 'Order') ?></a>
                    </div>
			<?php } else { ?>
                     <div class="button-buy-wrapper">
                        <a class="blue-btn" href="javascript:void(0)">Немає в наявності</a>
                    </div>
			<?php } ?>
			
                </div>
            </div>
        </div>        
    </div>
    <?php include("common/order-modal.tpl"); ?>
    <?php include("common/good-modal.tpl"); ?>
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