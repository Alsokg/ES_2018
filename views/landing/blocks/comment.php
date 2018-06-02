<div class="order-modal" id="comment-modal">
    <div class="modal-content">
        <div class="scrolable">
            <p><?=Yii::t('yii', 'title_comments')?></p>
            <div class="separator"></div>
            <div class="close-icon" id="close-comment-modal">
                <div class="close-line"></div>
                <div class="close-line"></div>
            </div>
            <form id="comment-form-2" method="POST" class="comment-form" enctype="multipart/form-data">
                <div class="form-aligner toggled dropdown-selector">
                    <div class="comment-view-wrapper flexbox">
                        <div class="form-group image-group">
                            <div class="image-preview">
                                <input type="file" name="ava-file" id="ava-file2" />
                                <img id="preview2" src="placeholder.png" alt="placeholder.png"/>
                                <input type="hidden" name="image-src" id="image-src2" value="placeholder.png">
                            </div>
                            <label for="ava-file2" class="error hidden"><?=Yii::t('yii','error_comment_image')?></label>
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
                            <p class="gray-color"><?=Yii::t('yii','or')?></p>
                            <span><?=Yii::t('yii', 'login with')?> </span>
                            <a class="fb" href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            <a class="signin-button" href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" name="name-comment" class="name-comment"  placeholder="<?=Yii::t('yii','placeholder_comment_name')?>">
                        <label class="error hidden"><?=Yii::t('yii','error_comment_name')?></label>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email-comment" class="email-comment"  placeholder="<?=Yii::t('yii','placeholder_comment_email')?>">
                        <label class="error hidden"><?=Yii::t('yii','error_comment_email')?></label>
                    </div>
                    <div class="form-group">
                        <input type="text" name="who-comment" class="who-comment"  placeholder="<?=Yii::t('yii','placeholder_comment_who')?>">
                    </div>
                    <div class="form-group button-buy-wrapper">
                        <input type="hidden" value="<?=$this->params['val']?>" name="page-id" >
                        <input type="hidden" value="0" name="parent-id" >
                        <input type="hidden" value="placeholder.png" name="image-src">
                        <button type="submit" name="comment-submit"><?=Yii::t('yii','send')?></button>
                    </div>
                </div>
            </form>
            <?php if (isset($allComments)) { ?> 
            <div class="comments-modal">
                <?php $i = 0; foreach ($allComments as $comment) { $i++;?>
                    <div class="comment-full-wrapper" data-id="<?=$i?>">
                        <div class="parent flexbox">
                            <div class="ava-wrapper">
                                <img src="<?=$comment['img_src']?>" alt="<?=$comment['img_src']?>">
                            </div>
                            <div class="comment-text">
                                <span class="comment-author"><span class="bold"><?=$comment['name']?>, </span><span class="detail"><?=$comment['who']?></span></span>
                                <div class="rating">
                                    <?php for ($l = 1; $l <= 5; $l++) { ?>
                                        <?php if ($comment['rating'] < $l) { ?>
                                            <i class="fa fa-star"></i>
                                        <?php } else { ?>
                                            <i class="fa fa-star active"></i>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                                <p><?=$comment['text']?></p>
                                <div class="form-controls">
                                    <div class="answer blue-text-btn">
                                        <a href="#" class="reply-btn" data-parent="<?=$comment['id']?>"><i class="fa fa-reply" aria-hidden="true"></i> <?=Yii::t('yii','reply')?></a> 
                                    </div>
                                    <form id="comment-review-<?=$comment['id']?>" class="comment-review" method="POST" data-info="<?=$comment['id']?>">
                                        <p class="yes-no"><?=Yii::t('yii', 'usefull?')?></p>
                                        <div class="good">
                                            <label class="blue-text-btn">
                                                <input type="hidden" name="good-<?=$comment['id']?>" id ="good-<?=$comment['id']?>" value = "0">
                                                <?=Yii::t('yii', 'good')?>(<span class="sp-pos"><?=$comment['positive']?></span>)
                                            </label>
                                        </div>
                                        <div class="bad">
                                            <label class="blue-text-btn">
                                                <input type="hidden" name="bad-<?=$comment['id']?>" id ="bad-<?=$comment['id']?>" value="0">
                                                <span class="space"></span><?=Yii::t('yii', 'bad')?>(<span class="sp-neg"><?=($comment['total_reviews'] - $comment['positive'])?></span>)
                                            </label>
                                        </div>
                                    </form>
                                </div>
                                <form id="comment-form<?=$comment['id']?>" method="POST" class="comment-form" enctype="multipart/form-data">
                                    <div class="toggled-full dropdown-selector-full">
                                        <div class="form-group">
                                            <textarea rows="4" name="comment-comment" class="comment-comment" placeholder="<?=Yii::t('yii','placeholder_comment_comment')?>"></textarea>
                                            <label class="error hidden"><?=Yii::t('yii','error_comment_comment')?></label>
                                        </div>
                                        <div class="form-group">
                                            <div class="social-login-btns">
                                                <p class="gray-color"><?=Yii::t('yii','or')?></p>
                                                <span><?=Yii::t('yii', 'login with')?> </span>
                                                <a class="fb" href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                                <a class="signin-button" href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="name-comment" class="name-comment"  placeholder="<?=Yii::t('yii','placeholder_comment_name')?>">
                                            <label class="error hidden"><?=Yii::t('yii','error_comment_name')?></label>
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="email-comment" class="email-comment"  placeholder="<?=Yii::t('yii','placeholder_comment_email')?>">
                                            <label class="error hidden"><?=Yii::t('yii','error_comment_email')?></label>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="who-comment" class="who-comment"  placeholder="<?=Yii::t('yii','placeholder_comment_who')?>">
                                        </div>
                                        <div class="form-group button-buy-wrapper">
                                            <input type="hidden" value="<?=$this->params['val']?>" name="page-id" >
                                            <input type="hidden" value="<?=$comment['id']?>" name="parent-id" >
                                            <input type="hidden" value="placeholder.png" name="image-src">
                                            <button type="submit" name="comment-submit"><?=Yii::t('yii','send')?></button>
                                        </div>
                                    </div>
                                </form>
                                <?php if (array_key_exists('childs', $comment)) { ?>
                                    <?php foreach ($comment['childs'] as $child) { ?>
                                        <div class="parent flexbox">
                                            <div class="ava-wrapper">
                                                <img src="<?=$child['img_src']?>" alt="<?=$child['img_src']?>">
                                            </div>
                                            <div class="comment-text">
                                                <span class="comment-author"><span class="bold"><?=$child['name']?>, </span><span class="detail"><?=$child['who']?></span></span>
                                                <div class="rating">
                                                    <?php for ($l = 1; $l <= 5; $l++) { ?>
                                                        <?php if ($child['rating'] < $l) { ?>
                                                            <i class="fa fa-star"></i>
                                                        <?php } else { ?>
                                                            <i class="fa fa-star active"></i>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </div>
                                                <p><?=$child['text']?></p>
                                                <div class="form-controls">
                                                    <div class="answer blue-text-btn">
                                                        <a href="#" class="reply-btn" data-parent="<?=$comment['id']?>"><i class="fa fa-reply" aria-hidden="true"></i> <?=Yii::t('yii','reply')?></a> 
                                                    </div>
                                                    <form id="comment-review-<?=$child['id']?>" class="comment-review" method="POST" data-info="<?=$child['id']?>">
                                                        <p class="yes-no"><?=Yii::t('yii', 'usefull?')?></p>
                                                        <div class="good">
                                                            <label class="blue-text-btn">
                                                            <input type="hidden" name="good-<?=$child['id']?>" id ="good-<?=$child['id']?>" value = "0">
                                                            <?=Yii::t('yii', 'good')?>(<span class="sp-pos"><?=$child['positive']?></span>)
                                                            </label>
                                                        </div>
                                                        <div class="bad">
                                                            <label class="blue-text-btn">
                                                                <input type="hidden" name="bad-<?=$child['id']?>" id ="bad-<?=$child['id']?>" value="0">
                                                                <span class="space"></span><?=Yii::t('yii', 'bad')?>(<span class="sp-neg"><?=($child['total_reviews'] - $child['positive'])?></span>)
                                                            </label>
                                                        </div>
                                                    </form>
                                                </div>
                                                <form id="comment-form<?=$child['id']?>" method="POST" class="comment-form" enctype="multipart/form-data">
                                                    <div class="toggled-full dropdown-selector-full">
                                                        <div class="form-group">
                                                            <textarea rows="4" name="comment-comment" class="comment-comment" placeholder="<?=Yii::t('yii','placeholder_comment_comment')?>"></textarea>
                                                            <label  class="error hidden"><?=Yii::t('yii','error_comment_comment')?></label>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="social-login-btns">
                                                                <p class="gray-color"><?=Yii::t('yii','or')?></p>
                                                                <span><?=Yii::t('yii', 'login with')?> </span>
                                                                <a class="fb" href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                                                <a class="signin-button" href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" name="name-comment" class="name-comment"  placeholder="<?=Yii::t('yii','placeholder_comment_name')?>">
                                                            <label  class="error hidden"><?=Yii::t('yii','error_comment_name')?></label>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="email" name="email-comment" class="email-comment"  placeholder="<?=Yii::t('yii','placeholder_comment_email')?>">
                                                            <label  class="error hidden"><?=Yii::t('yii','error_comment_email')?></label>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" name="who-comment" class="who-comment"  placeholder="<?=Yii::t('yii','placeholder_comment_who')?>">
                                                        </div>
                                                        <div class="form-group button-buy-wrapper">
                                                            <input type="hidden" value="<?=$this->params['val']?>" name="page-id" >
                                                            <input type="hidden" value="<?=$comment['id']?>" name="parent-id" >
                                                            <input type="hidden" value="placeholder.png" name="image-src">
                                                            <button type="submit" name="comment-submit"><?=Yii::t('yii','send')?></button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php }?>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        var baseH = 600;
        function calcH(){
            var w = $(window).width();
           if (w > 768){
               baseH = 600;
           } else if (w > 600){
               baseH = 550;
           } else if (w > 480){
               baseH = 520;
           } else {
               baseH = 490;
           }
        }
        calcH();
        $(window).on('resize', function(){
           calcH();
        });
        $('.reply-btn').on('click', function(e){
           e.preventDefault();
          // $('#parent-id').val($(this).data('parent'));
          $form = $(this).parent().parent().next().find('.dropdown-selector-full');
          $form.toggleClass('toggled-full');
        });
        $('.show-full').on('click', function(e){
            e.preventDefault();
           $(this).prev().toggleClass('ellipsis');
           if (!$(this).prev().hasClass('ellipsis')){
                $(this).animate({
                    marginTop: 0
                }, 100);
           } else {
              $(this).animate({
                    marginTop: "-20px"
                }, 100); 
           }
           var $that = $(this);
           setTimeout(function(){
                var h = $that.prev().height();
                if (!$that.prev().hasClass('ellipsis')){
                    if (h > 150){
                        $('.screen-comments').css('min-height', (baseH+(h-24)) + "px");
                    }
                }else {
                        $('.screen-comments').css('min-height', baseH + "px");
                    }
           }, 100);
           
         //  $('.carousel').css('margin-bottom', 	$('.carousel .active .text-carousel').height() + "px");
        });
    $('.show-all').on('click', function(e){
       e.preventDefault();
       $('#comment-modal').css('display', 'block').animate({
           opacity: 1
       });
       $('html, body').addClass('no-scroll');
       
    });
    
    $('.to-main').on('click', function(e){
        e.preventDefault();
       $(this).parent().parent().prev().trigger('click'); 
    });
    
    $('.good').on('click', function(e){
        e.preventDefault();
        e.stopPropagation();
        var $input = $(this).find('input');
        if ($input.val()!=1){
            var $form = $(this).parent();
            $input.val(1);
            $form.removeClass('bad-trigger').addClass('good-trigger');
        
            setTimeout(function(){
                $form.trigger('submit');
            }, 50);
        } else{
            return false;
        }
    });
    
    $('.bad').on('click', function(e){
        e.preventDefault();
        e.stopPropagation();
        var $input = $(this).find('input');
        if ($input.val()!=1){
            var $form = $(this).parent();
            $input.val(1);
            $form.removeClass('good-trigger').addClass('bad-trigger');
        
            setTimeout(function(){
                $form.trigger('submit');
            }, 50);
        } else{
            return false;
        }
    });
    
    $('.comment-review').on('submit', function(e){
        e.preventDefault();
        e.stopPropagation();
        var $form = $(this);
        var urls = "<?='/' . Yii::$app->language . '/site/'?>";
        if ($(this).hasClass('good-trigger')){
            urls += 'positive/';
            $(this).find('.bad input').val(0);
        } else {
            urls += 'negative/';
            $(this).find('.good input').val(0);
        }
        urls += $(this).attr('data-info');
       $.ajax({
                type: "POST",
                  
                url: urls,
                 dataType: "JSON",
                data: $(this).serialize(),
                error: function(response){
                    console.log("error");
                    console.log(response);
                },
                success: function(response) {
                    
                    $form.find('.sp-pos').empty().text(response[1]);
                    $form.find('.sp-neg').empty().text(response[0] - response[1]);
                }
            }); 
        return false;
    });
    
    });
</script>
