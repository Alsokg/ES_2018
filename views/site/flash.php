<?php

/* @var $this yii\web\View */

$this->title = $title;
?>
<div class="site-wrapper">
    <div class="screen screen-1">
        <div class="mom-bg" style="background-image: url(<?=$image?>)"></div>
        <div class="info-mom title-main">
            <div class="header">
                <?= $oneTitle ?>
            </div>
            <div class="separator"></div>
            <div class="description">
                <?= $oneDescription ?>
            </div>
            <div class="button-buy-wrapper">
                <a class="buy-kids to-product" data-product="boxes" href="#boxes"><?=Yii::t('yii', 'Buy')?></a>
            </div>
            <?php if (Yii::$app->language != 'uk'){ ?>
                <p class="notice"><?=Yii::t('yii', 'Cards are available only <span class="bold">in ukrainian</span>')?></p>
            <?php } ?>
        </div>
    </div>
        <div class="screen screen-2 screen-title">
            <p><?= $twoTitle ?></p>
            <div class="separator"></div>
        </div>
        <div class="screen-2 title-main offset-top">
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
            <div class="plus plus-mini-box inst-wr">
                <span class="num">5</span>
                <span class="pl">+</span>
                <span class="hover-bg"></span>
                <div class="txt"><?= Yii::t('yii', 'a case for easy use of cardsR')?><img class="inst" src="../img/inst.jpg" alt="box scheme"></div>
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
<div class="screen screen-4 screen-title">
            <p><span class="bold"><?= Yii::t('yii', '40 random cards')?></span></p>
            <div class="separator"></div>
            <?php include('common/tabWidget.php'); ?>
</div>
<div class="screen screen-41 screen-title">
            <p><?= $foneTitle ?></p>
            <div class="separator"></div>
            <?php include("common/lis-main.php") ?>
            <div class="themes-list flexbox">
                <?php  $aligner = 8; $j = 0; for ($i = 0; $i < 4; $i++) { ?>
                    <ul>
                        <?php if($i > 2)  $aligner = 8; for ($j; $j < $aligner*($i+1); $j++){ if (array_key_exists($j,$themes)){?>
                            <li>
                                <i class="sprite-icon <?=$themes[$j]['alt']?>"></i>
                                <span><?= Yii::t('yii', $themes[$j]['text']); ?></span>
                            </li>
                        <?php }} ?>
                    </ul>
                <?php } ?>
            </div>
</div>
<?php include('blocks/comment-block.php'); ?>
<div class="screen screen-products screen-title screen-video">
        <p><?= Yii::t('yii', 'video_text') ?></p>
        <div class="separator"></div>
    <div class="video-wrapper">
        <iframe src="https://www.youtube.com/embed/ZZSKx_IZDYM" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
    </div>
</div>
<?php if ($productsArray) { ?>

<div id="boxes" class="screen screen-products screen-title">
        <p><?= $productsTitle ?></p>
        <div class="separator"></div>
        <p class="notice"><?= $productsNotice ?></p>
        <div class="flexbox products-container">

<div class="desktop-promo" style="display: none">
<div class="flexbox">
	<div class="secont-promo"><div class="secont-bg">
<div class="text-wrapper"><?= Yii::t('yii', 'Get free delivery, when order 2 boxes') ?></div>
</div>
</div>
    <?php if ($sale){ ?>
        <div class="screen screen-promo screen-title">
            <div class="promo-section promo-main">
                <div class="text">
                    <?= $sale ?>
                </div>
            </div>    
        </div>
    <?php } ?>

</div>
</div>
            <?php foreach($productsArray as $pr) { ?>

            <div class="product-main global-pr<?=$pr['id']?>" id="product-<?=$pr['id']?>">
	<?php if($pr['new'] == 1) { ?>
<div class="container-l">                      
    <div class="badge">                      
        <div class="badge-text">
            NEW
        </div>
    </div>
</div>
		<?php } else if($pr['popular'] == 1) { ?>
<div class="container-l">                      
    <div class="badge badge-red">                      
        <div class="badge-text">
            TOP
        </div>
    </div>
</div>
		<?php } ?>
                <img src="<?= $url.$pr['images'][0]['src'] ?>" alt="<?= $pr['images'][0]['alt'] ?>">
                <div class="rating-wrapper">
                    <div class="rating">
                        <?php for ($i = 1; $i <= 5; $i++) { ?>
                            <?php if ($allRatings[$pr['id']]['rating'] < $i) { ?>
                                 <i class="fa fa-star"></i>
                            <?php } else { ?>
                                <i class="fa fa-star active"></i>
                            <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="reviews-count laodComments blue-text-btn">
                        <span class="show-all"><?= Yii::t('yii', '{delta, plural, one{1 day} other{# days}}', ['delta' => $allRatings[$pr['id']]['total']]);?></span>
                    </div>
                </div>
                <p class="title"><?= $pr['name'] ?></p>
                <?php if ($pr['old_price'] == 0) {$class2=" hidden";} else{ $class2=" "; }?>
                <div class="price"><span class="actual-price"><?= $pr['price'] . " " . Yii::t('yii', 'UAH') ?></span> <span class="old-price strike <?=$class2?>"><?= $pr['old_price'] . " " . Yii::t('yii', 'UAH')?></span></div>
                <div class="button-buy-wrapper">
                    <a class="buy inc<?=$pr['id']?> inc" href="javascript:void(0)" data-id="product-<?=$pr['id']?>"><?= Yii::t('yii', 'to cart')?></a>
                </div>
                <div class="counts green-color transparent">
                    <i class="fa fa-check-circle" aria-hidden="true"></i> <?= Yii::t('yii', 'Added')?> <span class="pr-count"></span> <?= Yii::t('yii', 'qt')?>
                </div>
            </div>
            <?php } ?>

        </div>
</div>
<?php } ?> 

    <?php if ($sale){ ?>
        <div class="screen screen-promo screen-title mobile-only">
            <div class="promo-section promo-main">
<span class="promo"><?= Yii::t('yii', 'Discount') ?></span>
                <div class="text">
                    <?= $sale ?>
                </div>
            </div>    
        </div>
    <?php } ?>

        <div class="screen screen-8 flexbox" style="display:none">
            <div class="half kids-img">
                <?php foreach ($productImages as $pImg) { ?>
                    <img src="<?= $url.$pImg['src'] ?>" alt="<?= $pImg['alt'] ?>">
                <?php } ?>
            </div>
            <div class="half ">
                <div class="product-wrapper global-pr<?=$kidsID?>" id="product-<?=$kidsID?>">
                    <div class="new-label"><?= Yii::t('yii', 'New') ?></div>
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
                        <span><?= Yii::t('yii', '{delta, plural, one{1 day} other{# days}}', ['delta' => $commentsKids]);?></span>
                    </div>
                    </div>
                    <div class="description">
                        <p><?= $productDescription ?></p>
                    </div>
                    <div class="price">
                        <p><?= $price ?> <?= Yii::t('yii', 'UAH') ?></p>
                    </div>
                     <div class="button-buy-wrapper">
                        <a class="buy blue-btn inc<?=$kidsID?> inc" href="javascript:void(0)" data-id="product-<?=$kidsID?>"><?= Yii::t('yii', 'to cart') ?></a>
                    </div>
                </div>
            </div>
        </div>
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
<?php if (isset($dev)){ ?>
<?php include('common/order-liqpay.tpl'); ?>
<?php } else { ?>
<?php include('common/order-modal-full.tpl'); ?>
<?php } ?>
<?php include("common/good-modal.tpl"); ?>
<script>
    $(document).ready(function(){
        var langJS = "<?='/' . Yii::$app->language . '/'?>";
        $('.to-product').on('click', function(e){
            e.preventDefault();
            var el = $('#boxes');
            var p = el.offset();
            var t = p.top;
           var body = $("html, body");
            body.stop().animate({scrollTop: t}, 300, 'swing'); 
        });
        
        var fadeTime = 200;
       //$('#A1, #A2, #B1, #B2').cbpFWSlider();
    function getCards(box){
        var urls = langJS +  "cards/getcards/" + box;
        $.ajax({
            type: "GET",
            url: urls,
            dataType: "JSON",
            data: {"info" : box},
                error: function(response){
                    console.log("error");
                    console.log(response);
                },
                success: function(response) {
                   $('#' + box + ' ul').find('.loader').remove();
                   $('#' + box + ' ul').append(response);
                   $('#' + box).cbpFWSlider().css('display', 'block');
                   $('.' + box).attr('data-loaded', '1');
                }
            });
        }
        
        getCards('a1');
       
       $('.nav-tab span').on('click', function(){

           
           var $current =  $('#' + $('.nav-tab .active').data('content'));
           var $next = $('#' + $(this).data('content'));
           var loaded =  $(this).attr('data-loaded');
           if (loaded == "0") {
                $('.nav-tab span').removeClass('active');
                    $(this).addClass('active');
                    $current.fadeOut(fadeTime, function(){
                        $next.fadeIn(fadeTime);
                    });
                    var content = $(this).data('content');
               setTimeout(function(){
                   getCards(content); 
               }, 250);
               //console.log("load: " + $(this).data('content'));
           } else {
            $('.nav-tab span').removeClass('active');
           $(this).addClass('active');
          // $current.hide();
          // $next.show();
           $current.fadeOut(fadeTime, function(){
               $next.fadeIn(fadeTime);
           });
           }
       });
       

       
    });
</script>