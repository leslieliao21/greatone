<?php 
require_once 'php.lib/config.php';
require_once 'php.lib/main.php';
require_once 'php.lib/mysqli_class.php';
$DB = new DB_CONN();

$award = array();
$result = awardList(array(),0);
foreach($result as $k=>$d){
    $award[$d['id']] = $d;
    $award[$d['id']]['winner'] = array();
}

$result = winnerList(array(),0);
foreach($result as $k=>$d)
    $award[$d['aid']]['winner'][] = $d;

/*$city = array();
$result = cityList();
foreach($result as $k=>$d)
    $city[$d['name']] = $d['name'];*/
?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
    <!-- Basic Data -->
    <meta charset="UTF-8">
    <title>路老師培訓網 | 年度獎項獲獎名單</title>
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

<body id="intro-page" class="awardPage" data-menu="2">
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
                    <li class="active">年度獎項獲獎名單</li>
                </ol>

                <div class="pageCont">
                    <div class="pageBodyTitle">
                        <h4><img src="images/icon/icon_title_award.png" alt="">
                            ‑ 年度獎項獲獎名單 ‑
                        </h4>
                    </div>

                    <?php foreach($award as $k=>$d){?>
                    <?php if(empty($d['winner'])) continue;?>
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-8 text-left">
                                <p class="awardName"><?php echo $d['title'];?></p>
                            </div>
                            <div class="col-sm-4 text-right">
                                <p class="awardNumber"><?php echo count($d['winner']);?>位路老師</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <table class="responsive-table table-in-smallscreen">
                                    <tr>
                                        <th>編號</th>
                                        <th>姓名</th>
                                        <th>居住地區</th>
                                    </tr>
                                    <?php for($i=0;$i<ceil(count($d['winner'])/2);$i++){?>
                                    <tr>
                                        <td data-th="編號">
                                            <p><?php echo substr('0'.($i+1),-2);?></p>
                                        </td>
                                        <td data-th="姓名">
                                            <p><?php echo $d['winner'][$i]['name'];?></p>
                                        </td>
                                        <td data-th="居住地區">
                                            <p><?php echo $d['winner'][$i]['city'];?></p>
                                        </td>
                                    </tr>
                                    <?php }?>
                                </table>
                            </div>
                            <div class="col-sm-6">
                                <table class="responsive-table table-in-smallscreen">
                                    <tr>
                                        <th>編號</th>
                                        <th>姓名</th>
                                        <th>居住地區</th>
                                    </tr>
                                    <?php for($i;$i<count($d['winner']);$i++){?>
                                    <tr>
                                        <td data-th="編號">
                                            <p><?php echo substr('0'.($i+1),-2);?></p>
                                        </td>
                                        <td data-th="姓名">
                                            <p><?php echo $d['winner'][$i]['name'];?></p>
                                        </td>
                                        <td data-th="居住地區">
                                            <p><?php echo $d['winner'][$i]['city'];?></p>
                                        </td>
                                    </tr>
                                    <?php }?>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                    
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