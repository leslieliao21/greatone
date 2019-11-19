<?php
require_once 'php.lib/config.php';
require_once 'php.lib/main.php';
require_once 'php.lib/functions.php';
require_once 'php.lib/mysqli_class.php';
$DB = new DB_CONN();
$page = isset($_GET['page'])?FUNCS::inputFilter('page','GET',1):1;
$limit = 0;
$param = array(
    'publish'=>1,
    'page'  => $page
);
$recs = newsList($param,$limit);
?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
    <!-- Basic Data -->
    <meta charset="UTF-8">
    <title>最新消息 | 水月休閒農業發展協會</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="viewport" content="width=1000, user-scalable=yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="icon" type="image/ico" href="images/favicon.ico" />
    <!--<link rel="preload" href="" as="image">-->

    <!-- Meta Data -->
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="og:title" content="水月休閒農業發展協會">
    <meta name="og:description" content="">
    <meta name="og:type" content="website">
    <meta property="og:url" content="">
    <!--<meta name="og:image" content="images/1200x630.jpg">-->

    <!-- CSS -->
    <link rel="stylesheet" href="css/main.min.css" />

    <!-- Tools -->
    <script src="./js/vendor-dist.js"></script>
    <script src="./js/kits-dist.js"></script>

    <!--[if IE]>
    <script type="text/javascript" src="js/html5shiv.js"></script>
  <![endif]-->

</head>

<body class="news-page" data-menu="2">
    <div class="page-loading">
        <div>
            <!--<img src="./images/icons/loading.svg" alt="頁面下載中，請稍後">-->
        </div>
    </div>

    <header class="page-header"></header>

    <main class="main-container">

        <section class="insideTop">
            <div class="secTitle">
                <span>- News -</span>
                <h2>最新消息</h2>
            </div>
        </section>

        <section class="newsList">
            <?php foreach($recs as $k=>$d){?>
            <a href="article.php?id=<?php echo $d['id'];?>" class="newsBox">
                <div class="imgWrapper">
                    <img src="<?php echo UPLOAD_PATH.$d['cover'];?>" alt="">
                </div>
                <div class="txt">
                    <h5 class="newsTitle"><?php echo $d['title'];?></h5>
                    <p><?php echo $d['descript'];?></p>
                </div>
                <div class="bottom">
                    <span class="time"><?php echo date('Y.m',strtotime($d['publishdate']));?></span>
                    <span class="btnMoreTxt">看更多 +</span>
                </div>
            </a>
            <?php }?>
        </section>


    </main>

    <footer class="page-footer"></footer>

    <script src="./js/index-dist.js"></script>
</body>

</html>