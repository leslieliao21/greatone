//@prepros-prepend _lazyload.js

var winW = $(window).width();
var winH = $(window).height();
var headerH = $('header').outerHeight();
var kvH = $('.kv').outerHeight();
var navH = $('.navBox').outerHeight();
var wWidth = $(window).width();
var $body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body');

$(document).ready(function () {
    windowEvent();
    
    $(window).resize(function() {
        windowEvent();
    });

    $body.bind('scroll mousedown wheel DOMMouseScroll mousewheel keyup touchmove', function (e) {
        if (e.which > 0 || e.type == "mousedown" || e.type == "mousewheel" || e.type == "touchmove") {
            $("html,body").stop();
        }
    }) 

    $(window).scroll(function () {
        var winTop = $(window).scrollTop();
        var headHeight = headerH + kvH;

        if(wWidth > 768){
            if (winTop >= headHeight) {
                $("body").addClass("stickyMe");
                $(".secA > .container").css('marginTop', navH);
            } else {
                $("body").removeClass("stickyMe");
                $(".secA > .container").css('marginTop', '0');
            }
        }else{
            $("body").removeClass("stickyMe");
        }

    })

    $('.navBtn').click(function (e) {
        var navH = $('.navBox').outerHeight();
        var aid = $(this).find('a').attr("href");

        if(wWidth > 768){
            $body.animate({
                scrollTop: $(aid).offset().top - navH -10
            });
            // e.preventDefault();
        }else{
            $("body").removeClass("mOpen");
            $(".menuOverlay").fadeOut();
            $body.animate({
                scrollTop: $(aid).offset().top - headerH
            });
            // e.preventDefault();
        }
        e.preventDefault();
        
    });


    $('.btnMenu').on('click', function () {
        // $('.navBox').toggleClass('active');
        $("body").toggleClass("mOpen");
    })

    $('.menuOverlay').on('click', function () {
        $("body").removeClass("mOpen");
    })


    //--------------------- imagesLoaded ---------------------//
    var removeLoading = function () {
        $('#loading').fadeOut(function () {
            $(this).remove();
        });
    };

    $('html, body').imagesLoaded(function () {
        removeLoading();
    });


    function windowEvent(){
        if(wWidth <= 768){
            $('body').css('paddingTop', headerH);
        }else{
            $('body').css('paddingTop', '0');
        }
    }
    
});


