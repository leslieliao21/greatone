<?php
require_once '../../php.lib/config.php';
require_once '../../php.lib/main.php';
require_once '../../php.lib/functions.php';
require_once '../../php.lib/mysqli_class.php';

$response = $JSONMSG[550];

// login check
$result = loginChk();
if(!$result['status']){ echo json_encode($response); exit; }
$DB = new DB_CONN();

// set data
$etype = isset($_POST['etype'])?FUNCS::inputFilter('etype','POST',3):'';

switch($etype){
    case 'chk':{
        $psw = isset($_POST['psw'])?FUNCS::inputFilter('psw','POST',3):'';
        $query = 'SELECT * FROM admin WHERE id=? AND status=1';
        $result = $DB->select($query,false,'i',array($_SESSION[WEBX.'Adm']['user_id']));
        $rec = $result['data'][0];
        $response = $rec['password']!=$psw?$JSONMSG[100]:$JSONMSG[200];
        break;
    }
    case 'edit':{
        $param = array(
            'id'        => $_SESSION[WEBX.'Adm']['user_id'],
            'opsw'      => isset($_POST['old'])?FUNCS::inputFilter('old','POST',3):'',
            'password'  => isset($_POST['new'])?FUNCS::inputFilter('new','POST',3):''
        );
        $result = editPsw($param);
        if($result['status']){
            echo '<script>alert("更新成功");location.href="../logout.php";</script>';
            exit;
        }
        else{
            $response['data'] = $result;
        }
        break;
    }
    default:{$response = $JSONMSG[209];}
}

// response
echo json_encode($response);
?>