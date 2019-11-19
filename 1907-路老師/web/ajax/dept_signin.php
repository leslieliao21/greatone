<?php 
require_once '../php.lib/config.php';
require_once '../php.lib/main.php';
require_once '../php.lib/functions.php';
require_once '../php.lib/mysqli_class.php';
$DB = new DB_CONN();
$acc = isset($_POST['account'])?FUNCS::inputFilter('account','POST',3):'';
$psw = isset($_POST['psw'])?FUNCS::inputFilter('psw','POST',3):'';
$result = departLogin($acc,$psw);
if(!$result['status'])
    echo '<script>alert("'.$result['msg'].'");history.back();</script>';
else{
    $memberLogin = memberLoginChk();
    if($memberLogin['status']){
        unset($_SESSION[WEBX.'Mem']);
        echo '<script>alert("您已登入我要找路老師專區，你的路老師帳號已被登出。");</script>';
    }
    echo '<script>location.href="../dept_info.php";</script>';
}
?>
