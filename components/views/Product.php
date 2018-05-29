
<!-- where full info for 1 product -->
<div id="box-<?=$slag?>" class="screen screen-8 flexbox single-view">
  <div class="half kids-img to-center-img">
      <?php if ($mainImage) { ?>
        <img src="/<?=$mainImage['src']?>" alt="<?=$mainImage['alt']?>">
      <?php } ?>
  </div>
  <div class="half to-left-info">
    <div class="product-wrapper">
      <div class="title">
        <p><?= $name.$id ?></p>
      </div>
      <div class="separator"></div>
      <div class="description">
        <p><?= $description ?></p>
      </div>
        <div class="price">
          <p><span class="actual-price price--new"><?=$price." ".Yii::t('yii', 'UAH')?></span> <?php if ($pre == 1) { ?><span class="old-price price--old"><?= $oldPrice." ".Yii::t('yii', 'UAH')?></span><?php } ?></p>
        </div>
        <?php if ($pre == 1) { ?>
          <div class="polska-timer"></div>
        <?php } ?>
			  <div class="button-buy-wrapper">
          <a class="buy-landing blue-btn" href="#" data-id-show="#polska-modal"><?php if ($pre == 1) { echo Yii::t('yii', 'PreOrder'); } else {echo Yii::t('yii', 'Order');} ?></a>
        </div>
      </div>
    </div>
</div>
<?php include('parts/modal-order.php'); ?>
