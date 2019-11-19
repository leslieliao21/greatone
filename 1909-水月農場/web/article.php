<?php
require_once 'php.lib/config.php';
require_once 'php.lib/main.php';
require_once 'php.lib/functions.php';
require_once 'php.lib/mysqli_class.php';
$DB = new DB_CONN();
$id = isset($_GET['id'])?FUNCS::inputFilter('id','GET',1):1;
$limit = 1;
$param = array(
    'id'    => $id,
    'publish'=>1
);
$result = newsList($param,$limit);
$rec = !empty($result)?$result[0]:array();
if(empty($rec)){
    echo '<script>alert("not found");history.back();</script>';
    exit;
}
$rec['content'] = json_decode($rec['content']);

$prev = array();
$next = array();
$found = false;
$query = 'SELECT id,title FROM news WHERE publishdate<=CURDATE() AND status=1';
$result = $DB->select($query);
foreach($result['data'] as $k=>$d){
    if($id==$d['id'])
        $found = true;
    else{
        if($found) $next = empty($next)?$d:$next;
        if(!$found) $prev = empty($prev)?$d:$prev;
    }
}
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

<body class="article-page" data-menu="2">
    <div class="page-loading">
        <div>
            <!--<img src="./images/icons/loading.svg" alt="頁面下載中，請稍後">-->
        </div>
    </div>

    <header class="page-header"></header>

    <main class="main-container">

        <section class="insideTop">
            <div class="secTitle">
                <span><?php echo date('Y.m',strtotime($rec['publishdate']));?></span>
                <h2><?php echo $rec['title'];?></h2>
            </div>
        </section>

        <?php 
        switch($rec['type']){
            case 1:{
                ?>
        <section class="newsArticle verA">
            <?php if($rec['img1']){?>
            <div class="articleTopPic">
                <?php echo $rec['img1url']?'<a href="'.$rec['img1url'].'">':'';?>
                <img src="<?php echo UPLOAD_PATH.$rec['img1'];?>" alt="">
                <?php echo $rec['img1url']?'</a>':'';?>
            </div>
            <?php }?>
            <?php if($rec['img2']){?>
            <div class="articleFloatPic">
                <img src="<?php echo UPLOAD_PATH.$rec['img2'];?>" alt="">
            </div>
            <?php }?>

            <?php foreach($rec['content'] as $k=>$d){?>
            <p><?php echo $d;?></p>
            <?php }?>
        </section>
                <?php
                break;
            }
            case 2:{
                ?>
        <section class="newsArticle verB">
            <?php if($rec['img3']){?>
            <div class="articleTopPic">
                <?php echo $rec['img3url']?'<a href="'.$rec['img3url'].'">':'';?>
                <img src="<?php echo UPLOAD_PATH.$rec['img3'];?>" alt="">
                <?php echo $rec['img3url']?'</a>':'';?>
            </div>
            <?php }?>
        </section>
                <?php
                break;
            }
        }
        ?>
        

        <section class="pagination">
            <a href="article.php?id=<?php echo !empty($prev)?$prev['id']:'';?>" class="artiPrev pageBtn<?php echo empty($prev)?' hidden':'';?>">
                <i></i>
                <div class="pageTxt">
                    <span>Previous</span>
                    <p><?php echo !empty($prev)?$prev['title']:'';?></p>
                </div>
            </a>
            <a href="article.php?id=<?php echo !empty($next)?$next['id']:'';?>" class="artiNext pageBtn<?php echo empty($next)?' hidden':'';?>">
                <div class="pageTxt">
                    <span>Next</span>
                    <p><?php echo !empty($next)?$next['title']:'';?></p>
                </div>
                <i></i>
            </a>
        </section>


    </main>

    <footer class="page-footer"></footer>

    <script src="./js/index-dist.js"></script>
</body>

</html>