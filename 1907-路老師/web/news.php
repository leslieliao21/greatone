<?php 
require_once 'php.lib/config.php';
require_once 'php.lib/main.php';
require_once 'php.lib/mysqli_class.php';
$DB = new DB_CONN();
$limit = 5;
$news = newsList(array('publish'=>1),$limit);
$count = newsCount(array('publish'=>1));
$pgs = ceil($count/$limit);
?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
    <!-- Basic Data -->
    <meta charset="UTF-8">
    <title>路老師培訓網 | 最新消息</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="expires" content="0">
    <meta http-equiv="cache-control" content="no-cache">
    <meta name="format-detection" content="telephone=no">
    <!-- <link rel="icon" type="image/ico" href="" /> -->

    <!-- Meta Data -->
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="og:title" content="">
    <meta name="og:description" content="">
    <meta name="og:type" content="website">
    <!-- <meta name="og:image" content="正式網址/images/1200x630.jpg"> -->

    <!-- CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/main.css" />

    <!--[if IE]>
        <script type="text/javascript" src="js/html5shiv.js"></script>
    <![endif]-->

</head>

<body id="intro-page" data-menu="2">
    <!--Loading-->
    <div id="loading">
        <div class="loader">
            <div class="spinner">

            </div>
        </div>
    </div>

    <header class="page-header"></header>

    <main class="main-container">

        <div class="inside bgWhite pdb-40">
            <h2 class="pageHead">‑ 路老師介紹 ‑</h2>

            <div class="bodyCont">

                <ol class="breadcrumb">
                    <li><a href="index.php">首頁</a></li>
                    <li><a href="intro.php">路老師介紹</a></li>
                    <li class="active">最新消息</li>
                </ol>

                <div class="pageCont">
                    <div class="pageBodyTitle">
                        <h4><img src="images/icon/icon_title_news.png" alt="">
                            ‑ 最新消息 ‑</h4>
                    </div>

                    <div id="introNewsWrapper" class="introWrapper">
                        <ul class="introNewsList">
                            <?php foreach($news as $k=>$d){?>
                            <li>
                                <a href="<?php echo $d['contenttype']==2?$d['url'].'" target="_blank':'news_article.php?id='.$d['id'];?>">
                                    <span class="newsDate"><?php echo mingoDate($d['publishdate']);?></span>
                                    <?php 
                                    switch($d['type']){
                                        case 1:{ echo '<span class="newsCategory bgOrange">公告</span>'; break; }
                                        case 2:{ echo '<span class="newsCategory bgGreen">活動</span>'; break; }
                                        case 3:{ echo '<span class="newsCategory bgBlue">報名</span>'; break; }
                                        case 4:{ echo '<span class="newsCategory bgRed">重要</span>'; break; }
                                    }
                                    ?>
                                    <h4><?php echo $d['title'];?></h4>
                                </a>
                            </li>
                            <?php }?>
                        </ul>
                        <?php if($pgs>1){?>
                        <a href="javascript:;" class="btnMore"><i class="glyphicon glyphicon-play"></i><span>更多消息</span></a>
                        <?php }?>
                    </div>

                </div>

            </div>
        </div>
    </main>

    <footer class="page-footer"></footer>


    <!-- Scripts -->
    <script src="js/vendor.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/kits.min.js"></script>
    <!-- main js -->
    <script src="js/main.min.js"></script>
    <script>
    $(document).ready(function(){
        var pg = 1;
        var loading = false;
        $('.btnMore').click(function(){
            if(loading) return;
            loading = true;
            pg += 1;
            $.ajax({
                type : 'post',
                url : 'ajax/news.php',
                data : {page:pg,limit:'<?php echo $limit;?>'},
                dataType : 'json',
                success : function(data){
                    loading = false;
                    if(data.msgcode == 200){
                        $.each(data.data,function(i,v){
                            var $news = $('<li>\
                                <a href="'+(v.contenttype==2?v.url+'" target="_blank':'news_article.php?id='+v.id)+'">\
                                    <span class="newsDate">'+v.publishdate+'</span>\
                                    <span class="newsCategory"></span>\
                                    <h4>'+v.title+'</h4>\
                                </a>\
                            </li>');
                            
                            switch(v.type){
                                case 1:{ $news.find('.newsCategory').addClass('bgOrange').html('公告'); break; }
                                case 2:{ $news.find('.newsCategory').addClass('bgGreen').html('活動'); break; }
                                case 3:{ $news.find('.newsCategory').addClass('bgBlue').html('報名'); break; }
                                case 4:{ $news.find('.newsCategory').addClass('bgRed').html('重要'); break; }
                            }
                            
                            $('.introNewsList').append($news);
                        });
                        
                        if(data.pages<=pg)
                            $('.btnMore').css({display:'none'});
                    }
                    else
                        alert(data.msg);
                }
            });
        });
    });
    </script>
</body>

</html>