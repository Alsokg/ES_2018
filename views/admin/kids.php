<?php
use yii\helpers\Url;
$langs = $this->params['langs'];

?>
<form class="workground kids-one-form">
  <span class="title">Сторінка Діти: Блок 1</span>
  <div class="tab-widget">
    <span class="tab selected">UK</span>
    <div class="active form-group">
      <label for="one_title_uk">Заголовок</label>
      <input type="text" id="one_title_uk" name="one_title_uk" value='<?=$page->one_title_uk?>'/>
      <label for="one_description_uk">Опис</label>
      <textarea type="text" id="one_description_uk" name="one_description_uk"><?=$page->one_description_uk?></textarea>
    </div>    
    <span class="tab">RU</span>
    <div class="form-group">
      <label for="one_title_ru">Заголовок</label>
      <input type="text" id="one_title_ru" name="one_title_ru" value='<?=$page->one_title_ru?>'/>
      <label for="one_description_ru">Опис</label>
      <textarea type="text" id="one_description_ru" name="one_description_ru"><?=$page->one_description_ru?></textarea>
    </div>     
    <span class="tab">EN</span>
    <div class="form-group">
      <label for="one_title_en">Заголовок</label>
      <input type="text" id="one_title_en" name="one_title_en" value='<?=$page->one_title_en?>'/>
      <label for="one_description_en">Опис</label>
      <textarea type="text" id="one_description_en" name="one_description_en"><?=$page->one_description_en?></textarea>
    </div>   
  </div>    
  <div class="form-group clearfix">
    <div class="left-group image-group">
      <img id="img_one_src" src="<?='/'.$page->one_bg_image ?>">
    </div>
    <div class="right-group attr-group">
      <label for="one_src">Фонове зображення</label>
      <input type="text" id="one_src" name="one_src" value="<?= $page->one_bg_image ?>"/>
    </div>
  </div>
  <div class="from-group clearfix">
    <input type="submit" value="Оновити" />
  </div>
</form>
<form class="workground kids-two-form">
  <span class="title">Сторінка Діти: Блок плюсики</span>
  <div class="tab-widget">
    <span class="tab selected">UK</span>
    <div class="active form-group">
      <label for="two_title_uk">Заголовок</label>
      <input type="text" id="two_title_uk" name="two_title_uk" value='<?=$page->two_title_uk?>'/>
    </div>    
    <span class="tab">RU</span>
    <div class="form-group">
      <label for="two_title_ru">Заголовок</label>
      <input type="text" id="two_title_ru" name="two_title_ru" value='<?=$page->two_title_ru?>'/>
    </div>     
    <span class="tab">EN</span>
    <div class="form-group">
      <label for="two_title_en">Заголовок</label>
      <input type="text" id="two_title_en" name="two_title_en" value='<?=$page->two_title_en?>'/>
    </div>   
  </div>    
  <div class="form-group clearfix">
    <div class="left-group image-group">
      <img id="img_two_src" src="<?='/'.$page->two_bg_image ?>">
    </div>
    <div class="right-group attr-group">
      <label for="two_src">Фонове зображення</label>
      <input type="text" id="two_src" name="two_src" value="<?= $page->two_bg_image ?>"/>
    </div>
  </div>
  <div class="from-group clearfix">
    <input type="submit" value="Оновити" />
  </div>
</form>
<form class="workground kids-three-form">
  <span class="title">Сторінка Діти: Блок Про картку</span>
  <div class="tab-widget">
    <span class="tab selected">UK</span>
    <div class="active form-group">
      <label for="three_title_uk">Заголовок</label>
      <input type="text" id="three_title_uk" name="three_title_uk" value='<?=$page->three_title_uk?>'/>
      <label for="three_one_uk">Інформація 1</label>
      <input type="text" id="three_one_uk" name="three_one_uk" value='<?=$page->three_one_uk?>'/>
      <label for="three_two_uk">Інформація 2</label>
      <input type="text" id="three_two_uk" name="three_two_uk" value='<?=$page->three_two_uk?>'/>
      <label for="three_three_uk">Інформація 3</label>
      <input type="text" id="three_three_uk" name="three_three_uk" value='<?=$page->three_three_uk?>'/>
      <label for="three_four_uk">Інформація 4</label>
      <input type="text" id="three_four_uk" name="three_four_uk" value='<?=$page->three_four_uk?>'/>
    </div>    
    <span class="tab">RU</span>
    <div class="form-group">
      <label for="three_title_ru">Заголовок</label>
      <input type="text" id="three_title_ru" name="three_title_ru" value='<?=$page->three_title_ru?>'/>
      <label for="three_one_ru">Інформація 1</label>
      <input type="text" id="three_one_ru" name="three_one_ru" value='<?=$page->three_one_ru?>'/>
      <label for="three_two_ru">Інформація 2</label>
      <input type="text" id="three_two_ru" name="three_two_ru" value='<?=$page->three_two_ru?>'/>
      <label for="three_three_ru">Інформація 3</label>
      <input type="text" id="three_three_ru" name="three_three_ru" value='<?=$page->three_three_ru?>'/>
      <label for="three_four_ru">Інформація 4</label>
      <input type="text" id="three_four_ru" name="three_four_ru" value='<?=$page->three_four_ru?>'/>
    </div>     
    <span class="tab">EN</span>
    <div class="form-group">
      <label for="three_title_en">Заголовок</label>
      <input type="text" id="three_title_en" name="three_title_en" value='<?=$page->three_title_en?>'/>
      <label for="three_one_en">Інформація 1</label>
      <input type="text" id="three_one_en" name="three_one_en" value='<?=$page->three_one_en?>'/>
      <label for="three_two_en">Інформація 2</label>
      <input type="text" id="three_two_en" name="three_two_en" value='<?=$page->three_two_en?>'/>
      <label for="three_three_en">Інформація 3</label>
      <input type="text" id="three_three_en" name="three_three_en" value='<?=$page->three_three_en?>'/>
      <label for="three_four_en">Інформація 4</label>
      <input type="text" id="three_four_en" name="three_four_en" value='<?=$page->three_four_en?>'/>
    </div>   
  </div>    
  <div class="from-group clearfix">
    <input type="submit" value="Оновити" />
  </div>
</form>
<form class="workground kids-six-form">
  <span class="title">Сторінка Діти: ілюстрації</span>
  <div class="tab-widget">
    <?php foreach ($langs as $lang) { ?>
      <?php if ($lang == 'uk') { ?>
        <span class="tab selected"><?=$lang?></span>
        <div class="active form-group">
      <?php } else { ?>
        <span class="tab"><?=$lang?></span>
        <div class="form-group">
      <?php } ?>
        <label for="six_title_<?=$lang?>">Заголовок</label>
        <input type="text" id="six_title_<?=$lang?>" name="six_title_<?=$lang?>" value='<?=$Page['six_title_'.$lang]?>'/>
        <label for="six_description_<?=$lang?>">Опис</label>
        <textarea type="text" id="six_description_<?=$lang?>" name="six_description_<?=$lang?>"><?=$Page['six_description_'.$lang]?></textarea>
      </div>  
    <?php } ?>
  </div>
  
  <?php for ($i = 1; $i < 5; $i++) { ?>
    <div class="form-group clearfix">
      <div class="left-group image-group">
        <img id="img_<?=$i?>_src" src="<?='/'.$Page['picture_'.$i] ?>">
      </div>
      <div class="right-group attr-group">
        <label for="picture<?=$i?>_src">Ілюстрація <?=$i?></label>
        <input type="text" id="picture<?=$i?>_src" name="picture<?=$i?>_src" value="<?= $Page['picture_'.$i] ?>"/>
      </div>
    </div>
  <?php } ?>
  <div class="form-group clearfix">
      <div class="left-group image-group">
        <img id="img_main_src" src="<?='/'.$Page['picture_main'] ?>">
      </div>
      <div class="right-group attr-group">
        <label for="picturemain_src">Ілюстрація Головна</label>
        <input type="text" id="picturemain_src" name="picturemain_src" value="<?= $Page['picture_main'] ?>"/>
      </div>
    </div>
  
  <div class="from-group clearfix">
    <input type="submit" value="Оновити" />
  </div>
</form>

<form class="workground kids-seven-form">
  <span class="title">Сторінка Діти: Кроки</span>
  <div class="tab-widget">
    <?php foreach ($langs as $lang) { ?>
      <?php if ($lang == 'uk') { ?>
        <span class="tab selected"><?=$lang?></span>
        <div class="active form-group">
      <?php } else { ?>
        <span class="tab"><?=$lang?></span>
        <div class="form-group">
      <?php } ?>
        <label for="seven_title_<?=$lang?>">Заголовок</label>
        <input type="text" id="seven_title_<?=$lang?>" name="seven_title_<?=$lang?>" value='<?=$Page['seven_title_'.$lang]?>'/>
        <?php for ($i = 1; $i < 4; $i++) { ?>
          <label for="seven_step<?=$i?>_<?=$lang?>">Крок <?=$i?></label>
          <textarea type="text" id="seven_step<?=$i?>_<?=$lang?>" name="seven_step<?=$i?>_<?=$lang?>"><?=$Page['seven_step'.$i.'_'.$lang]?></textarea>
        <?php } ?>
      </div>  
    <?php } ?>
  </div>
  <?php for ($i = 1; $i < 4; $i++) { ?>
    <div class="form-group clearfix">
      <div class="left-group image-group">
        <img id="img_seven_step<?=$i?>_src" src="<?='/'.$Page['seven_step'.$i.'_src'] ?>">
      </div>
      <div class="right-group attr-group">
        <label for="seven_step<?=$i?>_src">Ілюстрація Крок <?=$i?></label>
        <input type="text" id="seven_step<?=$i?>_src" name="seven_step<?=$i?>_src" value="<?= $Page['seven_step'.$i.'_src'] ?>"/>
      </div>
    </div>
  <?php } ?>
  <div class="from-group clearfix">
    <input type="submit" value="Оновити" />
  </div>
</form>

<form class="workground kids-seo-form">
  <span class="title">SEO</span>
  <div class="tab-widget">
    <span class="tab selected">UK</span>
    <div class="active form-group">
      <label for="site_title_uk">Заголовок SEO</label>
      <input type="text" id="site_title_uk" name="site_title_uk" value='<?=$page->site_title_uk?>'/>
      <label for="site_description_uk">Опис SEO</label>
      <textarea type="text" id="site_description_uk" name="site_description_uk"><?=$page->site_description_uk?></textarea>
    </div>    
    <span class="tab">RU</span>
    <div class="form-group">
      <label for="site_title_ru">Заголовок SEO</label>
      <input type="text" id="site_title_ru" name="site_title_ru" value='<?=$page->site_title_ru?>'/>
      <label for="site_description_ru">Опис SEO</label>
      <textarea type="text" id="site_description_ru" name="site_description_ru"><?=$page->site_description_ru?></textarea>
    </div>    
    <span class="tab">EN</span>
    <div class="form-group">
      <label for="site_title_en">Заголовок SEO</label>
      <input type="text" id="site_title_en" name="site_title_en" value='<?=$page->site_title_en?>'/>
      <label for="site_description_en">Опис SEO</label>
      <textarea type="text" id="site_description_en" name="site_description_en"><?=$page->site_description_en?></textarea>
    </div>   
  </div>
  <div class="from-group">
    <input type="submit" value="Оновити" />
  </div>
</form>
<script>
$(document).ready(function(){
  ajaxSend("<?= Url::to(['admin/updateonekids']); ?>", ".kids-one-form");
  ajaxSend("<?= Url::to(['admin/updatetwokids']); ?>", ".kids-two-form");
  ajaxSend("<?= Url::to(['admin/updatethreekids']); ?>", ".kids-three-form");
  ajaxSend("<?= Url::to(['admin/updatesixkids']); ?>", ".kids-six-form");
  ajaxSend("<?= Url::to(['admin/updatesevenkids']); ?>", ".kids-seven-form");
  ajaxSend("<?= Url::to(['admin/updateseokids']); ?>", ".kids-seo-form");
});
</script>