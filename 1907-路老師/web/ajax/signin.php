<?php 
require_once '../php.lib/config.php';
require_once '../php.lib/main.php';
require_once '../php.lib/functions.php';
require_once '../php.lib/mysqli_class.php';
$DB = new DB_CONN();
$acc = isset($_POST['account'])?FUNCS::inputFilter('account','POST',3):'';
$psw = isset($_POST['psw'])?FUNCS::inputFilter('psw','POST',3):'';
$result = memberLogin($acc,$psw);
if(!$result['status'])
    echo '<script>alert("'.$result['msg'].'");history.back();</script>';
else{
    $departLogin = departLoginChk();
    if($departLogin['status']){
        unset($_SESSION[WEBX.'Dep']);
        echo '<script>alert("您已登入路老師專區，您的路老師需求單位帳號已被登出。");</script>';
    }
    if($result['status']==2)
        echo '<script>location.href="../member_info.php";</script>';
    else
        echo '<script>location.href="../member.php";</script>';
}
?>
