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
    array('name'=>'編輯首頁看版')
);

$id = isset($_GET['id'])?FUNCS::inputFilter('id','GET',1):0;
$result = kvList(array('id'=>$id),1);
$rec = !empty($result)?$result[0]:array();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Administration of Web Service</title>
        <link type='text/css' rel='stylesheet' href='css/basic_setting.css' />
        <link type='text/css' rel='stylesheet' href='css/jquery_treeview.css' />
        <link type='text/css' rel='stylesheet' href='../js.lib/datetimepicker/jquery.datetimepicker.css' />
    </head>
    <body>
        <div id="mainPageLayout" class="comRange">
            <?php require_once 'tpls/header.php';?>
            <?php require_once 'tpls/menu.php';?>
            <div id="mainContent">
                <?php require_once 'tpls/crumb.php';?>
                <form enctype="multipart/form-data" action="ajax/kvedit.php" method="post">
                <input type="hidden" name="etype" id="etype" value="edit" />
                <input type="hidden" name="id" id="id" value="<?php echo !empty($rec)?$rec['id']:'';?>" />
                <input type="hidden" name="o_img" id="o_img" value="<?php echo !empty($rec)?$rec['img']:'';?>" />
				<input type="hidden" name="o_img_mb" id="o_img_mb" value="<?php echo !empty($rec)?$rec['img_mb']:'';?>" />
                <table width="100%" cellspacing="1" cellpadding="5" border="0" align="center" class="dataInsertTable">
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*標題：</th>
                        <td width="80%" valign="top" align="left">
                            <input class="ness" data-ness="標題" type="text" id="title" name="title" value="<?php echo !empty($rec)?$rec['title']:'';?>" style="width:99%;" />
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*PC版圖片：</th>
                        <td width="80%" valign="top" align="left">
                            <input class="ness" data-ness="PC版圖片" type="file" id="img" name="img" data-file="o_img" />(1000*274)
                            <?php if(!empty($rec)&&$rec['img']!=''){?>
                            <img src="../upload/<?php echo $rec['img'];?>" />
                            <?php }?>
                        </td>
                    </tr>
					<tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*MB版圖片：</th>
                        <td width="80%" valign="top" align="left">
                            <input class="ness" data-ness="MB版圖片" type="file" id="img_mb" name="img_mb" data-file="o_img_mb" />(640*274)
                            <?php if(!empty($rec)&&$rec['img_mb']!=''){?>
                            <img src="../upload/<?php echo $rec['img_mb'];?>" />
                            <?php }?>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*連結網址：</th>
                        <td width="80%" valign="top" align="left">
                            <input class="ness" data-ness="連結網址" type="text" id="url" name="url" value="<?php echo !empty($rec)?$rec['url']:'';?>" style="width:99%;" />
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*發布日期：</th>
                        <td width="80%" valign="top" align="left">
                            <input type="text" id="publishdate" class="date ness" data-ness="發布日期" name="publishdate" value="<?php echo !empty($rec)?$rec['publishdate']:'';?>" />
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*次標題：</th>
                        <td width="80%" valign="top" align="left">
                            <input class="ness" data-ness="次標題" type="text" id="subtitle" name="subtitle" value="<?php echo !empty($rec)?$rec['subtitle']:'';?>" style="width:99%;" />
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
        <script type="text/javascript" src="../js.lib/datetimepicker/jquery.datetimepicker.js"></script>
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
            
            $('.date').datetimepicker({
                lang: 'ch',
                format: 'Y-m-d',
                scrollInput: false,
                closeOnDateSelect: true,
                timepicker: false
            });
        })();
        </script>
    </body>
</html>