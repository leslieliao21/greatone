$(function () {
  'use strict' // 採用嚴格模式

  /*==================== Vaiables ====================*/
  // Window, Document
  var $win = $(window)
  var winW
  var winH
  var $doc = $('html, body')
  var $body = $('body')

  // console.log Style
  var logSafeStyle = 'color: green; font-weight: bold;'
  var logErrorStyle = 'color: red; font-weight: bold;'
  var logInfoStyle = 'color: blue;'

  // Constant
  var STD_DURATION = 300

  // Dom Data
  var headerH
  var $footer
  var footerPos = 0

  var options = {
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: false,
    lazyLoad: 'ondemand',
    // autoplaySpeed: 4000,
    dots: false,
    // arrows: false,
    prevArrow: '<div class="prevBtn"></div>',
    nextArrow: '<div class="nextBtn"></div>',
    // fade: true,
    cssEase: 'ease-out'
  }

  if ($('.iconPage').length > 0) {
    $('.icon-slider').on('init', function () {});
    
    $('.icon-slider').slick(options);
    
    
  }



// Others
// Header 選單Metadata
// var menuList = {
//   about: {
//     id: 0,
//     subMenu: ['aboutPage', 'tnfTaiwanPage', 'sponsorPage']
//   },
//   act: {
//     id: 1,
//     subMenu: [
//       'tnf2019Page',
//       'snowPage',
//       'hikingPage',
//       'campingPage',
//       'outdoorTrainingPage',
//       'climbingPage',
//       'skiPage',
//       'orienteeringPage'
//     ]
//   },
//   shop: {
//     id: 2
//   },
//   qa: {
//     id: 3
//   }
// }

// 狀態: 頁面是否有 .signUp || .review
var isNoSignUp
var isNoReview
// 右側固定選單 Metadata
var fixedSidebarPos = {
  introduction: {
    id: 0,
    pos: 0
  },
  course: {
    id: 1,
    pos: 0
  },
  origin: {
    id: 2,
    pos: 0
  },
  googleMap: {
    id: 3,
    pos: 0
  },
  review: {
    id: 4,
    pos: 0
  },
  signUp: {
    id: 5,
    pos: 0
  }
}

// 右側固定選單 Metadata forNTF100
var ntfSidebarPos = {
  rules: {
    id: 0,
    pos: 0
  },
  information: {
    id: 1,
    pos: 0
  },
  registration: {
    id: 2,
    pos: 0
  },
  storage: {
    id: 3,
    pos: 0
  },
  traffic: {
    id: 4,
    pos: 0
  },
  internation: {
    id: 5,
    pos: 0
  },
  other: {
    id: 6,
    pos: 0
  },
  review: {
    id: 7,
    pos: 0
  },
  signUp: {
    id: 8,
    pos: 0
  }
}


// 判斷是否為測試站，是的話就帶入/tnf100
var prePath = location.origin == "http://demo.great2.com.tw" ? '/tnf100' : '';


if ($('body').hasClass('tnf100Page')) {
  fixedSidebarPos = ntfSidebarPos
}
// if ($('body').hasClass('orienteeringPage')) {
//   setTimeout(function(){ $(".session2").trigger('click'); }, 100);
// }

console.log('%cStart Build...', logInfoStyle)

// Load Header
var wdth = $(window).width();
if (wdth <= 768) {
  if ($('.pageHeader').hasClass('en')) {
    $('.pageHeader.en').load(prePath + '/includes/_page_header_en_m.html', _headerCallback);
  } else {
    $('.pageHeader').load(prePath + '/includes/_page_header_m.html', _headerCallback);
  }
} else {
  if ($('.pageHeader').hasClass('en')) {
    $('.pageHeader.en').load(prePath + '/includes/_page_header_en.html', _headerCallback);
  } else {
    $('.pageHeader').load(prePath + '/includes/_page_header.html', _headerCallback);
  }
}

// Menu Init
var $menu
var $subMenu
var $hamburger
var $header
var subMenuH = []

function _headerCallback() {
  console.log('%cHeader Completed', logSafeStyle)

  $menu = $('.menuPc')
  // $subMenu = $('.subMenu')
  $hamburger = $('.hamburger')
  $header = $('.pageHeader')

  /***** 選單設定 *****/
  var wdth = $(window).width();
  if (wdth > 768) {
    //default no hover
    var realHover = 0;

    //沒有submenu的選單滑入
    $(".menuPc > ul > li:not(.has-submenu)").hover(function () {
      $('.submenu').stop(true, false).slideUp(200);
      realHover = 0;
    });

    //有submenu的選單滑入
    $(".menuPc ul li.has-submenu").hover(function () {
      var submenuData = $(this).find('a.goSubmenu').data('submenu');
      $(this).siblings('.has-submenu').find('.submenu').slideUp(200);
      $('#' + submenuData).stop(true, false).slideDown(400);
      if (submenuData === 'TNF100') {
        realHover = 1;
      } else if (submenuData === 'infomation') {
        realHover = 2;
      }
    }, function () {
      if (realHover == 1 || realHover == 2) {
        $(this).find('.submenu').show();
      }
    });
    //離開header後submenu收回
    $("body > *:not(header)").hover(function () {
      $('.submenu').stop(true, false).slideUp(200);
      realHover = 0;
    });
  }

  /***** 繁/英 切換聯結設定 *****/
  var url = window.location.pathname;
  var fileName = url.substring(url.lastIndexOf('/') + 1);
  var $chLink = $('.pageHeader a.leng').eq(0);
  var $enLink = $('.pageHeader a.leng').eq(1);
  //有英文版的頁面名稱請加入以下陣列
  var enFiles = ['tnf100_2019', 'tnf100_2019_review', 'tnf100_2019_rule', 'tnf100_2019_info', 'jiufen', 'orienteering', 'cheerpark', 'info', 'news'];

  var temp = fileName.split('.')[0]; // 目前頁面名稱
  var hasEnPage = false;
  temp = temp.split('_en')[0];
  $.each(enFiles, function (idx, val) {
    if (temp === val) {
      hasEnPage = true;
    }
  });

  /***** 中英切換設定 *****/
  if ($('.enPage').length > 0) {
    // 英文版
    var chFileName = fileName.split('.');
    chFileName[0] = chFileName[0].split('_en');
    chFileName[0] = chFileName[0][0];
    chFileName = chFileName[0] + '.' + chFileName[1];

    $enLink.attr('href', './' + fileName);
    $chLink.attr('href', './' + chFileName);
  } else {
    // 中文版
    var enFileName = fileName.split('.');
    enFileName[0] += '_en';
    enFileName = enFileName[0] + '.' + enFileName[1];

    if (!hasEnPage) {
      $enLink.attr('href', prePath + '/' + enFiles[2] + '_en.html');
    } else {
      $enLink.attr('href', './' + enFileName);
    }

    $chLink.attr('href', './' + fileName);
  }

  // Load Footer
  $('.pageFooter').load(prePath + '/includes/_page_footer.html', _footerCallback)

  // 如果是測試站就加上/tnf100/的路徑
  $('header a').not(".leng, .goSubmenu, .has-submenu > a, .submenu-header > a, .historyReview > a").each(function (i, v) {
    if ($(v).attr('href').substr(0, 7) != 'http://' && $(v).attr('href').substr(0, 8) != 'https://')
      $(v).attr('href', prePath + $(v).attr('href'));
  });
}

function _footerCallback() {
  console.log('%cFooter Completed', logSafeStyle)
  $footer = $('.pageFooter')

  // 如果需要側欄，就下載 (好像說廢話...XD)
  if ($('.fixedSideBar').length > 0) {
    if ($('body').hasClass('tnf100Page')) {
      $('.fixedSideBar').load(
        prePath + '/includes/_fixed_side_bar_ntf100.html',
        _fixedSideBarCallback
      )
    } else {
      $('.fixedSideBar').load(
        prePath + '/includes/_fixed_side_bar.html',
        _fixedSideBarCallback
      )
    }
  } else {
    goMainFunction()
  }
}

var $fixedSideBar

function _fixedSideBarCallback() {
  console.log('%cFixed SideBar Completed', logSafeStyle)

  $fixedSideBar = $('.fixedSideBar')

  if ($('.climbingPage, .orienteeringPage').length > 0) {
    $fixedSideBar
      .find('.origin')
      .find('p')
      .html('報名須知')
  }

  goMainFunction()

  if ($('body').hasClass('hikingPage')) {
    $('.fixedSideBar .class p').html('步道簡介')
    $('.fixedSideBar .origin p').html('無痕山林概念')
  }
}

function goMainFunction() {
  console.log('%cImages Start Loading...', logInfoStyle)

  $('html, body')
    .imagesLoaded({
      background: true
    })
    .always(mainFunction) // Go Main Function
}

// function menuHints() {
//   var hint = $header.data('hint')

//   $.each(menuList, function (key, value) {
//     if (key === hint) {
//       var targetMenuItem = $menu.children().eq(value.id)
//       targetMenuItem.addClass('selected')

//       if (!menuList[key].subMenu.length) return
//       if (key !== 'about') {
//         targetMenuItem
//           .find('.subMenu')
//           .children()
//           .eq(getSubMenuIdx(key))
//           .addClass('selected')
//       }
//       /* about.html 的 submenu hint 在 scroll 作處理 */
//     }
//   })
// }

// function getSubMenuIdx(menuKey) {
//   var pageName = $body.data('hint')
//   var ans

//   $.each(menuList[menuKey].subMenu, function (idx, value) {
//     if (value === pageName) ans = idx
//   })

//   return ans
// }

// Load SignUp
// $('.signUp.nthuTest').load('includes/_signup.php', function () {
//   //james add START
//   var emailReg = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
//   var mobileReg = /^09[0-9]{8}$/
//   $('#join_form .submit').click(function (e) {
//     e.preventDefault()
//     var msg = ''
//     var name = $('#join_form [name=name]').val()
//     var sex = $('#join_form [name=gender]:checked').val()
//     var pid = $('#join_form [name=pid]').val()
//     var birthy = $('#join_form [name=birthy]').val()
//     var birthm = $('#join_form [name=birthm]').val()
//     var birthd = $('#join_form [name=birthd]').val()
//     var email = $('#join_form [name=email]').val()
//     var tel = $('#join_form [name=tel]').val()
//     var size = $('#join_form [name=size]').val()
//     var area_id = $('#join_form [name=area_id]').val()

//     if (area_id == '') msg = '請選擇場次'
//     else if (name == '') msg = '請輸入姓名'
//     else if ($('#join_form [name=gender]:checked').length == 0)
//       msg = '請選擇性別'
//     else if (pid == '') msg = '請輸入身份證號'
//     else if (birthy == '' || birthm == '' || birthd == '')
//       msg = '請輸入出生日期'
//     else if (email == '' || !email.match(emailReg)) msg = '請輸入正確Email'
//     else if (tel == '' || !tel.match(mobileReg)) msg = '請輸入正確聯絡電話'
//     else if (size == '') msg = '請輸入衣服尺寸'
//     if (msg) {
//       alert(msg)
//       return false
//     }

//     var data = {
//       name: name,
//       sex: sex,
//       pid: pid,
//       birthy: birthy,
//       birthm: birthm,
//       birthd: birthd,
//       email: email,
//       tel: tel,
//       size: size,
//       area_id: area_id
//     }
//     $.ajax({
//       url: 'ajax/join.php',
//       type: 'get',
//       dataType: 'json',
//       data: data,
//       error: function () {
//         alert('系統忙碌中，請稍後再試')
//         return false
//       },
//       success: function (res) {
//         if (res.success) {
//           alert('報名成功')
//           window.location.reload()
//           //$('#join_form .submit').unbind('click');
//         } else alert('報名失敗')
//       }
//     })
//   })
//   lightbox.init()
//   //james add END
// })

// lightbox.init()

/*==================================================*\
        Main Function
\*==================================================*/
var DEVICE_LINE = 768
var deviceName = ['pc', 'mobile']
var nowDeviceName = ''

var SLICK_SPEED = 400

function mainFunction() {
  /*==================== Initialization ====================*/
  console.log('%cBuild Completed!', logSafeStyle)

  /*
   * 判斷該頁是否有 .noSignUp || .noReview
   * 影響 scroll 功能
   */
  isNoSignUp = $body.hasClass('noSignUp') ? true : false
  isNoReview = $body.hasClass('noReview') ? true : false

  if (isNoSignUp) {
    delete fixedSidebarPos.signUp
  }
  if (isNoReview) {
    delete fixedSidebarPos.review
  }

  // Resize
  $win.on('resize', _resize).resize()
  // Scroll
  $win.on('scroll', _scroll).scroll()

  /***** Index Slick *****/
  if ($('.indexPage').length > 0) {
    // Carousel Setting
    $('._slick').slick({
      infinite: true,
      fade: true,
      autoplay: true,
      autoplaySpeed: 5000,
      speed: SLICK_SPEED,
      pauseOnHover: false,
      dots: true,
      arrows: false
    })

    var $kvListDots = $('.kvListDots')
    var $kvListDot = $('.kvListDots > div')
    $('._slick').on('beforeChange', function (
      event,
      slick,
      currentSlide,
      nextSlide
    ) {
      if (nextSlide === 0) {
        // $kvListDots.addClass('hide')
      } else if ($kvListDots.hasClass('hide')) {
        $kvListDots.removeClass('hide')
      }

      $kvListDot.removeClass('selected')
      // if (nextSlide === 0) {
      //   return false
      // } //  如果是形象圖就全部移除就結束
      $kvListDot
        .eq(nextSlide)
        .addClass('selected')
    })
  }

  if ($('.campingPage').length > 0) {
    $('.fixedSideBar li')
      .eq(1)
      .find('p')
      .html('活動流程')
  }

  // if ($('.tnf100_2019Page').length > 0) {
  //   $('._indSlick').slick({
  //     infinite: true,
  //     fade: true,
  //     autoplay: true,
  //     autoplaySpeed: 5000,
  //     speed: SLICK_SPEED,
  //     pauseOnHover: false,
  //     dots: true,
  //     arrows: false
  //   })
  // }

  // aboutPageAnchor()


  // MENU HOVER
  // function hoverSubMenuOut() {
  //   $(".hoverSubMenuIn").removeClass("hoverSubMenuIn");
  // }
  // function subsubOut() {
  //   $( ".subsubIn" ).removeClass("subsubIn");
  // }
  // var t;
  // $(".menu > *").hover(
  //   function () {
  //     clearTimeout(t);
  //     $(this).siblings().children(".hoverSubMenuIn").removeClass("hoverSubMenuIn");
  //     $(this).children(".subMenu").addClass("hoverSubMenuIn");
  //   },
  //   function () {
  //     t = setTimeout(hoverSubMenuOut, 500);
  //   }
  // );
  // var subsub;
  // $( ".subsubTitle" ).hover(
  //     function() {
  //         clearTimeout(subsub);
  //         $( this ).siblings().children(".subsubIn").removeClass("subsubIn");
  //         $( this ).children(".subsub").addClass("subsubIn");
  //     }, function() {
  //         t = setTimeout(subsubOut, 500);
  //     }
  // );

  /*==================== Main Content ====================*/
  /***** Utilties *****/
  $('.goTop').on('click', function (evt) {
    evt.preventDefault()
    $doc.animate({
        scrollTop: true
      },
      STD_DURATION
    )
  })

  $('.playlist .switchVideo').on('click', function () {
    $('.playlist .active').removeClass('active');
    $(this).addClass('active');
    var vid = $(this).data('vid'),
      vtitle = $(this).data('vtitle');
    $('#mainIframe').attr("src", "https://www.youtube.com/embed/" + vid);
    $('.vName').html(vtitle);
  })



  /***** Index *****/
  if ($('.indexPage').length > 0) {
    // 右側點點 Click Event
    $kvListDot.on('click', dotsClickHandler)

    function dotsClickHandler() {
      var $this = $(this)
      var idx = $this.index()

      // 改變外觀
      $kvListDot.removeClass('selected')
      $this.addClass('selected')

      // 內頁轉換 (+1 是因為要忽略掉第一幕形象圖)
      $('.slick-dots > li')
        .eq(idx)
        .children()
        .click()
    }
  }



  /***** activeTemplate *****/
  if (
    $('.activetiesTemplate').length > 0 ||
    $('.articlePage').length > 0 ||
    $('.tnf100_2019Page').length > 0 ||
    $('.iconPage').length > 0
  ) {
    // signUp Section
    // var $signUpBtn = $('.signUpBtn')
    // $signUpBtn.on('click', function () {
    //   var $this = $(this)
    //   $this
    //     .stop()
    //     .slideUp(STD_DURATION)
    //     .next()
    //     .stop()
    //     .slideDown(STD_DURATION)
    // })

    /*
     * 誤會取消報名是要收合表單，
     * 原意是讓已報名的人 "取消報名"
     */
    // $('.formBtnWrap .cancel').on('click', function (evt) {
    //   evt.preventDefault()
    //   // $signUpBtn.stop().slideDown(STD_DURATION)
    //   //   .next().stop().slideUp(STD_DURATION);
    // })

    // Slick Carousel Lightbox Event
    // 綁定 lightbox 相關按鈕
    lightbox.init()
  }

  /***** outdoorTrainingPage *****/
  if ($('.outdoorTrainingPage').length > 0) {
    $('.toBannerBlock').on('click', function () {
      scrollToIdx(0)
    })
  }

  /***** tnf100_2019_info_en *****/
  if ($('.tnf100_2019_infoPage.enPage').length > 0) {
    var href = location.href;
    var headerOffset = winW > 768 ? $('.tnf100subMenu > a').height() : $('.tnf1002019_fixed li').height();
    href = href.split('?')[1];
    if (!!href) {
      href = href.split('=')[1];

      $('html, body').animate({
        scrollTop: $('#' + href).offset().top - headerH - headerOffset
      });
    }
  }

  /***** orienteeringPage *****/

  $('.orienteeringPage .session1').on('click', function () {
    $('.orienteeringPage .session1')
      .addClass('selected')
      .siblings()
      .removeClass('selected')
    $('.orienteeringPage .titlePlace').html('台中場')
    $('.orienteeringPage .actTime').html('時間：2018年9月9日下午13:30~16:30')
    $('.orienteeringPage .actPlace').html('地點：台中市都會公園')
    $('.orienteeringPage .googleMap').html(
      '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3638.9700703690855!2d120.59662741499012!3d24.207827784365843!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x346915bf026727a3%3A0xe703e38159c1f9b0!2z6YO95pyD5YWs5ZyS!5e0!3m2!1szh-TW!2stw!4v1534241346330" frameborder="0" style="border:0" allowfullscreen></iframe>'
    )
    $('.orienteeringPage .soonBtn.taichung')
      .css('display', 'flex')
      .siblings()
      .hide()
    $('.orienteeringPage .forKao').hide()
    $('.orienteeringPage .notKao').show()
  })
  $('.orienteeringPage .session2').on('click', function () {
    $('.orienteeringPage .session2')
      .addClass('selected')
      .siblings()
      .removeClass('selected')
    $('.orienteeringPage .titlePlace').html('高雄場')
    $('.orienteeringPage .actTime').html('時間：2018年9月15日下午13:30~16:30')
    $('.orienteeringPage .actPlace').html('地點：高雄美術館/生態藝術園')
    $('.orienteeringPage .googleMap').html(
      '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3681.9290900796095!2d120.286263!3d22.6564323!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x346e0451f1321009%3A0x4f90af4e670c3d1f!2z6auY6ZuE5biC56uL576O6KGT6aSo!5e0!3m2!1szh-TW!2stw!4v1535597533631" frameborder="0" style="border:0" allowfullscreen></iframe>'
    )
    $('.orienteeringPage .soonBtn.kaohsiung')
      .css('display', 'flex')
      .siblings()
      .hide()
    $('.orienteeringPage .forKao').show()
    $('.orienteeringPage .notKao').hide()
  })
  $('.orienteeringPage .session3').on('click', function () {
    $('.orienteeringPage .session3')
      .addClass('selected')
      .siblings()
      .removeClass('selected')
    $('.orienteeringPage .titlePlace').html('台北場')
    $('.orienteeringPage .actTime').html('時間：2018年9月16日下午13:30~16:30')
    $('.orienteeringPage .actPlace').html('地點：新生園區')
    $('.orienteeringPage .googleMap').html(
      '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3613.916081542377!2d121.52920021473952!3d25.070833283955093!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3442a956d210e71b%3A0x8bc2d6620dacbe60!2z6Iqx5Y2a5YWs5ZyS5paw55Sf5ZyS5Y2A!5e0!3m2!1szh-TW!2stw!4v1534241460148" frameborder="0" style="border:0" allowfullscreen></iframe>'
    )
    $('.orienteeringPage .soonBtn.taipei')
      .css('display', 'flex')
      .siblings()
      .hide()
    $('.orienteeringPage .forKao').hide()
    $('.orienteeringPage .notKao').show()
  })

  /***** exploringPage *****/

  if ($('body').hasClass('exploringPage')) {
    $('.reviewChu, .reviewKao').hide();
  }

  $('.exploringPage .session1').on('click', function () {
    $('.reviewChu, .reviewKao').hide();
    $('.reviewPei').show();
    $('.exploringPage .session1')
      .addClass('selected')
      .siblings()
      .removeClass('selected')
    $('.exploringPage .titlePlace').html('台北阪急')
    $('.exploringPage ._event').html('阪急')
    $('.exploringPage .actTime').html('起程時間：2019/1/20(日) 13:00~19:00')
    $('.exploringPage .actPlace').html(
      '跳躍起點：台北統一時代2F戶外廣場 (台北市信義區忠孝東路五段8號2F)'
    )
    $('.exploringPage ._eventDate').html('1/20 (日)')
    $('.exploringPage .googleMap').html(
      '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3614.808592702558!2d121.56343755038158!3d25.04056898389059!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3442abbbdf915b99%3A0xb501f9aa3f479cdd!2zMTEw5Y-w5YyX5biC5L-h576p5Y2A5b-g5a2d5p2x6Lev5LqU5q61OOiZnw!5e0!3m2!1szh-TW!2stw!4v1544600730603" frameborder="0" style="border:0" allowfullscreen></iframe>'
    )
    // $('.exploringPage .soonBtn.taipei').css('display', 'flex').siblings().hide();
    $('.forChu, .forKao').hide()
    $('.forPei').show()
  })
  $('.exploringPage .session2').on('click', function () {
    $('.reviewKao, .reviewPei').hide();
    $('.reviewChu').show();
    $('.exploringPage .session2')
      .addClass('selected')
      .siblings()
      .removeClass('selected')
    $('.exploringPage .titlePlace').html('新竹巨城')
    $('.exploringPage ._event').html('巨城')
    $('.exploringPage .actTime').html('起程時間：2019/1/19(六) 13:00~19:00')
    $('.exploringPage .actPlace').html(
      '跳躍起點：新竹Big City 遠東巨城戶外廣場 (新竹市東區中央路229號)'
    )
    $('.exploringPage ._eventDate').html('1/19 (六)')
    $('.exploringPage .googleMap').html(
      '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3621.590088433064!2d120.97252695037655!3d24.809486083999797!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x346835c4e07f9681%3A0x761cb7cee32538e7!2zMzAw5paw56u55biC5p2x5Y2A5Lit5aSu6LevMjI56Jmf!5e0!3m2!1szh-TW!2stw!4v1544600681111" frameborder="0" style="border:0" allowfullscreen></iframe>'
    )
    // $('.exploringPage .soonBtn.kaohsiung').css('display', 'flex').siblings().hide();
    $('.forKao, .forPei').hide()
    $('.forChu').show()
  })
  $('.exploringPage .session3').on('click', function () {
    $('.reviewChu, .reviewPei').hide();
    $('.reviewKao').show();
    $('.exploringPage .session3')
      .addClass('selected')
      .siblings()
      .removeClass('selected')
    $('.exploringPage .titlePlace').html('高雄漢神巨蛋')
    $('.exploringPage ._event').html('漢神')
    $('.exploringPage .actTime').html('起程時間：2019/1/13(日) 13:00~19:00')
    $('.exploringPage .actPlace').html(
      '跳躍起點：高雄漢神巨蛋戶外廣場 (高雄市左營區博愛二路777號)'
    )
    $('.exploringPage ._eventDate').html('1/13(日)')
    $('.exploringPage .googleMap').html(
      '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3681.5759829131234!2d120.30009731496122!3d22.66959258513296!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x346e0508a4e3a31d%3A0x539a045c0687f824!2zODEz6auY6ZuE5biC5bem54ef5Y2A5Y2a5oSb5LqM6LevNzc36Jmf!5e0!3m2!1szh-TW!2stw!4v1544600607489" frameborder="0" style="border:0" allowfullscreen></iframe>'
    )
    // $('.exploringPage .soonBtn.taichung').css('display', 'flex').siblings().hide();
    $('.forChu, .forPei').hide()
    $('.forKao').show()
  })

  /***** tnf100Page *****/
  $('.otherContent a').on('click', function () {
    $(this)
      .parent()
      .toggleClass('active')
      .children('.otherBox')
      .slideToggle(500, 'linear')
  })

  if ($('body').hasClass('tnf100_2019Template')) {
    var thisPage = $('body').data('menu')

    $('.' + thisPage).addClass('here')

    $('.hamburger').on('click', function () {
      $('.tnf1002019_fixed').toggleClass('active')
    })

    $('.tnf100Menu').show()
    $('.menu > div:not(.tnf100Menu)').hover(
      function () {
        $('.tnf100subMenu').addClass('slideUp')
      },
      function () {
        $('.tnf100subMenu').removeClass('slideUp')
      }
    )
  }
  var targetId = location.href.split('#')[1];
  setTimeout(function () {
    $('html, body').stop().animate({
      scrollTop: ($('#' + targetId).offset().top - headerH -20)
    }, 400)
  }, 600);


  if (
    $('body').hasClass('tnf100_2019_epprojectPage') ||
    $('body').hasClass('tnf100_2019_rulePage')
  ) {
    if ($(window).width() <= 768) {
      $('.tnf1002019_fixed').scrollLeft(400)
    }
  }
  if (
    $('body').hasClass('tnf100_2019_regulationPage') ||
    $('body').hasClass('tnf100_2019_fansPage') ||
    $('body').hasClass('tnf100_2019_lecturesPage')
  ) {
    if ($(window).width() <= 768) {
      $('.tnf1002019_fixed').scrollLeft(900)
    }
  }

  /***** 2018 tnf100Page Review *****/
  // $('.tnf100_2019_reviewPage .js-pic-lb').on('click', function(){
  //   var imgSrc = $(this).data('history');
  //   $( '.lbReview img' ).attr( 'src', imgSrc );
  //   $('.lbReview').fadeIn();
  // })

  /***** Fixed Sidebar *****/
  if ($('.fixedSideBar').length > 0) {
    $('.fixedSideBar button').on('click', function () {
      var liIdx = $(this)
        .parent()
        .index()

      scrollToIdx(liIdx)
    })
  }

  function a() {
    $('body')
      .append('<img class="love" src="images/background/fish.jpg">')
      .imagesLoaded()
      .always(function () {
        $('.love').addClass('start'),
          setTimeout(function () {
            $('.love').remove()
          }, 3e3)
      })
  }
  var b = [],
    c = [73, 76, 79, 86, 69, 89, 79, 85]
  $win.on('keyup', function (e) {
    b.push(e.keyCode),
      b.every(function (e, n) {
        return e === c[n]
      }) ?
      b.length < 8 || a() :
      b.splice(0, b.length)
  })

  // Remove Loading Layer
  $('.loading').fadeOut(STD_DURATION, function () {
    setTimeout(function () {
      $(this).remove()
    }, STD_DURATION)
  })
}

function aboutPageAnchor() {
  if (!!$('.aboutPage').length > 0) {
    var href = location.href
    var anchor = href.split('target=')[1]

    if (!anchor) return

    $doc.animate({
        scrollTop: $('.js-' + anchor).offset().top - headerH
      },
      STD_DURATION
    )
  }
}

/*==================================================*\
                    Resize
\*==================================================*/
var isFirstTime = true

function _resize() {
  getSize()
  getHeaderH()
  footerPos = $footer.offset().top

  /*========== 過臨界點才會執行區域 ==========*/
  var device = winW > DEVICE_LINE ? deviceName[0] : deviceName[1]
  var prePath = location.origin == "http://demo.great2.com.tw" ? '/tnf100' : '';
  if (device === nowDeviceName) {
    // 降低 Resize 負擔
    return false
  } else {
    // 更新裝置名稱
    nowDeviceName = device
    console.log(
      '%cDevice is: ' + nowDeviceName + '(' + winW + 'px)',
      logInfoStyle
    )

    // 如果是手機版
    if (nowDeviceName === deviceName[1]) {
      // Load Header
      if ($('.pageHeader').hasClass('en')) {
        $('.pageHeader.en').load(prePath + '/includes/_page_header_en_m.html', _headerCallback);
      } else {
        $('.pageHeader').load(prePath + '/includes/_page_header_m.html', _headerCallback);
      }

      // mobileFunc()
      slickInit(3)
    } else {
      // Load Header
      if ($('.pageHeader').hasClass('en')) {
        $('.pageHeader.en').load(prePath + '/includes/_page_header_en.html', _headerCallback);
      } else {
        $('.pageHeader').load(prePath + '/includes/_page_header.html', _headerCallback);
      }
      pcFunc()
      slickInit(4)
    }
  }

  if ($('.fixedSideBar').length > 0) {
    // 取得各節點 Offset
    getFixedSidebarPos()
  }

  isFirstTime = false
} /* _resize END */

function getSize() {
  winW = $win.width()
  winH = $win.height()
}

function getHeaderH() {
  headerH = 60

  if (winW > 560) {
    headerH = 80
  }
  if (winW > 768) {
    headerH = 100
  }
}

function getFixedSidebarPos() {
  // if($('body').hasClass('tnf100Page')){
  //   $.each(ntfSidebarPos, function(key) {
  //     ntfSidebarPos[key].pos = $('.' + key).offset().top;
  //   });
  //   console.log(ntfSidebarPos);

  // }else{
  //   $.each(fixedSidebarPos, function(key) {
  //     fixedSidebarPos[key].pos = $('.' + key).offset().top;
  //   });
  //   console.log(fixedSidebarPos);
  // }

  $.each(fixedSidebarPos, function (key) {
    fixedSidebarPos[key].pos = $('.' + key).offset().top
  })
  console.log(fixedSidebarPos)
}

/*========== Mobile 要做的事情 ==========*/
// function mobileFunc() {
//   // Menu 相關事件
//   menuEvents()
// }

// // Menu 相關事件
//function menuEvents() {

// getSubMenuH()
// menuInit()
// menuSwitch()

// $body.on('click', closeMenu)
// $menu.on('click', function (evt) {
//   evt.stopPropagation()
// })
//}

// 手機版展開 Menu clickEvent
// function menuBtnHandler() {
//   var $this = $(this);
//   var thisIdx = $this.index();
//   var $thisSubMenu = $this.find('.subMenu');
//   var isOpen = ($thisSubMenu.outerHeight() === 0);
//   var targetH = isOpen ? subMenuH[thisIdx] : 0;

//   $thisSubMenu.animate(
//     {
//       height: targetH
//     }, 25
//   );

//   isOpen ? $thisSubMenu.addClass('isOpen') : $thisSubMenu.removeClass('isOpen');
// }
// function menuBtnHandler() {
//   var $this = $(this)
//   var thisIdx = $this.index()
//   var $thisSubMenu = $this.find('.subMenu')
//   // var isOpen = ($thisSubMenu.outerHeight() === 0);
//   // var targetH = isOpen ? subMenuH[thisIdx] : 0;

//   $this
//     .siblings()
//     .children('.subMenu')
//     .slideUp(100, 'swing')
//   $thisSubMenu.slideToggle(100, 'swing')
// }

// Menu 初始化
// function menuInit() {
//   // $subMenu.css({ height: 0 });
//   // Menu Button 綁定點擊事件
//   $('.menu > div').on('click', menuBtnHandler)
// }

// Menu 開關事件
// function menuSwitch() {
//   $hamburger.on('click', hamburgerHandler)
// }

// function hamburgerHandler(evt) {
//   evt.stopPropagation()

//   // $hamburger.toggleClass('selected')
//   // $menu.toggleClass('isOpen')
// }

// function closeMenu() {
//   // $hamburger.removeClass('selected')
//   // $menu.removeClass('isOpen')
// }

/*========== PC 要做的事情 ==========*/
function pcFunc() {
  // Init: 移除 mobile 的各種影響的數值
  // closeMenu()
  // $subMenu.removeAttr('style')
  // $('.menu > div').off('click')
  // $hamburger.off('click')
  $('body').css('right', 0);
  $('.menuMobile').menuMobile().close();
}

// 取得所有 .subMenu 的高度
// function getSubMenuH() {
//   for (var i = 0; i < $subMenu.length; i++) {
//     subMenuH.push($subMenu.eq(i).outerHeight())
//   }
//   // console.log(subMenuH);
// }

/*========== Outdoor Training Slick ==========*/
function slickInit(slideNum) {
  if ($('.activetiesTemplate').length > 0) {
    var slickProp = {
      slidesToShow: slideNum,
      slidesToScroll: slideNum,
      infinite: false,
      autoplay: false,
      speed: SLICK_SPEED,
      pauseOnHover: true,
      dots: false,
      arrows: true,
      prevArrow: '<button class="slick-arrow arrow-prev inTheEnd"><div></div></>',
      nextArrow: '<button class="slick-arrow arrow-next"><div></div></>',
      // centerMode: true,
      variableWidth: true
    }

    if (isFirstTime) {
      $('._slick').slick(slickProp)
    } else {
      $('.nowPage').html('1')
      $('._slick').slick('unslick')
      $('._slick').slick(slickProp)
      console.log('%cCarousel was reInit.', logErrorStyle)
    }

    var slickLen = $('.slickItem').length
    var hideStyleClassName = 'inTheEnd'
    var $slickArrow = $('.slick-arrow')

    $('._slick').on('afterChange', function (evt, slick, currentSlide) {
      // 於頭尾位置時候、箭頭顏色變淡
      if (currentSlide === 0) {
        $('.arrow-prev').addClass(hideStyleClassName)
      } else if (currentSlide === slickLen - (slickLen % slideNum)) {
        $('.arrow-next').addClass(hideStyleClassName)
      } else if ($slickArrow.hasClass(hideStyleClassName)) {
        $slickArrow.removeClass(hideStyleClassName)
      }

      // 目前頁面資訊
      $('.nowPage').html(Math.floor(currentSlide / slideNum) + 1)
    })

    // 頁面總數資訊
    $('.totalPage').html(Math.floor(slickLen / slideNum) + 1)
  }
}

/*==================================================*\
                    Scroll
\*==================================================*/
var nowPos = 0

function _scroll() {
  nowPos = $win.scrollTop() + headerH + 1

  var scrollCounter = 0
  $.each(fixedSidebarPos, function (key, value) {
    var valId = value.id

    if (nowPos + winH >= footerPos && !$('.tnf100Page').length > 0) {
      if (isNoSignUp) {
        showNowPosAtFixedSidebar(4)
      }
      if (isNoReview) {
        showNowPosAtFixedSidebar(3)
      }
      if ((!isNoReview && !isNoSignUp) || (!isNoSignUp && isNoReview)) {
        showNowPosAtFixedSidebar(5)
      }
      scrollCounter += 1
    }
    // else if (nowPos >= value.pos - (winH / 2)) {
    //   showNowPosAtFixedSidebar(valId);
    //   scrollCounter += 1;
    // }
    else if (
      $win.scrollTop() + winH >= footerPos &&
      $('.tnf100Page').length > 0
    ) {
      showNowPosAtFixedSidebar(8)
      scrollCounter += 1
    } else if (nowPos >= value.pos) {
      showNowPosAtFixedSidebar(valId)
      scrollCounter += 1
    }
  })

  if (scrollCounter === 0) {
    removeFixedSidebarListClass()
  }

  // About SubMenu Hint
  // if ($body.hasClass('aboutPage')) {
  //   aboutSubMenuHint(nowPos)
  // }
}

// var $aboutSubMenu
/***** About SubMenu Hint *****/
// function aboutSubMenuHint(nowPos) {
//   $aboutSubMenu.removeClass('selected')

//   if (nowPos + winH >= footerPos + 100) {
//     $aboutSubMenu.eq(2).addClass('selected')
//   } else if (nowPos >= $('.js-taiwan').offset().top) {
//     $aboutSubMenu.eq(1).addClass('selected')
//   } else {
//     $aboutSubMenu.eq(0).addClass('selected')
//   }
// }

function removeFixedSidebarListClass() {
  $('.fixedSideBar li').removeClass('selected')
}

function showNowPosAtFixedSidebar(idx) {
  removeFixedSidebarListClass()

  $('.fixedSideBar li')
    .eq(idx)
    .addClass('selected')
}

function scrollToIdx(idx) {
  // 偏移量: headerH 倍數
  var gap = idx === 3 ? 4 : 1
  $.each(fixedSidebarPos, function (key, value) {
    if (value.id === idx) {
      $doc.animate({
          scrollTop: value.pos - headerH * gap
        },
        STD_DURATION
      )
    }
  })
}
})