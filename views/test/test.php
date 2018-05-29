<?php
$this->title = $title_seo;

use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AppAsset;
?>
<div class="site-wrapper test-page">
  <div class="title-test screen-title">
    <h1><?=Yii::t('yii', 'test-h1')?></h1>
    <div class="separator"></div>
  </div>
  <div id="recomend" style="display: none">
    <p id="rec-level"><?=Yii::t('yii', 'recommend')?></p>
    <a href="/<?=Yii::$app->language?>/test/"><?=Yii::t('yii', 'get-test')?></a>
  </div>
    <div id="rounds-navigator"></div>
    <div id="testPage" class="test__page">
      <div id="questions" class="test__questions"></div>
    </div>
    <div id="result-nav"></div>
  <!-- view -->
  
  <div id="box-js" class="screen screen-8 flexbox" style="display: none">
  <div class="half kids-img to-center-img image-js">
    
  </div>
  <div class="half to-left-info">
    <div class="product-wrapper">
      <div class="title">
        <p class="name-js"></p>
      </div>
      <div class="separator"></div>
      <div class="description">
        <p class="description-js"></p>
      </div>
        <div class="price">
          <p><span class="actual-price price--new new-price-js"><?=" ".Yii::t('yii', 'UAH')?></span> <span class="old-price price--old old-price-js"><?=" ".Yii::t('yii', 'UAH')?></span></p>
        </div>
	    <div class="button-buy-wrapper">
          <a class="blue-btn js-link inc buy" href="javascript:void(0)" data-id=""><?= Yii::t('yii', 'Order') ?></a>
        </div>
      </div>
    </div>
</div>
</div>
<div id="test-tooltip"><span><?=Yii::t('yii', 'PleaseSelect5answers')?></span></div>

<!--main page order-->
        <div class="screen screen-cart screen-title">
            <p><?= Yii::t('yii', 'Cart') ?> </p>
            <div class="separator"></div>
            <div class="pseudo-form">
                <div class="product product-title thead">
                    <div class="product-img">
                    </div>
                    <div class="product-name">
                        <?=  Yii::t('yii', 'Product name') ?>
                    </div>
                    <div class="form-group numeric">
                        <label><?=  Yii::t('yii', 'qty') ?></label>
                    </div>                
                    <div class="price">
                        <span><?=  Yii::t('yii', 'price') ?></span>
                    </div>
                    <div class="price-total">
                        <span><?=  Yii::t('yii', 'full price') ?></span>
                    </div>
                </div>
                <div class="product product-one global-pr<?=$kidsID?>">
                    <div class="product-img">
                        <img src="<?= $url.$productImages[0]['src'] ?>" alt="<?= $productImages[0]['alt'] ?>">
                    </div>
                    <div class="product-name">
                        <p><?= $productName; ?></p>
                    </div>
                    <div class="form-group numeric">
                        <input class="qty<?=$kidsID?>" type="text" name="qty<?=$kidsID?>"  value="0" disabled>
                        <input class="qty1<?=$kidsID?>" type="hidden" name="qty1<?=$kidsID?>"  value="0">
                        <span class="inc inc<?=$kidsID?>">+</span>
                        <span class="dec dec<?=$kidsID?>">-</span>
                    </div>                
                    <div class="price">
                        <span class="price-i<?=$kidsID?>"><?= $price ?></span> <span><?= Yii::t('yii', 'UAH') ?></span>
                    </div>
                    <div class="price-total total<?=$kidsID?>">
                        <span  class="price-i">0</span> <span><?= Yii::t('yii', 'UAH') ?></span>
                        <div class="clear-offset"><span class="clear-product"></span></div>
                    </div>
                </div>
                <?php foreach($productsArray as $pr) { ?>
                <div class="product product-eng global-pr<?=$pr['id']?>">
                    <div class="product-img">
                        <img src="<?= $url.$pr['images'][0]['src'] ?>" alt="<?= $pr['images'][0]['alt'] ?>">
                    </div>
                    <div class="product-name">
                        <p><?= $pr['name'] ?></p>
                    </div>
                    <div class="form-group numeric">
                        <input class="qty<?=$pr['id']?>" type="text" name="qty<?=$pr['id']?>"  value="0" disabled>
                        <input class="qty1<?=$pr['id']?>" type="hidden" name="qty1<?=$pr['id']?>"  value="0" >
                        <span class="inc inc<?=$pr['id']?>">+</span>
                        <span class="dec dec<?=$pr['id']?>">-</span>
                    </div>  
                    <div class="price">
                        <span class="price-i<?=$pr['id']?>"><?= $pr['price'] ?></span> <span><?= Yii::t('yii', 'UAH') ?></span>
                        <span class="total-strike"><?=$pr['old_price']?><span class="old"></span> <?= Yii::t('yii', 'UAH') ?></span>
                    </div>
                    <div class="price-total total<?=$pr['id']?>">
                        <span  class="price-i">0</span> <span><?= Yii::t('yii', 'UAH') ?></span>
                        <span class="total-strike summury"><span class="old"></span> <?= Yii::t('yii', 'UAH') ?></span>
                         <div class="clear-offset"><span class="clear-product"></span></div>
                    </div>
                </div>
                <?php } ?>
                <div class="total-price">
                    <div class="header-total"><?= Yii::t('yii', 'Total') ?></div>
                    <div class="info-total">
                        <span class="total">0</span><span class="big"> <?= Yii::t('yii', 'UAH') ?> </span>
                        <span class="total-strike"><span class="old"></span> <?= Yii::t('yii', 'UAH') ?></span>
                    </div>
                </div>
                <div class="total-price gift-ico">
                    <div class="header-total normal"><?= Yii::t('yii', 'Get free delivery, when order 2 boxes') ?></div>
                    <div class="button-buy-wrapper">
                        <a class="buy-kids global-form" href="#"><?= Yii::t('yii', 'Buy')?></a>
                    </div>
                </div>
                <div class="clear-fix"></div>
            </div>
        </div>
        
</div>
<div class="notify-cart"></div>
            <div class="cart-action global-form">
                <span class="cart-ico"></span>
                <span class="cart-num"></span>
            </div>
<?php include("orderForm.php"); ?>
<script src="/kids/js/test/test.js"></script>
<script>
  var levels = ["A1", "A2", "B1", "B2", "C1"];
  var colors = ["#4890fe", "#4dbb64","#f9b844","#df191a","#de33d9"];
  var text = ["<?= Yii::t('yii', 'Round')?>", "<?= Yii::t('yii', 'Res')?>"];
  var test = new Test(levels, colors, text);
  test.run();
  

</script>