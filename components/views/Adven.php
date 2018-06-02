<div class="screen screen-3 screen-title">
            <p><?= $title ?></p>
            <div class="separator"></div>
            <div class="flexbox">
                <?php $i=1; foreach ($advens as $ad) { ?>
                    <div class="flex-adv">
                        <img src="<?=$ad['image_link']?>" alt="adven<?=$i++?>">
                        <div class="adv-description">
                            <?=$ad['text_'.$lang]?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>