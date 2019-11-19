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

$id = isset($rec['id'])?filter_var($rec['id'],FILTER_SANITIZE_NUMBER_INT):0;
$status = 0;

$result = speachList(array('tid'=>$member['id'],'id'=>$id),1);
if(!empty($result) && in_array($result[0]['status'],array(-1,2))){
    $edit_ary = array('status=?','updatetime=NOW()');
    $param_ary = array($status);
    $param_str = 'i';
    $result = updateRecord('speach','id='.$id,$edit_ary,$param_ary,$param_str);
}
else $e_msg.= 'not found';

echo '<script>';
if($e_msg=='')
    echo 'alert("編輯成功");location.href="../member_affairs.php";';
else if($id>0)
    echo 'alert("'.$e_msg.'");location.href="../member_affairs_recordinfo.php?id='.$id.'";';
else
    echo 'alert("'.$e_msg.'");history.back();';
echo '</script>';