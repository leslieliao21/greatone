<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
    <!-- Basic Data -->
    <meta charset="UTF-8">
    <title>路老師培訓網 | 單位登入</title>
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

<body id="sign-page" class="deptSignPage" data-menu="1">
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
            <h2 class="pageHead">‑ 我要找路老師 ‑</h2>

            <div class="bodyCont">

                <ol class="breadcrumb">
                    <li><a href="index.php">首頁</a></li>
                    <li><a href="teacher_search.php">我要找路老師</a></li>
                    <li class="active">單位登入</li>
                </ol>

                <div class="pageCont mgb-30">
                    <div class="pageBodyTitle">
                        <h4><img src="images/icon/icon_title_signin.png" alt="">
                            ‑ 單位登入 ‑</h4>
                    </div>
                    <p>本單元提供需求單位查詢路老師，以便後續跟路老師聯繫。</p>

                    <form action="ajax/dept_signin.php" method="post">
                        <div class="form-group">
                            <label for="signupAccount" class="col-sm-2 control-label labelIcon"
                                style="background-image: url('images/icon/icon_mobile.png')">
                                帳號
                            </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="signinAccount" name="account" placeholder="請輸入帳號">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="signinPassword" class="col-sm-2 control-label labelIcon"
                                style="background-image: url('images/icon/icon_pw.png')">
                                密碼
                            </label>
                            <div class="col-sm-10">
                                <input type="hidden" name="psw">
                                <input type="password" class="form-control" id="signinPassword" placeholder="請輸入密碼">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-submit">登入</button>
                        <!-- <button type="button" class="btn btn-link">忘記密碼</button> -->
                    </form>

                </div>

                <div class="pageCont">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="pageBodyTitle">
                                    <h4><img src="images/icon/icon_title_unlock.png" alt="">⎯ 忘記帳號或密碼 ⎯</h4>
                                </div>
                                <p>若您忘記你的登入帳號或密碼，請逕洽您的登入帳號核發機關，或請<a href="contact.php" class="cblue">聯絡我們</a>。</p>
                            </div>

                            <div class="col-sm-2"></div>

                            <div class="col-sm-5">
                                <div class="pageBodyTitle">
                                    <h4><img src="images/icon/icon_title_mobile.png" alt="">⎯ 提供登入帳號 ⎯</h4>
                                </div>
                                <p>若您的單位需要帳號，請<a href="contact.php" class="cblue">聯絡我們</a>。</p>
                            </div>
                        </div>
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
    <script type="text/javascript" src="js.lib/sha.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $('#signinPassword').keyup(function(){
            var psw = $(this).val();
            var hashObj = new jsSHA('SHA-1','TEXT');
            hashObj.update(psw);
            $('input[name=psw]').val(hashObj.getHash('HEX'));
        });
    });
    </script>

</body>

</html>