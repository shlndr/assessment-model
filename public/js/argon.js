/*!

=========================================================
* Argon Dashboard - v1.2.0
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2020 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md)

* Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

*/
"use strict";
var map, lat, lng, Layout = function () {
		function a() {
			$(".sidenav-toggler").addClass("active"), $(".sidenav-toggler").data("action", "sidenav-unpin"), $("body").removeClass("g-sidenav-hidden").addClass("g-sidenav-show g-sidenav-pinned"), $("body").append('<div class="backdrop d-xl-none" data-action="sidenav-unpin" data-target=' + $("#sidenav-main").data("target") + " />"), Cookies.set("sidenav-state", "pinned")
		}

		function e() {
			$(".sidenav-toggler").removeClass("active"), $(".sidenav-toggler").data("action", "sidenav-pin"), $("body").removeClass("g-sidenav-pinned").addClass("g-sidenav-hidden"), $("body").find(".backdrop").remove(), Cookies.set("sidenav-state", "unpinned")
		}
		var n = Cookies.get("sidenav-state") ? Cookies.get("sidenav-state") : "pinned";
		$(window).width() > 1200 && ("pinned" == n && a(), "unpinned" == Cookies.get("sidenav-state") && e(), $(window).resize(function () {
			$("body").hasClass("g-sidenav-show") && !$("body").hasClass("g-sidenav-pinned") && $("body").removeClass("g-sidenav-show").addClass("g-sidenav-hidden")
		})), $(window).width() < 1200 && ($("body").removeClass("g-sidenav-hide").addClass("g-sidenav-hidden"), $("body").removeClass("g-sidenav-show"), $(window).resize(function () {
			$("body").hasClass("g-sidenav-show") && !$("body").hasClass("g-sidenav-pinned") && $("body").removeClass("g-sidenav-show").addClass("g-sidenav-hidden")
		})), $("body").on("click", "[data-action]", function (n) {
			n.preventDefault();
			var t = $(this),
				o = t.data("action");
			t.data("target");
			switch (o) {
				case "sidenav-pin":
					a();
					break;
				case "sidenav-unpin":
					e();
					break;
				case "search-show":
					t.data("target"), $("body").removeClass("g-navbar-search-show").addClass("g-navbar-search-showing"), setTimeout(function () {
						$("body").removeClass("g-navbar-search-showing").addClass("g-navbar-search-show")
					}, 150), setTimeout(function () {
						$("body").addClass("g-navbar-search-shown")
					}, 300);
					break;
				case "search-close":
					t.data("target"), $("body").removeClass("g-navbar-search-shown"), setTimeout(function () {
						$("body").removeClass("g-navbar-search-show").addClass("g-navbar-search-hiding")
					}, 150), setTimeout(function () {
						$("body").removeClass("g-navbar-search-hiding").addClass("g-navbar-search-hidden")
					}, 300), setTimeout(function () {
						$("body").removeClass("g-navbar-search-hidden")
					}, 500)
			}
		}), $(".sidenav").on("mouseenter", function () {
			$("body").hasClass("g-sidenav-pinned") || $("body").removeClass("g-sidenav-hide").removeClass("g-sidenav-hidden").addClass("g-sidenav-show")
		}), $(".sidenav").on("mouseleave", function () {
			$("body").hasClass("g-sidenav-pinned") || ($("body").removeClass("g-sidenav-show").addClass("g-sidenav-hide"), setTimeout(function () {
				$("body").removeClass("g-sidenav-hide").addClass("g-sidenav-hidden")
			}, 300))
		}), $(window).on("load resize", function () {
			$("body").height() < 800 && ($("body").css("min-height", "100vh"), $("#footer-main").addClass("footer-auto-bottom"))
		})
	}(),
	Charts = function () {
		var a, e = $('[data-toggle="chart"]'),
			n = "light",
			t = {
				base: "Open Sans"
			},
			o = {
				gray: {
					100: "#f6f9fc",
					200: "#e9ecef",
					300: "#dee2e6",
					400: "#ced4da",
					500: "#adb5bd",
					600: "#8898aa",
					700: "#525f7f",
					800: "#32325d",
					900: "#212529"
				},
				theme: {
					default: "#172b4d",
					primary: "#5e72e4",
					secondary: "#f4f5f7",
					info: "#11cdef",
					success: "#2dce89",
					danger: "#f5365c",
					warning: "#fb6340"
				},
				black: "#12263F",
				white: "#FFFFFF",
				transparent: "transparent"
			};

		function s(a, e) {
			for (var n in e) "object" != typeof e[n] ? a[n] = e[n] : s(a[n], e[n])
		}

		function r(a) {
			var e = a.data("add"),
				n = $(a.data("target")).data("chart");
			a.is(":checked") ? (! function a(e, n) {
				for (var t in n) Array.isArray(n[t]) ? n[t].forEach(function (a) {
					e[t].push(a)
				}) : a(e[t], n[t])
			}(n, e), n.update()) : (! function a(e, n) {
				for (var t in n) Array.isArray(n[t]) ? n[t].forEach(function (a) {
					e[t].pop()
				}) : a(e[t], n[t])
			}(n, e), n.update())
		}

		function i(a) {
			var e = a.data("update"),
				n = $(a.data("target")).data("chart");
			s(n, e),
				function (a, e) {
					if (void 0 !== a.data("prefix") || void 0 !== a.data("prefix")) {
						var n = a.data("prefix") ? a.data("prefix") : "",
							t = a.data("suffix") ? a.data("suffix") : "";
						e.options.scales.yAxes[0].ticks.callback = function (a) {
							if (!(a % 10)) return n + a + t
						}, e.options.tooltips.callbacks.label = function (a, e) {
							var o = e.datasets[a.datasetIndex].label || "",
								s = a.yLabel,
								r = "";
							return e.datasets.length > 1 && (r += '<span class="popover-body-label mr-auto">' + o + "</span>"), r += '<span class="popover-body-value">' + n + s + t + "</span>"
						}
					}
				}(a, n), n.update()
		}
		return window.Chart && s(Chart, (a = {
			defaults: {
				global: {
					responsive: !0,
					maintainAspectRatio: !1,
					defaultColor: "dark" == n ? o.gray[700] : o.gray[600],
					defaultFontColor: "dark" == n ? o.gray[700] : o.gray[600],
					defaultFontFamily: t.base,
					defaultFontSize: 13,
					layout: {
						padding: 0
					},
					legend: {
						display: !1,
						position: "bottom",
						labels: {
							usePointStyle: !0,
							padding: 16
						}
					},
					elements: {
						point: {
							radius: 0,
							backgroundColor: o.theme.primary
						},
						line: {
							tension: .4,
							borderWidth: 4,
							borderColor: o.theme.primary,
							backgroundColor: o.transparent,
							borderCapStyle: "rounded"
						},
						rectangle: {
							backgroundColor: o.theme.warning
						},
						arc: {
							backgroundColor: o.theme.primary,
							borderColor: "dark" == n ? o.gray[800] : o.white,
							borderWidth: 4
						}
					},
					tooltips: {
						enabled: !0,
						mode: "index",
						intersect: !1
					}
				},
				doughnut: {
					cutoutPercentage: 83,
					legendCallback: function (a) {
						var e = a.data,
							n = "";
						return e.labels.forEach(function (a, t) {
							var o = e.datasets[0].backgroundColor[t];
							n += '<span class="chart-legend-item">', n += '<i class="chart-legend-indicator" style="background-color: ' + o + '"></i>', n += a, n += "</span>"
						}), n
					}
				}
			}
		}, Chart.scaleService.updateScaleDefaults("linear", {
			gridLines: {
				borderDash: [2],
				borderDashOffset: [2],
				color: "dark" == n ? o.gray[900] : o.gray[300],
				drawBorder: !1,
				drawTicks: !1,
				drawOnChartArea: !0,
				zeroLineWidth: 0,
				zeroLineColor: "rgba(0,0,0,0)",
				zeroLineBorderDash: [2],
				zeroLineBorderDashOffset: [2]
			},
			ticks: {
				beginAtZero: !0,
				padding: 10,
				callback: function (a) {
					if (!(a % 10)) return a
				}
			}
		}), Chart.scaleService.updateScaleDefaults("category", {
			gridLines: {
				drawBorder: !1,
				drawOnChartArea: !1,
				drawTicks: !1
			},
			ticks: {
				padding: 20
			},
			maxBarThickness: 10
		}), a)), e.on({
			change: function () {
				var a = $(this);
				a.is("[data-add]") && r(a)
			},
			click: function () {
				var a = $(this);
				a.is("[data-update]") && i(a)
			}
		}), {
			colors: o,
			fonts: t,
			mode: n
		}
	}(),
	CopyIcon = function () {
		var a, e = ".btn-icon-clipboard",
			n = $(e);
		n.length && ((a = n).tooltip().on("mouseleave", function () {
			a.tooltip("hide")
		}), new ClipboardJS(e).on("success", function (a) {
			$(a.trigger).attr("title", "Copied!").tooltip("_fixTitle").tooltip("show").attr("title", "Copy to clipboard").tooltip("_fixTitle"), a.clearSelection()
		}))
	}(),
	Navbar = function () {
		var a = $(".navbar-nav, .navbar-nav .nav"),
			e = $(".navbar .collapse"),
			n = $(".navbar .dropdown");
		e.on({
			"show.bs.collapse": function () {
				var n;
				(n = $(this)).closest(a).find(e).not(n).collapse("hide")
			}
		}), n.on({
			"hide.bs.dropdown": function () {
				var a, e;
				a = $(this), (e = a.find(".dropdown-menu")).addClass("close"), setTimeout(function () {
					e.removeClass("close")
				}, 200)
			}
		})
	}(),
	NavbarCollapse = function () {
		$(".navbar-nav");
		var a = $(".navbar .navbar-custom-collapse");
		a.length && (a.on({
			"hide.bs.collapse": function () {
				a.addClass("collapsing-out")
			}
		}), a.on({
			"hidden.bs.collapse": function () {
				a.removeClass("collapsing-out")
			}
		}));
		var e = 0;
		$(".sidenav-toggler").click(function () {
			if (1 == e) $("body").removeClass("nav-open"), e = 0, $(".bodyClick").remove();
			else {
				$('<div class="bodyClick"></div>').appendTo("body").click(function () {
					$("body").removeClass("nav-open"), e = 0, $(".bodyClick").remove()
				}), $("body").addClass("nav-open"), e = 1
			}
		})
	}(),
	Popover = function () {
		var a = $('[data-toggle="popover"]'),
			e = "";
		a.length && a.each(function () {
			! function (a) {
				a.data("color") && (e = "popover-" + a.data("color"));
				var n = {
					trigger: "focus",
					template: '<div class="popover ' + e + '" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>'
				};
				a.popover(n)
			}($(this))
		})
	}(),
	ScrollTo = function () {
		var a = $(".scroll-me, [data-scroll-to], .toc-entry a");

		function e(a) {
			var e = a.attr("href"),
				n = a.data("scroll-to-offset") ? a.data("scroll-to-offset") : 0,
				t = {
					scrollTop: $(e).offset().top - n
				};
			$("html, body").stop(!0, !0).animate(t, 600), event.preventDefault()
		}
		a.length && a.on("click", function (a) {
			e($(this))
		})
	}(),
	Tooltip = function () {
		var a = $('[data-toggle="tooltip"]');
		a.length && a.tooltip()
	}(),
	FormControl = function () {
		var a = $(".form-control");
		a.length && a.on("focus blur", function (a) {
			$(this).parents(".form-group").toggleClass("focused", "focus" === a.type)
		}).trigger("blur")
	}(),
	$map = $("#map-default"),
	color = "#5e72e4";

function initMap() {
	map = document.getElementById("map-default"), lat = map.getAttribute("data-lat"), lng = map.getAttribute("data-lng");
	var a = new google.maps.LatLng(lat, lng),
		e = {
			zoom: 12,
			scrollwheel: !1,
			center: a,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
	map = new google.maps.Map(map, e);
	var n = new google.maps.Marker({
			position: a,
			map: map,
			animation: google.maps.Animation.DROP,
			title: "Hello World!"
		}),
		t = new google.maps.InfoWindow({
			content: '<div class="info-window-content"><h2>Argon Dashboard</h2><p>A beautiful Dashboard for Bootstrap 4. It is Free and Open Source.</p></div>'
		});
	google.maps.event.addListener(n, "click", function () {
		t.open(map, n)
	})
}
$map.length && google.maps.event.addDomListener(window, "load", initMap);
var BarsChart = function () {
		var a = $("#chart-bars");
		a.length && function (a) {
			var e = new Chart(a, {
				type: "bar",
				data: {
					labels: ["Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
					datasets: [{
						label: "Sales",
						data: [25, 20, 30, 22, 17, 29]
					}]
				}
			});
			a.data("chart", e)
		}(a)
	}(),
	SalesChart = function () {
		var a = $("#chart-sales-dark");
		a.length && function (a) {
			var e = new Chart(a, {
				type: "line",
				options: {
					scales: {
						yAxes: [{
							gridLines: {
								lineWidth: 1,
								color: Charts.colors.gray[900],
								zeroLineColor: Charts.colors.gray[900]
							},
							ticks: {
								callback: function (a) {
									if (!(a % 10)) return "$" + a + "k"
								}
							}
						}]
					},
					tooltips: {
						callbacks: {
							label: function (a, e) {
								var n = e.datasets[a.datasetIndex].label || "",
									t = a.yLabel,
									o = "";
								return e.datasets.length > 1 && (o += '<span class="popover-body-label mr-auto">' + n + "</span>"), o += '<span class="popover-body-value">$' + t + "k</span>"
							}
						}
					}
				},
				data: {
					labels: ["May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
					datasets: [{
						label: "Performance",
						data: [0, 20, 10, 30, 15, 40, 20, 60, 60]
					}]
				}
			});
			a.data("chart", e)
		}(a)
	}(),
	Datepicker = function () {
		var a = $(".datepicker");
		a.length && a.each(function () {
			$(this).datepicker({
				disableTouchKeyboard: !0,
				autoclose: !1
			})
		})
	}(),
	noUiSlider = function () {
		if ($(".input-slider-container")[0] && $(".input-slider-container").each(function () {
				var a = $(this).find(".input-slider"),
					e = a.attr("id"),
					n = a.data("range-value-min"),
					t = a.data("range-value-max"),
					o = $(this).find(".range-slider-value"),
					s = o.attr("id"),
					r = o.data("range-value-low"),
					i = document.getElementById(e),
					d = document.getElementById(s);
				noUiSlider.create(i, {
					start: [parseInt(r)],
					connect: [!0, !1],
					range: {
						min: [parseInt(n)],
						max: [parseInt(t)]
					}
				}), i.noUiSlider.on("update", function (a, e) {
					d.textContent = a[e]
				})
			}), $("#input-slider-range")[0]) {
			var a = document.getElementById("input-slider-range"),
				e = document.getElementById("input-slider-range-value-low"),
				n = document.getElementById("input-slider-range-value-high"),
				t = [e, n];
			noUiSlider.create(a, {
				start: [parseInt(e.getAttribute("data-range-value-low")), parseInt(n.getAttribute("data-range-value-high"))],
				connect: !0,
				range: {
					min: parseInt(a.getAttribute("data-range-value-min")),
					max: parseInt(a.getAttribute("data-range-value-max"))
				}
			}), a.noUiSlider.on("update", function (a, e) {
				t[e].textContent = a[e]
			})
		}
	}(),
	Scrollbar = function () {
		var a = $(".scrollbar-inner");
		a.length && a.scrollbar().scrollLock()
	}();