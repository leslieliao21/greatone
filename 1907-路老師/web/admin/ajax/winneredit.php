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
        $aid    = isset($_POST['aid'])?FUNCS::inputFilter('aid','POST',1):0;
        $tid    = isset($_POST['tid'])?FUNCS::inputFilter('tid','POST',1):0;
        $e_msg  = '';
        
        $result = teacherList(array('id'=>$tid),1);
        $rec = !empty($result)?$result[0]:array();
        if(empty($rec)){
            echo '<script>alert("查無得獎人");history.back();</script>';
            exit;
            break;
        }
        
        if($id<=0){
            $edit_ary = array('aid=?','tid=?','name=?','gender=?','birthday=?','account=?','city=?','area=?','updatetime=NOW()');
            $param_ary = array($aid,$tid,$rec['name'],$rec['gender'],$rec['birthday'],$rec['account'],$rec['city'],$rec['area']);
            $param_str = 'iisissss';
            $result = insertRecord('winner',$edit_ary,$param_ary,$param_str);
            $id = $result['id'];
        }
        else{
            $edit_ary = array('aid=?','tid=?','name=?','gender=?','birthday=?','account=?','city=?','area=?','updatetime=NOW()');
            $param_ary = array($aid,$tid,$rec['name'],$rec['gender'],$rec['birthday'],$rec['account'],$rec['city'],$rec['area']);
            $param_str = 'iisissss';
            $result = updateRecord('winner','id='.$id,$edit_ary,$param_ary,$param_str);
        }
        
        if($id<=0) $e_msg.= '沒有變更';
        
        echo '<script>';
        if($e_msg=='')
            echo 'alert("編輯成功");location.href="../winnerlist.php";';
        else if($id>0)
            echo 'alert("'.$e_msg.'");location.href="../winneredit.php?id='.$id.'";';
        else
            echo 'alert("'.$e_msg.'");history.back();';
        echo '</script>';
        exit;
        break;
    }
    case 'del':{
        $id = isset($_POST['id'])?FUNCS::inputFilter('id','POST',1):0;
        $result = deleteRecord('winner','id='.$id);
        if($result['status']) $response = $JSONMSG[200];
        else $response = array_merge($JSONMSG[100],array('msg'=>$result['msg']));
        break;
    }
}

// response
echo json_encode($response);
?>