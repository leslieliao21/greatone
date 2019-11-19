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
        case 'review':{ echo json_encode($response); break; }
        default:{ echo '<script>alert("not login");history.back();</script>'; break; }
    }
    exit;
}

$DB = new DB_CONN();

switch ($etype){
    case 'review':{
        $id = isset($_POST['id'])?FUNCS::inputFilter('id','POST',1):0;
        $status = isset($_POST['status'])?FUNCS::inputFilter('status','POST',1):0;
        
        $result = trainingMemberList(array('id'=>$id),1);
        $rec = !empty($result)?$result[0]:array();
        
        $query = 'UPDATE trainingmember SET status=?,reviewtime=NOW() WHERE id=?';
        $result = $DB->update($query,'ii',array($status,$id));
        if($result['affected_rows']){
            $response = $JSONMSG[200];
            
            if(!empty($rec)){
                $result = teacherList(array('id'=>$rec['teid']),1);
                $teacher = !empty($result)?$result[0]:array();
                $training = $teacher['training']?explode(',',$teacher['training']):array();
            }
            if(!empty($teacher) && $status==2){
                $training[] = $rec['trid'];
                $query = 'UPDATE teacher SET training=? WHERE id=?';
                $DB->update($query,'si',array(join(',',$training),$rec['teid']));
            }
            else if(!empty($teacher)){
                $training = array_diff($training,array($rec['trid']));
                $query = 'UPDATE teacher SET training=? WHERE id=?';
                $DB->update($query,'si',array(join(',',$training),$rec['teid']));
            }
        }
        else $response = array_merge($JSONMSG[100],array('msg'=>$result['msg']));
        break;
    }
}

// response
echo json_encode($response);
?>