<?php
use yii\helpers\Url;
?>
<?php foreach ($sales as $sale) {?>
    <form class="block workground sales-form">
        <span class="title">Акція <?=$sale->for_page?></span>

        <div class="tab-widget">
            <span class="tab selected">UK</span>
            <div class="active form-group">
                <label for="title_uk">Промо</label>
                <input type="text" name="title_uk" value='<?=$sale->title_uk?>'/>
            </div>    
            <span class="tab">RU</span>
            <div class="form-group">
                <label for="title_ru">Промо</label>
                <input type="text" name="title_ru" value='<?=$sale->title_ru?>'/>
            </div>    
            <span class="tab">EN</span>
            <div class="form-group">
                <label for="title_en">Промо</label>
                <input type="text" name="title_en" value='<?=$sale->title_en?>'/>
            </div>    
        </div>
        <input name="id" type="hidden" value="<?=$sale->id?>">
        <div class="form-group">
            <label for="active<?=$sale->id?>">Показувати на сторінці:</label>
            <?php if ($sale->active == 1) { ?>
                <input name="active" id="active<?=$sale->id?>" type="checkbox" checked>
            <?php } else { ?>
                <input name="active" id="active<?=$sale->id?>" type="checkbox">
            <?php } ?>
        </div>
        <div class="form-group">
             <label for="page<?=$sale->id?>">Для сторінки(1-Головна, 3-Діти)</label>
             <input type="number" name="page" id="page<?=$sale->id?>" value="<?=$sale->for_page?>">
        </div>
        <div class="form-group">
             <label for="discount<?=$sale->id?>">Знижка для покупців:</label>
             <input type="number" name="discount" id="discount<?=$sale->id?>" value="<?=$sale->discount?>">
        </div>
        <div class="form-group">
             <label for="discount-number<?=$sale->id?>">Кількість продуктів, для знижки:</label>
             <input type="number" name="discount-number" id="discount-number<?=$sale->id?>" value="<?=$sale->products_for_discount?>">
        </div>
        <div class="form-group">
            <input type="submit" value="Оновити">
        </div>
    </form>
<?php } ?>
<script>

$(document).ready(function(){
    
    var message = new Messages();
    $('.sales-form').on('submit', function(e){
        e.preventDefault();
        var $form = $(this);
        $.ajax({
            type: "POST",
            url: "<?= Url::to(['admin/updatesales']); ?>",
            dataType: "JSON",
            data: $form.serialize(),
            error: function(response){
                console.log(response);
            },
            success: function(response) {
                console.log(response);
                if (response['error']){
                    message.addMessage(response['error'], 'error');
                }
                if (response['success']){
                    message.addMessage(response['success'], 'success');
                }
            }
        });
    });
});
</script>