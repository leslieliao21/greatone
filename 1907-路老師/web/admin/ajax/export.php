<?php
require_once '../../php.lib/config.php';
require_once '../../php.lib/main.php';
require_once '../../php.lib/functions.php';
require_once '../../php.lib/mysqli_class.php';

function myChr($i){
    return $i<26?chr(65+$i):chr(65+floor($i/26)-1).chr(65+($i%26));
}

// login check
$result = loginChk();
if(!$result['status']){ echo '<script>alert("error");history.back();</script>'; exit; }

$DB = new DB_CONN();
$src = isset($_POST['src'])?FUNCS::inputFilter('src','POST',3):'';
$data = array();

switch($src){
    case 'teacherSearch':{
        // set data
        $param = array();
        $data = teacherSearchLogList($param,0);
        
        $gender = array('','男','女');
        $hasLineid = array('否','是');
        
        foreach($data as $k=>$d){
            $search = json_decode($d['search'],true);
            $data[$k]['name'] = isset($search['name'])?$search['name']:'';
            $data[$k]['genderText'] = isset($search['gender'])&&($gender[$search['gender']])?$gender[$search['gender']]:'';
            $data[$k]['hasLineid'] = isset($search['hasLineid'])&&isset($hasLineid[$search['hasLineid']])?$hasLineid[$search['hasLineid']]:'';
            $data[$k]['transportation'] = isset($search['transportation'])?join(',',$search['transportation']):'';
            $data[$k]['ageText'] = isset($search['age'])&&isset($AGERANGE[$search['age']])?$AGERANGE[$search['age']]['text']:'';
            $data[$k]['location'] = '';
            foreach($search['cityIn'] as $kk=>$dd)
                $data[$k]['location'] .= ($data[$k]['location']?',':'').$dd;
            foreach($search['areaIn'] as $kk=>$dd)
                $data[$k]['location'] .= ($data[$k]['location']?',':'').$dd[0].$dd[1];
            $data[$k]['language'] = isset($search['language'])?join(',',$search['language']):'';
            $data[$k]['service'] = isset($search['service'])?$search['service']:'';
            $data[$k]['phone'] = isset($search['phone'])?$search['phone']:'';
            $data[$k]['email'] = isset($search['email'])?$search['email']:'';
            $data[$k]['career'] = isset($search['career'])?$search['career']:'';
            $data[$k]['speachText'] = isset($search['speach'])&&isset($EXPRANGE[$search['speach']])?$EXPRANGE[$search['speach']]['text']:'';
            $data[$k]['license'] = (isset($search['license_bike'])?'機車':'').(isset($search['license_bike'])&&isset($search['license_car'])?'，':'').(isset($search['license_car'])?'汽車':'');
        }
        
        $fn = 'TeacherSearchLog';
        $cols = array(
            'id' => '流水號',
            'unit' => '需求單位',
            'account' => '帳號'
        );
        
        $result = teacherSearchList(array(),0);
        foreach($result as $k=>$d){
            switch($d['id']){
                case 1:{ $cols['name'] = '姓名'; break; }
                case 2:{ $cols['genderText'] = '性別'; break; }
                case 3:{ $cols['hasLineid'] = 'Line ID'; break; }
                case 4:{ $cols['transportation'] = '經常使用之交通工具'; break; }
                case 5:{ $cols['ageText'] = '年齡'; break; }
                case 6:{ $cols['location'] = '居住地區'; break; }
                case 7:{ $cols['language'] = '精通語言'; break; }
                case 8:{ $cols['service'] = '服務單位'; break; }
                case 9:{ $cols['phone'] = '手機'; break; }
                case 10:{ $cols['email'] = 'Email'; break; }
                case 11:{ $cols['career'] = '職業'; break; }
                case 12:{ $cols['speachText'] = '宣講場次'; break; }
                case 13:{ $cols['license'] = '持有駕照'; break; }
            }
        }
        break;
    }
    case 'planDownload':{
        // set data
        $param = array();
        $data = planFileDownloadLogList($param,0);
        
        /*foreach($data as $k=>$d){
            
        }*/
        
        $fn = 'PlanFileDownloadLog';
        $cols = array(
            'id' => '流水號',
            'tid' => '路老師ID',
            'createtime' => '下載時間',
            'plan' => '教案名稱',
            'fn' => '下載檔案'
        );
        break;
    }
    case 'teacher':{
        // set data
        $account = isset($_POST['account'])?FUNCS::inputFilter('account','POST',3):'';
        $name = isset($_POST['name'])?FUNCS::inputFilter('name','POST',3):'';
        $city = isset($_POST['city'])?FUNCS::inputFilter('city','POST',3):'';
        $area = isset($_POST['area'])?FUNCS::inputFilter('area','POST',3):'';
        $qualify = isset($_POST['qualify'])?FUNCS::inputFilter('qualify','POST',1):0;
        $status = isset($_POST['status'])?FUNCS::inputFilter('status','POST',1):-1;
        $param = array(
            'account'=>$account,
            'name'  => $name,
            'city'  => $city,
            'area'  => $area,
            'qualify'=>$qualify,
            'status'=> $status
        );
        $data = teacherList($param,0);
        
        $city = array();
        $result = cityList();
        foreach($result as $k=>$d)
            $city[$d['name']] = $d['name'];
        
        $area = array();
        $result = areaList();
        foreach($result as $k=>$d){
            $area[$d['cityname']] = isset($area[$d['cityname']])?$area[$d['cityname']]:array();
            $area[$d['cityname']][$d['name']] = $d['name'];
        }
        
        $training = array();
        $result = trainingList(array());
        foreach($result as $k=>$d)
            $training[$d['id']] = $d;
        
        $gender = array('','男','女');
        $qualify = array('','合格','實習','一般');
        
        foreach($data as $k=>$d){
            $data[$k]['genderText'] = isset($gender[$d['gender']])?$gender[$d['gender']]:'';
            $data[$k]['qualifyText'] = isset($qualify[$d['qualify']])?$qualify[$d['qualify']]:'';
            $data[$k]['lineidText'] = $d['lineid']?$d['lineid']:'無';
            $data[$k]['emailText'] = $d['email']?$d['email']:'無';
            $data[$k]['cityText'] = isset($city[$d['city']])?$city[$d['city']]:'';
            $data[$k]['areaText'] = isset($area[$d['city']])&&isset($area[$d['city']][$d['area']])?$area[$d['city']][$d['area']]:'';
            $data[$k]['licenseText'] = ($d['license_bike']?'機車駕照':'').($d['license_bike']&&$d['license_car']?',':'').($d['license_car']?'汽車駕照':'');
            
            $trained = array();
            $tra = $d['training']?explode(',',$d['training']):array();
            foreach($tra as $kk=>$dd){
                if(isset($training[$dd]))
                    $trained[] = $training[$dd]['year'].$training[$dd]['title'];
            }
            $data[$k]['trainingText'] = join(',',$trained);
            
            $data[$k]['awardText'] = '';
        }
        
        $fn = 'TeacherList';
        $cols = array(
            'id' => '編號',
            'name' => '姓名',
            'genderText' => '性別',
            'account' => '帳號(手機號碼)',
            'qualifyText' => '身分',
            'birthday' => '生日',
            'phone' => '市話',
            'lineidText' => 'Line ID',
            'emailText' => 'Email',
            'cityText' => '縣市',
            'areaText' => '行政區',
            'language' => '語言',
            'career' => '職業',
            'service' => '服務單位',
            'transportation' => '經常使用交通工具',
            'licenseText' => '持有駕照',
            'trainingText' => '回訓歷程', // 101xxx => 年度+場次
            'speach' => '宣講次數',
            'awardText' => '得獎紀錄',
            'createtime' => '註冊時間',
            'enabletime' => '第一次登入時間',
            'logintime' => '最後一次登入時間',
            'updatetime' => '最後修改資料時間'
        );
        $numberCols = array('account','phone');
        break;
    }
    case 'training':{
        // set data
        $id = isset($_POST['id'])?FUNCS::inputFilter('id','POST',1):1;
        $account = isset($_POST['account'])?FUNCS::inputFilter('account','POST',3):'';
        $name = isset($_POST['name'])?FUNCS::inputFilter('name','POST',3):'';
        $city = isset($_POST['city'])?FUNCS::inputFilter('city','POST',3):'';
        $area = isset($_POST['area'])?FUNCS::inputFilter('area','POST',3):'';
        $email = isset($_POST['email'])?FUNCS::inputFilter('email','POST',3):'';
        $career = isset($_POST['career'])?FUNCS::inputFilter('career','POST',3):'';
        $service = isset($_POST['service'])?FUNCS::inputFilter('service','POST',3):'';
        $dinning = isset($_POST['dinning'])?FUNCS::inputFilter('dinning','POST',1):0;
        $status = isset($_POST['status'])?FUNCS::inputFilter('status','POST',1):-1;

        $param = array(
            'trid'  => $id,
            'account'=>$account,
            'name'  => $name,
            'city'  => $city,
            'area'  => $area,
            'email' => $email,
            'career'=> $career,
            'service'=>$service,
            'dinning'=>$dinning,
            'status'=> $status
        );
        $data = trainingMemberList($param,0);
        
        $city = array();
        $result = cityList();
        foreach($result as $k=>$d)
            $city[$d['name']] = $d['name'];
        
        $area = array();
        $result = areaList();
        foreach($result as $k=>$d){
            $area[$d['cityname']] = isset($area[$d['cityname']])?$area[$d['cityname']]:array();
            $area[$d['cityname']][$d['name']] = $d['name'];
        }
        
        $gender = array('','男','女');
        $qualify = array('','合格','實習','一般');
        $dinning = array('','葷食','素食');
        $status = array('未出席','未完訓','完訓');
        
        foreach($data as $k=>$d){
            $data[$k]['genderText'] = isset($gender[$d['gender']])?$gender[$d['gender']]:'';
            $data[$k]['qualifyText'] = isset($qualify[$d['qualify']])?$qualify[$d['qualify']]:'';
            $data[$k]['lineidText'] = $d['lineid']?$d['lineid']:'無';
            $data[$k]['emailText'] = $d['email']?$d['email']:'無';
            $data[$k]['cityText'] = isset($city[$d['city']])?$city[$d['city']]:'';
            $data[$k]['areaText'] = isset($area[$d['city']])&&isset($area[$d['city']][$d['area']])?$area[$d['city']][$d['area']]:'';
            $data[$k]['licenseText'] = ($d['license_bike']?'機車駕照':'').($d['license_bike']&&$d['license_car']?',':'').($d['license_car']?'汽車駕照':'');
            $data[$k]['dinningText'] = isset($dinning[$d['dinning']])?$dinning[$d['dinning']]:'';
            $data[$k]['statusText'] = isset($status[$d['status']])?$status[$d['status']]:'';
        }
        
        $fn = 'TrainingMemberList';
        $cols = array(
            'id' => '編號',
            'name' => '姓名',
            'genderText' => '性別',
            'account' => '帳號(手機號碼)',
            'qualifyText' => '身分',
            'birthday' => '生日',
            'phone' => '市話',
            'lineidText' => 'Line ID',
            'emailText' => 'Email',
            'cityText' => '縣市',
            'areaText' => '行政區',
            'language' => '語言',
            'career' => '職業',
            'service' => '服務單位',
            'transportation' => '經常使用交通工具',
            'licenseText' => '持有駕照',
            'dinningText' => '用餐習慣',
            'statusText' => '培訓結果',
            'createtime' => '培訓報名時間',
            'reviewtime' => '審查時間'
        );
        $numberCols = array('account','phone');
        break;
    }
    case 'speach':{
        // set data
        $title = isset($_POST['title'])?FUNCS::inputFilter('title','POST',3):'';
        $plan = isset($_POST['plan'])?FUNCS::inputFilter('plan','POST',1):0;
        $sdate = isset($_POST['sdate'])?FUNCS::inputFilter('sdate','POST',3):'';
        $edate = isset($_POST['edate'])?FUNCS::inputFilter('edate','POST',3):'';
        $csdate = isset($_POST['csdate'])?FUNCS::inputFilter('csdate','POST',3):'';
        $cedate = isset($_POST['cedate'])?FUNCS::inputFilter('cedate','POST',3):'';
        $city = isset($_POST['city'])?FUNCS::inputFilter('city','POST',3):'';
        $area = isset($_POST['area'])?FUNCS::inputFilter('area','POST',3):'';
        $name = isset($_POST['name'])?FUNCS::inputFilter('name','POST',3):'';
        $account = isset($_POST['account'])?FUNCS::inputFilter('account','POST',3):'';
        $status = isset($_POST['status'])?FUNCS::inputFilter('status','POST',1):-1;

        $param = array(
            'title' => $title,
            'plan'  => $plan,
            'sdate' => $sdate,
            'edate' => $edate,
            'csdate'=> $csdate,
            'cedate'=> $cedate,
            'city'  => $city,
            'area'  => $area,
            'name'  => $name,
            'account'=>$account,
            'status'=> $status
        );
        $data = speachList($param,0);
        
        $city = array();
        $result = cityList();
        foreach($result as $k=>$d)
            $city[$d['name']] = $d['name'];
        
        $area = array();
        $result = areaList();
        foreach($result as $k=>$d){
            $area[$d['cityname']] = isset($area[$d['cityname']])?$area[$d['cityname']]:array();
            $area[$d['cityname']][$d['name']] = $d['name'];
        }
        
        $teacher = array();
        $qualify = array('','合格','實習','一般');
        
        foreach($data as $k=>$d){
            if(!isset($teacher[$d['tid']])){
                $result = teacherList(array('id'=>$d['tid']),1);
                if(!empty($result)){
                    $teacher[$d['tid']] = array(
                        'name' => $result[0]['name'],
                        'qualifyText' => isset($qualify[$result[0]['qualify']])?$qualify[$result[0]['qualify']]:''
                    );
                }
            }
            $data[$k]['tname'] = isset($teacher[$d['tid']])?$teacher[$d['tid']]['name']:'';
            $data[$k]['tqualify'] = isset($teacher[$d['tid']])?$teacher[$d['tid']]['qualifyText']:'';
            
            $data[$k]['cityText'] = isset($city[$d['city']])?$city[$d['city']]:'';
            $data[$k]['areaText'] = isset($area[$d['city']])&&isset($area[$d['city']][$d['area']])?$area[$d['city']][$d['area']]:'';
            $data[$k]['createdate'] = date('Y-m-d',strtotime($d['createtime']));
            
            $pictures = json_decode($d['pictures'],true);
            $data[$k]['teacherPic'] = isset($pictures['teacher'])&&$pictures['teacher']?UPLOAD_PATH.$pictures['teacher']:'';
            $data[$k]['groupPic'] = isset($pictures['group'])&&$pictures['group']?UPLOAD_PATH.$pictures['group']:'';
            $data[$k]['scene1Pic'] = isset($pictures['scene'][0])&&$pictures['scene'][0]?UPLOAD_PATH.$pictures['scene'][0]:'';
            $data[$k]['scene2Pic'] = isset($pictures['scene'][1])&&$pictures['scene'][1]?UPLOAD_PATH.$pictures['scene'][1]:'';
            $data[$k]['scene3Pic'] = isset($pictures['scene'][2])&&$pictures['scene'][2]?UPLOAD_PATH.$pictures['scene'][2]:'';
            $data[$k]['scene4Pic'] = isset($pictures['scene'][3])&&$pictures['scene'][3]?UPLOAD_PATH.$pictures['scene'][3]:'';
            $data[$k]['scene5Pic'] = isset($pictures['scene'][4])&&$pictures['scene'][4]?UPLOAD_PATH.$pictures['scene'][4]:'';
            $data[$k]['scene6Pic'] = isset($pictures['scene'][5])&&$pictures['scene'][5]?UPLOAD_PATH.$pictures['scene'][5]:'';
            $data[$k]['teacherDesc'] = isset($pictures['teacher_desc'])?$pictures['teacher_desc']:'';
            $data[$k]['groupDesc'] = isset($pictures['group_desc'])?$pictures['group_desc']:'';
            $data[$k]['scene1Desc'] = isset($pictures['scene_desc'][0])?$pictures['scene_desc'][0]:'';
            $data[$k]['scene2Desc'] = isset($pictures['scene_desc'][1])?$pictures['scene_desc'][1]:'';
            $data[$k]['scene3Desc'] = isset($pictures['scene_desc'][2])?$pictures['scene_desc'][2]:'';
            $data[$k]['scene4Desc'] = isset($pictures['scene_desc'][3])?$pictures['scene_desc'][3]:'';
            $data[$k]['scene5Desc'] = isset($pictures['scene_desc'][4])?$pictures['scene_desc'][4]:'';
            $data[$k]['scene6Desc'] = isset($pictures['scene_desc'][5])?$pictures['scene_desc'][5]:'';
        }
        
        $fn = 'SpeachList';
        $cols = array(
            'id' => '流水號',
            'tid' => '路老師系統編號',
            'tname' => '路老師姓名',
            'tqualify' => '路老師狀態',
            'speachdate' => '宣講日期',
            'audience' => '宣講單位',
            'cityText' => '宣講縣市',
            'areaText' => '宣講行政區',
            'plan' => '使用教案',
            'attends' => '參加人數',
            'minutes' => '總宣講時間',
            'benefit' => '優點',
            'feedback' => '建議',
            'evaluation' => '學習成效評估',
            'teacherPic' => '路老師上台宣講',
            'teacherDesc' => '路老師上台宣講說明',
            'groupPic' => '路老師與學生團體合照',
            'groupDesc' => '路老師與學生團體合照說名',
            'scene1Pic' => '教學過程實況1',
            'scene1Desc' => '教學過程實況說明1',
            'scene2Pic' => '教學過程實況2',
            'scene2Desc' => '教學過程實況說明2',
            'scene3Pic' => '教學過程實況3',
            'scene3Desc' => '教學過程實況說明3',
            'scene4Pic' => '教學過程實況4',
            'scene4Desc' => '教學過程實況說明4',
            'scene5Pic' => '教學過程實況5',
            'scene5Desc' => '教學過程實況說明5',
            'scene6Pic' => '教學過程實況6',
            'scene6Desc' => '教學過程實況說明6',
            'createdate' => '登錄日期'
        );
        break;
    }
    default:{exit;}
}

if(empty($data)){ echo '<script>alert("no data");window.close();</script>'; exit; }


require_once '../../php.lib/Classes/PHPExcel.php';
// response
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document")
                             ->setSubject("Office 2007 XLSX Test Document")
                             ->setDescription("Document for Office 2007 XLSX, generated using PHP classes.");

// Add some data
$i = 0;
foreach($cols as $k=>$d)
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue(myChr($i++).'1',$d);

$objPHPExcel->setActiveSheetIndex(0)
            ->getStyle('A1:'.myChr($i-1).'1')
            ->applyFromArray(
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => 'a8c545')
                    ),
                    'borders' => array(
                        'outline' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN
                        )
                    )
                )
            );

foreach($data as $k=>$d){
    $i = 0;
    foreach($cols as $kk=>$dd){
        if(!empty($numberCols)&&in_array($kk,$numberCols))
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueExplicit(myChr($i++).($k+2), $d[$kk], PHPExcel_Cell_DataType::TYPE_STRING);
        else
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue(myChr($i++).($k+2),$d[$kk]);
    }
}

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle($fn);

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$fn.'.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
?>