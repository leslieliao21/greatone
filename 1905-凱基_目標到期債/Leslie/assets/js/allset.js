window.onbeforeunload = function () {
    window.scrollTo(0, 0);
  }
window.onload = function () {
    deviceSet();
    var countdown = 1000;

    setTimeout(function () {
        $('.loading').fadeOut();
    }, countdown);
}

$(function () {
    var BL;
    var sectopic = $('.secTopic');
    var headerHeight = $('header').outerHeight();
    var dashA = $('#secA .wrapper .dashlineA').find('.st0');
    var dashB = $('#secA .wrapper .dashlineB').find('.st0');
    var dashC = $('#secA .wrapper .dashlineC').find('.st0');
    var isAnimateA = $('#secA .wrapper').find('.isAnimated');
    var isAnimateB = $('#secB .wrapper').find('.isAnimated');
    var isAnimateC = $('#secC .wrapper').find('.isAnimated');
    var isAnimateC2 = $('#secC .wrapper .sec03_mainBlock').find('.isAnimated');
    var isAnimateE = $('#secE .wrapper').find('.isAnimated');
    var isAnimateF = $('#secF .wrapper').find('.isAnimated');
    var isAnimateG = $('#secG .wrapper .boxWrapperA .boxBtm ul li').find('.isAnimated');
    var isAnimateG2 = $('#secG .wrapper .boxWrapperB .boxBtm ul li').find('.isAnimated');
    var isAnimateG3 = $('#secG .wrapper .boxWrapperC .boxBtm ul li').find('.isAnimated');
    var isAnimateH = $('#secH .wrapper .barWrapper').find('.isAnimated');
    var isAnimateJ = $('#secJ .wrapper .showDT').find('.isAnimated');
    var isAnimateJ2 = $('#secJ .wrapper .showM').find('.isAnimated');
    var isAnimateJ3 = $('#secJ .finishedBlock').find('.isAnimated');
    var chartAnimate = $('#secI #chartWrapperA').find('svg');

    //device setting
    deviceSet();

    //Slick setting
    if (device.mobile() || device.tablet()) {
        $('#secAslider').slick({
            autoplay: false,
            infinite: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: true,
            prevArrow: '<div class="prevBtn"><i class="fas fa-caret-left"></i></div>',
            nextArrow: '<div class="nextBtn"><i class="fas fa-caret-right"></i></div>'
        });
        $('#secGslider').slick({
            autoplay: false,
            infinite: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: true,
            centerMode: true,
            centerPadding: '300px',
            prevArrow: '<div class="prevBtn"><i class="fas fa-caret-left"></i></div>',
            nextArrow: '<div class="nextBtn"><i class="fas fa-caret-right"></i></div>',
            responsive: [{
                breakpoint: 900,
                settings: {
                    centerPadding: '180px',
                }
            },
            {
                breakpoint: 767,
                settings: {
                    centerPadding: '20px',
                }
            }
        ]
        });
    }
    $('#secBslider').slick({
        autoplay: false,
        infinite: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        prevArrow: '<div class="prevBtn"><i class="fas fa-caret-left"></i></div>',
        nextArrow: '<div class="nextBtn"><i class="fas fa-caret-right"></i></div>'
    });
    $('#secBslider2').slick({
        autoplay: false,
        infinite: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        prevArrow: '<div class="prevBtn"><i class="fas fa-caret-left"></i></div>',
        nextArrow: '<div class="nextBtn"><i class="fas fa-caret-right"></i></div>'
    });
    $('#secDslider').slick({
        autoplay: false,
        infinite: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: true,
        centerPadding: '300px',
        dots: true,
        prevArrow: '<div class="prevBtn"><i class="fas fa-caret-left"></i></div>',
        nextArrow: '<div class="nextBtn"><i class="fas fa-caret-right"></i></div>',
        responsive: [{
                breakpoint: 1024,
                settings: {
                    centerPadding: '100px',
                }
            },
            {
                breakpoint: 600,
                settings: {
                    centerPadding: '80px',
                }
            },
            {
                breakpoint: 480,
                settings: {
                    centerPadding: '30px',
                }
            }
        ]
    });

    $('ul.qaBlock').eq(0).find(".iconCollapse").html('-');

    $(".bubbleWrapper.customer").on('click', function () {
        var toggleCollapse = $(this).find(".iconCollapse");
        if (toggleCollapse.html() === "+") {
            toggleCollapse.html('-');
            $(this).parent().siblings().find('.bubbleWrapper.service').slideUp();
            $(this).parent().siblings().find(".iconCollapse").html('+');
        } else {
            toggleCollapse.html('+');
        }

        $(this).next('.bubbleWrapper.service').slideToggle();

    });

    $('#secB .slick-arrow').on('click', function () {
        reloadIframe();
    });

    $('#btnGoTop').click(function () {
        $('html,body').animate({
            scrollTop: 0
        }, 'slow');
        return false;
    });

    //fullpage
    $('#fullpage').fullpage({
        anchors: ['sec00', 'sec01', 'sec02', 'sec03', 'sec04', 'sec05', 'sec06', 'sec07', 'sec08', 'sec09', 'sec10', 'sec11', 'sec12'],
        sectionsColor: ['', '#f3f6f7', '', '#f3f6f7', '#1883d5', '', '', '', '', '', '', '#f1960b', ''],
        verticalCentered: true,
        menu: '#menu',
        lockAnchors: true,
        // css3: true,
        // paddingTop: '100px',
        // scrollingSpeed: 800,
        // easing: 'easeInOutCubic',
        // easingcss3: 'ease',
        autoScrolling: false,
        fitSection: false,
        // scrollOverflow: true,
        // scrollOverflowReset: true,
        // scrollHorizontally: true,
        dragAndMove: true,
        // onLeave: function (anchorLink, index) {
        //     TweenMax.to(sectopic, 0, {
        //         y: -headerHeight,
        //         opacity: 0,
        //         autoAlpha: 0,
        //     });
        // },
        afterLoad: function (anchorLink, index) {
            if (index !== 1) {
                $('header').addClass('bgFullcolor');
                $('#btnGoTop').show();
                if (device.mobile() || device.tablet()) {
                    $('.logoWrapper').hide();
                } else {
                    $('.logoWrapper').show();
                }
            }
            switch (index) {
                case 1:
                    $('.logoWrapper').show();
                    $('header').removeClass('bgFullcolor');
                    $('#btnGoTop').hide();
                    break;
                case 2:
                    dashA.addClass('aniDashA');
                    dashB.addClass('aniDashB');
                    dashC.addClass('aniDashC');
                    if (device.desktop()) {
                        isAnimateA.addClass('animated fadeIn');
                    }
                    // isAnimateA.addClass('animated fadeIn');
                    // isAnimateA.eq(0).css('animation-delay', '0.3s');
                    for(a=0, b=2.6; a<3, b<8.6; a++, b+=2){
                        isAnimateA.eq(a).css('animation-delay', b+'s');
                    }
                    break;
                case 3:
                    reloadIframe();
                    isAnimateB.addClass('animated bounceIn');
                    for(a=0, b=0; a<2, b<0.6; a++, b+=0.3){
                        isAnimateB.eq(a).css('animation-delay', b+'s');
                    }
                    break;
                case 4:
                    isAnimateC.addClass('animated bounceIn');
                    isAnimateC2.addClass('animated flipInX');
                    for(a=0, b=0; a<4, b<1.2; a++, b+=0.3){
                        isAnimateC.eq(a).css('animation-delay', b+'s');
                    }
                    isAnimateC2.eq(1).css('animation-delay', '1.5s');
                    isAnimateC2.eq(0).css('animation-delay', '1.5s');
                    isAnimateC2.eq(2).css('animation-delay', '2.0s');
                    isAnimateC2.eq(3).css('animation-delay', '2.0s');
                    break;
                case 5:
                    break;
                case 6:
                    isAnimateE.addClass('animated bounceIn');
                    isAnimateE.css('animation-delay', '.3s');
                    break;
                case 7:
                    isAnimateF.addClass('animated');
                    // isAnimateF.eq(0).addClass('bounceIn').css('animation-delay', '.3s');
                    if (device.mobile()) {
                        isAnimateF.eq(0).addClass('slideInUp').css('animation-delay', '.3s');
                        isAnimateF.eq(1).addClass('slideInDown').css('animation-delay', '.3s');
                    } else {
                        isAnimateF.eq(0).addClass('slideInRight').css('animation-delay', '.3s');
                        isAnimateF.eq(1).addClass('slideInLeft').css('animation-delay', '.3s');
                    }

                    break;
                case 8:
                    isAnimateG.addClass('animated bounceIn');
                    for(a=0, b=0; a<3, b<0.7; a++, b+=0.2){
                        isAnimateG.eq(a).css('animation-delay', b+'s');
                    }
                    isAnimateG2.addClass('animated bounceIn');
                    for(a=0, b=0.7; a<3, b<1.3; a++, b+=0.2){
                        isAnimateG2.eq(a).css('animation-delay', b+'s');
                    }
                    isAnimateG3.addClass('animated bounceIn');
                    for(a=0, b=1.3; a<3, b<1.9; a++, b+=0.2){
                        isAnimateG3.eq(a).css('animation-delay', b+'s');
                    }
                    break;
                case 9:
                    isAnimateH.addClass('animated flipInX');
                    for(a=0, b=0; a<3, b<0.9; a++, b+=0.3){
                        isAnimateH.eq(a).css('animation-delay', b+'s');
                    }
                    break;
                case 10:
                    chartAnimate.find('path').addClass('aniA');
                    chartAnimate.find('.downarrow').addClass('aniB');
                    barAnimate();
                    break;
                case 11:
                    isAnimateJ.addClass('animated flipInX');
                    for(a=0, b=0; a<11, b<3.2; a++, b+=0.3){
                        isAnimateJ.eq(a).css('animation-delay', b+'s');
                    }
                    isAnimateJ2.addClass('animated flipInX');
                    for(a=0, b=0; a<11, b<3.2; a++, b+=0.3){
                        isAnimateJ2.eq(a).css('animation-delay', b+'s');
                    }
                    isAnimateJ3.addClass('animated stampIn');
                    for(a=0; a<3; a++){
                        isAnimateJ3.eq(a).css('animation-delay', '4.0s');
                    }
                    break;
                case 12:
                    break;
                case 13:
                    break;
                default:
                    $('header').removeClass('bgFullcolor');
                    break;
            }
        },
        
    });
    //Confetti effect
    const Confettiful = function (el) {
        this.el = el;
        this.containerEl = null;

        this.confettiFrequency = 1;
        this.confettiColors = ['#4c81fb', '#e1a531', '#fe77c3'];
        this.confettiAnimations = ['slow', 'medium', 'fast'];

        this._setupElements();
        this._renderConfetti();
    };

    Confettiful.prototype._setupElements = function () {
        const containerEl = document.createElement('div');
        const elPosition = this.el.style.position;

        if (elPosition !== 'relative' || elPosition !== 'absolute') {
            this.el.style.position = 'relative';
        }

        containerEl.classList.add('confetti-container');

        this.el.appendChild(containerEl);

        this.containerEl = containerEl;
    };

    Confettiful.prototype._renderConfetti = function () {
        this.confettiInterval = setInterval(() => {
            const confettiEl = document.createElement('div');
            const confettiSize = Math.floor(Math.random() * 2) + 9 + 'px';
            const confettiBackground = this.confettiColors[Math.floor(Math.random() * this.confettiColors.length)];
            const confettiLeft = Math.floor(Math.random() * this.el.offsetWidth) + 'px';
            const confettiAnimation = this.confettiAnimations[Math.floor(Math.random() * this.confettiAnimations.length)];

            confettiEl.classList.add('confetti', 'confetti--animation-' + confettiAnimation);
            confettiEl.style.left = confettiLeft;
            confettiEl.style.width = confettiSize;
            confettiEl.style.height = confettiSize;
            confettiEl.style.backgroundColor = confettiBackground;

            confettiEl.removeTimeout = setTimeout(function () {
                confettiEl.parentNode.removeChild(confettiEl);
            }, 5000);

            this.containerEl.appendChild(confettiEl);
        }, 50);
    };

    window.confettiful = new Confettiful(document.querySelector('.js-container'));

    //oncroll
    $(document).on('scroll',function(e)
    {
        onScroll();
        $('section').each(function()
        {
            if ( $(this).offset().top < window.pageYOffset + 10 
            &&   $(this).offset().top + 
                $(this).height() > window.pageYOffset + 10
            ) 
            {
            var data = $(this).attr('id');
            window.location.hash = data;
            }
        });
    });
    // $(document).on("scroll", onScroll);
    $('a[href^="#"]').on('click', function (e) {
        e.preventDefault();
        $(document).off("scroll");
        
        $('body').css('padding-top','0');
        
        $('a').each(function () {
            $(this).removeClass('active');
        })
        $(this).addClass('active');
      
        var target = this.hash,
            menu = target;
        $target = $(target);
        // var $topic = $(target).find('.secTopic');
        
        $('html, body').stop().animate({
            'scrollTop': $target.offset().top
        }, 500, 'swing', function () {
            var headerHeight = $('header').outerHeight();
            if(target != '#secTop'){
                TweenMax.to($('body'), 0, {
                    css:{paddingTop:headerHeight}
                });
            }
            window.location.hash = target;
            $(document).on("scroll", onScroll);
        });
    });
});


// function們
function deviceSet(){
    if (device.mobile()) {
        BL = 'M';
        $('#css_style').attr('href', 'assets/css/mobile.css');
        $('.sec03_mainBlock').css('background-image', 'url("assets/images/sec_c_bg_m.png');
        $('.icon_fb img').attr('src', 'assets/images/icon_fb_m.svg');
        $('.icon_line img').attr('src', 'assets/images/icon_line_m.svg');
        $('.showM').show();
        $('.showMT').show();
        $('.showD').hide();
        $('.showDT').hide();
        $('.noAniM').css('opacity', '1');
    } else {
        $('.icon_fb').attr('src', 'assets/images/icon_fb.svg');
        $('.icon_line').attr('src', 'assets/images/icon_line.svg');
        $('.showMT').hide();

        if (device.tablet()) {
            BL = 'T';
            $('#css_style').attr('href', 'assets/css/tablet.css');
            $('.icon_fb img').attr('src', 'assets/images/icon_fb_m.svg');
            $('.icon_line img').attr('src', 'assets/images/icon_line_m.svg');
            $('.showMT').show();
            $('.showD').hide();
            $('.noAniM').css('opacity', '1');
        }
        if (device.desktop()) {
            BL = 'W';
            $('#css_style').attr('href', 'assets/css/style.css');
            $('.showM').hide();
            $('.showMT').hide();
            $('.showD').show();
            $('.showDT').show();

        }
    }
}

function onScroll(event){
    var scrollPos = $(document).scrollTop();
    $('#menu li a').each(function () {
        var currLink = $(this);
        var refElement = $(currLink.attr("href"));
        if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
            $('#menu li').removeClass("active");
            currLink.parent().addClass("active");
        }
        else{
            currLink.removeClass("active");
        }
    });
}

function barAnimate() {
    $("#bars li .bar").each(function (key, bar) {
        var percentage = $(this).data('percentage');
        $(this).height(10);

        $(this).stop(true, true).delay(5000).animate({
            'height': percentage * 12.6 + '%'
        }, 100);
    });
}

function reloadIframe() {
    $('#iframeA').attr('src', $('#iframeA').attr('src'));
    $('#iframeB').attr('src', $('#iframeB').attr('src'));
    $('#iframeA2').attr('src', $('#iframeA2').attr('src'));
    $('#iframeB2').attr('src', $('#iframeB2').attr('src'));
}

function removeLocationHash(){
    var noHashURL = window.location.href.replace(/#.*$/, '');
    window.history.replaceState('', document.title, noHashURL) 
}
window.addEventListener("load", function(){
    removeLocationHash();
});