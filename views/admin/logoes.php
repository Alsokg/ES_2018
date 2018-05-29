<?php
use yii\helpers\Url;
$langs = $this->params['langs'];
?>
    <form class="workground logo-form-create" id="id0">
        <span class="title">Додати партнера</span>
        <div class="form-group clearfix">
          <div class="left-group image-group">
            <img id="img_src" src="" alt="">
          </div>
          <div class="right-group attr-group">
            <label for="src">Посилання</label>
            <input type="text" id="src" name="src" value="/img/"/>
            <label for="alt">Альтернативний текст</label>
            <input type="text" name="alt" id="alt" value=""/>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="">
          </div>
        </div>
        <div class="form-group clearfix accept-group">
          <input type="submit" value="Додати">
          <input class="reset-add" type="reset" value="Очистити">
        </div>
      </form>
<?php foreach ($logoes as $logo) { ?>
    <form class="workground logo-form" id="id<?=$logo->id?>">
        <input name="id" class="logo-id" type="hidden" value="<?=$logo->id?>">
        <div class="form-group clearfix">
          <div class="left-group image-group">
            <img id="img_src<?=$logo->id?>" src="<?= $logo->image ?>" alt="<?= $logo->alt ?>">
          </div>
          <div class="right-group attr-group">
            <label for="src<?=$logo->id?>">Посилання</label>
            <input type="text" id="src<?=$logo->id?>" name="src" value="<?=$logo->image ?>"/>
            <label for="alt<?=$logo->id?>">Альтернативний текст</label>
            <input type="text" name="alt" id="alt<?=$logo->id?>" value="<?=$logo->alt?>"/>
            <label for="title<?=$logo->id?>">Title</label>
            <input type="text" name="title" id="title<?=$logo->id?>" value="<?=$logo->title?>">
          </div>
        </div>
        <div class="form-group clearfix accept-group">
          <input type="submit" value="Оновити">
          <div class="delete-logo">Видалити</div>
        </div>
      </form>
<?php } ?>

<!--<button class="fab fab-balanced add-logo"><i class="fa fa-plus"></i></button>-->

<div class="overlay overlay-delete">
<div class="modal modal-delete">
    <div class="title">Видалення Партнера</div>
    <div class="text"></div>
    <form id="delete-logo">
        <input type="hidden" name="id" id="logo-id" value="">
        <div class="form-group accept-group">
            <input type="submit" value="Видалити">
            <input type="reset" value="Відмінити">
        </div>
    </form>
</div>
</div>
<script>
$(document).ready(function(){
  ajaxSend("<?= Url::to(['admin/updatelogo']); ?>", ".logo-form");
    ajaxSend("<?= Url::to(['admin/createlogo']); ?>", ".logo-form-create");
ajaxSend("<?= Url::to(['admin/removelogo']); ?>", "#delete-logo");
});
</script>