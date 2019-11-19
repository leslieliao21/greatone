<?php 
require_once '../php.lib/config.php';
require_once '../php.lib/main.php';
require_once '../php.lib/functions.php';
require_once '../php.lib/mysqli_class.php';
$DB = new DB_CONN();
$acc = isset($_POST['account'])?FUNCS::inputFilter('account','POST',3):'';
$result = teacherList(array('accountEqual'=>$acc),1);
if(!empty($result)){
    //密碼設回預設狀態(即手機號碼)，並用簡訊傳送
    $rec = $result[0];
    $msg = '已將密碼設回預設狀態(即手機號碼),請重新登入後修改密碼';
    $npsw = sha1($rec['account']);
    $result = setMessageToPhone($rec['account'],$msg);
    if(strpos($result,'statuscode=1')!==false){
        $result = updateRecord('teacher','id='.$rec['id'],array('password=?'),array($npsw),'s');
        echo '<script>alert("已將新密碼傳送至註冊手機");location.href="../signin.php";</script>';
    }
    else{
        echo '<script>alert("密碼重設失敗");location.href="../signin.php";</script>';
    }
}
else{
    echo '<script>alert("查無該帳號");history.back();location.href="../signin.php";</script>';
}
?>
