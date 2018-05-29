<?php


$this->title = 'Contacts';
?>
<div class="site-wrapper">
    <div class="header-contacts">
        <div class="slogan">
            <span><?=Yii::t('yii', 'Ready to meet with you')?></span>
        </div>
        <div class="contact-info">
            <span class="title"><?=Yii::t('yii','Visit us:')?></span>
            <span class="sub-info"><?=$address?></span>
        </div>
        <div class="contact-info">
            <span class="title"><?=Yii::t('yii','Call to:')?></span>
            <span class="sub-info phones">
                <?php foreach ($this->params['phones'] as $phone) {
                    echo $phone . "<br>";
                } ?>
            </span>
        </div>
        <div class="contact-info">
            <span class="title"><?=Yii::t('yii', 'Write us:')?></span>
            <span class="sub-info"><?=$this->params['email']?></span>
        </div>
    </div>
    <div class="map">
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d643.2690615261679!2d24.022815329241368!3d49.84102486360501!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x473add7183d01c05%3A0x7caf1c152ef66c60!2z0LLRg9C70LjRhtGPINCi0LDQtNC10YPRiNCwINCa0L7RgdGC0Y7RiNC60LAsIDE4LCDQm9GM0LLRltCyLCDQm9GM0LLRltCy0YHRjNC60LAg0L7QsdC70LDRgdGC0YwsIDc5MDAw!5e0!3m2!1suk!2sua!4v1514332052513" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>        
<script>
            $('.map').click(function(){
			$(this).find('iframe').addClass('clicked')}).mouseleave(function(){
			$(this).find('iframe').removeClass('clicked')});
        </script>
    </div>
</div>