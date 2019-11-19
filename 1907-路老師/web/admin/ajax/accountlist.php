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
$account = isset($_POST['account'])?FUNCS::inputFilter('account','POST',3):'';
$name = isset($_POST['name'])?FUNCS::inputFilter('name','POST',3):'';
$status = isset($_POST['status'])?FUNCS::inputFilter('status','POST',1):2;
$limit = isset($_POST['limit'])?FUNCS::inputFilter('limit','POST',1):20;
$page = isset($_POST['page'])?FUNCS::inputFilter('page','POST',1):1;
$param = array(
    'account' => $account,
    'name' => $name,
    'status' => $status
);
$data = accountList($param,$limit);

$response['data'] = $data;
$response['all'] = accountCount();
$response['count'] = accountCount($param);
$response['pages'] = ceil($response['count']/$limit);
$response['page'] = $page;

// response
echo json_encode($response);
?>