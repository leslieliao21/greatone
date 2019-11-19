<?php 
require_once '../php.lib/config.php';
require_once '../php.lib/main.php';
require_once '../php.lib/functions.php';
require_once '../php.lib/mysqli_class.php';
$result = loginChk();
if(!$result['status']){ header('Location:login.php?rn='.rand()); exit; }
$siteMap = $result['siteMap'];
$crumbs = array(
    array('name'=>'變更密碼')
);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Administration of Web Service</title>
        <link type='text/css' rel='stylesheet' href='css/basic_setting.css' />
        <link type='text/css' rel='stylesheet' href='css/jquery_treeview.css' />
    </head>
    <body>
        <div id="mainPageLayout" class="comRange">
            <?php require_once 'tpls/header.php';?>
            <?php require_once 'tpls/menu.php';?>
            <div id="mainContent">
                <?php require_once 'tpls/crumb.php';?>
                <form enctype="multipart/form-data" action="ajax/psw.php" method="post" id="form1" autocomplete="off">
                <input type="hidden" name="etype" value="edit" />
                <table width="100%" cellspacing="0" cellpadding="7" id="fn_table" style="border:1px solid #ccc;margin:0;line-height:24px;">
                    <tr>
                        <td style="width:7%;">舊密碼：</td>
                        <td>
                            <input type="password" class="old_psw">
                            <input type="hidden" name="old">
                        </td>
                    </tr>
                    <tr>
                        <td>新密碼：</td>
                        <td>
                            <input type="password" class="new_psw">
                            <input type="hidden" name="new">
                        </td>
                    </tr>
                    <tr>
                        <td>新密碼確認：</td>
                        <td>
                            <input type="password"  class="new_psw_confirm">
                        </td>
                    </tr>
                    <tr><td><input type="button" id="psw_change" value="儲存"></td><td></td></tr>
                </table>
                </form>
            </div>
        </div>
        <div class="clearboth"></div>

        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script type="text/javascript" src="../js.lib/jquery_cookie.js"></script>
        <script type="text/javascript" src="../js.lib/jquery_treeview.js"></script>
        <script type="text/javascript" src="../js.lib/functions.js"></script>
        <script type="text/javascript" src="../js.lib/parameters.js"></script>
        <script type="text/javascript" src="../js.lib/sha.js"></script>
        <script type="text/javascript" src="js/tpl.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
        <script type="text/javascript">
            var siteMap = <?php echo json_encode($siteMap);?>;
            $(document).ready(function(){
                $('#psw_change').click(function(){
                    var old_psw = $('input.old_psw').val().trim();
                    var new_psw = $('input.new_psw').val().trim();
                    var new_psw_confirm = $('input.new_psw_confirm').val().trim();
                    if(old_psw == '')
                        alert('請輸入舊密碼');
                    else if(new_psw == '')
                        alert('請輸入新密碼');
                    else if(new_psw != new_psw_confirm)
                        alert('請確認新密碼是否正確');
                    else{
                        var hashObj = new jsSHA('SHA-1','TEXT');
                        hashObj.update(old_psw);
                        $('input[name=old]').val(hashObj.getHash('HEX'))
                        $.ajax({
                            type : 'post',
                            url : 'ajax/psw.php',
                            data : {
                                psw : hashObj.getHash('HEX'),
                                etype : 'chk'
                            },
                            dataType : 'json',
                            success : function(data){
                                if(data.msgcode == 200){
                                    hashObj = new jsSHA('SHA-1','TEXT');
                                    hashObj.update(new_psw);
                                    $('input[name=new]').val(hashObj.getHash('HEX'));
                                    $('#form1').submit();
                                }
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