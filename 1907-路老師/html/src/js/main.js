var $win = $(window);
var winW = $win.width();
var winH = $win.height();
var pos = $(window).scrollTop();

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

function mainFunc() {

    windowEvents();

    transitionThenRemove({
        dom: $("#loading"),
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
    getSize(), 769 < winW ? resizePC() : resizeMB()
}

function getSize() {
    winW = $win.outerWidth()
}

function resizePC() {
    var headerH = $('.page-header').outerHeight();

    $('main').css({
        'padding-top': headerH
    });

    $("#indexSignWrapper").before($("#indexNewsWrapper"));
    // var footerDH = footerH-30;
    // headerInit("flex"), $(".main-container").css({
    //     marginTop: headerTopH
    // }),$(".header-nav").css({
    //     marginTop: 0
    // }), $(".game-page main").css({
    //     'height': 'calc(100vh - ' +footerDH+ 'px)'
    // }),$(window).off("scroll", scrollHandler)
}

function resizeMB() {
    var headerH = $('.page-header').outerHeight();

    $('main').css({
        'padding-top': headerH
    });

    $("#indexSignWrapper").after($("#indexNewsWrapper"));
    // headerInit("none"), $(".main-container, .header-nav").css({
    //     marginTop: headerTopH
    // }), $(".game-page main").css({
    //     'height': 'calc(100vh - ' +footerH+ 'px)'
    // }),$(window).scroll(scrollHandler)
}

listenImagesLoading($("html, body"), mainFunc);

function removeCollapseIn() {
    $('.navbar-toggle').removeClass('collapsed');
    $('.collapse').removeClass('in')
}


$(function () {

    $('main').click(function (e) {
        removeCollapseIn();
    });

    $(window).scroll(function () {
        removeCollapseIn();
    });

    $('.carousel').carousel({
        interval: 7000
    });

    $(".carousel").on("touchstart", function (event) {
        var xClick = event.originalEvent.touches[0].pageX;
        $(this).one("touchmove", function (event) {
            var xMove = event.originalEvent.touches[0].pageX;
            if (Math.floor(xClick - xMove) > 5) {
                $(this).carousel('next');
            } else if (Math.floor(xClick - xMove) < -5) {
                $(this).carousel('prev');
            }
        });
        $(".carousel").on("touchend", function () {
            $(this).off("touchmove");
        });
    });

    $('.txtOverflow').each(function(e){
        var $txtLength = $(this).html().length;

        console.log($txtLength);

        if($txtLength >= 100){
            $(this).siblings('.expandBtn').show();
        }else{
            $(this).siblings('.expandBtn').hide();
        }
    });


    $('.expandBtn').click(function (e) {
        if($(this).siblings('.txtOverflow').hasClass('txtOverflow')){
            $(this).siblings('.txtOverflow').removeClass('txtOverflow');
            $(this).html("更少");
        }else{
            $(this).siblings('p').addClass('txtOverflow');
            $(this).html("更多");
        }
    });

    // Create the dropdown base
    $("<select />").appendTo(".hasSignIn");

    // Create default option
    $("<option />", {
        "selected": "selected",
        "value": "",
        "hidden": "",
        "text": "路老師專區功能"
    }).appendTo(".hasSignIn select");

    // Populate dropdown with menu items
    $(".hasSignIn a").each(function () {
        var el = $(this);
        $("<option />", {
            "value": el.attr("href"),
            "text": el.text()
        }).appendTo(".hasSignIn select");
    });

    // $('.hasSignIn select').addClass('form-control');
    $('.hasSignIn select > option').eq(0).hide();


    // To make dropdown actually work
    $(".hasSignIn select").change(function () {
        window.location = $(this).find("option:selected").val();
    });

    // $(".goTop").on('click', function () {
    //     $('html, body').animate({
    //         scrollTop: 0
    //     }, 500);
    // });

    $('.faqBox').on('click', function () {
        $(this).find('.answerBar').slideToggle();
        $(this).toggleClass('clicked');

        $(this).siblings().find('.answerBar').slideUp();
        $(this).siblings().removeClass('clicked');
    });

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