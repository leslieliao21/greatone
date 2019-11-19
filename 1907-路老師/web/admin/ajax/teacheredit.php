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
        $account= isset($_POST['account'])?FUNCS::inputFilter('account','POST',3):'';
        $password=isset($_POST['password'])?FUNCS::inputFilter('password','POST',3):'';
        $name   = isset($_POST['name'])?FUNCS::inputFilter('name','POST',3):'';
        $gender = isset($_POST['gender'])?FUNCS::inputFilter('gender','POST',1):0;
        $birthday=isset($_POST['birthday'])?FUNCS::inputFilter('birthday','POST',3):'';
        $city   = isset($_POST['city'])?FUNCS::inputFilter('city','POST',3):'';
        $area   = isset($_POST['area'])?FUNCS::inputFilter('area','POST',3):'';
        $email  = isset($_POST['email'])?FUNCS::inputFilter('email','POST',3):'';
        $lineid = isset($_POST['lineid'])?FUNCS::inputFilter('lineid','POST',3):'';
        $service= isset($_POST['service'])?FUNCS::inputFilter('service','POST',3):'';
        $license_bike = isset($_POST['license_bike'])?FUNCS::inputFilter('license_bike','POST',1):0;
        $license_car = isset($_POST['license_car'])?FUNCS::inputFilter('license_car','POST',1):0;
        $qualify= isset($_POST['qualify'])?FUNCS::inputFilter('qualify','POST',1):0;
        $year   = isset($_POST['year'])?FUNCS::inputFilter('year','POST',3):'';
        $status = isset($_POST['status'])?FUNCS::inputFilter('status','POST',1):0;
        $e_msg  = '';
        
        $code = isset($_POST['code'])?FUNCS::inputFilter('code','POST',3):'';
        $_phone = isset($_POST['phone'])?FUNCS::inputFilter('phone','POST',3):'';
        $phone = $code&&$_phone?$code.'-'.$_phone:'';
        
        $career_else = isset($_POST['career_else'])?FUNCS::inputFilter('career_else','POST',3):'';
        $career = isset($_POST['career'])?FUNCS::inputFilter('career','POST',3):'';
        $career = $career=='其它'?$career_else:$career;
        
        $language = array();
        $lang_else = isset($_POST['lang_else'])?FUNCS::inputFilter('lang_else','POST',3):'';
        if(!empty($_POST['language'])){
            foreach($_POST['language'] as $k=>$d){
                $lang = filter_var($d,FILTER_SANITIZE_SPECIAL_CHARS);
                if($lang!='其它')
                    $language[] = $lang;
            }
        }
        $else = $lang_else?explode(',',$lang_else):array();
        $language = array_merge($language,$else);
        
        $transportation = array();
        $trans_else = isset($_POST['trans_else'])?FUNCS::inputFilter('trans_else','POST',3):'';
        if(!empty($_POST['transportation'])){
            foreach($_POST['transportation'] as $k=>$d){
                $trans = filter_var($d,FILTER_SANITIZE_SPECIAL_CHARS);
                if($trans!='其它')
                    $transportation[] = $trans;
            }
        }
        $else = $trans_else?explode(',',$trans_else):array();
        $transportation = array_merge($transportation,$else);
        
        $year = $qualify==1?$year:'';
        
        $rec = teacherList(array('accountEqual'=>$account),1);
        if(!empty($rec)&&$rec[0]['id']!=$id){
            $e_msg.= '帳號重複';
        }
        else if($id<=0){
            $edit_ary = array('account=?','password=?','name=?','gender=?','birthday=?','city=?','area=?','email=?','lineid=?','phone=?','language=?','career=?','transportation=?','service=?','license_bike=?','license_car=?','qualify=?','year=?','status=?','training=""','speach=0','imp=0','enabletime=0','logintime=0','updatetime=NOW()');
            $param_ary = array($account,$password,$name,$gender,$birthday,$city,$area,$email,$lineid,$phone,join(',',$language),$career,join(',',$transportation),$service,$license_bike,$license_car,$qualify,$year,$status);
            $param_str = 'sssissssssssssssisi';
            $result = insertRecord('teacher',$edit_ary,$param_ary,$param_str);
            $id = $result['id'];
        }
        else{
            $edit_ary = array('account=?','name=?','gender=?','birthday=?','city=?','area=?','email=?','lineid=?','phone=?','language=?','career=?','transportation=?','service=?','license_bike=?','license_car=?','qualify=?','year=?','status=?','updatetime=NOW()');
            $param_ary = array($account,$name,$gender,$birthday,$city,$area,$email,$lineid,$phone,join(',',$language),$career,join(',',$transportation),$service,$license_bike,$license_car,$qualify,$year,$status);
            $param_str = 'ssissssssssssssisi';
            
            if($password){
                $edit_ary[] = 'password=?';
                $param_ary[] = $password;
                $param_str .= 's';
            }
            
            $result = updateRecord('teacher','id='.$id,$edit_ary,$param_ary,$param_str);
        }
        
        if($id<=0) $e_msg.= '沒有變更';
        
        echo '<script>';
        if($e_msg=='')
            echo 'alert("編輯成功");location.href="../teacherlist.php";';
        else if($id>0)
            echo 'alert("'.$e_msg.'");location.href="../teacheredit.php?id='.$id.'";';
        else
            echo 'alert("'.$e_msg.'");history.back();';
        echo '</script>';
        exit;
        break;
    }
    case 'del':{
        $id = isset($_POST['id'])?FUNCS::inputFilter('id','POST',1):0;
        $result = teacherDelete($id);
        if($result['status']) $response = $JSONMSG[200];
        else $response = array_merge($JSONMSG[100],array('msg'=>$result['msg']));
        break;
    }
}

// response
echo json_encode($response);
?>