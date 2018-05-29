<div class="order-modal" id="comment-modal">
    <div class="modal-content">
        <div class="scrolable">
            <div class="close-icon" id="close-comment-modal">
                <div class="close-line"></div>
                <div class="close-line"></div>
            </div>
            <div class="comments-modal">
                <?php $i = 0; foreach ($comments as $comment) { $i++;?>
                    <div class="comment-full-wrapper" data-id="<?=$i?>">
                        <div class="ava-wrapper">
                            <img src="<?=$comment['img_src']?>">
                        </div>
                        <div class="comment-text">
                            <p><?=$comment['full_text']?></p>
                        </div>
                    </div>
                <?php }?>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
           $('.show-full').on('click', function(e){
       e.preventDefault();
       $('#comment-modal').css('display', 'block').animate({
           opacity: 1
       });
       $('html, body').addClass('no-scroll');
       
    });
    });
</script>
