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
?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
    <!-- Basic Data -->
    <meta charset="UTF-8">
    <title>路老師培訓網 | 修改手機/登入帳號</title>
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

<body id="sign-page" data-menu="0">
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
                        <h4><img src="images/icon/icon_title_write.png" alt="">
                            ‑ 修改手機/登入帳號 ‑</h4>
                    </div>
                    <p>請填寫手機號碼。手機號碼為登入帳號，新號碼需可收到簡訊驗證碼才可變更</p>

                    <form id="accountForm" action="ajax/account.php" method="post" class="form-horizontal">
                        <div class="form-group">
                            <label for="signupAccount" class="col-sm-3 control-label required labelIcon"
                                style="background-image: url('images/icon/icon_mobile.png')">
                                手機號碼
                            </label>
                            <div class="col-sm-7">
                                <input type="tel" class="form-control" id="signupAccount" name="account" placeholder="手機號碼，共10碼數字">
                            </div>
                            <div class="col-sm-2">
                                <a href="javascript:;" class="formAddition getAuth">取得驗證碼</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="signupVerificationCode" class="col-sm-3 control-label required labelIcon"
                                style="background-image: url('images/icon/icon_check.png')">
                                驗證碼
                            </label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="signupVerificationCode"
                                    placeholder="驗證碼，共5碼數字">
                            </div>

                        </div>
                        <button type="button" class="btn btn-submit submit">下一步</button>
                    </form>

                    <span class="cRed"><i class="glyphicon glyphicon-info-sign"></i> *為必填欄位</span>
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
    <script src="js.lib/parameters.js"></script>
    <script>
    $(document).ready(function(){
        $('#memberSelector').change(function(){
            location.href = $(this).val()+'.php';
        });
        
        $('.pageCont .getAuth').click(function(){
            var acc = $('#signupAccount').val();
            if(!acc.match(mobileReg))
                return alert('請確認帳號(手機號碼)格式正確');
            $.ajax({
                type : 'post',
                url : 'ajax/authcode.php',
                data : {account:acc},
                dataType : 'json',
                success : function(data){
                    if(data.msgcode == 200)
                        alert('請收取簡訊驗證碼');
                    else
                        alert(data.msg);
                }
            });
        });
        
        $('.pageCont .submit').click(function(){
            var acc = $('#signupAccount').val();
            if(!acc.match(mobileReg))
                return alert('請確認帳號(手機號碼)格式正確');
            
            var code = $('#signupVerificationCode').val();
            if(!code)
                return alert('請輸入驗證碼');
            
            $.ajax({
                type : 'post',
                url : 'ajax/auth.php',
                data : {account:acc,code:code},
                dataType : 'json',
                success : function(data){
                    if(data.msgcode == 200)
                        $('#accountForm').submit();
                    else
                        alert(data.msg);
                }
            });
        });
    });
    </script>

</body>

</html>