<?php
use yii\helpers\Url;
?>
    <form id="upload-form" method="POST" class="workground" enctype="multipart/form-data">
        <div class="form-group image-group">
            <div class="image-preview">
                <input type="file" name="files[]" id="files" multiple />
            </div>
        </div>
        <div class="form-group">
            <input type="submit" value="Завантажити">
        </div>
        <span class="small-title">Попередній перегляд:</span>
        <div class="form-group preview-group" id="preview-container"></div>
        <div class="form-group clearfix"></div>
        
        <span class="small-title">Наявні зображення:</span>
        <div class="form-group preview-group flexbox-pre">
            <?php foreach ($images as $image) { $prefix="/img/" ?>
                <div class="block-p">
                    <img src="<?=$prefix.$image?>">
                    <span><?=$image?></span>
                </div>
            <?php } ?>
        </div>
        <div class="form-group clearfix"></div>
    </form>
<script>
    $('#upload-form').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "<?= Url::to(['admin/uploadimages']); ?>",
            dataType: "JSON",
            processData: false,
            contentType: false,
            data: new FormData( this ),
            error: function(response){
                console.log(response);
            },
            success: function(response) {
                console.log(response);
            }
        });
    });
    
    document.getElementById("files").onchange = function () {
        var files = document.getElementById("files").files;
    
        var i = 0;
        for (file of files){
            var reader = new FileReader();
            reader.onload = function (e) {
            // get loaded data and render thumbnail.
                var image = document.createElement("img");
                image.src = e.target.result;
                document.getElementById("preview-container").appendChild(image);
            };
            reader.readAsDataURL(this.files[i]);
            i++;
        }
    };
</script>