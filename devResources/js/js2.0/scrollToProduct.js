        $('.to-product').on('click', function(e){
            e.preventDefault();
            var el = $('#' + $(this).data('product'));
            var p = el.offset();
            var t = p.top - 66;
           var body = $("html, body");
            body.stop().animate({scrollTop: t}, 300, 'swing'); 
        });