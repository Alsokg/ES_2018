$('.close-icon').on('click', function(){
    $('html, body').removeClass('no-scroll');
    var $modal = $(this).parent().parent().parent(); 
    $modal.animate({
        opacity: 0
    }, 250);
    
    setTimeout(function() {$modal.css('display', 'none')}, 250);    
});

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}