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
$result = unitaccountList(array('id'=>$id),1);
$rec = !empty($result)?$result[0]:array();

$unit = array();
$recs = unitList(array());
foreach($recs as $k=>$d)
    $unit[$d['id']] = $d;

$subUnit = array();
$recs = subUnitList(array());
foreach($recs as $k=>$d){
    $subUnit[$d['uid']] = isset($subUnit[$d['uid']])?$subUnit[$d['uid']]:array();
    $subUnit[$d['uid']][$d['id']] = $d;
}
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
                <form enctype="multipart/form-data" action="ajax/unitaccountedit.php" method="post">
                <input type="hidden" name="etype" id="etype" value="edit" />
                <input type="hidden" name="id" id="id" value="<?php echo !empty($rec)?$rec['id']:'';?>" />
                <table width="100%" cellspacing="1" cellpadding="5" border="0" align="center" class="dataInsertTable">
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*所屬單位：</th>
                        <td width="80%" valign="top" align="left">
                            <select name="uid" class="ness" data-ness="所屬單位">
                                <?php foreach($unit as $k=>$d){?>
                                <option value="<?php echo $d['id'];?>"<?php echo !empty($rec)&&$rec['uid']==$d['id']?' selected':'';?>><?php echo $d['title'];?></option>
                                <?php }?>
                            </select>
                            <select name="suid"></select>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*帳號：</th>
                        <td width="80%" valign="top" align="left">
                            <input class="ness" data-ness="帳號" type="text" id="account" name="account" value="<?php echo !empty($rec)?$rec['account']:'';?>" style="width:99%;" placeholder="例：abc1234" />
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*密碼：</th>
                        <td width="80%" valign="top" align="left">
                            <input type="hidden" name="password" value="">
                            <input class="ness" data-ness="密碼" type="password" id="psw" value="" />
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*確認密碼：</th>
                        <td width="80%" valign="top" align="left">
                            <input class="ness" data-ness="確認密碼" type="password" id="repsw" value="" />
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*聯絡人：</th>
                        <td width="80%" valign="top" align="left">
                            <input class="ness" data-ness="聯絡人" type="text" id="name" name="name" value="<?php echo !empty($rec)?$rec['name']:'';?>" style="width:99%;" />
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*連絡電話：</th>
                        <td width="80%" valign="top" align="left">
                            <input class="ness" data-ness="連絡電話" type="text" id="phone" name="phone" value="<?php echo !empty($rec)?$rec['phone']:'';?>" style="width:99%;" />
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*帳號狀態：</th>
                        <td width="80%" valign="top" align="left">
                            <select name="status" class="ness" data-ness="帳號狀態">
                                <option value="1"<?php echo empty($rec)||$rec['status']==1?' selected':'';?>>啟用</option>
                                <option value="0"<?php echo !empty($rec)&&$rec['status']!=1?' selected':'';?>>停用</option>
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
        <script type="text/javascript" src="../js.lib/sha.js"></script>
        <script type="text/javascript" src="js/tpl.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
        <script type="text/javascript">
        (function(){
            var unit = JSON.parse('<?php echo json_encode($unit);?>');
            var subUnit = JSON.parse('<?php echo json_encode($subUnit);?>');
            
            $('select[name=uid]').change(function(){
                $('select[name=suid]').html('<option value="0">全部</option>');
                if(!subUnit[$(this).val()]) return;
                console.log(subUnit[$(this).val()]);
                $.each(subUnit[$(this).val()],function(i,v){
                    $('select[name=suid]').append('<option value="'+v.id+'">'+v.title+'</option>');
                });
            }).change();
            
            <?php if(!empty($rec)){?>
            $('select[name=suid]').val('<?php echo $rec['suid'];?>');
            $('#psw, #repsw').removeClass('ness');
            
            <?php }?>
            $('#psw').change(function(){
                var psw = $(this).val();
                var hashObj = new jsSHA('SHA-1','TEXT');
                hashObj.update(psw);
                $('input[name=password]').val(hashObj.getHash('HEX'));
            });
            
            $('#save').click(function(){
				if(!chkNessInput($('form'))) return;
                if($('#psw').val()!=$('#repsw').val())
                    return alert('請確認密碼輸入相同');
                var phone = $('input[name=phone]').val();
                if(!phone.match(mobileReg))
                    return alert('請確認電話格式正確');
                $('form').submit();
            });
            
            $('#cancel').click(function(){
                history.back();
            });
        })();
        </script>
    </body>
</html>