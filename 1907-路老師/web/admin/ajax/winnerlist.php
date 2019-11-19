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
$award = isset($_POST['award'])?FUNCS::inputFilter('award','POST',3):'';
$name = isset($_POST['name'])?FUNCS::inputFilter('name','POST',3):'';
$page = isset($_POST['page'])?FUNCS::inputFilter('page','POST',1):1;
$param = array(
	'aid'   => $award,
    'name'  => $name,
    'page'  => $page
);
$data = winnerList($param,$limit);

$response['data'] = $data;
$response['all'] = winnerCount();
$response['count'] = winnerCount($param);
$response['pages'] = ceil($response['count']/$limit);
$response['page'] = $page;

// response
echo json_encode($response);
?>