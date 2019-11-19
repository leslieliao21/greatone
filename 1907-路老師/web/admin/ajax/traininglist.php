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
$type = isset($_POST['type'])?FUNCS::inputFilter('type','POST',3):'';
$year = isset($_POST['year'])?FUNCS::inputFilter('year','POST',3):'';
$status = isset($_POST['status'])?FUNCS::inputFilter('status','POST',1):2;
$page = isset($_POST['page'])?FUNCS::inputFilter('page','POST',1):1;
$param = array(
	'title' => $title,
    'type'  => $type,
    'year'  => $year,
    'status'=> $status,
    'page'  => $page
);
$data = trainingList($param,$limit);

$previd = $nextid = 0;
if($param['page']>1){
    $par = $param;
    $par['page'] -= 1;
    $res = trainingList($par,$limit);
    $previd = $res[$limit-1]['id'];
}
$par = $param;
$par['page'] += 1;
$res = trainingList($par,$limit);
$nextid = !empty($res)?$res[0]['id']:$nextid;

$response['previd'] = $previd;
$response['nextid'] = $nextid;
$response['data'] = $data;
$response['all'] = trainingCount();
$response['count'] = trainingCount($param);
$response['pages'] = ceil($response['count']/$limit);
$response['page'] = $page;

// response
echo json_encode($response);
?>