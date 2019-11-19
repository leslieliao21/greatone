<?php 
require_once '../php.lib/config.php';
require_once '../php.lib/main.php';
require_once '../php.lib/functions.php';
require_once '../php.lib/mysqli_class.php';

$DB = new DB_CONN();

$id = 0;
$account = isset($_POST['account'])?FUNCS::inputFilter('account','POST',3):'';
$password = isset($_POST['psw'])?FUNCS::inputFilter('psw','POST',3):'';
$name = isset($_POST['name'])?FUNCS::inputFilter('name','POST',3):'';
$gender = isset($_POST['gender'])?FUNCS::inputFilter('gender','POST',1):0;
$city = isset($_POST['city'])?FUNCS::inputFilter('city','POST',3):'';
$area = isset($_POST['area'])?FUNCS::inputFilter('area','POST',3):'';
$email = isset($_POST['email'])?FUNCS::inputFilter('email','POST',3):'';
$service = isset($_POST['service'])?FUNCS::inputFilter('service','POST',3):'';
$license_bike = isset($_POST['license_bike'])?FUNCS::inputFilter('license_bike','POST',1):0;
$license_car = isset($_POST['license_car'])?FUNCS::inputFilter('license_car','POST',1):0;
$qualify = 3;
$year = '';
$status = 2;
$e_msg = '';

$y = isset($_POST['year'])?FUNCS::inputFilter('year','POST',1):0;
$m = isset($_POST['month'])?FUNCS::inputFilter('month','POST',1):0;
$d = isset($_POST['date'])?FUNCS::inputFilter('date','POST',1):0;
$birthday = date('Y-m-d',strtotime($y.'-'.$m.'-'.$d));

$lineOption = isset($_POST['lineOption'])?FUNCS::inputFilter('lineOption','POST',1):0;
$lineid = $lineOption&&isset($_POST['lineid'])?FUNCS::inputFilter('lineid','POST',3):'';

$code = isset($_POST['code'])?FUNCS::inputFilter('code','POST',3):'';
$_phone = isset($_POST['phone'])?FUNCS::inputFilter('phone','POST',3):'';
$phone = $code&&$_phone?$code.'-'.$_phone:'';

$career_else = isset($_POST['career_else'])?FUNCS::inputFilter('career_else','POST',3):'';
$career = isset($_POST['career'])?FUNCS::inputFilter('career','POST',3):'';
$career = $career=='其它'?$career_else:$career;

$language = array();
$lang_else = isset($_POST['lang_else'])?FUNCS::inputFilter('lang_else','POST',3):'';
if(!empty($_POST['langOption'])){
    foreach($_POST['langOption'] as $k=>$d){
        $lang = filter_var($d,FILTER_SANITIZE_SPECIAL_CHARS);
        if($lang!='其它')
            $language[] = $lang;
    }
}
$else = $lang_else?explode(',',$lang_else):array();
$language = array_merge($language,$else);

$transportation = array();
$trans_else = isset($_POST['trans_else'])?FUNCS::inputFilter('trans_else','POST',3):'';
if(!empty($_POST['transportOption'])){
    foreach($_POST['transportOption'] as $k=>$d){
        $trans = filter_var($d,FILTER_SANITIZE_SPECIAL_CHARS);
        if($trans!='其它')
            $transportation[] = $trans;
    }
}
$else = $trans_else?explode(',',$trans_else):array();
$transportation = array_merge($transportation,$else);

$rec = teacherList(array('accountEqual'=>$account),1);
if(!empty($rec)){
    $e_msg.= '帳號重複';
}
else{
    $edit_ary = array('account=?','password=?','name=?','gender=?','birthday=?','city=?','area=?','email=?','lineid=?','phone=?','language=?','career=?','transportation=?','service=?','license_bike=?','license_car=?','qualify=?','year=?','status=?','training=""','speach=0','imp=0','enabletime=0','logintime=0','updatetime=NOW()');
    $param_ary = array($account,$password,$name,$gender,$birthday,$city,$area,$email,$lineid,$phone,join(',',$language),$career,join(',',$transportation),$service,$license_bike,$license_car,$qualify,$year,$status);
    $param_str = 'sssissssssssssssisi';
    $result = insertRecord('teacher',$edit_ary,$param_ary,$param_str);
    $id = $result['id'];
}

if($id<=0) $e_msg.= '沒有變更';

echo '<script>';
if($e_msg=='')
    echo 'alert("編輯成功");location.href="../signup_success.php";';
else
    echo 'alert("'.$e_msg.'");history.back();';
echo '</script>';