function setStars(t,i){i.find(".star-for").each(function(i,a){i+1<=t?$(a).children("i").addClass("active"):$(a).children("i").removeClass("active")})}$(".star-for").on("click, mouseover",function(){setStars($(this).attr("data-id").slice(-1),$(this).parent())}),$(".input-rating-group").on("mouseleave",function(){setStars($(this).find("input:radio[name ='rating']:checked").val(),$(this))});