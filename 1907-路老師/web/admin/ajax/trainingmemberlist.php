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
$response = $JSONMSG[200];
$limit = 50;
$id = isset($_POST['id'])?FUNCS::inputFilter('id','POST',1):1;
$account = isset($_POST['account'])?FUNCS::inputFilter('account','POST',3):'';
$name = isset($_POST['name'])?FUNCS::inputFilter('name','POST',3):'';
$city = isset($_POST['city'])?FUNCS::inputFilter('city','POST',3):'';
$area = isset($_POST['area'])?FUNCS::inputFilter('area','POST',3):'';
$email = isset($_POST['email'])?FUNCS::inputFilter('email','POST',3):'';
$career = isset($_POST['career'])?FUNCS::inputFilter('career','POST',3):'';
$service = isset($_POST['service'])?FUNCS::inputFilter('service','POST',3):'';
$dinning = isset($_POST['dinning'])?FUNCS::inputFilter('dinning','POST',1):0;
$status = isset($_POST['status'])?FUNCS::inputFilter('status','POST',1):-1;
$page = isset($_POST['page'])?FUNCS::inputFilter('page','POST',1):1;
$param = array(
	'trid'  => $id,
	'account'=>$account,
    'name'  => $name,
    'city'  => $city,
    'area'  => $area,
    'email' => $email,
	'career'=> $career,
    'service'=>$service,
    'dinning'=>$dinning,
    'status'=> $status,
    'page'  => $page
);
$data = trainingMemberList($param,$limit);

$response['data'] = $data;
$response['all'] = trainingMemberCount(array('trid'=>$id));
$response['count'] = trainingMemberCount($param);
$response['pages'] = ceil($response['count']/$limit);
$response['page'] = $page;

// response
echo json_encode($response);
?>