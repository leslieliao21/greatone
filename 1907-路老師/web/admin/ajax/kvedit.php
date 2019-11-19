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
        $query = 'SELECT * FROM kv WHERE id='.$id1;
        $result = $DB->select($query,false,$param_str,$param_ary);
        $sort1 = !empty($result['data'])?$result['data'][0]['sort']:0;
        
        $id2 = isset($_POST['id2'])?FUNCS::inputFilter('id2','POST',1):0;
        $query = 'SELECT * FROM kv WHERE id='.$id2;
        $result = $DB->select($query,false,$param_str,$param_ary);
        $sort2 = !empty($result['data'])?$result['data'][0]['sort']:0;
        
        if($sort1 && $sort2){
            $edit_ary = array('sort=?');
            $param_ary = array($sort2);
            $param_str = 'i';
            $result = updateRecord('kv','id='.$id1,$edit_ary,$param_ary,$param_str);
            
            $edit_ary = array('sort=?');
            $param_ary = array($sort1);
            $param_str = 'i';
            $result = updateRecord('kv','id='.$id2,$edit_ary,$param_ary,$param_str);
            $response = $JSONMSG[200];
        }
        else
            $response = $JSONMSG[100];
        break;
    }
    case 'edit':{
        $id     = isset($_POST['id'])?FUNCS::inputFilter('id','POST',1):0;
        $title  = isset($_POST['title'])?FUNCS::inputFilter('title','POST',3):'';
        $img    = isset($_POST['o_img'])?FUNCS::inputFilter('o_img','POST',3):'';
        $img_mb = isset($_POST['o_img_mb'])?FUNCS::inputFilter('o_img_mb','POST',3):'';
        $url    = isset($_POST['url'])?FUNCS::inputFilter('url','POST',3):'';
        $publishdate=isset($_POST['publishdate'])?FUNCS::inputFilter('publishdate','POST',3):'';
        $subtitle=isset($_POST['subtitle'])?FUNCS::inputFilter('subtitle','POST',3):'';
        $status = isset($_POST['status'])?FUNCS::inputFilter('status','POST',1):0;
        $e_msg  = '';
        
        $publishdate = $publishdate?$publishdate:date('Y-m-d');
        
        if($id<=0){
            $edit_ary = array('title=?','img=?','img_mb=?','url=?','publishdate=?','subtitle=?','status=?','sort=0','updatetime=NOW()');
            $param_ary = array($title,$img,$img_mb,$url,$publishdate,$subtitle,$status);
            $param_str = 'ssssssi';
            $result = insertRecord('kv',$edit_ary,$param_ary,$param_str);
            $id = $result['id'];
            
            $edit_ary = array('sort=?');
            $param_ary = array($id);
            $param_str = 'i';
            $result = updateRecord('kv','id='.$id,$edit_ary,$param_ary,$param_str);
        }
        else{
            $edit_ary = array('title=?','url=?','publishdate=?','subtitle=?','status=?','updatetime=NOW()');
            $param_ary = array($title,$url,$publishdate,$subtitle,$status);
            $param_str = 'ssssi';
            $result = updateRecord('kv','id='.$id,$edit_ary,$param_ary,$param_str);
        }
        
        if($id<=0) $e_msg.= '沒有變更';
        else{
			$result = kvList(array('id'=>$id),1);
            $rec = $result[0];
			
			//PC版圖片
            $pic = $_FILES['img'];
            if(FUNCS::Get_file_kind($pic['name'])=='photo' || FUNCS::Get_file_kind($pic['name'])=='png'){
                $_img = new IMG_PROCESS(array(
                    'img_source' => $pic,
                    'save_path'  => '../../upload/',
                    'save_name'  => 'kv'.$id.'_img_'.date('siHdmY')
                ));
                $img = $_img->saveImg($_img->imgCrop(1000,274));
            }
            else if(FUNCS::Get_file_kind($pic['name'])=='f-data'){}
            else $e_msg .= 'PC版圖片請使用jpg、png、gif格式\n';
			
			//MB版圖片
            $pic_mb = $_FILES['img_mb'];
            if(FUNCS::Get_file_kind($pic_mb['name'])=='photo' || FUNCS::Get_file_kind($pic_mb['name'])=='png'){
                $_img_mb = new IMG_PROCESS(array(
                    'img_source' => $pic_mb,
                    'save_path'  => '../../upload/',
                    'save_name'  => 'kv'.$id.'_img_mb_'.date('siHdmY')
                ));
                $img_mb = $_img_mb->saveImg($_img_mb->imgCrop(640,274));
            }
            else if(FUNCS::Get_file_kind($pic_mb['name'])=='f-data'){}
            else $e_msg .= 'MB版圖片請使用jpg、png、gif格式\n';
            
            if($e_msg==''){
				if($img!=$rec['img']&&$rec['img']) unlink('../../upload/'.$rec['img']);
                if($img_mb!=$rec['img_mb']&&$rec['img_mb']) unlink('../../upload/'.$rec['img_mb']);
				
                $edit_ary = array('img=?','img_mb=?');
                $param_ary = array($img,$img_mb);
                $param_str = 'ss';
                $result = updateRecord('kv','id='.$id,$edit_ary,$param_ary,$param_str);
            }
        }
        
        echo '<script>';
        if($e_msg=='')
            echo 'alert("編輯成功");location.href="../kvlist.php";';
        else if($id>0)
            echo 'alert("'.$e_msg.'");location.href="../kvedit.php?id='.$id.'";';
        else
            echo 'alert("'.$e_msg.'");history.back();';
        echo '</script>';
        exit;
        break;
    }
    case 'del':{
        $id = isset($_POST['id'])?FUNCS::inputFilter('id','POST',1):0;
        $result = deleteRecord('kv','id='.$id,array('img','img_mb'));
        if($result['status']) $response = $JSONMSG[200];
        else $response = array_merge($JSONMSG[100],array('msg'=>$result['msg']));
        break;
    }
}

// response
echo json_encode($response);
?>