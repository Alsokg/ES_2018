<?php
use yii\helpers\Url;
?>
<div class="order-modal" id="order-modal">
    <div class="modal-content">
        <div class="scrolable">
            <div class="close-icon" id="close-modal">
                <div class="close-line"></div>
                <div class="close-line"></div>
            </div>
            <div class="screen-title order-title">
                <p><?=  Yii::t('yii', 'Your order') ?></p>
                <div class="separator"></div>
            </div>
            <form id="kids-order" method="POST">
                <div class="product product-title">
                    <div class="product-img">
                    </div>
                    <div class="product-name">
                        <?=  Yii::t('yii', 'Product name') ?>
                    </div>
                    <div class="form-group numeric">
                        <label for="qty"><?=  Yii::t('yii', 'qty') ?></label>
                    </div>                
                    <div class="price">
                        <span><?=  Yii::t('yii', 'price') ?></span>
                    </div>
                    <div class="price-total">
                        <span><?=  Yii::t('yii', 'full price') ?></span>
                    </div>
                </div>
                <div class="product product-one" id="kids">
                    <div class="product-img">
                        <img src="<?= $url.$productImages[0]['src'] ?>" alt="<?= $productImages[0]['alt'] ?>">
                        <input type="hidden" name="pr-image[]" value="<?= $url.$productImages[0]['src'] ?>">
                    </div>
                    <div class="product-name">
                        <p><?= $productName; ?></p>
                        <input type="hidden" name="pr-name[]" value="<?= $productName; ?>">
                        <input type="hidden" name="pr-id[]" value="1">
                    </div>
                    <div class="form-group numeric">
                        <input type="text" name="qty" id="qty[]" value="1" disabled>
                        <input type="hidden" name="qty1" id="qty1[]" value="1">
                        <span class="inc">+</span>
                        <span class="dec">-</span>
                    </div>                
                    <div class="price">
                        <span class="price-i"><?= $price ?></span> <span><?= Yii::t('yii', 'UAH') ?></span>
                        <input id="price-kids" name="price[]" type="hidden" value="<?= $price ?>">
                        
                    </div>
                    <div class="price-total">
                        <span  class="price-i"><?= $price ?></span> <span><?= Yii::t('yii', 'UAH') ?></span>
                        <input id="total-kids" name="ttl" type="hidden" value="<?= $price ?>">
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
                    <div class="form-group button-buy-wrapper">
                        <input type="hidden" name="guid" id="guid" value="">
                        <button type="submit"><?= Yii::t('yii', 'Make order') ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    
    
  function guidGenerator() {
    var S4 = function() {
       return (((1+Math.random())*0x10000)|0).toString(16).substring(1);
    };
    return (S4()+S4()+"-"+S4()+"-"+S4()+"-"+S4()+"-"+S4()+S4()+S4());
}           
     var guid;
         function gaInfoSend(){
                          var productsTXT = "";
             var productsCount = "";
             var productsPrice = "";
             var total = $('#total-kids').val();
        ga('require', 'ecommerce', 'ecommerce.js');

//ADD TOP LEVEL TRACKING INFO
        ga('ecommerce:addTransaction', {
        id: guid, 
        affiliation: 'English Student Junior',
        revenue: total,
        shipping: $('#delivery1').val(), 
        tax: 0 
        });

var skus= ["Junior", "A1", "A2", "B1", "B2"];

if (parseInt($('#qty1').val()) > 0){
    
        ga('ecommerce:addItem', {
            id: guid,
            sku: "Junior",
            name: "<?= $productName; ?> + kids_page",
            category: "<?= $productID; ?>", 
            price: "<?= $price ?>", 
            quantity: parseInt($('#qty1').val())
            });
        productsTXT += skus[0] + "\n";
        productsPrice += parseInt($('#qty1').val()) + " x " +  "<?= $price ?>\n";
        productsCount += parseInt($('#qty1').val()) + "\n";
}


ga('ecommerce:send');
var payment = $('#delivery1').val();
var name = $('#name').val();
var phone = $('#phone').val();
var email = $('#email').val();
var myJSONStr = 'payload= { "username": "ES BOT Kids",   "attachments": [{  "fallback": "This attachement isnt supported.", "title": "Замовлення з сайту",  "color": "#141414", "fields": [{ "title": "Товар:",  "value":"' + productsTXT + '","short": true},{"title": "Кількість х Ціна:","value":"' + productsPrice + '","short": true}, {"title": "Сумма","value":' + total + '}],"mrkdwn_in": ["text", "fields"],"text": "Від: ' +  name + ', Телефон: ' + phone + ', Пошта: ' + email + ', Оплата: ' + $('#delivery1').val() + '"}]}';

//console.log(myJSONStr);

  var xmlhttp = new XMLHttpRequest(),
        webhook_url = "https://hooks.slack.com/services/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";
    xmlhttp.open('POST', webhook_url, false);
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlhttp.send(myJSONStr);
    }  
  //  $( "#phone" ).phoneValidator();
     $("#kids-order").validate({
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
            if ($( "#phone" ).attr('data-valid') == 'true'){
              //  $('#phone').next().removeClass('fix-visible');
            } else {
             //   $('#phone').next().addClass('fix-visible');
              //  return false;
            }
            guid  = guidGenerator();
            $('#guid').val(guid);
            $.ajax({
                type: "POST",
                  
                url: "<?= Url::to(['site/apiorder']); ?>",
                 dataType: "JSON",
                data: $(form).serialize(),
                beforeSend: function(){
			$('#kids-order button').attr('disabled', true).empty().html('<i class="fa fa-spinner" aria-hidden="true"></i>');
                  gaInfoSend();  
                },
                error: function(response){  
                                      setTimeout(function(){
                        if ($('#delivery1').val() == 'LIQPAY'){
                            $(location).attr('href', "<?= Url::to(['liqpay/index']); ?>");
                        } else {
                            $(location).attr('href', "<?= Url::to(['success/index']); ?>");
                        }
                    }, 100);
                },
                success: function(response) {
                    
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
    $('.buy-kids').on('click', function(e){
       e.preventDefault();
       $('#order-modal').css('display', 'block').animate({
           opacity: 1
       });
       $('html, body').addClass('no-scroll');
       
    });
    
    $('.inc').on('click', function(){
       var i = parseInt($('#qty').val()) + 1;
       $('#qty').val(i);
       $('#qty1').val(i);
       updatePrice('kids', i);
    });
    $('.dec').on('click', function(){
       var i = parseInt($('#qty').val());
       if (i > 0){
           i--;
           $('#qty').val(i);
           $('#qty1').val(i);
       }
       updatePrice('kids', i);
    });
    function updatePrice(el, count){
        
        var price = parseInt($("#" + el).find('#price-' + el).val());
        $("#" + el).find('#total-' + el).empty().val(price*count);
        $("#" + el).find('.price-total .price-i').empty().text(price*count);
    }
    
});    
</script>