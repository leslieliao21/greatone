var $win = $(window),
    winW = $win.width(),
    winH = $win.height(),
    _media = 1280;

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

    var $this = {};
    var $main = $('.maincontainer');

    $('.btnX').on('click', function () {
        $('header').toggleClass('active');
    })

    var wdth = $(window).width();
    if (wdth <= 768) {
        $('header').addClass('mMenu');
    }
    $(window).resize(function () {
        wdth = $(window).width();
        if (wdth <= 768) {
            $('header').addClass('mMenu');
        } else {
            $('header').removeClass('mMenu').removeClass('active');
        }

    });
    $('.buy, .gogobuy').on('click', function () {
        fbq('init', '2154662284804730');
        fbq('track', 'Purchase');
    })
    $('.btn_buy_bottom').on('click', function () {
        fbq('init', '2154662284804730');
        fbq('track', 'CompleteRegistration');
    })
    $('.goConditions').on('click', function () {
        fbq('init', '2154662284804730');
        fbq('track', 'ViewContent');
    })
    $('.goDoctor').on('click', function () {
        fbq('init', '2154662284804730');
        fbq('track', 'Search');
    })
    $('.goProducts').on('click', function () {
        fbq('init', '2154662284804730');
        fbq('track', 'AddToCart');
    })
    $('.goMedia').on('click', function () {
        fbq('init', '2154662284804730');
        fbq('track', 'InitiateCheckout');
    })
    $('.goPurchase').on('click', function () {
        fbq('init', '2154662284804730');
        fbq('track', 'AddPaymentInfo');
    })
    $('.goQA').on('click', function () {
        fbq('init', '2154662284804730');
        fbq('track', 'Subscribe');
    })
    $('.goFan').on('click', function () {
        fbq('init', '2154662284804730');
        fbq('track', 'StartTrial');
    })

    $('._ga').on('click', function (e) {
        var evt_category = $(this).data('category');
        var evt_label = $(this).data('label');
        var href = $(this).attr('href');
        var target = $(this).attr('target');
        
        if (target != '_blank' && href && href != '#' && href != 'javascript:;') {
            e.preventDefault();
            ga('send', 'event', evt_category, 'click', evt_label, 1);
            // gtag('event', 'click-ga', {
            //     'event_category': evt,
            //     'event_action': '',
            //     'event_label': evt
            // });
            setTimeout(function () {
                location.href = href;
            }, 500);
        }else{
            ga('send', 'event', evt_category, 'click', evt_label, 1);
            // gtag('event', 'click-ga', {
            //     'event_category': evt,
            //     'event_action': '',
            //     'event_label': evt
            // });
        }
        console.log("SEND GA", evt_category, evt_label);
    })

    $('.buy_gb').on('click', function () {
        var evt_category = $(this).data('category');
        var evt_label = $(this).data('label');

        window.uetq = window.uetq || [];
        window.uetq.push('event', 'purchasebuttonclick', {
            'event_category': evt_category,
            'event_label': evt_label,
            'event_value': '1'
        });
        console.log("SEND BING", evt_category, evt_label);

        gtag('event', 'conversion', {
            'event_category': evt_category,
            'event_action': 'click',
            'event_label': evt_label,
            'event_value': '1'
        });
        console.log("SEND goog", evt_category, evt_label);

        gtag_report_conversion();
    })

    $('.buy, .gogobuy').on('click', function () {
        fbq('trackSingle', '265214090710692', 'Purchase');
        console.log("SEND FBQ");
    })

    $('.menuList').on('click', function () {
        $('header').removeClass('active');
    })

    $(".goTop").on('click', function () {
        $('html, body').animate({
            scrollTop: 0
        }, 500);
    });
}

function windowEvents() {
    $win.on("resize", _resize).resize()
}

function _resize() {
    getSize(), 768 <= winW ? resizePC() : resizeMB()
}

function getSize() {
    winW = $(window).outerWidth(), winH = $(window).height(), headerTopH = $("header").outerHeight()
}

function resizePC() {
    $("section").eq(0).css({
        marginTop: 90
    })
}

function resizeMB() {
    $("section").eq(0).css({
        marginTop: headerTopH
    });

    //手機版occasion移位
    var flipBlock = ['office', 'excercise', 'period', 'pregnant', 'travel', 'gathering'];
    flipBlock.forEach(function (el) {
        $("#" + el).appendTo($("li[data-condition='" + el + "']"));
    })
}

$(function () {
    var main = myScript();


    windowEvents();

    var realclick = true;

    $(".qaCollapseWrapper").load("includes/faq-txt.html");

    $('.qaWrapper').on('click', function () {
        $(this).find('.arrow').toggleClass('rotate');
        $(this).next('.qaCollapseWrapper').slideToggle();
    })

    // window.onpopstate = function(event) {
    //     alert("urlchange");
    //     var id = '';


    //     realclick = false;
    //     if (location.hash != '') { // if has hash
    //         id = location.hash
    //         var hashid=id.replace("#","");
    //         alert(id);
    //         $('.conditionTxt').hide();
    //         $(id).show();
    //         $(".flip").removeClass('active');
    //         $("li[data-condition='" + hashid +"']").addClass('active');
    //     }
    //     realclick = true;

    //     // $('html, body').stop().animate({
    //     //     'scrollTop': $(id).parents().prev('ul').offset().top-100
    //     // });

    //   };

    $(".flip").on("click", function (event) {

        $(this).toggleClass('active');
        $(".flip").not(this).removeClass('active');
        $('.conditionTxt').hide();
        var condition = $(this).data('condition');
        var $title = $(this).data('title');
        // Use Pushstate to change the URL
        var stateObj = {};

        if ($(this).hasClass('active')) {
            //load content html
            $.ajax({
                url: "./includes/occasion-txt-" + condition + ".html",
                // data: {},
                type: "GET",
                dataType: "html",
                success: function (data) {
                    $('#' + condition).html(data);
                },
                error: function (xhr, status) {
                    alert("抱歉, 內容讀取錯誤!");
                }
            });

            $('#' + condition).show();
            // Check if browser supports PushState
            if (history.pushState) {
                var $title = $(this).data('title');
                history.pushState(stateObj, $title, "occasion-" + condition + ".html");
                document.title = $title;
            }
        } else {
            $('#' + condition).find('.loadCont').remove();
            $('#' + condition).hide();
            if (history.pushState) {
                var $title = $(this).data('title');
                history.pushState(stateObj, $title, "occasion.html");
                document.title = '私密處清潔 | 女性專用衛生紙 - 舒潔女性專用濕式衛生紙';
            }
        }

        wdth = $(window).width();
        if (wdth <= 768) {
            $('html, body').stop().animate({
                'scrollTop': $(this).offset().top - headerTopH - 10
            });
        }


    });

    // $(window).on('hashchange', function (e) {
    //     var id = '';

    //     realclick = false;
    //     if (location.hash != '') { // if has hash
    //         id = location.hash
    //         var hashid=id.replace("#","");
    //         $('.conditionTxt').hide();
    //         $(id).show();
    //         $(".flip").removeClass('active');
    //         $("li[data-condition='" + hashid +"']").addClass('active');
    //     }
    //     realclick = true;

    //     $('html, body').stop().animate({
    //         'scrollTop': $(id).parents().prev('ul').offset().top-100
    //     });

    // });

});