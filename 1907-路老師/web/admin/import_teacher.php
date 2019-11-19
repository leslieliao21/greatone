<?php 
require_once '../php.lib/config.php';
require_once '../php.lib/main.php';
require_once '../php.lib/functions.php';
require_once '../php.lib/mysqli_class.php';
require_once '../php.lib/Classes/PHPExcel.php';

$DB = new DB_CONN();

$city = array();
$result = cityList();
foreach($result as $k=>$d)
    $city[$d['code']] = $d['name'];

$area = array();
$area2 = array();
$result = areaList();
foreach($result as $k=>$d){
    $area[$d['cityname']][$d['zipcode']] = $d['name'];
    $area2[$d['cityname']][] = $d['name'];
}

//設定要被讀取的檔案
$file = 'teacher_1017.xlsx';
try {
    $objPHPExcel = PHPExcel_IOFactory::load($file);
} catch(Exception $e) {
    die('Error loading file "'.pathinfo($file,PATHINFO_BASENAME).'": '.$e->getMessage());
}

$sheetData = $objPHPExcel->getSheet(0)->toArray(null,true,true,true);

//列印每一行的資料
echo '<pre>';
$ary = array();
foreach($sheetData as $key=>$col){
    if($key<=1) continue;
    
    $_gender = isset($col['C'])?filter_var($col['C'],FILTER_SANITIZE_SPECIAL_CHARS):'';
    $_city = isset($col['E'])?filter_var($col['E'],FILTER_SANITIZE_SPECIAL_CHARS):'';
    $_area = isset($col['F'])?filter_var($col['F'],FILTER_SANITIZE_SPECIAL_CHARS):'';
    
    $rec = array(
        'account' => isset($col['A'])?filter_var($col['A'],FILTER_SANITIZE_SPECIAL_CHARS):'',
        'password' => '',
        'name' => isset($col['B'])?filter_var($col['B'],FILTER_SANITIZE_SPECIAL_CHARS):'',
        'gender' => 0,
        'birthday' => isset($col['D'])?filter_var($col['D'],FILTER_SANITIZE_SPECIAL_CHARS):'',
        'city' => '',
        'area' => '',
        'email' => isset($col['G'])?filter_var($col['G'],FILTER_SANITIZE_SPECIAL_CHARS):'',
        'lineid' => isset($col['H'])?filter_var($col['H'],FILTER_SANITIZE_SPECIAL_CHARS):'',
        'phone' => isset($col['I'])?filter_var($col['I'],FILTER_SANITIZE_SPECIAL_CHARS):'',
        'language' => isset($col['J'])?filter_var($col['J'],FILTER_SANITIZE_SPECIAL_CHARS):'',
        'career' => isset($col['K'])?filter_var($col['K'],FILTER_SANITIZE_SPECIAL_CHARS):'',
        'transportation' => isset($col['L'])?filter_var($col['L'],FILTER_SANITIZE_SPECIAL_CHARS):'',
        'service' => isset($col['M'])?filter_var($col['M'],FILTER_SANITIZE_SPECIAL_CHARS):'',
        'license_bike' => isset($col['N'])?filter_var($col['N'],FILTER_SANITIZE_NUMBER_INT):0,
        'license_car' => isset($col['O'])?filter_var($col['O'],FILTER_SANITIZE_NUMBER_INT):0,
        'training' => '',
        'speach' => 0,
        'qualify' => isset($col['P'])?filter_var($col['P'],FILTER_SANITIZE_NUMBER_INT):0,
        'year' => isset($col['Q'])?filter_var($col['Q'],FILTER_SANITIZE_NUMBER_INT):0,
        'imp' => 1,
        'status' => 2,
        'enabletime' => '0000-00-00 00:00:00',
        'logintime' => '0000-00-00 00:00:00',
        'createtime' => date('Y-m-d H:i:s'),
        'updatetime' => date('Y-m-d H:i:s'),
    );
    
    $result = teacherCount(array('accountEqual'=>$rec['account']));
    if(!$rec['account']){
        echo 'no account<br>';
        print_r($col);
        continue;
    }
    if(!empty($result)){
        echo 'duplicate account<br>';
        print_r($col);
        continue;
    }
    if(isset($ary[$rec['account']])){
        echo 'duplicate account 2<br>';
        print_r($col);
        continue;
    }
    
    $rec['password'] = sha1($rec['account']);
    switch($_gender){
        case '男':{ $rec['gender'] = 1; break; }
        case '女':{ $rec['gender'] = 2; break; }
        default:{ $rec['gender'] = 0; }
    }
    $rec['birthday'] = $rec['birthday']?date('Y-m-d',strtotime($rec['birthday'])):'0000-00-00';
    $_city = $_city=='#N/A'?'':$_city;
    $rec['city'] = isset($city[$_city])?$city[$_city]:$_city;
    $_area = $_area=='#N/A'?'':$_area;
    $rec['area'] = isset($area[$rec['city']])&&isset($area[$rec['city']][$_area])?$area[$rec['city']][$_area]:$_area;
    $rec['email'] = $rec['email']=='無'?'':$rec['email'];
    $rec['email'] = $rec['email']=='「無」'?'':$rec['email'];
    $rec['lineid'] = $rec['lineid']=='無'?'':$rec['lineid'];
    $rec['lineid'] = $rec['lineid']=='「無」'?'':$rec['lineid'];
    $rec['lineid'] = $rec['lineid']=='未設定id'?'':$rec['lineid'];
    $rec['license_bike'] = in_array($rec['license_bike'],array(1,0))?$rec['license_bike']:0;
    $rec['license_car'] = in_array($rec['license_car'],array(1,0))?$rec['license_car']:0;
    $rec['qualify'] = in_array($rec['qualify'],array(1,2))?$rec['qualify']:0;
    $rec['year'] = $rec['qualify']==1&&$rec['year']?$rec['year']-1911:'';
    
    $ary[$rec['account']] = $rec;
    if(count($ary)<100) continue;
    echo count($ary).'<br>';
    $i = 0;
    $query = 'INSERT INTO teacher (account,password,name,gender,birthday,city,area,email,lineid,phone,language,career,transportation,service,license_bike,license_car,qualify,year,status,training,speach,imp,enabletime,logintime,updatetime,createtime) VALUES (';
    foreach($ary as $k=>$d)
        $query .= ($i++>0?'),(':'').'"'.$d['account'].'","'.$d['password'].'","'.$d['name'].'","'.$d['gender'].'","'.$d['birthday'].'","'.$d['city'].'","'.$d['area'].'","'.$d['email'].'","'.$d['lineid'].'","'.$d['phone'].'","'.$d['language'].'","'.$d['career'].'","'.$d['transportation'].'","'.$d['service'].'","'.$d['license_bike'].'","'.$d['license_car'].'","'.$d['qualify'].'","'.$d['year'].'","'.$d['status'].'","",0,1,0,0,NOW(),NOW()';
    $query .= ')';
    $DB->update($query);
    $ary = array();
}
echo count($ary).'<br>';
if(!empty($ary)){
    $i = 0;
    $query = 'INSERT INTO teacher (account,password,name,gender,birthday,city,area,email,lineid,phone,language,career,transportation,service,license_bike,license_car,qualify,year,status,training,speach,imp,enabletime,logintime,updatetime,createtime) VALUES (';
    foreach($ary as $k=>$d)
        $query .= ($i++>0?'),(':'').'"'.$d['account'].'","'.$d['password'].'","'.$d['name'].'","'.$d['gender'].'","'.$d['birthday'].'","'.$d['city'].'","'.$d['area'].'","'.$d['email'].'","'.$d['lineid'].'","'.$d['phone'].'","'.$d['language'].'","'.$d['career'].'","'.$d['transportation'].'","'.$d['service'].'","'.$d['license_bike'].'","'.$d['license_car'].'","'.$d['qualify'].'","'.$d['year'].'","'.$d['status'].'","",0,1,0,0,NOW(),NOW()';
    $query .= ')';
    $DB->update($query);
}
?>