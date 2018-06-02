<?php
use yii\helpers\Url;
?>
<div class="order-modal" id="comment-modal-form">
    <div class="modal-content">
        <div class="scrolable">
            <div class="close-icon" id="close-modal-form">
                <div class="close-line"></div>
                <div class="close-line"></div>
            </div>
            <div class="screen-title order-title">
                <p><?=  Yii::t('yii', 'leave comment') ?></p>
                <div class="separator"></div>
            </div>
            <form id="comment-form" method="POST" class="comment-form" enctype="multipart/form-data">
                <div class="form-aligner">
                <div class="comment-view-wrapper flexbox">
                    <div class="form-group image-group">
                        <div class="image-preview">
                            <input type="file" name="ava-file" id="ava-file" />
                            <img id="preview" src="/upload/placeholder.png" alt="placeholder.png" />
                            <input type="hidden" name="image-src" id="image-src" value="placeholder.png">
                        </div>
                        <label for="ava-file" class="error hidden"><?=Yii::t('yii','error_comment_image')?></label>
                    </div>
                    <div class="form-group area-group">
                        <textarea rows="4" name="comment-comment" class="comment-comment" placeholder="<?=Yii::t('yii','placeholder_comment_comment')?>"></textarea>
                        <label class="error hidden"><?=Yii::t('yii','error_comment_comment')?></label>
                    </div>
                </div>
                <div class="rating">
                    <label><?=Yii::t('yii','rate this') . " ";?></label>    
                  <p class="input-rating-group">
                    <label class="star-for" data-id="s1"><input class="hidden" name="rating" value="1" type="radio"><i class="fa fa-star active" aria-hidden="true"></i></label>
                    <label class="star-for" data-id="s2"><input class="hidden" name="rating" value="2" type="radio"><i class="fa fa-star active" aria-hidden="true"></i></label>
                    <label class="star-for" data-id="s3"><input class="hidden" name="rating" value="3" type="radio"><i class="fa fa-star active" aria-hidden="true"></i></label>
                    <label class="star-for" data-id="s4"><input class="hidden" name="rating" value="4" type="radio"><i class="fa fa-star active" aria-hidden="true"></i></label>
                    <label class="star-for" data-id="s5"><input class="hidden" name="rating" value="5" checked="checked" type="radio"><i class="fa fa-star active" aria-hidden="true"></i></label>
                  </p>
                </div>
                <?php if (isset($productsArray)) { ?>
                    <div class="select-box form-group nav-tab">
                        <p><?=Yii::t('yii', 'box for')?></p>
                        <?php foreach($productsArray as $pr) { ?>
                            <span><label class="box-review"><input class="hidden" name="box-input" value="<?=$pr['id']?>" type="radio"><?=$pr['name']?></label></span>
                        <?php } ?>
                        <label class="error hidden"><?=Yii::t('yii','error_comment_box')?></label>
                    </div>
                <?php } ?>
                <div class="form-group">
                    <div class="social-login-btns">
                        
                        <span><?=Yii::t('yii', 'login with')?> </span>
                        <a class="fb" href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        <a class="signin-button" href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" name="name-comment" class="name-comment" placeholder="<?=Yii::t('yii','placeholder_comment_name')?>">
                    <label  class="error hidden"><?=Yii::t('yii','error_comment_name')?></label>
                </div>
                <div class="form-group">
                    <input type="email" name="email-comment" class="email-comment" placeholder="<?=Yii::t('yii','placeholder_comment_email')?>">
                    <label  class="error hidden"><?=Yii::t('yii','error_comment_email')?></label>
                </div>
                <div class="form-group">
                    <input type="text" name="who-comment" class="who-comment" placeholder="<?=Yii::t('yii','placeholder_comment_who')?>">
                </div>
                <div class="form-group button-buy-wrapper">
                    <input type="hidden" value="<?=$this->params['val']?>" name="page-id" >
                    <input type="hidden" value="0" name="parent-id" id="parent-id">
                    <button type="submit" name="comment-submit" ><?=Yii::t('yii','send')?></button>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>

function validateBase($form){
    var ret = true;
    var $name = $form.find('.name-comment');
    var $email = $form.find('.email-comment');
    var $comment = $form.find('.comment-comment')
    
    if ($name.val().length < 3){
        $name.addClass('error');
        $name.next().removeClass('hidden');
        ret = false;
    } else {
        $name.removeClass('error');
        $name.next().addClass('hidden');
    }
    if (!validateEmail($email.val())){
        $email.addClass('error');
        $email.next().removeClass('hidden');
        ret = false;
    } else{
        $email.removeClass('error');
        $email.next().addClass('hidden');
    }
    if ($comment.val().length < 25){
        $comment.addClass('error');
        $comment.next().removeClass('hidden');
        ret = false;
    } else {
        $comment.removeClass('error');
        $comment.next().addClass('hidden');
    }
    
    if ($form.find(".select-box").length > 0){
        if (!$("input[name='box-input']:checked").val()) {
            $form.find('.select-box label').removeClass('hidden');
            ret = false;
        }
        else {
            $form.find('.select-box label.error').addClass('hidden');
        }
    }
    
    if (!imageTrue) ret = false;

    return ret;
}
var imageTrue = true;
function validateImage(width, height, size, id){
    var ret = true;
    if(width > 100 || height > 100 || size > 100000){
        $('#preview' + id).parent().next().removeClass('hidden');
        return false;
    }
    else{
        $('#preview' + id).parent().next().addClass('hidden');
    }
    return ret;
}
function validateChild($form){
    var ret = true;
    var $name = $form.find('.name-comment');
    var $email = $form.find('.email-comment');
    var $comment = $form.find('.comment-comment')
    
    if ($name.val().length < 3){
        $name.addClass('error');
        $name.next().removeClass('hidden');
        ret = false;
    } else {
        $name.removeClass('error');
        $name.next().addClass('hidden');
    }
    if (!validateEmail($email.val())){
        $email.addClass('error');
        $email.next().removeClass('hidden');
        ret = false;
    } else{
        $email.removeClass('error');
        $email.next().addClass('hidden');
    }
    if ($comment.val().length < 25){
        $comment.addClass('error');
        $comment.next().removeClass('hidden');
        ret = false;
    } else {
        $comment.removeClass('error');
        $comment.next().addClass('hidden');
    }
    
    if ($form.find(".select-box").length > 0){
        if (!$("input[name='box-input']:checked").val()) {
            $form.find('.select-box label').removeClass('hidden');
            ret = false;
        }
        else {
            $form.find('.select-box label.error').addClass('hidden');
        }
    }
    
    if (!imageTrue) ret = false;
    return ret;
}
$('.comment-form').delegate('.toggled', 'click', function(e){
    
   $(this).removeClass('toggled'); 
});
$('.comment-form').on('submit', function(e){
    e.preventDefault();
    
    var $form = $(this);
    // if (formTrigger !== undefined){
    //     if (formTrigger == 2)
    //         $form = $(("#comment-form" + formTrigger));
    // }
    var available = false;
    if ($('#comment-form').find('input[name=parent-id]').val() == 0){
       available = validateBase($form);
    } else {
        available = validateChild($form);
    }
    
    if (available == true)
    $.ajax({
        type: "POST",
        url: "<?= Url::to(['site/log']); ?>",
        dataType: "JSON",
        processData: false,
        contentType: false,
        data: new FormData( this ),
        error: function(response){
        //    console.log(response + "error");
            $('#good-comment').css('display', 'block').animate({
                opacity: 1
            },250);
        },
        success: function(response) {
          //  console.log(response);
            $('#good-comment').css('display', 'block').animate({
                opacity: 1
            },250);
        }
    });
});
$('.comment-form .nav-tab span').on('click', function(e){
   $(this).find('input[type=radio]').prop('checked', true); 
});
    $('.write-comment').on('click', function(e){
           e.preventDefault();
           $('html, body').addClass('no-scroll');
           $('#comment-modal-form').css('display', 'block').animate({
           opacity: 1
       });
       });
       
     document.getElementById("ava-file").onchange = function () {
    var reader = new FileReader();
    reader.onload = function (e) {
        // get loaded data and render thumbnail.
        var image = document.getElementById("preview");
        image.src = e.target.result;
        $('#image-src').attr('src', e.target.result);
        var size = document.getElementById("ava-file").files[0].size;
            image.onload = function() {
               imageTrue = validateImage(this.width, this.height, size, "");
            }
    };
    reader.readAsDataURL(this.files[0]);
};

       document.getElementById("ava-file2").onchange = function () {
    var reader = new FileReader();
    reader.onload = function (e) {
        // get loaded data and render thumbnail.
        var image = document.getElementById("preview2");
        var size = document.getElementById("ava-file2").files[0].size;
        image.src = e.target.result;
        $('#image-src2').attr('src', e.target.result);
        console.log(size)
            image.onload = function() {
               imageTrue = validateImage(this.width, this.height, size, 2);
            }
    };

    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
};
    
</script>