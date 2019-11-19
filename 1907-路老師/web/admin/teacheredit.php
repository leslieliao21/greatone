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
    array('name'=>'編輯路老師')
);

$id = isset($_GET['id'])?FUNCS::inputFilter('id','GET',1):0;
$result = teacherList(array('id'=>$id),1);
$rec = !empty($result)?$result[0]:array();
if(!empty($rec)){
    $rec['phone'] = getPhone($rec['phone']);
    $rec['language'] = $rec['language']?explode(',',$rec['language']):array();
    $rec['transportation'] = $rec['transportation']?explode(',',$rec['transportation']):array();
}

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
                <form enctype="multipart/form-data" action="ajax/teacheredit.php" method="post">
                <input type="hidden" name="etype" id="etype" value="edit" />
                <input type="hidden" name="id" id="id" value="<?php echo !empty($rec)?$rec['id']:'';?>" />
                <table width="100%" cellspacing="1" cellpadding="5" border="0" align="center" class="dataInsertTable">
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*帳號(手機號碼)：</th>
                        <td width="80%" valign="top" align="left">
                            <input class="ness" data-ness="帳號" type="text" id="account" name="account" value="<?php echo !empty($rec)?$rec['account']:'';?>" placeholder="例：09xxxxxxxx" style="width:99%;" />
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*密碼：</th>
                        <td width="80%" valign="top" align="left">
                            <input type="hidden" name="password" />
                            <input class="ness" data-ness="密碼" type="password" id="psw" />
                        </td>
                    </tr>
					<tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*確認密碼：</th>
                        <td width="80%" valign="top" align="left">
                            <input class="ness" data-ness="確認密碼" type="password" id="repsw" />
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*姓名：</th>
                        <td width="80%" valign="top" align="left">
                            <input class="ness" data-ness="姓名" type="text" id="name" name="name" value="<?php echo !empty($rec)?$rec['name']:'';?>" style="width:99%;" />
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*性別：</th>
                        <td width="80%" valign="top" align="left">
                            <select name="gender" class="ness" data-ness="性別">
                                <option value="1"<?php echo empty($rec)||$rec['gender']==1?' selected':'';?>>男</option>
                                <option value="2"<?php echo !empty($rec)&&$rec['gender']!=1?' selected':'';?>>女</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*生日：</th>
                        <td width="80%" valign="top" align="left">
                            <input type="text" id="birthday" class="date ness" data-ness="生日" name="birthday" value="<?php echo !empty($rec)?$rec['birthday']:'';?>" />
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*居住地：</th>
                        <td width="80%" valign="top" align="left">
                            <select name="city" class="ness" data-ness="縣市">
                                <?php foreach($city as $k=>$d){?>
                                <option value="<?php echo $d['name'];?>"<?php echo !empty($rec)&&$rec['city']==$d['name']?' selected':'';?>><?php echo $d['name'];?></option>
                                <?php }?>
                            </select>
                            <select name="area" class="ness" data-ness="地區"></select>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">Email：</th>
                        <td width="80%" valign="top" align="left">
                            <input type="text" id="email" name="email" value="<?php echo !empty($rec)?$rec['email']:'';?>" style="width:99%;" />
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">Line ID：</th>
                        <td width="80%" valign="top" align="left">
                            <input type="text" id="lineid" name="lineid" value="<?php echo !empty($rec)?$rec['lineid']:'';?>" style="width:99%;" />
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">市話：</th>
                        <td width="80%" valign="top" align="left">
                            <input type="text" id="code" name="code" value="<?php echo !empty($rec)?$rec['phone'][0]:'';?>" placeholder="區碼" />
                            <input type="text" id="phone" name="phone" value="<?php echo !empty($rec)?$rec['phone'][1]:'';?>" placeholder="例如：2222-2222" />
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">精通語言(可複選)：</th>
                        <td width="80%" valign="top" align="left">
                            <?php 
                            for($i=1;$i<count($LANGUAGE);$i++){
                                $ind = -1;
                                if(!empty($rec)){
                                    foreach($rec['language'] as $k=>$d)
                                        $ind = $d==$LANGUAGE[$i]?$k:$ind;
                                }
                            ?>
                            
                            <input type="checkbox" id="lang<?php echo $i;?>" name="language[]" value="<?php echo $LANGUAGE[$i];?>"<?php echo $ind>=0?' checked':'';?>><label for="lang<?php echo $i;?>"><?php echo $LANGUAGE[$i];?></label>
                            <?php 
                                if($ind>=0)
                                    unset($rec['language'][$ind]);
                            }
                            ?>
                            <input type="checkbox" id="lang7" name="language[]" value="其它"<?php echo !empty($rec)&&!empty($rec['language'])?' checked':'';?>><label for="lang7">其它</label>
                            <input type="text" name="lang_else" value="<?php echo !empty($rec)?join(',',$rec['language']):'';?>">
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">職業：</th>
                        <td width="80%" valign="top" align="left">
                            <select name="career">
                                <option value="">請選擇</option>
                                <?php for($i=1;$i<count($CAREER);$i++){?>
                                <option value="<?php echo $CAREER[$i];?>"<?php echo !empty($rec)&&$rec['career']==$CAREER[$i]?' selected':'';?>><?php echo $CAREER[$i];?></option>
                                <?php }?>
                                <option value="其它"<?php echo !empty($rec)&&!in_array($rec['career'],$CAREER)?' selected':'';?>>其它</option>
                            </select>
                            <input type="text" name="career_else" value="<?php echo !empty($rec)&&!in_array($rec['career'],$CAREER)?$rec['career']:'';?>">
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">經常使用的交通工具(可複選)：</th>
                        <td width="80%" valign="top" align="left">
                            <?php 
                            for($i=1;$i<count($TRANSPORTATION);$i++){
                                $ind = -1;
                                if(!empty($rec)){
                                    foreach($rec['transportation'] as $k=>$d)
                                        $ind = $d==$TRANSPORTATION[$i]?$k:$ind;
                                }
                            ?>
                            
                            <input type="checkbox" id="trans<?php echo $i;?>" name="transportation[]" value="<?php echo $TRANSPORTATION[$i];?>"<?php echo $ind>=0?' checked':'';?>><label for="trans<?php echo $i;?>"><?php echo $TRANSPORTATION[$i];?></label>
                            <?php 
                                if($ind>=0)
                                    unset($rec['transportation'][$ind]);
                            }
                            ?>
                            <input type="checkbox" id="trans6" name="transportation[]" value="其它"<?php echo !empty($rec)&&!empty($rec['transportation'])?' checked':'';?>><label for="trans6">其它</label>
                            <input type="text" name="trans_else" value="<?php echo !empty($rec)?join(',',$rec['transportation']):'';?>">
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">服務單位：</th>
                        <td width="80%" valign="top" align="left">
                            <input type="text" id="service" name="service" value="<?php echo !empty($rec)?$rec['service']:'';?>" style="width:99%;" />
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">持有駕照：</th>
                        <td width="80%" valign="top" align="left">
                            <input type="checkbox" id="license_bike" name="license_bike" value="1"<?php echo !empty($rec)&&$rec['license_bike']?' checked':'';?> />
                            <label for="license_bike">機車駕照</label>
                            <input type="checkbox" id="license_car" name="license_car" value="1"<?php echo !empty($rec)&&$rec['license_car']?' checked':'';?> />
                            <label for="license_car">汽車駕照</label>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*路老師狀態：</th>
                        <td width="80%" valign="top" align="left">
                            <select name="qualify" class="ness" data-ness="路老師狀態">
                                <option value="1"<?php echo empty($rec)||$rec['qualify']==1?' selected':'';?>>合格</option>
                                <option value="2"<?php echo !empty($rec)&&$rec['qualify']==2?' selected':'';?>>實習</option>
                                <option value="3"<?php echo !empty($rec)&&$rec['qualify']==3?' selected':'';?>>一般</option>
                            </select>
                            <input type="text" name="year" class="ness_dep" data-dep="qualify,1" data-ness="合格年度" placeholder="合格年度" value="<?php echo !empty($rec)?$rec['year']:'';?>">
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*帳號狀態：</th>
                        <td width="80%" valign="top" align="left">
                            <select name="status" class="ness" data-ness="帳號狀態">
                                <option value="2"<?php echo empty($rec)||$rec['status']==2?' selected':'';?>>未登入</option>
                                <option value="1"<?php echo !empty($rec)&&$rec['status']==1?' selected':'';?>>啟用</option>
                                <option value="0"<?php echo !empty($rec)&&$rec['status']==0?' selected':'';?>>停用</option>
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
            $('#psw, #repsw').removeClass('ness');
            
            <?php }?>
            $('#psw').change(function(){
                var psw = $(this).val();
                var hashObj = new jsSHA('SHA-1','TEXT');
                hashObj.update(psw);
                $('input[name=password]').val(hashObj.getHash('HEX'));
            });
            
            $('#lang7').change(function(){
                if($(this).prop('checked'))
                    $('input[name=lang_else]').css('display','inline-block');
                else
                    $('input[name=lang_else]').css('display','none');
            }).change();
            
            $('select[name=career]').change(function(){
                if($(this).val()=='其它')
                    $('input[name=career_else]').css('display','inline-block');
                else
                    $('input[name=career_else]').css('display','none');
            }).change();
            
            $('#trans6').change(function(){
                if($(this).prop('checked'))
                    $('input[name=trans_else]').css('display','inline-block');
                else
                    $('input[name=trans_else]').css('display','none');
            }).change();
            
            $('select[name=qualify]').change(function(){
                if(parseInt($(this).val())==1)
                    $('input[name=year]').css('display','inline-block');
                else
                    $('input[name=year]').css('display','none');
            }).change();
            
            $('#save').click(function(){
				if(!chkNessInput($('form'))) return;
                var account = $('input[name=account]').val();
                if(!account.match(mobileReg))
                    return alert('請確認帳號(手機號碼)格式正確');
                if($('#psw').val()!=$('#repsw').val())
                    return alert('請確認密碼輸入相同');
                var email = $('input[name=email]').val();
                if(email&&!email.match(emailReg))
                    return alert('請確認Email格式正確');
                var code = $('input[name=code]').val();
                var phone = $('input[name=phone]').val();
                if(phone&&!(code+'-'+phone).match(phoneReg))
                    return alert('請確認市話格式正確');
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