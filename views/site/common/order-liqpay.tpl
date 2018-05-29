<?php
use yii\helpers\Url;
use yii\base\Widget;
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
                <div class="product product-one global-pr<?=$kidsID?>" style="display:none">
                    <div class="product-img">
                        <img src="<?= $url.$productImages[0]['src'] ?>" alt="<?= $productImages[0]['alt'] ?>">
                    </div>
                    <div class="product-name">
                        <p><?= $productName; ?></p>
                    </div>
                    <div class="form-group numeric">
                        <input class="qty<?=$kidsID?>" type="text" name="qty<?=$kidsID?>" id="qty<?=$kidsID?>" value="0" disabled>
                        <input class="qty1<?=$kidsID?>" type="hidden" name="qty1<?=$kidsID?>" id="qty1<?=$kidsID?>" value="0">
                        <span class="inc inc<?=$kidsID?>">+</span>
                        <span class="dec dec<?=$kidsID?>">-</span>
                    </div>                
                    <div class="price">
                        <span class="price-i<?=$kidsID?>"><?= $price ?></span> <span><?= Yii::t('yii', 'UAH') ?></span>
                        <input id="price<?=$kidsID?>" name="price<?=$kidsID?>" type="hidden" value="<?= $price ?>">
                    </div>
                    <div class="price-total total<?=$kidsID?>">
                        <span  class="price-i">0</span> <span><?= Yii::t('yii', 'UAH') ?></span>
                        <input id="total<?=$kidsID?>" name="total<?=$kidsID?>" type="hidden" value="0">
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
                        <input class="qty<?=$pr['id']?>" type="text" name="qty<?=$pr['id']?>" id="qty<?=$pr['id']?>" value="0" disabled>
                        <input class="qty1<?=$pr['id']?>" type="hidden" name="qty1<?=$pr['id']?>" id="qty1<?=$pr['id']?>" value="0" >
                        <span class="inc inc<?=$pr['id']?>">+</span>
                        <span class="dec dec<?=$pr['id']?>">-</span>
                    </div>  
                    <div class="price">
                        <span class="price-i<?=$pr['id']?>"><?= $pr['price'] ?></span> <span><?= Yii::t('yii', 'UAH') ?></span>
                        <span class="total-strike"><?=$pr['old_price']?><span class="old"></span> <?= Yii::t('yii', 'UAH') ?></span>
                        <input id="price<?=$pr['id']?>" name="price<?=$pr['id']?>" type="hidden" value="<?= $pr['price'] ?>">
                    </div>
                    <div class="price-total total<?=$pr['id']?>">
                        <span  class="price-i">0</span> <span><?= Yii::t('yii', 'UAH') ?></span>
                        <span class="total-strike summury"><span class="old"></span> <?= Yii::t('yii', 'UAH') ?></span>
                        <input id="total<?=$pr['id']?>" name="total<?=$pr['id']?>" type="hidden" value="0">
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
<form method="POST" accept-charset="utf-8" action="https://www.liqpay.ua/api/3/checkout">
	<input type="hidden" name="data" value="eyJ2ZXJzaW9uIjozLCJhY3Rpb24iOiJwYXkiLCJwdWJsaWNfa2V5IjoiaTY1MTc4MDYyNTY5IiwiYW1vdW50IjoiNSIsImN1cnJlbmN5IjoiVUFIIiwiZGVzY3JpcHRpb24iOiLQnNC+0Lkg0YLQvtCy0LDRgCIsInR5cGUiOiJidXkiLCJzYW5kYm94IjoiMSIsInNlcnZlcl91cmwiOiJodHRwczovL2VuZ2xpc2hzdHVkZW50Lm5ldC9saXFwYXkvcmVzdWx0IiwicmVzdWx0X3VybCI6Imh0dHBzOi8vZW5nbGlzaHN0dWRlbnQubmV0L2xpcXBheS9yZXN1bHQiLCJsYW5ndWFnZSI6InJ1In0=" />
	<input type="hidden" name="signature" value="2SWk+yM0bq8nR3ZZOenlAD3rCmU=" />
	<button style="border: none !important; display:inline-block !important;text-align: center !important;padding: 7px 20px !important;
		color: #fff !important; font-size:16px !important; font-weight: 600 !important; font-family:OpenSans, sans-serif; cursor: pointer !important; border-radius: 2px !important;
		background: rgb(122,183,43) !important;"onmouseover="this.style.opacity='0.5';" onmouseout="this.style.opacity='1';">
		<img src="https://static.liqpay.ua/buttons/logo-small.png" name="btn_text"
			style="margin-right: 7px !important; vertical-align: middle !important;"/>
		<span style="vertical-align:middle; !important">Оплатить 5 UAH</span>
	</button>
</form>
<script>
     var cart;
     var products = [];
$(document).ready(function(){

$('.code-show').on('click', function(e){
	e.preventDefault();
	$('#promo-code').css('display', 'block');
});

 function guidGenerator() {
    var S4 = function() {
       return (((1+Math.random())*0x10000)|0).toString(16).substring(1);
    };
    return (S4()+S4()+"-"+S4()+"-"+S4()+"-"+S4()+"-"+S4()+S4()+S4());
}   

  //  $( "#phone" ).phoneValidator();
    
   
    
    <?php if ($sale) { ?>
         cart = new Cart({discount: <?=$discount?>, productsForDiscount: <?=$saleCount?>});
    <?php }  else {?>
         cart = new Cart();
         <?php } ?>
         
         var prKids = new Product({ count : 0, price: <?= $price ?>, oldPrice: 0, classToUpdate: 'global-pr1', id: 1 });
cart.addProduct(prKids);

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

var skus= ["Junior", "A1", "A2", "B11", "B12", "B21", "B22", "C1", "C2"];

if (prKids.getCount() > 0){
    
        ga('ecommerce:addItem', {
            id: guid,
            sku: skus[0],
            name: "<?= $productName; ?>", 
            category: "<?= $kidsID; ?>", 
            price: "<?= $price ?>", 
            quantity: prKids.getCount()
            });
        productsTXT += skus[0] + "\n";
        productsPrice += prKids.getCount() + " x " +  "<?= $price ?>\n";
        productsCount += prKids.getCount() + "\n";
        
}
var i = 0;
<?php $i=0; foreach ($productsArray as $pr) { ?>
    console.log(i);
    if(products[<?=$i?>].getCount() > 0){
            
        ga('ecommerce:addItem', {
            id: guid,
            sku: skus[i + 1],
             name: "<?=$pr['name']?> ", 
            category: "<?=$pr['id']?> ", 
            price: "<?=$pr['price']?> ", 
            quantity: products[<?=$i?>].getCount()
            });
        
        productsTXT += skus[<?=$i?>+1] + "\n";
//console.log("product-id");
//console.log(skus[i+1]);
//console.log(productsTXT);
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

var discount = "";
if (validatePromo(code) == 1){
	discount = "Promo Code:" + code;
}
//Slack Bot
var myJSONStr = 'payload= { "username": "ES BOT",   "attachments": [{  "fallback": "This attachement isnt supported.", "title": "Замовлення з сайту",  "color": "#141414", "fields": [{ "title": "Товар:",  "value":"' + productsTXT + '","short": true},{"title": "Кількість х Ціна:","value":"' + productsPrice + '","short": true}, {"title": "Сумма","value":' + total + '}],"mrkdwn_in": ["text", "fields"],"text": "Від: ' +  name + ', Телефон: ' + phone + ', Пошта: ' + email + ', Оплата: ' + payment + ' ' + discount + '"}]}';

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
                  
                url: "<?= Url::to(['site/full']); ?>",
                 dataType: "JSON",
                data: $(form).serialize(),
                beforeSend: function(){
			$('#order-modal-full button').attr('disabled', true).empty().html('<i class="fa fa-spinner" aria-hidden="true"></i>');
                  //gaInfoSend();  
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