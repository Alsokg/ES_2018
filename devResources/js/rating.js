function setStars(id, $that){
    var $arr = $that.find('.star-for');
    $arr.each(function(index, el){
       if (index + 1 <= id)
            $(el).children('i').addClass('active');
        else    
            $(el).children('i').removeClass('active');
    });
}
$('.star-for').on('click, mouseover', function(){
    var id = $(this).attr('data-id').slice(-1);
    setStars(id, $(this).parent());
})
$('.input-rating-group').on('mouseleave', function(){
    var id = $(this).find("input:radio[name ='rating']:checked").val();
    setStars(id, $(this));
});