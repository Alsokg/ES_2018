<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;
?>

<div class="workground">
    <div class="table">
    <div class="preview-comment clerafix title-preview">
        <div class="id">id</div>
        <div class="main-page">in5</div>
        <div class="name">імя</div>
        <div class="text">Коментар</div>
        <div class="email">email</div>
        <div class="who">Хто</div>
        <div class="controls">Управління</div>
    </div>
<?php foreach ($models as $model) { 
    if ($model->viewed == 1)
        $class="new";
        else
        $class="";
        $i = 0;
?>
    <div class="preview-comment clearfix <?=$class?>" id="id<?=$model->id;?>">
        <div class="id"><?=$model->id?></div>
        <div class="main-page"><?=$model->featured?></div>
        <div class="name"><?=$model->name?></div>
        <div class="text"><?=$model->text?></div>
        <div class="email"><?=$model->email?></div>
        <div class="who"><?=$model->who?></div>
        <div class="hidden-ajax publish"><?=$model->publish?></div>
        <div class="hidden-ajax img-src"><?=$model->img_src?></div>
        <div class="hidden-ajax rating"><?=$model->rating?></div>
        <div class="hidden-ajax product-id"><?=$products[$i]['id']?></div>
        <div class="hidden-ajax product-name"><?=$products[$i]['name']?></div>
        <div class="controls">
            <i class="fa fa-pencil-square edit" aria-hidden="true"></i>
            <i class="fa fa-trash delete" aria-hidden="true"></i>
        </div>
    </div>
<?php $i++;} ?>
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
    <div class="title">Видалення Коментаря</div>
    <div class="text"></div>
    <form id="delete-comment">
        <input type="hidden" name="id" id="comment-id" value="">
        <div class="form-group accept-group">
            <input type="submit" value="Видалити">
            <input type="reset" value="Відмінити">
        </div>
    </form>
</div>
</div>
<div class="overlay workground overlay-edit">
    <div class="modal modal-update">
        <div class="title">Редагування Коментаря <span id="id-title"></span></div>
        <div class="close-edit">
            <i class="fa fa-times"></i>
        </div>
        <form id="edit-comment">
            <input type="hidden" id="update-id" name="id" value="">
            <div class="form-group">
                <label for="featured">Показувати на головній: </label>
                <input type="checkbox" name="featured" id="featured">
            </div>
            <div class="form-group">
                <label for="name">Імя Автора</label>
                <input type="text" name="name" id="name" value="">
            </div>
            <div class="form-group">
                <label for="comment-text">Коментар</label>
                <textarea name="comment-text" id="comment-text"></textarea> 
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" value="">
            </div>
            <div class="form-group">
                <label for="who">Хто автор?</label>
                <input type="text" name="who" id="who" value="">
            </div>
            <div class="form-group">
                <label for="publish">Показувати в усіх коментарях: </label>
                <input type="checkbox" name="publish" id="publish">
            </div>
            <div class="form-group clearfix">
                <div class="left-group image-group">
                  <img id="img_image_src" src="">
                </div>
                <div class="right-group attr-group">
                  <label for="image_src">Аватарка</label>
                  <input type="text" id="image_src" name="image_src" value=""/>
                </div>
             </div>
            <div class="form-group clearfix">
                <label for="rating">Рейтинг (1-5) </label>
                <input type="number" name="rating" id="rating" min="1" max="5">
            </div>
            <div class="form-group clearfix">
                <label>Відгук для товару: </label>
                <span class="product-name-form"></span>
            </div>
            <div class="form-group">
                <input type="submit" value ="Оновити">
            </div>
        </form>
    </div>
</div>
<script>
$(document).ready(function(){
  ajaxSend("<?= Url::to(['admin/removecomment']); ?>", "#delete-comment");
  ajaxSend("<?= Url::to(['admin/updatecomment']); ?>", "#edit-comment");
});
</script>