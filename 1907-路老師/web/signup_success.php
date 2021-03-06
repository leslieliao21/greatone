<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
    <!-- Basic Data -->
    <meta charset="UTF-8">
    <title>路老師培訓網 | 路老師註冊</title>
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
                    <p>註冊完成!恭喜您成為實習路老師!<br>
                        即日起可用您註冊的帳號密碼來登入網站。只要報名初訓課程，並實際宣講課程，經交通部認證後即可成為合格路老師。
                    </p>

                    <div class="text-center">
                        <button type="submit" class="btn btn-submit btnInline download">教案下載</button>
                        <button type="submit" class="btn btn-submit btnInline application">培訓報名</button>
                        <button type="submit" class="btn btn-submit btnInline affairs_record">宣講歷程登錄</button>
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
        $('.download').click(function(){
            location.href = 'member_download.php';
        });
        $('.application').click(function(){
            location.href = 'member_application.php';
        });
        $('.affairs_record').click(function(){
            location.href = 'member_affairs_record.php';
        });
    });
    </script>
</body>

</html>