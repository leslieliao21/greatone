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
$unit = isset($_POST['unit'])?FUNCS::inputFilter('unit','POST',1):0;
$subunit = isset($_POST['subunit'])?FUNCS::inputFilter('subunit','POST',1):0;
$status = isset($_POST['status'])?FUNCS::inputFilter('status','POST',1):2;
$page = isset($_POST['page'])?FUNCS::inputFilter('page','POST',1):1;
$param = array(
	'account'=>$account,
    'uid'   => $unit,
    'suid'  => $subunit,
    'status'=> $status,
    'page'  => $page
);
$data = unitAccountList($param,$limit);

$response['data'] = $data;
$response['all'] = unitAccountCount();
$response['count'] = unitAccountCount($param);
$response['pages'] = ceil($response['count']/$limit);
$response['page'] = $page;

// response
echo json_encode($response);
?>