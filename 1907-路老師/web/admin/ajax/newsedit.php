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
        $query = 'SELECT * FROM news WHERE id='.$id1;
        $result = $DB->select($query,false,$param_str,$param_ary);
        $sort1 = !empty($result['data'])?$result['data'][0]['sort']:0;
        
        $id2 = isset($_POST['id2'])?FUNCS::inputFilter('id2','POST',1):0;
        $query = 'SELECT * FROM news WHERE id='.$id2;
        $result = $DB->select($query,false,$param_str,$param_ary);
        $sort2 = !empty($result['data'])?$result['data'][0]['sort']:0;
        
        if($sort1 && $sort2){
            $edit_ary = array('sort=?');
            $param_ary = array($sort2);
            $param_str = 'i';
            $result = updateRecord('news','id='.$id1,$edit_ary,$param_ary,$param_str);
            
            $edit_ary = array('sort=?');
            $param_ary = array($sort1);
            $param_str = 'i';
            $result = updateRecord('news','id='.$id2,$edit_ary,$param_ary,$param_str);
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
        $descript=isset($_POST['descript'])?FUNCS::inputFilter('descript','POST',3):'';
        $cover  = isset($_POST['o_cover'])?FUNCS::inputFilter('o_cover','POST',3):'';
        $contenttype=isset($_POST['contenttype'])?FUNCS::inputFilter('contenttype','POST',1):0;
        $url    = isset($_POST['url'])?FUNCS::inputFilter('url','POST',3):'';
        $publishdate=isset($_POST['publishdate'])?FUNCS::inputFilter('publishdate','POST',3):'';
        $status = isset($_POST['status'])?FUNCS::inputFilter('status','POST',1):0;
        $e_msg  = '';
        
        $url = $contenttype==2?$url:'';
        $publishdate = $publishdate?$publishdate:date('Y-m-d');
        
        if($id<=0){
            $edit_ary = array('type=?','title=?','descript=?','cover=?','contenttype=?','url=?','publishdate=?','status=?','sort=0','updatetime=NOW()');
            $param_ary = array($type,$title,$descript,$cover,$contenttype,$url,$publishdate,$status);
            $param_str = 'isssissi';
            $result = insertRecord('news',$edit_ary,$param_ary,$param_str);
            $id = $result['id'];
            
            $edit_ary = array('sort=?');
            $param_ary = array($id);
            $param_str = 'i';
            $result = updateRecord('news','id='.$id,$edit_ary,$param_ary,$param_str);
        }
        else{
            $edit_ary = array('type=?','title=?','descript=?','contenttype=?','url=?','publishdate=?','status=?','updatetime=NOW()');
            $param_ary = array($type,$title,$descript,$contenttype,$url,$publishdate,$status);
            $param_str = 'ississi';
            $result = updateRecord('news','id='.$id,$edit_ary,$param_ary,$param_str);
        }
        
        if($id<=0) $e_msg.= '沒有變更';
        else{
			$result = newsList(array('id'=>$id),1);
            $rec = $result[0];
			
			//封面圖
            $pic = $_FILES['cover'];
            if(FUNCS::Get_file_kind($pic['name'])=='photo' || FUNCS::Get_file_kind($pic['name'])=='png'){
                $_img = new IMG_PROCESS(array(
                    'img_source' => $pic,
                    'save_path'  => '../../upload/',
                    'save_name'  => 'news'.$id.'_cover_'.date('siHdmY')
                ));
                $cover = $_img->saveImg($_img->imgCrop(1920,820));
            }
            else if(FUNCS::Get_file_kind($pic['name'])=='f-data'){}
            else $e_msg .= '封面圖請使用jpg、png、gif格式\n';
            
            if($e_msg==''){
				if($cover!=$rec['cover']&&$rec['cover']) unlink('../../upload/'.$rec['cover']);
				
                $edit_ary = array('cover=?');
                $param_ary = array($cover);
                $param_str = 's';
                $result = updateRecord('news','id='.$id,$edit_ary,$param_ary,$param_str);
            }
            
            //內文
            $conts = array();
            $recs = newsContList(array('nid'=>$id));
            foreach($recs as $k=>$d)
                $conts[$d['id']] = $d;
            if($contenttype==1){
                foreach($_POST['cid'] as $k=>$d){
                    $cid = filter_var($d, FILTER_SANITIZE_NUMBER_INT);
                    $cont = isset($conts[$cid])?$conts[$cid]:array();
                    $cont['media'] = filter_var($_POST['media'][$k], FILTER_SANITIZE_NUMBER_INT);
                    $cont['content'] = filter_var($_POST['content'][$k], FILTER_SANITIZE_SPECIAL_CHARS);
                    $cont['sort'] = $k;
                    switch($cont['media']){
                        case 1:{
                            $cont['img'] = filter_var($_POST['o_img'][$k], FILTER_SANITIZE_SPECIAL_CHARS);
                            $cont['img_desc'] = filter_var($_POST['img_desc'][$k], FILTER_SANITIZE_SPECIAL_CHARS);
                            $cont['ytid'] = '';
                            break;
                        }
                        case 2:{
                            $cont['img'] = '';
                            $cont['img_desc'] = '';
                            $cont['ytid'] = filter_var($_POST['ytid'][$k], FILTER_SANITIZE_SPECIAL_CHARS);
                            break;
                        }
                    }
                    
                    if(!isset($conts[$cid])){
                        $edit_ary = array('nid=?','media=?','content=?','img=?','img_desc=?','ytid=?','sort=?','updatetime=NOW()');
                        $param_ary = array($id,$cont['media'],$cont['content'],$cont['img'],$cont['img_desc'],$cont['ytid'],$cont['sort']);
                        $param_str = 'iissssi';
                        $result = insertRecord('newscont',$edit_ary,$param_ary,$param_str);
                        $cid = $cont['id'] = $result['id'];
                    }
                    else{
                        $edit_ary = array('media=?','content=?','img_desc=?','ytid=?','sort=?','updatetime=NOW()');
                        $param_ary = array($cont['media'],$cont['content'],$cont['img_desc'],$cont['ytid'],$cont['sort']);
                        $param_str = 'isssi';
                        $result = updateRecord('newscont','id='.$cid,$edit_ary,$param_ary,$param_str);
                    }
                    
                    $img = $cont['img'];
                    $pic = array(
                        'name' => $_FILES['img']['name'][$k],
                        'type' => $_FILES['img']['type'][$k],
                        'tmp_name' => $_FILES['img']['tmp_name'][$k],
                        'error' => $_FILES['img']['error'][$k],
                        'size' => $_FILES['img']['size'][$k]
                    );
                    if($cont['media']==1 && (FUNCS::Get_file_kind($pic['name'])=='photo' || FUNCS::Get_file_kind($pic['name'])=='png')){
                        $_img = new IMG_PROCESS(array(
                            'img_source' => $pic,
                            'save_path'  => '../../upload/',
                            'save_name'  => 'news'.$id.'_img_'.$cid.'_'.date('siHdmY')
                        ));
                        $img = $_img->saveImg($_img->imgCrop(500,250));
                    }
                    else if(FUNCS::Get_file_kind($pic['name'])=='f-data'){}
                    else $e_msg .= '圖片請使用jpg、png、gif格式\n';

                    if($e_msg==''){
                        if($img!=$cont['img']&&$cont['img']) unlink('../../upload/'.$cont['img']);

                        $edit_ary = array('img=?');
                        $param_ary = array($img);
                        $param_str = 's';
                        $result = updateRecord('newscont','id='.$cid,$edit_ary,$param_ary,$param_str);
                    }
                    
                    if(isset($conts[$cid])) unset($conts[$cid]);
                }
            }
            
            foreach($conts as $k=>$d)
                deleteRecord('newscont','id='.$d['id'],array('img')); 
        }
        
        echo '<script>';
        if($e_msg=='')
            echo 'alert("編輯成功");location.href="../newslist.php";';
        else if($id>0)
            echo 'alert("'.$e_msg.'");location.href="../newsedit.php?id='.$id.'";';
        else
            echo 'alert("'.$e_msg.'");history.back();';
        echo '</script>';
        exit;
        break;
    }
    case 'del':{
        $id = isset($_POST['id'])?FUNCS::inputFilter('id','POST',1):0;
        $result = deleteRecord('news','id='.$id,array('cover'));
        if($result['status']) $response = $JSONMSG[200];
        else $response = array_merge($JSONMSG[100],array('msg'=>$result['msg']));
        break;
    }
}

// response
echo json_encode($response);
?>