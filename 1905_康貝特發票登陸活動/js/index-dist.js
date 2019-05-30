var headerNavLi = $('.header-nav ul li');
var indexlogo = $('.logo-index');
var indexlogoB = $('.logo-index2');
var indexPage = $('.index-page');
var slogan = $('.main-slogan');
var product = $('.main-product');
var wave = $('.main-img div');
var mainImg = $('.main-img');
var mainBtn = $('.main-btn');
var nextBtn = $('.next-btn');
var submitBtn = $('.submit-btn');
var mainIndex = $('.main-index');
var receipt = $('.receiptWrapper');
var topTitleA = $('.topTitle01');
var topTitleB = $('.topTitle02');
var detailWrapper = $('.detailWrapper');
var listWrapper = $('.listWrapper');
var footer = $('footer');
const $progressBar = $('.page-loading .progress-bar');

listenImagesLoading(
  $('img'),
  mainFunc,
  function (per, instance) {
    $progressBar.css({
      width: per + '%'
    });
  }
);

$(document).ready(function () {
  $('.sample-btn').magnificPopup({
    type: 'image'
  });
  $('.private-btn').magnificPopup({
    type: 'inline',
    midClick: true
  });
  $('.scrollbar-inner').scrollbar();

  mainBtn.hover(
    function () {
      TweenMax.to(mainBtn, 0.1, {
        css: {
          scale: 1.05
        }
      });
    },
    function () {
      TweenMax.to(mainBtn, 0.1, {
        css: {
          scale: 1
        }
      });
    }
  );


  TweenMax.fromTo(slogan, 1, {
    css: {
      scale: 0
    },
    opacity: 0,
    autoAlpha: 1
  }, {
    css: {
      scale: 1
    },
    opacity: 1,
    autoAlpha: 1,
    delay: .5,
    ease: Elastic.easeOut,
    pause: true
  });
  TweenMax.fromTo(product, 1, {
    y: 100,
    opacity: 0,
    autoAlpha: 1
  }, {
    y: 0,
    opacity: 1,
    autoAlpha: 1,
    delay: 1,
    ease: Elastic.easeOut,
    pause: true
  });

  if (device.mobile()) {
    mainImg.hide();
    product.hide();
  }

  var tweenIndex = new TimelineMax({
    paused: true
  });
  var tweenReceipt = new TimelineMax({
    paused: true
  });
  var tweenDetailA = new TimelineMax({
    paused: true
  });
  var tweenDetailB = new TimelineMax({
    paused: true
  });
  // var tweenList = new TimelineMax({paused:true});

  tweenIndex.to(mainIndex, 0.5, {
    css: {
      scale: 0,
      opacity: 0,
    },
    ease: Expo.easeOut,
    pause: true
  });

  tweenReceipt.fromTo(receipt, 0.2, {
    css: {
      marginTop: -1000
    },
    opacity: 0,
    autoAlpha: 1
  }, {
    css: {
      marginTop: 0
    },
    opacity: 1,
    autoAlpha: 1,
    ease: Expo.easeOut,
  });

  tweenDetailA.fromTo(topTitleA, 0.2, {
    css: {
      marginTop: -500
    },
    opacity: 0,
    autoAlpha: 1
  }, {
    css: {
      marginTop: 0
    },
    opacity: 1,
    autoAlpha: 1,
    ease: Expo.easeOut,
  });
  tweenDetailB.fromTo(topTitleB, 0.2, {
    css: {
      marginTop: -500
    },
    opacity: 0,
    autoAlpha: 1
  }, {
    css: {
      marginTop: 0
    },
    opacity: 1,
    autoAlpha: 1,
    ease: Expo.easeOut,
  });

  var navB = headerNavLi.eq(1);


  headerNavLi.eq(0).on('click', function () {
    indexPage.removeClass('bgChange');
    detailWrapper.fadeOut();
    listWrapper.fadeOut();
    indexlogo.fadeOut();
    mainImg.fadeIn();
    mainIndex.show();
    footer.show();
    if (device.mobile()) {
      mainImg.hide();
      product.hide();
    }
    var isReversed = tweenIndex.reverse() && tweenReceipt.reverse() && tweenDetailA.reverse() && tweenDetailB.reverse();
    if (!isReversed) {
      isReversed;
    }
  });

  headerNavLi.eq(2).on('click', function () {
    indexPage.addClass('bgChange');
    listWrapper.fadeOut();
    mainIndex.hide();
    mainImg.fadeOut();
    indexlogo.fadeIn();
    footer.hide();
    $(this).on("click", function () {
      $('.scrollbar-inner').scrollTop(0);
    });
    var isPlayed = tweenDetailA.play() && tweenDetailB.reverse() && tweenIndex.play() && tweenReceipt.reverse();
    if (!isPlayed) {
      isPlayed;
    }
    detailWrapper.fadeIn();
  });

  headerNavLi.eq(3).on('click', function () {
    indexPage.addClass('bgChange');
    detailWrapper.fadeOut();
    mainIndex.hide();
    mainImg.fadeOut();
    indexlogo.fadeIn();
    footer.hide();
    $(this).on("click", function () {
      $('.scrollbar-inner').scrollTop(0);
    });
    var isPlayed = tweenDetailB.play() && tweenDetailA.reverse() && tweenIndex.play() && tweenReceipt.reverse();
    if (!isPlayed) {
      isPlayed;
    }
    listWrapper.fadeIn();
  });

  mainBtn.add(navB).on('click', function (evt) {
    indexPage.addClass('bgChange');
    detailWrapper.fadeOut();
    listWrapper.fadeOut();
    mainIndex.hide();
    indexlogo.fadeIn();
    mainImg.fadeIn();
    footer.hide();
    if (device.mobile()) {
      mainImg.hide();
    }
    $('.inputStepB').hide();
    $('.inputStepA').show();
    var isPlayed = tweenIndex.play() && tweenReceipt.play() && tweenDetailA.reverse() && tweenDetailB.reverse();
    headerNavLi.removeClass('active');
    headerNavLi.eq(1).addClass('active');
    if (!isPlayed) {
      isPlayed;
    }
  });

  nextBtn.on('click', function (evt) {
    $('.inputStepA').hide();
    $('.inputStepB').fadeIn();
  });

});


/*==================================================*\
        Main Function
\*==================================================*/
const PAGE_HEADER_ACTIVE = 'menuOpen';
let $header;
let $hamburger;
let $headerNav;

function mainFunc() {

  $header = $('.page-header');
  $hamburger = $('.hamburger');
  $headerNav = $('.header-nav ul');

  /* window 事件: Resize & scroll */
  windowEvents();

  /***** Header *****/
  // Hamburger
  $hamburger.on('click', function (evt) {
    evt.preventDefault();
    evt.stopPropagation();
    $header.toggleClass(PAGE_HEADER_ACTIVE);
    indexlogoB.fadeToggle("fast");

    if ($header.hasClass(PAGE_HEADER_ACTIVE)) {
      $headerNav.stop().fadeIn(DURATION.STD);
      indexlogoB.fadeIn("fast");
    } else {
      $headerNav.stop().fadeOut(DURATION.STD);
      indexlogoB.fadeOut("fast");
    }
  });

  $doc.on('click', function () {
    if ($header.hasClass(PAGE_HEADER_ACTIVE)) {
      $headerNav.stop().fadeOut(DURATION.STD);
      $header.removeClass(PAGE_HEADER_ACTIVE);
      indexlogoB.fadeOut("fast");
    }
  });

  headerNavLi.on('click', function (evt) {
    $(this).addClass('active');
    $(this).siblings().removeClass('active');
  });

  /* 收掉 .page-loading */
  transitionThenRemove({
    dom: $(".page-loading"),
    duration: DURATION.STD,
    callback: function () {
      console.log("%cBuild Completed!", logSafeStyle);
    }
  });
}

/*==================================================*\
        window Events
\*==================================================*/
let isFirstTime = true;
let sectionPos;
let footerPos;
let headerTopH;
let headerNavH;
let headerTotalH;

function windowEvents() {
  // Window Resize
  $win.on("resize", _resize).resize();
  // Window Scroll
  // $win.on("scroll", _scroll).scroll();
}

function listPC() {
  htmlD = $.ajax({
    url: "./includes/list.html",
    async: false
  });
  $("#listLoad").html(htmlD.responseText);
}

function listMB() {
  htmlM = $.ajax({
    url: "./includes/m_list.html",
    async: false
  });
  $("#listLoad").html(htmlM.responseText);
}

/*========== Window Resize ==========*/
function _resize() {
  getSize();

  winW > 1023 ? listPC() : listMB();
  var listTabLi = $('.tabWrapper ul li');
  var listTabM = $('.m_listWrapper').find('.tabWrapper');
  $('.m_listWrapper.showmeFirst').find('.listInner').slideDown();
  $('.m_listWrapper.showmeFirst').find('i').addClass('rotate');

  listTabLi.on('click', function (evt) {
    $(this).addClass('active');
    $(this).siblings().removeClass('active');
  });
  listTabM.on('click', function (evt) {
    $(this).addClass('active');
    $(this).siblings().removeClass('active');

    if ($(this).find('i').hasClass('rotate')) {
      $(this).find('i').removeClass('rotate');
    } else {
      $(this).find('i').toggleClass('rotate');
    }

    $(this).siblings('.listInner').slideToggle();
    $(this).parent().siblings().find('.listInner').slideUp();
    $(this).parent().siblings().find('i').removeClass('rotate');
  });

  // 斷點偵測
  // detectiveBreakpoint([
  //   {
  //     minimum: -1,
  //     mq: function() {}
  //   },
  //   {
  //     phoneMini: 320,
  //     mq: function() {}
  //   },
  //   {
  //     phone: 400,
  //     mq: function() {}
  //   },
  //   {
  //     phoneWide: 480,
  //     mq: function() {}
  //   },
  //   {
  //     phablet: 560,
  //     mq: function() {}
  //   },
  //   {
  //     tabletSmall: 640,
  //     mq: function() {}
  //   },
  //   {
  //     tablet: 768,
  //     mq: function() {}
  //   },
  //   {
  //     tabletWide: 1024,
  //     mq: function() {}
  //   },
  //   {
  //     notebook: 1366,
  //     mq: function() {}
  //   },
  //   {
  //     desktop: 1680,
  //     mq: function() {}
  //   }
  // ]);
}

function getSize() {
  winW = $win.width();
  winH = $win.height();
}

/*========== Window Scroll ==========*/
// let nowPos;
// function _scroll() {
//   getPos();
// }

// function getPos() {
//   nowPos = {
//     x: $doc.scrollLeft(),
//     y: $doc.scrollTop()
//   };
// }

/*==================================================*\
        Library
\*==================================================*/
/* 斷點偵測 (for window resize) */
// let preBP = { minimum: -1 };
// function detectiveBreakpoint(breakpoint) {
//   let nowBP = breakpoint[0];

//   $.each(breakpoint, (idx, obj) => {
//     const objName = Object.getOwnPropertyNames(obj)[0];
//     const val = obj[objName];

//     if (winW > val && val > nowBP[Object.getOwnPropertyNames(nowBP)[0]]) {
//       nowBP = obj;
//     }
//   });

//   if (
//     Object.getOwnPropertyNames(nowBP)[0] ===
//     Object.getOwnPropertyNames(preBP)[0]
//   ) {
//     return false;
//   }

//   // 執行 Media Query
//   mediaQuery(nowBP);
// }

// // 執行 Media Query
// function mediaQuery(nowBP) {
//   const nowBPName = Object.getOwnPropertyNames(nowBP)[0];
//   console.log(`Breakpoint {${nowBPName}: ${nowBP[nowBPName]}}`);

//   // 執行該斷點 Media Query
//   if (!nowBP.hasOwnProperty("mq")) {
//     throw new Error(`此斷點(↑)尚未設定 Media Query 之屬性 "mq"(function)`);
//   } else if (typeof nowBP.mq !== "function") {
//     throw new Error(`此中斷點之 Media Query 型別並非 "function`);
//   } else {
//     nowBP.mq();
//   }

//   preBP = nowBP;
// }

//# sourceMappingURL=index-dist.js.map