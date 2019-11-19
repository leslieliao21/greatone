<?php 
require_once 'php.lib/config.php';
require_once 'php.lib/main.php';
require_once 'php.lib/mysqli_class.php';
$DB = new DB_CONN();
$memberLogin = memberLoginChk();
if(!$memberLogin['status']){
    header('Location:signin.php');
    exit;
}
$member = $_SESSION[WEBX.'Mem'];
$result = teacherList(array('id'=>$member['id']),1);
$info = !empty($result)?$result[0]:array();
if(empty($info)){
    echo '<script>alert("not found");history.back();</script>';
    exit;
}

$info['phone'] = getPhone($info['phone']);
$info['language'] = $info['language']?explode(',',$info['language']):array();
$info['transportation'] = $info['transportation']?explode(',',$info['transportation']):array();

$city = cityList();
$area = areaList();
?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
    <!-- Basic Data -->
    <meta charset="UTF-8">
    <title>路老師培訓網 | 個人資料修改</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="expires" content="0">
    <meta http-equiv="cache-control" content="no-cache">
    <meta name="format-detection" content="telephone=no">
    <!-- <link rel="icon" type="image/ico" href="" /> -->

    <!-- Meta Data -->
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="og:title" content="">
    <meta name="og:description" content="">
    <meta name="og:type" content="website">
    <!-- <meta name="og:image" content="正式網址/images/1200x630.jpg"> -->

    <!-- CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/main.css" />

    <!--[if IE]>
    <script type="text/javascript" src="js/html5shiv.js"></script>
  <![endif]-->

</head>

<body id="sign-page" class="signupInfoPage" data-menu="0">
    <!--Loading-->
    <div id="loading">
        <div class="loader">
            <div class="spinner">

            </div>
        </div>
    </div>

    <header class="page-header"></header>

    <main class="main-container">

        <div class="inside bgWhite pdb-40">
            <h2 class="pageHead">‑ 路老師專區 ‑</h2>

            <div class="bodyCont">

                <ol class="breadcrumb">
                    <li><a href="index.php">首頁</a></li>
                    <li><a href="member.php">路老師專區</a></li>
                    <li class="active">個人資料</li>
                </ol>
                
                <div class="signout">
                    <div class="showDinlineblock">
                        <label for="memberSelector"><?php echo $member['name'];?> 老師</label>
                        <select name="" id="memberSelector" class="form-control w200">
                            <option value="member">路老師專區</option>
                            <?php if(in_array($member['qualify'],array(1,2))){?>
                            <option value="member_affairs">個人宣講歷程</option>
                            <option value="member_affairs_record">宣講歷程登錄</option>
                            <option value="member_download">教案下載</option>
                            <?php }?>
                            <option value="member_application">培訓報名</option>
                            <option value="member_info" selected>個人資料</option>
                        </select>
                    </div>

                    <button type="button" class="btn btn-submit btnInline" onclick="location.href='ajax/signout.php'">登出</button>
                </div>

                <div class="pageCont">
                    <div class="pageBodyTitle">
                        <h4><img src="images/icon/icon_title_signin.png" alt="">
                            ‑ 個人資料修改 ‑</h4>
                    </div>

                    <p>請確認以下個人資料是否正確</p>

                    <form id="infoForm" action="ajax/info.php" method="post" class="form-horizontal">
                        <div class="form-group">
                            <label for="signupName" class="col-sm-3 control-label required labelIcon"
                                style="background-image: url('images/icon/icon_signup_info01.png')">姓名</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="signupName" name="name" value="<?php echo $info['name'];?>" placeholder="請留下您的真實姓名">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label required labelIcon"
                                style="background-image: url('images/icon/icon_signup_info02.png')">性別</label>
                            <div class="col-sm-9">
                                <div class="text-left form-inline radioCont">
                                    <label class="radio-inline">
                                        <input type="radio" name="gender" id="genderRadio1" value="1"<?php echo $info['gender']==1?' checked':'';?>>
                                        <span class="checkmark"></span> 男
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="gender" id="genderRadio2" value="2"<?php echo $info['gender']==2?' checked':'';?>>
                                        <span class="checkmark"></span> 女
                                    </label>
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="signupBirth" class="col-sm-3 control-label required labelIcon"
                                style="background-image: url('images/icon/icon_signup_info03.png')">出生日期</label>
                            <div class="col-sm-3">
                                <select name="year" class="form-control">
                                    <option value="">年</option>
                                    <?php for($i=mingoDate(date('Y-m-d'),'y');$i>1;$i--){?>
                                    <option value="<?php echo $i+1911;?>"<?php echo mingoDate($info['birthday'],'y')==$i?' selected':'';?>><?php echo $i;?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <select name="month" class="form-control">
                                    <option value="">月</option>
                                    <?php for($i=1;$i<=12;$i++){?>
                                    <option value="<?php echo $i;?>"<?php echo date('n',strtotime($info['birthday']))==$i?' selected':'';?>><?php echo $i;?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <select name="date" class="form-control">
                                    <option value="">日</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="signupArea" class="col-sm-3 control-label required labelIcon"
                                style="background-image: url('images/icon/icon_signup_info04.png')">居住地區</label>
                            <div class="col-sm-4">
                                <select name="city" class="form-control">
                                    <option value="">縣市</option>
                                    <?php foreach($city as $k=>$d){?>
                                    <option value="<?php echo $d['name'];?>"<?php echo $info['city']==$d['name']?' selected':'';?>><?php echo $d['name'];?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="col-sm-5">
                                <select name="area" class="form-control">
                                    <option value="">鄉鎮區域</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="signupEmail" class="col-sm-3 control-label labelIcon"
                                style="background-image: url('images/icon/icon_signup_info05.png')">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="signupEmail" name="email" value="<?php echo $info['email'];?>" placeholder="請填寫正確E-mail信箱">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label labelIcon"
                                style="background-image: url('images/icon/icon_signup_info06.png')">市話</label>
                            <div class="col-xs-3 col-sm-2 pdr-5">
                                <input type="tel" class="form-control" id="signupTel1" name="code" value="<?php echo $info['phone'][0];?>" placeholder="區碼">
                            </div>
                            <div class="col-xs-9 col-sm-7">
                                <input type="tel" class="form-control" id="signupTel2" name="phone" value="<?php echo $info['phone'][1];?>" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label required labelIcon"
                                style="background-image: url('images/icon/icon_signup_info07.png')">Line ID</label>
                            <div class="col-sm-9">
                                <div class="text-left form-inline radioCont">
                                    <label class="radio-inline">
                                        <input type="radio" name="lineOption" id="lineRadio1" value="0"<?php echo !$info['lineid']?' checked':'';?>>
                                        <span class="checkmark"></span>無
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="lineOption" id="lineRadio2" value="1"<?php echo $info['lineid']?' checked':'';?>>
                                        <span class="checkmark"></span>有
                                    </label>
                                    <input type="text" class="form-control other-input mgb-0" id="" name="lineid" value="<?php echo $info['lineid'];?>" placeholder="請填寫Line ID">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label required labelIcon"
                                style="background-image: url('images/icon/icon_signup_info08.png')">精通語言</label>
                            <div class="col-sm-9">
                                <div class="text-left form-inline checkboxCont">
                                    <?php
                                    for($i=1;$i<count($LANGUAGE);$i++){
                                        $ind = -1;
                                        foreach($info['language'] as $k=>$d)
                                            $ind = $d==$LANGUAGE[$i]?$k:$ind;
                                    ?>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" class="langOption" name="langOption[]" id="langCheckbox<?php echo $i;?>" value="<?php echo $LANGUAGE[$i];?>"<?php echo $ind>=0?' checked':'';?>>
                                        <span class="checkmark"></span><?php echo $LANGUAGE[$i];?>
                                    </label>
                                    <?php
                                        if($ind>=0)
                                            unset($info['language'][$ind]);
                                    }
                                    ?>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" class="langOption" name="langOption[]" id="Checkbox<?php echo $i+1;?>" value="其它"<?php echo !empty($info['language'])?' checked':'';?>>
                                        <span class="checkmark"></span>其它
                                    </label>
                                    <input type="text" class="form-control other-input" id="" name="lang_else" value="<?php echo join(',',$info['language']);?>" placeholder="請填寫">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mgt-n10">
                            <label for="signupJob" class="col-sm-3 control-label required labelIcon"
                                style="background-image: url('images/icon/icon_signup_info09.png')">職業</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="career">
                                    <option value="">請選擇</option>
                                    <?php for($i=1;$i<count($CAREER);$i++){?>
                                    <option value="<?php echo $CAREER[$i];?>"<?php echo $info['career']==$CAREER[$i]?' selected':'';?>><?php echo $CAREER[$i];?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label required labelIcon"
                                style="background-image: url('images/icon/icon_signup_info10.png')">經常使用之交通工具</label>
                            <div class="col-sm-9">
                                <div class="text-left form-inline checkboxCont">
                                    <?php 
                                    for($i=1;$i<count($TRANSPORTATION);$i++){
                                        $ind = -1;
                                        foreach($info['transportation'] as $k=>$d)
                                            $ind = $d==$TRANSPORTATION[$i]?$k:$ind;
                                    ?>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" class="transportOption" name="transportOption[]" id="Checkbox<?php echo $i;?>" value="<?php echo $TRANSPORTATION[$i];?>"<?php echo $ind>=0?' checked':'';?>>
                                        <span class="checkmark"></span><?php echo $TRANSPORTATION[$i];?>
                                    </label>
                                    <?php 
                                        if($ind>=0)
                                            unset($info['transportation'][$ind]);
                                    }
                                    ?>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" class="transportOption" name="transportOption[]" id="Checkbox<?php echo $i+1;?>" value="其它"<?php echo !empty($info['transportation'])?' checked':'';?>>
                                        <span class="checkmark"></span>其它
                                    </label>
                                    <input type="text" class="form-control other-input" id="" name="trans_else" value="<?php echo join(',',$info['transportation']);?>" placeholder="請填寫">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label required labelIcon"
                                style="background-image: url('images/icon/icon_signup_info11.png')">持有駕照</label>
                            <div class="col-sm-9">
                                <div class="text-left form-inline checkboxCont">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="license_bike" id="Checkbox1" value="1"<?php echo $info['license_bike']?' checked':'';?>>
                                        <span class="checkmark"></span>機車
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="license_car" id="Checkbox2" value="1"<?php echo $info['license_car']?' checked':'';?>>
                                        <span class="checkmark"></span>汽車
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mgt-n10">
                            <label for="signupWork" class="col-sm-3 control-label required labelIcon"
                                style="background-image: url('images/icon/icon_signup_info12.png')">服務單位</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="signupWork" name="service" value="<?php echo $info['service'];?>" placeholder="請填答現職或退休前服務單位">
                            </div>
                        </div>


                        <button type="button" class="btn btn-submit submit">下一步</button>
                    </form>

                    <span class="cRed"><i class="glyphicon glyphicon-info-sign"></i> *為必填欄位</span>

                </div>
            </div>
        </div>

    </main>

    <footer class="page-footer"></footer>


    <!-- Scripts -->
    <script src="js/vendor.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/kits.min.js"></script>
    <!-- main js -->
    <script src="js/main.min.js"></script>
    <script src="js.lib/parameters.js"></script>
    <script>
    $(document).ready(function(){
        $('#memberSelector').change(function(){
            location.href = $(this).val()+'.php';
        });
        
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
            $('select[name=area]').html('<option value="">鄉鎮區域</option>');
            if(!area[$(this).val()]) return;
            $.each(area[$(this).val()],function(i,v){
                $('select[name=area]').append('<option value="'+i+'">'+v+'</option>');
            });
        }).change();
        $('select[name=area]').val('<?php echo $info['area'];?>');
        
        $('select[name=year], select[name=month]').change(function(){
            var y = parseInt($('select[name=year]').val());
            var m = '0'+parseInt($('select[name=month]').val());
            $('select[name=date]').html('<option value="">日</option>');
            if((new Date(y+'-'+('0'+m).substr(-2)))=='Invalid Date') return;
            for(var d=1;(new Date(y+'-'+('0'+m).substr(-2)+'-'+('0'+d).substr(-2))).getMonth()<m;d++)
                $('select[name=date]').append('<option value="'+d+'">'+d+'</option>');
        }).change();
        $('select[name=date]').val('<?php echo date('j',strtotime($info['birthday']));?>');
        
        $('.submit').click(function(){
            var name = $('#signupName').val();
            if(!name)
                return alert('請輸入姓名');
            
            var gender = $('input[name=gender]:checked').val();
            if(!gender)
                return alert('請選擇性別');
            
            var y = parseInt($('select[name=year]').val());
            var m = parseInt($('select[name=month]').val());
            var d = parseInt($('select[name=date]').val());
            if((new Date(y+'-'+('0'+m).substr(-2)+'-'+('0'+d).substr(-2)))=='Invalid Date')
                return alert('請選擇出生日期');
            
            var city = $('select[name=city]').val();
            var area = $('select[name=area]').val();
            if(!city||!area)
                return alert('請選擇居住地區');
            
            var email = $('input[name=email]').val();
            if(email && !(email).match(emailReg))
                return alert('請確認Email格式正確');
            
            var code = $('input[name=code]').val();
            var phone = $('input[name=phone]').val();
            if((code||phone) && !(code+'-'+phone).match(phoneReg))
                return alert('請確認市話格式正確');
            
            var lineOption = $('input[name=lineOption]:checked').length;
            var lineid = $('input[name=lineid]').val();
            if(!lineOption)
                return alert('請選擇Line ID');
            if(parseInt($('input[name=lineOption]:checked').val())==1 && !lineid)
                return alert('請填寫Line ID');
            
            var lang = $('input.langOption:checked').length;
            var langElse = $('input[name=lang_else]').val();
            if(!lang)
                return alert('請選擇精通語言');
            if($('input.langOption[value=其它]').prop('checked')&&!langElse)
                return alert('請填寫精通語言');
            
            var career = $('select[name=career]').val();
            if(!career)
                return alert('請選擇職業');
            
            var trans = $('input.transportOption:checked').length;
            var transElse = $('input[name=trans_else]').val();
            if(!trans)
                return alert('請選擇經常使用之交通工具');
            if($('input.transportOption[value=其它]').prop('checked')&&!transElse)
                return alert('請填寫經常使用之交通工具');
            
            var license_bike = $('input[name=license_bike]').prop('checked');
            var license_car = $('input[name=license_car]').prop('checked');
            if(!license_bike&&!license_car)
                return alert('請選擇持有駕照');
            
            var service = $('input[name=service]').val();
            if(!service)
                return alert('請選擇服務單位');
            
            $('#infoForm').submit();
        });
    });
    </script>
</body>

</html>