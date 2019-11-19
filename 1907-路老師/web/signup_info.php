<?php
require_once 'php.lib/config.php';
require_once 'php.lib/main.php';
require_once 'php.lib/mysqli_class.php';
$DB = new DB_CONN();
if(!isset($_POST['account'])){
    header('Location:signup.php');
    exit;
}
$city = cityList();
$area = areaList();
?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
    <!-- Basic Data -->
    <meta charset="UTF-8">
    <title>路老師培訓網 | 實習路老師註冊</title>
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
                    <li class="active">路老師註冊</li>
                </ol>

                <div class="pageCont">
                    <div class="pageBodyTitle">
                        <h4><img src="images/icon/icon_title_signin.png" alt="">
                            ‑ 路老師註冊 ‑</h4>
                    </div>

                    <p>請填寫以下資料註冊路老師</p>

                    <form id="signupForm" action="ajax/signup.php" method="post" class="form-horizontal">
                        <input type="hidden" name="account" value="<?php echo $_POST['account'];?>">
                        <input type="hidden" name="psw" value="<?php echo $_POST['psw'];?>">
                        <div class="form-group">
                            <label for="signupName" class="col-sm-3 control-label required labelIcon"
                                style="background-image: url('images/icon/icon_signup_info01.png')">姓名</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="signupName" name="name" placeholder="請留下您的真實姓名">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label required labelIcon"
                                style="background-image: url('images/icon/icon_signup_info02.png')">性別</label>
                            <div class="col-sm-9">
                                <div class="text-left form-inline radioCont">
                                    <label class="radio-inline">
                                        <input type="radio" name="gender" id="genderRadio1" value="1">
                                        <span class="checkmark"></span> 男
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="gender" id="genderRadio2" value="2">
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
                                    <?php for($i=mingoDate(date('Y-m-d'),'y');$i>=1;$i--){?>
                                    <option value="<?php echo $i+1911;?>"><?php echo $i;?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <select name="month" class="form-control">
                                    <option value="">月</option>
                                    <?php for($i=1;$i<=12;$i++){?>
                                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
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
                                    <option value="<?php echo $d['name'];?>"><?php echo $d['name'];?></option>
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
                                <input type="email" class="form-control" id="signupEmail" name="email" placeholder="請填寫正確E-mail信箱">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label labelIcon"
                                style="background-image: url('images/icon/icon_signup_info06.png')">市話</label>
                            <div class="col-xs-3 col-sm-2 pdr-5">
                                <input type="tel" class="form-control" id="signupTel1" name="code" placeholder="區碼">
                            </div>
                            <div class="col-xs-9 col-sm-7">
                                <input type="tel" class="form-control" id="signupTel2" name="phone" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label required labelIcon"
                                style="background-image: url('images/icon/icon_signup_info07.png')">Line ID</label>
                            <div class="col-sm-9">
                                <div class="text-left form-inline radioCont">
                                    <label class="radio-inline">
                                        <input type="radio" name="lineOption" id="lineRadio1" value="0">
                                        <span class="checkmark"></span>無
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="lineOption" id="lineRadio2" value="1">
                                        <span class="checkmark"></span>有
                                    </label>
                                    <input type="text" class="form-control other-input mgb-0" id="" name="lineid" placeholder="請填寫Line ID">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label required labelIcon"
                                style="background-image: url('images/icon/icon_signup_info08.png')">精通語言</label>
                            <div class="col-sm-9">
                                <div class="text-left form-inline checkboxCont">
                                    <?php for($i=1;$i<count($LANGUAGE);$i++){?>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" class="langOption" name="langOption[]" id="langCheckbox<?php echo $i;?>" value="<?php echo $LANGUAGE[$i];?>">
                                        <span class="checkmark"></span><?php echo $LANGUAGE[$i];?>
                                    </label>
                                    <?php }?>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" class="langOption" name="langOption[]" id="Checkbox<?php echo $i+1;?>" value="其它">
                                        <span class="checkmark"></span>其它
                                    </label>
                                    <input type="text" class="form-control other-input" id="" name="lang_else" placeholder="請填寫">
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
                                    <option value="<?php echo $CAREER[$i];?>"><?php echo $CAREER[$i];?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label required labelIcon"
                                style="background-image: url('images/icon/icon_signup_info10.png')">經常使用之交通工具</label>
                            <div class="col-sm-9">
                                <div class="text-left form-inline checkboxCont">
                                    <?php for($i=1;$i<count($TRANSPORTATION);$i++){?>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" class="transportOption" name="transportOption[]" id="Checkbox<?php echo $i;?>" value="<?php echo $TRANSPORTATION[$i];?>">
                                        <span class="checkmark"></span><?php echo $TRANSPORTATION[$i];?>
                                    </label>
                                    <?php }?>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" class="transportOption" name="transportOption[]" id="Checkbox<?php echo $i+1;?>" value="其它">
                                        <span class="checkmark"></span>其它
                                    </label>
                                    <input type="text" class="form-control other-input" id="" name="trans_else" placeholder="請填寫">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label required labelIcon"
                                style="background-image: url('images/icon/icon_signup_info11.png')">持有駕照</label>
                            <div class="col-sm-9">
                                <div class="text-left form-inline checkboxCont">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="license_bike" id="Checkbox1" value="1">
                                        <span class="checkmark"></span>機車
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="license_car" id="Checkbox2" value="1">
                                        <span class="checkmark"></span>汽車
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mgt-n10">
                            <label for="signupWork" class="col-sm-3 control-label required labelIcon"
                                style="background-image: url('images/icon/icon_signup_info12.png')">服務單位</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="signupWork" name="service" placeholder="請填答現職或退休前服務單位">
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
        
        $('select[name=year], select[name=month]').change(function(){
            var y = parseInt($('select[name=year]').val());
            var m = parseInt($('select[name=month]').val());
            $('select[name=date]').html('<option value="">日</option>');
            if((new Date(y+'-'+('0'+m).substr(-2)))=='Invalid Date') return;
            for(var d=1;(new Date(y+'-'+('0'+m).substr(-2)+'-'+('0'+d).substr(-2))).getMonth()<m;d++)
                $('select[name=date]').append('<option value="'+d+'">'+d+'</option>');
        });
        
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
            
            $('#signupForm').submit();
        });
    });
    </script>
</body>

</html>