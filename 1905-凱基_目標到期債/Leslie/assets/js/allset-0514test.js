var canvas, stage, exportRoot, anim_container, dom_overlay_container, fnStartAnimation;
function init() {
	canvas = document.getElementById("canvas");
	anim_container = document.getElementById("animation_container");
	dom_overlay_container = document.getElementById("dom_overlay_container");
	var comp=AdobeAn.getComposition("5028E7E44764F64EA9B2AEEECE407C8C");
	var lib=comp.getLibrary();
	var loader = new createjs.LoadQueue(false);
	loader.addEventListener("fileload", function(evt){handleFileLoad(evt,comp)});
	loader.addEventListener("complete", function(evt){handleComplete(evt,comp)});
	var lib=comp.getLibrary();
	loader.loadManifest(lib.properties.manifest);
}
function handleFileLoad(evt, comp) {
	var images=comp.getImages();	
	if (evt && (evt.item.type == "image")) { images[evt.item.id] = evt.result; }	
}
function handleComplete(evt,comp) {
	//This function is always called, irrespective of the content. You can use the variable "stage" after it is created in token create_stage.
	var lib=comp.getLibrary();
	var ss=comp.getSpriteSheet();
	var queue = evt.target;
	var ssMetadata = lib.ssMetadata;
	for(i=0; i<ssMetadata.length; i++) {
		ss[ssMetadata[i].name] = new createjs.SpriteSheet( {"images": [queue.getResult(ssMetadata[i].name)], "frames": ssMetadata[i].frames} )
	}
	exportRoot = new lib.pig();
	stage = new lib.Stage(canvas);	
	//Registers the "tick" event listener.
	fnStartAnimation = function() {
		stage.addChild(exportRoot);
		createjs.Ticker.setFPS(lib.properties.fps);
		createjs.Ticker.addEventListener("tick", stage);
	}	    
	//Code to support hidpi screens and responsive scaling.
	AdobeAn.makeResponsive(false,'both',false,1,[canvas,anim_container,dom_overlay_container]);	
	AdobeAn.compositionLoaded(lib.properties.id);
	fnStartAnimation();
}

window.onload = function(){
    init();
}

// Cache selectors
var lastId,
    topMenu = $("#menu"),
    topMenuHeight = topMenu.outerHeight(),
    // All list items
    allSec = $('body').find('section'),
    menuItems = topMenu.find("a"),

    secItems = allSec.map(function(){
        var blocks = $($(this).attr('id'));
        if (blocks.length) { return blocks; }
    });
    // Anchors corresponding to menu items
    scrollItems = menuItems.map(function(){
      var item = $($(this).attr("href"));
      if (item.length) { return item; }
    });

// Bind click handler to menu items
// so we can get a fancy scroll animation
menuItems.click(function(e){
  var href = $(this).attr("href"),
      offsetTop = href === "#" ? 0 : $(href).offset().top-topMenuHeight+1;
  $('html, body').stop().animate({ 
      scrollTop: offsetTop
  }, 300);
  e.preventDefault();
});

$(function () {
    var BL;
    var controller = new ScrollMagic.Controller();
    var DataAnchor = new Array;
    var sectopic = $('.secTopic');
    var sectopicA = $('#secA .secTopic');
    var sectopicB = $('#secB .secTopic');
    var sectopicD= $('#secD .secTopic');
    var sectopicE = $('#secE .secTopic');
    var sectopicK = $('#secK .secTopic');
    var headerHeight = $('header').outerHeight();
    var isAnimateA = $('#secA .wrapper').find('.isAnimated');
    var isAnimateB = $('#secB .wrapper').find('.isAnimated');
    var isAnimateC = $('#secC .wrapper').find('.isAnimated');
    var isAnimateC2 = $('#secC .wrapper .sec03_mainBlock').find('.isAnimated');
    var isAnimateE = $('#secE .wrapper').find('.isAnimated');
    var isAnimateF = $('#secF .wrapper').find('.isAnimated');
    var isAnimateG = $('#secG .wrapper .boxBtm ul').find('.isAnimated');
    var isAnimateH = $('#secH .wrapper .barWrapper').find('.isAnimated');
    var isAnimateJ = $('#secJ .wrapper').find('.isAnimated');
    var isAnimateJ2 = $('#secJ .finishedBlock').find('.isAnimated');
    var chartAnimate = $('#secI #chartWrapperA').find('svg');

    function barAnimate() {
        $("#bars li .bar").each(function (key, bar) {
            var percentage = $(this).data('percentage');

            $(this).stop(true, true).delay(2500).animate({
                'height': percentage * 12.8 + '%'
            }, 1000);
        });
    }
    
    $('ul.qaBlock').eq(0).find(".iconCollapse").html('-');

    $(".bubbleWrapper.customer").on('click', function() {
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

    //fullpage
    // $('#fullpage').fullpage({
    //     anchors: ['sec00', 'sec01', 'sec02', 'sec03', 'sec04', 'sec05', 'sec06','sec07', 'sec08', 'sec09', 'sec10', 'sec11', 'sec12'],
    //     sectionsColor: ['', '#f3f6f7', '', '#f3f6f7', '#1883d5', '', '', '', '', '', '', '#f1960b', ''],
    //     verticalCentered: true,
    //     menu: '#menu',
    //     // fixedElements: '#header',
    //     // scrollBar: true,
    //     // css3: true,
    //     // paddingTop: '120px',
    //     // scrollingSpeed: 800,
    //     // easing: 'easeInOutCubic',
    //     // easingcss3: 'ease',
    //     autoScrolling: false,
    //     fitSection: false,
    //     // scrollOverflow: true,
    //     // scrollOverflowReset: true,
    //     // scrollHorizontally: true,
    //     dragAndMove: true,
    //     // menu: '#menu',
    //     afterLoad: function (anchorLink, index) {
    //         if(index !== 1){
    //             $('header').addClass('bgFullcolor');
    //         }
    //         switch (index) {
    //             case 1:
    //                 $('header').removeClass('bgFullcolor');
    //                 break;
    //             case 2:
    //                 TweenMax.to(sectopicA, 0.2, {
    //                     y: headerHeight,
    //                     opacity: 1,
    //                     autoAlpha: 1,
    //                 });
    //                 isAnimateA.addClass('animated fadeInUp');
    //                 isAnimateA.eq(0).css('animation-delay', '.3s');
    //                 isAnimateA.eq(1).css('animation-delay', '.6s');
    //                 isAnimateA.eq(2).css('animation-delay', '.9s');
    //                 isAnimateA.eq(3).css('animation-delay', '1.3s');

    //                 // var aniA = function(){
    //                 //     $('#secA').find('.sec01_blockA').stop().css({ 'margin-left': '-505px', 'margin-top': '-100px' }, 1000, 'easeOutBack');
    //                 //   };
    //                 //   setTimeout(aniA, 2000);
    //                 break;
    //             case 3:
    //                 TweenMax.to(sectopicB, 0.2, {
    //                     y: headerHeight,
    //                     opacity: 1,
    //                     autoAlpha: 1,
    //                 });
    //                 isAnimateB.addClass('animated bounceIn');
    //                 isAnimateB.eq(0).css('animation-delay', '.3s');
    //                 isAnimateB.eq(1).css('animation-delay', '.6s');
    //                 break;
    //             case 4:
    //                 isAnimateC.addClass('animated bounceIn');
    //                 isAnimateC2.addClass('animated flipInX');
    //                 isAnimateC.eq(0).css('animation-delay', '.3s');
    //                 isAnimateC.eq(1).css('animation-delay', '.6s');
    //                 isAnimateC.eq(2).css('animation-delay', '.9s');
    //                 isAnimateC.eq(3).css('animation-delay', '1.2s');
    //                 isAnimateC2.eq(1).css('animation-delay', '1.5s');
    //                 isAnimateC2.eq(0).css('animation-delay', '1.5s');
    //                 isAnimateC2.eq(2).css('animation-delay', '2.0s');
    //                 isAnimateC2.eq(3).css('animation-delay', '2.0s');
    //                 break;
    //             case 5:
    //                 TweenMax.to(sectopicD, 0.2, {
    //                     y: headerHeight,
    //                     opacity: 1,
    //                     autoAlpha: 1,
    //                 });
    //                 break;
    //             case 6:
    //                 TweenMax.to(sectopicE, 0.2, {
    //                     y: headerHeight,
    //                     opacity: 1,
    //                     autoAlpha: 1,
    //                 });
    //                 isAnimateE.addClass('animated bounceIn');
    //                 isAnimateE.css('animation-delay', '.3s');
    //                 break;
    //             case 7:
    //                 isAnimateF.addClass('animated');
    //                 // isAnimateF.eq(0).addClass('bounceIn').css('animation-delay', '.3s');
    //                 isAnimateF.eq(0).addClass('slideInRight').css('animation-delay', '.3s');
    //                 isAnimateF.eq(1).addClass('slideInLeft').css('animation-delay', '.3s');
    //                 break;
    //             case 8:
    //                 isAnimateG.addClass('animated bounceIn');
    //                 isAnimateG.eq(0).css('animation-delay', '.3s');
    //                 isAnimateG.eq(1).css('animation-delay', '.5s');
    //                 isAnimateG.eq(2).css('animation-delay', '.7s');
    //                 break;
    //             case 9:
    //                 isAnimateH.addClass('animated flipInX');
    //                 isAnimateH.eq(0).css('animation-delay', '.3s');
    //                 isAnimateH.eq(1).css('animation-delay', '.6s');
    //                 isAnimateH.eq(2).css('animation-delay', '.9s');
    //                 break;
    //             case 10:
    //                 chartAnimate.find('path').addClass('aniA');
    //                 chartAnimate.find('.downarrow').addClass('aniB');
    //                 barAnimate();
    //                 break;
    //             case 11:
    //                 isAnimateJ.addClass('animated flipInX');
    //                 isAnimateJ.eq(0).css('animation-delay', '.2s');
    //                 isAnimateJ.eq(1).css('animation-delay', '.5s');
    //                 isAnimateJ.eq(2).css('animation-delay', '.8s');
    //                 isAnimateJ.eq(3).css('animation-delay', '1.1s');
    //                 isAnimateJ.eq(4).css('animation-delay', '1.4s');
    //                 isAnimateJ.eq(5).css('animation-delay', '1.7s');
    //                 isAnimateJ.eq(6).css('animation-delay', '2.0s');
    //                 isAnimateJ.eq(7).css('animation-delay', '2.3s');
    //                 isAnimateJ.eq(8).css('animation-delay', '2.6s');
    //                 isAnimateJ.eq(9).css('animation-delay', '2.9s');
    //                 isAnimateJ.eq(10).css('animation-delay', '3.2s');

    //                 isAnimateJ2.addClass('animated stampIn');
    //                 isAnimateJ2.eq(0).css({'animation-delay': '4.0s'});
    //                 isAnimateJ2.eq(1).css({'animation-delay': '4.0s'});
    //                 isAnimateJ2.eq(2).css({'animation-delay': '4.0s'});
    //                 break;
    //             case 12:
    //                 TweenMax.to(sectopicK, 0.2, {
    //                     y: headerHeight,
    //                     opacity: 1,
    //                     autoAlpha: 1,
    //                 });
    //                 break;
    //             default:
    //                 $('header').removeClass('bgFullcolor');
    //                 break;
    //         }
    //     },
    //     onLeave: function (anchorLink, index) {
    //         TweenMax.to(sectopic, 0.2, {
    //             y: -headerHeight,
    //             opacity: 0,
    //             autoAlpha: 0,
    //         });
    //         switch(index) {
    //             default:
    //                 break;
    //         }
    //     },
    // });

    var secA = $('#secA');
    var secA = $('#secB');

    var controller = new ScrollMagic.Controller()

var tween01 = new TimelineMax ()
  .add ([
    TweenMax.fromTo('#secA .secTopic', 0.5, {
        y: -headerHeight, opacity: 0, autoAlpha: 0},
        {y: headerHeight, opacity: 1, autoAlpha: 1}
    ),
    TweenMax.fromTo('.isAnimated', 1, {y:-500, autoAlpha: 0}, {y:0, autoAlpha: 1, ease: Linear.easeNone}),
  ]);

  var tween02 = new TimelineMax ()
  .add ([
    TweenMax.fromTo('#secB .secTopic', 0.5, {
        y: -headerHeight, opacity: 0, autoAlpha: 0},
        {y: headerHeight, opacity: 1, autoAlpha: 1}
    ),
    TweenMax.fromTo('.isAnimated', 1, {y:-500, autoAlpha: 0}, {y:0, autoAlpha: 1, ease: Linear.easeNone}),
  ]);

  var scene = new ScrollMagic.Scene({triggerElement: secB, duration: "100%"}).setTween(tween01).addTo(controller);


    // // Bind to scroll
    $(window).scroll(function(){
        // Get container scroll position
        var fromTop = $(this).scrollTop()+topMenuHeight;
        
        // Get id of current scroll item
        var cur = scrollItems.map(function(){
        if ($(this).offset().top < fromTop)
            return this;
        });

        // Get the id of the current element
        cur = cur[cur.length-1];
        var id = cur && cur.length ? cur[0].id : "";

        if (lastId !== id) {
            lastId = id;
            // Set/remove active class
            menuItems
            .parent().removeClass("active")
            .end().filter("[href='#"+id+"']").parent().addClass("active");
        }
        
        if(id !== secTop){
            $('header').addClass('bgFullcolor');
        }else if(id == secTop){
            $('header').removeClass('bgFullcolor');
        }
        switch (id) {
            case secTop:
                $('header').removeClass('bgFullcolor');
                break;
            case secA:
                TweenMax.to(sectopicA, 0.2, {
                    y: headerHeight,
                    opacity: 1,
                    autoAlpha: 1,
                });
                break;
        }
    });

    
    //device setting
    if (device.mobile() || device.tablet()) {
        BL = 'M';
        $('#css_style').attr('href', 'assets/css/mobile.css');
    } else {

        if (device.tablet()) {
            BL = 'T';
            $('#css_style').attr('href', 'assets/css/table.css');
        } else {
            BL = 'W';
        }
    }

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

    //Slick setting
    $('#secBslider').slick({
        autoplay: false,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        prevArrow: '<div class="prevBtn"><i class="fas fa-caret-left"></i></div>',
        nextArrow: '<div class="nextBtn"><i class="fas fa-caret-right"></i></div>'
    });
    $('#secDslider').slick({
        autoplay: true,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: true,
        centerPadding: '260px',
        dots: true,
        prevArrow: '<div class="prevBtn"><i class="fas fa-caret-left"></i></div>',
        nextArrow: '<div class="nextBtn"><i class="fas fa-caret-right"></i></div>'
    });
});

