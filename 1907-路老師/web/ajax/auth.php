<?php 
require_once '../php.lib/config.php';
require_once '../php.lib/main.php';
require_once '../php.lib/functions.php';
require_once '../php.lib/mysqli_class.php';

$DB = new DB_CONN();
$response = $JSONMSG[100];
$acc = isset($_POST['account'])?FUNCS::inputFilter('account','POST',3):'';
$code = isset($_POST['code'])?FUNCS::inputFilter('code','POST',3):'';

$result = teacherList(array('accountEqual'=>$acc),1);
if(!empty($result)){
    $response['msg'] = '該帳號已被註冊過';
}
else if(isset($_SESSION[WEBX.'Auth']) && $_SESSION[WEBX.'Auth']==$code){
    if(time()-$_SESSION[WEBX.'AuthTime']>300)
        $response['msg'] = '驗證碼已過期';
    else
        $response = $JSONMSG[200];
}
else{
    $response['msg'] = '驗證碼錯誤';
}

// response
echo json_encode($response);
?>
