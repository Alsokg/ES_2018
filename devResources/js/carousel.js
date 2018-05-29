$(document).ready(function(){

var $elements = $('.height-fix');
$.each($elements, function(key, value){
	var h = $(value).height();
	if (value.scrollHeight < h+2){
		$(value).next().css('display', 'none');
	}
});

	

var carousel = $(".carousel"),
    currdeg  = 0;
var block = 0;
var fadeTime = 350;
var timeOut = 300;
var rotationTime = 250;
var current = 3;
var width = 100;
var items = 5;
    var is_chrome = navigator.userAgent.indexOf('Chrome') > -1;
    var is_explorer = navigator.userAgent.indexOf('MSIE') > -1;
    var is_firefox = navigator.userAgent.indexOf('Firefox') > -1;
    var is_safari = navigator.userAgent.indexOf("Safari") > -1;
    var is_opera = navigator.userAgent.toLowerCase().indexOf("op") > -1;
    if ((is_chrome)&&(is_safari)) {is_safari=false;}
    if ((is_chrome)&&(is_opera)) {is_chrome=false;}
$(window).on('resize', function(){
	if ($(window).width() > 600){
		width = 100;
	}	else {
		width: 60;
	}
});
$('.carousel').css('margin-bottom', 	$('.carousel .active .text-carousel').height() + "px");
function restoreIDs(){
	setTimeout(function(){
		$('.carousel .item:nth-child(1)').attr('data-id', '1');
		$('.carousel .item:nth-child(2)').attr('data-id', '2');
		$('.carousel .item:nth-child(3)').attr('data-id', '3');
		$('.carousel .item:nth-child(4)').attr('data-id', '4');
		$('.carousel .item:nth-child(5)').attr('data-id', '5');
		block = 0;
	}, fadeTime);
}

function next(count){
	var $last = [];
	for (var i = 0; i < count; i++){
		$last[i] = $('.carousel .item:nth-child(' + (items) + ')');
		$('.carousel .item:nth-child(' + (items) + ')').detach();
		$('.carousel').prepend($last[i]);
	}
	$('.carousel').css({marginLeft: (-count*width) + "px"});
	if (is_safari){
				setTimeout(function(){
			$('.carousel .item:nth-child(' + (3) + ')').addClass('active');
		}, 150);
	} else {
		$('.carousel .item:nth-child(' + (current) + ')').addClass('active');	
	}
   	$('.carousel').animate({marginLeft: 0}, rotationTime*(2*0.75));
//	$('.carousel').css('margin-bottom', 	$('.carousel .active .text-carousel').height() + "px");
    restoreIDs();
}



function prev(count){
	var $first = [];
	for (var i = 0; i < count; i++){
		$first[i] = $('.carousel .item:nth-child('+ (1) +')');
		 $('.carousel .item:nth-child(1)').detach();
    	$('.carousel').append($first[i]);
	}
	$('.carousel').css({marginLeft: (width*count) + "px"});
	if (is_safari){
		setTimeout(function(){
			$('.carousel .item:nth-child(' + (3) + ')').addClass('active');
		}, 150);
	} else {
		$('.carousel .item:nth-child(' + (current) + ')').addClass('active');	
	}
    $('.carousel').animate({marginLeft: 0}, rotationTime*(2*0.75));    
 //   $('.carousel').css('margin-bottom', 	$('.carousel .active .text-carousel').height() + "px");
    restoreIDs();
}

$('.carousel').delegate('.item .content', 'click', function(e){
	e.preventDefault();
	if (block == 0){
		
		var clicked = $(this).parent().attr('data-id');
		block = 1;
		var dis = current - clicked;
		if (dis == 0){
			block = 0;
			return;
		}
		$('.carousel .item').removeClass('active');
		if (dis < 0){
			var tmp = dis*(-1);
			prev(tmp);
		} else if (dis > 0){
			next(dis);
		}
	}
});
});