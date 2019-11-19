<?php 
require_once '../../php.lib/config.php';
require_once '../../php.lib/main.php';
require_once '../../php.lib/functions.php';
require_once '../../php.lib/mysqli_class.php';
require_once '../../php.lib/imgOutput.php';

$response = $JSONMSG[550];

// login check
$etype = isset($_POST['etype'])?FUNCS::inputFilter('etype','POST',3):'';
$result = loginChk();
if(!$result['status']){
    switch($etype){
        case 'sort':{}
        case 'del':{ echo json_encode($response); break; }
        case 'edit':{}
        default:{ echo '<script>alert("not login");history.back();</script>'; break; }
    }
    exit;
}

$DB = new DB_CONN();

switch ($etype){
    case 'sort':{
        $id1 = isset($_POST['id1'])?FUNCS::inputFilter('id1','POST',1):0;
        $query = 'SELECT * FROM plan WHERE id='.$id1;
        $result = $DB->select($query,false,$param_str,$param_ary);
        $sort1 = !empty($result['data'])?$result['data'][0]['sort']:0;
        
        $id2 = isset($_POST['id2'])?FUNCS::inputFilter('id2','POST',1):0;
        $query = 'SELECT * FROM plan WHERE id='.$id2;
        $result = $DB->select($query,false,$param_str,$param_ary);
        $sort2 = !empty($result['data'])?$result['data'][0]['sort']:0;
        
        if($sort1 && $sort2){
            $edit_ary = array('sort=?');
            $param_ary = array($sort2);
            $param_str = 'i';
            $result = updateRecord('plan','id='.$id1,$edit_ary,$param_ary,$param_str);
            
            $edit_ary = array('sort=?');
            $param_ary = array($sort1);
            $param_str = 'i';
            $result = updateRecord('plan','id='.$id2,$edit_ary,$param_ary,$param_str);
            $response = $JSONMSG[200];
        }
        else
            $response = $JSONMSG[100];
        break;
    }
    case 'edit':{
        $id     = isset($_POST['id'])?FUNCS::inputFilter('id','POST',1):0;
        $type   = isset($_POST['type'])?FUNCS::inputFilter('type','POST',1):0;
        $title  = isset($_POST['title'])?FUNCS::inputFilter('title','POST',3):'';
        $fn1    = isset($_POST['fn1'])?FUNCS::inputFilter('fn1','POST',3):'';
        $fn2    = isset($_POST['fn2'])?FUNCS::inputFilter('fn2','POST',3):'';
        $fn3    = isset($_POST['fn3'])?FUNCS::inputFilter('fn3','POST',3):'';
        $fn4    = isset($_POST['fn4'])?FUNCS::inputFilter('fn4','POST',3):'';
        $fn5    = isset($_POST['fn5'])?FUNCS::inputFilter('fn5','POST',3):'';
        $fn6    = isset($_POST['fn6'])?FUNCS::inputFilter('fn6','POST',3):'';
        $file1  = isset($_POST['o_file1'])?FUNCS::inputFilter('o_file1','POST',3):'';
        $file2  = isset($_POST['o_file2'])?FUNCS::inputFilter('o_file2','POST',3):'';
        $file3  = isset($_POST['o_file3'])?FUNCS::inputFilter('o_file3','POST',3):'';
        $file4  = isset($_POST['o_file4'])?FUNCS::inputFilter('o_file4','POST',3):'';
        $file5  = isset($_POST['o_file5'])?FUNCS::inputFilter('o_file5','POST',3):'';
        $file6  = isset($_POST['o_file6'])?FUNCS::inputFilter('o_file6','POST',3):'';
        $publishdate=isset($_POST['publishdate'])?FUNCS::inputFilter('publishdate','POST',3):'';
        $status = isset($_POST['status'])?FUNCS::inputFilter('status','POST',1):0;
        $e_msg  = '';
        
        $publishdate = $publishdate?$publishdate:date('Y-m-d');
        
        if($id<=0){
            $edit_ary = array('type=?','title=?','fn1=?','fn2=?','fn3=?','fn4=?','fn5=?','fn6=?','file1=?','file2=?','file3=?','file4=?','file5=?','file6=?','publishdate=?','status=?','downloads=0','sort=0','updatetime=NOW()');
            $param_ary = array($type,$title,$fn1,$fn2,$fn3,$fn4,$fn5,$fn6,$file1,$file2,$file3,$file4,$file5,$file6,$publishdate,$status);
            $param_str = 'issssssssssssssi';
            $result = insertRecord('plan',$edit_ary,$param_ary,$param_str);
            $id = $result['id'];
            
            $edit_ary = array('sort=?');
            $param_ary = array($id);
            $param_str = 'i';
            $result = updateRecord('plan','id='.$id,$edit_ary,$param_ary,$param_str);
        }
        else{
            $edit_ary = array('type=?','title=?','fn1=?','fn2=?','fn3=?','fn4=?','fn5=?','fn6=?','publishdate=?','status=?','updatetime=NOW()');
            $param_ary = array($type,$title,$fn1,$fn2,$fn3,$fn4,$fn5,$fn6,$publishdate,$status);
            $param_str = 'issssssssi';
            $result = updateRecord('plan','id='.$id,$edit_ary,$param_ary,$param_str);
        }
        
        if($id<=0) $e_msg.= '沒有變更';
        else{
			$result = planList(array('id'=>$id),1);
            $rec = $result[0];
			
			//上傳檔案
            $file = $_FILES['file1'];
            if(FUNCS::Get_file_kind($file['name'])=='f-mso'||FUNCS::Get_file_kind($file['name'])=='video'){
                $file1 = 'plan'.$id.'_file1_'.date('siHdmY').'.'.getExt($file['name']);
                copy($file['tmp_name'],'../../upload/'.$file1);
            }
            else if(FUNCS::Get_file_kind($file['name'])=='f-data'){}
            else $e_msg .= '上傳檔案請使用doc、xls、ptt、pdf格式\n';
            
            $file = $_FILES['file2'];
            if(FUNCS::Get_file_kind($file['name'])=='f-mso'||FUNCS::Get_file_kind($file['name'])=='video'){
                $file2 = 'plan'.$id.'_file2_'.date('siHdmY').'.'.getExt($file['name']);
                copy($file['tmp_name'],'../../upload/'.$file2);
            }
            else if(FUNCS::Get_file_kind($file['name'])=='f-data'){}
            else $e_msg .= '上傳檔案請使用doc、xls、ptt、pdf格式\n';
            
            $file = $_FILES['file3'];
            if(FUNCS::Get_file_kind($file['name'])=='f-mso'||FUNCS::Get_file_kind($file['name'])=='video'){
                $file3 = 'plan'.$id.'_file3_'.date('siHdmY').'.'.getExt($file['name']);
                copy($file['tmp_name'],'../../upload/'.$file3);
            }
            else if(FUNCS::Get_file_kind($file['name'])=='f-data'){}
            else $e_msg .= '上傳檔案請使用doc、xls、ptt、pdf格式\n';
            
            $file = $_FILES['file4'];
            if(FUNCS::Get_file_kind($file['name'])=='f-mso'||FUNCS::Get_file_kind($file['name'])=='video'){
                $file4 = 'plan'.$id.'_file4_'.date('siHdmY').'.'.getExt($file['name']);
                copy($file['tmp_name'],'../../upload/'.$file4);
            }
            else if(FUNCS::Get_file_kind($file['name'])=='f-data'){}
            else $e_msg .= '上傳檔案請使用doc、xls、ptt、pdf格式\n';
            
            $file = $_FILES['file5'];
            if(FUNCS::Get_file_kind($file['name'])=='f-mso'||FUNCS::Get_file_kind($file['name'])=='video'){
                $file5 = 'plan'.$id.'_file5_'.date('siHdmY').'.'.getExt($file['name']);
                copy($file['tmp_name'],'../../upload/'.$file5);
            }
            else if(FUNCS::Get_file_kind($file['name'])=='f-data'){}
            else $e_msg .= '上傳檔案請使用doc、xls、ptt、pdf格式\n';
            
            $file = $_FILES['file6'];
            if(FUNCS::Get_file_kind($file['name'])=='f-mso'||FUNCS::Get_file_kind($file['name'])=='video'){
                $file6 = 'plan'.$id.'_file6_'.date('siHdmY').'.'.getExt($file['name']);
                copy($file['tmp_name'],'../../upload/'.$file6);
            }
            else if(FUNCS::Get_file_kind($file['name'])=='f-data'){}
            else $e_msg .= '上傳檔案請使用doc、xls、ptt、pdf格式\n';
            
            if($e_msg==''){
				if($file1!=$rec['file1']&&$rec['file1']) unlink('../../upload/'.$rec['file1']);
				if($file2!=$rec['file2']&&$rec['file2']) unlink('../../upload/'.$rec['file2']);
				if($file3!=$rec['file3']&&$rec['file3']) unlink('../../upload/'.$rec['file3']);
				if($file4!=$rec['file4']&&$rec['file4']) unlink('../../upload/'.$rec['file4']);
				if($file5!=$rec['file5']&&$rec['file5']) unlink('../../upload/'.$rec['file5']);
				if($file6!=$rec['file6']&&$rec['file6']) unlink('../../upload/'.$rec['file6']);
				
                $edit_ary = array('file1=?','file2=?','file3=?','file4=?','file5=?','file6=?');
                $param_ary = array($file1,$file2,$file3,$file4,$file5,$file6);
                $param_str = 'ssssss';
                $result = updateRecord('plan','id='.$id,$edit_ary,$param_ary,$param_str);
            }
        }
        
        echo '<script>';
        if($e_msg=='')
            echo 'alert("編輯成功");location.href="../planlist.php";';
        else if($id>0)
            echo 'alert("'.$e_msg.'");location.href="../planedit.php?id='.$id.'";';
        else
            echo 'alert("'.$e_msg.'");history.back();';
        echo '</script>';
        exit;
        break;
    }
    case 'del':{
        $id = isset($_POST['id'])?FUNCS::inputFilter('id','POST',1):0;
        $result = planDelete($id);
        if($result['status']) $response = $JSONMSG[200];
        else $response = array_merge($JSONMSG[100],array('msg'=>$result['msg']));
        break;
    }
}

// response
echo json_encode($response);
?>