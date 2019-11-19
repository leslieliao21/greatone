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
$account = isset($_POST['account'])?FUNCS::inputFilter('account','POST',3):'';
$e_msg = '';

$rec = teacherList(array('accountEqual'=>$account),1);
if(!empty($rec)){
    $e_msg.= '帳號重複';
}
else{
    $result = updateRecord('teacher','id='.$member['id'],array('account=?','password=?','updatetime=NOW()'),array($account,sha1($account)),'ss');
    if($result['status'])
        unset($_SESSION[WEBX.'Mem']);
    else
        $e_msg = $result['msg'];
}

echo '<script>';
if($e_msg=='')
    echo 'location.href="../member_info_edit_account_step2.php";';
else
    echo 'alert("'.$e_msg.'");history.back();';
echo '</script>';
?>
