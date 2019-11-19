<?php 
require_once '../php.lib/config.php';
require_once '../php.lib/main.php';
require_once '../php.lib/functions.php';
require_once '../php.lib/mysqli_class.php';
$DB = new DB_CONN();
$memberLogin = memberLoginChk();
if(!$memberLogin['status']){
    header('Location:../signin.php');
    exit;
}
$member = $_SESSION[WEBX.'Mem'];
if(!in_array($member['qualify'],array(1,2))){
    header('Location:../member.php');
    exit;
}
$result = teacherList(array('id'=>$member['id']),1);
$info = !empty($result)?$result[0]:array();

$rec = isset($_POST['rec'])?json_decode(urldecode($_POST['rec']),true):array();
if(empty($rec)){
    echo '<script>alert("error");history.back();</script>';
    exit;
}

$record = isset($_GET['record'])&&$_GET['record']==1?true:false;

$id = isset($rec['id'])?filter_var($rec['id'],FILTER_SANITIZE_NUMBER_INT):0;
$audience = isset($rec['audience'])?filter_var($rec['audience'],FILTER_SANITIZE_SPECIAL_CHARS):'';
$city = isset($rec['city'])?filter_var($rec['city'],FILTER_SANITIZE_SPECIAL_CHARS):0;
$area = isset($rec['area'])?filter_var($rec['area'],FILTER_SANITIZE_SPECIAL_CHARS):0;
$title = isset($rec['title'])?filter_var($rec['title'],FILTER_SANITIZE_SPECIAL_CHARS):'';
$tid = $info['id'];
$name = $info['name'];
$account = $info['account'];
$minutes = isset($rec['minutes'])?filter_var($rec['minutes'],FILTER_SANITIZE_NUMBER_INT):0;
$attends = isset($rec['attends'])?filter_var($rec['attends'],FILTER_SANITIZE_NUMBER_INT):0;
$benefit = isset($rec['benefit'])?filter_var($rec['benefit'],FILTER_SANITIZE_SPECIAL_CHARS):'';
$feedback = isset($rec['feedback'])?filter_var($rec['feedback'],FILTER_SANITIZE_SPECIAL_CHARS):'';
$evaluation = isset($rec['evaluation'])?filter_var($rec['evaluation'],FILTER_SANITIZE_SPECIAL_CHARS):'';
$speachdate = isset($rec['speachdate'])?filter_var($rec['speachdate'],FILTER_SANITIZE_SPECIAL_CHARS):'';
$recommend = '';
$reviewtime = '0000-00-00 00:00:00';
$status = -1;
$e_msg = '';

$plans = array();
if(!empty($rec['plans'])){
    foreach($rec['plans'] as $k=>$d){
        $plan = filter_var($rec['plans'][$k],FILTER_SANITIZE_SPECIAL_CHARS);
        if($plan && $plan!='其它')
            $plans[] = $plan;
    }
}

$pictures = array();
if(!empty($rec['pictures'])){
    $teacher = isset($rec['pictures']['teacher'])?filter_var($rec['pictures']['teacher'],FILTER_SANITIZE_SPECIAL_CHARS):'';
    $teacher_desc = isset($rec['pictures']['teacher_desc'])?filter_var($rec['pictures']['teacher_desc'],FILTER_SANITIZE_SPECIAL_CHARS):'';
    if($teacher){
        $pictures['teacher'] = $teacher;
        $pictures['teacher_desc'] = $teacher_desc;
    }
    
    $group = isset($rec['pictures']['group'])?filter_var($rec['pictures']['group'],FILTER_SANITIZE_SPECIAL_CHARS):'';
    $group_desc = isset($rec['pictures']['group_desc'])?filter_var($rec['pictures']['group_desc'],FILTER_SANITIZE_SPECIAL_CHARS):'';
    if($teacher){
        $pictures['group'] = $group;
        $pictures['group_desc'] = $group_desc;
    }
    
    foreach($rec['pictures']['scene'] as $k=>$d){
        $scene = isset($rec['pictures']['scene'][$k])?filter_var($rec['pictures']['scene'][$k],FILTER_SANITIZE_SPECIAL_CHARS):'';
        $scene_desc = isset($rec['pictures']['scene_desc'][$k])?filter_var($rec['pictures']['scene_desc'][$k],FILTER_SANITIZE_SPECIAL_CHARS):'';
        
        if($scene){
            $pictures['scene'] = isset($pictures['scene'])?$pictures['scene']:array();
            $pictures['scene'][] = $scene;
            $pictures['scene_desc'] = isset($pictures['scene_desc'])?$pictures['scene_desc']:array();
            $pictures['scene_desc'][] = $scene_desc;
        }
    }
}

$result = speachList(array('tid'=>$member['id'],'id'=>$id),1);
if($id>0 && !empty($result) && in_array($result[0]['status'],array(-1,2))){
    // tid 符合 且 狀態為草稿或退件
    $edit_ary = array('plan=?','audience=?','city=?','area=?','title=?','minutes=?','attends=?','benefit=?','feedback=?','evaluation=?','pictures=?','speachdate=?','status=?','updatetime=NOW()');
    $param_ary = array(join(',',$plans),$audience,$city,$area,$title,$minutes,$attends,$benefit,$feedback,$evaluation,json_encode($pictures),$speachdate,$status);
    $param_str = 'sssssiisssssi';
    $result = updateRecord('speach','id='.$id,$edit_ary,$param_ary,$param_str);
}
else if($id<=0){
    // 新件
    $status = $record?0:$status; // 存為草稿或直接送審
    $edit_ary = array('plan=?','audience=?','city=?','area=?','title=?','tid=?','name=?','account=?','minutes=?','attends=?','benefit=?','feedback=?','evaluation=?','pictures=?','recommend=?','speachdate=?','reviewtime=?','status=?','updatetime=NOW()');
    $param_ary = array(join(',',$plans),$audience,$city,$area,$title,$tid,$name,$account,$minutes,$attends,$benefit,$feedback,$evaluation,json_encode($pictures),$recommend,$speachdate,$reviewtime,$status);
    $param_str = 'sssssissiisssssssi';
    $result = insertRecord('speach',$edit_ary,$param_ary,$param_str);
    $id = $result['id'];
}
else $e_msg.= 'not found';

if($id<=0) $e_msg.= '沒有變更';

echo '<script>';
if($e_msg=='')
    echo 'alert("編輯成功");location.href="../member_affairs.php";';
else if($id>0)
    echo 'alert("'.$e_msg.'");location.href="../member_affairs_recordinfo.php?id='.$id.'";';
else
    echo 'alert("'.$e_msg.'");history.back();';
echo '</script>';