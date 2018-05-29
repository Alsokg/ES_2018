<div class="<?=$className?>">
    <?php foreach ($data as $image) { ?>
        <div>
            <img src="<?=$image?>" alt="<?=$image?>" />
        </div>
    <?php } ?>
</div>

<script>
    $(document).ready(function(){
$('.<?=$className?>').slick({
  dots: true,
  infinite: true,
  speed: 500,
  fade: true,
  cssEase: 'linear',
  autoplay: true,
  autoplaySpeed: 3000,
});
    });
</script>
<style>
    .slider-style .slick-arrow{
        display: none !important;
    }
    .slider-style {
        background-image: none !important;
    }
    .slider-style img{
        max-width: initial;
        width: 100%;
    }
    .slider-style .slick-dots {
        bottom: 10px;
    }
    .slider-style .slick-dots li button:before {
        color: #fff !important;
        font-size: 8px !important;
    }
</style>