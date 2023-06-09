/*!
 * jQuery jqCart Plugin v1.1.2
 * requires jQuery v1.9 or later
 *
 * http://incode.pro/
 *
 * Date: 2016-05-18 19:15
 */
	(function(e) {
	var a, k, d = "",
		n = 0,
		q = !1,
		m = e('<div class="jqcart-cart-label"><span class="jqcart-title">\u041e\u0444\u043e\u0440\u043c\u0438\u0442\u044c \u0437\u0430\u043a\u0430\u0437</span><span class="jqcart-total-cnt">0</span></div>'),
		g = {
			buttons: ".add_item",
			cartLabel: "body",
			visibleLabel: !1,
			openByAdding: !1,
			handler: "/",
			currency: "$"
		},
		c = {
			init: function(b) {
				g = e.extend(g, b);
				a = c.getStorage();
				if(null !== a && Object.keys(a).length) {
					for(var f in a) a.hasOwnProperty(f) && (n += a[f].count);
					q = !0;
				}
				m.prependTo(g.cartLabel)[q || g.visibleLabel ? "show" : "hide"]().on("click", c.openCart).find(".jqcart-total-cnt").text(n);
				e(document).on("click", g.buttons, c.addToCart).on("click", ".jqcart-layout", function(b) {
					b.target === this && c.hideCart();
				}).on("click", ".jqcart-incr", c.changeAmount).on("input keyup", ".jqcart-amount", c.changeAmount).on("click", ".jqcart-del-item", c.delFromCart).on("submit", ".jqcart-orderform", c.sendOrder).on("reset", ".jqcart-orderform", c.hideCart).on("click", ".jqcart-print-order", c.printOrder);
				return !1;
			},
			addToCart: function(b) {
				b.preventDefault();
				k = e(this).data();
				if("undefined" === typeof k.id) return console.log("\u041e\u0442\u0441\u0443\u0442\u0441\u0442\u0432\u0443\u0435\u0442 ID \u0442\u043e\u0432\u0430\u0440\u0430"), !1;
				a = c.getStorage() || {};
				a.hasOwnProperty(k.id) ? a[k.id].count++ : (k.count = 1, a[k.id] = k);
				c.setStorage(a);
				c.changeTotalCnt(1);
				m.show();
				g.openByAdding && c.openCart();
				return !1;
			},
			delFromCart: function() {
				var b = e(this).closest(".jqcart-tr"),
					f = b.data("id");
				a = c.getStorage();
				c.changeTotalCnt(-a[f].count);
				delete a[f];
				c.setStorage(a);
				b.remove();
				c.recalcSum();
				return !1;
			},
			changeAmount: function() {
				var b = e(this),
					f = b.hasClass("jqcart-amount"),
					d = +(f ? b.val() : b.data("incr")),
					l = b.closest(".jqcart-tr").data("id");
				a = c.getStorage();
				a[l].count = f ? isNaN(d) || 1 > d ? 1 : d : a[l].count + d;
				1 > a[l].count && (a[l].count = 1);
				f ? b.val(a[l].count) : b.siblings("input").val(a[l].count);
				c.setStorage(a);
				c.recalcSum();
				return !1;
			},
			recalcSum: function() {
				var b = 0,
					f, a = 0,
					d = 0;
				e(".jqcart-tr").each(function() {
					f = +e(".jqcart-amount", this).val();
					a = Math.ceil(f * e(".jqcart-price", this).text() * 100) / 100;
					e(".jqcart-sum", this).html(a + " " + g.currency);
					b = Math.ceil(100 * (b + a)) / 100;
					d += f;
				});
				e(".jqcart-subtotal strong").text(b);
				e(".jqcart-total-cnt").text(d);
				0 >= d && (c.hideCart(), g.visibleLabel || m.hide());
				return !1;
			},
			changeTotalCnt: function(b) {
				var a = e(".jqcart-total-cnt");
				a.text(+a.text() + b);
				return !1;
			},
			openCart: function() {
				var b = 0,
					f = "";
				a = c.getStorage();
				d = '<p class="jqcart-cart-title">\u041a\u043e\u0440\u0437\u0438\u043d\u0430 <span class="jqcart-print-order"></span></p><div class="jqcart-table-wrapper"><div class="jqcart-manage-order"><div class="jqcart-thead"><div>ID</div><div></div><div>\u041d\u0430\u0438\u043c\u0435\u043d\u043e\u0432\u0430\u043d\u0438\u0435</div><div>\u0426\u0435\u043d\u0430</div><div>\u041a\u043e\u043b-\u0432\u043e</div><div>\u0421\u0443\u043c\u043c\u0430</div><div></div></div>';
				var h, f = 0;
				for(h in a) a.hasOwnProperty(h) && (f = Math.ceil(a[h].count * a[h].price * 100) / 100, b = Math.ceil(100 * (b + f)) / 100, d += '<div class="jqcart-tr" data-id="' + a[h].id + '">', d += '<div class="jqcart-small-td">' + a[h].id + "</div>", d += '<div class="jqcart-small-td jqcart-item-img"><img src="' + a[h].img + '" alt=""></div>', d += "<div>" + a[h].title + "</div>", d += '<div class="jqcart-price">' + a[h].price + "</div>", d += '<div><span class="jqcart-incr" data-incr="-1">&#8211;</span><input type="text" class="jqcart-amount" value="' + a[h].count + '"><span class="jqcart-incr" data-incr="1">+</span></div>', d += '<div class="jqcart-sum">' + f + " " + g.currency + "</div>", d += '<div class="jqcart-small-td"><span class="jqcart-del-item"></span></div>', d += "</div>");
				d += "</div></div>";
				d += '<div class="jqcart-subtotal">\u0418\u0442\u043e\u0433\u043e: <strong>' + b + "</strong> " + g.currency + "</div>";
				f = b ? d + '<p class="jqcart-cart-title">\u041a\u043e\u043d\u0442\u0430\u043a\u0442\u043d\u0430\u044f \u0438\u043d\u0444\u043e\u0440\u043c\u0430\u0446\u0438\u044f:</p><form class="jqcart-orderform"><p><label>\u0424\u0418\u041e:</label><input type="text" name="user_name"></p><p><label>\u0422\u0435\u043b\u0435\u0444\u043e\u043d:</label><input type="text" name="user_phone"></p><p><label>Email:</label><input type="text" name="user_mail"></p><p><label>\u0410\u0434\u0440\u0435\u0441:</label><input type="text" name="user_address"></p><p><label>\u041a\u043e\u043c\u0435\u043d\u0442\u0430\u0440\u0438\u0439:</label><textarea name="user_comment"></textarea></p><p><input type="submit" value="\u041e\u0442\u043f\u0440\u0430\u0432\u0438\u0442\u044c \u0437\u0430\u043a\u0430\u0437"><input type="reset" value="\u0412\u0435\u0440\u043d\u0443\u0442\u044c\u0441\u044f \u043a \u043f\u043e\u043a\u0443\u043f\u043a\u0430\u043c"></p></form>' : '<h2 class="jqcart-empty-cart">\u041a\u043e\u0440\u0437\u0438\u043d\u0430 \u043f\u0443\u0441\u0442\u0430</h2>';
				e('<div class="jqcart-layout"><div class="jqcart-checkout">123</div></div>').appendTo("body").find(".jqcart-checkout").html(f);
			},
			hideCart: function() {
				e(".jqcart-layout").fadeOut("fast", function() {
					e(this).remove();
				});
				return !1;
			},
			sendOrder: function(b) {
				b.preventDefault();
				b = e(this);
				if("" === e.trim(e("[name=user_name]", b).val()) || "" === e.trim(e("[name=user_phone]", b).val())) return e('<p class="jqcart-error">\u041f\u043e\u0436\u0430\u043b\u0443\u0439\u0441\u0442\u0430, \u0443\u043a\u0430\u0436\u0438\u0442\u0435 \u0441\u0432\u043e\u0435 \u0438\u043c\u044f \u0438 \u043a\u043e\u043d\u0442\u0430\u043a\u0442\u043d\u044b\u0439 \u0442\u0435\u043b\u0435\u0444\u043e\u043d!</p>').insertBefore(b).delay(3E3).fadeOut(), !1;
				e.ajax({
					url: g.handler,
					type: "POST",
					dataType: "json",
					data: {
						orderlist: e.param(c.getStorage()),
						userdata: b.serialize()
					},
					error: function() {},
					success: function(b) {
						e(".jqcart-checkout").html("<p>" + b.message + "</p>");
						b.errors || setTimeout(p.clearCart, 2E3);
					}
				});
			},
			printOrder: function() {
				var b = e(this).closest(".jqcart-checkout").prop("outerHTML");
				if(!b) return !1;
				var a = window.open("", "\u041f\u0435\u0447\u0430\u0442\u044c \u0437\u0430\u043a\u0430\u0437\u0430", "width=" + screen.width + ",height=" + screen.height),
					d = e(a.opener.document).find('link[href$="jqcart.css"]').attr("href"),
					c = new Date(),
					c = ("0" + c.getDate()).slice(-2) + "-" + ("0" + (c.getMonth() + 1)).slice(-2) + "-" + c.getFullYear() + " " + ("0" + c.getHours()).slice(-2) + ":" + ("0" + c.getMinutes()).slice(-2) + ":" + ("0" + c.getSeconds()).slice(-2);
				a.document.write("<html><head><title>\u0417\u0430\u043a\u0430\u0437 " + c + "</title>");
				a.document.write('<link rel="stylesheet" href="' + d + '" type="text/css" />');
				a.document.write("</head><body >");
				a.document.write(b);
				a.document.write("</body></html>");
				a.document.close();
				a.focus();
				a.print();
				a.close();
				return !0;
			},
			setStorage: function(a) {
				localStorage.setItem("jqcart", JSON.stringify(a));
				return !1;
			},
			getStorage: function() {
				return JSON.parse(localStorage.getItem("jqcart"));
			}
		},
		p = {
			clearCart: function() {
				localStorage.removeItem("jqcart");
				m[g.visibleLabel ? "show" : "hide"]().find(".jqcart-total-cnt").text(0);
				c.hideCart();
			},
			openCart: c.openCart,
			printOrder: c.printOrder,
			test: function() {
				c.getStorage();
			}
		};
	e.jqCart = function(a) {
		if(p[a]) return p[a].apply(this, Array.prototype.slice.call(arguments, 1));
		if("object" !== typeof a && a) e.error('\u041c\u0435\u0442\u043e\u0434 \u0441 \u0438\u043c\u0435\u043d\u0435\u043c "' + a + '" \u043d\u0435 \u0441\u0443\u0449\u0435\u0441\u0442\u0432\u0443\u0435\u0442!');
		else return c.init.apply(this, arguments);
	};
})(jQuery);