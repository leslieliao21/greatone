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
        case 'sort':{}
        case 'del':{ echo json_encode($response); break; }
        case 'edit':{}
        default:{ echo '<script>alert("not login");history.back();</script>'; break; }
    }
    exit;
}

$DB = new DB_CONN();

switch ($etype){
    case 'sort':{
        $id1 = isset($_POST['id1'])?FUNCS::inputFilter('id1','POST',1):0;
        $query = 'SELECT * FROM training WHERE id='.$id1;
        $result = $DB->select($query,false,$param_str,$param_ary);
        $sort1 = !empty($result['data'])?$result['data'][0]['sort']:0;
        
        $id2 = isset($_POST['id2'])?FUNCS::inputFilter('id2','POST',1):0;
        $query = 'SELECT * FROM training WHERE id='.$id2;
        $result = $DB->select($query,false,$param_str,$param_ary);
        $sort2 = !empty($result['data'])?$result['data'][0]['sort']:0;
        
        if($sort1 && $sort2){
            $edit_ary = array('sort=?');
            $param_ary = array($sort2);
            $param_str = 'i';
            $result = updateRecord('training','id='.$id1,$edit_ary,$param_ary,$param_str);
            
            $edit_ary = array('sort=?');
            $param_ary = array($sort1);
            $param_str = 'i';
            $result = updateRecord('training','id='.$id2,$edit_ary,$param_ary,$param_str);
            $response = $JSONMSG[200];
        }
        else
            $response = $JSONMSG[100];
        break;
    }
    case 'edit':{
        $id     = isset($_POST['id'])?FUNCS::inputFilter('id','POST',1):0;
        $year   = isset($_POST['year'])?FUNCS::inputFilter('year','POST',1):0;
        $type   = isset($_POST['type'])?FUNCS::inputFilter('type','POST',1):0;
        $title  = isset($_POST['title'])?FUNCS::inputFilter('title','POST',3):'';
        $location=isset($_POST['location'])?FUNCS::inputFilter('location','POST',3):'';
        $city   = isset($_POST['city'])?FUNCS::inputFilter('city','POST',3):'';
        $area   = isset($_POST['area'])?FUNCS::inputFilter('area','POST',3):'';
        $address= isset($_POST['address'])?FUNCS::inputFilter('address','POST',3):'';
        $descript=isset($_POST['descript'])?FUNCS::inputFilter('descript','POST',3):'';
        $sdate  = isset($_POST['sdate'])?FUNCS::inputFilter('sdate','POST',3):'';
        $edate  = isset($_POST['edate'])?FUNCS::inputFilter('edate','POST',3):'';
        $stime  = isset($_POST['stime'])?FUNCS::inputFilter('stime','POST',3):'';
        $etime  = isset($_POST['etime'])?FUNCS::inputFilter('etime','POST',3):'';
        $status = isset($_POST['status'])?FUNCS::inputFilter('status','POST',1):0;
        $e_msg  = '';
        
        if($id<=0){
            $edit_ary = array('year=?','type=?','title=?','location=?','city=?','area=?','address=?','descript=?','sdate=?','edate=?','stime=?','etime=?','status=?','sort=0','updatetime=NOW()');
            $param_ary = array($year,$type,$title,$location,$city,$area,$address,$descript,$sdate,$edate,$stime,$etime,$status);
            $param_str = 'iissssssssssi';
            $result = insertRecord('training',$edit_ary,$param_ary,$param_str);
            $id = $result['id'];
            
            $edit_ary = array('sort=?');
            $param_ary = array($id);
            $param_str = 'i';
            $result = updateRecord('training','id='.$id,$edit_ary,$param_ary,$param_str);
        }
        else{
            $edit_ary = array('year=?','type=?','title=?','location=?','city=?','area=?','address=?','descript=?','sdate=?','edate=?','stime=?','etime=?','status=?','updatetime=NOW()');
            $param_ary = array($year,$type,$title,$location,$city,$area,$address,$descript,$sdate,$edate,$stime,$etime,$status);
            $param_str = 'iissssssssssi';
            $result = updateRecord('training','id='.$id,$edit_ary,$param_ary,$param_str);
        }
        
        if($id<=0) $e_msg.= '沒有變更';
        
        echo '<script>';
        if($e_msg=='')
            echo 'alert("編輯成功");location.href="../traininglist.php";';
        else if($id>0)
            echo 'alert("'.$e_msg.'");location.href="../trainingedit.php?id='.$id.'";';
        else
            echo 'alert("'.$e_msg.'");history.back();';
        echo '</script>';
        exit;
        break;
    }
    case 'del':{
        $id = isset($_POST['id'])?FUNCS::inputFilter('id','POST',1):0;
        $result = trainingDelete($id);
        if($result['status']) $response = $JSONMSG[200];
        else $response = array_merge($JSONMSG[100],array('msg'=>$result['msg']));
        break;
    }
}

// response
echo json_encode($response);
?>