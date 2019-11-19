<?php 
require_once '../php.lib/config.php';
require_once '../php.lib/main.php';
require_once '../php.lib/functions.php';
require_once '../php.lib/mysqli_class.php';
$result = loginChk();
if(!$result['status']){ header('Location:login.php?rn='.rand()); exit; }
$siteMap = $result['siteMap'];
$DB = new DB_CONN();
$crumbs = array(
    array('name'=>'編輯Q&A')
);

$id = isset($_GET['id'])?FUNCS::inputFilter('id','GET',1):0;
$result = qaList(array('id'=>$id),1);
$rec = !empty($result)?$result[0]:array();
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
                <form enctype="multipart/form-data" action="ajax/qaedit.php" method="post">
                <input type="hidden" name="etype" id="etype" value="edit" />
                <input type="hidden" name="id" id="id" value="<?php echo !empty($rec)?$rec['id']:'';?>" />
                <table width="100%" cellspacing="1" cellpadding="5" border="0" align="center" class="dataInsertTable">
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*問題：</th>
                        <td width="80%" valign="top" align="left">
                            <textarea class="ness" data-ness="問題" type="text" id="title" name="title" rows="5" style="width:99%;"><?php echo !empty($rec)?$rec['title']:'';?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*答案：</th>
                        <td width="80%" valign="top" align="left">
                            <textarea class="ness" data-ness="答案" type="text" id="content" name="content" rows="5" style="width:99%;"><?php echo !empty($rec)?$rec['content']:'';?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*上架狀態：</th>
                        <td width="80%" valign="top" align="left">
                            <select name="status" class="ness" data-ness="上架狀態">
                                <option value="1"<?php echo empty($rec)||$rec['status']==1?' selected':'';?>>上架</option>
                                <option value="0"<?php echo !empty($rec)&&$rec['status']!=1?' selected':'';?>>下架</option>
                            </select>
                        </td>
                    </tr>
                </table>
                </form>

                <table width="100%" cellspacing="1" cellpadding="5" border="0" align="center" class="dataInsertTable">
                    <tr>
                        <td style="text-align:center;">
                            <input type="button" id="save" value="儲存" />
                            <input type="button" id="cancel" value="取消" />
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="clearboth"></div>

        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script type="text/javascript" src="../js.lib/jquery_cookie.js"></script>
        <script type="text/javascript" src="../js.lib/jquery_treeview.js"></script>
        <script type="text/javascript" src="../js.lib/functions.js"></script>
        <script type="text/javascript" src="../js.lib/parameters.js"></script>
        <script type="text/javascript" src="js/tpl.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
        <script type="text/javascript">
        (function(){
            $('#save').click(function(){
				if(!chkNessInput($('form'))) return;
                $('form').submit();
            });
            
            $('#cancel').click(function(){
                history.back();
            });
        })();
        </script>
    </body>
</html>