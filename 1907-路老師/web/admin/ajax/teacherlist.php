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
$account = isset($_POST['account'])?FUNCS::inputFilter('account','POST',3):'';
$name = isset($_POST['name'])?FUNCS::inputFilter('name','POST',3):'';
$city = isset($_POST['city'])?FUNCS::inputFilter('city','POST',3):'';
$area = isset($_POST['area'])?FUNCS::inputFilter('area','POST',3):'';
$qualify = isset($_POST['qualify'])?FUNCS::inputFilter('qualify','POST',1):0;
$status = isset($_POST['status'])?FUNCS::inputFilter('status','POST',1):-1;
$page = isset($_POST['page'])?FUNCS::inputFilter('page','POST',1):1;
$param = array(
	'account'=>$account,
    'name'  => $name,
    'city'  => $city,
    'area'  => $area,
    'qualify'=>$qualify,
    'status'=> $status,
    'page'  => $page
);
$data = teacherList($param,$limit);

$response['data'] = $data;
$response['all'] = teacherCount();
$response['count'] = teacherCount($param);
$response['pages'] = ceil($response['count']/$limit);
$response['page'] = $page;

// response
echo json_encode($response);
?>