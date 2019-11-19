<?php 
require_once 'php.lib/config.php';
require_once 'php.lib/main.php';
require_once 'php.lib/functions.php';
require_once 'php.lib/mysqli_class.php';
require_once 'php.lib/imgOutput.php';
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

$plans = array();
$result = planList(array('publish'=>1),0);
foreach($result as $k=>$d)
    $plans[$d['id']] = $d['title'];

$id = isset($_GET['id'])?FUNCS::inputFilter('id','GET',1):0;
$result = speachList(array('tid'=>$member['id'],'id'=>$id),1);
if(!empty($result)){
    $rec = $result[0];
    $rec['plans'] = explode(',',$rec['plan']);
    $rec['pictures'] = json_decode($rec['pictures'],true);
}
else if(!empty($_POST)){
    $rec = array();
    $rec['id'] = isset($_POST['id'])?FUNCS::inputFilter('id','POST',1):0;
    $rec['audience'] = isset($_POST['audience'])?FUNCS::inputFilter('audience','POST',3):'';
    $rec['city'] = isset($_POST['city'])?FUNCS::inputFilter('city','POST',3):'';
    $rec['area'] = isset($_POST['area'])?FUNCS::inputFilter('area','POST',3):'';
    $rec['minutes'] = isset($_POST['minutes'])?FUNCS::inputFilter('minutes','POST',1):0;
    $rec['attends'] = isset($_POST['attends'])?FUNCS::inputFilter('attends','POST',1):0;
    $rec['benefit'] = isset($_POST['benefit'])?FUNCS::inputFilter('benefit','POST',3):'';
    $rec['feedback'] = isset($_POST['feedback'])?FUNCS::inputFilter('feedback','POST',3):'';
    $rec['evaluation'] = isset($_POST['evaluation'])?FUNCS::inputFilter('evaluation','POST',3):'';
    $rec['status'] = -1;
    
    $y = isset($_POST['year'])?FUNCS::inputFilter('year','POST',1):0;
    $m = isset($_POST['month'])?FUNCS::inputFilter('month','POST',1):0;
    $d = isset($_POST['date'])?FUNCS::inputFilter('date','POST',1):0;
    $rec['speachdate'] = date('Y-m-d',strtotime($y.'-'.$m.'-'.$d));
    
    $rec['plans'] = array();
    if(!empty($_POST['plan'])){
        foreach($_POST['plan'] as $k=>$d){
            $plan = filter_var($_POST['plan'][$k],FILTER_SANITIZE_SPECIAL_CHARS);
            $else = filter_var($_POST['plan_else'][$k],FILTER_SANITIZE_SPECIAL_CHARS);
            $else = $else?explode(',',$else):array();
            if($plan && $plan!='其它')
                $rec['plans'][] = $plan;
            else if(!empty($else))
                $rec['plans'] = array_merge($rec['plans'],$else);
        }
    }
    
    $rec['pictures'] = array();
    $rec['pictures']['teacher'] = isset($_POST['o_teacher'])?FUNCS::inputFilter('o_teacher','POST',3):'';
    $rec['pictures']['teacher_desc'] = isset($_POST['teacher_desc'])?FUNCS::inputFilter('teacher_desc','POST',3):'';
    $pic = $_FILES['teacher'];
    if(FUNCS::Get_file_kind($pic['name'])=='photo' || FUNCS::Get_file_kind($pic['name'])=='png'){
        $_img = new IMG_PROCESS(array(
            'img_source' => $pic,
            'save_path'  => 'upload/',
            'save_name'  => 'speach'.$member['id'].'_teacher_'.date('siHdmY')
        ));
        $rec['pictures']['teacher'] = $_img->saveImg($_img->imgCrop(640,428));
    }
    else if(FUNCS::Get_file_kind($pic['name'])=='f-data'){}
    //else $e_msg .= '照片請使用jpg、png、gif格式\n';

    $rec['pictures']['group'] = isset($_POST['o_group'])?FUNCS::inputFilter('o_group','POST',3):'';
    $rec['pictures']['group_desc'] = isset($_POST['group_desc'])?FUNCS::inputFilter('group_desc','POST',3):'';
    $pic = $_FILES['group'];
    if(FUNCS::Get_file_kind($pic['name'])=='photo' || FUNCS::Get_file_kind($pic['name'])=='png'){
        $_img = new IMG_PROCESS(array(
            'img_source' => $pic,
            'save_path'  => 'upload/',
            'save_name'  => 'speach'.$member['id'].'_group_'.date('siHdmY')
        ));
        $rec['pictures']['group'] = $_img->saveImg($_img->imgCrop(640,428));
    }
    else if(FUNCS::Get_file_kind($pic['name'])=='f-data'){}
    //else $e_msg .= '照片請使用jpg、png、gif格式\n';

    $rec['pictures']['scene'] = array();
    foreach($_POST['o_scene'] as $k=>$d)
        $rec['pictures']['scene'][$k] = filter_var($_POST['o_scene'][$k],FILTER_SANITIZE_STRING);

    $rec['pictures']['scene_desc'] = array();
    foreach($_POST['scene_desc'] as $k=>$d)
        $rec['pictures']['scene_desc'][$k] = isset($_POST['scene_desc'][$k])?filter_var($_POST['scene_desc'][$k],FILTER_SANITIZE_STRING):'';

    foreach($_FILES['scene']['name'] as $k=>$d){
        if($k>=6 && count($rec['pictures']['scene'])>=6)
            continue;

        $pic = array(
            'name' => $_FILES['scene']['name'][$k],
            'type' => $_FILES['scene']['type'][$k],
            'tmp_name' => $_FILES['scene']['tmp_name'][$k],
            'error' => $_FILES['scene']['error'][$k],
            'size' => $_FILES['scene']['size'][$k]
        );

        if(FUNCS::Get_file_kind($pic['name'])=='photo' || FUNCS::Get_file_kind($pic['name'])=='png'){
            $_img = new IMG_PROCESS(array(
                'img_source' => $pic,
                'save_path'  => 'upload/',
                'save_name'  => 'speach'.$member['id'].'_scene'.($k+1).'_'.date('siHdmY')
            ));
            $rec['pictures']['scene'][$k] = $_img->saveImg($_img->imgCrop(640,428));
        }
        else if(FUNCS::Get_file_kind($pic['name'])=='f-data'){}
        //else $e_msg .= '照片請使用jpg、png、gif格式\n';
    }

    foreach($rec['pictures']['scene'] as $k=>$d){
        if(!$d){
            unset($rec['pictures']['scene'][$k]);
            unset($rec['pictures']['scene_desc'][$k]);
        }
    }
}
else{
    header('Location:member_affairs_record.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
    <!-- Basic Data -->
    <meta charset="UTF-8">
    <title>路老師培訓網 | 個人宣講歷程</title>
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

<body id="member-page" class="affairsRecordInfoPage" data-menu="0">
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

                    <!--<p>本教案登錄完成!感謝您支持高齡者交通安全教育，以下是您登錄的內容</p>-->

                    <table class="normal-table">
                        <tr>
                            <td>宣講單位</td>
                            <td><?php echo $rec['audience'];?></td>
                        </tr>
                        <tr>
                            <td>宣講日期</td>
                            <td><?php echo mingoDate($rec['speachdate']);?></td>
                        </tr>
                        <tr>
                            <td>城市鄉鎮</td>
                            <td><?php echo $rec['city'];?> <?php echo $rec['area'];?></td>
                        </tr>
                        <tr>
                            <td>總宣講時間</td>
                            <td><?php echo $rec['minutes'];?>分鐘</td>
                        </tr>
                        <tr>
                            <td>參加人數</td>
                            <td><?php echo $rec['attends'];?>人</td>
                        </tr>
                        <tr>
                            <td>使用教案</td>
                            <td>
                                <?php 
                                foreach($rec['plans'] as $k=>$d){
                                    echo $k?'，':'';
                                    echo isset($plans[$d])?$plans[$d]:$d;
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>路老師回饋 - 優點</td>
                            <td><?php echo nl2br($rec['benefit']);?></td>
                        </tr>
                        <tr>
                            <td>路老師回饋 - 建議</td>
                            <td><?php echo nl2br($rec['feedback']);?></td>
                        </tr>
                        <tr>
                            <td>學習成效評估</td>
                            <td><?php echo nl2br($rec['evaluation']);?></td>
                        </tr>
                        <tr>
                            <td>宣講照片上傳</td>
                            <td>
                                <div class="container">
                                    <?php if($rec['pictures']['teacher']||$rec['pictures']['group']){?>
                                    <div class="row">
                                        <?php if($rec['pictures']['teacher']){?>
                                        <div class="col-sm-6">
                                            <div class="affairsPhotoBox">
                                                <div class="imgWrapper">
                                                    <img src="<?php echo UPLOAD_PATH.$rec['pictures']['teacher'];?>" alt="">
                                                </div>
                                                <div class="affairsPhotoName">路老師台上宣講</div>
                                                <p><?php echo $rec['pictures']['teacher_desc'];?></p>
                                                <a href="#" class="btnMore text-right"><i class="glyphicon glyphicon-play"></i><span>展開</span></a>
                                            </div>
                                        </div>
                                        <?php }?>
                                        <?php if($rec['pictures']['group']){?>
                                        <div class="col-sm-6">
                                            <div class="affairsPhotoBox">
                                                <div class="imgWrapper">
                                                    <img src="<?php echo UPLOAD_PATH.$rec['pictures']['group'];?>" alt="">
                                                </div>
                                                <div class="affairsPhotoName">與學生團體合照</div>
                                                <p><?php echo $rec['pictures']['group_desc'];?></p>
                                                <a href="#" class="btnMore text-right"><i class="glyphicon glyphicon-play"></i><span>展開</span></a>
                                            </div>
                                        </div>
                                        <?php }?>
                                    </div>
                                    <?php }?>
                                    <?php if(!empty($rec['pictures']['scene'])){?>
                                    <div class="row">
                                        <?php $i = 0;?>
                                        <?php foreach($rec['pictures']['scene'] as $k=>$d){?>
                                        <?php if($i!=0 && $i++%2==0) echo '</div><div class="row">';?>
                                        <div class="col-sm-6">
                                            <div class="affairsPhotoBox">
                                                <div class="imgWrapper">
                                                    <img src="<?php echo UPLOAD_PATH.$rec['pictures']['scene'][$k];?>" alt="">
                                                </div>
                                                <div class="affairsPhotoName">教學過程實況</div>
                                                <p><?php echo $rec['pictures']['scene_desc'][$k];?></p>
                                                <a href="#" class="btnMore text-right"><i class="glyphicon glyphicon-play"></i><span>展開</span></a>
                                            </div>
                                        </div>
                                        <?php }?>
                                    </div>
                                    <?php }?>
                                </div>
                            </td>
                        </tr>
                    </table>

                    <?php if(in_array($rec['status'],array(-1,2))){?>
                    <div class="text-center">
                        <button type="button" class="btn btn-gray btnInline draft">存為草稿</button>
                        <button type="button" class="btn btn-gray btnInline edit">修改內容</button>
                        <button type="button" class="btn btn-gray btnInline delete">刪除</button>
                        <button type="button" class="btn btn-submit btnInline submit">確認登錄</button>
                    </div>
                    <?php }?>

                    <form id="recordForm" method="post">
                        <input type="hidden" name="rec" value="<?php echo urlencode(json_encode($rec));?>">
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
    <?php if(in_array($rec['status'],array(-1,2))){?>
    <script>
    $(document).ready(function(){
        $('#memberSelector').change(function(){
            location.href = $(this).val()+'.php';
        });
        
        $('.draft').click(function(){
            $('#recordForm').attr('action','ajax/draft.php');
            $('#recordForm').submit();
        });
        
        $('.edit').click(function(){
            $('#recordForm').attr('action','member_affairs_record.php');
            $('#recordForm').submit();
        });
        
        $('.delete').click(function(){
            $('#recordForm').attr('action','ajax/delete.php');
            $('#recordForm').submit();
        });
        
        $('.submit').click(function(){
            <?php if($rec['id']){?>
            $('#recordForm').attr('action','ajax/record.php');
            <?php }else{//未先存為草稿就直接送審?>
            $('#recordForm').attr('action','ajax/draft.php?record=1');
            <?php }?>
            $('#recordForm').submit();
        });
    });
    </script>
    <?php }?>
</body>

</html>