<?php
require_once '../php.lib/config.php';
//ini_set('display_errors',true);
require_once '../php.lib/functions.php';
require_once '../php.lib/class.phpmailer.php';
require_once '../php.lib/class.smtp.php';

$name = isset($_POST['name'])?FUNCS::inputFilter('name','POST',3):'';
$phone = isset($_POST['phone'])?FUNCS::inputFilter('phone','POST',3):'';
$type = isset($_POST['type'])?FUNCS::inputFilter('type','POST',3):'';
$detail = isset($_POST['detail'])?FUNCS::inputFilter('detail','POST',3):'';
$array = array();
$array['success'] = false;
try {
    $mail = new PHPMailer(true);
    $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title>無標題文件</title>
                </head>
                <body>';
    $body.= '<table><tr><td>姓名：'.$name.'</td></tr><tr><td>電話：'.$phone.'</td></tr><tr><td>問題類型：'.$type.'</td></tr><tr><td>說明：<br>'.nl2br($detail).'</td></tr></table>';
    $body.= '</body>
            </html>'; 
    $body = preg_replace('/\\\\/','', $body);
    mb_internal_encoding('UTF-8');
    $mail->SetFrom('road@iactor.com.tw', mb_encode_mimeheader("路老師培訓網", "UTF-8"));
    //$mail->SMTPDebug = 2;
    $mail->CharSet = 'utf-8';
    $mail->Encoding = "base64";
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "ssl";
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465;
    $mail->Username = "road@iactor.com.tw";
    $mail->Password = "rtrtrtrt";
    $mail->AddAddress('road@iactor.com.tw');
    $mail->AddAddress('jacky@great2.com.tw');
    $mail->AddAddress('shane@great2.com.tw');
    $mail->Subject = mb_encode_mimeheader("路老師培訓網留言", "UTF-8");
    $mail->WordWrap = 80;
    $mail->MsgHTML($body);
    $mail->IsHTML(true);
    if($mail->Send())
        $array['success'] = true;
    //echo json_encode($array);
} catch (phpmailerException $e) {
    //echo json_encode($array);
}

if($array['success']){
    header('Location:../contact_success.php');
    exit;
}
else{
    echo '<script>alert("送出失敗");history.back();</script>';
    exit;
}
?>