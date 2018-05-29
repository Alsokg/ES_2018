<?php

/* @var $this yii\web\View */

$this->title = $title;
?>

    <div class="site-wrapper">        
        <div class="screen screen-8 flexbox" style="background-color: #fff">
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
                     <div class="button-buy-wrapper">
                        <a class="blue-btn" href="/"><?= Yii::t('yii', 'Order') ?></a>
                    </div>
                </div>
            </div>
        </div>        
    </div>