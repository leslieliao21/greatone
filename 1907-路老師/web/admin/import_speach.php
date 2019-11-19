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
    $city[] = $d['name'];

$area2 = array();
$result = areaList();
foreach($result as $k=>$d)
    $area2[$d['cityname']][] = $d['name'];

$plan = array();
$result = planList(array(),0);
foreach($result as $k=>$d)
    $plan[$d['title']] = $d['id'];

//設定要被讀取的檔案
$file = 'speach_918.xlsx';
try {
    $objPHPExcel = PHPExcel_IOFactory::load($file);
} catch(Exception $e) {
    die('Error loading file "'.pathinfo($file,PATHINFO_BASENAME).'": '.$e->getMessage());
}

$sheetData = $objPHPExcel->getSheet(0)->toArray(null,true,true,true);

//列印每一行的資料
echo '<pre>';
$teacher = array();
$ary = array();
$ary2 = array();
foreach($sheetData as $key=>$col){
    if($key<=1) continue;
    
    $rec = array(
        'plan' => '',
        'audience' => isset($col['H'])?filter_var($col['H'],FILTER_SANITIZE_SPECIAL_CHARS):'',
        'city' => isset($col['E'])?filter_var($col['E'],FILTER_SANITIZE_SPECIAL_CHARS):'',
        'area' => isset($col['F'])?filter_var($col['F'],FILTER_SANITIZE_SPECIAL_CHARS):'',
        'title' => isset($col['A'])?filter_var($col['A'],FILTER_SANITIZE_SPECIAL_CHARS):'',
        'tid' => 0,
        'name' => isset($col['C'])?filter_var($col['C'],FILTER_SANITIZE_SPECIAL_CHARS):'',
        'account' => '',
        'minutes' => isset($col['G'])?filter_var($col['G'],FILTER_SANITIZE_NUMBER_INT):0,
        'attends' => isset($col['D'])?filter_var($col['D'],FILTER_SANITIZE_NUMBER_INT):0,
        'benefit' => isset($col['P'])?filter_var($col['P'],FILTER_SANITIZE_SPECIAL_CHARS):'',
        'feedback' => isset($col['Q'])?filter_var($col['Q'],FILTER_SANITIZE_SPECIAL_CHARS):'',
        'evaluation' => isset($col['R'])?filter_var($col['R'],FILTER_SANITIZE_SPECIAL_CHARS):'',
        'pictures' => '{\"teacher\":\"\",\"teacher_desc\":\"\",\"group\":\"\",\"group_desc\":\"\",\"scene\":[],\"scene_desc\":[]}',
        'recommend' => '',
        'speachdate' => '',
        'reviewtime' => date('Y-m-d H:i:s'),
        'status' => 1,
        'createtime' => date('Y-m-d H:i:s'),
        'updatetime' => date('Y-m-d H:i:s'),
    );
    
    $_plan = array();
    for($i=0;$i<7;$i++){
        $p = isset($col[chr($i+73)])?filter_var($col[chr($i+73)],FILTER_SANITIZE_SPECIAL_CHARS):'';
        $p = str_replace("&#10;", "", $p);
        $p = trim($p);
        if($p&&isset($plan[$p]))
            $_plan[] = $plan[$p];
        else if($p)
            $_plan[] = $p;
    }
    $rec['plan'] = join(',',$_plan);
    
    if(!isset($teacher[$rec['name']])){
        $result = teacherList(array('nameEqual'=>$rec['name']),1);
        $teacher[$rec['name']] = !empty($result)?$result[0]:array();
    }
    if(!empty($teacher[$rec['name']])){
        $rec['tid'] = $teacher[$rec['name']]['id'];
        $rec['account'] = $teacher[$rec['name']]['account'];
        $ary2[$teacher[$rec['name']]['id']] = $ary2[$teacher[$rec['name']]['id']]?$ary2[$teacher[$rec['name']]['id']]+1:1;
    }
    
    $rec['city'] = in_array($rec['city'],$city)?$rec['city']:'';
    $rec['area'] = isset($area[$rec['city']])&&in_array($rec['area'],$area[$rec['city']])?$rec['area']:'';
    $rec['speachdate'] = date('Y-m-d',strtotime($rec['speachdate']));
    
    $cell = $objPHPExcel->getSheet(0)->getCell('B'.$key);
    $rec['speachdate'] = $cell->getValue();
    if(PHPExcel_Shared_Date::isDateTime($cell))
         $rec['speachdate'] = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($rec['speachdate']));
    
    $ary[] = $rec;
    if(count($ary)<100) continue;
    echo count($ary).'<br>';
    $i = 0;
    $query = 'INSERT INTO speach (plan,audience,city,area,title,tid,name,account,minutes,attends,benefit,feedback,evaluation,pictures,recommend,speachdate,reviewtime,status,createtime,updatetime) VALUES (';
    foreach($ary as $k=>$d)
        $query .= ($i++>0?'),(':'').'"'.$d['plan'].'","'.$d['audience'].'","'.$d['city'].'","'.$d['area'].'","'.$d['title'].'","'.$d['tid'].'","'.$d['name'].'","'.$d['account'].'","'.$d['minutes'].'","'.$d['attends'].'","'.$d['benefit'].'","'.$d['feedback'].'","'.$d['evaluation'].'","'.$d['pictures'].'","'.$d['recommend'].'","'.$d['speachdate'].'",NOW(),1,NOW(),NOW()';
    $query .= ')';
    $DB->update($query);
    $ary = array();
    
    if(empty($ary2)) continue;
    $query = 'update teacher set speach=speach+(CASE';
    foreach($ary2 as $k=>$d)
        $query .= ' WHEN id='.$k.' THEN '.$d;
    $query .= ' END)
            WHERE id IN ('.join(',',array_keys($ary2)).')';
    $DB->update($query);
    $ary2 = array();
}
echo count($ary).'<br>';
if(!empty($ary)){
    $i = 0;
    $query = 'INSERT INTO speach (plan,audience,city,area,title,tid,name,account,minutes,attends,benefit,feedback,evaluation,pictures,recommend,speachdate,reviewtime,status,createtime,updatetime) VALUES (';
    foreach($ary as $k=>$d)
        $query .= ($i++>0?'),(':'').'"'.$d['plan'].'","'.$d['audience'].'","'.$d['city'].'","'.$d['area'].'","'.$d['title'].'","'.$d['tid'].'","'.$d['name'].'","'.$d['account'].'","'.$d['minutes'].'","'.$d['attends'].'","'.$d['benefit'].'","'.$d['feedback'].'","'.$d['evaluation'].'","'.$d['pictures'].'","'.$d['recommend'].'","'.$d['speachdate'].'",NOW(),1,NOW(),NOW()';
    $query .= ')';
    $DB->update($query);
}
if(!empty($ary2)){
    $query = 'update teacher set speach=speach+(CASE';
    foreach($ary2 as $k=>$d)
        $query .= ' WHEN id='.$k.' THEN '.$d;
    $query .= ' END)
            WHERE id IN ('.join(',',array_keys($ary2)).')';
    $DB->update($query);
}
?>