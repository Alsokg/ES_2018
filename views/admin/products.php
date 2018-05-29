<?php
use yii\helpers\Url;
$langs = $this->params['langs'];
?>

<?php foreach ($products as $product) { ?>
<?php $id = $product['id']; ?>
  <form class="workground product-form" id="id<?=$id?>">
    <input name="id" type="hidden" class="product-id" value="<?=$id?>">
    <span class="title"><?=$product['name_uk']?></span>
    <div class="tab-widget">
      <span class="tab selected">UK</span>
      <div class="active form-group">
        <label for="title_uk<?=$id?>">Назва товару</label>
        <input type="text" id="title_uk<?=$id?>" name="title_uk" value='<?=$product['name_uk']?>'/>
        <label for="description_uk<?=$id?>">Опис товару</label>
        <textarea type="text" id="description_uk<?=$id?>" name="description_uk"><?=$product['description_uk']?></textarea>
      </div>    
      <span class="tab">RU</span>
      <div class="form-group">
        <label for="title_ru<?=$id?>">Название товарa</label>
        <input type="text" id="title_ru<?=$id?>" name="title_ru" value='<?=$product['name_ru']?>'/>
        <label for="description_ru<?=$id?>">Описание товару</label>
        <textarea type="text" id="description_ru<?=$id?>" name="description_ru"><?=$product['description_ru']?></textarea>
      </div>    
      <span class="tab">EN</span>
      <div class="form-group">
        <label for="title_en<?=$id?>">Product name</label>
        <input type="text" id="title_en<?=$id?>" name="title_en" value='<?=$product['name_en']?>'/>
        <label for="description_en<?=$id?>">Description</label>
        <textarea type="text" id="description_en<?=$id?>" name="description_en"><?=$product['description_en']?></textarea>
      </div>    
    </div>
    <div class="form-group price-wrapper">
      <label for="price<?=$id?>">Ціна:</label>
      <input type="number" id="price<?=$id?>" name="price" value="<?=$product['price']?>"/>
      <label for="old_price<?=$id?>">Ціна перекреслена(0 сховати):</label>
      <input type="number" id="old_price<?=$id?>" name="old_price" value="<?=$product['old_price']?>"/>
    </div>
    <div class="form-group clearfix">
      <div class="left-group image-group">
        <img id="img_src<?=$id?>" src="<?= $url.$product['images'][0]['src'] ?>" alt="<?= $product['images'][0]['alt'] ?>">
      </div>
      <div class="right-group attr-group">
        <label for="src<?=$id?>">Посилання</label>
        <input type="text" id="alt<?=$id?>" name="src" value="<?=$product['images'][0]['src'] ?>"/>
        <label for="alt<?=$id?>">Альтернативний текст</label>
        <input type="text" name="alt" id="alt<?=$id?>" value="<?=$product['images'][0]['alt'] ?>"/>
      </div>
    </div>
    <div class="form-group clearfix accept-group">
          <input type="submit" value="Оновити">
          <div class="delete-product">Видалити</div>
    </div>
  </form>

  <button class="fab fab-balanced add-product"><i class="fa fa-plus"></i></button>

<div class="overlay overlay-create workground overlay-edit" >
  <div class="modal modal-create modal-update">
    <div class="close-edit">
      <i class="fa fa-times"></i>
    </div>
    <div class="title">Створення продукту</div>
    <form class="workground create-form" id="create-product" method="POST" enctype="multipart/form-data">
      <div class="tab-widget">
    <?php foreach ($langs as $lang) { ?>
      <?php if ($lang == 'uk') { ?>
        <span class="tab selected"><?=$lang?></span>
        <div class="active form-group">
      <?php } else { ?>
        <span class="tab"><?=$lang?></span>
        <div class="form-group">
      <?php } ?>
        <label for="title_<?=$lang?>">Назва</label>
        <input type="text" name="title_<?=$lang?>" id="title_<?=$lang?>">
        <label for="description_<?=$lang?>">Опис</label>
        <textarea name="description_<?=$lang?>" id="description_<?=$lang?>"></textarea>
      </div>  
    <?php } ?>  
      </div>
      <div class="form-group price-wrapper">
        <label for="price">Ціна:</label>
        <input type="number" id="price" name="price" value="350"/>
        <label for="old_price">Ціна перекреслена(0 сховати):</label>
        <input type="number" id="old_price" name="old_price" value="400"/>
      </div>
      <div class="form-group clearfix">
        <div class="right-group attr-group">
          <label for="src">Посилання</label>
          <input type="text" id="alt" name="src" value="img/"/>
          <label for="alt">Альтернативний текст</label>
          <input type="text" name="alt" id="alt" value=""/>
        </div>
      </div>
        <div class="form-group accept-group clearfix">
            <input type="submit" value="Створити">
            <input type="reset" value="Відмінити">
        </div>
    </form>
</div>
</div>
<?php } ?>
<div class="overlay overlay-delete">
<div class="modal modal-delete">
    <div class="title">Видалення Продукту</div>
    <div class="text"></div>
    <form id="delete-product">
        <input type="hidden" name="id" id="product-id" value="">
        <div class="form-group accept-group">
            <input type="submit" value="Видалити">
            <input type="reset" value="Відмінити">
        </div>
    </form>
</div>
</div>
<script>
$(document).ready(function(){
  ajaxSend("<?= Url::to(['admin/updateproduct']); ?>", ".product-form");
  ajaxSend("<?= Url::to(['admin/createproduct']); ?>", ".create-form");
  ajaxSend("<?= Url::to(['admin/removeproduct']); ?>", "#delete-product");
  $('.add-product').on('click', function(){
    showModal($('.overlay-create'));
  });
  $('.modal-create .close-edit').on('click', function(){
    hideModal($(this).parent().parent());
  });
  $('.create-form').on('reset', function(){
     $('.modal-create .close-edit').trigger('click');
  });
});
</script>

