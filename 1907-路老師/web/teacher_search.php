<?php 
require_once 'php.lib/config.php';
require_once 'php.lib/main.php';
require_once 'php.lib/mysqli_class.php';
$DB = new DB_CONN();
$departLogin = departLoginChk();
if(!$departLogin['status']){
    header('Location:dept_signin.php');
    exit;
}
$member = $_SESSION[WEBX.'Dep'];

$search = array();
$result = teacherSearchList(array('status'=>1),0);
foreach($result as $k=>$d)
    $search[] = $d['id'];

$city = cityList();
$area = areaList();
?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
    <!-- Basic Data -->
    <meta charset="UTF-8">
    <title>路老師培訓網 | 路老師查詢</title>
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

<body id="sign-page" class="searchPage signupInfoPage" data-menu="1">
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
            <h2 class="pageHead">‑ 我要找路老師 ‑</h2>

            <div class="bodyCont">

                <ol class="breadcrumb">
                    <li><a href="index.php">首頁</a></li>
                    <li><a href="teacher_search.php">我要找路老師</a></li>
                    <li class="active">路老師查詢</li>
                </ol>
                
                <div class="signout">
                    <div class="showDinlineblock">
                        <label for="deptSelector"><?php echo $member['name'];?> 老師</label>
                        <select name="" id="deptSelector" class="form-control w200">
                            <option value="teacher_search" selected>路老師查詢</option>
                            <option value="dept_info">單位資訊</option>
                        </select>
                    </div>

                    <button type="button" class="btn btn-submit btnInline" onclick="location.href='ajax/dept_signout.php'">登出</button>
                </div>

                <div class="pageCont">
                    <div class="pageBodyTitle">
                        <h4><img src="images/icon/icon_title_search.png" alt="">
                            ‑ 路老師查詢 ‑</h4>
                    </div>

                    <div class="container">

                        <form action="" method="post" class="form-horizontal">
                            <?php foreach($search as $k=>$d){?>
                                <?php
                                switch($d){
                                    case 1:{
                                ?>
                                <div class="form-group">
                                    <label for="signupName" class="col-sm-3 control-label labelIcon"
                                        style="background-image: url('images/icon/icon_signup_info01.png')">路老師姓名</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="signupName" name="name" placeholder="">
                                    </div>
                                </div>
                                <?php
                                        break;
                                    }
                                    case 2:{
                                ?>
                                <div class="form-group">
                                    <label for="" class="col-sm-3 control-label labelIcon"
                                        style="background-image: url('images/icon/icon_signup_info02.png')">性別</label>
                                    <div class="col-sm-7">
                                        <select class="form-control" name="gender">
                                            <option value="">全部</option>
                                            <option value="1">男</option>
                                            <option value="2">女</option>
                                        </select>
                                    </div>
                                </div>
                                <?php
                                        break;
                                    }
                                    case 3:{
                                ?>
                                <div class="form-group">
                                    <label for="" class="col-sm-3 control-label labelIcon"
                                        style="background-image: url('images/icon/icon_signup_info07.png')">Line ID</label>
                                    <div class="col-sm-7">
                                        <div class="text-left form-inline radioCont">
                                            <label class="radio-inline">
                                                <input type="radio" name="lineOption" id="Radio1" value="0">
                                                <span class="checkmark"></span>無
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="lineOption" id="Radio2" value="1">
                                                <span class="checkmark"></span>有
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                        break;
                                    }
                                    case 4:{
                                ?>
                                <div class="form-group">
                                    <label for="" class="col-sm-3 control-label labelIcon"
                                        style="background-image: url('images/icon/icon_signup_info10.png')">經常使用之交通工具</label>
                                    <div class="col-sm-7">
                                        <div class="text-left form-inline checkboxCont">
                                            <?php for($i=1;$i<count($TRANSPORTATION);$i++){?>
                                            <label class="checkbox-inline">
                                                <input type="checkbox" class="trans" name="transportOption[]" id="Checkbox<?php echo $i;?>" value="<?php echo $TRANSPORTATION[$i];?>">
                                                <span class="checkmark"></span><?php echo $TRANSPORTATION[$i];?>
                                            </label>
                                            <?php }?>
                                            <label class="checkbox-inline">
                                                <input type="checkbox" name="transportOption[]" id="Checkbox<?php echo $i+1;?>" value="其它">
                                                <span class="checkmark"></span>其它
                                            </label>
                                            <input type="text" class="form-control other-input" id="" name="trans_else" placeholder="請填寫">
                                        </div>
                                    </div>
                                </div>
                                <?php
                                        break;
                                    }
                                    case 5:{
                                ?>
                                <div class="form-group">
                                    <label for="" class="col-sm-3 control-label labelIcon"
                                        style="background-image: url('images/icon/icon_affairs_log05.png')">年齡</label>
                                    <div class="col-sm-7">
                                        <select class="form-control" name="age">
                                            <option value="">全部</option>
                                            <?php for($i=1;$i<count($AGERANGE);$i++){?>
                                            <option value="<?php echo $i;?>"><?php echo $AGERANGE[$i]['text'];?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <?php
                                        break;
                                    }
                                    case 6:{
                                ?>
                                <div class="form-group">
                                    <div class="location">
                                        <label for="signupArea" class="col-xs-12 col-sm-3 control-label labelIcon" style="background-image: url('images/icon/icon_signup_info04.png')">居住地區</label>
                                        <div class="col-xs-6 col-sm-3 pdr-5">
                                            <select class="form-control city" name="city">
                                                <option value="">縣市</option>
                                                <?php foreach($city as $k=>$d){?>
                                                <option value="<?php echo $d['name'];?>"><?php echo $d['name'];?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                        <div class="col-xs-6 col-sm-4">
                                            <select class="form-control area" name="area">
                                                <option value="">鄉鎮區域</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-2">
                                        <a href="javascript:;" class="formAddition addLocation"><i class="glyphicon glyphicon-plus-sign"></i> 新增區域</a>
                                        <span style="display: block; font-size: smaller; margin-top: -8px; margin-left:18px;">(最多三個)</span>
                                    </div>
                                </div>
                                <?php
                                        break;
                                    }
                                    case 7:{
                                ?>
                                <div class="form-group mgt-n10">
                                    <label for="" class="col-sm-3 control-label labelIcon"
                                        style="background-image: url('images/icon/icon_signup_info08.png')">精通語言</label>
                                    <div class="col-sm-7">
                                        <div class="text-left form-inline checkboxCont">
                                            <?php for($i=1;$i<count($LANGUAGE);$i++){?>
                                            <label class="checkbox-inline">
                                                <input type="checkbox" class="lang" name="langOption[]" id="Checkbox<?php echo $i;?>" value="<?php echo $LANGUAGE[$i];?>">
                                                <span class="checkmark"></span><?php echo $LANGUAGE[$i];?>
                                            </label>
                                            <?php }?>
                                            <label class="checkbox-inline">
                                                <input type="checkbox" name="langOption" id="Checkbox<?php echo $i+1;?>" value="其它">
                                                <span class="checkmark"></span>其它
                                            </label>
                                            <input type="text" class="form-control other-input" id="" name="lang_else" placeholder="請填寫">
                                        </div>
                                    </div>
                                </div>
                                <?php
                                        break;
                                    }
                                    case 8:{
                                ?>
                                <?php
                                        break;
                                    }
                                    case 9:{
                                ?>
                                <?php
                                        break;
                                    }
                                    case 10:{
                                ?>
                                <?php
                                        break;
                                    }
                                    case 11:{
                                ?>
                                <div class="form-group mgt-n10">
                                    <label for="signupJob" class="col-sm-3 control-label labelIcon"
                                        style="background-image: url('images/icon/icon_signup_info09.png')">職業</label>
                                    <div class="col-sm-7">
                                        <select class="form-control" name="career">
                                            <option value="">請選擇</option>
                                            <?php for($i=1;$i<count($CAREER);$i++){?>
                                            <option value="<?php echo $CAREER[$i];?>"><?php echo $CAREER[$i];?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <?php
                                        break;
                                    }
                                    case 12:{
                                ?>
                                <div class="form-group mgt-n10">
                                    <label for="" class="col-sm-3 control-label labelIcon"
                                        style="background-image: url('images/icon/icon_signup_info03.png')">宣講場次</label>
                                    <div class="col-sm-7">
                                        <select class="form-control" name="speach">
                                            <option value="">請選擇</option>
                                            <?php for($i=1;$i<count($EXPRANGE);$i++){?>
                                            <option value="<?php echo $i;?>"><?php echo $EXPRANGE[$i]['text'];?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <?php
                                        break;
                                    }
                                    case 13:{
                                ?>
                                <div class="form-group mgt-n10">
                                    <label for="" class="col-sm-3 control-label labelIcon"
                                        style="background-image: url('images/icon/icon_signup_info11.png')">持有駕照</label>
                                    <div class="col-sm-7">
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
                                <?php
                                        break;
                                    }
                                }
                                ?>
                            <?php }?>
    
                            <button type="button" class="btn btn-submit submit">查詢</button>
                        </form>
                    </div>

                </div>

                <!--查詢結果START-->
                <div class="pageCont searchCont hide">
                    <div class="pageBodyTitle">
                        <h4>
                            ‑ 查詢結果 ‑
                        </h4>
                        <div>
                            <label for="">排列順序</label>
                            <select name="order" id="" class="form-control w200">
                                <option value="1" selected>鄉鎮區域</option>
                                <option value="2">宣講場次</option>
                                <option value="3">性別</option>
                                <option value="4">年齡</option>
                                <option value="5">姓名</option>
                            </select>
                            <select name="sort" id="" class="form-control">
                                <option value="1" selected>順序</option>
                                <option value="2">反序</option>
                            </select>
                        </div>
                    </div>

                    <p class="resultTxt">查詢結果 共 <span class="cBlue tBold count"></span> 筆</p>

                    <div class="container">

                        <!--pagination START-->
                        <nav id="paginationBar" class="hide" aria-label="Page navigation">
                            <ul class="pagination">
                                <li>
                                    <a href="#" aria-label="Previous">
                                        <span aria-hidden="true">上一頁</span>
                                    </a>
                                </li>
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li>
                                    <a href="#" aria-label="Next">
                                        <span aria-hidden="true">下一頁</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <!--pagination END-->
                    </div>
                </div>
                <!--查詢結果END-->

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
    <script>
    $(document).ready(function(){
        $('#deptSelector').change(function(){
            location.href = $(this).val()+'.php';
        });
        
        $('.submit').click(function(){
            loadList();
        });
        
        $('select[name=order], select[name=sort]').change(function(){
            loadList();
        });
        
        <?php if(in_array(6,$search)){?>
        var city = {};
        <?php foreach($city as $k=>$d){?>
        city['<?php echo $d['name'];?>'] = '<?php echo $d['name'];?>';
        <?php }?>
        var area = {};
        <?php foreach($area as $k=>$d){?>
        area['<?php echo $d['cityname'];?>'] = area['<?php echo $d['cityname'];?>']||{};
        area['<?php echo $d['cityname'];?>']['<?php echo $d['name'];?>'] = '<?php echo $d['name'];?>';
        <?php }?>
        
        $('select.city').change(cityChange);
        
        $('.addLocation').click(function(){
            if($('.location').length>=3) return alert('區域最多三個');
            var $location = $('<div class="location">\
                              <label for="signupArea" class="col-xs-12 col-sm-3 control-label labelIcon"></label>\
                                <div class="col-xs-6 col-sm-3 pdr-5 mgb-10">\
                                    <select class="form-control city" name="city">\
                                        <option value="">縣市</option>\
                                        <?php foreach($city as $k=>$d){?>
                                        <option value="<?php echo $d['name'];?>"><?php echo $d['name'];?></option>\
                                        <?php }?>
                                    </select>\
                                </div>\
                                <div class="col-xs-6 col-sm-4 mgb-10">\
                                    <select class="form-control area" name="area">\
                                        <option value="">鄉鎮區域</option>\
                                    </select>\
                                </div>\
                              </div>');
            $(this).closest('.form-group').append($location);
            $location.find('select.city').change(cityChange);
        });
        
        function cityChange(){
            var $location = $(this).closest('.location');
            $location.find('select.area').html('<option value="">鄉鎮區域</option>');
            if(!area[$(this).val()]) return;
            $.each(area[$(this).val()],function(i,v){
                $location.find('select.area').append('<option value="'+i+'">'+v+'</option>');
            });
        }
        <?php }?>
        
        function loadList(pg){
            $('.searchCont .container .row').remove();
            $('#paginationBar').addClass('hide');
            
            var formData = {};
            formData['limit'] = 20;
            formData['page'] = pg||1;
            formData['order'] = $('select[name=order]').val()||'';
            formData['sort'] = $('select[name=sort]').val()||'';
            <?php foreach($search as $k=>$d){?>
                <?php
                switch($d){
                    case 1:{
                ?>
            formData['name'] = $('input[name=name]').val()||'';
                <?php
                        break;
                    }
                    case 2:{
                ?>
            formData['gender'] = $('select[name=gender]').val()||'';
                <?php
                        break;
                    }
                    case 3:{
                ?>
            formData['lineid'] = $('input[name=lineOption]:checked').val()||'2';
                <?php
                        break;
                    }
                    case 4:{
                ?>
            formData['transportation'] = [];
            $.each($('.trans:checked'),function(i,v){
                formData['transportation'].push($(v).val());
            });
            if($('input[name=trans_else]').val())
                $.merge(formData['transportation'],$('input[name=trans_else]').val().split(','));
                <?php
                        break;
                    }
                    case 5:{
                ?>
            formData['age'] = $('select[name=age]').val()||'';
                <?php
                        break;
                    }
                    case 6:{
                ?>
            formData['location'] = [];
            $.each($('.location'),function(i,v){
                formData['location'].push([$(v).find('select.city').val(),$(v).find('select.area').val()]);
            });
                <?php
                        break;
                    }
                    case 7:{
                ?>
            formData['language'] = [];
            $.each($('input.lang:checked'),function(i,v){
                formData['language'].push($(v).val());
            });
            if($('input[name=lang_else]').val())
                $.merge(formData['language'],$('input[name=lang_else]').val().split(','));
                <?php
                        break;
                    }
                    case 8:{
                ?>
                <?php
                        break;
                    }
                    case 9:{
                ?>
                <?php
                        break;
                    }
                    case 10:{
                ?>
                <?php
                        break;
                    }
                    case 11:{
                ?>
            formData['career'] = $('select[name=career]').val()||'';
                <?php
                        break;
                    }
                    case 12:{
                ?>
            formData['speach'] = $('select[name=speach]').val()||'';
                <?php
                        break;
                    }
                    case 13:{
                ?>
            formData['license_bike'] = $('input[name=license_bike]:checked').val()||'';
            formData['license_car'] = $('input[name=license_car]:checked').val()||'';
                <?php
                        break;
                    }
                }
                ?>
            <?php }?>
            
            $.ajax({
                type : 'post',
                url : 'ajax/teacher.php',
                data : formData,
                dataType : 'json',
                success : function(data){
                    if(data.msgcode == 200){
                        $.each(data.data,function(i,v){
                            var $rec = $('<div class="row">\
                                        <table class="responsive-table table-in-smallscreen" style="cursor:pointer;">\
                                            <tr>\
                                                <td data-th="編號">\
                                                    <p>'+v.id+'</p>\
                                                </td>\
                                                <td data-th="姓名">\
                                                    <p>'+v.name+'</p>\
                                                </td>\
                                                <td data-th="精通語言">\
                                                    <p>'+v.language+'</p>\
                                                </td>\
                                                <td data-th="性別">\
                                                    <p>'+v.gender+'</p>\
                                                </td>\
                                                <td data-th="年齡">\
                                                    <p>'+v.age+'</p>\
                                                </td>\
                                                <td data-th="居住地區">\
                                                    <p>'+v.location+'</p>\
                                                </td>\
                                            </tr>\
                                        </table>\
                                        <form action="" class="form-horizontal hide">\
                                            <div class="form-group">\
                                                <label for="" class="col-sm-3 control-label labelIcon" style="background-image: url(\'images/icon/icon_signup_info05.png\')">Email</label>\
                                                <div class="col-sm-9">\
                                                    <p>'+v.email+'</p>\
                                                </div>\
                                            </div>\
                                            <div class="form-group">\
                                                <label for="" class="col-sm-3 control-label labelIcon" style="background-image: url(\'images/icon/icon_signup_info07.png\')">LINE ID</label>\
                                                <div class="col-sm-9">\
                                                    <p>'+v.lineid+'</p>\
                                                </div>\
                                            </div>\
                                            <div class="form-group">\
                                                <label for="" class="col-sm-3 control-label labelIcon" style="background-image: url(\'images/icon/icon_signup_info06.png\')">電話</label>\
                                                <div class="col-sm-9">\
                                                    <p>'+v.phone+'</p>\
                                                </div>\
                                            </div>\
                                            <div class="form-group">\
                                                <label for="" class="col-sm-3 control-label labelIcon" style="background-image: url(\'images/icon/icon_signup_info09.png\')">職業</label>\
                                                <div class="col-sm-9">\
                                                    <p>'+v.career+'</p>\
                                                </div>\
                                            </div>\
                                            <div class="form-group">\
                                                <label for="" class="col-sm-3 control-label labelIcon" style="background-image: url(\'images/icon/icon_signup_info12.png\')">服務單位</label>\
                                                <div class="col-sm-9">\
                                                    <p>'+v.service+'</p>\
                                                </div>\
                                            </div>\
                                            <div class="form-group">\
                                                <label for="" class="col-sm-3 control-label labelIcon" style="background-image: url(\'images/icon/icon_signup_info11.png\')">駕照</label>\
                                                <div class="col-sm-9">\
                                                    <p>'+v.license+'</p>\
                                                </div>\
                                            </div>\
                                            <div class="form-group">\
                                                <label for="" class="col-sm-3 control-label labelIcon" style="background-image: url(\'images/icon/icon_signup_info10.png\')">經常使用交通工具</label>\
                                                <div class="col-sm-9">\
                                                    <p>'+v.transportation+'</p>\
                                                </div>\
                                            </div>\
                                            <div class="form-group">\
                                                <label for="" class="col-sm-3 control-label labelIcon" style="background-image: url(\'images/icon/icon_affairs_log07.png\')">得獎紀錄</label>\
                                                <div class="col-sm-9">\
                                                    <p>'+v.award+'</p>\
                                                </div>\
                                            </div>\
                                            <div class="form-group">\
                                                <label for="" class="col-sm-3 control-label labelIcon" style="background-image: url(\'images/icon/icon_affairs_log02.png\')">宣講場次'+v.speach+'次</label>\
                                                <div class="col-sm-9">\
                                                    <p class="txtOverflow">'+v.speachText+'</p>\
                                                    <a href="javascript:;" class="expandBtn">更多</a>\
                                                </div>\
                                            </div>\
                                            <div class="form-group">\
                                                <label for="" class="col-sm-3 control-label labelIcon" style="background-image: url(\'images/icon/icon_affairs_log06.png\')">培訓歷程'+v.training+'次</label>\
                                                <div class="col-sm-9">\
                                                    <p class="txtOverflow">'+v.trainingText+'</p>\
                                                    <a href="javascript:;" class="expandBtn">更多</a>\
                                                </div>\
                                            </div>\
                                            <div class="form-group">\
                                                <label for="" class="col-sm-3 control-label labelIcon" style="background-image: url(\'images/icon/icon_affairs_log03.png\')">認證年份</label>\
                                                <div class="col-sm-9">\
                                                    <p>'+v.year+'年</p>\
                                                </div>\
                                            </div>\
                                        </form>\
                                    </div>');
                            $('.searchCont .container').append($rec);
                            
                            $rec.find('table').prepend(i==0?'<tr><th>編號</th><th>姓名</th><th>精通語言</th><th>性別</th><th>年齡</th><th>居住地區</th></tr>':'');
                            
                            $rec.find('table').click(function(){
                                $rec.find('form').toggleClass('hide');
                            });
                        });
                        if(data.pages>1){
                            $('#paginationBar').removeClass('hide');
                            $('#paginationBar li').remove();
                            $('#paginationBar .pagination').append(pagging(parseInt(data.page),parseInt(data.pages)));
                            $('.searchCont .container').append($('#paginationBar'));
                        }
                        $('.count').html(data.count);
                        $('.searchCont').removeClass('hide');
                    }
                    else
                        alert(data.msg);
                }
            });
        }
        
        function pagging(pg,pgs){
            var html = '';
            if(pg>1)
                html +='<li><a href="javascript:;" aria-label="Previous" data-pg="'+(pg-1)+'"><span aria-hidden="true">上一頁</span></a></li>';
            for(var i=(Math.ceil(pg/10)-1)*10+1;i<=Math.ceil(pg/10)*10&&i<=pgs;i++)
                html +='<li'+(i==pg?' class="active"':'')+'><a href="javascript:;" data-pg="'+i+'">'+i+'</a></li>';
            if(pg<pgs)
                html +='<li><a href="javascript:;" aria-label="Next" data-pg="'+(pg+1)+'"><span aria-hidden="true">下一頁</span></a></li>';
            var $pagging = $(html);
            $pagging.find('a').click(function(){
                loadList($(this).data('pg'));
            });
            return $pagging;
        }
    });
    </script>
</body>

</html>