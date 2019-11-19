<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
    <!-- Basic Data -->
    <meta charset="UTF-8">
    <title>路老師培訓網 | 忘記密碼</title>
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
                    <li class="active">忘記密碼</li>
                </ol>

                <div class="pageCont">
                    <div class="pageBodyTitle">
                        <h4><img src="images/icon/icon_title_unlock.png" alt="">
                            ‑ 忘記密碼 ‑</h4>
                    </div>
                    <p>請填寫手機號碼，您的密碼將用簡訊傳送到填寫的手機</p>

                    <form action="ajax/forgot.php" method="post">
                        <div class="form-group">
                            <label for="signupAccount" class="col-sm-3 control-label">
                                <img src="images/icon/icon_mobile.png" alt="">
                                手機號碼
                            </label>
                            <div class="col-sm-9">
                                <input type="tel" class="form-control" id="signinAccount" name="account" placeholder="手機號碼，共10碼數字">
                            </div>
                        </div>
                        <button type="button" class="btn btn-gray btnInline back">回登入頁</button>
                        <button type="submit" class="btn btn-submit btnInline">送出</button>
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
    <script>
    $(document).ready(function(){
        $('.pageCont .back').click(function(){
            location.href = 'signin.php';
        });
    });
    </script>

</body>

</html>