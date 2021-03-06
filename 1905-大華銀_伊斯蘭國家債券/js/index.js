"use strict";

function mainFunc() {
    $header = $(".page-header"), $hamburger = $(".hamburger"), $headerNav = $(".header-nav ul"), windowEvents(), $hamburger.on("click", function (e) {
        e.preventDefault(), e.stopPropagation(), $header.toggleClass(PAGE_HEADER_ACTIVE), $header.hasClass(PAGE_HEADER_ACTIVE) ? $headerNav.stop().slideDown(DURATION.STD) : $headerNav.stop().slideUp(DURATION.STD)
    }), $doc.on("click", function () {
        $header.hasClass(PAGE_HEADER_ACTIVE) && ($headerNav.stop().slideUp(DURATION.STD), $header.removeClass(PAGE_HEADER_ACTIVE))
    }), $(".header-nav a").on("click", function (e) {
        e.preventDefault();
        var o = $(this).parent().index();
        $("html, body").stop().animate({
            scrollTop: sectionPos[o] - headerTotalH
        }, DURATION.NOR)
    }), transitionThenRemove({
        dom: $(".page-loading"),
        duration: DURATION.STD,
        callback: function () {
            console.log("%cBuild Completed!", logSafeStyle)
        }
    })
}

function windowEvents() {
    $win.on("resize", _resize).resize(), $win.on("scroll", _scroll).scroll()
}

function _resize() {
    getSize(), 768 < winW ? resizePC() : resizeMB(), footerPos = $(".page-footer").offset().top, getSectionPos()
}

function getSize() {
    winW = $win.width(), winH = $win.height(), headerTopH = $(".header-top").outerHeight(), headerNavH = $(".header-nav").outerHeight()
}

function resizePC() {
    headerInit("flex"), $(".main-container").css({
        marginTop: headerTopH + headerNavH
    }), headerTotalH = headerTopH + headerNavH
}

function resizeMB() {
    headerInit("none"), $(".main-container").css({
        marginTop: headerTopH
    }), headerTotalH = headerTopH
}

function headerInit(e) {
    $header.removeClass(PAGE_HEADER_ACTIVE), $headerNav.css({
        display: e
    })
}

function getSectionPos() {
    sectionPos = [], $.each($(".anchor"), function (e, o) {
        sectionPos.push(Math.floor($(o).offset().top))
    })
}

function _scroll() {
    getPos(), setNavigationHint()
}

function getPos() {
    nowPos = {
        x: $doc.scrollLeft(),
        y: $doc.scrollTop(),
        top: $doc.scrollTop() + headerTotalH + 1
    }
}

function setNavigationHint() {
    var e = $(".header-nav li"),
        o = "active";
    $.each(sectionPos, function (a, n) {
        if (0 === a && nowPos.top < sectionPos[0] || nowPos.top >= footerPos) return e.removeClass(o), !1;
        nowPos.top >= n && (e.removeClass(o), e.eq(a).addClass(o))
    })
}
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