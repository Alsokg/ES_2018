<?php
use yii\helpers\Url;
$langs = $this->params['langs'];

?>
<form class="workground main-one-form">
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
<form class="workground main-two-form">
  <span class="title">Сторінка Головна: плюсики та теми</span>
  <div class="tab-widget">
    <?php foreach ($langs as $lang) { ?>
      <?php if ($lang == 'uk') { ?>
        <span class="tab selected"><?=$lang?></span>
        <div class="active form-group">
      <?php } else { ?>
        <span class="tab"><?=$lang?></span>
        <div class="form-group">
      <?php } ?>
        <label for="two_title_<?=$lang?>">Заголовок Плюсики</label>
        <input type="text" id="two_title_<?=$lang?>" name="two_title_<?=$lang?>" value='<?=$Page['two_title_'.$lang]?>'/>
        <label for="fone_title_<?=$lang?>">Заголовок Теми</label>
        <input type="text" id="fone_title_<?=$lang?>" name="fone_title_<?=$lang?>" value='<?=$Page['fone_title_'.$lang]?>'/>
      </div>  
    <?php } ?>
  </div>
  <div class="from-group clearfix">
    <input type="submit" value="Оновити" />
  </div>
</form>
<form class="workground main-two-form">
  <span class="title">Сторінка Головна: плюсики та теми</span>
  <div class="tab-widget">
    <?php foreach ($langs as $lang) { ?>
      <?php if ($lang == 'uk') { ?>
        <span class="tab selected"><?=$lang?></span>
        <div class="active form-group">
      <?php } else { ?>
        <span class="tab"><?=$lang?></span>
        <div class="form-group">
      <?php } ?>
        <label for="two_title_<?=$lang?>">Заголовок Плюсики</label>
        <input type="text" id="two_title_<?=$lang?>" name="two_title_<?=$lang?>" value='<?=$Page['two_title_'.$lang]?>'/>
        <label for="fone_title_<?=$lang?>">Заголовок Теми</label>
        <input type="text" id="fone_title_<?=$lang?>" name="fone_title_<?=$lang?>" value='<?=$Page['fone_title_'.$lang]?>'/>
      </div>  
    <?php } ?>
  </div>
  <div class="from-group clearfix">
    <input type="submit" value="Оновити" />
  </div>
</form>
<form class="workground main-three-form">
  <span class="title">Сторінка Головна: Товари</span>
  <div class="tab-widget">
    <?php foreach ($langs as $lang) { ?>
      <?php if ($lang == 'uk') { ?>
        <span class="tab selected"><?=$lang?></span>
        <div class="active form-group">
      <?php } else { ?>
        <span class="tab"><?=$lang?></span>
        <div class="form-group">
      <?php } ?>
        <label for="products_title_<?=$lang?>">Заголовок</label>
        <input type="text" id="products_title_<?=$lang?>" name="products_title_<?=$lang?>" value='<?=$Page['products_title_'.$lang]?>'/>
        <label for="products_notice_<?=$lang?>">Уточнення</label>
        <input type="text" id="products_notice_<?=$lang?>" name="products_notice_<?=$lang?>" value='<?=$Page['products_notice_'.$lang]?>'/>
      </div>  
    <?php } ?>
  </div>
  <div class="from-group clearfix">
    <input type="submit" value="Оновити" />
  </div>
</form>
<form class="workground main-seo-form">
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
        <label for="site_title_<?=$lang?>">Заголовок SEO</label>
        <input type="text" id="site_title_<?=$lang?>" name="site_title_<?=$lang?>" value='<?=$Page['site_title_'.$lang]?>'/>
        <label for="site_description_<?=$lang?>">Опис SEO</label>
        <textarea type="text" id="site_description_<?=$lang?>" name="site_description_<?=$lang?>"><?=$Page['site_description_'.$lang]?></textarea>
      </div>  
    <?php } ?>
  </div>
  <div class="from-group clearfix">
    <input type="submit" value="Оновити" />
  </div>
</form>
<script>
$(document).ready(function(){
  ajaxSend("<?= Url::to(['admin/updateonemain']); ?>", ".main-one-form");
ajaxSend("<?= Url::to(['admin/updatetwomain']); ?>", ".main-two-form");
ajaxSend("<?= Url::to(['admin/updatethreemain']); ?>", ".main-three-form");
  ajaxSend("<?= Url::to(['admin/updateseomain']); ?>", ".main-seo-form");
});
</script>