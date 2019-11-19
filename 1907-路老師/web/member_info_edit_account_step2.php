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

                <div class="pageCont bglightBrown">
                    <div class="pageBodyTitle">
                        <h4><img src="images/icon/icon_title_write.png" alt="">
                            ‑ 修改手機/登入帳號 ‑</h4>
                    </div>
                    <p>修改完成，請用新帳號/手機號碼登入</p>

                    <form action="ajax/signin.php" method="post">
                        <div class="form-group">
                            <label for="signinAccount" class="col-sm-2 control-label labelIcon"
                                style="background-image: url('images/icon/icon_mobile.png')">
                                帳號
                            </label>
                            <div class="col-sm-10">
                                <input type="tel" class="form-control" id="signinAccount" name="account" placeholder="手機號碼，共10碼數字">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="signinPassword" class="col-sm-2 control-label labelIcon"
                                style="background-image: url('images/icon/icon_pw.png')">
                                密碼
                            </label>
                            <div class="col-sm-10">
                                <input type="hidden" name="psw">
                                <input type="password" class="form-control" id="signinPassword" placeholder="預設為手機號碼">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-submit">登入</button>
                        <button type="button" class="btn btn-link forgot">忘記密碼</button>
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
        
        $('#signinPassword').keyup(function(){
            var psw = $(this).val();
            var hashObj = new jsSHA('SHA-1','TEXT');
            hashObj.update(psw);
            $('input[name=psw]').val(hashObj.getHash('HEX'));
        });
        $('.pageCont .forgot').click(function(){
            location.href = 'signin_forgot-password.php';
        });
    });
    </script>

</body>

</html>