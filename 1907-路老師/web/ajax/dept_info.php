<?php 
require_once '../php.lib/config.php';
require_once '../php.lib/main.php';
require_once '../php.lib/functions.php';
require_once '../php.lib/mysqli_class.php';
$DB = new DB_CONN();

$response = $JSONMSG[550];
$departLogin = departLoginChk();
if(!$departLogin['status']){
    echo json_encode($response);
    exit;
}
$response = $JSONMSG[209];
$member = $_SESSION[WEBX.'Dep'];

$depart = getDepart($member['uid']);
if(empty($depart)){
    $response['msg'] = 'error';
    echo json_encode($response);
    exit;
}

if(isset($depart['member'][$member['id']])){
    if(isset($_POST['title'][$member['uid']])){
        foreach($_POST['title'][$member['uid']] as $k=>$d){
            $title = filter_var($d,FILTER_SANITIZE_STRING);
            if($title!=$depart['sub'][$k]['title'])
                updateRecord('subunit','id='.$k,array('title=?','updatetime=NOW()'),array($title),'s');
        }
    }
    
    foreach($depart['member'] as $k=>$d){
        if(isset($_POST['name'][$k])&&isset($_POST['phone'][$k])){
            $name = filter_var($_POST['name'][$k],FILTER_SANITIZE_STRING);
            $phone = filter_var($_POST['phone'][$k],FILTER_SANITIZE_STRING);
            if($name!=$d['name']||$phone!=$d['phone'])
                updateRecord('unitaccount','id='.$k,array('name=?','phone=?','updatetime=NOW()'),array($name,$phone),'ss');
        }
    }
    
    foreach($depart['sub'] as $k=>$d){
        foreach($d['member'] as $kk=>$dd){
            if(isset($_POST['name'][$kk])&&$_POST['phone'][$kk]){
                $name = filter_var($_POST['name'][$kk],FILTER_SANITIZE_STRING);
                $phone = filter_var($_POST['phone'][$kk],FILTER_SANITIZE_STRING);
                if($name!=$dd['name']||$phone!=$dd['phone'])
                     updateRecord('unitaccount','id='.$kk,array('name=?','phone=?','updatetime=NOW()'),array($name,$phone),'ss');
            }
        }
    }
    
    $response = $JSONMSG[200];
}
else if($depart['sub'][$member['suid']]){
    if(isset($_POST['title'][$member['uid']]) && isset($_POST['title'][$member['uid']][$member['suid']])){
        $title = filter_var($_POST['title'][$member['uid']][$member['suid']],FILTER_SANITIZE_STRING);
        if($title!=$depart['sub'][$member['suid']]['title'])
            updateRecord('subunit','id='.$member['suid'],array('title=?','updatetime=NOW()'),array($title),'s');
    }
    
    foreach($depart['sub'][$member['suid']]['member'] as $k=>$d){
        if(isset($_POST['name'][$k])&&isset($_POST['phone'][$k])){
            $name = filter_var($_POST['name'][$k],FILTER_SANITIZE_STRING);
            $phone = filter_var($_POST['phone'][$k],FILTER_SANITIZE_STRING);
            if($name!=$d['name']||$phone!=$d['phone'])
                updateRecord('unitaccount','id='.$k,array('name=?','phone=?','updatetime=NOW()'),array($name,$phone),'ss');
        }
    }
    
    $response = $JSONMSG[200];
}

// response
echo json_encode($response);
?>
