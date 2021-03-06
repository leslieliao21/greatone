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
$limit = 0;
$page = isset($_POST['page'])?FUNCS::inputFilter('page','POST',1):1;
$param = array(
    'page'  => $page
);
$data = planTypeList($param,$limit);

$response['data'] = $data;
$response['all'] = planTypeCount();
$response['count'] = planTypeCount($param);
$response['pages'] = ceil($response['count']/$limit);
$response['page'] = $page;

// response
echo json_encode($response);
?>