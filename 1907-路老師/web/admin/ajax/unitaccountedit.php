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
        $uid    = isset($_POST['uid'])?FUNCS::inputFilter('uid','POST',1):0;
        $suid   = isset($_POST['suid'])?FUNCS::inputFilter('suid','POST',1):0;
        $account= isset($_POST['account'])?FUNCS::inputFilter('account','POST',3):'';
        $password=isset($_POST['password'])?FUNCS::inputFilter('password','POST',3):'';
        $name   = isset($_POST['name'])?FUNCS::inputFilter('name','POST',3):'';
        $phone  = isset($_POST['phone'])?FUNCS::inputFilter('phone','POST',3):'';
        $status = isset($_POST['status'])?FUNCS::inputFilter('status','POST',1):0;
        $e_msg  = '';
        
        $query = 'SELECT * FROM unitaccount WHERE account=? AND id!=?';
        $result = $DB->select($query,false,'si',array($account,$id));
        if(!empty($result['data'])){
            $e_msg = '帳號重複';
            echo '<script>';
            echo 'alert("'.$e_msg.'");history.back();';
            echo '</script>';
            exit;
            break;
        }
        
        if($id<=0){
            $edit_ary = array('uid=?','suid=?','account=?','password=?','name=?','phone=?','status=?','updatetime=NOW()');
            $param_ary = array($uid,$suid,$account,$password,$name,$phone,$status);
            $param_str = 'iissssi';
            $result = insertRecord('unitaccount',$edit_ary,$param_ary,$param_str);
            $id = $result['id'];
            
            $edit_ary = array('sort=?');
            $param_ary = array($id);
            $param_str = 'i';
            $result = updateRecord('unitaccount','id='.$id,$edit_ary,$param_ary,$param_str);
        }
        else{
            $edit_ary = array('uid=?','suid=?','account=?','name=?','phone=?','status=?','updatetime=NOW()');
            $param_ary = array($uid,$suid,$account,$name,$phone,$status);
            $param_str = 'iisssi';
            
            if($password!=''){
                $edit_ary[] = 'password=?';
                $param_ary[] = $password;
                $param_str .= 's';
            }
            
            $result = updateRecord('unitaccount','id='.$id,$edit_ary,$param_ary,$param_str);
        }
        
        if($id<=0) $e_msg.= '沒有變更';
        
        echo '<script>';
        if($e_msg=='')
            echo 'alert("編輯成功");location.href="../unitaccountlist.php";';
        else if($id>0)
            echo 'alert("'.$e_msg.'");location.href="../unitaccountedit.php?id='.$id.'";';
        else
            echo 'alert("'.$e_msg.'");history.back();';
        echo '</script>';
        exit;
        break;
    }
    case 'del':{
        $id = isset($_POST['id'])?FUNCS::inputFilter('id','POST',1):0;
        $result = deleteRecord('unitaccount','id='.$id);
        if($result['status']) $response = $JSONMSG[200];
        else $response = array_merge($JSONMSG[100],array('msg'=>$result['msg']));
        break;
    }
}

// response
echo json_encode($response);
?>