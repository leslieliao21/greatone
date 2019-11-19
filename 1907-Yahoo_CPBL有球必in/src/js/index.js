var $win = $(window),
    winW = $win.width(),
    winH = $win.height(),
    _media = 1280,
    pos = $(window).scrollTop();

var options = {
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 4000,
    dots: true,
    cssEase: 'ease-out'
}


var loading = function () {

    var $this = {};
    $this.removeLoading = function () {
        $('#loading').fadeOut(function () {
            $('#loading').remove();
            // 動態程式寫這 

        });
    };
    $this.loadfunc = function () {
        $('html, body').imagesLoaded(function () {
            $this.removeLoading();
        });
    };
    return $this;
};
var myScript = function () {

    var imagesLoaded = loading();
    imagesLoaded.loadfunc();

}

// function windowEvents() {
//     $win.on("resize", _resize).resize()
// }

// function _resize() {
//     getSize(), 768 <= winW ? resizePC() : resizeMB()
// }

// function getSize() {
//     winW = $(window).outerWidth(), winH = $(window).height(), headerTopH = $("header").outerHeight()
// }

// function resizePC() {

// }

// function resizeMB() {

// }

$(function () {
    var main = myScript();

    var btnH = $('.fixBottomBtn').outerHeight();

    $('main').css({
        'padding-bottom': btnH
    });
    
    // $("._lb").lightbox(function () {});

    $('._slick').on('init', function () {});

    $('._slick').slick(options);

    $("ul.tabWrapper li").on('click', function () {
        var $data = $(this).data('tab');
        var $tabEl = $('#' + $data);

        $(this).addClass('selected');
        $(this).siblings().removeClass('selected');
        $(this).parent().siblings('div').not($tabEl).hide();
        $tabEl.show();
        $('._slick').slick('unslick');
        $('._slick').slick(options);

    });

    $("ul.dateWrapper li").on('click', function () {
        $(this).addClass('selected');
        $(this).siblings().removeClass('selected');
    });

    $('.fixBottomBtn').on('click', function () {
        $('body').css({'overflow-y':'hidden'});
    });

    $('#boardSelector').change(function(){
        $('.boardList').addClass('hide');
        $('#' + $(this).val()).removeClass('hide').addClass('show');
    });

    // $(".goTop").on('click', function () {
    //     $('html, body').animate({
    //         scrollTop: 0
    //     }, 500);
    // });

    // $(window).resize(function() {
    //     windowEvents();
    // });

});