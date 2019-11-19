// var $win = $(window);
// var winW = $win.width();
// var winH = $win.height();
// var pos = $(window).scrollTop();

var url = location.search;
var $body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body');
var options = {
    infinite: true,
    slidesToShow: 6,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 4000,
    
    dots: true,
    arrows: false,
    responsive: [
      {
        breakpoint: 1360,
        settings: {
          slidesToShow: 5,
          slidesToScroll: 5,
        }
      },
      {
        breakpoint: 900,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
        }
      }
    ]
}

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
    $(".header-nav li").click(function () {
        removeNav();
    });

    if(url.indexOf("?") != -1){
        var webAnchor = url.split("?")[1];
        setTimeout(function() {
            scrollto(webAnchor)
        }, 250);
    }

    $('#goTop').click(function () {
        $('html,body').stop().animate({
            scrollTop: 0
        }, 'slow');
        return false;
    });

    // 滾到錨點
    $('._scrollto').on('click', function(){
        var someWhere = $(this).data("scrollto");
        scrollto(someWhere);
    })

    document.addEventListener("scroll", _scroll);

    $('.playlist .switchVideo').on('click', function(){
        var vid = $(this).data('vid');
        $('.playlist .switchVideo').removeClass('active');
        $(this).addClass('active');
        $('#mainIframe').attr("src","https://www.youtube.com/embed/"+vid+"?rel=0&autoplay=1");
    });


    // 首頁時刻表被拖動時-提示消失
    $(".indexTimetableSection ._scrollx").scroll(function () {
        $('.guidanceIcon').addClass("_draged");
    })


    // 主題活動-slick
    $('.actSlick').each(function(){
        var imgNum = $(this).find('img').length;
        if(imgNum > 1){
            $(this).slick({
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 4000,
                
                dots: true,
                arrows: false
            });
        }
    })


    // 四大主題
    if( $('.theme-page').length > 0 ){


        // 文字收放
        $('.theme-page .themeIntroSection .txt').each(function() {
            var $thisH = $(this).height() + 48;
            $(this).attr('data-txth', $thisH );
        })

        if( $(window).width() > 768 ){
            $('.theme-page .themeIntroSection .txt').css("height","20rem").addClass('_closed');
        }else{
            $('.theme-page .themeIntroSection .txt').css("height","15rem").addClass('_closed');
        }
        
        $('.theme-page .themeIntroSection .txt').each(function() {
            var $thisH = $(this).height() + 48;
            $(this).attr('data-txtcloseh', $thisH );

            if( $(this).data("txth") == $(this).data("txtcloseh") ){
                $(this).children(".btnMore").hide();
            }
        })
        
        
        $('.theme-page .themeIntroSection .btnMore').on('click', function(){
            var $this = $(this).parent(".txt");
            if( $this.data("txth") != $this.data("txtcloseh") ){
                $(this).toggleClass('_active');
                if($(this).parent(".txt").hasClass('_closed')){
                    
                    $this.stop().animate({
                        height: $this.data("txth")
                    },100).removeClass('_closed');
        
                }else{
                    
                    $this.stop().animate({
                        height: $this.data("txtcloseh")
                    },100).addClass('_closed');
            
                }
            }
        })
    }

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

    $('.playlistWrap').mCustomScrollbar({
        scrollInertia: 500,
    });

    $header = $(".page-header"), $hamburger = $(".hamburger"), $headerNav = $(".header-nav")
    $hamburger.on("click", function (e) {
        // e.preventDefault(), e.stopPropagation()
        $header.toggleClass(PAGE_HEADER_ACTIVE)
        $header.hasClass(PAGE_HEADER_ACTIVE) ? $headerNav.css('left', '0') : $headerNav.css('left', '-300px')
    })

    $('.menuOverlay').on("click", function () {
        $header.hasClass(PAGE_HEADER_ACTIVE) && ($headerNav.css('left', '-300px'), $header.removeClass(PAGE_HEADER_ACTIVE))
    })

    // 主題活動錨點
    if( $('.activities-page').length > 0 ){

        // var $body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body');
    
        $('.anchorBtn').on('click', function (evt) {
            
            var aid = $(this).data("anchor");
            $body.stop().animate({
                scrollTop: $('#' + aid).offset().top
            },500);
            
        });
    }else{

        $('.anchorBtn').on('click', function (evt) {
            evt.preventDefault();
            
            var aid = $(this).data("anchor");
            parent.location.href = "activities.html" + "#" + aid;
            
        });

    }

    //是電腦版的話開啟放大鏡
    if(device.desktop()){
        $('img.magnify-image').magnify();
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

function scrollto(anchor){
    // var someWhere = $(this).data("scrollto");
    // alert(someWhere)
    // $body.stop().animate({
    //     scrollTop: $('.' + someWhere).offset().top - 62
    // },500);
    $body.stop().animate({
        scrollTop: $('.' + anchor).offset().top - 62
    },500);
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

var removeNav = function(){
    $header.removeClass(PAGE_HEADER_ACTIVE);
    $headerNav.css('left', '-300px');
}

// function scrollTopReload() {
//     $('html, body').animate({  
//         scrollTop: 0
//     }, DURATION.FAST); 
// }

function resizePC() {
    headerInit("flex")
    $(".header-nav").css({
        marginTop: 0
    })
    $(window).off("scroll", removeNav);

    if( $('.index-page').length > 0 ){
        // 首頁時刻表拖拉
        const slider = document.querySelector('._scrollx');
        let isDown = false;
        let startX;
        let scrollLeft;
    
        slider.addEventListener('mousedown', (e) => {
            isDown = true;
            slider.classList.add('active');
            startX = e.pageX - slider.offsetLeft;
            scrollLeft = slider.scrollLeft;
        });
        slider.addEventListener('mouseleave', () => {
            isDown = false;
            slider.classList.remove('active');
        });
        slider.addEventListener('mouseup', () => {
            isDown = false;
            slider.classList.remove('active');
        });
        slider.addEventListener('mousemove', (e) => {
            if(!isDown) return;
            e.preventDefault();
            const x = e.pageX - slider.offsetLeft;
            const walk = (x - startX) * 3; //scroll-fast
            slider.scrollLeft = scrollLeft - walk;
            // console.log(walk);
        });
    }

}


function resizeMB() {
    headerInit("block");

    $('.indexChannelBlock').on("click", function () {
        $(this).toggleClass('clicked');
        $(this).siblings().removeClass('clicked');
    })

    $(window).scroll(removeNav)
}


function sponsorMB(){
    $('._slick').on('init', function () {});

    $('._slick').slick(options);
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

