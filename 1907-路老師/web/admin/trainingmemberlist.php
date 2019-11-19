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
    array('name'=>'培訓名單管理')
);

$id = isset($_GET['id'])?FUNCS::inputFilter('id','GET',1):0;
$result = trainingList(array('id'=>$id),1);
$rec = !empty($result)?$result[0]:array();

if(empty($rec)){
    echo '<script>alert("not found");history.back();</script>';
    exit;
}

$crumbs = array_merge(array(
    array('name'=>$rec['year'].' 年度'),
    array('name'=>$rec['title'].' 課程')
),$crumbs);

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
                            <form method="post" action="ajax/export.php" target="_blank">
                            <input type="hidden" name="src" value="training">
                            <input type="hidden" name="id" value="<?php echo $id;?>">
                            帳號(手機):<input type="text" class="schParam" name="account">
                            姓名:<input type="text" class="schParam" name="name">
                            居住地區:
                            <select class="schParam" name="city">
                                <option value="">全部</option>
                                <?php foreach($city as $k=>$d){?>
                                <option value="<?php echo $d['name']?>"><?php echo $d['name'];?></option>
                                <?php }?>
                            </select>
                            <select class="schParam" name="area">
                                <option value="">全部</option>
                            </select>
                            Email:<input type="text" class="schParam" name="email">
                            <br>
                            職業:
                            <select class="schParam" name="career">
                                <option value="">全部</option>
                                <?php for($i=1;$i<count($CAREER);$i++){?>
                                <option value="<?php echo $CAREER[$i];?>"><?php echo $CAREER[$i];?></option>
                                <?php }?>
                            </select>
                            服務單位:<input type="text" class="schParam" name="service">
                            用餐習慣:
                            <select class="schParam" name="dinning">
                                <option value="0">全部</option>
                                <option value="1">葷食</option>
                                <option value="2">素食</option>
                            </select>
                            培訓結果:
                            <select class="schParam" name="status">
                                <option value="-1">全部</option>
                                <option value="0">未出席</option>
                                <option value="1">未完訓</option>
                                <option value="2">完訓</option>
                            </select>
                            </form>
                            <input type="button" id="search" value="查詢" style="float:right;margin-right:5px;" />
                            <input type="button" id="export" value="匯出培訓名單" style="float:right;margin-right:5px;" />
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                </table>
                
                <table class="datatable" align="center" width="100%" style="display:none;">
                    <tr>
                        <th style="text-align:center;width:5%;">編號</th>
                        <th style="text-align:center;width:10%;">姓名</th>
                        <th style="text-align:center;width:10%;">性別</th>
                        <th style="text-align:center;width:10%;">生日</th>
                        <th style="text-align:center;width:15%;">帳號(手機)</th>
                        <th style="text-align:center;width:10%;">服務單位</th>
                        <th style="text-align:center;width:10%;">居住地區</th>
                        <th style="text-align:center;width:10%;">用餐習慣</th>
                        <th style="text-align:center;width:10%;">培訓結果</th>
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
                formData['id'] = '<?php echo $id;?>';
                $.each($('.schParam'),function(i,v){
                    switch($(v).attr('name')){
                        case 'account':{}
                        case 'name':{}
                        case 'city':{}
                        case 'area':{}
                        case 'email':{}
                        case 'career':{}
                        case 'service':{}
                        case 'dinning':{}
                        case 'status':{ $(v).val()!='' && (formData[$(v).attr('name')] = $(v).val()); break; }
                    }
                });
                $.ajax({
                    type : 'post',
                    url : 'ajax/trainingmemberlist.php',
                    data : formData,
                    dataType : 'json',
                    success : function(data){
                        if(data.msgcode == 200){
                            $.each(data.data,function(i,v){
                                $('.datatable').append('<tr data-id="'+v.id+'">\
                                    <td>'+v.id+'</td>\
                                    <td>'+v.name+'</td>\
                                    <td>'+(['','男','女'][v.gender]||'')+'</td>\
                                    <td>'+v.birthday+'</td>\
                                    <td>'+v.account+'</td>\
                                    <td>'+v.service+'</td>\
                                    <td>'+v.city+' '+v.area+'</td>\
                                    <td>'+(['','葷食','素食'][v.dinning]||'')+'</td>\
                                    <td>\
                                        <input type="radio" id="status'+v.id+'_0" name="status'+v.id+'" value="0"'+(v.status==0?' checked':'')+'>\
                                        <label for="status'+v.id+'_0">未出席</label><br>\
                                        <input type="radio" id="status'+v.id+'_1" name="status'+v.id+'" value="1"'+(v.status==1?' checked':'')+'>\
                                        <label for="status'+v.id+'_1">未完訓</label><br>\
                                        <input type="radio" id="status'+v.id+'_2" name="status'+v.id+'" value="2"'+(v.status==2?' checked':'')+'>\
                                        <label for="status'+v.id+'_2">完訓</label><br>\
                                    </td>\
                                </tr>');
                            });
                            
                            $('input[type=radio]').click(function(){
                                var $rec = $(this).closest('tr');
                                var formData = {
                                    etype : 'review',
                                    id : $rec.data('id'),
                                    status: $rec.find('input[type=radio]:checked').val()
                                };
                                $.ajax({
                                    type : 'post',
                                    url : 'ajax/trainingmemberedit.php',
                                    data : formData,
                                    dataType : 'json',
                                    success : function(data){
                                        if(data.msgcode == 200)
                                            loadList(pg);
                                        else
                                            alert(data.msg);
                                    }
                                });
                            });
                            
                            if(data.pages>1){
                                $('.datatable').append('<tr class="pagelist"><td colspan="9" style="text-align:right;">'+minePage(parseInt(data.page),parseInt(data.pages))+'</td></tr>');
                                
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
            }).change();
            
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