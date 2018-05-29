<?php
use yii\helpers\Url;
?>

<div id="box-<?=$slag?>" class="multy-product-widget">
    
</div>

<?php if ($productsArray) { ?>

<div id="boxes" class="screen screen-products screen-title">
        <p><?= Yii::t('yii', 'multy-pr-title') ?></p>
        <div class="separator"></div>
        <p class="notice"><?= Yii::t('yii', 'multy-pr-notice') ?></p>
        <div class="flexbox products-container">

<div class="desktop-promo">
<div class="flexbox">
	<div class="secont-promo"><div class="secont-bg">
<div class="text-wrapper"><?= Yii::t('yii', 'Get free delivery, when order 2 boxes') ?></div>
</div>
</div>
    <?php if ($sale){ ?>
        <div class="screen screen-promo screen-title">
            <div class="promo-section promo-main">
                <div class="text">
                    <?= $sale['title_'.$lang] ?>
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
                <img src="<?= $pr['image-src'] ?>" alt="<?= $pr['image-alt'] ?>">
                <p class="title"><?= $pr['name_'.$lang] ?></p>
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

                <?php foreach($productsArray as $pr) { ?>
                <div class="product product-eng global-pr<?=$pr['id']?>">
                    <div class="product-img">
                        <img src="<?= $pr['image-src'] ?>" alt="<?= $pr['image-alt'] ?>">
                    </div>
                    <div class="product-name">
                        <p><?= $pr['name_'.$lang] ?></p>
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

<div class="notify-cart"></div>
            <div class="cart-action global-form">
                <span class="cart-ico"></span>
                <span class="cart-num"></span>
            </div>
            

<script>
     var cart;
     var products = [];
$(document).ready(function(){
function validatePromo(code){
    if (code == "ES_promo_2018" || code == "5107" || code == "ES_summer"){
        return true;
    } else {
        return false;
    }
}
var promoDiscount = 0;
$('#promo-code').on('keyup', function(){
   if(validatePromo($(this).val())){
       $(this).addClass('valid-promo').css({
           "background" : "rgba(61,255,61,0.25)"
       });
       promoDiscount = 5;
       
   } else {
       $(this).removeClass('valid-promo');
       promoDiscount = 0;
   }
   cart.setPromo(promoDiscount);
});
$('.code-show').on('click', function(e){
	e.preventDefault();
	$('#promo-code').css('display', 'block');
});

var session = <?php echo json_encode($session); ?>;

//fn
var form = document.getElementById('main-order');
for (var k in session){
    if (session.hasOwnProperty(k)) {
         console.log("Key is " + k + ", value is " + session[k]);
         let input = document.createElement('input');
         input.type = "hidden";
         input.name = input.id = k;
         input.value = session[k];
         form.appendChild(input);
    }
}
//fn end

 function guidGenerator() {
    var S4 = function() {
       return (((1+Math.random())*0x10000)|0).toString(16).substring(1);
    };
    return (S4()+S4()+"-"+S4()+"-"+S4()+"-"+S4()+"-"+S4()+S4()+S4());
}   

  //  $( "#phone" ).phoneValidator();
    
   
    
    <?php if ($sale) { ?>
         cart = new Cart({discount: <?=$sale['discount']?>, productsForDiscount: <?=$sale['products_for_discount']?>});
    <?php }  else {?>
         cart = new Cart();
         <?php } ?>


<?php $i=0; foreach ($productsArray as $product) { ?>
    products[<?=$i?>] = new Product({ count : 0, price: <?= $productsArray[$i]['price'] ?>, oldPrice: <?= $productsArray[$i]['old_price'] ?>, classToUpdate: 'global-pr<?=$productsArray[$i]["id"]?>', id: <?=$productsArray[$i]["id"]?> });
    cart.addProduct(products[<?=$i?>]);
<?php $i++;} ?>

    $('.global-form').on('click', function(e){
           e.preventDefault();
           $('html, body').addClass('no-scroll');
           $('#order-modal-full').css('display', 'block').animate({
           opacity: 1
       });
       });
       
var guid;     
         function gaInfoSend(){
             var productsTXT = "";
             var productsCount = "";
             var productsPrice = "";
             var total = cart.getTotal();
        ga('require', 'ecommerce', 'ecommerce.js');

//ADD TOP LEVEL TRACKING INFO
        ga('ecommerce:addTransaction', {
        id: guid, 
        affiliation: 'English Student',
        revenue: total,
        shipping: $('#delivery1').val(), 
        tax: 0 
        });

var nameCustom = $(".product-one .product-name p").first().text();

var skus= ["Bisiness English", "IT English"];


var i = 0;
<?php $i=0; foreach ($productsArray as $pr) { ?>
    console.log(i);
    if(products[<?=$i?>].getCount() > 0){
            
        ga('ecommerce:addItem', {
            id: guid,
            sku: skus[i],
             name: "<?=$pr['name_'.$lang]?> ", 
            category: "<?=$pr['id']?> ", 
            price: "<?=$pr['price']?> ", 
            quantity: products[<?=$i?>].getCount()
            });
        
        productsTXT += skus[<?=$i?>] + "\n";

        productsPrice += products[<?=$i?>].getCount() + " x " + "<?= $pr['price'] ?>\n";
        productsCount += products[<?=$i?>].getCount() + "\n";
    i++;
    }
<?php $i++; } ?>
ga('ecommerce:send');

var name=$('#name').val();
var email=$('#email').val();
var payment=$('#delivery1').val();
var phone=$('#phone').val();
var code = $('#promo-code').val();

var newPost = $('#new-post').val();

var discount = "";
function validatePromo(code){
    return false;
}
// if (validatePromo(code) == 1){
// 	discount = "Promo Code:" + code;
// }
//Slack Bot
var myJSONStr = 'payload= { "username": "ES BOT",   "attachments": [{  "fallback": "This attachement isnt supported.", "title": "Замовлення з сайту",  "color": "#141414", "fields": [{ "title": "Товар:",  "value":"' + productsTXT + '","short": true},{"title": "Кількість х Ціна:","value":"' + productsPrice + '","short": true}, {"title": "Сумма","value":' + total + '}],"mrkdwn_in": ["text", "fields"],"text": "Від: ' +  name + ', Телефон: ' + phone + ', Пошта: ' + email + ', Доставка: ' + newPost + ', Оплата: ' + payment + ' ' + discount + '"}]}';

//console.log(myJSONStr);

  var xmlhttp = new XMLHttpRequest(),
        webhook_url = "https://hooks.slack.com/services/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";
    xmlhttp.open('POST', webhook_url, false);
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlhttp.send(myJSONStr);
    
    }  
    
     $("#main-order").validate({
        ignore: ":hidden",
        rules: {
            name: {
                required: true,
                minlength: 3
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true,
                minlength: 8
            },
            delivery: {
                required: true
            }
        },
        messages: {   
            name: {
                required: "<?=  Yii::t('yii', 'set name') ?>",
                minlength: "<?=  Yii::t('yii', 'min 3 symbols') ?>"
            },
            email: {
                required: "<?=  Yii::t('yii', 'set email') ?>",
                email: "<?=  Yii::t('yii', 'invalid format') ?>"
            },
            phone: {
                required: "<?=  Yii::t('yii', 'set phone') ?>",
                minlength: "<?=  Yii::t('yii', 'invalid format') ?>"
            },
            delivery: {
                required: "<?=  Yii::t('yii', 'set delivery') ?>"
            }
        },
submitHandler: function(form) {
            guid  = guidGenerator();
            $('#guid').val(guid);
            
            $.ajax({
                type: "POST",
                  
                url: "<?= Url::to(['site/apiorder']); ?>",
                 dataType: "JSON",
                data: $(form).serialize(),
                beforeSend: function(){
			$('#order-modal-full button').attr('disabled', true).empty().html('<i class="fa fa-spinner" aria-hidden="true"></i>');
                  gaInfoSend();  
                },
                error: function(response){
                    console.log(response);
                 //                       if (response['status'] == 200){
                 //                           gaInfoSend();
                 //                           cart.clearAll();
                 //   $('#good-modal').css('display', 'block').animate({
                 //       opacity: 1
                 //   },250);
                 //   $('#close-modal-full').trigger('click');
                 //   }
                },
                success: function(response) {
                    //console.log(response);
                    //gaInfoSend();
                    cart.clearAll();
                    //$('#good-modal').css('display', 'block').animate({
                     //   opacity: 1
                    //},250);
                    //$('#close-modal-full').trigger('click');
                    setTimeout(function(){
                        if ($('#delivery1').val() == 'LIQPAY'){
                            $(location).attr('href', "<?= Url::to(['liqpay/index']); ?>");
                        } else {
                            $(location).attr('href', "<?= Url::to(['success/index']); ?>");
                        }
                    }, 100);
                    
                }
            });
            return false;
        }
    });
});    
</script>
<style>
@keyframes rotate360 {
  to { transform: rotate(360deg); }
}
.fa-spinner { animation: 2s rotate360 infinite linear; }
</style>

<?php include('parts/order-modal-full.php'); ?>