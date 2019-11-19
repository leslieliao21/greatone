<?php 
require_once 'php.lib/config.php';
require_once 'php.lib/main.php';
require_once 'php.lib/functions.php';
require_once 'php.lib/mysqli_class.php';
$DB = new DB_CONN();
$memberLogin = memberLoginChk();
if(!$memberLogin['status']){
    header('Location:signin.php');
    exit;
}
$member = $_SESSION[WEBX.'Mem'];
if(!in_array($member['qualify'],array(1,2))){
    header('Location:member.php');
    exit;
}

$plans = planList(array('publish'=>1),0);
$city = cityList();
$area = areaList();

$rec = '';
$id = isset($_GET['id'])?FUNCS::inputFilter('id','GET',1):0;
$result = speachList(array('tid'=>$member['id'],'id'=>$id),1);
if(!empty($result)){
    $rec = $result[0];
    $rec['plans'] = explode(',',$rec['plan']);
    $rec['pictures'] = json_decode($rec['pictures'],true);
    $rec = json_encode($rec);
}
else if(!empty($_POST['rec'])){
    $rec = urldecode($_POST['rec']);
}
?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
    <!-- Basic Data -->
    <meta charset="UTF-8">
    <title>路老師培訓網 | 宣講歷程登錄</title>
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

<body id="member-page" class="affairsRecordPage" data-menu="0">
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
                    <li><a href="member_affairs.php">個人宣講歷程</a></li>
                    <li class="active">宣講歷程登錄</li>
                </ol>
                
                <div class="signout">
                    <div class="showDinlineblock">
                        <label for="memberSelector"><?php echo $member['name'];?> 老師</label>
                        <select name="" id="memberSelector" class="form-control w200">
                            <option value="member">路老師專區</option>
                            <?php if(in_array($member['qualify'],array(1,2))){?>
                            <option value="member_affairs">個人宣講歷程</option>
                            <option value="member_affairs_record" selected>宣講歷程登錄</option>
                            <option value="member_download">教案下載</option>
                            <?php }?>
                            <option value="member_application">培訓報名</option>
                            <option value="member_info">個人資料</option>
                        </select>
                    </div>

                    <button type="button" class="btn btn-submit btnInline" onclick="location.href='ajax/signout.php'">登出</button>
                </div>

                <div class="pageCont">
                    <div class="pageBodyTitle">
                        <h4><img src="images/icon/icon_title_book.png" alt="">
                            ‑ 宣講歷程登錄 ‑
                        </h4>
                    </div>

                    <p>請登錄個人宣講過程與教學回饋</p>

                    <form id="recordForm" class="form-horizontal" action="member_affairs_recordinfo.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="">
                        <input type="hidden" name="o_teacher" value="">
                        <input type="hidden" name="o_group" value="">
                        <input type="hidden" class="o_scene" name="o_scene[]" value="">
                        <input type="hidden" class="o_scene" name="o_scene[]" value="">
                        <input type="hidden" class="o_scene" name="o_scene[]" value="">
                        <input type="hidden" class="o_scene" name="o_scene[]" value="">
                        <input type="hidden" class="o_scene" name="o_scene[]" value="">
                        <input type="hidden" class="o_scene" name="o_scene[]" value="">
                        <div class="form-group">
                            <label for="affairsPlace" class="col-sm-3 control-label required labelIcon"
                                style="background-image: url('images/icon/icon_affairs_log01.png')">宣講單位</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="affairsPlace" name="audience" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label required labelIcon"
                                style="background-image: url('images/icon/icon_affairs_log02.png')">宣講日期</label>
                            <div class="col-sm-4">
                                <select name="year" class="form-control">
                                    <option value="">年</option>
                                    <?php for($i=mingoDate(date('Y-m-d'),'y');$i>105;$i--){?>
                                    <option value="<?php echo $i+1911;?>"><?php echo $i;?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <select name="month" class="form-control">
                                    <option value="">月</option>
                                    <?php for($i=1;$i<=12;$i++){?>
                                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <select name="date" class="form-control">
                                    <option value="">日</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="affairsTime" class="col-sm-3 control-label required labelIcon"
                                style="background-image: url('images/icon/icon_affairs_log03.png')">宣講時間</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="affairsTime" name="minutes" placeholder="">
                            </div>
                            <div class="col-sm-2 formAddition">分鐘</div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label required labelIcon"
                                style="background-image: url('images/icon/icon_affairs_log04.png')">城市鄉鎮</label>
                            <div class="col-sm-3">
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
                            <label for="affairsPeople" class="col-sm-3 control-label required labelIcon"
                                style="background-image: url('images/icon/icon_affairs_log05.png')">參加人數</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="affairsPeople" name="attends" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label required labelIcon"
                                style="background-image: url('images/icon/icon_affairs_log06.png')">使用教案</label>
                            <div class="col-sm-3">
                                <select name="plan[]" class="form-control plan">
                                    <option value="">請選擇</option>
                                    <?php foreach($plans as $k=>$d){?>
                                    <option value="<?php echo $d['id'];?>"><?php echo $d['title'];?></option>
                                    <?php }?>
                                    <option value="其它">其它</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control plan_else" id="" name="plan_else[]" placeholder="請填寫其他教案">
                            </div>
                            <div class="col-sm-2">
                                <a href="javascript:;" class="formAddition addPlan"><i class="glyphicon glyphicon-plus-sign"></i> 新增教案</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="affairsAdvantage" class="col-sm-3 control-label required labelIcon"
                                style="background-image: url('images/icon/icon_affairs_log07.png')">路老師回饋 - 優點</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" id="affairsAdvantage" name="benefit" placeholder="請就本教案提出您的想法與建議(例如:教學主題、教學內容、教學簡報內容、影片內容、課程長度、學習單、實作觀察表等)" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="affairsSuggestion" class="col-sm-3 control-label required labelIcon"
                                style="background-image: url('images/icon/icon_affairs_log08.png')">路老師回饋 - 建議</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" id="affairsSuggestion" name="feedback" placeholder="請就本教案提出您的想法與建議(例如:教學主題、教學內容、教學簡報內容、影片內容、課程長度、學習單、實作觀察表等)" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="affairsEffective" class="col-sm-3 control-label required labelIcon"
                                style="background-image: url('images/icon/icon_affairs_log09.png')">學習成效評估</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" id="affairsEffective" name="evaluation" placeholder="請針對各教案最後的學習單統計結果，說明各教案的學習單問題回答情況。(如:行人教案一第一題有20人答對，第一題有15人答對)" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label labelIcon"
                                style="background-image: url('images/icon/icon_affairs_log10.png')">宣講照片上傳</label>
                            <div class="col-sm-7 mgb-10 photo">
                                <label for="" class="col-sm-4 control-label required">路老師台上宣講</label>
                                <div class="col-sm-3">
                                    <input type="file" class="form-control teacher" name="teacher" style="display:none;">
                                    <button type="button" class="btn btn-upload">
                                        <img src="images/icon/icon_upload.png" alt="">
                                        瀏覽
                                    </button>
                                </div>
                                <div class="col-sm-5 pdr-0">
                                    <input type="text" class="form-control" id="" name="teacher_desc" placeholder="請簡短說明">
                                </div>
                                <div class="col-sm-12 teacher_photo photoUploadName hide"></div>
                            </div>
                            <label for="" class="col-sm-3 control-label"></label>
                            <div class="col-sm-7 mgb-10 photo">
                                <label for="" class="col-sm-4 control-label">與學生團體合照</label>
                                <div class="col-sm-3">
                                    <input type="file" class="form-control group" name="group" style="display:none;">
                                    <button type="button" class="btn btn-upload">
                                        <img src="images/icon/icon_upload.png" alt="">
                                        瀏覽
                                    </button>
                                </div>
                                <div class="col-sm-5 pdr-0">
                                    <input type="text" class="form-control" id="" name="group_desc" placeholder="請簡短說明">
                                </div>
                                <div class="col-sm-12 group_photo photoUploadName hide"></div>
                            </div>
                            <label for="" class="col-sm-3 control-label"></label>
                            <div class="col-sm-7 mgb-10 photo">
                                <label for="" class="col-sm-4 control-label required">教學過程實況</label>
                                <div class="col-sm-3">
                                    <input type="file" class="form-control scene" name="scene[]" style="display:none;">
                                    <button type="button" class="btn btn-upload">
                                        <img src="images/icon/icon_upload.png" alt="">
                                        瀏覽
                                    </button>
                                </div>
                                <div class="col-sm-5 pdr-0">
                                    <input type="text" class="form-control scene_desc" id="" name="scene_desc[]" placeholder="請簡短說明">
                                </div>
                                <div class="col-sm-12 scene_photo photoUploadName hide"></div>
                            </div>
                            <div class="col-sm-2">
                                <a href="javascript:;" class="formAddition addScene"><i class="glyphicon glyphicon-plus-sign"></i> 新增照片</a>
                            </div>
                            <label for="" class="col-sm-3 control-label"></label>
                            <div class="col-sm-7 mgb-10 photo">
                                <label for="" class="col-sm-4 control-label"></label>
                                <div class="col-sm-3">
                                    <input type="file" class="form-control scene" name="scene[]" style="display:none;">
                                    <button type="button" class="btn btn-upload">
                                        <img src="images/icon/icon_upload.png" alt="">
                                        瀏覽
                                    </button>
                                </div>
                                <div class="col-sm-5 pdr-0">
                                    <input type="text" class="form-control scene_desc" id="" name="scene_desc[]" placeholder="請簡短說明">
                                </div>
                                <div class="col-sm-12 scene_photo photoUploadName hide"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-8 text-left">
                                <p><i class="glyphicon glyphicon-info-sign"></i> 教學過程實況最多新增四張照片</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-8 text-left">
                                <span><i class="glyphicon glyphicon-info-sign"></i> 為必填欄位：</span>
                                <ul>
                                    <li>請根據主題上傳宣講過程中的照片</li>
                                    <li>每張照片限5MB以下</li>
                                </ul>
                            </div>
                        </div>

                        <button type="button" class="btn btn-gray btnInline reset">重新填寫</button>
                        <button type="button" class="btn btn-submit btnInline submit">確認</button>
                    </form>
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
        
        $('select[name=year], select[name=month]').change(function(){
            var y = parseInt($('select[name=year]').val());
            var m = parseInt($('select[name=month]').val());
            $('select[name=date]').html('<option value="">日</option>');
            if((new Date(y+'-'+('0'+m).substr(-2)))=='Invalid Date') return;
            for(var d=1;(new Date(y+'-'+('0'+m).substr(-2)+'-'+('0'+d).substr(-2))).getMonth()<m;d++)
                $('select[name=date]').append('<option value="'+d+'">'+d+'</option>');
        });
        
        $('.addPlan').click(function(){
            addPlan();
        });
        
        $('.btn-upload').click(function(){
            $(this).siblings('input[type=file]').click();
        });
        
        $('input[type=file]').change(function(){
            fileChange(this);
        });
        
        $('.addScene').click(function(){
            addScene();
        });
        
        $('.reset').click(function(){
            $('.form-control').val('');
        });
        
        $('.submit').click(function(e){
            var audience = $('#affairsPlace').val();
            if(!audience)
                return alert('請輸入宣講單位');
            
            var y = parseInt($('select[name=year]').val());
            var m = parseInt($('select[name=month]').val());
            var d = parseInt($('select[name=date]').val());
            if((new Date(y+'-'+('0'+m).substr(-2)+'-'+('0'+d).substr(-2)))=='Invalid Date')
                return alert('請選擇宣講日期');
            
            var minutes = $('#affairsTime').val();
            if(!minutes)
                return alert('請輸入宣講時間');
            
            var city = $('select[name=city]').val();
            var area = $('select[name=area]').val();
            if(!city||!area)
                return alert('請選擇城市鄉鎮');
            
            var attends = $('#affairsPeople').val();
            if(!attends)
                return alert('請輸入參加人數');
            
            var plan = '';
            $.each($('.plan'),function(i,v){
                if($('.plan').eq(i).val()=='其它')
                    plan = $('.plan_else').eq(i).val()||plan;
                else
                    plan = $('.plan').eq(i).val()||plan;
            });
            if(!plan)
                return alert('請選擇使用教案');
            
            var benefit = $('#affairsAdvantage').val();
            if(!benefit)
                return alert('請輸入路老師回饋 - 優點');
            
            var feedback = $('#affairsSuggestion').val();
            if(!feedback)
                return alert('請輸入路老師回饋 - 建議');
            
            var evaluation = $('#affairsEffective').val();
            if(!evaluation)
                return alert('請輸入學習成效評估');
            
            var teacher = $('.teacher').val()||$('input[name=o_teacher]').val();
            if(!teacher)
                return alert('請上傳路老師台上宣講照片');
            
            /*var group = $('.group').val()||$('input[name=o_group]').val();
            if(!group)
                return alert('請上傳路老師與學生團體合照照片');*/
            
            var scene = 0;
            $.each($('.scene'),function(i,v){
                scene += ($(v).val()||$('input.o_scene').eq(i).val())?1:0;
            });
            if(scene<2||scene>6)
                return alert('請上傳路老師教學過程實況照片2~6張');
            
            $('#recordForm').submit();
        });
        
        function fileChange(e){
            if(e.files[0].size<=5*1024*1024){
                $(e).closest('.photo').find('.photoUploadName').html(e.files[0].name).removeClass('hide');
                return;
            }
            alert('上傳檔案大於5MB');
            $(e).val('');
        }
        
        function addPlan(rec){
            var $plan = $('<label for="" class="col-sm-3 control-label"></label>\
                            <div class="col-sm-3">\
                                <select name="plan[]" class="form-control plan">\
                                    <option value="">請選擇</option>\
                                    <?php foreach($plans as $k=>$d){?>
                                    <option value="<?php echo $d['id'];?>"><?php echo $d['title'];?></option>\
                                    <?php }?>
                                    <option value="其它">其它</option>\
                                </select>\
                            </div>\
                            <div class="col-sm-4">\
                                <input type="text" class="form-control plan_else" id="" name="plan_else[]" placeholder="請填寫其他教案">\
                            </div>');
            $('.addPlan').closest('.form-group').append($plan);
            $('.addPlan').closest('.form-group').find('.col-sm-3,.col-sm-4').addClass('mgb-10');
            $plan.removeClass('mgb-10');
            
            if($plan.find('option[value='+rec+']').length)
                $plan.find('select.plan').val(rec||'')
            else
                $plan.find('select.plan').val('其它'), $plan.find('input.plan_else').val(rec||'')
        }
        
        function addScene(rec,desc){
            if($('.scene').length>=6)
                return alert('教學過程實況最多上傳6張');
            
            var $scene = $('<label for="" class="col-sm-3 control-label"></label>\
                            <div class="col-sm-7 mgb-10 photo">\
                                <label for="" class="col-sm-4 control-label"></label>\
                                <div class="col-sm-3">\
                                    <input type="file" class="form-control scene" name="scene[]" style="display:none;">\
                                    <button type="button" class="btn btn-upload">\
                                        <img src="images/icon/icon_upload.png" alt="">\
                                        瀏覽\
                                    </button>\
                                </div>\
                                <div class="col-sm-5 pdr-0">\
                                    <input type="text" class="form-control scene_desc" id="" name="scene_desc[]" value="'+(desc||'')+'" placeholder="請簡短說明">\
                                </div>\
                                <div class="col-sm-12 scene_photo photoUploadName'+(rec?'':' hide')+'">'+(rec||'')+'</div>\
                            </div>');
            $('.addScene').closest('.form-group').append($scene);
            $scene.find('.btn-upload').click(function(){
                $(this).siblings('input[type=file]').click();
            });
            $scene.find('input[type=file]').change(function(){
                fileChange(this);
            });
        }
        
        <?php if($rec){?>
        var rec = JSON.parse('<?php echo $rec;?>');
        $('input[name="id"]').val(rec.id||0);
        $('input[name="audience"]').val(rec.audience||'');
        $('select[name="city"]').val(rec.city||'').change();
        $('select[name="area"]').val(rec.area||'');
        $('input[name="minutes"]').val(rec.minutes||'');
        $('input[name="attends"]').val(rec.attends||'');
        $('textarea[name="benefit"]').val(rec.benefit||'');
        $('textarea[name="feedback"]').val(rec.feedback||'');
        $('textarea[name="evaluation"]').val(rec.evaluation||'');
        
        var speachdate = new Date(rec.speachdate);
        $('select[name="year"]').val(speachdate.getFullYear()).change();
        $('select[name="month"]').val(speachdate.getMonth()+1).change();
        $('select[name="date"]').val(speachdate.getDate());
        
        $.each(rec.plans,function(i,v){
            if(i>0)
                addPlan(v);
            else if($('select.plan option[value='+v+']').length)
                $('select.plan').val(v||'');
            else
                $('select.plan').val('其它'), $('input.plan_else').val(v||'');
        });
        
        if(rec.pictures.teacher)
            $('.teacher_photo').html(rec.pictures.teacher).removeClass('hide');
        $('input[name=o_teacher]').val(rec.pictures.teacher||'');
        $('input[name=teacher_desc]').val(rec.pictures.teacher_desc||'');
        
        if(rec.pictures.group)
            $('.group_photo').html(rec.pictures.group).removeClass('hide');
        $('input[name=o_group]').val(rec.pictures.group||'');
        $('input[name=group_desc]').val(rec.pictures.group_desc||'');
        
        var j = 0;
        $.each(rec.pictures.scene,function(i,v){
            $('input.o_scene').eq(j).val(rec.pictures.scene[i]||'');
            j++;
        });
        
            j = 0;
        $.each(rec.pictures.scene_desc,function(i,v){
            if(j>=2)
                addScene(rec.pictures.scene[i],rec.pictures.scene_desc[i]);
            else{
                if(rec.pictures.scene[i])
                    $('.scene_photo').eq(j).html(rec.pictures.scene[i]).removeClass('hide');
                $('input.scene_desc').eq(j).val(rec.pictures.scene_desc[i]||'');
            }
            j++;
        });
        <?php }?>
    });
    </script>
</body>

</html>