<?php 
require_once '../php.lib/config.php';
require_once '../php.lib/main.php';
require_once '../php.lib/functions.php';
require_once '../php.lib/mysqli_class.php';
$DB = new DB_CONN();
$acc = isset($_POST['account'])?FUNCS::inputFilter('account','POST',3):'';
$psw = isset($_POST['psw'])?FUNCS::inputFilter('psw','POST',3):'';
$result = login($acc,$psw);
if(!empty($_POST) && $result['status']){
    header('Location:index.php?rn='.rand());
    exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Administration of Web Service</title>
        <link type='text/css' rel='stylesheet' href='css/basic_setting.css' />
    </head>
    <body>
        <div id="mainPageLayout" style="width:750px;">
            <div id="header" style="width:750px;">
                <div id="headerTitle"><b>後台管理系統</b></div>
                <div id="system_date"></div>
            </div>
            <div id="mainMenu"></div>
            <div id="mainContent">
                <div id="centerContent">
                    <div id="location">管理者登入</div>
                    <div class="clearboth"></div>
                    <form id="form1" name="form1" method="post" action="">
                    <input type="hidden" name="psw" />
                    <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:20px;color:#333;">
                        <tr>
                            <td width="40%"><b>帳號:</b>
                                <input type="text" name="account" style="width:110px;border:1px solid #999;" />
                            </td>
                            <td width="40%"><b>密碼:</b>
                                <input type="password" style="width: 110px;border:1px solid #999;" />
                            </td>
                            <td class="help">
                                <input type="image" name="submit" src="images/submit.gif" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
        <div class="clearboth"></div>

        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script type="text/javascript" src="../js.lib/functions.js"></script>
        <script type="text/javascript" src="../js.lib/parameters.js"></script>
        <script type="text/javascript" src="../js.lib/sha.js"></script>
        <script type="text/javascript" src="js/tpl.js"></script>
        <script type="text/javascript">
        $(document).ready(function(){
            <?php
            if(!empty($_POST) && !$result['status'])
                echo 'alert("'.$result['msg'].'");';
            ?>

            $('input[name=submit]').click(function(e){
                e.preventDefault();
                var acc = $('input[name=account]').val();
                var psw = $('input[type=password]').val();
                if(acc=='')
                    alert('請輸入帳號');
                else if(psw=='')
                    alert('請輸入密碼');
                else{
                    var hashObj = new jsSHA('SHA-1','TEXT');
                    hashObj.update(psw);
                    $('input[name=psw]').val(hashObj.getHash('HEX'));
                    $('#form1').submit();
                }
            });

            checkHeight();
            $(window).resize(checkHeight);
        });
        </script>
    </body>
</html>