! function(e) {
    "use strict";

    function t() {
        if (e(".main-header").length) {
            var t = e(window).scrollTop(),
                a = e(".main-header"),
                o = e(".scroll-to-top");
            t >= 200 ? (a.addClass("fixed-header"), o.fadeIn(300)) : (a.removeClass("fixed-header"), o.fadeOut(300))
        }
    }
    if (t(), e(".main-header .navigation li.dropdown ul").length && (e(".main-header .navigation li.dropdown").append('<div class="dropdown-btn"><span class="fa fa-angle-down"></span></div>'), e(".main-header .navigation li.dropdown .dropdown-btn").on("click", function() {
            e(this).prev("ul").slideToggle(500)
        }), e(".main-header .navigation li.dropdown > a,.hidden-bar .side-menu li.dropdown > a").on("click", function(e) {
            e.preventDefault()
        })), e(".main-slider .tp-banner").length) {
        var a = e(".main-slider"),
            o = a.attr("data-start-height"),
            n = "'" + a.attr("data-slide-overlay") + "'";
        e(".main-slider .tp-banner").show().revolution({
            dottedOverlay: n,
            delay: 1e4,
            startwidth: 1200,
            startheight: o,
            hideThumbs: 600,
            thumbWidth: 80,
            thumbHeight: 50,
            thumbAmount: 5,
            navigationType: "bullet",
            navigationArrows: "0",
            navigationStyle: "preview3",
            touchenabled: "on",
            onHoverStop: "off",
            swipe_velocity: .7,
            swipe_min_touches: 1,
            swipe_max_touches: 1,
            drag_block_vertical: !1,
            parallax: "mouse",
            parallaxBgFreeze: "on",
            parallaxLevels: [7, 4, 3, 2, 5, 4, 3, 2, 1, 0],
            keyboardNavigation: "off",
            navigationHAlign: "center",
            navigationVAlign: "bottom",
            navigationHOffset: 0,
            navigationVOffset: 40,
            soloArrowLeftHalign: "left",
            soloArrowLeftValign: "center",
            soloArrowLeftHOffset: 0,
            soloArrowLeftVOffset: 0,
            soloArrowRightHalign: "right",
            soloArrowRightValign: "center",
            soloArrowRightHOffset: 0,
            soloArrowRightVOffset: 0,
            shadow: 0,
            fullWidth: "on",
            fullScreen: "off",
            spinner: "spinner4",
            stopLoop: "off",
            stopAfterLoops: -1,
            stopAtSlide: -1,
            shuffle: "off",
            autoHeight: "off",
            forceFullWidth: "on",
            hideThumbsOnMobile: "on",
            hideNavDelayOnMobile: 1500,
            hideBulletsOnMobile: "on",
            hideArrowsOnMobile: "on",
            hideThumbsUnderResolution: 0,
            hideSliderAtLimit: 0,
            hideCaptionAtLimit: 0,
            hideAllCaptionAtLilmit: 0,
            startWithSlide: 0,
            videoJsPath: "",
            fullScreenOffsetContainer: ""
        })
    }
    if (e(".lightbox-image").length && e(".lightbox-image").fancybox({
            openEffect: "fade",
            closeEffect: "fade",
            helpers: {
                media: {}
            }
        }), e(".count-box").length && e(".count-box").appear(function() {
            var t = e(this),
                a = t.find(".count-text").attr("data-stop"),
                o = parseInt(t.find(".count-text").attr("data-speed"), 10);
            t.hasClass("counted") || (t.addClass("counted"), e({
                countNum: t.find(".count-text").text()
            }).animate({
                countNum: a
            }, {
                duration: o,
                easing: "linear",
                step: function() {
                    t.find(".count-text").text(Math.floor(this.countNum))
                },
                complete: function() {
                    t.find(".count-text").text(this.countNum)
                }
            }))
        }, {
            accY: 0
        }), e(".progress-line").length && e(".progress-line").appear(function() {
            var t = e(this),
                a = t.data("width");
            e(t).css("width", a + "%")
        }, {
            accY: 0
        }), e(".sponsors-carousel-one").length && e(".sponsors-carousel-one").owlCarousel({
            loop: !0,
            margin: 30,
            nav: !0,
            smartSpeed: 500,
            autoplay: 4e3,
            navText: ['<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>'],
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                800: {
                    items: 3
                },
                1000: {
                    items: 3
                },
                1200: {
                    items: 3
                }
            }
        }), e(".sponsors-carousel-two").length && e(".sponsors-carousel-two").owlCarousel({
            loop: !0,
            margin: 30,
            nav: !0,
            smartSpeed: 500,
            autoplay: 4e3,
            navText: ['<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>'],
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                800: {
                    items: 4
                },
                1024: {
                    items: 4
                },
                1200: {
                    items: 5
                }
            }
        }), e(".team-carousel").length && e(".team-carousel").owlCarousel({
            loop: !0,
            margin: 30,
            nav: !0,
            smartSpeed: 500,
            autoplay: !0,
            navText: ['<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>'],
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                800: {
                    items: 2
                },
                1024: {
                    items: 3
                },
                1200: {
                    items: 3
                }
            }
        }), e(".testimonial-carousel-one .carousel-content").length && e(".testimonial-carousel-one .carousel-pager").length) {
        var i = e(".testimonial-carousel-one .carousel-content"),
            s = e(".testimonial-carousel-one .carousel-pager"),
            l = !1;
        i.owlCarousel({
            loop: !1,
            items: 1,
            margin: 0,
            nav: !1,
            navText: ['<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>'],
            dots: !1,
            autoplay: !0,
            autoplayTimeout: 5e3
        }).on("changed.owl.carousel", function(e) {
            l || (l = !1, s.trigger("to.owl.carousel", [e.item.index, 500, !0]), l = !1)
        }), s.owlCarousel({
            loop: !1,
            margin: 50,
            items: 1,
            nav: !0,
            navText: ['<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>'],
            dots: !1,
            center: !1,
            autoplay: !0,
            autoplayTimeout: 5e3,
            responsive: {
                0: {
                    items: 1,
                    autoWidth: !1
                },
                400: {
                    items: 1,
                    autoWidth: !1
                },
                600: {
                    items: 1,
                    autoWidth: !1
                },
                1000: {
                    items: 3,
                    autoWidth: !1
                },
                1200: {
                    items: 3,
                    autoWidth: !1
                }
            }
        }).on("click", ".owl-item", function() {
            i.trigger("to.owl.carousel", [e(this).index(), 500, !0])
        }).on("changed.owl.carousel", function(e) {
            l || (l = !0, i.trigger("to.owl.carousel", [e.item.index, 500, !0]), l = !1)
        })
    }

    function r() {
        e(".switch_menu").length && (e(".switch_btn button").on("click", function() {
            e(".switcher").toggleClass("open")
        }), e("#myonoffswitch").on("click", function() {
            e(".main-header").toggleClass("menu_fixed"), e(".main-header").toggleClass("fixed")
        }), e("#boxed").on("click", function() {
            e(".layout_changer").addClass("home_boxed")
        }), e("#full_width").on("click", function() {
            e(".layout_changer").removeClass("home_boxed")
        }), e(".bg1").on("click", function() {
            e(".home_boxed").addClass("bg1"), e(".home_boxed").removeClass("bg2 bg3 bg4")
        }), e(".bg2").on("click", function() {
            e(".home_boxed").addClass("bg2"), e(".home_boxed").removeClass("bg1 bg3 bg4")
        }), e(".bg3").on("click", function() {
            e(".home_boxed").addClass("bg3"), e(".home_boxed").removeClass("bg2 bg1 bg4")
        }), e(".bg4").on("click", function() {
            e(".home_boxed").addClass("bg4"), e(".home_boxed").removeClass("bg2 bg3 bg1")
        }), e("#styleOptions").styleSwitcher({
            hasPreview: !0,
            fullPath: "css/custom/",
            cookie: {
                expires: 30,
                isManagingLoad: !0
            }
        }))
    }

    function c() {
        (e(".masonary-layout").length && e(".masonary-layout").isotope({
            layoutMode: "masonry"
        }), e(".post-filter").length && e(".post-filter li").children("span").click(function() {
            var t = e(this),
                a = t.parent().attr("data-filter");
            return e(".post-filter li").children("span").parent().removeClass("active"), t.parent().addClass("active"), e(".filter-layout").isotope({
                filter: a,
                animationOptions: {
                    duration: 500,
                    easing: "linear",
                    queue: !1
                }
            }), !1
        }), e(".post-filter.has-dynamic-filter-counter").length) && e(".post-filter.has-dynamic-filter-counter").find("li").each(function() {
            var t = e(this).data("filter");
            console.log(t);
            var a = e(".gallery-content").find(t).length;
            e(this).children("span").append('<span class="count"><b>' + a + "</b></span>")
        })
    }
    if (e(".single-item-carousel").length && e(".single-item-carousel").owlCarousel({
            loop: !0,
            mouseDrag: !0,
            margin: 30,
            nav: !1,
            smartSpeed: 1500,
            autoplay: !1,
            responsive: {
                0: {
                    items: 1
                },
                992: {
                    items: 2
                },
                1200: {
                    items: 2
                }
            }
        }), e(".gallery-carousel").length && e(".gallery-carousel").owlCarousel({
            loop: !0,
            mouseDrag: !0,
            margin: 0,
            nav: !0,
            smartSpeed: 700,
            autoplay: 4e3,
            navText: ['<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>'],
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                800: {
                    items: 2
                },
                1024: {
                    items: 3
                },
                1200: {
                    items: 3
                },
                1400: {
                    items: 3
                }
            }
        }), e(".accordion-box").length && e(".accordion-box").on("click", ".acc-btn", function() {
            var t = e(this).parents(".accordion-box"),
                a = e(this).parents(".accordion");
            if (!0 !== e(this).hasClass("active") && e(".accordion .acc-btn").removeClass("active"), e(this).next(".acc-content").is(":visible")) return !1;
            e(this).addClass("active"), e(t).children(".accordion").removeClass("active-block"), e(t).find(".accordion").children(".acc-content").slideUp(300), a.addClass("active-block"), e(this).next(".acc-content").slideDown(300)
        }), e("#contact-form").length && e("#contact-form").validate({
            rules: {
                username: {
                    required: !0
                },
                email: {
                    required: !0,
                    email: !0
                },
                subject: {
                    required: !0
                },
                message: {
                    required: !0
                }
            }
        }), e(".scroll-to-target").length && e(".scroll-to-target").on("click", function() {
            var t = e(this).attr("data-target");
            e("html, body").animate({
                scrollTop: e(t).offset().top
            }, 1500)
        }), e(".tool_tip").length && e(".tool_tip").tooltip(), e(".quantity-spinner").length && e("input.quantity-spinner").TouchSpin({
            verticalbuttons: !0
        }), e(".range-slider-price").length) {
        var d = document.getElementById("range-slider-price");
        noUiSlider.create(d, {
            start: [30, 300],
            limit: 1e3,
            behaviour: "drag",
            connect: !0,
            range: {
                min: 10,
                max: 500
            }
        });
        var u = document.getElementById("min-value-rangeslider"),
            f = document.getElementById("max-value-rangeslider");
        d.noUiSlider.on("update", function(e, t) {
            (t ? f : u).value = e[t]
        })
    }(e(".prod-tabs .tab-btn").length && e(".prod-tabs .tab-btn").on("click", function(t) {
        t.preventDefault();
        var a = e(e(this).attr("href"));
        e(".prod-tabs .tab-btn").removeClass("active-btn"), e(this).addClass("active-btn"), e(".prod-tabs .tab").fadeOut(0), e(".prod-tabs .tab").removeClass("active-tab"), e(a).fadeIn(500), e(a).addClass("active-tab")
    }), e(".wow").length) && new WOW({
        boxClass: "wow",
        animateClass: "animated",
        offset: 0,
        mobile: !0,
        live: !0
    }).init();
    e(window).on("ready", function() {
        r()
    }), e(window).on("scroll", function() {
        ! function() {
            if (e(".main-header").length) {
                var t = e(".main-header");
                e(window).scrollTop() >= 265 ? t.addClass("fixed-header") : t.removeClass("fixed-header")
            }
        }(), t()
    }), e(window).on("load", function() {
        e(".preloader").length && e(".preloader").delay(200).fadeOut(500), r(), c()
    }), e(window).on("resize", function() {
        c()
    })
}(window.jQuery);