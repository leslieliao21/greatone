<?php
require_once '../php.lib/config.php';
unset($_SESSION[WEBX.'Dep']);
echo '<script>';
echo 'alert("登出成功!!");';
echo 'window.location="../index.php";';
echo '</script>';
exit;
?>