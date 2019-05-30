
/* loading func -----------------------------*/
var loading = function(){
    
    var $this = {};
    $this.removeLoading = function(){
        $('.loading').fadeOut(function(){
            $('.loading').remove();
            
            // 動態程式寫這 
            
        });
    };
    $this.loadfunc = function(){
        $('html, body').imagesLoaded(function(){
            $this.removeLoading();
        });
    };
    return $this;
};

$(function(){
    $('header').load('include/header.html');
    $('footer').load('include/footer.html', function(){
        //imagesLoaded
        var imagesLoaded = loading();
        imagesLoaded.loadfunc();
    });
});


