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
$title = isset($_POST['title'])?FUNCS::inputFilter('title','POST',3):'';
$plan = isset($_POST['plan'])?FUNCS::inputFilter('plan','POST',1):0;
$sdate = isset($_POST['sdate'])?FUNCS::inputFilter('sdate','POST',3):'';
$edate = isset($_POST['edate'])?FUNCS::inputFilter('edate','POST',3):'';
$csdate = isset($_POST['csdate'])?FUNCS::inputFilter('csdate','POST',3):'';
$cedate = isset($_POST['cedate'])?FUNCS::inputFilter('cedate','POST',3):'';
$city = isset($_POST['city'])?FUNCS::inputFilter('city','POST',3):'';
$area = isset($_POST['area'])?FUNCS::inputFilter('area','POST',3):'';
$name = isset($_POST['name'])?FUNCS::inputFilter('name','POST',3):'';
$account = isset($_POST['account'])?FUNCS::inputFilter('account','POST',3):'';
$status = isset($_POST['status'])?FUNCS::inputFilter('status','POST',1):-2;
$page = isset($_POST['page'])?FUNCS::inputFilter('page','POST',1):1;
$param = array(
	'title' => $title,
    'plan'  => $plan,
    'sdate' => $sdate,
    'edate' => $edate,
	'csdate'=> $csdate,
    'cedate'=> $cedate,
    'city'  => $city,
    'area'  => $area,
	'name'  => $name,
    'account'=>$account,
    'status'=> $status,
    'statusNot'=>-1,
    'page'  => $page
);
$data = speachList($param,$limit);

$response['data'] = $data;
$response['all'] = speachCount(array('statusNot'=>-1));
$response['count'] = speachCount($param);
$response['pages'] = ceil($response['count']/$limit);
$response['page'] = $page;

// response
echo json_encode($response);
?>