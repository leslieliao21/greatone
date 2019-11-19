<?php 
require_once 'php.lib/config.php';
require_once 'php.lib/main.php';
require_once 'php.lib/mysqli_class.php';
$DB = new DB_CONN();
$qa = qaList(array('status'=>1),0);
?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
    <!-- Basic Data -->
    <meta charset="UTF-8">
    <title>路老師培訓網 | FAQ</title>
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
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> -->
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
                    <li class="active">FAQ</li>
                </ol>

                <div class="pageCont">
                    <div class="pageBodyTitle">
                        <h4><img src="images/icon/icon_title_faq.png" alt="">
                            ‑ FAQ ‑</h4>
                    </div>

                    <div id="introFAQWrapper" class="introWrapper">
                        <?php foreach($qa as $k=>$d){?>
                        <div class="faqBox">
                            <div class="questionBar">
                                <span><?php echo ($k+1).'. '.nl2br($d['title']);?></span>
                            </div>
                            <div class="answerBar">
                                <p><?php echo nl2br($d['content']);?></p>
                                <a href="javascript:;" class="faqCollapse"><i class="glyphicon glyphicon-play"></i><span>收回</span></a>
                            </div>
                        </div>
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
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
    <script src="js/kits.min.js"></script>
    <!-- main js -->
    <script src="js/main.min.js"></script>

</body>

</html>