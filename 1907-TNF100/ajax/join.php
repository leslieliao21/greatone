<?php
require_once '../php.lib/constants.php';
require_once PHP_LIB_PATH.'functions.php';
require_once PHP_LIB_PATH.'mysqli_conn.php';

$stmt 	= $link->stmt_init();

$name 	= isset($_GET['name'])?FUNCS::inputFilter('name','GET',3):'';
$sex 	= isset($_GET['sex'])?FUNCS::inputFilter('sex','GET',3):'';
$pid 	= isset($_GET['pid'])?FUNCS::inputFilter('pid','GET',3):'';
$birthy 	= isset($_GET['birthy'])?FUNCS::inputFilter('birthy','GET',3):'';
$birthm 	= isset($_GET['birthm'])?FUNCS::inputFilter('birthm','GET',3):'';
$birthd 	= isset($_GET['birthd'])?FUNCS::inputFilter('birthd','GET',3):'';
$email 	= isset($_GET['email'])?FUNCS::inputFilter('email','GET',3):'';
$tel 	= isset($_GET['tel'])?FUNCS::inputFilter('tel','GET',3):'';
$size 	= isset($_GET['size'])?FUNCS::inputFilter('size','GET',3):'';
$area_id 	= isset($_GET['area_id'])?FUNCS::inputFilter('area_id','GET',1):0;
$birth = $birthy.'-'.$birthm.'-'.$birthd;

$data = array();
$success = false;
$data['success'] = &$success;
	
$sql = "INSERT INTO join_list SET name=?,sex=?,pid=?,birth=?,email=?,tel=?,size=?,area_id=?,createtime=NOW()";
$insert = insert($sql,array('sssssssi',&$name,&$sex,&$pid,&$birth,&$email,&$tel,&$size,&$area_id));
if($insert > 0) $success = true;

$stmt->close();
$link->close();
echo json_encode($data);
?>