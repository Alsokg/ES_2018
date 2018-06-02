  
var customKidsAdditionalDiscount = 0;
var customKidsCount = 0;

var Product = function(options){
 
    var vars = {
        count : 0,
        price : 399,
        oldPrice: 499,
        classToUpdate: "",
        id : 0,
        signal: ".notify-cart",
        totalPrice: 0,
        totalOldPrice: 0
    };
    var root = this;
    var $add =0;
    var $dec =0;
    var $txtPrice =0;
    var $txtTotal =0;
    var $price =0;
    var $total =0;
    var $countInput;
    var $countTextI;
    var $counts;
    var $pseudoProduct;
    var $totalOld;
    var $totalOldCSS;
    var $clearBtn;
    

    this.construct = function(options){
        $.extend(vars , options);
        $add = $('.' + vars.classToUpdate + ' .inc' + vars.id);
        $dec = $('.' + vars.classToUpdate + ' .dec' + vars.id);
        $txtTotal  = $('.' + vars.classToUpdate + ' .total' + vars.id + ' .price-i');
        $total = $('.' + vars.classToUpdate + ' #total' + vars.id);
        $countTextI = $('.' + vars.classToUpdate + ' .qty' + vars.id);
        $countInput = $('.' + vars.classToUpdate + ' .qty1' + vars.id);
        $pseudoProduct = $('.pseudo-form .' + vars.classToUpdate).fadeOut(200);
        $clearBtn = $('.' + vars.classToUpdate + ' .clear-offset');
        
        $totalOld = $('.' + vars.classToUpdate + ' .summury .old');
        $totalOldCSS = $('.' + vars.classToUpdate + ' .summury').css('display', 'none');
        $total.empty().val(0);
        
        $counts = $('.' + vars.classToUpdate + ' .counts');
        
        $add.on('click', function(){
            root.add();
        });
        $dec.on('click', function(){
            root.dec();
        });
        $clearBtn.on('click', function() {
            root.clearCount();
        })
    };
    
    
 

    this.add = function(){
        vars.count++;
        vars.totalPrice = vars.count*vars.price;
        vars.totalOldPrice = vars.count*vars.oldPrice;
        if (vars.id == 1){
            customKidsCount++;
        }
        root.update();
            
    };
    this.dec = function(){
        if (vars.count > 0){
            vars.count--;
            vars.totalPrice = vars.count*vars.price;
            vars.totalOldPrice = vars.count*vars.oldPrice;
        if (vars.id == 1){
            customKidsCount--;
        }
            root.update();
        }
    }
    this.getCount = function(){
        return vars.count;
    }
    this.getPrice = function(){
        return vars.price;
    }
    this.getTotal = function(){
        return vars.count*vars.price;
    }
    this.getTotaOld = function(){
        return vars.count*vars.oldPrice;
    }
    
    this.clearCount = function(){
        vars.count = 0;
        vars.totalPrice = vars.count*vars.price;
        vars.totalOldPrice = vars.count*vars.oldPrice;
        
        root.update();
    }

    this.update = function(){
        $txtTotal.empty().text(vars.totalPrice);
        $total.val(vars.totalPrice);
        $countInput.val(vars.count);
        $countTextI.val(vars.count);
        if($counts.length){
            if (vars.count > 0){
                $counts.removeClass('transparent').find('.pr-count').empty().text(vars.count);
                $counts.parent().addClass('green-border')
            } else {
                $counts.addClass('transparent').find('.pr-count').empty();
                $counts.parent().removeClass('green-border');
            }
        }
        if(vars.count > 0){
            $pseudoProduct.fadeIn(200);
        }else{
            $pseudoProduct.fadeOut(200);
        }
        
        if (vars.oldPrice*vars.count > 0){
            $totalOld.empty().text(vars.oldPrice*vars.count);
            $totalOldCSS.css('display', 'inline');
        } else {
            $totalOld.empty();
            $totalOldCSS.css('display', 'none');
        }
        
        $(vars.signal).trigger('click');
    }
    
    this.construct(options);
 
};

var Cart = function(options){
 
    var total = {
        discount: 0,
        productsForDiscount: 0
    };
    
        var count = 0;
        var price = 0;
        var productPromo = 0;
        var oldPrice= 0;
        var classToUpdate= "";
        var products= [];
        var productsCount= 0;
        var totalDiscount = 0;
        var $screenCart = $('.screen-cart');
        var $total = $('.total-price .total');
        var $totalOld = $('.total-price .old');
        var $formTotal = $("#total-form");
    var root = this;

    this.construct = function(options){
        $.extend(total , options);
        $('.notify-cart').on('click', function(){
            root.updateCartTotal();
        })
    };
 
    this.updateCartTotal = function(){
        var totalPrice = 0;
        var totalCounts = 0;
        var totalOld = 0;
        totalDiscount = 0;
        var fixKids = products[0].getTotal();
        for (var i = 0; i < productsCount; i++){
            totalPrice += products[i].getTotal();
            totalCounts += products[i].getCount();
            totalOld += products[i].getTotaOld();
        }
        count = totalCounts;

        //var multi = parseInt(count/total.productsForDiscount);
        if (count >= total.productsForDiscount){
            totalDiscount = count*total.discount;
            // if (customKidsCount > 0){
            //     totalDiscount = totalDiscount + (customKidsAdditionalDiscount*customKidsCount);
            // }
        }
        if (productPromo > 0) {
            for (var i = 0; i < products.length; i++){
                var prDiscount = products[i].getPrice()/100.0;
                totalDiscount += Math.ceil(prDiscount)*productPromo*products[i].getCount();
            }
        }
        else{
            totalDiscount = 0;
        }
        price = totalPrice - totalDiscount;
        
        if (totalOld != 0){
            totalOld += + fixKids;
        }else{
            totalOld = totalPrice;
        }
        if (count > 0){
            $screenCart.fadeIn(200);
            $total.empty().text(price);
            $totalOld.empty().text(totalOld);
            $formTotal.val(price);
            $('.cart-action').addClass('flexbox').find('.cart-num').empty().text(count);
            $('#ttl').val(price)
        }else{
            $screenCart.fadeOut(200);
            $total.empty().text(price);
            $totalOld.empty().text(totalOld);
            $('.cart-action').removeClass('flexbox');
            
        }
        if (totalOld <= price){
            $totalOld.parent().css('display', 'none');
        } else {
            $totalOld.parent().css('display', 'inline');
        }
        
        //console.log(totalDiscount);
    }
    
    this.setPromo = function(percent){
        // console.log("setPromo => ", percent);
        productPromo = percent;
        root.updateCartTotal();
    }

    this.addProduct = function(pr){
        products[productsCount] = pr;
        productsCount += 1;
    };
    
    this.getTotal = function(){
        return price;
    }
    
    this.clearAll = function(){
        for (var i = 0; i < productsCount; i++){
            if (products[i].getCount() > 0){
                products[i].clearCount();
            }
        }
    }
    
    this.construct(options);
 
}; 

$(document).ready(function(){
    $('#close-good-modal, .to-main').on('click', function(e){
        e.preventDefault();
        $('#good-modal').animate({
                        opacity: 0
                    }, 250);
                    setTimeout(function() {$('#good-modal').css('display', 'none')}, 250);    
    
        return false;
    });
});    



 
