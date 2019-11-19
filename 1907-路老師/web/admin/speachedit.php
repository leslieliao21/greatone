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
    array('name'=>'審查宣講歷程')
);

$id = isset($_GET['id'])?FUNCS::inputFilter('id','GET',1):0;
$result = speachList(array('id'=>$id),1);
$rec = !empty($result)?$result[0]:array();

if(empty($rec)){
    echo '<script>alert("not found");history.back();</script>';
    exit;
}

$plan = array();
$result = planList(array(),0);
foreach($result as $k=>$d)
    $plan[$d['id']] = $d['title'];

$_plan = array();
$plans = explode(',',$rec['plan']);
foreach($plans as $k=>$d){
    if(isset($plan[$d]))
        $_plan[] = $plan[$d];
}

$city = array();
$result = cityList();
foreach($result as $k=>$d)
    $city[$d['name']] = $d['name'];

$area = array();
$result = areaList();
foreach($result as $k=>$d){
    $area[$d['cityname']] = isset($area[$d['cityname']])?$area[$d['cityname']]:array();
    $area[$d['cityname']][$d['name']] = $d['name'];
}

$pictures = json_decode($rec['pictures'],true);
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
                <form enctype="multipart/form-data" action="ajax/speachedit.php" method="post">
                <input type="hidden" name="etype" id="etype" value="edit" />
                <input type="hidden" name="id" id="id" value="<?php echo !empty($rec)?$rec['id']:'';?>" />
                <table width="100%" cellspacing="1" cellpadding="5" border="0" align="center" class="dataInsertTable">
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">路老師系統編號：</th>
                        <td width="80%" valign="top" align="left">
                            <?php echo !empty($rec)?$rec['tid']:'';?>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">路老師宣講時數(分鐘)：</th>
                        <td width="80%" valign="top" align="left">
                            <?php echo !empty($rec)?$rec['minutes']:'';?> (分鐘)
                        </td>
                    </tr>
					<tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">路老師姓名：</th>
                        <td width="80%" valign="top" align="left">
                            <?php echo !empty($rec)?$rec['name']:'';?>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">使用教案：</th>
                        <td width="80%" valign="top" align="left">
                            <?php echo join(',',$_plan);?>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">主題：</th>
                        <td width="80%" valign="top" align="left">
                            <?php echo !empty($rec)?$rec['title']:'';?>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">宣講日期：</th>
                        <td width="80%" valign="top" align="left">
                            <?php echo !empty($rec)?$rec['speachdate']:'';?>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">登錄日期：</th>
                        <td width="80%" valign="top" align="left">
                            <?php echo !empty($rec)?date('Y-m-d',strtotime($rec['createtime'])):'';?>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">宣講單位：</th>
                        <td width="80%" valign="top" align="left">
                            <?php echo !empty($rec)?$rec['audience']:'';?>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">宣講地區：</th>
                        <td width="80%" valign="top" align="left">
                            <?php echo !empty($rec)&&isset($city[$rec['city']])?$city[$rec['city']]:'';?>
                            /
                            <?php echo !empty($rec)&&isset($area[$rec['city']])&&isset($area[$rec['city']][$rec['area']])?$area[$rec['city']][$rec['area']]:'';?>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">參加人數：</th>
                        <td width="80%" valign="top" align="left">
                            <?php echo !empty($rec)?$rec['attends']:'';?>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">路老師回饋-優點：</th>
                        <td width="80%" valign="top" align="left">
                            <?php echo !empty($rec)?nl2br($rec['benefit']):'';?>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">路老師回饋-建議：</th>
                        <td width="80%" valign="top" align="left">
                            <?php echo !empty($rec)?nl2br($rec['feedback']):'';?>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">學習成效評估：</th>
                        <td width="80%" valign="top" align="left">
                            <?php echo !empty($rec)?nl2br($rec['evaluation']):'';?>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">宣講照片(路老師台上宣講)：</th>
                        <td width="80%" valign="top" align="left">
                            <?php echo !empty($pictures['teacher_desc'])?$pictures['teacher_desc']:'';?>
                            <?php echo !empty($pictures['teacher'])?'<img src="../upload/'.$pictures['teacher'].'">':'';?>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">宣講照片(路老師語學生團體合照)：</th>
                        <td width="80%" valign="top" align="left">
                            <?php echo !empty($pictures['group_desc'])?$pictures['group_desc']:'';?>
                            <?php echo !empty($pictures['group'])?'<img src="../upload/'.$pictures['group'].'">':'';?>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">宣講照片(教學過程實況1)：</th>
                        <td width="80%" valign="top" align="left">
                            <?php echo !empty($pictures['scene_desc'])&&!empty($pictures['scene_desc'][0])?$pictures['scene_desc'][0]:'';?>
                            <?php echo !empty($pictures['scene'])&&!empty($pictures['scene'][0])?'<img src="../upload/'.$pictures['scene'][0].'">':'';?>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">宣講照片(教學過程實況2)：</th>
                        <td width="80%" valign="top" align="left">
                            <?php echo !empty($pictures['scene_desc'])&&!empty($pictures['scene_desc'][1])?$pictures['scene_desc'][1]:'';?>
                            <?php echo !empty($pictures['scene'])&&!empty($pictures['scene'][1])?'<img src="../upload/'.$pictures['scene'][1].'">':'';?>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">宣講照片(教學過程實況3)：</th>
                        <td width="80%" valign="top" align="left">
                            <?php echo !empty($pictures['scene_desc'])&&!empty($pictures['scene_desc'][2])?$pictures['scene_desc'][2]:'';?>
                            <?php echo !empty($pictures['scene'])&&!empty($pictures['scene'][2])?'<img src="../upload/'.$pictures['scene'][2].'">':'';?>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">宣講照片(教學過程實況4)：</th>
                        <td width="80%" valign="top" align="left">
                            <?php echo !empty($pictures['scene_desc'])&&!empty($pictures['scene_desc'][3])?$pictures['scene_desc'][3]:'';?>
                            <?php echo !empty($pictures['scene'])&&!empty($pictures['scene'][3])?'<img src="../upload/'.$pictures['scene'][3].'">':'';?>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">宣講照片(教學過程實況5)：</th>
                        <td width="80%" valign="top" align="left">
                            <?php echo !empty($pictures['scene_desc'])&&!empty($pictures['scene_desc'][4])?$pictures['scene_desc'][4]:'';?>
                            <?php echo !empty($pictures['scene'])&&!empty($pictures['scene'][4])?'<img src="../upload/'.$pictures['scene'][4].'">':'';?>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">宣講照片(教學過程實況6)：</th>
                        <td width="80%" valign="top" align="left">
                            <?php echo !empty($pictures['scene_desc'])&&!empty($pictures['scene_desc'][5])?$pictures['scene_desc'][5]:'';?>
                            <?php echo !empty($pictures['scene'])&&!empty($pictures['scene'][5])?'<img src="../upload/'.$pictures['scene'][5].'">':'';?>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*審核狀態：</th>
                        <td width="80%" valign="top" align="left">
                            <select name="status" class="ness" data-ness="上架狀態">
                                <option value="0"<?php echo empty($rec)||$rec['status']==0?' selected':'';?>>待審核</option>
                                <option value="1"<?php echo !empty($rec)&&$rec['status']==1?' selected':'';?>>通過</option>
                                <option value="2"<?php echo !empty($rec)&&$rec['status']==2?' selected':'';?>>退件</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">審查說明：</th>
                        <td width="80%" valign="top" align="left">
                            <textarea name="recommend" rows="5" style="width:99%;"><?php echo !empty($rec)?$rec['recommend']:'';?></textarea>
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
        })();
        </script>
    </body>
</html>