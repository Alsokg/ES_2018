function isNumberKey(t){var i=!1;try{var s=t.which?t.which:t.keyCode;(s>=48&&s<=57||s>=96&&s<=105)&&(i=!0)}catch(t){console.log(t)}return i}function isSystemKey(t){var i=!1;try{var s=t.which?t.which:t.keyCode;8!=s&&37!=s&&39!=s&&46!=s||(i=!0)}catch(t){}return i}!function(t){t.fn.phoneValidator=function(i){var s=t.extend({basicTpl:"+380 (__) ___-__-__",numberPlaceholder:"_",preHolder:"+380 (",afterHolder:"__) ___-__-__",curentValue:"+380 (",numbers:9,fullLength:19,pos:6,that:null},i);this.val(s.basicTpl),s.that=this,this.on("keydown",function(i){if(s.pos>=s.fullLength&&!isSystemKey(i))return!1;if(!isNumberKey(i)&&!isSystemKey(i))return i.preventDefault(),!1;var n=i.which?i.which:i.keyCode;if(n>60&&(n-=48),isNumberKey(i)){var e=String.fromCharCode(n);s.pos>s.fullLength&&i.preventDefault(),s.pos++,9==s.pos?(s.preHolder+=") ",s.afterHolder=s.afterHolder.substr(2),s.pos+=2):14!=s.pos&&17!=s.pos||(s.afterHolder=s.afterHolder.substr(1),s.preHolder+="-",s.pos++),s.preHolder+=e.toString(),s.afterHolder=s.afterHolder.substr(1),t(s.that).val(s.preHolder+s.afterHolder),s.pos==s.fullLength&&t(s.that).attr("data-valid",!0),i.preventDefault()}else t(s.that).val(s.basicTpl).attr("data-valid",!1),s.pos=6,s.preHolder="+380 (",s.afterHolder="__) ___-__-__",i.preventDefault()})}}(jQuery),function(t,i,s){"use strict";var n=i.Modernizr;t.CBPFWSlider=function(i,s){this.$el=t(s),this._init(i)},t.CBPFWSlider.defaults={speed:500,easing:"ease"},t.CBPFWSlider.prototype={_init:function(i){this.options=t.extend(!0,{},t.CBPFWSlider.defaults,i),this._config(),this._initEvents()},_config:function(){this.$list=this.$el.children("ul"),this.$items=this.$list.children("li"),this.itemsCount=this.$items.length,this.support=n.csstransitions&&n.csstransforms,this.support3d=n.csstransforms3d;var i={WebkitTransition:{transitionEndEvent:"webkitTransitionEnd",tranformName:"-webkit-transform"},MozTransition:{transitionEndEvent:"transitionend",tranformName:"-moz-transform"},OTransition:{transitionEndEvent:"oTransitionEnd",tranformName:"-o-transform"},msTransition:{transitionEndEvent:"MSTransitionEnd",tranformName:"-ms-transform"},transition:{transitionEndEvent:"transitionend",tranformName:"transform"}};if(this.support&&(this.transEndEventName=i[n.prefixed("transition")].transitionEndEvent+".cbpFWSlider",this.transformName=i[n.prefixed("transition")].tranformName),this.current=0,this.old=0,this.isAnimating=!1,this.$list.css("width",100*this.itemsCount+"%"),this.support&&this.$list.css("transition",this.transformName+" "+this.options.speed+"ms "+this.options.easing),this.$items.css("width",100/this.itemsCount+"%"),this.itemsCount>1){this.$navPrev=t('<div class="cbp-fwprev"></div>').hide(),this.$navNext=t('<div class="cbp-fwnext"></div>'),t("<nav/>").append(this.$navPrev,this.$navNext).appendTo(this.$el);for(var s="",e=0;e<this.itemsCount;++e)s+=e===this.current?'<span class="cbp-fwcurrent"></span>':"<span></span>";var r=t('<div class="cbp-fwdots"/>').append(s).appendTo(this.$el);this.$navDots=r.children("span")}},_initEvents:function(){var i=this;this.itemsCount>1&&(this.$navPrev.on("click.cbpFWSlider",t.proxy(this._navigate,this,"previous")),this.$navNext.on("click.cbpFWSlider",t.proxy(this._navigate,this,"next")),this.$navDots.on("click.cbpFWSlider",function(){i._jump(t(this).index())}))},_navigate:function(t){if(this.isAnimating)return!1;this.isAnimating=!0,this.old=this.current,"next"===t&&this.current<this.itemsCount-1?++this.current:"previous"===t&&this.current>0&&--this.current,this._slide()},_slide:function(){this._toggleNavControls();var i=-1*this.current*100/this.itemsCount;this.support?this.$list.css("transform",this.support3d?"translate3d("+i+"%,0,0)":"translate("+i+"%)"):this.$list.css("margin-left",-1*this.current*100+"%");var s=t.proxy(function(){this.isAnimating=!1},this);this.support?this.$list.on(this.transEndEventName,t.proxy(s,this)):s.call()},_toggleNavControls:function(){switch(this.current){case 0:this.$navNext.show(),this.$navPrev.hide();break;case this.itemsCount-1:this.$navNext.hide(),this.$navPrev.show();break;default:this.$navNext.show(),this.$navPrev.show()}this.$navDots.eq(this.old).removeClass("cbp-fwcurrent").end().eq(this.current).addClass("cbp-fwcurrent")},_jump:function(t){if(t===this.current||this.isAnimating)return!1;this.isAnimating=!0,this.old=this.current,this.current=t,this._slide()},destroy:function(){this.itemsCount>1&&(this.$navPrev.parent().remove(),this.$navDots.parent().remove()),this.$list.css("width","auto"),this.support&&this.$list.css("transition","none"),this.$items.css("width","auto")}};var e=function(t){i.console&&i.console.error(t)};t.fn.cbpFWSlider=function(i){if("string"==typeof i){var s=Array.prototype.slice.call(arguments,1);this.each(function(){var n=t.data(this,"cbpFWSlider");n?t.isFunction(n[i])&&"_"!==i.charAt(0)?n[i].apply(n,s):e("no such method '"+i+"' for cbpFWSlider instance"):e("cannot call methods on cbpFWSlider prior to initialization; attempted to call method '"+i+"'")})}else this.each(function(){var s=t.data(this,"cbpFWSlider");s?s._init():s=t.data(this,"cbpFWSlider",new t.CBPFWSlider(i,this))});return this}}(jQuery,window);