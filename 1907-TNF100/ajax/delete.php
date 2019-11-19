<?php
require_once '../php.lib/constants.php';
require_once PHP_LIB_PATH.'functions.php';
require_once PHP_LIB_PATH.'mysqli_conn.php';

$stmt 	= $link->stmt_init();

$email 	= isset($_GET['email'])?FUNCS::inputFilter('email','GET',3):'';
$tel 	= isset($_GET['tel'])?FUNCS::inputFilter('tel','GET',3):'';
$area_id 	= isset($_GET['area_id'])?FUNCS::inputFilter('area_id','GET',1):0;

$data = array();
$success = false;
$data['success'] = &$success;
	
$sql = "SELECT * FROM join_list WHERE area_id=? AND email=? AND tel=?";
$row = row($sql,array('iss',&$area_id,&$email,&$tel));
if(!empty($row)){
    $success = true;
    $sql = "UPDATE join_list SET del=1 WHERE area_id=? AND email=? AND tel=?";
    update($sql,array('iss',&$area_id,&$email,&$tel));	
}

$stmt->close();
$link->close();
echo json_encode($data);
?>