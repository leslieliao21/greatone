<?php 
require_once '../php.lib/config.php';
require_once '../php.lib/main.php';
require_once '../php.lib/functions.php';
require_once '../php.lib/mysqli_class.php';
$result = loginChk();
if(!$result['status']){ header('Location:login.php?rn='.rand()); exit; }
$siteMap = $result['siteMap'];
$DB = new DB_CONN();
$crumbs = array(
    array('name'=>'附屬單位管理')
);

$id = isset($_GET['id'])?FUNCS::inputFilter('id','GET',1):0;
$result = unitList(array('id'=>$id),1);
$rec = !empty($result)?$result[0]:array();
if(empty($rec)){
    echo '<script>alert("not found");history.back();</script>';
    exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Administration of Web Service</title>
        <link type='text/css' rel='stylesheet' href='css/basic_setting.css' />
        <link type='text/css' rel='stylesheet' href='css/jquery_treeview.css' />
        <style>
            .searchtable input[type="text"]{
                width: 100px;
            }
        </style>
    </head>
    <body>
        <div id="mainPageLayout" class="comRange">
            <?php require_once 'tpls/header.php';?>
            <?php require_once 'tpls/menu.php';?>
            <div id="mainContent">
                <?php require_once 'tpls/crumb.php';?>
                <table class="datatable" align="center" width="100%" style="display:none;">
                    <tr>
                        <th style="text-align:center;width:5%;">編號</th>
                        <th style="text-align:center;width:10%;">單位</th>
                        <th style="text-align:center;width:10%;">排序</th>
                        <th style="text-align:center;width:10%;">維護</th>
                    </tr>
                </table>

                <table width="100%" cellspacing="1" cellpadding="5" border="0" align="center" class="dataInsertTable">
                    <tr>
                        <td style="text-align:center;">
                            <input type="button" id="add" value="新增" />
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="clearboth"></div>

        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script type="text/javascript" src="../js.lib/jquery_cookie.js"></script>
        <script type="text/javascript" src="../js.lib/jquery_treeview.js"></script>
        <script type="text/javascript" src="../js.lib/functions.js"></script>
        <script type="text/javascript" src="../js.lib/parameters.js"></script>
        <script src="../js.lib/viewer.min.js"></script>
        <script type="text/javascript" src="js/tpl.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
        <script type="text/javascript">
        (function(){
            var page = 1;
            function loadList(pg){
                $('.datatable').css({display:'none'});
                $('.datatable tr:not(:eq(0))').remove();
                var formData = {};
                formData['page'] = pg||1;
                formData['uid'] = '<?php echo $id;?>';
                $.ajax({
                    type : 'post',
                    url : 'ajax/subunitlist.php',
                    data : formData,
                    dataType : 'json',
                    success : function(data){
                        if(data.msgcode == 200){
                            $.each(data.data,function(i,v){
                                addRecord(v);
                            });
                        }
                        else
                            alert(data.msg);
                    }
                });
            }
            
            function addRecord(rec){
                var $rec = $('<tr data-id="'+(rec?rec.id:'')+'">\
                        <td class="recId">'+(rec?rec.id:'')+'</td>\
                        <td class="recTitle">'+(rec?rec.title:'')+'</td>\
                        <td>\
                            <a class="upBtn" href="javascript:;">上移</a>\
                            <a class="downBtn" href="javascript:;">下移</a>\
                        </td>\
                        <td>\
                            <a class="editBtn" href="javascript:;">編輯</a>\
                            <a class="delBtn" href="javascript:;">刪除</a>\
                            <input type="button" class="confirmBtn" value="確認">\
                        </td>\
                    </tr>');
                rec?$('.datatable').append($rec):$('.datatable tr:eq(0)').after($rec);
                
                $rec.find('.confirmBtn').click(function(){
                    var formData = {
                        etype : 'edit',
                        id : $rec.data('id'),
                        uid : '<?php echo $id;?>',
                        title : $rec.find('.recTitle input').val()
                    };
                    
                    if(!formData.title) return alert('請輸入單位名稱');
                    
                    $.ajax({
                        type : 'post',
                        url : 'ajax/subunitedit.php',
                        data : formData,
                        dataType : 'json',
                        success : function(data){
                            if(data.msgcode == 200)
                                alert('編輯成功'), loadList(page), $('.dataInsertTable').css('display','table');
                            else
                                alert(data.msg);
                        }
                    });
                });
                
                $rec.find('.editBtn').click(function(){
                    $('.dataInsertTable').css('display','none');
                    $('.upBtn').css('display','none');
                    $('.downBtn').css('display','none');
                    $('.editBtn').css('display','none');
                    $rec.find('.subBtn').css('display','none');
                    $rec.find('.delBtn').css('display','none');
                    $rec.find('.confirmBtn').css('display','inline-block');
                    $rec.find('.recTitle').html('<input type="text" value="'+$rec.find('.recTitle').text()+'">');
                });

                $rec.find('.delBtn').click(function(){
                    if(!confirm('確認刪除這筆資料?')) return;
                    var formData = {
                        etype : 'del',
                        id : $(this).closest('tr').data('id')
                    };
                    $.ajax({
                        type : 'post',
                        url : 'ajax/subunitedit.php',
                        data : formData,
                        dataType : 'json',
                        success : function(data){
                            if(data.msgcode == 200)
                                alert('刪除成功'), loadList(page);
                            else
                                alert(data.msg);
                        }
                    });
                });

                $rec.find('.upBtn').click(function(){
                    var id1 = $(this).closest('tr').data('id'),
                        ind = $(this).closest('tr').index(),
                        id2 = ind>1?$('.datatable tr').eq(ind-1).data('id'):0;
                    if(!id2) return alert('已是最前面的資料了');
                    $.ajax({
                        type : 'post',
                        url : 'ajax/subunitedit.php',
                        data : { etype: 'sort', id1: id1, id2: id2 },
                        dataType : 'json',
                        success : function(res){
                            if(res.msgcode == 200)
                                loadList(page);
                            else
                                alert(res.msg);
                        }
                    });
                });

                $rec.find('.downBtn').click(function(){
                    var id1 = $(this).closest('tr').data('id'),
                        ind = $(this).closest('tr').index(),
                        id2 = ind<$('.datatable tr').length-1?$('.datatable tr').eq(ind+1).data('id'):0;
                    if(!id2) return alert('已是最後面的資料了');
                    $.ajax({
                        type : 'post',
                        url : 'ajax/subunitedit.php',
                        data : { etype: 'sort', id1: id1, id2: id2 },
                        dataType : 'json',
                        success : function(res){
                            if(res.msgcode == 200)
                                loadList(page);
                            else
                                alert(res.msg);
                        }
                    });
                });
                
                $rec.find('.confirmBtn').css('display','none');
                $('.datatable').css({display:'table'});
                if(!rec) $rec.find('.editBtn').click();
            }
            
            $('#add').click(function(){
                addRecord();
            });
            
            loadList();
        })();
        </script>
    </body>
</html>