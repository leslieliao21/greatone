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
if(!in_array($member['qualify'],array(1,2))){
    header('Location:member.php');
    exit;
}

$plans = array();
$result = planList(array(),0);
foreach($result as $k=>$d)
    $plans[$d['id']] = $d['title'];

$status = array(-1=>'草稿',0=>'待審核',1=>'通過',2=>'退件');

$speach = speachList(array('tid'=>$member['id'],'order'=>'speachdate desc'),0);
$comment = array();
foreach($speach as $k=>$d){
    $speach[$k]['planText'] = '';
    $plan = $d['plan']?explode(',',$d['plan']):array();
    foreach($plan as $kk=>$dd)
        $speach[$k]['planText'] .= ($speach[$k]['planText']?'，':'').(isset($plans[$dd])?$plans[$dd]:$dd);
    
    //$speach[$k]['createdate'] = date('Y-m-d',strtotime($d['createtime']));
    $speach[$k]['statusText'] = isset($status[$d['status']])?$status[$d['status']]:'';
    
    if($d['status']==2){
        $d['year'] = mingoDate($d['speachdate'],'y');
        $d['month'] = strtoupper(date('M',strtotime($d['speachdate'])));
        $d['date'] = date('d',strtotime($d['speachdate']));
        $comment[] = $d;
    }
}
?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
    <!-- Basic Data -->
    <meta charset="UTF-8">
    <title>路老師培訓網 | 個人宣講歷程</title>
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

<body id="member-page" data-menu="0">
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
                    <li class="active">個人宣講歷程</li>
                </ol>
                
                <div class="signout">
                    <div class="showDinlineblock">
                        <label for="memberSelector"><?php echo $member['name'];?> 老師</label>
                        <select name="" id="memberSelector" class="form-control w200">
                            <option value="member">路老師專區</option>
                            <?php if(in_array($member['qualify'],array(1,2))){?>
                            <option value="member_affairs" selected>個人宣講歷程</option>
                            <option value="member_affairs_record">宣講歷程登錄</option>
                            <option value="member_download">教案下載</option>
                            <?php }?>
                            <option value="member_application">培訓報名</option>
                            <option value="member_info">個人資料</option>
                        </select>
                    </div>

                    <button type="button" class="btn btn-submit btnInline" onclick="location.href='ajax/signout.php'">登出</button>
                </div>

                <div class="pageCont">
                    <div class="pageBodyTitle">
                        <h4><img src="images/icon/icon_title_member.png" alt="">
                            ‑ 個人宣講歷程 ‑
                        </h4>
                    </div>

                    <?php if(!empty($comment)){?>
                    <h5 class="colTitle">⎯ <?php echo $member['name'];?> <span class="cBlack">宣講歷程重新登錄通知</span> ⎯</h5>

                    <div class="container">
                        <div class="row">
                            <?php foreach($comment as $k=>$d){?>
                            <?php if($k!=0&&$k%2==0) echo '</div><div class="row">';?>
                            <div class="col-sm-6">
                                <table class="column-table">
                                    <tr>
                                        <th><a href="member_affairs_record.php?id=<?php echo $d['id'];?>" class="affairName"><?php echo $d['audience'];?></a></th>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="calendar">
                                                <div class="year"><?php echo $d['year'];?></div>
                                                <div class="day">
                                                    <div class="month"><?php echo $d['month'];?></div>
                                                    <div class="date"><?php echo $d['date'];?></div>
                                                </div>
                                            </div>

                                            <ul>
                                                <li>結果：<span>需重新登錄</span></li>
                                                <li>原因：<span><?php echo $d['recommend'];?></span></li>
                                            </ul>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="text-right">
                                            <a href="member_affairs_record.php?id=<?php echo $d['id'];?>" class="btn_affairs_relog">重新登錄</a>
                                        </td>
                                    </tr>

                                </table>
                            </div>
                            <?php }?>
                        </div>
                    </div>
                    <?php }?>

                    <?php if(!empty($speach)){?>
                    <h5 class="colTitle">⎯ <?php echo $member['name'];?> <span class="cBlack">個人宣講歷程</span> ⎯</h5>

                    <div class="container">
                        <div class="row">
                            <?php foreach($speach as $k=>$d){?>
                            <?php if($k!=0&&$k%2==0) echo '</div><div class="row">';?>
                            <div class="col-sm-6">
                                <a href="member_affairs_recordinfo.php?id=<?php echo $d['id'];?>" class="affairName"><?php echo $d['audience'].'('.mingoDate($d['speachdate']).')'?></a>
                                <table class="normal-table">
                                    <tr>
                                        <td>使用教案</td>
                                        <td><?php echo $d['planText'];?></td>
                                    </tr>
                                    <tr>
                                        <td>城市鄉鎮</td>
                                        <td><?php echo $d['city'].' '.$d['area'];?></td>
                                    </tr>
                                    <tr>
                                        <td>總宣講時間</td>
                                        <td><?php echo $d['minutes'];?>分鐘</td>
                                    </tr>
                                    <tr>
                                        <td>參加人數</td>
                                        <td><?php echo $d['attends'];?>人</td>
                                    </tr>
                                    <tr>
                                        <td>登錄日期</td>
                                        <td><?php echo mingoDate($d['createtime']);?></td>
                                    </tr>
                                    <tr>
                                        <td>結果</td>
                                        <td><?php echo $d['statusText'];?></td>
                                    </tr>
                                </table>
                            </div>
                            <?php }?>
                        </div>
                    </div>
                    <?php }?>
                    
                    <button type="button" class="btn btn-submit record">+ 登錄宣講歷程</button>
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
        
        $('.record').click(function(){
            location.href = 'member_affairs_record.php';
        });
    });
    </script>
</body>

</html>