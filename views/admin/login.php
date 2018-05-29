<?php
   use yii\helpers\Url;
?>
<div class="login-form">
   <div class="aligner-mid">
      <div class="label-login">Вхід</div>
      <form id="login" method = "post">
         <input type="text" name="username" class="box" placeholder="Імя"/>
         <input type="password" name="password" class="box" placeholder="Пароль"/>
         <label class="error-form">Невірний логін або пароль</label>
         <input type="submit" value="Увійти"/>
      </form>
   </div>
</div>
<script>
   $('#login').on('submit', function(e){
    e.preventDefault();
    
    var $form = $(this);

    $.ajax({
        type: "POST",
        url: "<?= Url::to(['admin/login']); ?>",
        dataType: "JSON",
        data: $form.serialize(),
        error: function(response){
            if (response['error'] == 'failed'){
                console.log(response['error']);
               return false;
            } else {
               location.href = "products";
            }
        },
        success: function(response) {
            if (response['error'] == 'failed'){
                $('.error-form').css('display', 'none');
               return false;
            } else {
               location.href = "products";
            }
        }
    });
});
</script>
