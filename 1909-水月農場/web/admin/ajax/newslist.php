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
$sdate = isset($_POST['sdate'])?FUNCS::inputFilter('sdate','POST',3):'';
$edate = isset($_POST['edate'])?FUNCS::inputFilter('edate','POST',3):'';
$status = isset($_POST['status'])?FUNCS::inputFilter('status','POST',1):2;
$page = isset($_POST['page'])?FUNCS::inputFilter('page','POST',1):1;
$param = array(
	'title' => $title,
    'sdate' => $sdate,
    'edate' => $edate,
    'status'=> $status,
    'page'  => $page
);
$data = newsList($param,$limit);

$response['data'] = $data;
$response['all'] = newsCount();
$response['count'] = newsCount($param);
$response['pages'] = ceil($response['count']/$limit);
$response['page'] = $page;

// response
echo json_encode($response);
?>