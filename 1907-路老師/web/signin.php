<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
    <!-- Basic Data -->
    <meta charset="UTF-8">
    <title>路老師培訓網 | 路老師登入</title>
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
                    <li class="active">路老師登入</li>
                </ol>

                <div class="pageCont bglightBrown">
                    <div class="pageBodyTitle">
                        <h4><img src="images/icon/icon_title_signin.png" alt="">
                            ‑ 路老師登入 ‑</h4>
                    </div>
                    <p>「路老師」，全名為「向高齡者宣講道路交通安全知識的老師」。在交通部路⽼老師培訓與宣講計畫中，本站提供宣講教材下載，路老師登錄宣講歷程以及培訓報名。<br>
                        只要您曾經取得過合格路老師證照或註冊過實習路老師，就可直接登入，若無法登入請聯絡我們，會有專員盡快與您聯繫。<br>
                        <font class="cRed">備註：手機號碼為登入帳號，每個號碼只能被註冊一次</font>
                    </p>

                    <form action="ajax/signin.php" method="post">
                        <div class="form-group">
                            <label for="signinAccount" class="col-sm-2 control-label labelIcon" style="background-image: url('images/icon/icon_mobile.png')">
                                帳號
                            </label>
                            <div class="col-sm-10">
                                <input type="tel" class="form-control" id="signinAccount" name="account" placeholder="手機號碼，共10碼數字">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="signinPassword" class="col-sm-2 control-label labelIcon" style="background-image: url('images/icon/icon_pw.png')">
                                密碼
                            </label>
                            <div class="col-sm-10">
                                <input type="hidden" name="psw">
                                <input type="password" class="form-control" id="signinPassword" placeholder="">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-submit">登入</button>
                        <button type="button" class="btn btn-link forgot">忘記密碼</button>
                    </form>

                </div>
                <div class="pageCont">

                    <div class="pageBodyTitle">
                        <h4><img src="images/icon/icon_title_write.png" alt="">⎯ 路老師註冊 ⎯</h4>
                    </div>
                    <p>想成為合格路老師嗎？快來註冊實習路老師填寫個人資料，報名初訓課程，並實際宣講課程，經管理者認證後即可成為合格路老師。</p>
                    <button type="button" class="btn btn-submit signup">註冊</button>

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
        $('#signinPassword').keyup(function(){
            var psw = $(this).val();
            var hashObj = new jsSHA('SHA-1','TEXT');
            hashObj.update(psw);
            $('input[name=psw]').val(hashObj.getHash('HEX'));
        });
        $('.pageCont .forgot').click(function(){
            location.href = 'signin_forgot-password.php';
        });
        $('.pageCont .signup').click(function(){
            location.href = 'signup.php';
        });
    });
    </script>

</body>

</html>