
        <div class="screen screen-1">
            <div class="mom-bg" style="background-image: url(<?= $bg ?>)"></div>
            <div class="info-mom title-main">
                <div class="header">
                    <?= $title ?>
                </div>
                <div class="separator"></div>
                <div class="description">
                    <?= $description ?>
                </div>
                <div class="button-buy-wrapper">
                    <a class="to-product" data-product="box-<?=$slag2?>" href="#box-<?=$slag2?>"><?php if ($pre == 1) { echo Yii::t('yii', 'PreOrder'); } else {echo Yii::t('yii', 'Order');} ?></a>
                </div>
            </div>
        </div>