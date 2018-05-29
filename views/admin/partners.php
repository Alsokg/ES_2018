<?php
use yii\helpers\Url;
$langs = $this->params['langs'];
?>
<form class="workground partners-one-form">
  <span class="title">Сторінка Головна: Блок 1</span>
  <div class="tab-widget">
    <?php foreach ($langs as $lang) { ?>
      <?php if ($lang == 'uk') { ?>
        <span class="tab selected"><?=$lang?></span>
        <div class="active form-group">
      <?php } else { ?>
        <span class="tab"><?=$lang?></span>
        <div class="form-group">
      <?php } ?>
        <label for="one_title_<?=$lang?>">Заголовок</label>
        <input type="text" id="one_title_<?=$lang?>" name="one_title_<?=$lang?>" value='<?=$Page['one_title_'.$lang]?>'/>
        <label for="one_description_<?=$lang?>">Опис</label>
        <textarea type="text" id="one_description_<?=$lang?>" name="one_description_<?=$lang?>"><?=$Page['one_description_'.$lang]?></textarea>
      </div>  
    <?php } ?>
  </div>
  <div class="form-group clearfix">
    <div class="left-group image-group">
      <img id="img_image_src" src="<?='/'.$page->image ?>">
    </div>
    <div class="right-group attr-group">
      <label for="image_src">Фонове зображення</label>
      <input type="text" id="image_src" name="image_src" value="<?= $page->image ?>"/>
    </div>
  </div>
  <div class="from-group clearfix">
    <input type="submit" value="Оновити" />
  </div>
</form>
<form class="workground partners-who-form">
  <span class="title">З ким працюэмо:</span>
  <div class="tab-widget">
    <?php foreach ($langs as $lang) { ?>
      <?php if ($lang == 'uk') { ?>
        <span class="tab selected"><?=$lang?></span>
        <div class="active form-group">
      <?php } else { ?>
        <span class="tab"><?=$lang?></span>
        <div class="form-group">
      <?php } ?>
        <label for="list_<?=$lang?>">Список партнерів (через кому, без пробілів)</label>
        <textarea type="text" id="list_<?=$lang?>" name="list_<?=$lang?>"><?=$Page['list_'.$lang]?></textarea>
      </div>  
    <?php } ?>
  </div>
  <div class="from-group clearfix">
    <input type="submit" value="Оновити" />
  </div>
</form>
<form class="workground partners-seo-form">
  <span class="title">SEO</span>
  <div class="tab-widget">
    <?php foreach ($langs as $lang) { ?>
      <?php if ($lang == 'uk') { ?>
        <span class="tab selected"><?=$lang?></span>
        <div class="active form-group">
      <?php } else { ?>
        <span class="tab"><?=$lang?></span>
        <div class="form-group">
      <?php } ?>
        <label for="page_title_<?=$lang?>">Заголовок SEO</label>
        <input type="text" id="page_title_<?=$lang?>" name="page_title_<?=$lang?>" value='<?=$Page['page_title_'.$lang]?>'/>
        <label for="page_description_<?=$lang?>">Опис SEO</label>
        <textarea type="text" id="page_description_<?=$lang?>" name="page_description_<?=$lang?>"><?=$Page['page_description_'.$lang]?></textarea>
      </div>  
    <?php } ?>
  </div>
  <div class="from-group clearfix">
    <input type="submit" value="Оновити" />
  </div>
</form>
<script>
$(document).ready(function(){
  ajaxSend("<?= Url::to(['admin/updateonepartners']); ?>", ".partners-one-form");
  ajaxSend("<?= Url::to(['admin/updatewhopartners']); ?>", ".partners-who-form");
  ajaxSend("<?= Url::to(['admin/updateseopartners']); ?>", ".partners-seo-form");
});
</script>