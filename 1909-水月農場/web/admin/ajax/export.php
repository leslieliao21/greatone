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
    case 'recommend':{
        // set data
//        $account = isset($_POST['account'])?FUNCS::inputFilter('account','POST',3):'';
//        $name = isset($_POST['name'])?FUNCS::inputFilter('name','POST',3):'';
        $param = array(
//            'account'=>$account,
//            'name'  => $name
        );
        $data = recommendList($param,0);
        
        foreach($data as $k=>$d){
            $data[$k]['codeText'] = substr($d['code'],-6);
        }
        
        $fn = 'recommendList';
        $cols = array(
            'id' => '編號',
            'num' => '車牌號碼',
            'codeText' => '車身後六碼',
            'recommend' => '推薦碼',
            'createtime' => '登錄時間'
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
    foreach($cols as $kk=>$dd)
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue(myChr($i++).($k+2),$d[$kk]);
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