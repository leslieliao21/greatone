const $progressBar = $('.page-loading .progress-bar');

listenImagesLoading(
  $('img'),
  mainFunc,
  function(per, instance) {
    $progressBar.css({ width: per + '%' });
  }
);

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
  $hamburger.on('click', function(evt) {
    evt.preventDefault();
    evt.stopPropagation();
    $header.toggleClass(PAGE_HEADER_ACTIVE);

    if ($header.hasClass(PAGE_HEADER_ACTIVE)) {
      $headerNav.stop().slideDown(DURATION.STD);
    } else {
      $headerNav.stop().slideUp(DURATION.STD);
    }
  });

  $doc.on('click', () => {
    if ($header.hasClass(PAGE_HEADER_ACTIVE)) {
      $headerNav.stop().slideUp(DURATION.STD);
      $header.removeClass(PAGE_HEADER_ACTIVE);
    }
  });

  // Navigation
  $('.header-nav a').on('click', function(evt) {
    evt.preventDefault();

    const linkIdx = $(this).parent().index() + 1;
    $('html, body').stop().animate({
      scrollTop: sectionPos[linkIdx] - headerTotalH
    }, DURATION.NOR);
  });
  

  /* 收掉 .page-loading */
  transitionThenRemove({
    dom: $(".page-loading"),
    duration: DURATION.STD,
    callback: () => {
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
  $win.on("scroll", _scroll).scroll();
}

/*========== Window Resize ==========*/
function _resize() {
  getSize();

  winW > 768 ? resizePC() : resizeMB();

  footerPos = $('.page-footer').offset().top;
  getSectionPos();
}

function getSize() {
  winW = $win.width();
  winH = $win.height();
  headerTopH = $('.header-top').outerHeight();
  headerNavH = $('.header-nav').outerHeight();
}

function resizePC() {
  headerInit('flex');
  $('.main-container').css({ marginTop: headerTopH + headerNavH });
  headerTotalH = headerTopH + headerNavH;
}
function resizeMB() {
  headerInit('none');
  $('.main-container').css({ marginTop: headerTopH });
  headerTotalH = headerTopH;
}

function headerInit(display) {
  $header.removeClass(PAGE_HEADER_ACTIVE);
  $headerNav.css({ display });
}

function getSectionPos() {
  sectionPos = [];

  $.each($('main .anchor'), (idx, el) => {
    sectionPos.push(Math.floor($(el).offset().top));
  });
}










/*========== Window Scroll ==========*/
let nowPos;
function _scroll() {
  getPos();
  setNavigationHint();
}

function getPos() {
  nowPos = {
    x: $doc.scrollLeft(),
    y: $doc.scrollTop(),
    top: $doc.scrollTop() + headerTotalH + 1
  };
}

function setNavigationHint() {
  const $navLi = $('.header-nav li');
  const NAV_HINT_CLASS = 'active';

  $.each(sectionPos, (idx, val) => {
    if ((idx === 0 && nowPos.top < sectionPos[1]) || nowPos.top >= footerPos) {
      $navLi.removeClass(NAV_HINT_CLASS);
      return false;
    }

    if (nowPos.top >= val) {
      $navLi.removeClass(NAV_HINT_CLASS);
      $navLi.eq(idx - 1).addClass(NAV_HINT_CLASS);
    }
  });
}
