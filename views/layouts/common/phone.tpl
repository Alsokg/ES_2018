                    <form id="callback-form" method="POST" action="">
                    <input id="phone-input" type="text" name="phone-input" value="" placeholder="+380 (__) ___-__-__" data-valid="true">
                    <div class="button-buy-wrapper">
                        <input type="submit" class="push-wide" id="phone-send" value="<?= Yii::t('yii', 'Order') ?>">
                    </div>    
                     <label for="phone" style="display: block; visibility: hidden;" 
                        data-good="<?= Yii::t('yii', 'We will call you soon') ?>" data-bad="<?= Yii::t('yii', 'invalid format') ?>"><?= Yii::t('yii', 'invalid format') ?></label>
                </form>
    <script>
    $(document).ready(function(){
    
    $("#callback-form").on('submit', function(e){
       e.preventDefault();
       $label = $(this).find('label');
       if ($('#phone-input').attr('data-valid') == 'false'){
           $label.css('visibility', 'visible').text($label.attr('data-bad')).addClass('bad').removeClass('good');
           return;
       } else{
        $.ajax({
            type: 'post',
            url: 'https://englishstudent.net/mail/sendPhone.php',
            data: $('#callback-form').serialize(),
            success: function (response) {
                console.log(response);
                //work
                $label.css('visibility', 'visible').text($label.attr('data-good')).addClass('good').removeClass('bad');
            }
          });
       }
       return false;
    });
});
</script>