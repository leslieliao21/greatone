<?php 
require_once '../../php.lib/config.php';
require_once '../../php.lib/main.php';
require_once '../../php.lib/functions.php';
require_once '../../php.lib/mysqli_class.php';
require_once '../../php.lib/imgOutput.php';

$response = $JSONMSG[550];

// login check
$result = loginChk();
if(!$result['status']){ echo json_encode($response); exit; }

$DB = new DB_CONN();
$etype = isset($_POST['etype'])?FUNCS::inputFilter('etype','POST',3):'';

switch ($etype){
    /*case 'sort':{
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
    }*/
    case 'edit':{
        $id     = isset($_POST['id'])?FUNCS::inputFilter('id','POST',1):0;
        $type   = isset($_POST['type'])?FUNCS::inputFilter('type','POST',1):0;
        $title  = isset($_POST['title'])?FUNCS::inputFilter('title','POST',3):'';
        $descript=isset($_POST['descript'])?FUNCS::inputFilter('descript','POST',3):'';
        $publishdate=isset($_POST['publishdate'])?FUNCS::inputFilter('publishdate','POST',3):'';
        $status = isset($_POST['status'])?FUNCS::inputFilter('status','POST',1):0;
        $img1url= isset($_POST['img1url'])?FUNCS::inputFilter('img1url','POST',3):'';
        $img2url= isset($_POST['img2url'])?FUNCS::inputFilter('img2url','POST',3):'';
        $img3url= isset($_POST['img3url'])?FUNCS::inputFilter('img3url','POST',3):'';
        $cover  = isset($_POST['o_cover'])?FUNCS::inputFilter('o_cover','POST',3):'';
        $img1 = '';
        $img2 = '';
        $img3 = '';
        $content= array();
        $e_msg  = '';
        
        $publishdate = $publishdate?$publishdate:date('Y-m-d');
        
        switch($type){
            case 1:{
                $img1 = isset($_POST['o_img1'])?FUNCS::inputFilter('o_img1','POST',3):'';
                $img2 = isset($_POST['o_img2'])?FUNCS::inputFilter('o_img2','POST',3):'';
                foreach($_POST['content'] as $k=>$d){
                    $c = filter_var($d,FILTER_SANITIZE_STRING);
                    if($c)
                        $content[] = $c;
                }
                break;
            }
            case 2:{
                $img3 = isset($_POST['o_img3'])?FUNCS::inputFilter('o_img3','POST',3):'';
                break;
            }
        }
        
        if($id<=0){
            $edit_ary = array('type=?','cover=?','title=?','descript=?','img1=?','img2=?','img3=?','img1url=?','img2url=?','img3url=?','content=?','status=?','publishdate=?','updatetime=NOW()');
            $param_ary = array($type,$cover,$title,$descript,$img1,$img2,$img3,$img1url,$img2url,$img3url,json_encode($content),$status,$publishdate);
            $param_str = 'issssssssssis';
            $result = insertRecord('news',$edit_ary,$param_ary,$param_str);
            $id = $result['id'];
        }
        else{
            $edit_ary = array('type=?','cover=?','title=?','descript=?','img1=?','img2=?','img3=?','img1url=?','img2url=?','img3url=?','content=?','status=?','publishdate=?','updatetime=NOW()');
            $param_ary = array($type,$cover,$title,$descript,$img1,$img2,$img3,$img1url,$img2url,$img3url,json_encode($content),$status,$publishdate);
            $param_str = 'issssssssssis';
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
                $cover = $_img->saveImg($_img->imgCrop(585,438));
            }
            else if(FUNCS::Get_file_kind($pic['name'])=='f-data'){}
            else $e_msg .= '封面圖請使用jpg、png、gif格式\n';
            
            switch($type){
                case 1:{
                    $pic = $_FILES['img1'];
                    if(FUNCS::Get_file_kind($pic['name'])=='photo' || FUNCS::Get_file_kind($pic['name'])=='png'){
                        $_img = new IMG_PROCESS(array(
                            'img_source' => $pic,
                            'save_path'  => '../../upload/',
                            'save_name'  => 'news'.$id.'_img1_'.date('siHdmY')
                        ));
                        $img1 = $_img->saveImg($_img->imgCrop(1200,500));
                    }
                    else if(FUNCS::Get_file_kind($pic['name'])=='f-data'){}
                    else $e_msg .= '封面圖請使用jpg、png、gif格式\n';
                    
                    $pic = $_FILES['img2'];
                    if(FUNCS::Get_file_kind($pic['name'])=='photo' || FUNCS::Get_file_kind($pic['name'])=='png'){
                        $_img = new IMG_PROCESS(array(
                            'img_source' => $pic,
                            'save_path'  => '../../upload/',
                            'save_name'  => 'news'.$id.'_img2_'.date('siHdmY')
                        ));
                        $img2 = $_img->saveImg($_img->imgCrop(380,420));
                    }
                    else if(FUNCS::Get_file_kind($pic['name'])=='f-data'){}
                    else $e_msg .= '封面圖請使用jpg、png、gif格式\n';
                    break;
                }
                case 2:{
                    $pic = $_FILES['img3'];
                    if(FUNCS::Get_file_kind($pic['name'])=='photo' || FUNCS::Get_file_kind($pic['name'])=='png'){
                        $_img = new IMG_PROCESS(array(
                            'img_source' => $pic,
                            'save_path'  => '../../upload/',
                            'save_name'  => 'news'.$id.'_img3_'.date('siHdmY')
                        ));
                        $img3 = $_img->saveImg($_img->imgCrop(1200,1700));
                    }
                    else if(FUNCS::Get_file_kind($pic['name'])=='f-data'){}
                    else $e_msg .= '封面圖請使用jpg、png、gif格式\n';
                    break;
                }
            }
            
            if($e_msg==''){
				if($cover!=$rec['cover']&&$rec['cover']) unlink('../../upload/'.$rec['cover']);
				if($img1!=$rec['img1']&&$rec['img1']) unlink('../../upload/'.$rec['img1']);
				if($img2!=$rec['img2']&&$rec['img2']) unlink('../../upload/'.$rec['img2']);
				if($img3!=$rec['img3']&&$rec['img3']) unlink('../../upload/'.$rec['img3']);
				
                $edit_ary = array('cover=?','img1=?','img2=?','img3=?');
                $param_ary = array($cover,$img1,$img2,$img3);
                $param_str = 'ssss';
                $result = updateRecord('news','id='.$id,$edit_ary,$param_ary,$param_str);
            }
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
        $result = deleteRecord('news','id='.$id,array('cover','img1','img2','img3'));
        if($result['status']) $response = $JSONMSG[200];
        else $response = array_merge($JSONMSG[100],array('msg'=>$result['msg']));
        break;
    }
}

// response
echo json_encode($response);
?>