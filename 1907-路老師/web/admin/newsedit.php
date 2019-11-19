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
if(!empty($rec))
    $rec['cont'] = newsContList(array('nid'=>$id));
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
                <table width="100%" cellspacing="1" cellpadding="5" border="0" align="center" class="dataInsertTable">
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*類別：</th>
                        <td width="80%" valign="top" align="left">
                            <select name="type" class="ness" data-ness="類別">
                                <?php for($i=1;$i<count($NEWSTYPE);$i++){?>
                                <option value="<?php echo $i;?>"<?php echo !empty($rec)&&$rec['type']==$i?' selected':'';?>><?php echo $NEWSTYPE[$i];?></option>
                                <?php }?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*標題：</th>
                        <td width="80%" valign="top" align="left">
                            <input class="ness" data-ness="標題" type="text" id="title" name="title" value="<?php echo !empty($rec)?$rec['title']:'';?>" style="width:99%;" />
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*發布日期：</th>
                        <td width="80%" valign="top" align="left">
                            <input type="text" id="publishdate" class="date ness" data-ness="發布日期" name="publishdate" value="<?php echo !empty($rec)?$rec['publishdate']:'';?>" />
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*簡介：</th>
                        <td width="80%" valign="top" align="left">
                            <textarea type="text" id="descript" class="ness" data-ness="簡介" name="descript" rows="5" style="width:99%;"><?php echo !empty($rec)?$rec['descript']:'';?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">列表圖：</th>
                        <td width="80%" valign="top" align="left">
                            <input type="file" id="cover" name="cover" />(1920*820)
                            <?php if(!empty($rec)&&$rec['cover']!=''){?>
                            <img src="../upload/<?php echo $rec['cover'];?>" />
                            <?php }?>
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
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*內容樣式：</th>
                        <td width="80%" valign="top" align="left">
                            <input type="radio" id="contenttype1" name="contenttype" value="1"<?php echo empty($rec)||$rec['contenttype']==1?' checked':'';?> />
                            <label for="contenttype1">內文模式</label>
                            <input type="radio" id="contenttype2" name="contenttype" value="2"<?php echo !empty($rec)&&$rec['contenttype']!=1?' checked':'';?> />
                            <label for="contenttype2">外連網址</label>
                        </td>
                    </tr>
                    <tr id="cType1">
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">內文模式：</th>
                        <td width="80%" valign="top" align="left">
                            <input type="button" id="add" value="新增段落" />
                        </td>
                    </tr>
                    <tr id="cType2">
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">外連網址：</th>
                        <td width="80%" valign="top" align="left">
                            <input type="text" id="url" name="url" value="<?php echo !empty($rec)?$rec['url']:'';?>" style="width:99%;" />
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
                            <input type="hidden" name="cid[]" value="'+(cont?cont.id:'')+'" />\
                            <input type="button" class="upBtn" value="上移" />\
                            <input type="button" class="downBtn" value="下移" />\
                            <input type="button" class="delBtn" value="刪除" />\
                        </td>\
                    </tr>\
                    <tr>\
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">內容：</th>\
                        <td width="80%" valign="top" align="left">\
                            <textarea name="content[]" rows="5" style="width:99%;">'+(cont?cont.content:'')+'</textarea>\
                        </td>\
                    </tr>\
                    <tr>\
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">顯示樣式：</th>\
                        <td width="80%" valign="top" align="left">\
                            <select class="media" name="media[]">\
                                <option value="1"'+(!cont||cont.media==1?' selected':'')+'>圖片</option>\
                                <option value="2"'+(cont&&cont.media!=1?' selected':'')+'>youtube影片</option>\
                            </select>\
                        </td>\
                    </tr>\
                    <tr class="img">\
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">圖片：</th>\
                        <td width="80%" valign="top" align="left">\
                            <input type="hidden" name="o_img[]" value="'+(cont?cont.img:'')+'" />\
                            <input type="file" name="img[]" />(500*250)\
                            '+(cont&&cont.img?'<img src="../upload/'+cont.img+'" />':'')+'\
                        </td>\
                    </tr>\
                    <tr class="img">\
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">圖片說明：</th>\
                        <td width="80%" valign="top" align="left">\
                            <input type="text" name="img_desc[]" style="width:99%;" value="'+(cont?cont.img_desc:'')+'" />\
                        </td>\
                    </tr>\
                    <tr class="ytid">\
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">Youtube ID：</th>\
                        <td width="80%" valign="top" align="left">\
                            <input type="text" name="ytid[]" value="'+(cont?cont.ytid:'')+'" />\
                        </td>\
                    </tr>\
                </table>');
                $('#add').before($cont);
                $cont.find('.upBtn').click(function(){ contSwitch($cont,$cont.prev('table')); });
                $cont.find('.downBtn').click(function(){ contSwitch($cont.next('table'),$cont); });
                $cont.find('.delBtn').click(function(){ contDel($cont); });
                $cont.find('.media').change(function(){ mediaChange($cont); }).change();
            }
            
            function contSwitch($cont1,$cont2){
                if(!$cont1||!$cont2) return;
                $cont1.after($cont2);
            }
            
            function contDel($cont){
                if(!confirm('確認刪除?')) return;
                $cont.remove();
            }
            
            function mediaChange($cont){
                $cont.find('.img, .ytid').css('display','none');
                switch($cont.find('.media').val()){
                    case '1':{ $cont.find('.img').css('display','table-row'); break; }
                    case '2':{ $cont.find('.ytid').css('display','table-row'); break; }
                }
            }
            
            $('input[name=contenttype]').change(function(){
                $('#cType1, #cType2').css('display','none');
                switch($('input[name=contenttype]:checked').val()){
                    case '1':{ $('#cType1').css('display','table-row'); break; }
                    case '2':{ $('#cType2').css('display','table-row'); break; }
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
            
            <?php if(!empty($rec)&&$rec['contenttype']==1){?>
            var cont = JSON.parse('<?php echo json_encode($rec['cont']);?>');
            $.each(cont,function(i,v){ addCont(v); });
            <?php }?>
        })();
        </script>
    </body>
</html>