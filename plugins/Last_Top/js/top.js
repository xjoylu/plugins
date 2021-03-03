// 创建容器 监听滚动高度与点击
jQuery(document).ready(function(){
	$("#body").append("<div id='backTop'></div>");
	jQuery("#backTop").hide();
	jQuery(function () {
		jQuery(window).scroll(function(){ if (jQuery(window).scrollTop()>1000){ jQuery("#backTop").fadeIn(1000); }else{ jQuery("#backTop").fadeOut(1000); } });
		jQuery("#backTop").click(function(){ jQuery("body,html").animate({scrollTop:0},1000); return false; });
	});
});