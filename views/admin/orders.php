<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;
?>

<div class="workground">
    <div class="table">
    <div class="preview-comment clerafix title-preview">
        <div class="id">id</div>
        <div class="guid">guid</div>
        <div class="name">імя</div>
        <div class="price">Ціна</div>
        <div class="email">email</div>
        <div class="phone">Телефон</div>
        <div class="date">Дата</div>
        <div class="controls">Управління</div>
    </div>
    <?php if ($models) { ?>
<?php foreach ($models as $model) { 
    if ($model['order']->viewed == 1)
        $class="new";
        else
        $class="";
        $i = 0;
?>
    <div class="preview-comment drop-details clearfix <?=$class?>" id="id<?=$model['order']->id;?>">
        <div class="order-id id"><?=$model['order']->id;?></div>
        <div class="guid"><?=$model['order']->guid?></div>
        <div class="name"><?=$model['order']->name?></div>
        <div class="price"><?=$model['order']->total_price?></div>
        <div class="email"><?=$model['order']->email?></div>
        <div class="phone"><?=$model['order']->phone?></div>
        <div class="date"><?=$model['order']->date?></div>
        <div class="controls">
            <i class="fa fa-chevron-circle-down dropdown-details" aria-hidden="true"></i>
            <i class="fa fa-trash delete-order" aria-hidden="true"></i>
        </div>
    </div>
    <div class="hidden details-wrapper">
        <div class="payment">Оплата: <?=$model['order']->payment?></div>
        <div class="info-wrapper info-header">
            <div class="product-name">Товар</div>
            <div class="price-info">Ціна за одиницю</div>
            <div class="qty">Кількість</div>
        </div>
        <?php foreach ($model['order-info'] as $info) { ?>
            <div class="info-wrapper">
                <div class="product-name"><?=$info['product-name']?></div>
                <div class="price-info"><?=$info['price']?></div>
                <div class="qty"><?=$info['qty_product']?></div>
            </div>
        <?php } ?>
        
    </div>
<?php $i++;} ?>
<?php } ?>
    </div>
        <div class="clearfix"></div>
        <?php
            echo LinkPager::widget([
                'pagination' => $pages,
            ]);
        ?>
    </div>
<div class="clearfix"></div>
<div class="overlay overlay-delete">
<div class="modal modal-delete">
    <div class="title">Видалення Замовлення</div>
    <div class="text"></div>
    <form id="delete-order">
        <input type="hidden" name="id" id="order-id" value="">
        <div class="form-group accept-group">
            <input type="submit" value="Видалити">
            <input type="reset" value="Відмінити">
        </div>
    </form>
</div>
</div>

<script>
$(document).ready(function(){
  ajaxSend("<?= Url::to(['admin/removeorder']); ?>", "#delete-order");
});
</script>