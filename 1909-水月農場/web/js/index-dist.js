'use strict';

// var $win = $(window);
// var winW = $win.width();
// var winH = $win.height();
// var pos = $(window).scrollTop();

var optionA = {
    lazyLoad: 'ondemand',
    infinite: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: false,
    // autoplaySpeed: 5000,

    dots: true,
    arrows: true
};
var optionB = {
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: false,
    // autoplaySpeed: 4000,
    centerMode: true,
    centerPadding: '220px',

    dots: true,
    arrows: true
};

var optionC = {
    lazyLoad: 'ondemand',
    infinite: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 5000,

    dots: true,
    arrows: false
};

includesLoader({
    callback: mainFunc,
    includesList: [{
        target: ".page-header",
        fileName: "header"
    }, {
        target: ".page-footer",
        fileName: "footer"
    }]
});

$(function () {
    // $(".header-nav li").click(function () {
    //     $(this).addClass('active');
    //     $(this).siblings().removeClass('active');
    // });

    $('.centerLocation a').click(function () {
        var mapSrc = $(this).data('map');
        $('.mapLocation > iframe').attr('src', mapSrc);
    });

    $('#goTop').click(function () {
        $('html,body').animate({
            scrollTop: 0
        }, 'slow');
        return false;
    });

    document.addEventListener("scroll", _scroll);
});

function _scroll() {
    var winTop = $(window).scrollTop();
    if (winTop >= 500) {
        $('#goTop').css('opacity', '1');
    } else {
        $('#goTop').css('opacity', '0');
    }
}

function mainFunc() {
    var menuNum = $('body').data('menu');

    $(".menu_nav > li").siblings().removeClass('active');
    $(".menu_nav > li").eq(menuNum).addClass('active');

    if ($('.about-page').length > 0) {
        // $('._slick').on('init', function () {});

        $('.slick-farm').slick(optionA);
        $('.slick-three').slick(optionB);
        $('.slick-infinite').slick(optionC);

        var itemLength = $('.slickVideo').find('.item').not('.slick-cloned').length;

        $('.slick-arrow').click(function () {
            for (var i = 1; i <= itemLength; i++) {

                var id = $('#player' + i);

                id[0].contentWindow.postMessage('{"event":"command","func":"' + 'pauseVideo' + '","args":""}', '*');
            }
        });
    }

    $('._slick').each(function (e) {
        var $slideLength = Math.floor($(this).find('.item').not('.slick-cloned').length);
        var $dotsWidth = 100 / $slideLength;

        $(this).find('.slick-dots li').outerWidth($dotsWidth + '%');

        if ($slideLength === 1) {
            $(this).find('.slick-dots').hide();
        }
    });

    $(".js-lb").lightbox();

    $header = $(".page-header"), $headerNav = $(".header-nav");

    // windowEvents();
    transitionThenRemove({
        dom: $(".page-loading"),
        duration: DURATION.SLOW
    });
}

function windowEvents() {
    $win.on("resize", _resize).resize();
}

function _resize() {
    getSize(), 1024 < winW ? resizePC() : resizeMB();
}

function getSize() {
    winW = $win.outerWidth(), winH = $win.outerHeight(), headerTopH = $(".header-top").outerHeight(), headerNavH = $(".header-nav").outerHeight(), footerH = $("footer").outerHeight();
}

// var scrollHandler = function(){
//     $header.removeClass(PAGE_HEADER_ACTIVE);
//     $headerNav.stop().slideUp(DURATION.FAST);
// }


function resizePC() {
    // headerInit("flex")
    // $(".header-nav").css({
    //     marginTop: 0
    // })
    // $(window).off("scroll", scrollHandler)
}

function resizeMB() {}
// headerInit("block");

// $(window).scroll(scrollHandler)


// function sponsorMB(){
//     $('._slick').on('init', function () {});

//     $('._slick').slick(options);
// }

// function headerInit(e) {
//     $header.removeClass(PAGE_HEADER_ACTIVE)
//     $headerNav.css({
//         display: e
//     })
// }

listenImagesLoading($("html, body"));

var $header = void 0,
    $headerNav = void 0,
    isFirstTime = !0,
    sectionPos = void 0,
    footerPos = void 0,
    headerTopH = void 0,
    headerNavH = void 0,
    headerTotalH = void 0,
    footerH = void 0,
    nowPos = void 0;

//prevent touch to hover
// function hasTouch() {
//     return 'ontouchstart' in document.documentElement ||
//         navigator.maxTouchPoints > 0 ||
//         navigator.msMaxTouchPoints > 0;
// }

// if (hasTouch()) { // remove all :hover stylesheets
//     try { // prevent exception on browsers not supporting DOM styleSheets properly
//         for (var si in document.styleSheets) {
//             var styleSheet = document.styleSheets[si];
//             if (!styleSheet.rules) continue;

//             for (var ri = styleSheet.rules.length - 1; ri >= 0; ri--) {
//                 if (!styleSheet.rules[ri].selectorText) continue;

//                 if (styleSheet.rules[ri].selectorText.match(':hover')) {
//                     styleSheet.deleteRule(ri);
//                 }
//             }
//         }
//     } catch (ex) {}
// }
//END
//# sourceMappingURL=index-dist.js.map