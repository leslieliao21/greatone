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
$member = $_SESSION[WEBX.'Dep'];

$result = unitAccountList(array('id'=>$member['id']),1);
$info = !empty($result)?$result[0]:array();
if(empty($info)){
    $response = $JSONMSG[100];
    echo json_encode($response);
    exit;
}

$result = unitList(array('id'=>$info['uid']),1);
$info['uname'] = !empty($result)?$result[0]['title']:'';

$result = subUnitList(array('id'=>$info['suid']),1);
$info['suname'] = !empty($result)?$result[0]['title']:'';

$response = $JSONMSG[200];
$param = array();
$result = teacherSearchList(array('status'=>1),0);
foreach($result as $k=>$d){
    switch($d['id']){
        case 1:{
            $name = isset($_POST['name'])?FUNCS::inputFilter('name','POST',3):'';
            if($name) $param['name'] = $name;
            break;
        }
        case 2:{
            $gender = isset($_POST['gender'])?FUNCS::inputFilter('gender','POST',1):0;
            if(in_array($gender,array(1,2))) $param['gender'] = $gender;
            break;
        }
        case 3:{
            $lineid = isset($_POST['lineid'])?FUNCS::inputFilter('lineid','POST',1):2;
            if(in_array($lineid,array(0,1))) $param['hasLineid'] = $lineid;
            break;
        }
        case 4:{
            foreach($_POST['transportation'] as $k=>$d){
                $transportation = filter_var($d,FILTER_SANITIZE_STRING);
                if(!$transportation) continue;
                $param['transportation'] = isset($param['transportation'])?$param['transportation']:array();
                $param['transportation'][] = $transportation;
            }
            break;
        }
        case 5:{
            $age = isset($_POST['age'])?FUNCS::inputFilter('age','POST',1):0;
            if(in_array($age,array(1,2,3,4,5,6))) $param['age'] = $age;
            break;
        }
        case 6:{
            foreach($_POST['location'] as $k=>$d){
                $city = isset($d[0])?filter_var($d[0],FILTER_SANITIZE_STRING):'';
                $area = isset($d[1])?filter_var($d[1],FILTER_SANITIZE_STRING):'';
                
                if($area){
                    $param['areaIn'] = isset($param['areaIn'])?$param['areaIn']:array();
                    $param['areaIn'][] = array($city,$area);
                }
                else if($city){
                    $param['cityIn'] = isset($param['cityIn'])?$param['cityIn']:array();
                    $param['cityIn'][] = $city;
                }
            }
            break;
        }
        case 7:{
            foreach($_POST['language'] as $k=>$d){
                $language = filter_var($d,FILTER_SANITIZE_STRING);
                if(!$language) continue;
                $param['language'] = isset($param['language'])?$param['language']:array();
                $param['language'][] = $language;
            }
            break;
        }
        case 8:{
            break;
        }
        case 9:{
            break;
        }
        case 10:{
            break;
        }
        case 11:{
            $career = isset($_POST['career'])?FUNCS::inputFilter('career','POST',3):'';
            if($career) $param['career'] = $career;
            break;
        }
        case 12:{
            $speach = isset($_POST['speach'])?FUNCS::inputFilter('speach','POST',1):0;
            if(in_array($speach,array(1,2,3,4))) $param['speach'] = $speach;
            break;
        }
        case 13:{
            $license_bike = isset($_POST['license_bike'])?FUNCS::inputFilter('license_bike','POST',1):2;
            if($license_bike) $param['license_bike'] = $license_bike;
            $license_car = isset($_POST['license_car'])?FUNCS::inputFilter('license_car','POST',1):2;
            if($license_car) $param['license_car'] = $license_car;
            break;
        }
    }
}

$limit = isset($_POST['limit'])?FUNCS::inputFilter('limit','POST',1):5;
$param['qualify'] = 1;
$param['page'] = isset($_POST['page'])?FUNCS::inputFilter('page','POST',1):1;
$param['orderType'] = isset($_POST['order'])?FUNCS::inputFilter('order','POST',1):1;
$param['sortType'] = isset($_POST['order'])?FUNCS::inputFilter('sort','POST',1):1;

// search log
insertRecord('teachersearchlog',array('uaid=?','unit=?','account=?','search=?','updatetime=NOW()'),array($info['id'],$info['uname'].''.$info['suname'],$info['account'],json_encode($param)),'isss');

$gender = array('','男','女');

$response['data'] = array();
$result = teacherList($param,$limit);
foreach($result as $k=>$d){
    $award = array();
    $query = 'SELECT a.title FROM winner w LEFT JOIN award a on a.id=w.aid WHERE tid='.$d['id'].' ORDER BY a.sort DESC LIMIT 10';
    $result = $DB->select($query);
    foreach($result['data'] as $kk=>$dd)
        $award[] = $dd['title'];
    
    $speachText = array();
    $result = speachList(array('status'=>1,'tid'=>$d['id']),10);
    foreach($result as $kk=>$dd)
        $speachText[] = $dd['audience'].'('.$dd['speachdate'].')';
    
    $training = $d['training']?explode(',',$d['training']):array();
    $trainingText = array();
    $query = 'SELECT year,title FROM training WHERE id in (0,'.join(',',$training).') ORDER BY sort DESC LIMIT 10';
    $result = $DB->select($query);
    foreach($result['data'] as $kk=>$dd)
        $trainingText[] = $dd['year'].'年'.$dd['title'];
    
    $rec = array(
        'id' => $d['id'],
        'name' => $d['name'],
        'phone' => $d['account'],
        'gender' => isset($gender[$d['gender']])?$gender[$d['gender']]:'',
        'age' => $d['birthday']=='0000-00-00'?'':date('Y')-date('Y',strtotime($d['birthday'])),
        'location' => $d['city'].' '.$d['area'],
        'email' => $d['email'],
        'lineid' => $d['lineid'],
        'language' => $d['language'],
        'career' => $d['career'],
        'service' => $d['service'],
        'license' => ($d['license_bike']?'機車':'').($d['license_bike']&&$d['license_car']?'、':'').($d['license_car']?'汽車':''),
        'transportation' => $d['transportation'],
        'award' => join('、',$award),
        'speach' => $d['speach'],
        'speachText' => join('/',$speachText),
        'training' => count($training),
        'trainingText' => join('/',$trainingText),
        'year' => $d['year']
    );
    $response['data'][] = $rec;
}

$response['all'] = teacherCount();
$response['count'] = teacherCount($param);
$response['pages'] = ceil($response['count']/$limit);
$response['page'] = $param['page'];

// response
echo json_encode($response);
?>
