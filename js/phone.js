    
$(document).ready(function(){
    
    $("#callback-form").on('submit', function(e){
       e.preventDefault();
       if ($('#phone').attr('data-valid') == 'false'){
           $(this).find('label').show();
       } else{
           $(this).find('label').hide();
           
        $.ajax({
            type: 'post',
            url: 'php-mail/callback.php',
            data: $('#callback-form').serialize(),
            success: function (response) {
                //console.log(response);
                //work
            }
          });
       }
    });

$( "#phone" ).phoneValidator();
    
});
    
    
(function ( $ ) {

   $.fn.phoneValidator = function(options) {
        var settings = $.extend({
         basicTpl: "+380 (__) ___-__-__",
        numberPlaceholder: '_',
        preHolder: "+380 (",
        afterHolder: "__) ___-__-__",
        curentValue: "+380 (",
        numbers: 9,
        fullLength: 19,
        pos: 6,
        that: null
        }, options );
       this.val(settings.basicTpl);
       settings.that = this;
       
       this.on('keydown', function(event){
           
            if(!isNumberKey(event) && !isSystemKey(event)){
                event.preventDefault(); //stop character from entering input
                return false;
            }
        var charCode = (event.which) ? event.which : event.keyCode;
        if (charCode > 60){
            charCode = charCode - 48;
        }
        if (isNumberKey(event)){
            
            var n = String.fromCharCode(charCode);
            if (settings.pos > settings.fullLength){
                event.preventDefault();
            }
            settings.pos++;
            if (settings.pos == 9){
               settings.preHolder += ") ";
               settings.afterHolder = settings.afterHolder.substr(2);
               settings.pos += 2;
            } else if (settings.pos == 14 || settings.pos == 17){
                settings.afterHolder = settings.afterHolder.substr(1);
                settings.preHolder += "-";
                settings.pos++;
            } 
            settings.preHolder += n.toString();
            settings.afterHolder = settings.afterHolder.substr(1);
            $(settings.that).val(settings.preHolder + settings.afterHolder);
            if (settings.pos == settings.fullLength)
                $(settings.that).attr('data-valid', true);
            event.preventDefault();
        } else{
            $(settings.that).val(settings.basicTpl).attr('data-valid', false);
            settings.pos = 6;
            settings.preHolder= "+380 (";
            settings.afterHolder= "__) ___-__-__";
            event.preventDefault();
        }
       });
};
}(jQuery));
function isNumberKey(e) {
var result = false; 
try {
    var charCode = (e.which) ? e.which : e.keyCode;
    if ((charCode >= 48 && charCode <= 57) || (charCode >= 96 && charCode <= 105)) {
        result = true;
    }
}
catch(err) {
    //console.log(err);
}
return result;
}
function isSystemKey(e) {
var result = false; 
try {
    var charCode = (e.which) ? e.which : e.keyCode;
    if (charCode == 8 || charCode == 37 || charCode == 39 || charCode == 46) {
        result = true;
    }
}
catch(err) {
    //console.log(err);
}
return result;
}