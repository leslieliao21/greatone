<?php
require_once '../php.lib/config.php';
unset($_SESSION[WEBX.'Adm']);
echo '<script>';
echo 'alert("登出成功!!");';
echo 'window.location="login.php";';
echo '</script>';
exit;
?>