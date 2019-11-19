<?php 
require_once 'php.lib/config.php';
require_once 'php.lib/main.php';
require_once 'php.lib/functions.php';
require_once 'php.lib/mysqli_class.php';
$DB = new DB_CONN();
$id = isset($_GET['id'])?FUNCS::inputFilter('id','GET',1):0;
$result = newsList(array('publish'=>1,'id'=>$id),1);
if(empty($result)){
    echo '<script>alert("not found");history.back();</script>';
    exit;
}
$rec = $result[0];
if($rec['contenttype']==2){
    header('Location:'.$rec['url']);
    exit;
}
$rec['content'] = newsContList(array('nid'=>$id),0);
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

                    <div id="introNewsArticle" class="introWrapper">

                        <div class="newsArticleTitle">
                            <span class="newsDate"><?php echo mingoDate($rec['publishdate']);?></span>
                            <?php 
                            switch($rec['type']){
                                case 1:{ echo '<span class="newsCategory bgOrange">公告</span>'; break; }
                                case 2:{ echo '<span class="newsCategory bgGreen">活動</span>'; break; }
                                case 3:{ echo '<span class="newsCategory bgBlue">報名</span>'; break; }
                                case 4:{ echo '<span class="newsCategory bgRed">重要</span>'; break; }
                            }
                            ?>
                            <h4><?php echo $rec['title'];?></h4>
                        </div>

                        <div class="newsArticleBody">
                            <?php foreach($rec['content'] as $k=>$d){?>
                            <?php if($d['img']||$d['ytid']){?>
                            <div class="imgWrapper">
                                <?php 
                                switch($d['media']){
                                    case 1:{ echo '<img src="'.UPLOAD_PATH.$d['img'].'" alt="">'; break; }
                                    case 2:{ echo '<iframe width="500" height="250" src="https://www.youtube.com/embed/'.$d['ytid'].'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>'; break; }
                                }
                                ?>
                            </div>
                            <?php }?>
                            <p><?php echo html_entity_decode($d['content']);?></p>
                            <?php }?>
                        </div>

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

</body>

</html>