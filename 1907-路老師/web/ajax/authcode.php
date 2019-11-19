<?php 
require_once '../php.lib/config.php';
require_once '../php.lib/main.php';
require_once '../php.lib/functions.php';
require_once '../php.lib/mysqli_class.php';

$DB = new DB_CONN();
$response = $JSONMSG[100];
$acc = isset($_POST['account'])?FUNCS::inputFilter('account','POST',3):'';

$result = teacherList(array('accountEqual'=>$acc),1);
if(empty($result)){
    //驗證碼，共5碼數字
    $_SESSION[WEBX.'Auth'] = substr('0000'.rand(0,99999),-5);
    $_SESSION[WEBX.'AuthTime'] = time();
    $msg = '感謝您加入路老師的大家庭，您的帳號註冊簡訊認證碼為「'.$_SESSION[WEBX.'Auth'].'」，認證碼5分鐘內有效。';
    $result = setMessageToPhone($acc,$msg);
    if(strpos($result,'statuscode=1')!==false){
        $response = $JSONMSG[200];
    }
    else{
        $response['msg'] = '驗證碼發送失敗';
    }
}
else{
    $response['msg'] = '該帳號已被註冊過';
}

// response
echo json_encode($response);
?>
