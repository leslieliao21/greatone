<?php
require_once PHP_LIB_PATH.'functions.php';
require_once PHP_LIB_PATH.'mysqli_conn.php';
$stmt = $link->stmt_init();

$photo_dir = 'http://www.北面.tw/upload/photo/';
$sql = 'SELECT img_small FROM photo_list WHERE game_id=? ORDER BY id DESC';
$photos = rows($sql,array('i',&$game_id));

$stmt->close();
$link->close();
?>