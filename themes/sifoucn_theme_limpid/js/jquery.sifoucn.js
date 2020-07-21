/*
 * Desc:Xiuno BBS 4.0 模板实例：清新简约主题 
 * Author: sifoucn
 * Author URI: www.sifoucn.cn
 * Date: 2019-06-19
*/

$(function(){
	//主导航效果
	var nav = $("#header"); //得到导航对象
    var nav_empty = $("#nav_pc_2");
    var win = $(window); //得到窗口对象
    var sc = $(document); //得到document文档对象。
    win.scroll(function() {
      if (sc.scrollTop() >= 1) {
        nav.addClass("is_fixed").css({"position":"fixed","width":"100%","top":"0","left":"0","z-index":"999"}),
		nav_empty.addClass("hide");
      } else {
        nav.removeClass("is_fixed").removeAttr("style"),
		nav_empty.removeClass("hide");
      }
     });
});

$(function(){
	var scbar = $("#scbar");
	scbar.click(function(event){
		event.stopPropagation();
		$(this).addClass('active');
	});
	$(document).click(function(){
		if(scbar.hasClass('active')){
			scbar.removeClass('active');
		}
	})
});

$(".totop").click(function(){
	$('html,body').animate({ scrollTop: 0 },300);
});
$(window).scroll(function(){
	height =$(document).scrollTop();
	if(height > 300){$(".totop").show()}else{$(".totop").hide()};
});
$(function() {
    function a() {
        e.toggleClass(j),
        d.toggleClass(i),
        f.toggleClass(k),
        g.toggleClass(l)
    }
    function b() {
        e.addClass(j),
        d.animate({
            left: "0px"
        },
        n),
        f.animate({
            left: o
        },
        n),
        g.animate({
            left: o
        },
        n)
    }
    function c() {
        e.removeClass(j),
        d.animate({
            left: "-" + o
        },
        n),
        f.animate({
            left: "0px"
        },
        n),
        g.animate({
            left: "0px"
        },
        n)
    }
    var d = $(".sidebar"),
    e = $("body"),
    f = $("#offcanvas"),
    g = $(".slither"),
    h = $(".site-overlay"),
    i = "sidebar-left sidebar-open",
    j = "sidebar-active",
    k = "offcanvas-slither",
    l = "slither-slither",
    m = $(".navigation-drawer, .sidebar a"),
    n = 200,
    o = d.width() + "px";
    if (cssTransforms3d = function() {
        var a = document.createElement("p"),
        b = !1,
        c = {
            webkitTransform: "-webkit-transform",
            OTransform: "-o-transform",
            msTransform: "-ms-transform",
            MozTransform: "-moz-transform",
            transform: "transform"
        };
        document.body.insertBefore(a, null);
        for (var d in c) {
            void 0 !== a.style[d] && (a.style[d] = "translate3d(1px,1px,1px)", b = window.getComputedStyle(a).getPropertyValue(c[d]))
        }
        return document.body.removeChild(a),
        void 0 !== b && b.length > 0 && "none" !== b
    } ()) {
        m.click(function() {
            a()
        }),
        h.click(function() {
            a()
        })
    } else {
        d.css({
            left: "-" + o
        }),
        f.css({
            "overflow-x": "hidden"
        });
        var p = !0;
        m.click(function() {
            p ? (b(), p = !1) : (c(), p = !0)
        }),
        h.click(function() {
            p ? (b(), p = !1) : (c(), p = !0)
        })
    }
});