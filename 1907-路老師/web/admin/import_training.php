<?php 
require_once '../php.lib/config.php';
require_once '../php.lib/main.php';
require_once '../php.lib/functions.php';
require_once '../php.lib/mysqli_class.php';
require_once '../php.lib/Classes/PHPExcel.php';

$DB = new DB_CONN();

//設定要被讀取的檔案
$file = 'training_1019.xlsx';
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
    
    $rec = array(
        'trid' => isset($col['A'])?filter_var($col['A'],FILTER_SANITIZE_NUMBER_INT):'',
        'account' => isset($col['B'])?filter_var($col['B'],FILTER_SANITIZE_NUMBER_INT):'',
        'dinning' => isset($col['C'])?filter_var($col['C'],FILTER_SANITIZE_NUMBER_INT):'',
        'status' => isset($col['D'])?filter_var($col['D'],FILTER_SANITIZE_NUMBER_INT):'',
    );
    
    if(!$rec['account']){
        echo 'no account<br>';
        print_r($col);
        continue;
    }
    
    $ary[$rec['account']] = $rec;
    if(count($ary)<100) continue;
    echo count($ary).'<br>';
    $i = 0;
    $query = 'INSERT INTO trainingmember (trid,teid,account,name,gender,birthday,city,area,email,lineid,phone,language,career,transportation,service,license_bike,license_car,qualify,dinning,status,reviewtime,updatetime,createtime) VALUES (';
    foreach($ary as $k=>$d)
        $query .= ($i++>0?'),(':'').'"'.$d['trid'].'",0,"'.$d['account'].'","",0,0,"","","","","","","","","",0,0,0,"'.$d['dinning'].'","'.$d['status'].'",NOW(),NOW(),NOW()';
    $query .= ')';
    $DB->update($query);
    $ary = array();
}
echo count($ary).'<br>';
if(!empty($ary)){
    $i = 0;
    $query = 'INSERT INTO trainingmember (trid,teid,account,name,gender,birthday,city,area,email,lineid,phone,language,career,transportation,service,license_bike,license_car,qualify,dinning,status,reviewtime,updatetime,createtime) VALUES (';
    foreach($ary as $k=>$d)
        $query .= ($i++>0?'),(':'').'"'.$d['trid'].'",0,"'.$d['account'].'","",0,0,"","","","","","","","","",0,0,0,"'.$d['dinning'].'","'.$d['status'].'",NOW(),NOW(),NOW()';
    $query .= ')';
    $DB->update($query);
}

$query = 'UPDATE trainingmember m
INNER JOIN teacher t ON t.account=m.account
SET m.teid=t.id,m.name=t.name,m.gender=t.gender,m.birthday=t.birthday,m.city=t.city,m.area=t.area,m.email=t.email,m.lineid=t.lineid,m.phone=t.phone,m.language=t.language,m.career=t.career,m.transportation=t.transportation,m.service=t.service,m.license_bike=t.license_bike,m.license_car=t.license_car,m.qualify=t.qualify
WHERE m.id>13';
$DB->update($query);

$query = 'UPDATE teacher t
INNER JOIN (SELECT teid,account,GROUP_CONCAT(trid SEPARATOR ",") training
FROM trainingmember
GROUP BY account) m ON m.account=t.account
SET t.training=m.training';
$DB->update($query);
?>