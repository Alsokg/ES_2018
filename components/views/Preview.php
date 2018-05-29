<a href="<?="/".$lang.$data['link']?>" class="preview-wrapper cols-<?=$data['cols']?> <?=$data['template']?>">
    <div class="preview-image">
        <img src="<?=$data['image']?>" alt="<?=$data['text_'.$lang]?>">
    </div>
    <div class="preview-text">
        <?= $data['text_'.$lang] ?>
    </div>
</a>