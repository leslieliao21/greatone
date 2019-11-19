<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
    <!-- Basic Data -->
    <meta charset="UTF-8">
    <title>路老師培訓網 | 實習路老師註冊</title>
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
                    <li class="active">路老師註冊</li>
                </ol>

                <div class="pageCont">
                    <div class="pageBodyTitle">
                        <h4><img src="images/icon/icon_title_write.png" alt="">
                            ‑ 路老師註冊 ‑</h4>
                    </div>
                    <p>請填寫以下資料註冊路老師</p>

                    <form id="signupForm" action="signup_info.php" class="form-horizontal" method="post">
                        <div class="form-group">
                            <label for="signupAccount" class="col-sm-3 control-label required labelIcon" style="background-image: url('images/icon/icon_mobile.png')">
                                登入帳號
                            </label>
                            <div class="col-sm-7">
                                <input type="tel" class="form-control" id="signupAccount" name="account" placeholder="手機號碼，共10碼數字">
                            </div>
                            <div class="col-sm-2">
                                <a href="javascript:;" class="formAddition getAuth">取得驗證碼</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="signupVerificationCode" class="col-sm-3 control-label required labelIcon" style="background-image: url('images/icon/icon_check.png')">
                                驗證碼
                            </label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="signupVerificationCode"
                                    placeholder="驗證碼，共5碼數字">
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="signupPassword" class="col-sm-3 control-label required labelIcon" style="background-image: url('images/icon/icon_pw.png')">
                                登入密碼
                            </label>
                            <div class="col-sm-7">
                                <input type="hidden" name="psw">
                                <input type="password" class="form-control" id="signupPassword" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="signupPassword2" class="col-sm-3 control-label required labelIcon" style="background-image: url('images/icon/icon_pw.png')">
                                再次輸入密碼
                            </label>
                            <div class="col-sm-7">
                                <input type="password" class="form-control" id="signupPassword2" placeholder="">
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
    <script type="text/javascript" src="js.lib/sha.js"></script>
    <script>
    $(document).ready(function(){
        $('#signupPassword').keyup(function(){
            var psw = $(this).val();
            var hashObj = new jsSHA('SHA-1','TEXT');
            hashObj.update(psw);
            $('input[name=psw]').val(hashObj.getHash('HEX'));
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
            
            var opsw = $('#signupPassword').val();
            var rpsw = $('#signupPassword2').val();
            if(!opsw || opsw!=rpsw)
                return alert('請輸入密碼並確認密碼相同');
            
            $.ajax({
                type : 'post',
                url : 'ajax/auth.php',
                data : {account:acc,code:code},
                dataType : 'json',
                success : function(data){
                    if(data.msgcode == 200)
                        $('#signupForm').submit();
                    else
                        alert(data.msg);
                }
            });
        });
    });
    </script>

</body>

</html>