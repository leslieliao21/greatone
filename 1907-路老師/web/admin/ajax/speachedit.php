<?php 
require_once '../../php.lib/config.php';
require_once '../../php.lib/main.php';
require_once '../../php.lib/functions.php';
require_once '../../php.lib/mysqli_class.php';
require_once '../../php.lib/imgOutput.php';

$response = $JSONMSG[550];

// login check
$etype = isset($_POST['etype'])?FUNCS::inputFilter('etype','POST',3):'';
$result = loginChk();
if(!$result['status']){
    switch($etype){
        case 'del':{ echo json_encode($response); break; }
        case 'edit':{}
        default:{ echo '<script>alert("not login");history.back();</script>'; break; }
    }
    exit;
}

$DB = new DB_CONN();

switch ($etype){
    case 'edit':{
        $id     = isset($_POST['id'])?FUNCS::inputFilter('id','POST',1):0;
        $recommend=isset($_POST['recommend'])?FUNCS::inputFilter('recommend','POST',3):'';
        $status = isset($_POST['status'])?FUNCS::inputFilter('status','POST',1):0;
        $e_msg  = '';
        
        $result = speachList(array('id'=>$id),1);
        $rec = !empty($result)?$result[0]:array();
        if(empty($rec)){
            $e_msg.= 'not found';
        }
        else{
            $edit_ary = array('recommend=?','status=?','reviewtime=NOW()');
            $param_ary = array($recommend,$status);
            $param_str = 'si';
            $result = updateRecord('speach','id='.$id,$edit_ary,$param_ary,$param_str);
            
            $count = speachCount(array('tid'=>$rec['tid'],'status'=>1));
            updateRecord('teacher','id='.$rec['tid'],array('speach=?'),array($count),'i');
        }
        
        if($id<=0) $e_msg.= '沒有變更';
        
        echo '<script>';
        if($e_msg=='')
            echo 'alert("編輯成功");location.href="../speachlist.php";';
        else
            echo 'alert("'.$e_msg.'");history.back();';
        echo '</script>';
        exit;
        break;
    }
    case 'del':{
        $id = isset($_POST['id'])?FUNCS::inputFilter('id','POST',1):0;
        $result = speachDelete($id);
        if($result['status']) $response = $JSONMSG[200];
        else $response = array_merge($JSONMSG[100],array('msg'=>$result['msg']));
        break;
    }
}

// response
echo json_encode($response);
?>