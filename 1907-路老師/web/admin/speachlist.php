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
    array('name'=>'宣講歷程管理')
);

$plan = planList(array(),0);
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
        <link type='text/css' rel='stylesheet' href='../js.lib/datetimepicker/jquery.datetimepicker.css' />
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
                            <form method="post" action="ajax/export.php" target="_blank">
                            <input type="hidden" name="src" value="speach">
                            宣講主題:<input type="text" class="schParam" name="title">
                            教案:
                            <select class="schParam" name="plan">
                                <option value="0">全部</option>
                                <?php foreach($plan as $k=>$d){?>
                                <option value="<?php echo $d['id'];?>"><?php echo $d['title'];?></option>
                                <?php }?>
                            </select>
                            宣講日期:
                            <input type="text" class="schParam date" name="sdate"> ~
                            <input type="text" class="schParam date" name="edate">
                            登錄日期:
                            <input type="text" class="schParam date" name="csdate"> ~
                            <input type="text" class="schParam date" name="cedate">
                            <br>
                            宣講縣市:
                            <select class="schParam" name="city">
                                <option value="">全部</option>
                                <?php foreach($city as $k=>$d){?>
                                <option value="<?php echo $d['name'];?>"><?php echo $d['name'];?></option>
                                <?php }?>
                            </select>
                            <select class="schParam" name="area">
                                <option value="">全部</option>
                            </select>
                            路老師姓名:<input type="text" class="schParam" name="name">
                            路老師手機:<input type="text" class="schParam" name="account">
                            審查狀態:
                            <select class="schParam" name="status">
                                <option value="-2">全部</option>
                                <option value="0">待審查</option>
                                <option value="1">通過</option>
                                <option value="2">退件</option>
                            </select>
                            </form>
                            <input type="button" id="search" value="查詢" style="float:right;margin-right:5px;" />
                            <input type="button" id="export" value="匯出" style="float:right;margin-right:5px;" />
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                </table>
                
                <table class="datatable" align="center" width="100%" style="display:none;">
                    <tr>
                        <th style="text-align:center;width:5%;">編號</th>
                        <th style="text-align:center;width:15%;">教案</th>
                        <th style="text-align:center;width:9%;">宣講單位</th>
                        <th style="text-align:center;width:5%;">宣講日期</th>
                        <th style="text-align:center;width:5%;">登錄日期</th>
                        <th style="text-align:center;width:9%;">宣講地區</th>
                        <th style="text-align:center;width:15%;">宣講主題</th>
                        <th style="text-align:center;width:9%;">路老師姓名</th>
                        <th style="text-align:center;width:9%;">路老師手機</th>
                        <th style="text-align:center;width:5%;">總宣講時數(分鐘)</th>
                        <th style="text-align:center;width:5%;">審核狀態</th>
                        <th style="text-align:center;width:9%;">維護</th>
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
        <script type="text/javascript" src="../js.lib/datetimepicker/jquery.datetimepicker.js"></script>
        <script type="text/javascript" src="js/tpl.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
        <script type="text/javascript">
        (function(){
            var city = {};
            <?php foreach($city as $k=>$d){?>
            city['<?php echo $d['name'];?>'] = '<?php echo $d['name'];?>';
            <?php }?>
            var area = {};
            <?php foreach($area as $k=>$d){?>
            area['<?php echo $d['cityname'];?>'] = area['<?php echo $d['cityname'];?>']||{};
            area['<?php echo $d['cityname'];?>']['<?php echo $d['name'];?>'] = '<?php echo $d['name'];?>';
            <?php }?>
            var plan = {};
            <?php foreach($plan as $k=>$d){?>
            plan['<?php echo $d['id'];?>'] = '<?php echo $d['title'];?>';
            <?php }?>
            var page = 1;
            function loadList(pg){
                $('.datatable').css({display:'none'});
                $('.datatable tr:not(:eq(0))').remove();
                var formData = {};
                formData['page'] = pg||1;
                $.each($('.schParam'),function(i,v){
                    switch($(v).attr('name')){
                        case 'title':{}
                        case 'plan':{}
                        case 'sdate':{}
                        case 'edate':{}
                        case 'csdate':{}
                        case 'cedate':{}
                        case 'city':{}
                        case 'area':{}
                        case 'name':{}
                        case 'account':{}
                        case 'status':{ $(v).val()!='' && (formData[$(v).attr('name')] = $(v).val()); break; }
                    }
                });
                $.ajax({
                    type : 'post',
                    url : 'ajax/speachlist.php',
                    data : formData,
                    dataType : 'json',
                    success : function(data){
                        if(data.msgcode == 200){
                            $.each(data.data,function(i,v){
                                var plans = v.plan.split(',');
                                var _plan = [];
                                $.each(plans,function(ii,vv){
                                    if(plan[vv])
                                        _plan.push(plan[vv]);
                                });
                                $('.datatable').append('<tr data-id="'+v.id+'">\
                                    <td>'+v.id+'</td>\
                                    <td>'+_plan.join(',')+'</td>\
                                    <td>'+v.audience+'</td>\
                                    <td>'+v.speachdate+'</td>\
                                    <td>'+v.createtime.substr(0,10)+'</td>\
                                    <td>'+v.city+' '+v.area+'</td>\
                                    <td>'+v.title+'</td>\
                                    <td>'+v.name+'</td>\
                                    <td>'+v.account+'</td>\
                                    <td>'+v.minutes+'</td>\
                                    <td>'+(['待審查','通過','退件'][v.status]||'')+'</td>\
                                    <td>\
                                        <a class="editBtn" href="javascript:;">審查</a>\
                                        <a class="delBtn" href="javascript:;">刪除</a>\
                                    </td>\
                                </tr>');
                            });
                            
                            $('.editBtn').click(function(){
                                location.href = 'speachedit.php?id='+$(this).closest('tr').data('id');
                            });
                            
                            $('.delBtn').click(function(){
                                if(!confirm('確認刪除這筆資料?')) return;
                                var formData = {
                                    etype : 'del',
                                    id : $(this).closest('tr').data('id')
                                };
                                $.ajax({
                                    type : 'post',
                                    url : 'ajax/speachedit.php',
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
                                $('.datatable').append('<tr class="pagelist"><td colspan="12" style="text-align:right;">'+minePage(parseInt(data.page),parseInt(data.pages))+'</td></tr>');
                                
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
            
            $('select[name=city]').change(function(){
                $('select[name=area]').html('<option value="">全部</option>');
                if(!area[$(this).val()]) return;
                $.each(area[$(this).val()],function(i,v){
                    $('select[name=area]').append('<option value="'+i+'">'+v+'</option>');
                });
            });
            
            $('.date').datetimepicker({
                lang: 'ch',
                format: 'Y-m-d',
                scrollInput: false,
                closeOnDateSelect: true,
                timepicker: false
            });
            
            $('#search').click(function(){
                loadList();
            });
            
            $('#export').click(function(){
                $('form').submit();
            });
            
            loadList();
        })();
        </script>
    </body>
</html>