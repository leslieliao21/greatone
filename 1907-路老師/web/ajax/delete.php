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
$e_msg = '';

if($id){
    $result = speachDelete($id);
    $e_msg .= $result['status']?'':$result['msg'];
}

echo '<script>';
if($e_msg=='')
    echo 'alert("刪除成功");location.href="../member_affairs.php";';
else
    echo 'alert("'.$e_msg.'");history.back();';
echo '</script>';