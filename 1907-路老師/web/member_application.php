<?php 
require_once 'php.lib/config.php';
require_once 'php.lib/main.php';
require_once 'php.lib/mysqli_class.php';
$DB = new DB_CONN();
$memberLogin = memberLoginChk();
if(!$memberLogin['status']){
    header('Location:signin.php');
    exit;
}
$member = $_SESSION[WEBX.'Mem'];

$descript = trainingDescriptList();
$retraining = array();
if($member['qualify']==1)
    $retraining = trainingList(array('type'=>2,'status'=>1),0);
$training = trainingList(array('type'=>1,'status'=>1),0);

foreach($retraining as $k=>$d){
    $retraining[$k]['date'] = date('m/d',strtotime($d['sdate'])).($d['sdate']!='0000-00-00'&&$d['edate']!='0000-00-00'?',':'').date('m/d',strtotime($d['edate']));
    $retraining[$k]['time'] = date('H:i',strtotime($d['stime'])).($d['stime']!='00:00:00'&&$d['etime']!='00:00:00'?'~':'').date('H:i',strtotime($d['etime']));
}

foreach($training as $k=>$d){
    $training[$k]['date'] = date('m/d',strtotime($d['sdate'])).($d['sdate']!='0000-00-00'&&$d['edate']!='0000-00-00'?',':'').date('m/d',strtotime($d['edate']));
    $training[$k]['time'] = date('H:i',strtotime($d['stime'])).($d['stime']!='00:00:00'&&$d['etime']!='00:00:00'?'~':'').date('H:i',strtotime($d['etime']));
}
?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
    <!-- Basic Data -->
    <meta charset="UTF-8">
    <title>路老師培訓網 | 培訓報名</title>
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

<body id="member-page" class="affairsApplyPage" data-menu="0">
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
            <h2 class="pageHead">‑ 路老師專區 ‑</h2>

            <div class="bodyCont">

                <ol class="breadcrumb">
                    <li><a href="index.php">首頁</a></li>
                    <li><a href="member.php">路老師專區</a></li>
                    <li class="active">培訓報名</li>
                </ol>
                
                <div class="signout">
                    <div class="showDinlineblock">
                        <label for="memberSelector"><?php echo $member['name'];?> 老師</label>
                        <select name="" id="memberSelector" class="form-control w200">
                            <option value="member">路老師專區</option>
                            <?php if(in_array($member['qualify'],array(1,2))){?>
                            <option value="member_affairs">個人宣講歷程</option>
                            <option value="member_affairs_record">宣講歷程登錄</option>
                            <option value="member_download">教案下載</option>
                            <?php }?>
                            <option value="member_application" selected>培訓報名</option>
                            <option value="member_info">個人資料</option>
                        </select>
                    </div>

                    <button type="button" class="btn btn-submit btnInline" onclick="location.href='ajax/signout.php'">登出</button>
                </div>

                <div class="pageCont">
                    <div class="pageBodyTitle">
                        <h4><img src="images/icon/icon_title_apply.png" alt="">
                            ‑ 培訓報名 ‑
                        </h4>
                    </div>

                    <?php echo !empty($descript)?'<p>'.$descript['descript'].'</p>':'';?>

                    <div class="row">
                        <?php if(!empty($retraining)){?>
                        <div class="col-sm-6">
                            <h5 class="colTitle">⎯ <span class="cBlack">回訓報名</span> ⎯</h5>

                            <table class="responsive-table table-in-smallscreen">
                                <tr>
                                    <th>課程名稱</th>
                                    <th>日期</th>
                                    <th>開課時間</th>
                                </tr>
                                <?php foreach($retraining as $k=>$d){?>
                                <tr>
                                    <td data-th="課程名稱">
                                        <p>
                                            <a href="member_apply.php?id=<?php echo $d['id'];?>"><?php echo $d['title'];?></a>
                                        </p>
                                    </td>
                                    <td data-th="日期">
                                        <p><?php echo $d['date'];?></p>
                                    </td>
                                    <td data-th="開課時間">
                                        <p><?php echo $d['time'];?></p>
                                    </td>
                                </tr>
                                <?php }?>
                            </table>
                        </div>
                        <?php }?>
                        <?php if(!empty($training)){?>
                        <div class="col-sm-6">
                            <h5 class="colTitle">⎯ <span class="cBlack">初訓報名</span> ⎯</h5>

                            <table class="responsive-table table-in-smallscreen">
                                <tr>
                                    <th>課程名稱</th>
                                    <th>日期</th>
                                    <th>開課時間</th>
                                </tr>
                                <?php foreach($training as $k=>$d){?>
                                <tr>
                                    <td data-th="課程名稱">
                                        <p>
                                            <a href="member_apply.php?id=<?php echo $d['id'];?>"><?php echo $d['title'];?></a>
                                        </p>
                                    </td>
                                    <td data-th="日期">
                                        <p><?php echo $d['date'];?></p>
                                    </td>
                                    <td data-th="開課時間">
                                        <p><?php echo $d['time'];?></p>
                                    </td>
                                </tr>
                                <?php }?>
                            </table>
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
    <script src="js/kits.min.js"></script>
    <!-- main js -->
    <script src="js/main.min.js"></script>
    <script>
    $(document).ready(function(){
        $('#memberSelector').change(function(){
            location.href = $(this).val()+'.php';
        });
    });
    </script>
</body>

</html>