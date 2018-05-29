
   
     <div class="tab-content tab--padding">
        <div class="tab landing-slider">
            <ul class="cb-slider">   
<?php $i=0; foreach ($cards as $card){ ?>
<li class="cards-wrapper">
    <div class="card card--left">
    	<div class="card__header">
    		<span class="card__number"><?php echo $card['number']; ?></span>
    		<span class="card__level"><?php echo $card['level']; ?></span>
    	</div>
    	<div class="card__content" <?php if (isset($card['src'])){?> style="background-image:url(../img/cards-german/<?=$card['src']?>)"<?php } ?>>
    		<?php if ($card['word_1']) { ?>
    			<span class="card__word"><?php echo $card['word_1']; ?></span>
    		<?php } ?>
    		<?php if ($card['word_2']) { ?>
    			<span class="card__word"><?php echo $card['word_2']; ?></span>
    		<?php } ?>
    		<?php if ($card['word_3']) { ?>
    			<span class="card__word"><?php echo $card['word_3']; ?></span>
    		<?php } ?>
    		<?php if ($card['sentence_0']) { ?>
    			<span class="card__sen"><?php echo $card['sentence_0']; ?></span>
    		<?php } ?>	
    		<?php if ($card['sentence']) { ?>
    			<span class="card__sen"><?php echo $card['sentence']; ?></span>
    		<?php } ?>
    	</div>
    </div>
    <div class="card card--right">
    	<div class="card__header">
    		<span class="card__number"><?php echo $card['number']; ?></span>
    		<span class="card__level"><?php echo $card['level_ua']; ?></span>
    	</div>
    	<div class="card__content">
    		<?php if ($card['word_1_ua']) { ?>
    			<span class="card__word"><?php echo $card['word_1_ua']; ?></span>
    		<?php } ?>
    		<?php if ($card['word_2_ua']) { ?>
    			<span class="card__word"><?php echo $card['word_2_ua']; ?></span>
    		<?php } ?>
    		<?php if ($card['word_3_ua']) { ?>
    			<span class="card__word"><?php echo $card['word_3_ua']; ?></span>
    		<?php } ?>
    		<?php if ($card['sentence_0_ua']) { ?>
    			<span class="card__sen"><?php echo $card['sentence_0_ua']; ?></span>
    		<?php } ?>	
    		<?php if ($card['sentence_ua']) { ?>
    			<span class="card__sen"><?php echo $card['sentence_ua']; ?></span>
    		<?php } ?>
    	</div>
    </div>
</li>    
<?php $i++;}?>
</ul>
</div>
</div>
