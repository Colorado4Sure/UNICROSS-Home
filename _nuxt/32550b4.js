(window.webpackJsonp = window.webpackJsonp || []).push([[60, 68], { 509: function (t, e, n) { n(28), n(20), n(27), n(30), n(23), n(31); var a = n(132), r = n(133); function s(t, e) { var n = Object.keys(t); if (Object.getOwnPropertySymbols) { var a = Object.getOwnPropertySymbols(t); e && (a = a.filter((function (e) { return Object.getOwnPropertyDescriptor(t, e).enumerable }))), n.push.apply(n, a) } return n } n(36), t.exports = { functional: !0, render: function (t, e) { var n = e._c, i = (e._v, e.data), c = e.children, l = void 0 === c ? [] : c, o = i.class, u = i.staticClass, p = i.style, d = i.staticStyle, f = i.attrs, v = void 0 === f ? {} : f, b = r(i, ["class", "staticClass", "style", "staticStyle", "attrs"]); return n("svg", function (t) { for (var e = 1; e < arguments.length; e++) { var n = null != arguments[e] ? arguments[e] : {}; e % 2 ? s(Object(n), !0).forEach((function (e) { a(t, e, n[e]) })) : Object.getOwnPropertyDescriptors ? Object.defineProperties(t, Object.getOwnPropertyDescriptors(n)) : s(Object(n)).forEach((function (e) { Object.defineProperty(t, e, Object.getOwnPropertyDescriptor(n, e)) })) } return t }({ class: ["animate-spin h-5 w-5 text-current inline-block", o, u], style: [p, d], attrs: Object.assign({ xmlns: "http://www.w3.org/2000/svg", fill: "none", viewBox: "0 0 24 24" }, v) }, b), l.concat([n("circle", { staticClass: "opacity-25", attrs: { cx: "12", cy: "12", r: "10", stroke: "currentColor", "stroke-width": "4" } }), n("path", { staticClass: "opacity-75", attrs: { fill: "currentColor", d: "M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" } })])) } } }, 511: function (t, e, n) { }, 513: function (t, e, n) { "use strict"; n.r(e); var a = n(8), r = Object(a.c)({ name: "LayeredCardLarge", props: { contentClass: { type: String, default: "p-9 lg:p-14 bg-white" } } }), s = (n(517), n(15)), i = Object(s.a)(r, (function () { var t = this, e = t.$createElement, n = t._self._c || e; return n("div", { staticClass: "card-wrapper" }, [n("div", { staticClass: "layer-0" }), t._v(" "), n("div", { staticClass: "layer-1" }), t._v(" "), n("div", { staticClass: "layer-2", class: t.contentClass }, [t._t("image"), t._v(" "), t._t("default")], 2)]) }), [], !1, null, "2fa4e3da", null); e.default = i.exports }, 517: function (t, e, n) { "use strict"; n(511) }, 692: function (t, e, n) { }, 832: function (t, e, n) { t.exports = n.p + "ff0955f90fe6e7b9c1dd8c086c76b02a.svg" }, 833: function (t, e, n) { "use strict"; n(692) }, 946: function (t, e, n) { "use strict"; n.r(e); var a = n(4), r = (n(17), n(8)), s = n(509), i = n.n(s), c = n(75), l = n(85), o = n.n(l), u = n(104), p = function t() { Object(c.a)(this, t) }; p.subscribe = function (t) { return o.a.post(u.n, t, { headers: { "Content-Type": "application/json" } }).then((function (t) { return t.data })) }; var d = Object(r.c)({ name: "NewsLetterSection", components: { Loader: i.a }, props: { title: { type: String, default: "" }, description: { type: String, default: "" }, actionText: { type: String, default: "" } }, setup: function (t, e) { var n = e.root, s = n.$toast, i = n.$sentry, c = Object(r.p)(""), l = Object(r.p)(!1), o = function () { var t = Object(a.a)(regeneratorRuntime.mark((function t() { var e, n, a, r; return regeneratorRuntime.wrap((function (t) { for (; ;)switch (t.prev = t.next) { case 0: return s.clear(), l.value = !0, s.show("Subscribing..."), t.prev = 3, a = { email: c.value, locale: "en" }, t.next = 7, p.subscribe(a); case 7: t.sent && (s.clear(), s.success("News Letter Subscription Successful"), c.value = ""), t.next = 18; break; case 11: t.prev = 11, t.t0 = t.catch(3), r = "An unexpected error occurred", l.value = !1, "string" == typeof (null === (n = null === (e = t.t0.response) || void 0 === e ? void 0 : e.data) || void 0 === n ? void 0 : n.message) && (r = t.t0.response.data.message), s.error(r, { duration: void 0 }), null == i || i.captureException(t.t0); case 18: l.value = !1; case 19: case "end": return t.stop() } }), t, null, [[3, 11]]) }))); return function () { return t.apply(this, arguments) } }(); return { email: c, loading: l, onSubscribe: o } } }), f = (n(833), n(15)), v = Object(f.a)(d, (function () { var t = this, e = t.$createElement, a = t._self._c || e; return a("section", { staticClass: "newsletter-wrapper" }, [a("div", { staticClass: "w-full flex flex-col items-center content" }, [a("div", { staticClass: "shadow-2xl rounded-t-lg px-5 lg:px-8 py-2" }, [a("img", { directives: [{ name: "lazy-load", rawName: "v-lazy-load" }], staticClass: "h-10 w-auto", attrs: { alt: "Ditepay Newsletter", "data-src": n(832) } })]), t._v(" "), a("layered-card-large", { staticClass: "w-full", attrs: { "content-class": "newsletter-form" } }, [a("div", { staticClass: "relative" }, [a("h1", [t._v(t._s(t.title))])]), t._v(" "), a("p", { staticClass: "description font-body-2" }, [t._v(t._s(t.description))]), t._v(" "), a("form", { on: { submit: function (e) { return e.stopPropagation(), e.preventDefault(), t.onSubscribe(e) } } }, [a("div", { staticClass: "flex items-center justify-center" }, [a("input", { directives: [{ name: "model", rawName: "v-model.trim", value: t.email, expression: "email", modifiers: { trim: !0 } }], class: { loading: t.loading }, attrs: { disabled: t.loading, type: "email", required: "", placeholder: "Email Address" }, domProps: { value: t.email }, on: { input: function (e) { e.target.composing || (t.email = e.target.value.trim()) }, blur: function (e) { return t.$forceUpdate() } } }), t._v(" "), a("button", { staticClass: "btn", attrs: { disabled: t.loading, type: "submit" } }, [t.loading ? a("loader") : t._e(), t._v(" "), a("span", { staticClass: "flex h-3 w-3 absolute -top-1 right-0" }, [a("span", { staticClass: "\n                  animate-ping\n                  absolute\n                  inline-flex\n                  h-full\n                  w-full\n                  rounded-full\n                  bg-secondary-400\n                  opacity-75\n                " }), t._v(" "), a("span", { staticClass: "\n                  relative\n                  inline-flex\n                  rounded-full\n                  h-3\n                  w-3\n                  bg-secondary-500\n                " })]), t._v("\n            " + t._s(t.loading ? "Subscribing.." : t.actionText) + "\n          ")], 1)])])])], 1)]) }), [], !1, null, null, null); e.default = v.exports; installComponents(v, { LayeredCardLarge: n(513).default }) } }]);