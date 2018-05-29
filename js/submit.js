 $("#order-form").validate({
        ignore: ":hidden",
        rules: {
            sending: {
                required: true
            },
            paid: {
                required: true
            },
            fullName: {
                required: true,
                minlength: 3
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true,
                minlength: 10
            }
        },
        messages: {
            sending: {
                required: ""
            },
            paid: {
                required: ""
            },
            fullName: {
                required: "",
                minlength: ""
            },
            email: {
                required: "",
                email: ""
            },
            phone: {
                required: "",
                minlength: ""
            }
        },
        submitHandler: function(form) {
	//	var i = guid();
		 $('<input />').attr('type', 'hidden')
          .attr('name', "guid")
          .attr('value', i)
	        .attr('id', "guid")
          .appendTo('#order-form');
          
            $.ajax({
                type: "POST",
                url: "php-mail/sendmail.php",
                data: $(form).serialize(),
                success: function(response) {
                
                    setTimeout(function() {
                        $('#' + response).find('.close').click();
                    }, 5000);
                    
                }
                
            });
            return false;
            
        }
    });