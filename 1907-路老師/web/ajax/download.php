<?php 
require_once '../php.lib/config.php';
require_once '../php.lib/main.php';
require_once '../php.lib/functions.php';
require_once '../php.lib/mysqli_class.php';
$DB = new DB_CONN();
$memberLogin = memberLoginChk();
if(!$memberLogin['status']){
    header('Location:../signin.php');
    exit;
}
$member = $_SESSION[WEBX.'Mem'];
if(!in_array($member['qualify'],array(1,2))){
    header('Location:../member.php');
    exit;
}

$id = isset($_GET['id'])?FUNCS::inputFilter('id','GET',1):0;
$fn = isset($_GET['fn'])?FUNCS::inputFilter('fn','GET',3):'';

$result = planList(array('publish'=>1,'id'=>$id),1);
$rec = !empty($result)?$result[0]:array();

// create zip file
if(!empty($rec)&&$fn=='all'){
    $rec['file'.$fn] = 'plan'.$id.'.zip';
    $rec['fn'.$fn] = $rec['title'];
    
    if(is_file('../upload/plan'.$id.'.zip'))
        unlink('../upload/plan'.$id.'.zip');
    
    $zip = new ZipArchive();
    
    if($zip->open('../upload/'.$rec['file'.$fn], ZipArchive::CREATE)!==TRUE){
        exit("cannot open <{$rec['fn'.$fn]}>\n");
    }
    
    for($i=1;$i<=6;$i++){
        if(is_file('../upload/'.$rec['file'.$i])){
            $idx = explode('.',$rec['file'.$i]);
            $count_explode = count($idx);
            $idx = strtolower($idx[$count_explode-1]);
            $zip->addFile('../upload/'.$rec['file'.$i],iconv('UTF-8','big5',$rec['fn'.$i]).'.'.$idx);
        }
    }
    
    $zip->close();
}

if(empty($rec)||!$rec['file'.$fn]||!is_file('../upload/'.$rec['file'.$fn])){
    echo '<script>alert("not found");window.close();</script>';
    exit;
}

// download log
$result = logPlanFileDownload(array(
    'tid' => $member['id'],
    'pid' => $id,
    'plan' => $rec['title'],
    'file' => $rec['file'.$fn],
    'fn' => $rec['fn'.$fn]
));
if(!$result['status']){
    echo '<script>alert("error");window.close();</script>';
    exit;
}

$idx = explode('.',$rec['file'.$fn]);
$count_explode = count($idx);
$idx = strtolower($idx[$count_explode-1]);

function get_mime_type($idx){
    $mimet = array( 
        'txt' => 'text/plain',
        'htm' => 'text/html',
        'html' => 'text/html',
        'php' => 'text/html',
        'css' => 'text/css',
        'js' => 'application/javascript',
        'json' => 'application/json',
        'xml' => 'application/xml',
        'swf' => 'application/x-shockwave-flash',
        'flv' => 'video/x-flv',

        // images
        'png' => 'image/png',
        'jpe' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'jpg' => 'image/jpeg',
        'gif' => 'image/gif',
        'bmp' => 'image/bmp',
        'ico' => 'image/vnd.microsoft.icon',
        'tiff' => 'image/tiff',
        'tif' => 'image/tiff',
        'svg' => 'image/svg+xml',
        'svgz' => 'image/svg+xml',

        // archives
        'zip' => 'application/zip',
        'rar' => 'application/x-rar-compressed',
        'exe' => 'application/x-msdownload',
        'msi' => 'application/x-msdownload',
        'cab' => 'application/vnd.ms-cab-compressed',

        // audio/video
        'mp3' => 'audio/mpeg',
        'qt' => 'video/quicktime',
        'mov' => 'video/quicktime',

        // adobe
        'pdf' => 'application/pdf',
        'psd' => 'image/vnd.adobe.photoshop',
        'ai' => 'application/postscript',
        'eps' => 'application/postscript',
        'ps' => 'application/postscript',

        // ms office
        'doc' => 'application/msword',
        'rtf' => 'application/rtf',
        'xls' => 'application/vnd.ms-excel',
        'ppt' => 'application/vnd.ms-powerpoint',
        'docx' => 'application/msword',
        'xlsx' => 'application/vnd.ms-excel',
        'pptx' => 'application/vnd.ms-powerpoint',


        // open office
        'odt' => 'application/vnd.oasis.opendocument.text',
        'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
    );

    if(isset($mimet[$idx])){
        return $mimet[$idx];
    }else{
        return 'application/octet-stream';
    }
}

// download file
header("Content-Type: ".get_mime_type($idx));
header('Content-Disposition: attachment; filename="'.$rec['fn'.$fn].'.'.$idx.'"');
echo file_get_contents('../upload/'.$rec['file'.$fn]);