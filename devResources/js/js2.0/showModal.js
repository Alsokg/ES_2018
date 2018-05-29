$('.buy-landing').on('click', function(e){
   e.preventDefault();
   var id = $(this).data('id-show');
   $(id).css('display', 'block').animate({
       opacity: 1
   });
   $('html, body').addClass('no-scroll');
});