/* lightbox
    ------------------------------------------------------------*/

    // var lightbox = function(){

        var $body = $('html,body');
        var $lb = $('.lb'),
            $lbbox = $('.lbbox');

        var lb_data,
            lb_data2,
            lbname,
            lbname2;
        // var lbname = 'dest';

        TweenMax.set($('.lb'),{opacity:0 , zIndex:-1});

        var lbOpen = function(lb_data){

            var lbAni = new TimelineMax();
                lbAni.to($('.lb[data-lb="'+lb_data+'"]') , .3 ,{css:{zIndex:9999}} , '-=.3')
                     .to($('.lb[data-lb="'+lb_data+'"]') , .3 ,{opacity:1  ,ease:Linear.easeNone});

            if($('.restart').length){
                $('.restart').click(lbClose);
            }

            $body.css({
                'overflow':'hidden',
                'position':'fixed'
            })
        }

        var lbClose = function(lb_data2){

            var lbCloseAni = new TimelineMax();
                lbCloseAni.to($('.lb[data-lb="'+lb_data2+'"]') , .3 ,{opacity:0  ,ease:Linear.easeNone})
                          .to($('.lb[data-lb="'+lb_data2+'"]') , .3 ,{css:{zIndex:-1}});

            // $('.lb').css({'z-index':""})
            // $('.lbblack').css({'z-index':""})

            $body.css({
                'overflow':'',
                'position':''
            })

        }

        $('.lb .btn_x').click(function () {
            var rootlbname = $(this).parents('.lb').data('lb');

            $('#ytlink').attr('src','');

            lbClose(rootlbname)
        });

    // }
    // lightbox();