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
    array('name'=>'得獎名單管理')
);

$award = awardList(array(),0);
$city = cityList();
$area = areaList();
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
                            獎項:
                            <select class="schParam" name="award">
                                <option value="0">全部</option>
                                <?php foreach($award as $k=>$d){?>
                                <option value="<?php echo $d['id'];?>"><?php echo $d['title'];?></option>
                                <?php }?>
                            </select>
                            姓名:<input type="text" class="schParam" name="name">
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
                        <th style="text-align:center;width:10%;">獎項</th>
                        <th style="text-align:center;width:10%;">姓名</th>
                        <th style="text-align:center;width:10%;">性別</th>
                        <th style="text-align:center;width:15%;">生日</th>
                        <th style="text-align:center;width:10%;">手機</th>
                        <th style="text-align:center;width:10%;">居住縣市</th>
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
            var award = {};
            <?php foreach($award as $k=>$d){?>
            award['<?php echo $d['id'];?>'] = '<?php echo $d['title'];?>';
            <?php }?>
            var city = {};
            <?php foreach($city as $k=>$d){?>
            city['<?php echo $d['name'];?>'] = '<?php echo $d['name'];?>';
            <?php }?>
            var area = {};
            <?php foreach($area as $k=>$d){?>
            area['<?php echo $d['cityname'];?>'] = area['<?php echo $d['cityname'];?>']||{};
            area['<?php echo $d['cityname'];?>']['<?php echo $d['name'];?>'] = '<?php echo $d['name'];?>';
            <?php }?>
            var page = 1;
            function loadList(pg){
                $('.datatable').css({display:'none'});
                $('.datatable tr:not(:eq(0))').remove();
                var formData = {};
                formData['page'] = pg||1;
                $.each($('.schParam'),function(i,v){
                    switch($(v).attr('name')){
                        case 'award':{}
                        case 'name':{ $(v).val()!='' && (formData[$(v).attr('name')] = $(v).val()); break; }
                    }
                });
                $.ajax({
                    type : 'post',
                    url : 'ajax/winnerlist.php',
                    data : formData,
                    dataType : 'json',
                    success : function(data){
                        if(data.msgcode == 200){
                            $.each(data.data,function(i,v){
                                $('.datatable').append('<tr data-id="'+v.id+'">\
                                    <td>'+v.id+'</td>\
                                    <td>'+(award[v.aid]||'')+'</td>\
                                    <td>'+v.name+'</td>\
                                    <td>'+(['','男','女'][v.gender]||'')+'</td>\
                                    <td>'+v.birthday+'</td>\
                                    <td>'+v.account+'</td>\
                                    <td>'+v.city+' '+v.area+'</td>\
                                    <td>\
                                        <a class="editBtn" href="javascript:;">編輯</a>\
                                        <a class="delBtn" href="javascript:;">刪除</a>\
                                    </td>\
                                </tr>');
                            });
                            
                            $('.editBtn').click(function(){
                                location.href = 'winneredit.php?id='+$(this).closest('tr').data('id');
                            });
                            
                            $('.delBtn').click(function(){
                                if(!confirm('確認刪除這筆資料?')) return;
                                var formData = {
                                    etype : 'del',
                                    id : $(this).closest('tr').data('id')
                                };
                                $.ajax({
                                    type : 'post',
                                    url : 'ajax/winneredit.php',
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
                            
                            if(data.pages>1){
                                $('.datatable').append('<tr class="pagelist"><td colspan="8" style="text-align:right;">'+minePage(parseInt(data.page),parseInt(data.pages))+'</td></tr>');
                                
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
                location.href = 'winneredit.php';
            });
            
            $('#search').click(function(){
                loadList();
            });
            
            loadList();
        })();
        </script>
    </body>
</html>