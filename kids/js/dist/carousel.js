$(document).ready(function(){function t(){setTimeout(function(){$(".carousel .item:nth-child(1)").attr("data-id","1"),$(".carousel .item:nth-child(2)").attr("data-id","2"),$(".carousel .item:nth-child(3)").attr("data-id","3"),$(".carousel .item:nth-child(4)").attr("data-id","4"),$(".carousel .item:nth-child(5)").attr("data-id","5"),n=0},r)}function e(e){for(var a=[],i=0;i<e;i++)a[i]=$(".carousel .item:nth-child("+d+")"),$(".carousel .item:nth-child("+d+")").detach(),$(".carousel").prepend(a[i]);$(".carousel").css({marginLeft:-e*s+"px"}),u?setTimeout(function(){$(".carousel .item:nth-child(3)").addClass("active")},150):$(".carousel .item:nth-child("+o+")").addClass("active"),$(".carousel").animate({marginLeft:0},1.5*c),t()}function a(e){for(var a=[],i=0;i<e;i++)a[i]=$(".carousel .item:nth-child(1)"),$(".carousel .item:nth-child(1)").detach(),$(".carousel").append(a[i]);$(".carousel").css({marginLeft:s*e+"px"}),u?setTimeout(function(){$(".carousel .item:nth-child(3)").addClass("active")},150):$(".carousel .item:nth-child("+o+")").addClass("active"),$(".carousel").animate({marginLeft:0},1.5*c),t()}var i=$(".height-fix");$.each(i,function(t,e){var a=$(e).height();e.scrollHeight<a+2&&$(e).next().css("display","none")});$(".carousel");var n=0,r=350,c=250,o=3,s=100,d=5,l=navigator.userAgent.indexOf("Chrome")>-1,u=(navigator.userAgent.indexOf("MSIE"),navigator.userAgent.indexOf("Firefox"),navigator.userAgent.indexOf("Safari")>-1),h=navigator.userAgent.toLowerCase().indexOf("op")>-1;l&&u&&(u=!1),l&&h&&(l=!1),$(window).on("resize",function(){$(window).width()>600&&(s=100)}),$(".carousel").css("margin-bottom",$(".carousel .active .text-carousel").height()+"px"),$(".carousel").delegate(".item .content","click",function(t){if(t.preventDefault(),0==n){var i=$(this).parent().attr("data-id");n=1;var r=o-i;if(0==r)return void(n=0);$(".carousel .item").removeClass("active"),r<0?a(-1*r):r>0&&e(r)}})});