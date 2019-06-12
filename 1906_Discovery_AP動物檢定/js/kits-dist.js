"use strict"; // 全域採用嚴格模式

/*==================== Variables ====================*/
/* Window */

var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };

var $win = $(window);
var winW = void 0;
var winH = void 0;

/* Document */
var $doc = $("html");
var $body = $("body");

/* Log Style */
var logSafeStyle = "color: 	limegreen; font-weight: bold;";
var logInfoStyle = "color: yellow;";

/* Constant */
var DURATION = {
  FAST: 150,
  FASTER: 200,
  STD: 300,
  NOR: 400,
  SLOWER: 500,
  SLOW: 600
};

/*==================== Library ====================*/
/**
 * 項目名稱: 圖片載入進度偵聽器
 *
 * 參數內容:
 *    dom = 作用對象 (預設整個 document)
 *    callback = 圖片全部下載完畢時的 Callback
 *
 * 說明:
 *    所有 DOM 都確認載入後，開始監聽所有圖片是否載入完畢。
 *    亦可取用進度數值作 progress bar 之用。
 *
 * 注意事項:
 *    imagesLoadingCallback 為必填(預設為 buildPlugins)
 *    位置在 includesLoader 結束後(預設狀況下)
 */
function listenImagesLoading(target, callback, progress) {
  callback = callback || function () {};
  progress = progress || function (per, instance) {
    //console.log(`${per}% (${IMG_COUNTER}/${instance.images.length})`);
  };
  console.log("%cImages Loading Listening...", logInfoStyle);
  var IMG_COUNTER = 0;

  target.imagesLoaded({ background: true }).always(function () {
    console.log("%cImages Loading Completed!", logSafeStyle);
    callback();
  }).progress(function (instance) {
    IMG_COUNTER++;
    var per = Math.floor(IMG_COUNTER / instance.images.length * 100);
    progress(per, instance);
  });
}

/**
 * 項目名稱: 淡出後移除DOM
 *
 * 參數內容:
 *    opt = {
 *      dom - 作用對象,
 *      type - 過渡方式 (預設 'fadeOut' & 'slideUp')
 *      duration - 過渡時間,
 *      callback - 過渡完畢時的 Callback
 *    }
 *
 * 適用對象: Loading、Lightbox... etc.
 *
 * 注意事項: 預設 opt.type 為 "fadeOut"
 */
function transitionThenRemove(opt) {
  //const { dom, type, duration, callback } = opt;
  var dom = opt.dom;
  var type = opt.type;
  var duration = opt.duration;
  var callback = opt.callback;

  switch (type) {
    case "slideUp":
      dom.stop().slideUp(duration, transitionCallback);
      break;
    default:
      dom.stop().fadeOut(duration, transitionCallback);
      break;
  }

  function transitionCallback() {
    dom.remove();
    if (!!callback) {
      callback();
    }
  }
}

/* 參數型別驗證: Object */
function paraObjTypeValidation(para, _this) {
  if (para === undefined) {
    para = {};
    return true;
  } else if ((typeof para === "undefined" ? "undefined" : _typeof(para)) !== "object") {
    throw new Error(
    //`${_this.__proto__.constructor.name} 參數錯誤: 應為 "物件" 型別!`
    ' 參數錯誤: 應為 "物件" 型別!');
  }

  return true;
}

/* DOM 是否存在 */
function isExist() {
  var args = [];

  // for Loop for IE11
  for (var i = 0; i < arguments.length; i++) {
    args.push(arguments[i]);
  }

  var ans = args.some(function (el) {
    return $(el).length > 0;
  });

  return ans;
}
/**
 * 項目名稱: Includes 載入器
 *
 * 說明:
 *    監聽所有 includes 的載入、並作同步處理，
 *    下載完成後進入 listenImagesLoading，
 *    監聽完成即進入 this.callback。
 *
 * 注意事項：
 *    includesList.callback 為異步事件。
 *
 */

function includesLoader(userOpts) {
  var _userOpts$filesRootPa = userOpts.filesRootPath,
      filesRootPath = _userOpts$filesRootPa === undefined ? "./includes/" : _userOpts$filesRootPa,
      _userOpts$filesExtens = userOpts.filesExtension,
      filesExtension = _userOpts$filesExtens === undefined ? ".html" : _userOpts$filesExtens,
      loaderCallback = userOpts.callback,
      includesList = userOpts.includesList;

  /*==================== Start Loading ====================*/

  console.log("%cIncludes Loading...", logInfoStyle);

  var LIST_LEN = includesList.length;
  var counter = 0;

  // list 遍歷
  $.each(includesList, function (idx, includeData) {
    var target = includeData.target,
        _includeData$rootPath = includeData.rootPath,
        rootPath = _includeData$rootPath === undefined ? filesRootPath : _includeData$rootPath,
        fileName = includeData.fileName,
        _includeData$extensio = includeData.extension,
        extension = _includeData$extensio === undefined ? filesExtension : _includeData$extensio,
        callback = includeData.callback;


    var fullPath = rootPath + fileName + extension;

    // 正式載入
    $(target).load(fullPath, function () {
      counter++;
      console.log(fileName + " was being loaded (" + counter + "/" + LIST_LEN + ")");

      if (callback) {
        callback();
      }

      // Progress Listening...
      listenIncludesLoading(LIST_LEN, counter);
    });
  });

  function listenIncludesLoading(len, counter) {
    // 如果全部已下載完畢
    if (len === counter) {
      console.log("%cIncludes Loading Completed!", logSafeStyle);

      listenImagesLoading($doc, loaderCallback);
    }
  }
}

/*==================================================*\
        Lightbox
\*==================================================*/
;(function ($) {
  var btn;
  var announcement = false;
  var $lb;

  // 一次性無綁定 Lightbox
  $.lightbox = function (userOpts, callback) {
    announcement = true;
    $.fn.lightbox(userOpts, callback);
  };

  // 綁定事件 Lightbox
  $.fn.lightbox = function (userOpts, callback) {
    $.each(this, function (idx, el) {
      /*==================== Properties ====================*/
      var _this = $(el);

      /* 預設樣板 */
      var lbTemplate = '<div class="lightbox">' + '<div class="lb-container">' + '<div class="lb-content"></div>' + '<div class="lb-close-btn"></div>' + '</div>' + '<div class="lb-loading">' + '<svg><path d="M43.935,25.145c0-10.318-8.364-18.683-18.683-18.683c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615c8.072,0,14.615,6.543,14.615,14.615H43.935z"><animateTransform attributeType="xml"attributeName="transform" type="rotate" from="0 25 25" to="360 25 25" dur="0.6s" repeatCount="indefinite"/></path></svg>' + '</div>' + '</div>';

      /* 預設選項 */
      var _defaultOpts = {
        closeBtn: true,
        bodyClickClose: true,
        showWhenLanding: false,
        duration: 200,
        lbTemplate: lbTemplate,
        type: 'file',
        filesRootPath: './includes/lightbox/',
        filesDefaultExtension: '.html',
        fileName: '',
        id: '',
        fullPath: '',
        bindEvt: 'click',
        callback: function callback() {}
      };

      /* 資料處理 */
      if ((typeof userOpts === "undefined" ? "undefined" : _typeof(userOpts)) !== 'object') {
        var temp = userOpts;
        userOpts = {};

        switch (typeof temp === "undefined" ? "undefined" : _typeof(temp)) {
          // options 為 function 則實作為 callback
          case 'function':
            userOpts.callback = temp;
            break;

          // options 為 string 則實作為 fullPath
          case 'string':
            userOpts.fullPath = temp;
            break;
        }
      }

      var opts = $.extend(_defaultOpts, userOpts);

      // 如果不要關閉按鈕，則強制開啟 "點擊 body 可關閉 lightbox" 功能
      if (!opts.closeBtn) {
        opts.bodyClickClose = true;
      }

      /*==================== Entrance ====================*/
      /* 綁定對象確認 */
      if (announcement) {
        buildLbWrap(_this, opts);
      } else {
        btn = _this;

        // 驗證檔案名稱，如未設定檔名，則改用 data-lb 取得
        var btnDataLb = btn.data('lb');
        if (!opts.fileName) {
          opts.fileName = btnDataLb;
        } else if (!btnDataLb) {
          console.log('%c未設定檔案名稱', logErrorStyle);
          return false;
        }

        // 如果 fullPath 為空字串，則組裝各檔案資料
        if (opts.fullPath === '') {
          opts.fullPath = getFullPath(opts);
        }

        // 如果 id 為空白，則 id 採用 fileName
        if (!opts.id) {
          opts.id = opts.fileName;
        }

        if (opts.showWhenLanding) {
          buildLbWrap(btn, opts);
        } else {
          bindBtn(btn, opts);
        }
      }
    });

    /*==================== Methods ====================*/
    /* 綁定按鈕事件 */
    function bindBtn(btn, opts) {
      btn.on(opts.bindEvt, function (evt) {
        evt.preventDefault();
        evt.stopPropagation();

        !isExist('.lightbox') ? buildLbWrap(btn, opts) : console.log('%c前 lightbox 尚未關閉', logErrorStyle);
      });

      if (opts.showWhenLanding) {
        btn.trigger(opts.bindEvt);
      }
    }

    /* 建立 Lightbox 基本架構 */
    function buildLbWrap(_this, opts) {
      console.log('%cLightbox is Loading', logInfoStyle);
      var $body = $('body');
      $body.append(opts.lbTemplate);
      $lb = $('.lightbox');

      $lb.attr('id', opts.id);

      // 阻止關閉 Lightbox 的冒泡事件
      $('.lb-container').on('click', function (evt) {
        evt.stopPropagation();
      });

      // 是否需要 "關閉按鈕"
      var $closeBtn = $('.lb-close-btn');
      if (!opts.closeBtn) {
        $closeBtn.remove();
      } else {
        $closeBtn.on('click', function () {
          // $('body').css({'overflow-y':'visible'});
          closeLb(opts);
        });
      }

      // 是否開啟 "點擊 body 可關閉 lightbox" 功能
      if (opts.bodyClickClose) {
        $body.on('click', function () {
          closeLb(opts);
        });
      }

      switch (opts.type) {
        case 'file':
          loadFile(opts);
          break;
      }

      // 需調整: 開放使用者自定義
      $lb.stop().animate({
        opacity: 1
      }, {
        duration: opts.duration
      });
    }

    /* 開始下載檔案 */
    function loadFile(opts) {
      $('.lb-content').load(opts.fullPath, function () {
        listenImagesLoading($lb, function () {
          lbCompleted(opts);
        });
      });
    }

    /* 取得完整路徑 */
    function getFullPath(opts) {
      if (!!opts.fullPath) {
        return opts.fullPath;
      } else {
        return opts.filesRootPath + opts.fileName + opts.filesDefaultExtension;
      }
    }

    /* Lightbox Callback */
    function lbCompleted(opts) {
      opts.callback();
      showContent(opts);
    }

    function showContent(opts) {
      $('.lb-container').stop().animate({
        opacity: 1
      }, {
        duration: opts.duration,
        complete: function complete() {
          if (device.mobile() || device.tablet()) {
            $(".header-nav ul").stop().slideUp(DURATION.FAST);
            $(".page-header").removeClass(PAGE_HEADER_ACTIVE);
          }
          $('body').css({ 'overflow-y': 'hidden' });

          console.log('%cLightbox Loading Completed!', logSafeStyle);
        }
      });

      $('.lb-loading').stop().animate({
        opacity: 0
      }, {
        duration: opts.duration
      });
    }

    /* 關閉 Lightbox */
    function closeLb(opts) {
      if (!isExist('.lightbox')) {
        return false;
      }

      // 需調整: 開放使用者自定義
      $lb.stop().animate({
        opacity: 0
      }, {
        duration: opts.duration,
        complete: function complete() {
          $(this).remove();
          $('body').css({ 'overflow-y': 'visible' });
          console.log('%cLightbox Is Closed', logSafeStyle);
        }
      });
    }

    /* 啟用 jQuery 串香腸功能 */
    return this;
  };
})(jQuery);
//@prepros-prepend _global.js
//@prepros-prepend vendor/includesloader.js
//@prepros-prepend vendor/lightbox.js
//# sourceMappingURL=kits-dist.js.map