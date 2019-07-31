var $win = $(window),
    winW = $win.width(),
    winH = $win.height(),
    _media = 1280,
    pos = $(window).scrollTop(),
    slickW = $(window).width() / 3.5;
    
var scrollLeaf = $('.scrollLeafWrapper');

var tweenLeaf = new TimelineMax({
    paused: true
});

tweenLeaf.fromTo(scrollLeaf, 1, {
    // y: -200,
    opacity: 0,
    autoAlpha: 0
}, {
    // y: 0,
    opacity: 1,
    autoAlpha: 1,
    ease: Back.easeIn,
    pause: true
});

var loading = function () {

    var $this = {};
    $this.removeLoading = function () {
        $('#loading').fadeOut(function () {
            $('#loading').remove();
            // 動態程式寫這 

        });
    };
    $this.loadfunc = function () {
        $('html, body').imagesLoaded(function () {
            $this.removeLoading();
        });
    };
    return $this;
};
var myScript = function () {

    var imagesLoaded = loading();
    imagesLoaded.loadfunc();

    var luggage = $('.mainLuggage');
    

    TweenMax.fromTo(luggage, 1.2, {
        x: 1500,
        opacity: 0,
        autoAlpha: 0
      }, {
        x: 0,
        opacity: 1,
        autoAlpha: 1,
        // delay: 0.2,
        ease: Back.easeIn,
        pause: true
      });

    $('._slick').slick({
        lazyLoad: 'progressive',
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: true,
        centerPadding: slickW +'px',
        autoplay: true,
        autoplaySpeed: 4000,
        dots: true,
        responsive: [
            {
              breakpoint: 999,
              settings: {
                centerPadding: '100px',
              }
            },
            {
              breakpoint: 768,
              settings: {
                centerPadding: '20px',
              }
            }

          ]
    });

    $(".goTop").on('click', function () {
        $('html, body').animate({
            scrollTop: 0
        }, 500);
    });

    $(window).scroll(function () {
        var winTop = $(window).scrollTop();
        var slideTop = $('.secD').offset().top;
        var slideHeight = $('.secD').outerHeight();
        var secCTop = $('.secC').offset().top;

        if(winW > 999){
            var scroll = $(window).scrollTop();
            if(scroll > pos) {
                tweenLeaf.play();
                if(winTop >= secCTop && winTop < slideTop + slideHeight / 3){
                    tweenLeaf.reverse();
                }else{
                    tweenLeaf.play();
                }
                
            } else {
                tweenLeaf.reverse();
            }            
        }
        pos = scroll;

    })

    /*   GA/FBQ等設定  */

    // $('.buy, .gogobuy').on('click', function () {
    //     fbq('init', '2154662284804730');
    //     fbq('track', 'Purchase');
    // })
    // $('.btn_buy_bottom').on('click', function () {
    //     fbq('init', '2154662284804730');
    //     fbq('track', 'CompleteRegistration');
    // })
    // $('.goConditions').on('click', function () {
    //     fbq('init', '2154662284804730');
    //     fbq('track', 'ViewContent');
    // })
    // $('.goDoctor').on('click', function () {
    //     fbq('init', '2154662284804730');
    //     fbq('track', 'Search');
    // })
    // $('.goProducts').on('click', function () {
    //     fbq('init', '2154662284804730');
    //     fbq('track', 'AddToCart');
    // })
    // $('.goMedia').on('click', function () {
    //     fbq('init', '2154662284804730');
    //     fbq('track', 'InitiateCheckout');
    // })
    // $('.goPurchase').on('click', function () {
    //     fbq('init', '2154662284804730');
    //     fbq('track', 'AddPaymentInfo');
    // })
    // $('.goQA').on('click', function () {
    //     fbq('init', '2154662284804730');
    //     fbq('track', 'Subscribe');
    // })
    // $('.goFan').on('click', function () {
    //     fbq('init', '2154662284804730');
    //     fbq('track', 'StartTrial');
    // })

    // $('._ga').on('click', function (e) {
    //     var evt_category = $(this).data('category');
    //     var evt_label = $(this).data('label');
    //     var href = $(this).attr('href');
    //     var target = $(this).attr('target');
        
    //     if (target != '_blank' && href && href != '#' && href != 'javascript:;') {
    //         e.preventDefault();
    //         ga('send', 'event', evt_category, 'click', evt_label, 1);
    //         // gtag('event', 'click-ga', {
    //         //     'event_category': evt,
    //         //     'event_action': '',
    //         //     'event_label': evt
    //         // });
    //         setTimeout(function () {
    //             location.href = href;
    //         }, 500);
    //     }else{
    //         ga('send', 'event', evt_category, 'click', evt_label, 1);
    //         // gtag('event', 'click-ga', {
    //         //     'event_category': evt,
    //         //     'event_action': '',
    //         //     'event_label': evt
    //         // });
    //     }
    //     console.log(evt_category, evt_label);
    // })

    // $('.buy, .gogobuy').on('click', function () {
    //     fbq('trackSingle', '265214090710692', 'Purchase');
    //     console.log("SEND FBQ");
    //     goog_report_conversion();
    //     console.log("SEND GOOG");
    //     GetCustomEvent();
    //     console.log("SEND BING");
    // })

}

// function windowEvents() {
//     $win.on("resize", _resize).resize()
// }

// function _resize() {
//     getSize(), 768 <= winW ? resizePC() : resizeMB()
// }

// function getSize() {
//     winW = $(window).outerWidth(), winH = $(window).height(), headerTopH = $("header").outerHeight()
// }

// function resizePC() {

// }

// function resizeMB() {

// }

$(function () {
    var main = myScript();

    // $(window).resize(function() {
    //     windowEvents();
    // });

});

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