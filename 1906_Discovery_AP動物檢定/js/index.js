"use strict";

var rellax = new Rellax('.rellax');

// includesLoader({
//     callback: mainFunc,
//     includesList: [{
//         target: ".page-header.header_signout",
//         fileName: "header_signout"
//     }, {
//         target: ".page-header.header_signin",
//         fileName: "header_signin"
//     }]
// });

//prevent touch to hover
function hasTouch() {
    return 'ontouchstart' in document.documentElement ||
        navigator.maxTouchPoints > 0 ||
        navigator.msMaxTouchPoints > 0;
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

//animate by scroll
var c, currentScrollTop = 0,
    navbar = $('header'),
    newsbtn = $('.btn_news'),
    footbar = $('footer'),
    indexbtn = $('.index-page .btn_challenge');

$(window).scroll(function () {
    var a = $(window).scrollTop();
    var b = navbar.height();
    var footerH = $("footer").outerHeight() -1;

    if ($(window).width() <= 640) {
        $('.index-page .secC').css({
            paddingBottom: footerH
        });
        if($(window).scrollTop() + $(window).outerHeight() >= $(document).outerHeight()-footerH) {
            indexbtn.css({
                bottom: footerH
            });
        }else if($(window).scrollTop() + $(window).outerHeight() < $(document).outerHeight()-footerH){
            indexbtn.css({
                bottom: 0
            });
        }
    }

    currentScrollTop = a;

    if (c < currentScrollTop && a > b + b) {
        // navbar.css({
        //     marginTop: -headerTopH
        // });
        if (device.mobile()) {
            newsbtn.css({
                marginRight: -88
            });
        }
    } else if (c > currentScrollTop && !(a <= b)) {
        // navbar.css({
        //     marginTop: 0
        // });
        if (device.mobile()) {
            newsbtn.css({
                marginRight: 0
            });
        }
    }
    c = currentScrollTop;
});
//END



$(function () {
    $(".header-nav li").click(function () {
        $(this).find('a').addClass('active');
        $(this).siblings().find('a').removeClass('active');
    });

    $(".challengeOptionBox.choose .yesnoOption .item, .challengeOptionBox.choose .abcOption .item").click(function () {
        $(this).addClass('selected');
        $(this).siblings().removeClass('selected');
    });

    // var gameIndex = $('.game-page .kv'),
    //     gameChallenge = $('.challengeWrapper'),
    //     tweenGameIndex = new TimelineMax({
    //         paused: true
    //     }),
    //     tweenGameChallenge = new TimelineMax({
    //         paused: true
    //     });
    // tweenGameIndex.to(gameIndex, 0.3, {
    //     css: {
    //       scale: 0,
    //       opacity: 0,
    //     },
    //     ease: Expo.easeOut,
    //     pause: true
    // });
    // tweenGameChallenge.fromTo(gameChallenge, 0.5, {
    //     css: {
    //       marginTop: -2000
    //     },
    //     opacity: 0,
    //     autoAlpha: 1
    //   }, {
    //     css: {
    //       marginTop: -50
    //     },
    //     opacity: 1,
    //     autoAlpha: 1,
    //     delay: 0.6,
    //     ease: Power2.easeOut
    // });

    // $('.btn_play').click(function () {
    //     tweenGameIndex.play();
    //     tweenGameChallenge.play();
    // });
    
      
});

function mainFunc() {

    $header = $(".page-header"), $hamburger = $(".hamburger"), $headerNav = $(".header-nav ul"), windowEvents(), $hamburger.on("click", function (e) {
            e.preventDefault(), e.stopPropagation(), $header.toggleClass(PAGE_HEADER_ACTIVE), $header.hasClass(PAGE_HEADER_ACTIVE) ? $headerNav.stop().slideDown(DURATION.STD) : $headerNav.stop().slideUp(DURATION.STD)
        }), $doc.on("click", function () {
            $header.hasClass(PAGE_HEADER_ACTIVE) && ($headerNav.stop().slideUp(DURATION.STD), $header.removeClass(PAGE_HEADER_ACTIVE))
        }),
        $("._lb").lightbox(function () {});


    transitionThenRemove({
        dom: $(".page-loading"),
        duration: DURATION.SLOW,
        callback: function () {
            console.log("%cBuild Completed!", logSafeStyle)
        }
    });
}

function windowEvents() {
    $win.on("resize", _resize).resize()
}

function _resize() {
    getSize(), 1024 < winW ? resizePC() : resizeMB(), 800 <= winH ? scrollTopReload() : null
}

function getSize() {
    winW = $win.outerWidth(), winH = $win.outerHeight(), headerTopH = $(".header-top").outerHeight(), headerNavH = $(".header-nav").outerHeight(), footerH = $("footer").outerHeight()
}

var scrollHandler = function(){
    $header.removeClass(PAGE_HEADER_ACTIVE);
    $headerNav.stop().slideUp(DURATION.FAST);
}

function scrollTopReload() {
    $('html, body').animate({  
        scrollTop: 0
    }, DURATION.FAST); 
}

function resizePC() {
    var footerDH = footerH-30;
    headerInit("flex"), $(".main-container").css({
        marginTop: headerTopH
    }),$(".header-nav").css({
        marginTop: 0
    }), $(".game-page main").css({
        'height': 'calc(100vh - ' +footerDH+ 'px)'
    }),$(window).off("scroll", scrollHandler)
}

function resizeMB() {
    
    headerInit("none"), $(".main-container, .header-nav").css({
        marginTop: headerTopH
    }), $(".game-page main").css({
        'height': 'calc(100vh - ' +footerH+ 'px)'
    }),$(window).scroll(scrollHandler)
}

function headerInit(e) {
    $header.removeClass(PAGE_HEADER_ACTIVE), $headerNav.css({
        display: e
    })
}
// var $progressBar = $(".page-loading .progress-bar");
listenImagesLoading($(".main-container, img"), mainFunc);
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
    footerH = void 0,
    nowPos = void 0;