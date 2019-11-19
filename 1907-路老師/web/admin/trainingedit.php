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
    array('name'=>'編輯培訓課程')
);

$id = isset($_GET['id'])?FUNCS::inputFilter('id','GET',1):0;
$result = trainingList(array('id'=>$id),1);
$rec = !empty($result)?$result[0]:array();

$city = cityList();
$area = areaList();
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
                <form enctype="multipart/form-data" action="ajax/trainingedit.php" method="post">
                <input type="hidden" name="etype" id="etype" value="edit" />
                <input type="hidden" name="id" id="id" value="<?php echo !empty($rec)?$rec['id']:'';?>" />
                <table width="100%" cellspacing="1" cellpadding="5" border="0" align="center" class="dataInsertTable">
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*年度：</th>
                        <td width="80%" valign="top" align="left">
                            <input class="ness" data-ness="年度" type="text" id="year" name="year" value="<?php echo !empty($rec)?$rec['year']:'';?>" style="width:99%;" />
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*類別：</th>
                        <td width="80%" valign="top" align="left">
                            <select name="type" class="ness" data-ness="類別">
                                <option value="1"<?php echo empty($rec)||$rec['type']==1?' selected':'';?>>初訓</option>
                                <option value="2"<?php echo !empty($rec)&&$rec['type']==2?' selected':'';?>>回訓</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*場次：</th>
                        <td width="80%" valign="top" align="left">
                            <input class="ness" data-ness="場次" type="text" id="title" name="title" value="<?php echo !empty($rec)?$rec['title']:'';?>" style="width:99%;" />
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*培訓地點：</th>
                        <td width="80%" valign="top" align="left">
                            <input class="ness" data-ness="培訓地點" type="text" name="location" value="<?php echo !empty($rec)?$rec['location']:'';?>" style="width:99%;" />
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*培訓地址：</th>
                        <td width="80%" valign="top" align="left">
                            <select name="city" class="ness" data-ness="培訓縣市">
                                <?php foreach($city as $k=>$d){?>
                                <option value="<?php echo $d['name'];?>"<?php echo !empty($rec)&&$rec['city']==$d['name']?' selected':'';?>><?php echo $d['name'];?></option>
                                <?php }?>
                            </select>
                            <select name="area" class="ness" data-ness="培訓地區"></select>
                            <input class="ness" data-ness="培訓地址" type="text" id="address" name="address" value="<?php echo !empty($rec)?$rec['address']:'';?>" style="width:600px;max-width:99%;" />
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*課程簡介：</th>
                        <td width="80%" valign="top" align="left">
                            <textarea id="descript" class="ness" data-ness="課程簡介" name="descript" rows="5" style="width:99%;"><?php echo !empty($rec)?$rec['descript']:'';?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*開課日期：</th>
                        <td width="80%" valign="top" align="left">
                            <input type="text" id="sdate" class="date ness" data-ness="開課日期" name="sdate" value="<?php echo !empty($rec)?$rec['sdate']:'';?>" />
                            ~
                            <input type="text" id="edate" class="date ness" data-ness="開課日期" name="edate" value="<?php echo !empty($rec)?$rec['edate']:'';?>" />
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*上課時間：</th>
                        <td width="80%" valign="top" align="left">
                            <input type="text" id="stime" class="time ness" data-ness="上課時間" name="stime" value="<?php echo !empty($rec)?$rec['stime']:'';?>" />
                            ~
                            <input type="text" id="etime" class="time ness" data-ness="上課時間" name="etime" value="<?php echo !empty($rec)?$rec['etime']:'';?>" />
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
            var city = {};
            <?php foreach($city as $k=>$d){?>
            city['<?php echo $d['name'];?>'] = '<?php echo $d['name'];?>';
            <?php }?>
            var area = {};
            <?php foreach($area as $k=>$d){?>
            area['<?php echo $d['cityname'];?>'] = area['<?php echo $d['cityname'];?>']||{};
            area['<?php echo $d['cityname'];?>']['<?php echo $d['name'];?>'] = '<?php echo $d['name'];?>';
            <?php }?>
            
            $('select[name=city]').change(function(){
                $('select[name=area]').html('');
                if(!area[$(this).val()]) return;
                $.each(area[$(this).val()],function(i,v){
                    $('select[name=area]').append('<option value="'+i+'">'+v+'</option>');
                });
            }).change();
            
            <?php if(!empty($rec)){?>
            $('select[name=area]').val('<?php echo $rec['area'];?>');
            
            <?php }?>
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
            
            $('.time').datetimepicker({
                lang: 'ch',
                format: 'H:i',
                step: 10,
                datepicker: false
            });
        })();
        </script>
    </body>
</html>