        <?php if ($comments) {?>
        <div class="screen screen-comments screen-title">
            <div class="circle circle-big">
                <div class="circle circle-small"></div>
            </div>
            <p class="bold"><?=Yii::t('yii', 'title_comments')?></p>
            <div class="separator"></div>
            <div class="carousel">
                <?php $i = 0; foreach ($comments as $comment) { $i++;?>
                    <div class="item <?php if($i==3) echo " active"; ?>" data-id="<?=$i?>">
                        <div class="content">
                            <img src="<?=$comment['img_src']?>" alt="<?=$comment['img_src']?>">
                        </div>
                        <div class="text-carousel">
                            <div class="header">
                                <div class="rating">
                                    <?php for ($l = 1; $l <= 5; $l++) { ?>
                                        <?php if ($comment['rating'] < $l) { ?>
                                            <i class="fa fa-star"></i>
                                        <?php } else { ?>
                                            <i class="fa fa-star active"></i>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                                <span class="line-v"> | </span>
                                <div class="add-info">
                                    <span><?=$comment['time']['day'].", ".Yii::t('yii', 'm'.$comment['time']['month'])." ".$comment['time']['year']?></span>
                                </div>
                            </div>
                            <p class="ellipsis height-fix"><?=$comment['full_text']?></p>
                            <a class="show-full blue-text-btn" data-id="<?=$i?>" href="#"> <?=Yii::t('yii','more')?></a>
                            <p class="author"><?=$comment['name']?></p>
                            <?php if ($comment['who']) { ?>
                                <p class="who"> <span>&#8212;</span> <?=$comment['who']?></p>
                            <?php } ?>
                        </div>
                    </div>
                <?php }?>
            </div>
            <div class="bottom-btns">
                <div class="laodComments blue-text-btn">
                    <a href="#" class="show-all"><?=Yii::t('yii', 'All comments') . " " . $countReviews;?></a>
                </div>
                <div class="write-comment-btn blue-text-btn">
                    <a href="#" class="write-comment"><?=Yii::t('yii','leave comment')?></a>
                </div>
            </div>
            <?php include('comment.php'); ?>
        </div>
        <?=$formComment;?>
        <?php include('good-comment.tpl');?>
        <?php } ?>