var i = 0;
var text = ["Специальная цена действует:", "Special price only", "Спеціальна ціна діє:"]
var date = "1.05.2018.0.0";
jQuery(document).ready(function() {
	var lang = $('.lang-wrapper .active').text();
	if (lang == 'UA') i = 3;
	if (lang == 'RU') i = 1;
	if (lang == 'EN') i = 2;
jQuery(".polska-timer").eTimer({
			etType: 0, etDate: date, 
			etTitleText: text[i-1], 
			etTitleSize: 16, etShowSign: i, etSep: " ",
			etTextColor: "black", 
			etPaddingTB: 0, 
			etPaddingLR: 0, 
			etBackground: "white", 
			etBorderSize: 0, 
			etBorderRadius: 0, 
			etBorderColor: "white", 
			etShadow: "inset 0px 0px 0px 0px #333333", 
			etLastUnit: 4,
			etNumberSize: 24, etNumberColor: "black", 
			etNumberPaddingTB: 0, etNumberPaddingLR: 4, 
			etNumberBackground: "#eeeeee", etNumberBorderSize: 0, 
			etNumberBorderRadius: 2, etNumberBorderColor: "white", 
			etNumberShadow: "inset 0px 0px 0px 0px rgba(0, 0, 0, 0.5)"
		});
});