"use strict";

var rellax = new Rellax('.rellax');

//prevent touch to hover
function hasTouch() {
    return 'ontouchstart' in document.documentElement
           || navigator.maxTouchPoints > 0
           || navigator.msMaxTouchPoints > 0;
}

if (hasTouch()) { // remove all :hover stylesheets
    try { // prevent exception on browsers not supporting DOM styleSheets properly
        for (var si in document.styleSheets) {
            var styleSheet = document.styleSheets[si];
            if (!styleSheet.rules) continue;

            for (var ri = styleSheet.rules.length - 1; ri >= 0; ri--) {
                if (!styleSheet.rules[ri].selectorText) continue;

                if (styleSheet.rules[ri].selectorText.match(':hover')) {
                    styleSheet.deleteRule(ri);
                }
            }
        }
    } catch (ex) {}
}
//END

var c, currentScrollTop = 0,
    navbar = $('header'),
    newsbtn = $('.btn_news');

$(window).scroll(function () {
    var a = $(window).scrollTop();
    var b = navbar.height();

    currentScrollTop = a;

    if (c < currentScrollTop && a > b + b) {
        navbar.css({
            marginTop: -headerTopH
        });
        if (device.mobile()) {
            newsbtn.css({
                marginRight: -88
            });
        }
    } else if (c > currentScrollTop && !(a <= b)) {
        navbar.css({
            marginTop: 0
        });
        if (device.mobile()) {
            newsbtn.css({
                marginRight: 0
            });
        }
    }
    c = currentScrollTop;
});


$(function() {
    $(".header-nav li").click(function () {
        $(this).find('a').addClass('active');
        $(this).siblings().find('a').removeClass('active');
    });
});

function mainFunc() {
    
    $header = $(".page-header"), $hamburger = $(".hamburger"), $headerNav = $(".header-nav ul"),windowEvents(),  $hamburger.on("click", function (e) {
        e.preventDefault(), e.stopPropagation(), $header.toggleClass(PAGE_HEADER_ACTIVE), $header.hasClass(PAGE_HEADER_ACTIVE) ? $headerNav.stop().slideDown(DURATION.STD) : $headerNav.stop().slideUp(DURATION.STD)
    }), $doc.on("click", function () {
        $header.hasClass(PAGE_HEADER_ACTIVE) && ($headerNav.stop().slideUp(DURATION.STD), $header.removeClass(PAGE_HEADER_ACTIVE))
    }), 
    $("._lb").lightbox(function () {});
     
    
     transitionThenRemove({
        dom: $(".page-loading"),
        duration: DURATION.STD,
        callback: function () {
            console.log("%cBuild Completed!", logSafeStyle)
        }
    });
}

function windowEvents() {
    $win.on("resize", _resize).resize()
}

function _resize() {
    getSize(), 1024 < winW ? resizePC() : resizeMB()
    // if (device.mobile() || device.tablet()) {
    //     resizeMB()
    // }else{
    //     resizePC()
    // }
}

function getSize() {
    winW = $win.outerWidth(), winH = $win.height(), headerTopH = $(".header-top").outerHeight(), headerNavH = $(".header-nav").outerHeight()
}

function resizePC() {
    headerInit("flex"), $(".main-container").css({
        marginTop: headerTopH
    }), $(".header-nav").css({
        marginTop: 0
    }), headerTotalH = headerTopH
}

function resizeMB() {
    
    $(window).scroll(function () {
        $header.removeClass(PAGE_HEADER_ACTIVE);
        $headerNav.stop().slideUp(DURATION.FAST);
    });
    headerInit("none"), $(".main-container, .header-nav").css({
        marginTop: headerTopH
    }), headerTotalH = headerTopH
}

function headerInit(e) {
    $header.removeClass(PAGE_HEADER_ACTIVE), $headerNav.css({
        display: e
    })
}

// function getSectionPos() {
//     sectionPos = [], $.each($(".anchor"), function (e, o) {
//         sectionPos.push(Math.floor($(o).offset().top))
//     })
// }

// function _scroll() {
//     getPos(), setNavigationHint()
// }

// function getPos() {
//     nowPos = {
//         x: $doc.scrollLeft(),
//         y: $doc.scrollTop(),
//         top: $doc.scrollTop() + headerTotalH + 1
//     }
// }

// function setNavigationHint() {
//     var e = $(".header-nav li"),
//         o = "active";
//     $.each(sectionPos, function (a, n) {
//         if (0 === a && nowPos.top < sectionPos[0] || nowPos.top >= footerPos) return e.removeClass(o), !1;
//         nowPos.top >= n && (e.removeClass(o), e.eq(a).addClass(o))
//     })
// }
// function loadHtml(){
//     $('.index-page header').load('includes/header_signout.html');
//     $('.member-page header').load('includes/header_signin.html');
// }
var $progressBar = $(".page-loading .progress-bar");
listenImagesLoading($("img"), mainFunc, function (e, o) {
    $progressBar.css({
        width: e + "%"
    })
});
var PAGE_HEADER_ACTIVE = "menuOpen",
    $header = void 0,
    $hamburger = void 0,
    $headerNav = void 0,
    isFirstTime = !0,
    sectionPos = void 0,
    footerPos = void 0,
    headerTopH = void 0,
    headerNavH = void 0,
    headerTotalH = void 0,
    nowPos = void 0;