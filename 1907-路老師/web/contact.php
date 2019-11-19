<?php 
require_once 'php.lib/config.php';
?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
    <!-- Basic Data -->
    <meta charset="UTF-8">
    <title>路老師培訓網 | 聯絡我們</title>
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

<body id="sign-page" class="contactPage">
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
            <h2 class="pageHead">‑ 路老師介紹 ‑</h2>

            <div class="bodyCont">

                <ol class="breadcrumb">
                    <li><a href="index.php">首頁</a></li>
                    <li><a href="intro.php">路老師介紹</a></li>
                    <li class="active">聯絡我們</li>
                </ol>

                <div class="pageCont">
                    <div class="pageBodyTitle">
                        <h4><img src="images/icon/icon_title_write.png" alt="">
                            ‑ 聯絡我們 ‑</h4>
                    </div>
                    <p>請留下以下資料，我們將盡快與您聯繫</p>

                    <form id="contactForm" action="ajax/contact.php" method="post">
                        <div class="form-group">
                            <label for="contactName" class="col-sm-2 control-label required labelIcon"
                                style="background-image: url('images/icon/icon_signup_info01.png')">
                                姓名
                            </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="contactName" name="name" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="contactPhone" class="col-sm-2 control-label required labelIcon"
                                style="background-image: url('images/icon/icon_signup_info06.png')">
                                聯絡電話
                            </label>
                            <div class="col-sm-10">
                                <input type="tel" class="form-control" id="contactPhone" name="phone" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="contactType" class="col-sm-2 control-label required labelIcon"
                                style="background-image: url('images/icon/icon_signup_info04.png')">
                                問題類型
                            </label>
                            <div class="col-sm-10">
                                <select class="form-control" name="type">
                                    <?php for($i=1;$i<count($CONTACTTYPE);$i++){?>
                                    <option value="<?php echo $CONTACTTYPE[$i];?>"><?php echo $CONTACTTYPE[$i];?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="contactDetail" class="col-sm-2 control-label">
                                
                            </label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="5" id="contactDetail" name="detail" placeholder="說明"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-submit submit">送出</button>
                    </form>

                    <span class="cRed"><i class="glyphicon glyphicon-info-sign"></i> *為必填欄位</span>
                    <span><i class="glyphicon glyphicon-info-sign"></i> 或於上班日10:00~18:00致電02-25068916分機 #222簡佑勳 #212倪靖 #223蔡子彥 #213吳建霆</span> 

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
  <script type="text/javascript" src="js.lib/parameters.js"></script>
    <script>
    $(document).ready(function(){
        $('#contactForm .submit').click(function(e){
            e.preventDefault();
            var name = $('#contactName').val();
            if(!name)
                return alert('請填寫姓名');
            
            var phone = $('#contactPhone').val();
            if(!phone||(!phone.match(phoneReg)&&!phone.match(mobileReg)))
                return alert('請填寫並確認電話格式正確');
            
            var detail = $('#contactDetail').val();
            if(!detail)
                return alert('請填寫問題說明');
            
            $('#contactForm').submit();
        });
    });
    </script>

</body>

</html>