<?php 
require_once '../../php.lib/config.php';
require_once '../../php.lib/main.php';
require_once '../../php.lib/functions.php';
require_once '../../php.lib/mysqli_class.php';
ini_set('display_errors',true);

$response = $JSONMSG[550];

// login check
$etype = isset($_POST['etype'])?FUNCS::inputFilter('etype','POST',3):'';
$result = loginChk();
if(!$result['status']){
    switch($etype){
        case 'edit':{}
        default:{ echo '<script>alert("not login");history.back();</script>'; break; }
    }
    exit;
}

$DB = new DB_CONN();

switch ($etype){
    case 'edit':{
        $e_msg  = '';
        $edit_ary = array('status=0');
        updateRecord('teachersearch','1=1',$edit_ary);
        foreach($_POST['rec'] as $k=>$d){
            $id = filter_var($d,FILTER_SANITIZE_NUMBER_INT);
            if($id<=0) continue;
            $edit_ary = array('status=1');
            updateRecord('teachersearch','id='.$id,$edit_ary);
        }
        
        echo '<script>';
        if($e_msg=='')
            echo 'alert("編輯成功");location.href="../teachersearch.php";';
        else
            echo 'alert("'.$e_msg.'");history.back();';
        echo '</script>';
        exit;
        break;
    }
}

// response
echo json_encode($response);
?>