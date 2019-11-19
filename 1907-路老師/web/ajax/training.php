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

$result = teacherList(array('id'=>$member['id']),1);
$info = !empty($result)?$result[0]:array();

$trid = isset($_POST['id'])?FUNCS::inputFilter('id','POST',1):0;
$dinning = isset($_POST['vegeOption'])?FUNCS::inputFilter('vegeOption','POST',1):0;

$result = trainingList(array('status'=>1,'id'=>$trid),1);
$rec = !empty($result)?$result[0]:array();

if(empty($rec) || ($member['qualify']!=1&&$rec['type']==2)){
    echo '<script>alert("報名資格不符合");history.back();</script>';
    exit;
}

if($rec['sdate']<=date('Y-m-d')){
    echo '<script>alert("報名時間已過");history.back();</script>';
    exit;
}

$c = trainingMemberCount(array('trid'=>$trid,'teid'=>$member['id']));
if($c){
    echo '<script>alert("已在培訓名單之內");history.back();</script>';
    exit;
}

$edit_ary = array('trid=?','teid=?','account=?','name=?','gender=?','birthday=?','city=?','area=?','email=?','lineid=?','phone=?','language=?','career=?','transportation=?','service=?','license_bike=?','license_car=?','qualify=?','dinning=?','status=0','reviewtime=0','updatetime=NOW()');
$param_ary = array($trid,$info['id'],$info['account'],$info['name'],$info['gender'],$info['birthday'],$info['city'],$info['area'],$info['email'],$info['lineid'],$info['phone'],$info['language'],$info['career'],$info['transportation'],$info['service'],$info['license_bike'],$info['license_car'],$info['qualify'],$dinning);
$param_str = 'iississssssssssiiii';
$result = insertRecord('trainingmember',$edit_ary,$param_ary,$param_str);
$id = $result['id'];

if($id<=0) $e_msg.= '報名失敗';

echo '<script>';
if($e_msg=='')
    echo 'alert("報名成功");location.href="../member_apply_success.php?id='.$id.'";';
else
    echo 'alert("'.$e_msg.'");history.back();';
echo '</script>';