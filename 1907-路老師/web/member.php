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

$result = teacherList(array('id'=>$member['id']),1);
$info = !empty($result)?$result[0]:array();
if(empty($info)){
    echo 'error';
    exit;
}

$info['qualifyText'] = '';
switch($info['qualify']){
    case 1:{ $info['qualifyText'] = '合格路老師'; break; }
    case 2:{ $info['qualifyText'] = '實習路老師'; break; }
    case 3:{ $info['qualifyText'] = '一般民眾'; break; }
}

// 獎項
$award = '';
$query = 'SELECT a.title FROM winner w LEFT JOIN award a on a.id=w.aid WHERE w.tid='.$member['id'];
$result = $DB->select($query);
foreach($result['data'] as $k=>$d)
    $award .= ($award?'，':'').$d['title'];
$award = $award?$award:'再接再厲，下次就可拿獎！';

// 培訓歷程
$query = 'SELECT t.year,t.title FROM trainingmember m LEFT JOIN training t on t.id=m.trid WHERE m.teid='.$member['id'].' AND m.status=2 ORDER BY t.sdate DESC';
$result = $DB->select($query);
$experience = !empty($result['data'])?$result['data']:array();

// 宣講歷程
$speach = speachList(array('tid'=>$member['id'],'order'=>'speachdate desc'),3);

// 路老師培訓報名
$retraining = array();
if($member['qualify']==1)
    $retraining = trainingList(array('type'=>2,'status'=>1,'order'=>'sdate DESC'),0);
$training = trainingList(array('type'=>1,'status'=>1,'order'=>'sdate DESC'),0);

foreach($retraining as $k=>$d){
    $retraining[$k]['date'] = date('m/d',strtotime($d['sdate'])).($d['sdate']!='0000-00-00'&&$d['edate']!='0000-00-00'?',':'').date('m/d',strtotime($d['edate']));
}

foreach($training as $k=>$d){
    $training[$k]['date'] = date('m/d',strtotime($d['sdate'])).($d['sdate']!='0000-00-00'&&$d['edate']!='0000-00-00'?',':'').date('m/d',strtotime($d['edate']));
}

// 宣講歷程重新登錄通知
$comment = speachList(array('tid'=>$member['id'],'status'=>2,'order'=>'speachdate desc'),4);
foreach($comment as $k=>$d){
    $comment[$k]['year'] = mingoDate($d['createtime'],'y');
    $comment[$k]['month'] = strtoupper(date('M',strtotime($d['createtime'])));
    $comment[$k]['date'] = date('d',strtotime($d['createtime']));
}
?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
    <!-- Basic Data -->
    <meta charset="UTF-8">
    <title>路老師培訓網 | 個人專區</title>
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

<body id="member-page" class="memberMainPage" data-menu="0">
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
                    <li class="active">個人專區</li>
                </ol>
                
                <div class="signout">
                    <div class="showDinlineblock">
                        <label for="memberSelector"><?php echo $member['name'];?> 老師</label>
                        <select name="" id="memberSelector" class="form-control w200">
                            <option value="member" selected>路老師專區</option>
                            <?php if(in_array($member['qualify'],array(1,2))){?>
                            <option value="member_affairs">個人宣講歷程</option>
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
                            ‑ <span class="cBlue"><?php echo $info['name'];?></span>個人專區 ‑
                        </h4>
                    </div>

                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                                <table class="normal-table">
                                    <tr>
                                        <td>登入帳號(手機)</td>
                                        <td><?php echo $info['account'];?></td>
                                    </tr>
                                    <tr>
                                        <td>獎項</td>
                                        <td><?php echo $award;?></td>
                                    </tr>
                                    <?php if(!empty($experience)){?>
                                    <tr>
                                        <td>培訓歷程</td>
                                        <td>
                                            <ul>
                                                <?php foreach($experience as $k=>$d){?>
                                                <li<?php echo $k>=4?' class="hide"':'';?>><?php echo $d['year'];?>年 <?php echo $d['title'];?></li>
                                                <?php }?>
                                            </ul>
                                            <a href="javascript:;" class="btnMore text-right trainingExpend"><i class="glyphicon glyphicon-play"></i><span>展開</span></a>
                                        </td>
                                    </tr>
                                    <?php }?>
                                </table>
                            </div>
                            <div class="col-sm-6">
                                <table class="normal-table">
                                    <tr>
                                        <td>身份</td>
                                        <td><?php echo $info['qualifyText'];?></td>
                                    </tr>
                                    <?php if($info['qualify']==1){?>
                                    <tr>
                                        <td>路老師認證年份</td>
                                        <td><?php echo $info['year'];?>年</td>
                                    </tr>
                                    <?php }?>
                                    <?php if(!empty($speach)){?>
                                    <tr>
                                        <td>宣講歷程</td>
                                        <td>
                                            <ul>
                                                <?php foreach($speach as $k=>$d){?>
                                                <li<?php echo $k>=4?' class="hide"':'';?>><a href="member_affairs_recordinfo.php?id=<?php echo $d['id'];?>"><?php echo $d['audience'];?></a></li>
                                                <?php }?>
                                            </ul>
                                            <a href="member_affairs.php" class="btnMore text-right"><i class="glyphicon glyphicon-play"></i><span>顯示全部</span></a>
                                        </td>
                                    </tr>
                                    <?php }?>
                                </table>
                            </div>
                        </div>
                    </div>

                    <?php if(!empty($retraining)||!empty($training)){?>
                    <h5 class="colTitle">⎯ <span class="cBlack">路老師培訓報名</span> ⎯</h5>

                    <div class="container">
                        <div class="row">
                            <?php if(!empty($retraining)){?>
                            <div class="col-sm-6">
                                <table class="column-table applyTable">
                                    <tr>
                                        <th><span class="applyName">回訓報名</span></th>
                                    </tr>

                                    <tr>
                                        <td>
                                            <ul>
                                                <?php foreach($retraining as $k=>$d){?>
                                                <li<?php echo $k>=4?' class="hide"':'';?>><a href="member_apply.php?id=<?php echo $d['id'];?>"><?php echo $d['title'].' '.$d['date'];?></a></li>
                                                <?php }?>
                                            </ul>
                                            <a href="javascript:;" class="btnMore text-right trainingExpend"><i class="glyphicon glyphicon-play"></i><span>展開</span></a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <?php }?>
                            <?php if(!empty($training)){?>
                            <div class="col-sm-6">
                                <table class="column-table applyTable">
                                    <tr>
                                        <th><span class="applyName">初訓報名</span></th>
                                    </tr>

                                    <tr>
                                        <td>
                                            <ul>
                                                <?php foreach($training as $k=>$d){?>
                                                <li<?php echo $k>=4?' class="hide"':'';?>><a href="member_apply.php?id=<?php echo $d['id'];?>"><?php echo $d['title'].' '.$d['date'];?></a></li>
                                                <?php }?>
                                            </ul>
                                            <a href="javascript:;" class="btnMore text-right trainingExpend"><i class="glyphicon glyphicon-play"></i><span>展開</span></a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <?php }?>
                        </div>
                    </div>
                    <?php }?>
                    
                    <?php if(!empty($comment)){?>
                    <h5 class="colTitle">⎯ <span class="cBlack">宣講歷程重新登錄通知</span> ⎯</h5>

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
                            <div class="col-sm-12 text-right">
                                <a href="member_affairs.php" class="btnMore"><i class="glyphicon glyphicon-play"></i><span>顯示全部</span></a>
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
    <script>
    $(document).ready(function(){
        $('#memberSelector').change(function(){
            location.href = $(this).val()+'.php';
        });
        
        $('.trainingExpend').click(function(){
            $(this).closest('td').find('li').removeClass('hide');
        });
    });
    </script>

</body>

</html>