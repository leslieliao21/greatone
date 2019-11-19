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
    array('name'=>'編輯首頁看版')
);

$id = isset($_GET['id'])?FUNCS::inputFilter('id','GET',1):0;
$result = winnerList(array('id'=>$id),1);
$rec = !empty($result)?$result[0]:array();

$award = awardList(array(),0);
$gender = array('','男','女');
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
        <link type='text/css' rel='stylesheet' href='css/lb.css' />
        <style>
            img {
                max-width: 100%;
            }
        </style>
    </head>
    <body>
        <div id="mainPageLayout" class="comRange">
            <?php require_once 'tpls/header.php';?>
            <?php require_once 'tpls/menu.php';?>
            <div id="mainContent">
                <?php require_once 'tpls/crumb.php';?>
                <form enctype="multipart/form-data" action="ajax/winneredit.php" method="post">
                <input type="hidden" name="etype" id="etype" value="edit" />
                <input type="hidden" name="id" id="id" value="<?php echo !empty($rec)?$rec['id']:'';?>" />
                <input type="hidden" name="tid" id="tid" class="ness" data-ness="得獎人" value="<?php echo !empty($rec)?$rec['tid']:'';?>" />
                <table width="100%" cellspacing="1" cellpadding="5" border="0" align="center" class="dataInsertTable">
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*獎項：</th>
                        <td width="80%" valign="top" align="left">
                            <select name="aid" class="ness" data-ness="獎項">
                                <?php foreach($award as $k=>$d){?>
                                <option value="<?php echo $d['id'];?>"<?php echo !empty($rec)&&$rec['aid']==$d['id']?' selected':'';?>><?php echo $d['title'];?></option>
                                <?php }?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">得獎者查詢：</th>
                        <td width="80%" valign="top" align="left">
                            <input type="button" id="searchWinner" value="查詢" />
                        </td>
                    </tr>
					<tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*得獎者姓名：</th>
                        <td width="80%" valign="top" align="left" class="winnerName">
                            <?php echo !empty($rec)?$rec['name']:'';?>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*得獎者性別：</th>
                        <td width="80%" valign="top" align="left" class="winnerGender">
                            <?php echo !empty($rec)&&isset($gender[$rec['gender']])?$gender[$rec['gender']]:'';?>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" valign="middle" align="right" bgcolor="#6f86ab">*得獎者生日：</th>
                        <td width="80%" valign="top" align="left" class="winnerBirthday">
                            <?php echo !empty($rec)?$rec['birthday']:'';?>
                        </td>
                    </tr>
                </table>
                </form>

                <table width="100%" cellspacing="1" cellpadding="5" border="0" align="center" class="dataInsertTable">
                    <tr>
                        <td style="text-align:center;">
                            <input type="button" id="save" value="儲存" />
                            <input type="button" id="cancel" value="取消" />
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="clearboth"></div>
        
        <div class="lb" data-lb="search">
            <div class="lbbox lb-search">
                <div class="btn_x"><img src="images/lb_btn_x.png" alt=""></div>
                <table class="searchtable" width="100%" cellspacing="0" cellpadding="7" id="fn_table" style="border:1px solid #ccc;margin:0;line-height:24px;">
                    <tr>
                        <td>
                            路老師帳號(手機):<input type="text" class="schParam" name="account">
                            路老師姓名:<input type="text" class="schParam" name="name">
                            <input type="button" id="search" value="查詢" style="float:right;margin-right:5px;" />
                        </td>
                    </tr>
                </table>
                
                <table class="datatable" align="center" width="100%" style="display:none;">
                    <tr>
                        <th style="text-align:center;width:5%;">編號</th>
                        <th style="text-align:center;width:10%;">姓名</th>
                        <th style="text-align:center;width:10%;">性別</th>
                        <th style="text-align:center;width:10%;">生日</th>
                        <th style="text-align:center;width:15%;">帳號</th>
                        <th style="text-align:center;width:10%;">居住區域</th>
                        <th style="text-align:center;width:10%;">選取</th>
                    </tr>
                </table>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script type="text/javascript" src="../js.lib/jquery_cookie.js"></script>
        <script type="text/javascript" src="../js.lib/jquery_treeview.js"></script>
        <script type="text/javascript" src="../js.lib/functions.js"></script>
        <script type="text/javascript" src="../js.lib/parameters.js"></script>
        <script type="text/javascript" src="../js.lib/TweenMax.min.js"></script>
        <script type="text/javascript" src="js/lb.js"></script>
        <script type="text/javascript" src="js/tpl.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
        <script type="text/javascript">
        (function(){
            var gender = JSON.parse('<?php echo json_encode($gender);?>');
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
                        case 'account':{}
                        case 'name':{ $(v).val()!='' && (formData[$(v).attr('name')] = $(v).val()); break; }
                    }
                });
                $.ajax({
                    type : 'post',
                    url : 'ajax/teacherlist.php',
                    data : formData,
                    dataType : 'json',
                    success : function(data){
                        if(data.msgcode == 200){
                            $.each(data.data,function(i,v){
                                $('.datatable').append('<tr data-id="'+v.id+'" data-name="'+v.name+'" data-gender="'+(['','男','女'][v.gender]||'')+'" data-birthday="'+v.birthday+'">\
                                    <td>'+v.id+'</td>\
                                    <td>'+v.name+'</td>\
                                    <td>'+(['','男','女'][v.gender]||'')+'</td>\
                                    <td>'+v.birthday+'</td>\
                                    <td>'+v.account+'</td>\
                                    <td>'+v.city+' '+v.area+'</td>\
                                    <td>\
                                        <input type="button" class="confirmBtn" value="確認">\
                                    </td>\
                                </tr>');
                            });
                            
                            $('.confirmBtn').click(function(){
                                var $rec = $(this).closest('tr');
                                $('#tid').val($rec.data('id'));
                                $('.winnerName').html($rec.data('name'));
                                $('.winnerGender').html($rec.data('gender'));
                                $('.winnerBirthday').html($rec.data('birthday'));
                                
                                lbClose('search');
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
            
            $('#search').click(function(){
                loadList();
            });
            
            $('#searchWinner').click(function(){
                lbOpen('search');
            });
            
            $('#save').click(function(){
				if(!chkNessInput($('form'))) return;
                $('form').submit();
            });
            
            $('#cancel').click(function(){
                history.back();
            });
        })();
        </script>
    </body>
</html>