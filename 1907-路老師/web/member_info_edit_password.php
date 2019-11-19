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
    <title>路老師培訓網 | 修改密碼</title>
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
                            ‑ 修改密碼 ‑</h4>
                    </div>
                    <p>修改完成，請用新帳號/手機號碼登入</p>

                    <form id="passwordForm" action="ajax/password.php" method="post">
                        <input type="hidden" name="etype" value="edit">
                        <div class="form-group">
                            <label for="signinPasswordOld" class="col-sm-3 control-label labelIcon"
                                style="background-image: url('images/icon/icon_pw.png')">
                                原登入密碼
                            </label>
                            <div class="col-sm-9">
                                <input type="hidden" name="opsw">
                                <input type="password" class="form-control" id="signinPasswordOld" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="signinPasswordNew" class="col-sm-3 control-label labelIcon"
                                style="background-image: url('images/icon/icon_pw.png')">
                                新密碼
                            </label>
                            <div class="col-sm-9">
                                <input type="hidden" name="npsw">
                                <input type="password" class="form-control" id="signinPasswordNew" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="signinPasswordNew2" class="col-sm-3 control-label labelIcon"
                                style="background-image: url('images/icon/icon_pw.png')">
                                再次輸入新密碼
                            </label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="signinPasswordNew2" placeholder="">
                            </div>
                        </div>
                        <button type="button" class="btn btn-submit submit">下一步</button>
                    </form>

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
    <script type="text/javascript" src="js.lib/sha.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $('#memberSelector').change(function(){
            location.href = $(this).val()+'.php';
        });
        
        $('#signinPasswordOld').keyup(function(){
            var psw = $(this).val();
            var hashObj = new jsSHA('SHA-1','TEXT');
            hashObj.update(psw);
            $('input[name=opsw]').val(hashObj.getHash('HEX'));
        });
        $('#signinPasswordNew').keyup(function(){
            var psw = $(this).val();
            var hashObj = new jsSHA('SHA-1','TEXT');
            hashObj.update(psw);
            $('input[name=npsw]').val(hashObj.getHash('HEX'));
        });
        $('.pageCont .submit').click(function(){
            var opsw = $('#signinPasswordOld').val();
            var npsw = $('#signinPasswordNew').val();
            var rpsw = $('#signinPasswordNew2').val();
            if(opsw=='')
                alert('請輸入舊密碼');
            else if(npsw=='')
                alert('請輸入新密碼');
            else if(npsw!=rpsw)
                alert('請確認新密碼是否正確');
            else{
                $.ajax({
                    type : 'post',
                    url : 'ajax/password.php',
                    data : {
                        psw : $('input[name=opsw]').val(),
                        etype : 'chk'
                    },
                    dataType : 'json',
                    success : function(data){
                        if(data.msgcode == 200)
                            $('#passwordForm').submit();
                        else
                            alert('舊密碼不正確，請重新輸入');
                    }
                });
            }
        });
    });
    </script>
</body>

</html>