var message = 0;
var $modal = 0;
var $modalEdit = 0;
function ajaxSend(urls, selector){
    if (message == 0)
        message = new Messages();
    $(selector).on('submit', function(e){
        e.preventDefault();
        var $form = $(this);
        $.ajax({
            type: "POST",
            url: urls,
            dataType: "JSON",
            data: $form.serialize(),
            error: function(response){
                console.log(response);
            },
            success: function(response) {
                console.log(response);
                if (response['error']){
                    message.addMessage(response['error'], 'error');
                }
                if (response['success']){
                    message.addMessage(response['success'], 'success');
                    if (response['refresh_src']){
                        for(var k in response['refresh_src']) {
                            $('#img_' + k).attr('src', response['refresh_src'][k]);
                        }
                    }
                    if (response['clearID']){
                        var $next = $('#id' + response['clearID']).next();
                        $('#id' + response['clearID']).remove();
                        if ($next.hasClass('details-wrapper')){
                            $next.remove();
                        }
                        hideModal($modal);
                    }
                }
                hideModal($modal);
            }
        });
    });
}

function showModal($modal){
    $modal.css('display', 'block');
    $modal.animate({
       opacity: 1
    }, 250);
}
function hideModal($modal){
    $modal.css({
        'display' : 'none',
        'opacity' : 0
    });
}
$(document).ready(function(){
    $modal = $('.overlay-delete');
    $modalEdit = $('.overlay-edit');
   $('.tab-widget .tab').on('click', function(){
       $(this).parent().find('div').removeClass('active');
        $(this).next().addClass('active');
        $(this).parent().find('.tab').removeClass('selected');
        $(this).addClass('selected');
    });
    $('.msg').slideUp(150).css('display', 'block');

    $('.dropdown').prev().on('click', function(e){
        e.preventDefault();
        $(this).next().slideDown(350).parent().addClass('sub');
    })
    $('.delete').on('click', function(){
       var $container = $(this).parent().parent();
       var id = $container.find('.id').text();

        showModal($modal);
       $('#comment-id').val(id);
       var txt = "Ви впевнені, що хочете видалити коментар під номером: " + id + "?";
       $modal.find('.text').empty().text(txt);
    });
    $('.delete-logo').on('click', function(){
       var $container = $(this).parent().parent();
       var id = $container.find('.logo-id').val();

        showModal($modal);
       $('#logo-id').val(id);
       var txt = "Ви впевнені, що хочете видалити Партнера: " + id + "?";
       $modal.find('.text').empty().text(txt);
    });
    $('.delete-product').on('click', function(){
       var $container = $(this).parent().parent();
       var id = $container.find('.product-id').val();

        showModal($modal);
       $('#product-id').val(id);
       var txt = "Ви впевнені, що хочете видалити Продукт: " + id + "?";
       $modal.find('.text').empty().text(txt);
    });
    $('.delete-order').on('click', function(){
       var $container = $(this).parent().parent();
       var id = $container.find('.order-id').text();

        showModal($modal);
       $('#order-id').val(id);
       var txt = "Ви впевнені, що хочете видалити Замовлення під номером: " + id + "?";
       $modal.find('.text').empty().text(txt);
    });
    
    $('#delete-comment, #delete-order, #delete-logo, #delete-product').on('reset', function(){
        hideModal($modal);
    })
    $('.dropdown-details').on('click', function(){
        
        var $container = $(this).parent().parent().removeClass('new');
        
        var id = $container.find('.order-id').text();
        
        var url = '/uk/admin/updateorderviewed/' + id;
        $container.next().toggleClass('height-auto');
        $.ajax({
            type: "POST",
            url: url,
            data: 0,
            error: function(response){
                console.log(response);
            },
            success: function(response) {
                if (response['success'] == 1){
                    var val = $('.toolbar .orders span').text();
                    $('.toolbar .orders span').empty().text(val - 1);
                }
                console.log(response)
            }
        }); 
    });
    $('.edit').on('click', function(){
        var $container = $(this).parent().parent().removeClass('new');
        
        showModal($modalEdit);
        var id = $container.find('.id').text();
        var name = $container.find('.name').text();
        var text = $container.find('.text').text();
        var email = $container.find('.email').text();
        var who = $container.find('.who').text();
        var publish = $container.find('.publish').text();
        var featured = $container.find('.main-page').text();
        var img = $container.find('.img-src').text();
        var rating = $container.find('.rating').text();
        var product = $container.find('.product-name').text();
        $('#id-title').empty().text(id);
        $('#update-id').val(id);
        $('#name').val(name);
        $('#comment-text').empty().text(text);
        $('#email').val(email);
        $('#who').val(who);
        $('#img_image_src').attr('src', img);
        $('#image_src').val(img);
        $('#rating').val(rating);
        $('.product-name-form').empty().text(product);
        if (publish == 1)
            $('#publish').prop('checked', true);
        else
            $('#publish').prop('checked', false);
        if (featured == 1)
            $('#featured').prop('checked', true);
        else
            $('#featured').prop('checked', false);
        var url = '/uk/admin/updatecommentviewed/' + id;
        $.ajax({
            type: "POST",
            url: url,
            data: 0,
            error: function(response){
                console.log(response);
            },
            success: function(response) {
                if (response['success'] == 1){
                    var val = $('.toolbar .comments span').text();
                    $('.toolbar .comments span').empty().text(val - 1);
                }
                console.log(response)
            }
        });
});
    $('.close-edit').on('click',function(){
        hideModal($modalEdit);
    });
});

    
    var Messages = function(options){
 
        var vars  = {
            count: 0,
            container: '.msg'
        }
        vars.count = 0;
        var root = this;
        var $container = $(vars.container);
        this.construct = function(options){
            $.extend(vars , options);
            $('.msg').delegate('.close-msg', 'click', function(e){
                var $that = $(e.target);
                $that.parent().remove();
                root.removeMessage();
            });
        };
        
        this.addMessage = function(msg, type){
            vars.count++;
            $container.append("<div class='flexbox " + type + "'><span>" + msg + "</span><i class='fa fa-times close-msg' aria-hidden='true'></i></div>");
            if (vars.count > 0){
                $container.slideDown(350);
            }
          //  console.log("count add:" + vars.count);
        }
        this.removeMessage = function(){
            vars.count--;
            if (vars.count < 1){
                $container.slideUp(250);
            }
          //  console.log("count add:" + vars.count);
        }
        this.construct(options);
    };
    
    

  
    