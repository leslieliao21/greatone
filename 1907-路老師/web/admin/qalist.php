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
    array('name'=>'Q&A管理')
);
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
                <table class="searchtable" width="100%" cellspacing="0" cellpadding="7" id="fn_table" style="border:1px solid #ccc;margin:0;line-height:24px;">
                    <tr>
                        <td>
                            問題:<input type="text" class="schParam" name="title">
                            上架狀態:
                            <select class="schParam" name="status">
                                <option value="2">全部</option>
                                <option value="1">上架</option>
                                <option value="0">下架</option>
                            </select>
                            <input type="button" id="add" value="新增" style="float:right;margin-right:5px;" />
                            <input type="button" id="search" value="查詢" style="float:right;margin-right:5px;" />
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                </table>
                
                <table class="datatable" align="center" width="100%" style="display:none;">
                    <tr>
                        <th style="text-align:center;width:5%;">編號</th>
                        <th style="text-align:center;width:10%;">問題</th>
                        <th style="text-align:center;width:10%;">答案</th>
                        <th style="text-align:center;width:15%;">上架狀態</th>
                        <th style="text-align:center;width:10%;">排序</th>
                        <th style="text-align:center;width:10%;">維護</th>
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
                $.each($('.schParam'),function(i,v){
                    switch($(v).attr('name')){
                        case 'title':{}
                        case 'sdate':{}
                        case 'edate':{}
                        case 'status':{ $(v).val()!='' && (formData[$(v).attr('name')] = $(v).val()); break; }
                    }
                });
                $.ajax({
                    type : 'post',
                    url : 'ajax/qalist.php',
                    data : formData,
                    dataType : 'json',
                    success : function(data){
                        if(data.msgcode == 200){
                            $.each(data.data,function(i,v){
                                $('.datatable').append('<tr data-id="'+v.id+'">\
                                    <td>'+v.id+'</td>\
                                    <td>'+nl2br(v.title)+'</td>\
                                    <td>'+nl2br(v.content)+'</td>\
                                    <td>'+(['下架','上架'][v.status]||'')+'</td>\
                                    <td>\
                                        <a class="upBtn" href="javascript:;">上移</a>\
                                        <a class="downBtn" href="javascript:;">下移</a>\
                                    </td>\
                                    <td>\
                                        <a class="editBtn" href="javascript:;">編輯</a>\
                                        <a class="delBtn" href="javascript:;">刪除</a>\
                                    </td>\
                                </tr>');
                            });
                            
                            $('.editBtn').click(function(){
                                location.href = 'qaedit.php?id='+$(this).closest('tr').data('id');
                            });
                            
                            $('.delBtn').click(function(){
                                if(!confirm('確認刪除這筆資料?')) return;
                                var formData = {
                                    etype : 'del',
                                    id : $(this).closest('tr').data('id')
                                };
                                $.ajax({
                                    type : 'post',
                                    url : 'ajax/qaedit.php',
                                    data : formData,
                                    dataType : 'json',
                                    success : function(data){
                                        if(data.msgcode == 200)
                                            alert('刪除成功'), loadList(pg);
                                        else
                                            alert(data.msg);
                                    }
                                });
                            });
                            
                            $('.datatable .upBtn').click(function(){
                                var id1 = $(this).closest('tr').data('id'),
                                    ind = $(this).closest('tr').index(),
                                    id2 = ind>1?$('.datatable tr').eq(ind-1).data('id'):data.previd;
                                if(!id2) return alert('已是最前面的資料了');
                                $.ajax({
                                    type : 'post',
                                    url : 'ajax/qaedit.php',
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
                            
                            $('.datatable .downBtn').click(function(){
                                var id1 = $(this).closest('tr').data('id'),
                                    ind = $(this).closest('tr').index(),
                                    id2 = ind<$('.datatable tr').length-1?$('.datatable tr').eq(ind+1).data('id'):data.nextid;
                                if(!id2) return alert('已是最後面的資料了');
                                $.ajax({
                                    type : 'post',
                                    url : 'ajax/qaedit.php',
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
                            
                            if(data.pages>1){
                                $('.datatable').append('<tr class="pagelist"><td colspan="6" style="text-align:right;">'+minePage(parseInt(data.page),parseInt(data.pages))+'</td></tr>');
                                
                                $('.datatable .pagelist a').click(function(){
                                    page = parseInt($(this).data('pg'));
                                    loadList(page);
                                });
                            }
                            
                            data.data.length && $('.datatable').css({display:'table'});
                            $('.searchtable tr:eq(1) td').html('總筆數：'+data.all+' 符合條件的筆數：'+data.count);
                        }
                        else
                            alert(data.msg);
                    }
                });
            }
            
            $('#add').click(function(){
                location.href = 'qaedit.php';
            });
            
            $('#search').click(function(){
                loadList();
            });
            
            loadList();
        })();
        </script>
    </body>
</html>