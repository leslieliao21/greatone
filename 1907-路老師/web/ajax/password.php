<?php
require_once '../php.lib/config.php';
require_once '../php.lib/main.php';
require_once '../php.lib/functions.php';
require_once '../php.lib/mysqli_class.php';
$DB = new DB_CONN();
$response = $JSONMSG[550];
$memberLogin = memberLoginChk();
if(!$memberLogin['status']){
    echo json_encode($response);
    //header('Location:../signin.php');
    exit;
}
$member = $_SESSION[WEBX.'Mem'];

// set data
$etype = isset($_POST['etype'])?FUNCS::inputFilter('etype','POST',3):'';

switch($etype){
    case 'chk':{
        $psw = isset($_POST['psw'])?FUNCS::inputFilter('psw','POST',3):'';
        $result = teacherList(array('id'=>$member['id']),1);
        $response = empty($result)||$result[0]['password']!=$psw?$JSONMSG[100]:$JSONMSG[200];
        break;
    }
    case 'edit':{
        $opsw = isset($_POST['opsw'])?FUNCS::inputFilter('opsw','POST',3):'';
        $npsw = isset($_POST['npsw'])?FUNCS::inputFilter('npsw','POST',3):'';
        $result = teacherList(array('id'=>$member['id']),1);
        if(empty($result)||$result[0]['password']!=$opsw){
            echo '<script>alert("舊密碼不正確，請重新輸入");history.back();</script>';
            exit;
        }
        else{
            $result = updateRecord('teacher','id='.$member['id'],array('password=?','updatetime=NOW()'),array($npsw),'s');
            if($result['status']){
                unset($_SESSION[WEBX.'Mem']);
                echo '<script>alert("更新成功");location.href="../signin.php";</script>';
                exit;
            }
            else{
                echo '<script>alert("'.$result['msg'].'");history.back();</script>';
                exit;
            }
        }
        break;
    }
    default:{$response = $JSONMSG[209];}
}

// response
echo json_encode($response);
?>