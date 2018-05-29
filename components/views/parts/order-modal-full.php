<?php
use yii\helpers\Url;
?>
<div class="order-modal" id="order-modal-full">
    <div class="modal-content">
        <div class="scrolable">
            <div class="close-icon" id="close-modal-full">
                <div class="close-line"></div>
                <div class="close-line"></div>
            </div>
            <div class="screen-title order-title">
                <p><?=  Yii::t('yii', 'Your order') ?></p>
                <div class="separator"></div>
            </div>
            <form id="main-order" method="POST">
                <div class="product product-title">
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
                <?php foreach($productsArray as $pr) { ?>
                <div class="product product-eng global-pr<?=$pr['id']?>" <?php if ($pr['stock'] != 1) {?> style='display: 1none;'; <?php } ?>>
                    <div class="product-img">
                        <img src="<?= $pr['image-src'] ?>" alt="<?= $pr['image-alt'] ?>">
                        <input type="hidden" name="pr-image[]" value="<?= $pr['image-src'] ?>">
                    </div>
                    <div class="product-name">
                        <p><?= $pr['name_'.$lang] ?></p>
                        <input type="hidden" name="pr-name[]" value="<?= $pr['name_'.$lang] ?>">
                        <input type="hidden" name="pr-id[]" value="<?= $pr['id'] ?>">
                    </div>
                    <div class="form-group numeric">
                        <input class="qty<?=$pr['id']?>" type="text" name="qty[]" id="qty<?=$pr['id']?>" value="0" disabled>
                        <input class="qty1<?=$pr['id']?>" type="hidden" name="qty1[]" id="qty1<?=$pr['id']?>" value="0" >
                        <span class="inc inc<?=$pr['id']?>">+</span>
                        <span class="dec dec<?=$pr['id']?>">-</span>
                    </div>  
                    <div class="price">
                        <span class="price-i<?=$pr['id']?>"><?= $pr['price'] ?></span> <span><?= Yii::t('yii', 'UAH') ?></span>
                        <span class="total-strike"><?=$pr['old_price']?><span class="old"></span> <?= Yii::t('yii', 'UAH') ?></span>
                        <input id="price<?=$pr['id']?>" name="price[]" type="hidden" value="<?= $pr['price'] ?>">
                    </div>
                    <div class="price-total total<?=$pr['id']?>">
                        <span  class="price-i">0</span> <span><?= Yii::t('yii', 'UAH') ?></span>
                        <span class="total-strike summury"><span class="old"></span> <?= Yii::t('yii', 'UAH') ?></span>
                        <input id="total<?=$pr['id']?>" name="total[]" type="hidden" value="0">
                    </div>
                </div>
                <?php } ?>
                <div class="total-price">
                    <div class="header-total"><?= Yii::t('yii', 'Total') ?></div>
                    <div class="info-total">
                        <span class="total">0</span><span class="big"> <?= Yii::t('yii', 'UAH') ?> </span>
                        <input id="ttl" name="ttl" type="hidden" value="0">
                        <span class="total-strike"><span class="old"></span> <?= Yii::t('yii', 'UAH') ?></span>
                    </div>
                </div>
              
            
                
                <div class="persoanl-info">
                    <p><?=  Yii::t('yii', 'Contact information') ?></p>
                </div>
                <div class="order-detail">
                    <div class="form-group">
                        <input type="text" name="name" id="name" placeholder="<?= Yii::t('yii', 'Enter full name') ?>">
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" id="email" placeholder="<?= Yii::t('yii', 'Enter email') ?>">
                    </div>
                    <div class="form-group">
                        <input value="" data-valid="false" type="text" name="phone" id="phone" placeholder="<?= Yii::t('yii', 'Enter phone') ?>">
                        <span class="error phone-l"><?=  Yii::t('yii', 'invalid format') ?></span>
                    </div>
                    <div class="form-group">
                        <input type="text" name="delivery" id="delivery" placeholder="<?= Yii::t('yii', 'Enter town') ?>">
                    </div>
                    <div class="form-group">
                        <select name="delivery1" id="delivery1">
                            <option value="<?= Yii::t('yii', 'Cash') ?>"><?= Yii::t('yii', 'Cash') ?></option>
			<option value="LIQPAY"><?=  Yii::t('yii', 'liqpay_option') ?></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea rows="4"  name="comment" id="comment" placeholder="<?= Yii::t('yii', 'Comment') ?>"></textarea>
                    </div>
<div class="form-group">
                        <input type="text" name="new-post" id="new-post" placeholder="<?= Yii::t('yii', 'Enter town') ?>">
                    </div>
                    <div class="form-group">
			<span class="blue-text-btn">
				<a href="#" class="code-show">Промо-код</a>
			</span>
                        <input type="text" name="promo-code" id="promo-code" placeholder="Промо-код" style="display:none">
                    </div>
                    <div class="form-group button-buy-wrapper">
                        <input type="hidden" value="" id="guid" name="guid">
                        <button type="submit"><?= Yii::t('yii', 'Make order') ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
