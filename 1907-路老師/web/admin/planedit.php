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
    array('name'=>'編輯教案')
);

$id = isset($_GET['id'])?FUNCS::inputFilter('id','GET',1):0;
$result = planList(array('id'=>$id),1);
$rec = !empty($result)?$result[0]:array();

$planType = planTypeList(array());
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
                <form enctype="multipart/form-data" action="ajax/planedit.php" method="post">
                <input type="hidden" name="etype" id="etype" value="edit" />
                <input type="hidden" name="id" id="id" value="<?php echo !empty($rec)?$rec['id']:'';?>" />
                <input type="hidden" name="o_file1" id="o_file1" value="<?php echo !empty($rec)?$rec['file1']:'';?>" />
                <input type="hidden" name="o_file2" id="o_file2" value="<?php echo !empty($rec)?$rec['file2']:'';?>" />
                <input type="hidden" name="o_file3" id="o_file3" value="<?php echo !empty($rec)?$rec['file3']:'';?>" />
                <input type="hidden" name="o_file4" id="o_file4" value="<?php echo !empty($rec)?$rec['file4']:'';?>" />
                <input type="hidden" name="o_file5" id="o_file5" value="<?php echo !empty($rec)?$rec['file5']:'';?>" />
                <input type="hidden" name="o_file6" id="o_file6" value="<?php echo !empty($rec)?$rec['file6']:'';?>" />
                <table width="100%" cellspacing="1" cellpadding="5" border="0" align="center" class="dataInsertTable">
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*教案名稱：</th>
                        <td width="80%" valign="top" align="left">
                            <input class="ness" data-ness="教案名稱" type="text" id="title" name="title" value="<?php echo !empty($rec)?$rec['title']:'';?>" style="width:99%;" />
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*分類：</th>
                        <td width="80%" valign="top" align="left">
                            <select name="type" class="ness" data-ness="分類">
                                <?php foreach($planType as $k=>$d){?>
                                <option value="<?php echo $d['id'];?>"<?php echo !empty($rec)&&$rec['type']==$d['id']?' selected':'';?>><?php echo $d['title'];?></option>
                                <?php }?>
                            </select>
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
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*發布日期：</th>
                        <td width="80%" valign="top" align="left">
                            <input type="text" id="publishdate" class="date ness" data-ness="發布日期" name="publishdate" value="<?php echo !empty($rec)?$rec['publishdate']:'';?>" />
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*附件1：</th>
                        <td width="80%" valign="top" align="left">
                            <input class="ness" data-ness="附件1" type="text" id="fn1" name="fn1" value="<?php echo !empty($rec)?$rec['fn1']:'';?>" />
                            <input class="ness" data-ness="附件1" type="file" id="file1" name="file1" data-file="o_file1" />
                            <?php if(!empty($rec)&&$rec['file1']!=''){?>
                            <a href="../upload/<?php echo $rec['file1'];?>" target="_blank"><?php echo $rec['fn1'];?></a>
                            <input type="button" class="delBtn" value="刪除檔案"/>
                            <?php }?>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">附件2：</th>
                        <td width="80%" valign="top" align="left">
                            <input type="text" id="fn2" name="fn2" value="<?php echo !empty($rec)?$rec['fn2']:'';?>" />
                            <input type="file" id="file2" name="file2" data-file="o_file2" />
                            <?php if(!empty($rec)&&$rec['file2']!=''){?>
                            <a href="../upload/<?php echo $rec['file2'];?>" target="_blank"><?php echo $rec['fn2'];?></a>
                            <input type="button" class="delBtn" value="刪除檔案"/>
                            <?php }?>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">附件3：</th>
                        <td width="80%" valign="top" align="left">
                            <input type="text" id="fn3" name="fn3" value="<?php echo !empty($rec)?$rec['fn3']:'';?>" />
                            <input type="file" id="file3" name="file3" data-file="o_file3" />
                            <?php if(!empty($rec)&&$rec['file3']!=''){?>
                            <a href="../upload/<?php echo $rec['file3'];?>" target="_blank"><?php echo $rec['fn3'];?></a>
                            <input type="button" class="delBtn" value="刪除檔案"/>
                            <?php }?>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">附件4：</th>
                        <td width="80%" valign="top" align="left">
                            <input type="text" id="fn4" name="fn4" value="<?php echo !empty($rec)?$rec['fn4']:'';?>" />
                            <input type="file" id="file4" name="file4" data-file="o_file4" />
                            <?php if(!empty($rec)&&$rec['file4']!=''){?>
                            <a href="../upload/<?php echo $rec['file4'];?>" target="_blank"><?php echo $rec['fn4'];?></a>
                            <input type="button" class="delBtn" value="刪除檔案"/>
                            <?php }?>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">附件5：</th>
                        <td width="80%" valign="top" align="left">
                            <input type="text" id="fn5" name="fn5" value="<?php echo !empty($rec)?$rec['fn5']:'';?>" />
                            <input type="file" id="file5" name="file5" data-file="o_file5" />
                            <?php if(!empty($rec)&&$rec['file5']!=''){?>
                            <a href="../upload/<?php echo $rec['file5'];?>" target="_blank"><?php echo $rec['fn5'];?></a>
                            <input type="button" class="delBtn" value="刪除檔案"/>
                            <?php }?>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">附件6：</th>
                        <td width="80%" valign="top" align="left">
                            <input type="text" id="fn6" name="fn6" value="<?php echo !empty($rec)?$rec['fn6']:'';?>" />
                            <input type="file" id="file6" name="file6" data-file="o_file6" />
                            <?php if(!empty($rec)&&$rec['file6']!=''){?>
                            <a href="../upload/<?php echo $rec['file6'];?>" target="_blank"><?php echo $rec['fn6'];?></a>
                            <input type="button" class="delBtn" value="刪除檔案"/>
                            <?php }?>
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
            $('input[type=file]').change(function(){
                if(this.files[0].size<=50*1024*1024) return;
                alert('上傳檔案大於50MB');
                $(this).val('');
            });
            
            $('.delBtn').click(function(){
				if(!confirm('確認刪除?')) return;
                var $td = $(this).closest('td');
                $td.find('input[type=text],input[type=file]').val('');
                $td.find('a').remove();
                $('input[name='+$td.find('input[type=file]').data('file')+']').val('');
            });
            
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