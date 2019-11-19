;(function(i, s, o, g, r, a, m) {
  i['GoogleAnalyticsObject'] = r
  ;(i[r] =
    i[r] ||
    function() {
      ;(i[r].q = i[r].q || []).push(arguments)
    }),
    (i[r].l = 1 * new Date())
  ;(a = s.createElement(o)), (m = s.getElementsByTagName(o)[0])
  a.async = 1
  a.src = g
  m.parentNode.insertBefore(a, m)
})(
  window,
  document,
  'script',
  'https://www.google-analytics.com/analytics.js',
  'ga'
)
ga('create', 'UA-75164793-4', 'auto')
ga('send', 'pageview')
//let gaBtn = (_name) => ga('send', 'event', 'btn', 'click', _name);
//let gaPage = (_name) => ga('send', 'pageview', _name);

var $win = $(window),
  winW = $win.width(),
  winH = $win.height(),
  _media = 1280

var loading = function() {
  if (winW > 640) {
    // Opening Animation
    var opAni = new TimelineMax({ paused: true })

    opAni
      .to('.dot1', 0.3, { x: '+20', opacity: 0 }, '-=0')
      .to('.dot3', 0.3, { x: '-20', opacity: 0 }, '-=.3')
      .to('.dot2', 0.5, { scale: 0.75, ease: Power4.easeOut }, '-=0.3')
      .to('.dot2', 2, { scale: 0.02, opacity: 0, ease: Circ.easeOut }, '-=0.3')
      .to('.map', 0.75, { opacity: 1, ease: Power0.easeOut }, '-=1')
      .to('#loading', 0.1, { opacity: 0, ease: Power0.easeOut }, '+=0')
      .to('#loading', 0.1, { display: 'none' }, '+=0')
      // 圈圈
      .from(
        '.kv .circles img',
        1.5,
        { scale: 1.1, ease: Expo.easeOut, onComplete: function() {
          $('.kv .circles > div').addClass('light');
        } },
        '-=0.2'
      )
      // 大標
      .from(
        '.kv .title h1',
        2,
        { opacity: 0, scale: 0.9, ease: Expo.easeOut },
        '-=1.25'
      )
      // 小標
      .from('.kv .title h2', 1, { opacity: 0, ease: Power4.easeOut }, '-=1.5')
      // Scroll
      .from('.kv .title > a', 1, { opacity: 0, ease: Power4.easeOut }, '-=1')

    // .from('.kv .title', .5, { opacity: 0, y: '+20' }, '-=0.2')
    // .from('header', .5, { y: '-100' }, '-=0.5')
    // .from('.joinBox', .5, { opacity: 0, ease: Power0.easeOut }, '-=0')
    // .from('.kv .circles', 2, { opacity: 0 }, '-=0')

    var $this = {}
    $this.removeLoading = function() {
      $('.loader-inner').removeClass('autoAni')
      opAni.play()
      // $('#loading').fadeOut(function(){
      //     $('#loading').remove();

      //     // 動態程式寫這

      //     $('html').css("overflow","auto");

      // });
      // setTimeout(function(){$('html, body').scrollTop(0);},1000);

      // $('html, body').scrollTop(0);
      setTimeout('await()', 8000)
      setTimeout('goPin()', 3000)
    }
  } else {
    /* winW < 640 */  

    $('.kv .circles > div').addClass('light');
    var $this = {}
    $this.removeLoading = function() {
      $('#loading').fadeOut(function() {
        $('#loading').remove()

        // 動態程式寫這
        goPin()
        setTimeout('await()', 5000)
      })
    }
  }

  $this.loadfunc = function() {
    $('html, body').imagesLoaded(function() {
      $this.removeLoading()
    })
  }
  return $this
}

var myScript = function() {
  var imagesLoaded = loading()
  imagesLoaded.loadfunc()

  var starSetting =
    winW > 640
      ? {
          starColor: 'rgba(255,255,255,1)',
          bgColor: '#07959e',
          mouseMove: false,
          fps: 15,
          speed: 1,
          quantity: 1000,
          ratio: 10,
          divclass: 'starfield'
        }
      : {
          starColor: 'rgba(255,255,255,1)',
          bgColor: '#07959e',
          mouseMove: false,
          fps: 15,
          speed: 1,
          quantity: 300,
          ratio: 10,
          divclass: 'starfield'
        }

  // 星星背景
  $('.starfield').starfield(starSetting)

  /*     # include
  ----------------------------------------- */

  // $('header').load('include/header.html');
  // $('footer').load('include/footer.html');
  // $("._scroll").mCustomScrollbar();
  // $("._slick").slick();

  var $this = {
    //gaid: 'UA-116680658-1',
    //sec_array: ['.pvSec1','.pvSec2','.pvSec3','.pvSec4','.pvSec5','.pvSec6'],
    //pv_array: ['01','02','03','04','05','06'],
    //sec_now: '',
    //ifPV: false
  }
  var $main = $('.maincontainer')
  // kv = new TimelineMax({paused:true}),
  // saybox = new TimelineMax({paused:true,repeat:-1,repeatDelay:1}),
  // heart = new TimelineMax({repeat:-1,repeatDelay:1});

  if (winW <= 640) {
    // SLICK
    $('._slick').slick({
      dots: false,
      arrow: true,
      infinite: true,
      speed: 300,
      slidesToShow: 3,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 2560,
          settings: 'unslick'
        },
        {
          breakpoint: 640,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    })
    $('._slick').on('beforeChange', function(
      event,
      slick,
      currentSlide,
      nextSlide
    ) {
      $('.trendBox a').removeClass('active')
    })
  }

  var headerH = $('header').height()

  $('.kv, #loading').css({ 'padding-top': headerH })

  // click event

  // GA
  // $('.trend1').on( 'click' , function(){
  //     gtag('event', '分享', {
  //     'event_category': '按鈕點擊',
  //     'event_label': 'Facebook'
  //   });
  // })

  $('.btnMenu, .nav li').on('click', function() {
    $('.btnMenu').toggleClass('open')
  })
  // Menu Scrolling
  $('.nav li, .kv .title > a').on('click', function() {
    var thisNav = $(this).data('menu')
    $('html, body')
      .stop()
      .animate(
        {
          scrollTop: $('.' + thisNav).offset().top - headerH +1
        },
        800
      )
  })

  $('.btnTop').on('click', function() {
    gotop()
  })

  $('.trendBox a').on('click', function() {
    $('.trendBox a').removeClass('active')
    $(this).addClass('active')
  })

  var where = $('section').data('area')

  // $('.market .shareFb').on( 'click' , function(){
  //     window.open('https://www.facebook.com/sharer/sharer.php?u=' + location.href.replace(location.search,"") + '?market' )
  // })
  // $('.advice .shareFb').on( 'click' , function(){
  //     window.open('https://www.facebook.com/sharer/sharer.php?u=' + location.href.replace(location.search,"") + '?advice' )
  // })
  // $('.trend .shareFb').on( 'click' , function(){
  //     window.open('https://www.facebook.com/sharer/sharer.php?u=' + location.href.replace(location.search,"") + '?trend' )
  // })
  // $('.products .shareFb').on( 'click' , function(){
  //     window.open('https://www.facebook.com/sharer/sharer.php?u=' + location.href.replace(location.search,"") + '?products' )
  // })
  // $('.hot .shareFb').on( 'click' , function(){
  //     window.open('https://www.facebook.com/sharer/sharer.php?u=' + location.href.replace(location.search,"") + '?hot' )
  // })

  $('.market .shareLine').on('click', function() {
    window.open(
      'https://lineit.line.me/share/ui?url=' +
        location.href.replace(location.search, '') +
        '?market'
    )
  })
  $('.advice .shareLine').on('click', function() {
    window.open(
      'https://lineit.line.me/share/ui?url=' +
        location.href.replace(location.search, '') +
        '?advice'
    )
  })
  $('.trend .shareLine').on('click', function() {
    window.open(
      'https://lineit.line.me/share/ui?url=' +
        location.href.replace(location.search, '') +
        '?trend'
    )
  })
  // $('.products .shareLine').on('click', function() {
  //   window.open(
  //     'https://lineit.line.me/share/ui?url=' +
  //       location.href.replace(location.search, '') +
  //       '?products'
  //   )
  // })
  $('.hot .shareLine').on('click', function() {
    window.open(
      'https://lineit.line.me/share/ui?url=' +
        location.href.replace(location.search, '') +
        '?hot'
    )
  })
  // LightBox
  // $('.trendBox li').on('click', function(){
  //     var thisPic = $(this).data("lbpic");
  //     $( '.lightbox' ).fadeIn();
  //     $( '.lbTrend' ).fadeIn().css("display","inline-block");
  //     $( '.' + thisPic ).show();
  // })
  // $('.trendPic').slick({
  //     dots: false,
  //     arrow: true,
  //     infinite: true,
  //     speed: 300,
  //     slidesToShow: 1,
  //     slidesToScroll: 1,
  // });
  $('.adviceBlockB a.plus, .trendBox li').on('click', function() {
    var thisId = $(this).index()
    var thisPicBox = $(this).data('lbpicbox')
    var thisPic = $(this).data('lbpic')
    $('.lightbox').fadeIn()
    $('.lbTrend')
      .fadeIn()
      .css('display', 'inline-block')
    $('.' + thisPicBox).show()
    $('.' + thisPic).show()
    // $( '.' + thisPic ).children().eq(trendId).show();
    // SLICK
    // $( '.trendPic' ).slickGoTo( thisId );
  })
  $('.trendPic .btnPrev').on('click', function() {
    // $( '.lightbox' ).fadeIn();
    // $( '.lbVideo' ).fadeIn().css("display","inline-block");
    $(this)
      .parent()
      .prev()
      .show()
    $(this)
      .parent()
      .hide()
    // $(this).parent().prev().show( "fast", function() {
    //         $(this).hide();
    //     });
  })
  $('.trendPic .btnNext').on('click', function() {
    $(this)
      .parent()
      .next()
      .show()
    $(this)
      .parent()
      .hide()
    // $( '.lightbox' ).fadeIn();
    // $( '.lbVideo' ).fadeIn().css("display","inline-block");
    // $(this).parent().next().fadeIn( "fast", function() {
    //     $(this).fadeOut();
    // });
  })
  // .trend1
  // $('.btnOrder').on('click', function(){
  //     $( '.lightbox' ).fadeIn();
  //     $( '.lbOrder' ).fadeIn().css("display","inline-block");
  // })

    
  $('.cursorArea').on('click', function() {
    var thisId = $(this).index()
    var thisPicBox = $(this).data('lbpicbox')
    var thisPic = $(this).data('lbpic')
    $('.lightbox').fadeIn()
    $('.lbAdvice3')
      .fadeIn()
      .css('display', 'inline-block')
    $('.advice3Pic div').hide()
    $('.' + thisPicBox).show()
    $('.' + thisPic).show()
  })
    
  $('.contactServe').on('click', function() {
    var FundId = $(this).attr('fundid')
    $('.btnSend').attr('FundId', FundId)

    $('.order1').fadeOut(function() {
      $('.order2')
        .fadeIn()
        .css('display', 'inline-block')
    })
  })
    $('.btnSend').on('click', function () {
        var FundId = $('.btnSend').attr('fundId');
        var Name = $('#InputOrderName').val();
        var Mobile = $('#InputOrderMobile').val();
        var Email = $('#InputOrderMail').val();
        var IsCheck = $('#agreeContact:checkbox:checked').length;
        if (Name === undefined || Name === '' || Name === null) {
            alert('請您輸入您的姓名');
            return;
        }
        if (Mobile === undefined || Mobile === '' || Mobile === null) {
            alert('請您輸入您的手機號碼');
            return;
        }
        if (
            IsCheck === undefined ||
            IsCheck === '' ||
            IsCheck === null ||
            IsCheck <= 0
        ) {
            alert('請您閱讀並同意接受貴公司客戶資料保密措施聲明及隱私權保護政策');
            return;
        }
        $.ajax({
            type: 'POST',
            url: 'AJAX/SendOrder.ashx',
            data: {
                FundId: FundId,
                Name: Name,
                Mobile: Mobile,
                Email: Email,
                IsCheck: IsCheck
            },
            contentType: 'application/json; charset=utf-8',
            dataType: 'json',
            success: function (res) {
                if (res.IsSuccess === true) {
                    $('#InputOrderName').val("");
                    $('#InputOrderMobile').val("");
                    $('#InputOrderMail').val("");
                    $("#agreeContact").prop('checked', false); 
                    $('.order2').fadeOut(function () {
                        $('.order3')
                            .fadeIn()
                            .css('display', 'inline-block');
                    });
                    
                } else {
                    alert(res.Message);
                }
            },
            error: function (res) {
                alert('系統網頁發生錯誤');
            },
            beforeSend: function () {
                $('#LoadingOrder').css('display', '');
                $('.orderBox .btnSend').css('display', 'none');
            },
            complete: function () {
                $('#LoadingOrder').css('display', 'none');
                $('.orderBox .btnSend').css('display', '');
            }
        });
    });

  $('.btnOrder').on('click', function() {
    // var thisLink = $(this).data('buylink')
    // $('.lbOrder .buyNow').attr('href', thisLink)
    // var FundId = $(this).attr('fundid')
    // var FundName = FundIdWithName(FundId)
    // $('.lbOrder .buyNow').attr(
    //   'Onclick',
    //   "ga('send', 'event', 'Link', '立即申購去_" + FundName + "')"
    // )
    // $('.contactServe').attr('fundid', FundId)
    // $('.orderBox .btnSend').attr(
    //   'Onclick',
    //   "ga('send', 'event', 'Click', '專人與我聯絡_" + FundName + "')"
    // )
    var FundId = $(this).attr('fundid')
    $('.btnSend').attr('FundId', FundId)


    $('.lightbox').fadeIn()
    $('.lbOrder')
      .fadeIn()
      .css('display', 'inline-block')
    $('.order2')
      .fadeIn()
      .css('display', 'inline-block')
  })
  //$('.btnOrder').on('click', function () {
  //    var FundId = $(this).attr("fundid");
  //    var Link = $(this).attr("data-buylink");
  //    $(".buyNow").attr("href", Link);
  //    var FundName = FundIdWithName(FundId);
  //    $(".buyNow").attr("Onclick", "");
  //    console.log(this);
  //    $(".contactServe").attr("fundid", FundId);
  //    $('.lightbox').fadeIn();
  //    $('.lbOrder').fadeIn().css("display", "inline-block");
  //    $('.order1').fadeIn().css("display", "inline-block");
  //});

  $('.btnVideo').on('click', function() {
    $('.lightbox').fadeIn()
    $('.lbVideo')
      .fadeIn()
      .css('display', 'inline-block')
  })

  $('.lbX').on('click', function() {
    $('.contactServe').attr('fundId', '')
    $('.btnSend').attr('FundId', '')
    $('.orderBox .buyNow').attr('Onclick', '')
    $('.trendPic, .trendPic > div, .orderBox').fadeOut()
    $('.lbContent').fadeOut()
    $('.lightbox').fadeOut()
  })

  $('.nobub').on('click', function(e) {
    e.stopPropagation()	
  })
  
  $('.gtag').on('click', function() {
    var evt = $(this).data('ga')
    if(evt != "") gtag('event', evt)
	console.log('ga event', evt)	
  })
}

/*========== TweenMax Animation ==========*/
/* Variables */
var INIT_SET = { y: '-20px', opacity: 0, ease: Power3.easeOut }
var TITLETIME = 1
var AFTER_TITLE_TIME = '-=0.75'

/* Setting */
var lineW = $('.probability .line').width();
$('.probability .line').find('img').width(lineW);

var marketAni = new TimelineMax({ paused: true })
marketAni
.from('.market .stdTitle', TITLETIME, INIT_SET)
  .from('.probability_man', .8, { opacity: 0, ease: Power1.easeOut })
  .staggerFrom('.probability .bg', .8, { opacity: 0, ease: Power1.easeOut }, 0.15, '-=.8')
  .from('.probability_line_1', .6, { width: 0, ease: Power0.easeOut }, '-=.4')
  .from('.probability_txt_1', .5, { opacity: 0, ease: Power0.easeOut }, '-=.2')
  .from('.probability_line_2', .6, { width: 0, ease: Power0.easeOut }, '-=.0')
  .from('.probability_txt_2', .5, { opacity: 0, ease: Power0.easeOut }, '-=.2')
  .from('.probability_line_3', .6, { width: 0, ease: Power0.easeOut }, '-=.0')
  .from('.probability_txt_3', .5, { opacity: 0, ease: Power0.easeOut, onComplete: function(){
      TweenMax.to('.probability_txt_2', .6, { opacity: .3, yoyo: true, repeat: -1, ease: Power0.easeIn}); 
  } }, '-=.2')

var ADVICE_TIME = 2.5;
var adviceAni = new TimelineMax({ paused: true });
if (winW > 640) {
    adviceAni
    .from('.target .stdTitle', TITLETIME, INIT_SET)
      .from('.target .sWord', .8, { y: '-20px', opacity: 0, ease: Power3.easeOut }, AFTER_TITLE_TIME)  
      .from('.target_pc', .8, { opacity: 0, y: 50, ease: Circ.easeOut }, '-=.8')
      .staggerFrom(
        '.target_pc .tFlag',
        1.2,
        { y: '+20', opacity: 0, ease: Elastic.easeOut },
        1,
        AFTER_TITLE_TIME
      )
}else{
    adviceAni
    .from('.target .stdTitle', TITLETIME, INIT_SET)
      .from('.target .sWord', .8, { y: '-20px', opacity: 0, ease: Power3.easeOut }, AFTER_TITLE_TIME)  
      // .from('.target_mobile', .8, { opacity: 0, y: 50, ease: Circ.easeOut }, '-=.8')
      .from('.target_mobile .target_flag01', .6, { x: '-20', opacity: 0, ease: Elastic.easeOut })
      .from('.target_mobile .target_flag02', .6, { x: '+20', opacity: 0, ease: Elastic.easeOut }, '-=.4')
      .from('.target_mobile .target_flag03', .6, { x: '-20', opacity: 0, ease: Elastic.easeOut }, '-=.4')
      .from('.target_mobile .target_flag04', .6, { x: '+20', opacity: 0, ease: Elastic.easeOut }, '-=.4')
}

var advice3Ani = new TimelineMax({ paused: true });
// if (winW > 640) {
//     advice3Ani
//       .from('.advice3 .stdTitle', .8, { y: '-20px', opacity: 0, ease: Power3.easeOut })
//       .from('.advice3 .advice3_h4', .8, { y: '-20px', opacity: 0, ease: Power3.easeOut }, '-=.2')  
//       .from('.advice3_chart', .8, { opacity: 0, ease: Circ.easeOut })
//       .from('.advice3_chart .left', .6, { opacity: 0, x: 20, ease: Circ.easeOut })
//       .from('.advice3_chart .right', .6, { opacity: 0, ease: Circ.easeOut }, '-=.1')
//       .staggerFrom('.cursorArea', .5, { opacity: 0, x: -20, ease: Power1.easeOut }, .17, '-=.1')
// }
if (winW > 640) {
  advice3Ani
    .from('.advice3 .stdTitle', TITLETIME, INIT_SET)
    .from('.advice3 .advice3_h4', .8, { y: '-20px', opacity: 0, ease: Power3.easeOut }, AFTER_TITLE_TIME)
    .staggerFrom(
      '.advice3 .adviceBlock .moveBar',
      2,
      { x: '+400', opacity: 0, ease: Power3.easeOut },
      0.8,
      AFTER_TITLE_TIME
    )
}else{
  advice3Ani
  .from('.advice3 .stdTitle', TITLETIME, INIT_SET)
  .from('.advice3 .advice3_h4', .8, { y: '-20px', opacity: 0, ease: Power3.easeOut }, AFTER_TITLE_TIME)
  .staggerFrom(
      '.advice3 .adviceBlock',
      1,
      { y: '+50', opacity: 0, ease: Power3.easeOut },
      0.8,
      '-=.2'
    )
}

var trendAni = new TimelineMax({ paused: true })
trendAni
  .from('.trend .stdTitle', TITLETIME, INIT_SET)
  .staggerFrom(
    '.trend .slipIn',
    2,
    { y: '+20', opacity: 0, ease: Power3.easeOut },
    0.15,
    AFTER_TITLE_TIME
  )

 var productsAni = new TimelineMax({ paused: true })
if (winW > 640) {
 productsAni
   .from('.products .stdTitle', TITLETIME, INIT_SET)
   .staggerFrom(
     '.products .slipIn',
     0.6,
     { y: '+20', opacity: 0, ease: Power2.easeOut },
     0.15,
     AFTER_TITLE_TIME
   )
   .from('.products .content',  .6, { opacity: 0, y: 30, ease: Quart.easeOut}, '-=.2')
   .from('.products .picBox',  .6, { opacity: 0, x: -10, ease: Quart.easeOut}, '-=.2');
}else{
 productsAni
   .from('.products .stdTitle', TITLETIME, INIT_SET)
   .staggerFrom(
     '.products .slipIn',
     0.6,
     { y: '+20', opacity: 0, ease: Power2.easeOut },
     0.15,
     AFTER_TITLE_TIME
   )
   .from('.products .content',  .6, { opacity: 0, y: 30, ease: Quart.easeOut}, '-=.2')
   .from('.products .picBox',  .6, { opacity: 0, y: -10, ease: Quart.easeOut}, '-=.2');
}

var hotAni = new TimelineMax({ paused: true })
hotAni
  .from('.hot .stdTitle', TITLETIME, INIT_SET)
  .staggerFrom(
    '.hot .slipIn, .hot .picBox',
    0.6,
    { y: '+20', opacity: 0, ease: Power3.easeOut },
    0.15,
    AFTER_TITLE_TIME
  )
/*==========END TweenMax Animation END==========*/

var sec_array = [
    '.pvSec5',
    '.pvSec4',
    '.pvSec3',
    '.pvSec2',
    '.pvSec1'
  ],
  pv_array = ['hot','advice3', 'advice1', 'market', 'kv'],
  sec_now = ''

$(window).scroll(function() {
  var scrollVal = $(this).scrollTop()
  var scrollBottom = $(this).scrollTop() + $(window).height()
  var kvTop = $('.kv').offset().top,
    marketTop = $('.market').offset().top,
    adviceTop = $('.target').offset().top,
    advice3Top = $('.advice3').offset().top,
    // trendTop = $('.trend').offset().top,
    productsTop = $('.products').offset().top,
    hotTop = $('.hot').offset().top

  var headerH = $('header').height()

  if (scrollVal > $('.kv').height()) {
    $('.btnTop').fadeIn()
  } else {
    $('.btnTop').fadeOut()
  }

  if (winW > 640) {
    if (scrollVal > $('.kv').height() / 5) {
      $('header').addClass('bgBlue')
      $('.joinBox').addClass('bgBlue')
    } else {
      $('header').removeClass('bgBlue')
      $('.joinBox').removeClass('bgBlue')
    }
    if (scrollVal > adviceTop && scrollVal < advice3Top-700) {
      $('.joinBox').removeClass('bgBlue')
    }
  }
  //  else {
  //   if (scrollVal > $('.kv').height()) {
  //     $('.mJoinBox').fadeIn()
  //   } else {
  //     $('.mJoinBox').fadeOut()
  //   }
  //   if (scrollVal > adviceTop && scrollVal < advice3Top-200) {
  //     $('.mJoinBox').removeClass('bgBlue')
  //   }
  // }

  // 動態
  var ACTIVE_OFFSET = 300
  if (scrollBottom >= marketTop + ACTIVE_OFFSET) {
    marketAni.play()
  }
  if (winW > 640 && scrollBottom >= adviceTop + $('.advice').height() / 2) {
    adviceAni.play()
  } else if ((winW <= 640 && scrollBottom >= adviceTop)) {
    adviceAni.play()
  }
  if (scrollBottom >= advice3Top + ACTIVE_OFFSET) {
    advice3Ani.play()
  }
  // if (scrollBottom >= trendTop + ACTIVE_OFFSET) {
  //   trendAni.play()
  // }
   if (scrollBottom >= productsTop + ACTIVE_OFFSET) {
     productsAni.play()
   }
  if (scrollBottom >= hotTop + ACTIVE_OFFSET) {
    hotAni.play()
  }

  // Menu定位
  if (scrollVal >= kvTop) {
    $('.nav li').removeClass('pin')
    $('.kvMenu').addClass('pin')
  }
  if (scrollVal >= adviceTop - headerH) {
    $('.nav li').removeClass('pin')
    $('.adviceMenu').addClass('pin')
  }
  if (scrollVal >= advice3Top - headerH) {
    $('.nav li').removeClass('pin')
    $('.advice3Menu').addClass('pin')
  }
  // if (scrollVal >= trendTop - headerH) {
  //   $('.nav li').removeClass('pin')
  //   $('.trendMenu').addClass('pin')
  // }
   if (scrollVal >= productsTop - headerH) {
     $('.nav li').removeClass('pin')
     $('.productsMenu').addClass('pin')
   }
  if (scrollVal >= hotTop - headerH) {
    $('.nav li').removeClass('pin')
    $('.hotMenu').addClass('pin')
  }

  // if(scrollVal>950){
  // }else{
  // };

  $.each(sec_array, function(i, sec) {
    if (isScrolledIntoView(sec)) {
      if (sec_now == '' || sec_now != sec) {
        sec_now = sec
        //gtag('config', $this.gaid, {'page_title' : $this.pv_array[i]});
        gtag('event', pv_array[i])
        console.log('scroll event', pv_array[i]);

		//console.log('PV = '+$this.pv_array[i]);
        //console.log('GA id = '+$this.gaid);
		sec_array.splice(i, 1);
    pv_array.splice(i, 1);

      }
    }
  })
}) 
//}).scroll()

function gotop() {
  $('html, body')
    .stop()
    .animate(
      {
        scrollTop: 0
      },
      1000
    )
}

// function await(){
//     var scrollVal = $(this).scrollTop();
//     var scrollBottom = $(this).scrollTop() + $(window).height();
//     var headerH = $('header').height();
//     var marketTop = $('.market').offset().top,
//         adviceTop = $('.advice').offset().top;
//     if(scrollBottom < marketTop +($('.market').height()*0.4)){
//         $('html, body').stop().animate({
//             scrollTop: marketTop - headerH
//         }, 500);
//     }
// }
function goPin() {
  var headerH = $('header').height()

  // 茅點
  //先取得網址字串，假設此頁網址為「index.aspx?id=U001&name=GQSM」
  var url = location.href

  //再來用去尋找網址列中是否有資料傳遞(QueryString)
  if (url.indexOf('?') != -1) {
    var id = ''
    //在此直接將各自的參數資料切割放進ary中
    var ary = url.split('?')[1].split('?')
    //此時ary的內容為：
    //ary[0] = 'id=U001'，ary[1] = 'name=GQSM'

    //下迴圈去搜尋每個資料參數
    for (i = 0; i <= ary.length - 1; i++) {
      //如果資料名稱為id的話那就把他取出來
      if (ary[i].split('=')[0] == 'id') id = ary[i].split('=')[1]
    }

    $('html, body')
    .stop()
    .animate(
      {
        scrollTop: $('.' + ary[0]).offset().top - headerH
      },
      500
    )
  } else if (url.indexOf('#') != -1) {
    var anchor = ['cloud', 'elder', 'health', 'product'];
    var inAnchor = false;
    var hash = url.split('#')[1];
    var hashIdx;
    
    $.each(anchor, function(idx, val) {
      if (inAnchor === false) {
        inAnchor = hash === val ? true : false;
        hashIdx = idx;
      }
    })

  
    // if (hash === 'product' && inAnchor) {
    //   $('html, body').stop().animate({
    //     scrollTop: $('#products').offset().top - headerH
    //   }, 500); 
    // } else 
    if (inAnchor) {
      $('._slick').slick('slickGoTo', hashIdx);
  
      $('html, body').stop().animate({
        scrollTop: $('#trend').offset().top - headerH
      }, 500); 
    }
  }
}

// $(function () {
//     //設定陣列參數
//     var areaNum = ["02", "03", "037", "04", "049", "05", "06", "07", "08", "089", "082", "0826", "0836"];
//     //設定for迴圈的i等於array的陣列長度
//     for( i in areaNum){
//         //將Option加入ID為area-num的Select的標籤
//         $(".area-num").append($("<option value='" + areaNum[i] + "'>" + areaNum[i] + "</option>"));
//     }

//     var age = 30,
//         lowest = 40;

//     for (var i = 0; i <= age; i++) {
//         //處理 a[i]
//         // console.log(i)
//         ageopt=i+lowest;
//         $(".ageselect").append($("<option value='" + ageopt + "'>" + ageopt + "</option>"));
//     }
//     $(".ageselect option:first, .area-num option:first").attr("disabled", "disabled");
// });

function isScrolledIntoView(elem) {
  var docViewTop = $(window).scrollTop() + 150
  //console.log('window.scrollTop = '+docViewTop);
  if(!$(elem).length) return;
  var elemTop = $(elem).offset().top
  var elemBottom = elemTop + $(elem).height()
  //console.log(elem+'.top = '+elemTop);
  //console.log(elem+'.bottom = '+elemBottom);
  return docViewTop >= elemTop && docViewTop < elemBottom
}
function FundIdWithName(FundId) {
  if (FundId === 'G011A') {
    return '凱基醫院及長照產業基金'
  } else if (FundId === 'G006') {
    return '凱基雲端趨勢基金'
  } else if (FundId === 'G010A') {
    return '凱基銀髮商機基金'
  }
  return ''
}

$(function() {
  var main = myScript()
})
