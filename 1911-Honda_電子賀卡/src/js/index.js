var $body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body');
var indexLeft = $(".indexBottomLeft");
var indexRight = $(".indexBottomRight");
var indexCar = $(".indexCar");
var indexTop = $(".indexTop");
var indexSlogan = $(".indexSlogan");
var indexBtn = $(".indexBtn");
var confettiBg = $(".confettiBg");
var firework = $(".firework");
var confettiA = $(".confettiA");
var confettiB = $(".confettiB");
var confettiC = $(".confettiC");
var confettiD = $(".confettiD");
var confettiE = $(".confettiE");
var confettiF = $(".confettiF");
var confettiG = $(".confettiG");
var confettiH = $(".confettiH");
var confettiI = $(".confettiI");
var confettiJ = $(".confettiJ");
var confettiK = $(".confettiK");
var checker = $(".indexBottom .checker");
var checker1 = $(".checker1");
var checker2 = $(".checker2");
var checker3 = $(".checker3");
var checkerBack = $(".checkerBack");
var options = {
    infinite: false,
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: false,
    autoplaySpeed: 4000,
    centerMode: true,
    centerPadding: '250px',
    variableWidth: true,
    dots: true,
    arrows: true,
    responsive: [{
        breakpoint: 640,
        settings: {
            slidesToShow: 1,
            centerPadding: '20px',
            variableWidth: false,
        }
    }]
}

includesLoader({
    callback: mainFunc,
    includesList: [{
        target: ".page-header",
        fileName: "header"
    }]
});

$(function () {
    $(".header-nav li").click(function () {
        removeNav();
    });

    $('#goTop').click(function () {
        $('html,body').stop().animate({
            scrollTop: 0
        }, 'slow');
        return false;
    });


    $("#typeName").on("keyup", function (e) {
        var $name = $(this).val();
        $('.name').html($name);
    });

    if (device.ios()) {
        $('.showios').show();
        $('.downloadBtn').hide();
    }

    document.addEventListener("scroll", _scroll);

    /*confetti*/
    // TweenMax.set("img", {
    //     xPercent: "-50%",
    //     yPercent: "-50%"
    // })

    // var total = Random(8) + 3;
    // var w = $(".confetti").width();
    // var h = $(".confetti").height();

    // for (var i = 0; i < total; i++) {
    //     $(".confetti").append('<div class="dot"></div>')
    //     TweenMax.set($(".dot")[i], {
    //         x: Random(w),
    //         y: random(-100, 100),
    //         opacity: 1,
    //         scaleX: Random(0.5) + 0.3,
    //         scaleY: Random(0.5) + 0.3,
    //         background: "url('images/confetti" + random(2, 4) + ".png') no-repeat"
    //     });
    //     animm($(".dot")[i]);
    // }

    // function animm(elm) {
    //     TweenMax.to(elm, Random(3) + 4, {
    //         y: h,
    //         ease: Linear.easeNone,
    //         repeat: -1,
    //         delay: -5
    //     });
    //     TweenMax.to(elm, Random(3) + 1, {
    //         x: '+=70',
    //         repeat: -1,
    //         yoyo: true,
    //         ease: Sine.easeInOut
    //     })
    //     TweenMax.to(elm, Random(2) + 1, {
    //         scaleX: 0.8,
    //         rotation: Random(250),
    //         repeat: -1,
    //         yoyo: true,
    //         ease: Sine.easeInOut
    //     })
    //     TweenMax.to(elm, Random(8) + 0.5, {
    //         opacity: 0,
    //         repeat: -1,
    //         yoyo: true,
    //         ease: Sine.easeInOut
    //     })
    // };

    // function Random(max) {
    //     return Math.random() * max;
    // }

    // function random(min, max) {
    //     return min + Math.floor(Math.random() * (max - min));
    // }


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

    $(".header-nav li").siblings().removeClass('active');
    $(".header-nav li").eq(menuNum).addClass('active');

    $header = $(".page-header"), $hamburger = $(".hamburger"), $headerNav = $(".header-nav")
    $hamburger.on("click", function (e) {
        // e.preventDefault(), e.stopPropagation()
        $header.toggleClass(PAGE_HEADER_ACTIVE)
        $header.hasClass(PAGE_HEADER_ACTIVE) ? $headerNav.css('opacity', '1') : $headerNav.css('opacity', '0')
    })

    $('.menuOverlay').on("click", function () {
        $header.hasClass(PAGE_HEADER_ACTIVE) && ($headerNav.css('opacity', '0'), $header.removeClass(PAGE_HEADER_ACTIVE))
    })

    if ($('._slick').length > 0) {

        $('._slick').on('init', function () {});

        $('._slick').slick(options);
    }

    TweenMax.from(indexLeft, 0.4, {
        x: -600,
        // y: 100,
        opacity: 0,
        autoAlpha: 0,
        ease: Power0.easeNone,
        delay: 0.4
    });
    TweenMax.from(indexRight, 0.4, {
        x: 600,
        y: 650,
        opacity: 0,
        autoAlpha: 0,
        ease: Power0.easeNone,
        delay: 0.4
    });

    TweenMax.from(indexTop, 1.2, {
        y: 10,
        opacity: 0,
        autoAlpha: 0,
        delay: 1
    });
    TweenMax.from(indexCar, 0.4, {
        y: -80,
        x: 200,
        opacity: 0,
        autoAlpha: 0,
        ease: Back.easeOut,
        delay: 1.8
    });

    var checkerAni = function() {
        TweenMax.staggerFrom(checker, 2, {
            x: 500,
            y: 300,
            opacity: 0,
            autoAlpha: 0,
            delay: 0.5,
          ease: Elastic.easeOut.config(1, 0.75),
          onComplete: dnone
        }, 0.1);
      };
      
      checkerAni();


    TweenMax.to(checkerBack, 0.4, {
        // x: 4,
        // y: 2,
        opacity: 1,
        autoAlpha: 1,
        yoyo: true,
        ease: Power0.easeNone,
        delay: 2.5
    });

    function dnone(){
        setTimeout(function(){
            TweenMax.to(checker1, 0.2, {
                opacity: 0,
                autoAlpha: 0,
            });
        },2000);
        
    }

    TweenMax.from(indexSlogan, 0.3, {
        x: -500,
        scale: 3,
        opacity: 0,
        autoAlpha: 0,
        ease: Back.easeOut,
        delay: 2.5
    });
    
    TweenMax.from(confettiBg, 2.6, {
        y: -15,
        // scale: 0.95,
        opacity: 0,
        autoAlpha: 0,
        ease: Sine.easeOut,
        delay: 2.5
    });
    TweenMax.from(confettiA, 2.6, {
        y: -25,
        scale: 0.95,
        opacity: 0,
        autoAlpha: 0,
        ease: Sine.easeOut,
        delay: 2.5
    });
    TweenMax.from(confettiB, 2.6, {
        y: -20,
        scale: 0.95,
        opacity: 0,
        autoAlpha: 0,
        ease: Sine.easeOut,
        delay: 2.5
    });
    TweenMax.from(confettiC, 2.6, {
        y: -25,
        scale: 0.95,
        opacity: 0,
        autoAlpha: 0,
        ease: Sine.easeOut,
        delay: 2.5
    });
    TweenMax.from(confettiD, 2.6, {
        y: -20,
        scale: 0.95,
        opacity: 0,
        autoAlpha: 0,
        ease: Sine.easeOut,
        delay: 2.5
    });
    TweenMax.from(confettiE, 2.6, {
        y: -23,
        scale: 0.95,
        opacity: 0,
        autoAlpha: 0,
        ease: Sine.easeOut,
        delay: 2.5
    });
    TweenMax.from(confettiF, 2.6, {
        y: -28,
        scale: 0.95,
        opacity: 0,
        autoAlpha: 0,
        ease: Sine.easeOut,
        delay: 2.5
    });
    TweenMax.from(confettiG, 2.6, {
        y: -20,
        scale: 0.95,
        opacity: 0,
        autoAlpha: 0,
        ease: Sine.easeOut,
        delay: 2.5
    });
    TweenMax.from(confettiH, 2.6, {
        y: -25,
        scale: 0.95,
        opacity: 0,
        autoAlpha: 0,
        ease: Sine.easeOut,
        delay: 2.5
    });
    TweenMax.from(confettiI, 2.6, {
        y: -22,
        scale: 0.95,
        opacity: 0,
        autoAlpha: 0,
        ease: Sine.easeOut,
        delay: 2.5
    });
    TweenMax.from(confettiJ, 2.6, {
        y: -22,
        scale: 0.95,
        opacity: 0,
        autoAlpha: 0,
        ease: Sine.easeOut,
        delay: 2.5
    });
    TweenMax.from(confettiK, 2.6, {
        y: -25,
        scale: 0.95,
        opacity: 0,
        autoAlpha: 0,
        ease: Sine.easeOut,
        delay: 2.5
    });
    
    TweenMax.from(firework, 1, {
        y: 5,
        scale: 0.98,
        opacity: 0,
        autoAlpha: 0,
        ease: Sine.easeOut,
        delay: 2.5
    });

    var TL = new TimelineMax();

    TL.fromTo(indexBtn, 0.5, {
        scale: 0,
    },{
        scale: 0.9,
        delay: 3.5,
        ease: Back.easeOut,
        onComplete: onComplete
    });

    function onComplete() {
        // setTimeout(function(){
        //     var shake = new TimelineMax({repeat:-1, repeatDelay:2});
        //     shake.from(indexBtn, 0.3, {css:{left: '50.8%'}, repeat:7, yoyo:true, ease: Bounce.easeInOut})
        // },1800);
        TweenMax.fromTo(indexBtn, 0.45, { scale: 0.9 }, { scale: 1, repeat: -1, yoyo: true, ease: Power1.easeInOut });
    }

    windowEvents();
    transitionThenRemove({
        dom: $(".page-loading"),
        duration: DURATION.SLOW,
        callback: function () {
            console.log("%cBuild Completed!", logSafeStyle)
        }
    });
}

function scrollto(anchor) {
    // var someWhere = $(this).data("scrollto");
    // alert(someWhere)
    // $body.stop().animate({
    //     scrollTop: $('.' + someWhere).offset().top - 62
    // },500);
    $body.stop().animate({
        scrollTop: $('.' + anchor).offset().top - 62
    }, 500);
}

function windowEvents() {
    $win.on("resize", _resize).resize()
}

function _resize() {
    getSize(), 1024 < winW ? resizePC() : resizeMB()
    // 1360 < winW ? '' : sponsorMB()
    // 800 <= winH ? scrollTopReload() : null
}

function getSize() {
    winW = $win.outerWidth(), winH = $win.outerHeight(), headerTopH = $(".header-top").outerHeight(), headerNavH = $(".header-nav").outerHeight(), footerH = $("footer").outerHeight()
}

var removeNav = function () {
    $header.removeClass(PAGE_HEADER_ACTIVE);
    $headerNav.css('opacity', '0');
}

function resizePC() {
    // headerInit("flex");
    $("main").css({
        paddingTop: headerTopH
    })
    // $(window).off("scroll", removeNav);
}


function resizeMB() {
    // headerInit("flex");
    $("main").css({
        paddingTop: headerTopH
    })
    // $(window).scroll(removeNav)
}

function headerInit(e) {
    $header.removeClass(PAGE_HEADER_ACTIVE)
    $headerNav.css({
        display: e
    })
}

listenImagesLoading($("html, body"));

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