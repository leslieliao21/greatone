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
    array('name'=>'編輯最新消息')
);

$id = isset($_GET['id'])?FUNCS::inputFilter('id','GET',1):0;
$result = newsList(array('id'=>$id),1);
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
                <form enctype="multipart/form-data" action="ajax/newsedit.php" method="post">
                <input type="hidden" name="etype" id="etype" value="edit" />
                <input type="hidden" name="id" id="id" value="<?php echo !empty($rec)?$rec['id']:'';?>" />
                <input type="hidden" name="o_cover" id="o_cover" value="<?php echo !empty($rec)?$rec['cover']:'';?>" />
                <input type="hidden" name="o_img1" id="o_img1" value="<?php echo !empty($rec)?$rec['img1']:'';?>" />
                <input type="hidden" name="o_img2" id="o_img2" value="<?php echo !empty($rec)?$rec['img2']:'';?>" />
                <input type="hidden" name="o_img3" id="o_img3" value="<?php echo !empty($rec)?$rec['img3']:'';?>" />
                <table width="100%" cellspacing="1" cellpadding="5" border="0" align="center" class="dataInsertTable">
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*內容樣式：</th>
                        <td width="80%" valign="top" align="left">
                            <select name="type" class="ness" data-ness="類別">
                                <option value="1"<?php echo !empty($rec)&&$rec['type']==1?' selected':'';?>>圖文</option>
                                <option value="2"<?php echo !empty($rec)&&$rec['type']==2?' selected':'';?>>圖片</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*狀態：</th>
                        <td width="80%" valign="top" align="left">
                            <select name="status" class="ness" data-ness="狀態">
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
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*標題：</th>
                        <td width="80%" valign="top" align="left">
                            <input class="ness" data-ness="標題" type="text" id="title" name="title" value="<?php echo !empty($rec)?$rec['title']:'';?>" style="width:99%;" />
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*簡介：</th>
                        <td width="80%" valign="top" align="left">
                            <textarea type="text" id="descript" class="ness" data-ness="簡介" name="descript" rows="5" style="width:99%;"><?php echo !empty($rec)?$rec['descript']:'';?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*列表圖：</th>
                        <td width="80%" valign="top" align="left">
                            <input type="file" id="cover" class="ness" data-ness="列表圖" data-file="o_cover" name="cover" />(585*438)
                            <?php if(!empty($rec)&&$rec['cover']!=''){?>
                            <img src="../upload/<?php echo $rec['cover'];?>" />
                            <?php }?>
                        </td>
                    </tr>
                    <tr class="cType2">
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">圖片：</th>
                        <td width="80%" valign="top" align="left">
                            <input type="file" id="img3" name="img3" />(1200*1700)
                            <?php if(!empty($rec)&&$rec['img3']!=''){?>
                            <img src="../upload/<?php echo $rec['img3'];?>" />
                            <?php }?>
                            <input type="text" id="img3url" name="img3url" value="<?php echo !empty($rec)?$rec['img3url']:'';?>" placeholder="連結網址" style="width:99%;" />
                        </td>
                    </tr>
                    <tr class="cType1">
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">內頁大圖：</th>
                        <td width="80%" valign="top" align="left">
                            <input type="file" id="img1" name="img1" />(1200*500)
                            <?php if(!empty($rec)&&$rec['img1']!=''){?>
                            <img src="../upload/<?php echo $rec['img1'];?>" />
                            <?php }?>
                            <input type="text" id="img1url" name="img1url" value="<?php echo !empty($rec)?$rec['img1url']:'';?>" placeholder="連結網址" style="width:99%;" />
                        </td>
                    </tr>
                    <tr class="cType1">
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">左側小圖：</th>
                        <td width="80%" valign="top" align="left">
                            <input type="file" id="img2" name="img2" />(380*420)
                            <?php if(!empty($rec)&&$rec['img2']!=''){?>
                            <img src="../upload/<?php echo $rec['img2'];?>" />
                            <?php }?>
                        </td>
                    </tr>
                    <tr class="cType1">
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">內文段落：</th>
                        <td width="80%" valign="top" align="left">
                            <input type="button" id="add" value="新增段落" />
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
            function addCont(cont){
                var $cont = $('<table width="100%" cellspacing="1" cellpadding="5" border="0" align="center" class="dataInsertTable" style="margin:10px;">\
                    <tr>\
                        <td valign="top" align="left" colspan="2">\
                            <input type="button" class="upBtn" value="上移" />\
                            <input type="button" class="downBtn" value="下移" />\
                            <input type="button" class="delBtn" value="刪除" />\
                        </td>\
                    </tr>\
                    <tr>\
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">內容：</th>\
                        <td width="80%" valign="top" align="left">\
                            <textarea name="content[]" rows="5" style="width:99%;">'+(cont?cont:'')+'</textarea>\
                        </td>\
                    </tr>\
                </table>');
                $('#add').before($cont);
                $cont.find('.upBtn').click(function(){ contSwitch($cont,$cont.prev('table')); });
                $cont.find('.downBtn').click(function(){ contSwitch($cont.next('table'),$cont); });
                $cont.find('.delBtn').click(function(){ contDel($cont); });
            }
            
            function contSwitch($cont1,$cont2){
                if(!$cont1||!$cont2) return;
                $cont1.after($cont2);
            }
            
            function contDel($cont){
                if(!confirm('確認刪除?')) return;
                $cont.remove();
            }
            
            $('select[name=type]').change(function(){
                $('.cType1, .cType2').css('display','none');
                switch($('select[name=type]').val()){
                    case '1':{ $('.cType1').css('display','table-row'); break; }
                    case '2':{ $('.cType2').css('display','table-row'); break; }
                }
            }).change();
            
            $('#add').click(function(){
                addCont();
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
            
            <?php if(!empty($rec)&&$rec['type']==1){?>
            var cont = JSON.parse('<?php echo $rec['content'];?>');
            $.each(cont,function(i,v){ addCont(v); });
            <?php }?>
        })();
        </script>
    </body>
</html>