(window.MIP = window.MIP || []).push({
    name: "mip-showmore",
    func: function() {
        define("mip-showmore/mip-showmore", ["require", "customElement", "util", "viewport"],
        function(e) {
            function t(e, t) {
                for (; t.parentNode;) {
                    var i = t.getAttribute("on");
                    if (i && 0 === i.indexOf("tap:" + e)) return t;
                    t = t.parentNode
                }
                return t
            }
            function i(e) {
                var t, i = e.ele,
                n = e.type,
                o = s || [];
                if (n && i) {
                    if (void 0 === e.transitionTime || isNaN(e.transitionTime)) t = .24;
                    else t = Math.min(parseFloat(e.transitionTime), 1);
                    var r, a = void 0 !== e.oriHeight ? e.oriHeight: getComputedStyle(i).height,
                    c = e.cbFun ||
                    function() {};
                    if ("unfold" === n) {
                        if (void 0 !== e.tarHeight) r = e.tarHeight;
                        else i.style.transition = "height 0s",
                        i.style.height = "auto",
                        r = getComputedStyle(i).height;
                        var l = setTimeout(function() {
                            i.style.transition = "height 0s",
                            i.style.height = "auto"
                        },
                        1e3 * t);
                        o[0] = l
                    } else if ("fold" === n) r = e.tarHeight || 0;
                    i.style.height = a;
                    var p = setTimeout(function() {
                        i.style.transition = "height " + t + "s",
                        i.style.height = r
                    },
                    10),
                    d = setTimeout(function() {
                        c()
                    },
                    1e3 * t);
                    o[i.id] = o[i.id] || [],
                    o[i.id][1] = p,
                    o[i.id][2] = d
                }
            }
            function n(e) {
                var t = document.createElement("div"),
                i = getComputedStyle(e);
                t.innerHTML = e.innerHTML,
                t.style.padding = i.padding,
                t.style.margin = i.margin,
                t.style.border = i.border,
                t.style.position = "absolute",
                e.parentNode.insertBefore(t, e),
                t.style.height = "auto",
                t.style.visibility = "hidden";
                var n = r.rect.getElementOffset(t).height;
                return e.parentNode.removeChild(t),
                n
            }
            var o = e("customElement").create(),
            r = e("util"),
            a = e("viewport"),
            s = [],
            c = function(e) {
                if (this.ele = e, this.clickBtn = e.querySelector("[showmorebtn]"), this.clickBtnSpan = this.clickBtn && this.clickBtn.querySelector(".mip-showmore-btnshow"), this.showBox = this.ele.querySelector("[showmorebox]"), this.animateTime = this.ele.getAttribute("animatetime"), null === this.animateTime || isNaN(this.animateTime)) this.animateTime = .24;
                if (this.heightType = ["HEIGHTSCREEN", "HEIGHT", "LENGTH"], this.btn = document.querySelector('div[on="tap:' + this.ele.id + '.toggle"]'), this.eleid = e.id, !this.showBox) this.showBox = this.ele
            };
            return c.prototype.init = function() {
                if (!isNaN(this.animateTime)) {
                    if (this.maxHeight = this.ele.getAttribute("maxheight"), this.maxLen = this.ele.getAttribute("maxlen"), this.bottomShadow = "1" === this.ele.getAttribute("bottomshadow"), this.bottomShadowClassName = "linear-gradient", this.maxHeight && isNaN(this.maxHeight)) {
                        var e, t, i = this.maxHeight.split(":");
                        if (i.length > 1) switch (e = i[0].trim(), t = i[1].trim(), e) {
                        case "screen":
                            this.showType = this.heightType[0],
                            this.maxHeight = a.getHeight() * t,
                            this._initHeight();
                            break;
                        case "heightpx":
                            this.showType = this.heightType[1],
                            this._initHeight()
                        }
                    } else if (this.maxHeight && !isNaN(this.maxHeight)) this.showType = this.heightType[1],
                    this._initHeight();
                    else if (this.maxLen && !isNaN(this.maxLen)) this.showType = this.heightType[2],
                    this._initTextLength();
                    else this.maxHeight = 0,
                    this._initHeight();
                    r.css(this.ele, {
                        visibility: "visible"
                    });
                    var n = this.clickBtnSpan && getComputedStyle(this.clickBtnSpan).display,
                    o = this.btn && getComputedStyle(this.btn).display;
                    this.btnDisplay = o || n
                }
            },
            c.prototype.changeBtnStyle = function(e) {
                var t = this.ele.querySelector(".mip-showmore-btnshow"),
                i = this.ele.querySelector(".mip-showmore-btnhide"),
                n = this.btn || t;
                if ("fold" === e) r.css(n, "display", "inline-block"),
                i && r.css(i, "display", "none"),
                this.bottomShadow && this.showBox.classList.add(this.bottomShadowClassName);
                else if ("unfold" === e) r.css(n, "display", "none"),
                this.bottomShadow && this.showBox.classList.remove(this.bottomShadowClassName)
            },
            c.prototype._initHeight = function() {
                var e;
                if (this.showBox.style.height && this.showBox.style.height.match("px")) e = n(this.showBox);
                else e = r.rect.getElementOffset(this.showBox).height;
                if (e > this.maxHeight) r.css(this.showBox, {
                    height: this.maxHeight + "px",
                    overflow: "hidden"
                }),
                this.changeBtnStyle("fold");
                else r.css(this.showBox, e, "auto"),
                this.changeBtnStyle("unfold")
            },
            c.prototype._initTextLength = function() {
                if (!this.oriDiv) {
                    var e = this.showBox.innerHTML,
                    t = this._cutHtmlStr(this.maxLen);
                    if (e.length !== t.length) this.changeBtnStyle("fold"),
                    this.showBox.innerHTML = "",
                    this.oriDiv = document.createElement("div"),
                    this.oriDiv.setAttribute("class", "mip-showmore-originText mip-showmore-nodisplay"),
                    this.oriDiv.innerHTML = e,
                    this.showBox.appendChild(this.oriDiv),
                    this.cutDiv = document.createElement("div"),
                    this.cutDiv.setAttribute("class", "mip-showmore-abstract"),
                    this.cutDiv.innerHTML = "<p>" + t + "...</p>",
                    this.showBox.appendChild(this.cutDiv)
                }
            },
            c.prototype._bindClick = function() {
                if (this.clickBtn) {
                    var e = this;
                    this.clickBtn.addEventListener("click",
                    function() {
                        e.toggle.apply(e)
                    },
                    !1)
                }
            },
            c.prototype.addClassWhenUnfold = function() {
                var e = this.btn;
                e && e.classList.add("mip-showmore-btn-hide")
            },
            c.prototype.toggle = function(e) {
                var o = this,
                a = this.ele.classList,
                s = e && e.target ? t(this.ele.id.trim(), e.target) : null,
                c = {};
                if (c.aniTime = this.animateTime, this.showType === this.heightType[2]) {
                    c.oriHeight = r.rect.getElementOffset(this.showBox).height + "px";
                    var l = this.oriDiv,
                    p = this.cutDiv;
                    if (a.contains("mip-showmore-boxshow")) l.classList.add("mip-showmore-nodisplay"),
                    p.classList.remove("mip-showmore-nodisplay"),
                    c.tarHeight = r.rect.getElementOffset(this.showBox).height + "px",
                    l.classList.remove("mip-showmore-nodisplay"),
                    p.classList.add("mip-showmore-nodisplay"),
                    this.bottomShadow && this.showBox.classList.add(this.bottomShadowClassName),
                    c.type = "fold",
                    c.cbFun = function(e) {
                        e._toggleClickBtn(s, "showOpen"),
                        a.remove("mip-showmore-boxshow"),
                        l.classList.add("mip-showmore-nodisplay"),
                        p.classList.remove("mip-showmore-nodisplay")
                    }.bind(void 0, this);
                    else this.bottomShadow && this.showBox.classList.remove(this.bottomShadowClassName),
                    c.type = "unfold",
                    l.classList.remove("mip-showmore-nodisplay"),
                    p.classList.add("mip-showmore-nodisplay"),
                    c.tarHeight = n(this.showBox) + "px",
                    this.showBox.style.height = this.maxHeight + "px",
                    c.cbFun = function(e) {
                        e._toggleClickBtn(s, "showClose"),
                        a.add("mip-showmore-boxshow"),
                        o.addClassWhenUnfold()
                    }.bind(void 0, this)
                } else if (this.showType === this.heightType[1] || this.showType === this.heightType[0]) if (a.contains("mip-showmore-boxshow")) this.bottomShadow && this.showBox.classList.add(this.bottomShadowClassName),
                a.remove("mip-showmore-boxshow"),
                c.type = "fold",
                c.tarHeight = this.maxHeight + "px",
                c.cbFun = function(e, t) {
                    e._toggleClickBtn(t, "showOpen")
                }.bind(void 0, this, s);
                else this.bottomShadow && this.showBox.classList.remove(this.bottomShadowClassName),
                a.add("mip-showmore-boxshow"),
                c.type = "unfold",
                c.cbFun = function(e, t) {
                    e._toggleClickBtn(t, "showClose"),
                    e.ele.style.height = "auto",
                    o.addClassWhenUnfold()
                }.bind(void 0, this, s);
                i({
                    ele: this.showBox,
                    type: c.type,
                    transitionTime: c.aniTime,
                    tarHeight: c.tarHeight,
                    oriHeight: c.oriHeight,
                    cbFun: c.cbFun
                })
            },
            c.prototype._toggleClickBtn = function(e, t) {
                if (t) {
                    var i;
                    if (e && e.dataset && e.dataset.closeclass) i = e.dataset.closeclass;
                    if ("showOpen" === t) {
                        if (e) if (i) e.classList.remove(i);
                        else e.innerText = e.dataset.opentext;
                        this._changeBtnText({
                            display: this.btnDisplay
                        },
                        {
                            display: "none"
                        })
                    } else {
                        if (e) if (i) e.classList.add(i);
                        else {
                            var n = e.innerText;
                            e.innerText = e.dataset.closetext || "收起",
                            e.dataset.opentext = n
                        }
                        this._changeBtnText({
                            display: "none"
                        },
                        {
                            display: this.btnDisplay
                        })
                    }
                }
            },
            c.prototype._cutHtmlStr = function(e) {
                for (var t = this.showBox.childNodes,
                i = "",
                n = 0,
                o = [], r = 0; r < t.length; r++) {
                    var a = t[r].textContent.replace(/(^\s*)|(\s*$)/g, "");
                    if (i.length + a.length <= e) i += a,
                    n = i.length,
                    o.push(t[r]);
                    else {
                        var s = e - n > 0 ? e - n: n - e,
                        c = a ? a.slice(0, s) : "";
                        t[r].textContent = c,
                        o.push(t[r]);
                        break
                    }
                }
                for (var l = "",
                p = 0; p < o.length; p++) {
                    var d = o[p].nodeType;
                    if (1 === d) l += o[p].outerHTML;
                    else if (3 === d) l += o[p].textContent
                }
                return l
            },
            c.prototype._changeBtnText = function(e, t) {
                var i = this.ele.querySelector(".mip-showmore-btnshow"),
                n = this.ele.querySelector(".mip-showmore-btnhide");
                this._changeBtnShow(i, e),
                this._changeBtnShow(n, t)
            },
            c.prototype._changeBtnShow = function(e, t) {
                r.css(e, t)
            },
            o.prototype.build = function() {
                var e = this.element,
                t = new c(e);
                t.init(),
                t._bindClick(),
                this.addEventAction("toggle",
                function(e) {
                    t.toggle(e)
                }),
                window.addEventListener("orientationchange",
                function() {
                    t.init()
                },
                !1)
            },
            o.prototype.detachedCallback = function() {
                for (var e = s && s[this.element.id] || [], t = 0; t < e.length; t++) window.clearTimeout(e[t])
            },
            o
        }),
        define("mip-showmore", ["mip-showmore/mip-showmore"],
        function(e) {
            return e
        }),
        function() {
            function e(e, t) {
                e.registerMipElement("mip-showmore", t, 'mip-showmore{visibility:hidden;overflow:hidden;transform:translateZ(0)}mip-showmore .mip-showmore-originalhtml,mip-showmore .mip-showmore-btnhide,mip-showmore .mip-showmore-btnshow{display:none}mip-showmore.linear-gradient:after{content:"";position:absolute;bottom:0;display:block;width:100%;height:120px;background:-moz-linear-gradient(to bottom, rgba(255,255,255,0), #fff);background:-webkit-linear-gradient(to bottom, rgba(255,255,255,0), #fff);background:linear-gradient(to bottom, rgba(255,255,255,0), #fff)}mip-showmore [showmorebox]{overflow:hidden}mip-showmore .mip-showmore-originText{width:100%;transform:translate3d(0, 0, 0);-webkit-transform:translate3d(0, 0, 0);word-wrap:break-word;word-break:break-all}.mip-showmore-btn{display:none;padding:15px;border:1px solid #ddd;background:#fafafa}.mip-showmore-btn:hover,.mip-showmore-btn:active{background:#f0f0f0}.mip-showmore-nodisplay{display:none}')
            }
            if (window.MIP) require(["mip-showmore"],
            function(t) {
                e(window.MIP, t)
            });
            else require(["mip", "mip-showmore"], e)
        } ()
    }
});