<?php

use yii\helpers\Url;
$this->title = $title_seo;
?>
<div class="site-wrapper">
   
    <div class="screen screen-1">
        <div class="mom-bg" style="background-image: url(<?=$image?>)"></div>
        <div class="info-mom title-main">
            <div class="header">
                <span class="bold"><?= $title ?></span>
            </div>
            <div class="separator"></div>
            <div class="description">
                <?= $description ?>
            </div>
        </div>
    </div>
    <div class="screen screen-2 screen-title">
        <p  class="bold"><?= $twoTitle ?></p>
        <div class="separator"></div>
    </div>
    <div class="screen">
        <ul class="blue-dot-list">
            <li><?=Yii::t('yii','wtES1')?></li>
            <li><?=Yii::t('yii','wtES2')?></li>
            <li><?=Yii::t('yii','wtES3')?></li>
        </ul>
    </div>
    <div class="screen-2 title-main">
        <img src="../img/bg-plus-cards-min.jpg" alt="box-description">
        <div class="plus plus-cards">
            <span class="num">1</span>
            <span class="pl">+</span>
            <span class="hover-bg"></span>
        <div class="txt"><?= Yii::t('yii', '1024 cards for learning English wordsR')?></div>
    </div>
    <div class="plus plus-box">
        <span class="num">2</span>
        <span class="pl">+</span>
        <span class="hover-bg"></span>
        <div class="txt"><?= Yii::t('yii', 'a box for storage of cardsR')?></div>
    </div>
    <div class="plus plus-games">
        <span class="num">3</span>
        <span class="pl">+</span>
        <span class="hover-bg"></span>
        <div class="txt"><?= Yii::t('yii', '9 board games for interactive learningR')?></div>
    </div>
    <div class="plus plus-bottom-box">
        <span class="num">4</span>
        <span class="pl">+</span>
        <span class="hover-bg"></span>
        <div class="txt"><?= Yii::t('yii', 'a study-box for spaced repetitionR')?></div>
    </div>
    <div class="plus plus-mini-box">
        <span class="num">5</span>
        <span class="pl">+</span>
        <span class="hover-bg"></span>
        <div class="txt"><?= Yii::t('yii', 'a case for easy use of cardsR')?></div>
    </div>
    <div class="half-right fake-aligner"></div>
        <div class="half-right">
        </div>
    </div>
    <div class="mobile-only list">
        <ol>
            <li><?= Yii::t('yii', '1024 cards for learning English words')?></li>
            <li><?= Yii::t('yii', 'a box for storage of cards')?></li>
            <li><?= Yii::t('yii', '9 board games for interactive learning')?></li>
            <li><?= Yii::t('yii', 'a study-box for spaced repetition')?></li>
            <li><?= Yii::t('yii', 'a case for easy use of cards')?></li>
        </ol>
    </div>
    <div class="screen screen-1" style="height: auto">
        <div class="logoes-wrapper flexbox">
            <?php foreach ($partners as $item) { ?>
                <div class="partner">
                    <?php if ($item['link']){ ?>
                        <a href="<?=$item['link']?>" target="_blank">
                            <img src="<?=$item['image']?>" alt="<?=$item['alt']?>" title="<?=$item['title']?>">
                        </a>
                    <?php } else { ?>
                        <img src="<?=$item['image']?>" alt="<?=$item['alt']?>" title="<?=$item['title']?>">
                    <?php }?>
                </div>
            <?php }?>
        </div>
        <div class="info-mom title-main" style="height: auto">
            <div class="header">
                <span class="bold"><?=Yii::t('yii','our partners')?></span>
            </div>
            <div class="separator"></div>
            <div class="description">
                <ul class="partners-list">
                    <?php foreach ($listPartners as $item) { ?>
                        <li><?=$item?></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="screen screen-title offset-top">
        <p class="bold"><?=Yii::t('yii','5reasons')?></p>
        <div class="separator"></div>
        <div class="flexbox reasons-container">
            <div class="reason-wrapper flexbox">
                <div class="icon-reason">
                    <div class="ico-reason-1"></div>
                </div>
                <div class="text-reason">
                    <?=Yii::t('yii', 'reason1')?>
                </div>
            </div>
            <div class="reason-wrapper flexbox">
                <div class="icon-reason">
                    <div class="ico-reason-2"></div>
                </div>
                <div class="text-reason">
                    <?=Yii::t('yii', 'reason2')?>
                </div>
            </div>
            <div class="reason-wrapper flexbox">
                <div class="icon-reason">
                    <div class="ico-reason-3"></div>
                </div>
                <div class="text-reason">
                    <?=Yii::t('yii', 'reason3')?>
                </div>
            </div>
            <div class="reason-wrapper flexbox">
                <div class="icon-reason">
                    <div class="ico-reason-4"></div>
                </div>
                <div class="text-reason">
                    <?=Yii::t('yii', 'reason4')?>
                </div>
            </div>
        </div>
    </div>
    <div class="screen screen-title">
        <p  class="bold"><?=Yii::t('yii','need-to-work')?></p>
        <div class="separator"></div>
        <div class="flexbox to-work-container">
            <div class="step-work flexbox">
                <div class="icon-work">
                    <div class="ico-work-1"></div>
                </div>
                <div class="text-work">
                    <span><?=Yii::t('yii','work1')?></span>
                </div>
            </div>
            <div class="step-work flexbox">
                <div class="icon-work">
                    <div class="ico-work-2"></div>
                </div>
                <div class="text-work">
                    <span><?=Yii::t('yii','work2')?></span>
                </div>
            </div>
            <div class="step-work flexbox">
                <div class="icon-work">
                    <div class="ico-work-3"></div>
                </div>
                <div class="text-work">
                    <span><?=Yii::t('yii','work3')?></span>
                </div>
            </div>
            <div class="step-work flexbox">
                <div class="icon-work">
                    <div class="ico-work-4"></div>
                </div>
                <div class="text-work">
                    <span><?=Yii::t('yii','work4')?></span>
                </div>
            </div>
            <div class="step-work flexbox">
                <div class="icon-work">
                    <div class="ico-work-5"></div>
                </div>
                <div class="text-work">
                    <span><?=Yii::t('yii','work5')?></span>
                </div>
            </div>
        </div>
    </div>
    <div class="screen screen-title">
        <p  class="bold"><?=Yii::t('yii','make-order')?></p>
        <div class="separator"></div>
        <div class="form-partners">
            <form id="partners-order" method="POST" class="partners-form">
                <div class="form-group">
                    <input type="text" name="name-partner" placeholder="<?=Yii::t('yii','placeholder_comment_name')?>">
                    <label  class="error hidden"><?=Yii::t('yii','error_comment_name')?></label>
                </div>
                <div class="form-group">
                    <input type="email" name="email-partner" placeholder="<?=Yii::t('yii','placeholder_comment_email')?>">
                    <label  class="error hidden"><?=Yii::t('yii','error_comment_email')?></label>
                </div>
                <div class="form-group">
                    <input type="test" name="phone-partner" placeholder="Телефон">
                    <label class="error hidden"></label>
                </div>
                <div class="form-group">
                    <input type="text" name="request-partner" placeholder="<?=Yii::t('yii','placeholder_partner_info')?>">
                </div>
                <div class="form-group button-buy-wrapper">
                    <button type="submit" name="comment-submit" ><?=Yii::t('yii','send')?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include("good-modal.tpl"); ?>
<script>

function validatePartners(){
    var ret = true;
    var $email = $('input[name="email-partner"');
    var $name = $('input[name="name-partner"');
    
    if (!validateEmail($email.val())){
        $email.addClass('error');
        $email.next().removeClass('hidden');
        ret = false;
    } else{
        $email.removeClass('error');
        $email.next().addClass('hidden');
    }
    if ($name.val().length < 3){
        $name.addClass('error');
        $name.next().removeClass('hidden');
        ret = false;
    } else {
        $name.removeClass('error');
        $name.next().addClass('hidden');
    }
    return ret;
}
$('.partners-form').on('submit', function(e){
    e.preventDefault();
    if (validatePartners() == false)
        return false;
    $.ajax({
        type: "POST",
        url: "<?= Url::to(['partners/order']); ?>",
        dataType: "JSON",
        processData: false,
        contentType: false,
        data: new FormData( this ),
        error: function(response){
            console.log(response + "error");
            $('#good-modal2').css('display', 'block').animate({
                opacity: 1
            },250);
        },
        success: function(response) {
            console.log(response);
            $('#good-modal2').css('display', 'block').animate({
                opacity: 1
            },250);
        }
    });
});
</script>