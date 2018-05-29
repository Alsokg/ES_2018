<?php
use yii\helpers\Url;
?>
<form class="workground publisher-form">
  <span class="title">Сторінка Видавництво</span>
  <div class="tab-widget">
    <span class="tab selected">UK</span>
    <div class="active form-group">
      <label for="title_uk">Заголовок</label>
      <input type="text" id="title_uk" name="title_uk" value='<?=$about->title_uk?>'/>
      <label for="description_uk">Опис</label>
      <textarea type="text" id="description_uk" name="content_uk"><?=$about->content_uk?></textarea>
    </div>    
    <span class="tab">RU</span>
    <div class="form-group">
      <label for="title_ru">Заголовок</label>
      <input type="text" id="title_ru" name="title_ru" value='<?=$about->title_ru?>'/>
      <label for="description_ru">Опис</label>
      <textarea type="text" id="description_ru" name="content_ru"><?=$about->content_ru?></textarea>
    </div>    
    <span class="tab">EN</span>
    <div class="form-group">
      <label for="title_en">Заголовок</label>
      <input type="text" id="title_en" name="title_en" value='<?=$about->title_en?>'/>
      <label for="description_en">Опис</label>
      <textarea type="text" id="description_en" name="content_en"><?=$about->content_en?></textarea>
    </div>   
  </div>    
  <div class="form-group clearfix">
    <div class="left-group image-group">
      <img id="img_src" src="<?= substr($about->image,2) ?>">
    </div>
    <div class="right-group attr-group">
      <label for="src">Фонове зображення</label>
      <input type="text" id="src" name="src" value="<?= $about->image ?>"/>
    </div>
  </div>
  <div class="from-group clearfix">
    <input type="submit" value="Оновити" />
  </div>
</form>
<form class="workground publisher-seo-form">
  <span class="title">SEO</span>
  <div class="tab-widget">
    <span class="tab selected">UK</span>
    <div class="active form-group">
      <label for="title_seo_uk">Заголовок SEO</label>
      <input type="text" id="title_seo_uk" name="title_seo_uk" value='<?=$about->title_seo_uk?>'/>
      <label for="description_seo_uk">Опис SEO</label>
      <textarea type="text" id="description_seo_uk" name="description_uk"><?=$about->description_uk?></textarea>
    </div>    
    <span class="tab">RU</span>
    <div class="form-group">
      <label for="title_seo_ru">Заголовок SEO</label>
      <input type="text" id="title_seo_ru" name="title_seo_ru" value='<?=$about->title_seo_ru?>'/>
      <label for="description_seo_ru">Опис SEO</label>
      <textarea type="text" id="description_seo_ru" name="description_ru"><?=$about->description_ru?></textarea>
    </div>    
    <span class="tab">EN</span>
    <div class="form-group">
      <label for="title_seo_en">Заголовок SEO</label>
      <input type="text" id="title_seo_en" name="title_seo_en" value='<?=$about->title_seo_en?>'/>
      <label for="description_seo_en">Опис SEO</label>
      <textarea type="text" id="description_seo_en" name="description_en"><?=$about->description_en?></textarea>
    </div>   
  </div>
  <div class="from-group">
    <input type="submit" value="Оновити" />
  </div>
</form>
<script>
$(document).ready(function(){
  ajaxSend("<?= Url::to(['admin/updatepublisher']); ?>", ".publisher-form");
  ajaxSend("<?= Url::to(['admin/updateseopublisher']); ?>", ".publisher-seo-form");
});
</script>