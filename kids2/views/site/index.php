<?php

/* @var $this yii\web\View */

$this->title = '1My Yii Application';
?>
    <div class="site-wrapper">
        <?= $lang->url.Yii::$app->getRequest()->getUrl() ?>
        <div class="screen screen-1">
            <div class="mom-bg" style="background-image: url(<?= $oneSrc ?>)"></div>
            <div class="info-mom title-main">
                <div class="header">
                    <?= $oneTitle ?>
                </div>
                <div class="separator"></div>
                <div class="description">
                    <?= $oneDescription ?>
                </div>
                <div class="button-buy-wrapper">
                    <a class="buy-kids" href="#"><?= Yii::t('yii', 'Order') ?></a>
                </div>
            </div>
        </div>
        <div class="screen screen-2 title-main" style="background-image: url(<?= $twoSrc ?>)">
            <div class="plus first">
                <img src="img/left-card.jpg" alt="image">
                <span class="hover-bg"></span>
                <span>+</span>
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
            <div class="themes-list flexbox">
                <?php $j = 0; for ($i = 0; $i < 4; $i++) { ?>
                    <ul>
                        <?php for ($j; $j < 7*($i+1); $j++){ ?>
                            <li>
                                <img src="<?php echo $themes[$j]['src']; ?>" alt="<?php echo $themes[$j]['alt']; ?>">
                                <span><?= Yii::t('yii', $themes[$j]['text']); ?></span>
                            </li>
                        <?php } ?>
                    </ul>
                <?php } ?>
            </div>
        </div>
        <?php if ($sale){ ?>
        <div class="screen screen-5 screen-title">
            <div class="promo-section">
                <span><?= $sale ?></span>
                <div class="button-buy-wrapper button-buy-inverse">
                    <a class="buy-kids" href="#"><?= Yii::t('yii', 'Order') ?></a>
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
                    <img src="<?= $picture_1 ?>" alt="image1">
                    <img src="<?= $picture_2 ?>" alt="image2">
                </div>
                <div>
                    <img src="<?= $picture_main ?>" alt="train image">
                </div>
                <div class="right">
                    <img src="<?= $picture_3 ?>" alt="jump girl image">
                    <img src="<?= $picture_4 ?>" alt="bear image">
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
        <div class="screen screen-8 flexbox">
            <div class="half kids-img">
                <img src="img/box-kids.jpg" alt="box-image">
            </div>
            <div class="half ">
                <div class="product-wrapper">
                    <div class="title">
                        <p>Картки з англійськими словами для дітей</p>
                    </div>
                    <div class="separator"></div>
                    <div class="description">
                        <p>450 карток, авторські ілюстрації,<br>слова з дитячого середовища<br>для дітей від 3х років.</p>
                    </div>
                    <div class="price">
                        <p>349 грн</p>
                    </div>
                     <div class="button-buy-wrapper">
                        <a class="buy-kids" href="#">Замовити</a>
                    </div>
                </div>
            </div>
        </div>        
    </div>