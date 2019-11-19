<?php 
require_once '../php.lib/config.php';
require_once '../php.lib/main.php';
require_once '../php.lib/functions.php';
require_once '../php.lib/mysqli_class.php';

$DB = new DB_CONN();
$response = $JSONMSG[200];
$page = isset($_POST['page'])?FUNCS::inputFilter('page','POST',1):1;
$limit = isset($_POST['limit'])?FUNCS::inputFilter('limit','POST',1):5;

$count = newsCount(array('publish'=>1));
$response['data'] = newsList(array('publish'=>1,'page'=>$page),$limit);
$response['pages'] = ceil($count/$limit);

// response
echo json_encode($response);
?>
