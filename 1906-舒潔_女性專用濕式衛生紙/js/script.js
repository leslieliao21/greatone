
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

    /*     # include
  ----------------------------------------- */

    // if (winW > 768) {
    //     $('._slick').slick({
    //         // mobileFirst: true,
    //         infinite: true,
    //         slidesToShow: 3,
    //         slidesToScroll: 1,
    //         responsive: [{
    //             breakpoint: 768,
    //             settings: "unslick"
    //         }]
    //     });
    // }
    var $this = {};
    var $main = $('.maincontainer');
    
    $('.btnX').on('click', function () {
        $('header').toggleClass('active');
    })
    // $('.lbX, .lbBg').on('click', function () {
    //     $('.lb').fadeOut();
    // })
    // $('.report .btnMore').on('click', function () {
    //     $('.doctorSay').fadeIn();
    // })

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

        // if (wdth > 768) {
        //     $('._slick').slick({
        //         // mobileFirst: true,
        //         infinite: true,
        //         slidesToShow: 3,
        //         slidesToScroll: 1,
        //         responsive: [{
        //             breakpoint: 768,
        //             settings: "unslick"
        //         }]
        //     });
        // }
    });
    // $('.buy').on('click', function () {
    //     fbq('init', '1873549686070900');
    //     fbq('track', 'Purchase');
    // })
    // $('.goConditions').on('click', function () {
    //     fbq('init', '2154662284804730');
    //     fbq('track', 'Lead');
    // })
    // $('.goProducts').on('click', function () {
    //     fbq('init', '2154662284804730');
    //     fbq('track', 'CompleteRegistration');
    // })
    // $('.goMedia').on('click', function () {
    //     fbq('init', '2154662284804730');
    //     fbq('track', 'AddPaymentInfo');
    // })
    // $('.goFan').on('click', function () {
    //     fbq('init', '2154662284804730');
    //     fbq('track', 'AddToCart');
    // })
    // $('.gogobuy').on('click', function () {
    //     fbq('init', '2154662284804730');
    //     fbq('track', 'AddToWishlist');
    // })

    $('.buy, .gogobuy').on('click', function () {
        gtag('event', 'click-ga', {
            'event_category':'england-ladywipe-button_201806','event_action':'01-click-buy','event_label':'01-click-ladywipe'
        });
        console.log("SEND GA");
        fbq('trackSingle', '265214090710692', 'Purchase');

        console.log("SEND FBQ");
        goog_report_conversion();
        console.log("SEND GOOG");
    })

    $('.menuList').on('click', function(){
        $('header').removeClass('active');
    })

    $(".goTop").on('click',function (){
        $('html, body').animate({  
            scrollTop: 0
        }, 500);  
    });
}


// KARL 20180320-------

// $(window).scroll(function () {
//     var scrollVal = $(this).scrollTop();
//     var scrollBottom = $(this).scrollTop() + $(window).height();
//     var reportTop = $('.report .w1400').offset().top;
//     var reportArea = $('.report .w1400').offset().top + $('.report .w1400').height() + $(window).height()+500;
//     // console.log(scrollBottom)

//     if (scrollBottom >= reportTop && scrollBottom <= reportArea){
//         $('.buy').fadeOut();
//     }else{
//         $('.buy').fadeIn();
//     }

// });

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
    flipBlock.forEach(function(el){
        $("#"+el).appendTo($("li[data-condition='"+el+"']"));
    })
}

$(function () {
    var main = myScript();
    

    windowEvents();

    var realclick = true;

    $(".qaCollapseWrapper").load("includes/faq-txt.html"); 

    $('.qaWrapper').on('click', function(){   
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
       
        if($(this).hasClass('active')){
            //load content html
            $.ajax({
                url: "./includes/occasion-txt-"+condition+".html",
                // data: {},
                type: "GET",
                dataType: "html",
                success: function (data) {
                    $('#'+condition).html(data);
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
        }else{
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
                'scrollTop': $(this).offset().top-headerTopH-10
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