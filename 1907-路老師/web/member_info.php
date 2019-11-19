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
    echo '<script>alert("not found");history.back();</script>';
    exit;
}
$GENDER = array('','男','女');

$info['genderText'] = $GENDER[$info['gender']];
$info['birthdayText'] = '民國'.mingoDate($info['birthday'],'y').'年'.date('m月d日',strtotime($info['birthday']));
$info['locationText'] = $info['city'].' '.$info['area'];
$info['licenseText'] = ($info['license_car']?'汽車':'').($info['license_car']&&$info['license_bike']?'、':'').($info['license_bike']?'機車':'');
?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
    <!-- Basic Data -->
    <meta charset="UTF-8">
    <title>路老師培訓網 | 個人資料修改</title>
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

<body id="member-page" class="memberInfoPage" data-menu="0">
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
                    <li class="active">個人資料</li>
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
                            <option value="member_application">培訓報名</option>
                            <option value="member_info" selected>個人資料</option>
                        </select>
                    </div>

                    <button type="button" class="btn btn-submit btnInline" onclick="location.href='ajax/signout.php'">登出</button>
                </div>

                <div class="pageCont">
                    <div class="pageBodyTitle">
                        <h4><img src="images/icon/icon_title_signin.png" alt="">
                            ‑ 個人資料修改 ‑</h4>
                    </div>

                    <?php if($member['firstTime']){?>
                    <p>請確認以下個人資訊，若不正確請修改資料</p>
                    <?php }?>

                    <table class="normal-table">

                        <tr>
                            <td>姓名</td>
                            <td><?php echo $info['name'];?></td>
                        </tr>
                        <tr>
                            <td>性別</td>
                            <td><?php echo $info['genderText'];?></td>
                        </tr>
                        <tr>
                            <td>生日</td>
                            <td><?php echo $info['birthdayText'];?></td>
                        </tr>
                        <tr>
                            <td>居住地區</td>
                            <td><?php echo $info['locationText'];?></td>
                        </tr>
                        <tr>
                            <td>手機</td>
                            <td>
                                <div class="col-sm-8">
                                    <p><?php echo $info['account'];?></p>
                                    <span><i class="glyphicon glyphicon-info-sign"></i>備註:手機號碼為登入帳號，<br class="showDinline">若更改手機號碼，新號碼需可收到簡訊驗證碼才可變更</span>
                                </div>
                                <div class="col-sm-4">
                                    <button type="button" class="btn btn-edit editAccount">修改手機/登入帳號</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>密碼</td>
                            <td>
                                <div class="col-sm-8">
                                    <p>************</p>
                                    <span><i class="glyphicon glyphicon-info-sign"></i>備註:若您已是合格路老師且為第一次登入，則預設密碼為手機號碼</span>
                                </div>
                                <div class="col-sm-4">
                                    <button type="button" class="btn btn-edit editPassword">修改密碼</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Line ID</td>
                            <td><?php echo $info['lineid'];?></td>
                        </tr>
                        <tr>
                            <td>精通語言</td>
                            <td><?php echo $info['language'];?></td>
                        </tr>
                        <tr>
                            <td>職業</td>
                            <td><?php echo $info['career'];?></td>
                        </tr>
                        <tr>
                            <td>經常使用之交通工具</td>
                            <td><?php echo $info['transportation'];?></td>
                        </tr>
                        <tr>
                            <td>駕照</td>
                            <td><?php echo $info['licenseText'];?></td>
                        </tr>
                        <tr>
                            <td>服務單位</td>
                            <td><?php echo $info['service'];?></td>
                        </tr>

                    </table>

                    <button type="button" class="btn btn-submit edit">修改資料</button>

                    <!--<form action="" class="form-horizontal">
                        <div class="form-group">
                            <label for="signupName" class="col-sm-3 control-label labelIcon"
                                style="background-image: url('images/icon/icon_signup_info01.png')">姓名</label>
                            <div class="col-sm-9">
                               <p>王大明</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label labelIcon"
                                style="background-image: url('images/icon/icon_signup_info02.png')">性別</label>
                            <div class="col-sm-9">
                                <p>男</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="signupBirth" class="col-sm-3 control-label labelIcon"
                                style="background-image: url('images/icon/icon_signup_info03.png')">出生日期</label>
                            <div class="col-sm-9">
                                <p>民國77年7月7日</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="signupArea" class="col-sm-3 control-label labelIcon"
                                style="background-image: url('images/icon/icon_signup_info04.png')">居住地區</label>
                            <div class="col-sm-9">
                                <p>台北市 中山區</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="signupEmail" class="col-sm-3 control-label labelIcon"
                                style="background-image: url('images/icon/icon_signup_info05.png')">Email</label>
                            <div class="col-sm-6">
                                <p>0912345678</p>
                                <span>備註:⼿機號碼為登入帳號，若更改手機號碼，<br>
                                    新號碼需可收到簡訊驗證碼才可變更</span>
                            </div>
                            <div class="col-sm-3">
                                <button type="button" class="btn btn-submit">修改手機/登入帳號</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label labelIcon"
                                style="background-image: url('images/icon/icon_signup_info06.png')">市話</label>
                                <div class="col-sm-6">
                                    <p>0912345678</p>
                                    <span>備註:預設登入密碼為手機號碼</span>
                                </div>
                                <div class="col-sm-3">
                                    <button type="button" class="btn btn-submit">修改密碼</button>
                                </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label labelIcon"
                                style="background-image: url('images/icon/icon_signup_info07.png')">Line ID</label>
                            <div class="col-sm-9">
                                <p>lineID</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label labelIcon"
                                style="background-image: url('images/icon/icon_signup_info08.png')">精通語言</label>
                            <div class="col-sm-9">
                                <p>國語、台語</p>
                            </div>
                        </div>
                        <div class="form-group mgt-n10">
                            <label for="signupJob" class="col-sm-3 control-label labelIcon"
                                style="background-image: url('images/icon/icon_signup_info09.png')">職業</label>
                            <div class="col-sm-9">
                                <p>其他、擺地攤</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label labelIcon"
                                style="background-image: url('images/icon/icon_signup_info10.png')">經常使用之交通工具</label>
                            <div class="col-sm-9">
                                <p>機車、汽車</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label labelIcon"
                                style="background-image: url('images/icon/icon_signup_info11.png')">持有駕照</label>
                            <div class="col-sm-9">
                                <p>機車、汽車</p>
                            </div>
                        </div>
                        <div class="form-group mgt-n10">
                            <label for="signupWork" class="col-sm-3 control-label labelIcon"
                                style="background-image: url('images/icon/icon_signup_info12.png')">服務單位</label>
                            <div class="col-sm-9">
                                <p>石牌國小 教務處</p>
                            </div>
                        </div>

                        <button type="button" class="btn btn-submit">修改資料</button>
                    </form>-->

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
        
        $('.editAccount').click(function(){
            location.href = 'member_info_edit_account_step1.php';
        });
        
        $('.editPassword').click(function(){
            location.href = 'member_info_edit_password.php';
        });
        
        $('.edit').click(function(){
            location.href = 'member_info_edit.php';
        });
    });
    </script>
</body>

</html>