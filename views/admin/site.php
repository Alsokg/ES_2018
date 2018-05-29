<?php
use yii\helpers\Url;
$langs = $this->params['langs'];
?>
<form class="workground site-form">
  <span class="title">Конткатні дані:</span>
  <div class="tab-widget">
    <?php foreach ($langs as $lang) { ?>
      <?php if ($lang == 'uk') { ?>
        <span class="tab selected"><?=$lang?></span>
        <div class="active form-group">
      <?php } else { ?>
        <span class="tab"><?=$lang?></span>
        <div class="form-group">
      <?php } ?>
        <label for="address_<?=$lang?>">Адреса</label>
        <input type="text" id="address_<?=$lang?>" name="address_<?=$lang?>" value='<?=$Page['address_'.$lang]?>'/>
      </div>  
    <?php } ?>
  </div>
  <div class="form-group clearfix">
    <label for="phone">Телефоны (через кому, без пробілів)</label>
    <input type="text" id="phone" name="phone" value="<?= $page->phone?>"/>
  </div>
  <div class="form-group clearfix">
    <label for="email">Пошта</label>
    <input type="text" id="email" name="email" value="<?= $page->email?>"/>
  </div>
  <div class="from-group clearfix">
    <input type="submit" value="Оновити" />
  </div>
</form>
<script>
$(document).ready(function(){
  ajaxSend("<?= Url::to(['admin/updatesite']); ?>", ".site-form");
});
</script>