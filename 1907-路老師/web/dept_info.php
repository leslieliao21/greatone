<?php 
require_once 'php.lib/config.php';
require_once 'php.lib/main.php';
require_once 'php.lib/mysqli_class.php';
$DB = new DB_CONN();
$departLogin = departLoginChk();
if(!$departLogin['status']){
    header('Location:dept_signin.php');
    exit;
}
$member = $_SESSION[WEBX.'Dep'];
$depart = getDepart($member['uid']);
if(empty($depart)){
    echo '<script>alert("not found");history.back();</script>';
    exit;
}
?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
    <!-- Basic Data -->
    <meta charset="UTF-8">
    <title>路老師培訓網 | 單位資訊</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="expires" content="0">
    <meta http-equiv="cache-control" content="no-cache">
    <meta name="format-detection" content="telephone=no">
    <!-- <link rel="icon" type="image/ico" href="" /> -->

    <!-- Meta Data -->
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="og:title" content="">
    <meta name="og:description" content="">
    <meta name="og:type" content="website">
    <!-- <meta name="og:image" content="正式網址/images/1200x630.jpg"> -->

    <!-- CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/main.css" />

    <!--[if IE]>
        <script type="text/javascript" src="js/html5shiv.js"></script>
    <![endif]-->

</head>

<body id="dept-page" class="deptInfoPage" data-menu="1">
    <!--Loading-->
    <div id="loading">
        <div class="loader">
            <div class="spinner">

            </div>
        </div>
    </div>

    <header class="page-header"></header>

    <main class="main-container">

        <div class="inside bgWhite pdb-40">
            <h2 class="pageHead">‑ 我要找路老師 ‑</h2>

            <div class="bodyCont">

                <ol class="breadcrumb">
                    <li><a href="index.php">首頁</a></li>
                    <li><a href="teacher_search.php">我要找路老師</a></li>
                    <li class="active">單位資訊</li>
                </ol>
                
                <div class="signout">
                    <div class="showDinlineblock">
                        <label for="deptSelector"><?php echo $member['name'];?> 老師</label>
                        <select name="" id="deptSelector" class="form-control w200">
                            <option value="teacher_search">路老師查詢</option>
                            <option value="dept_info" selected>單位資訊</option>
                        </select>
                    </div>

                    <button type="button" class="btn btn-submit btnInline" onclick="location.href='ajax/dept_signout.php'">登出</button>
                </div>

                <div class="pageCont">
                    <div class="pageBodyTitle">
                        <h4><img src="images/icon/icon_title_list.png" alt="">
                            ‑ 單位資訊 ‑</h4>
                    </div>
                    
                    <p>以下是您的單位</p>

                    <table class="column-table depart">
                        <tr>
                            <th colspan="2"><span class="deptName"><?php echo $depart['title'];?></span></th>
                        </tr>

                        <?php foreach($depart['member'] as $k=>$d){?>
                        <tr>
                            <td>聯絡人</td>
                            <td class="param" data-param="name" data-id="<?php echo $d['id'];?>"><?php echo $d['name'];?></td>
                        </tr>

                        <tr>
                            <td>聯絡電話</td>
                            <td class="param" data-param="phone" data-id="<?php echo $d['id'];?>"><?php echo $d['phone'];?></td>
                        </tr>
                        <?php }?>

                    </table>

                    <?php if(isset($depart['member'][$member['id']])){?>
                    <div class="text-right">
                        <button type="submit" class="btn btn-submit btnInline text-right edit" data-tar="depart">編輯</button>
                        <button type="submit" class="btn btn-submit btnInline text-right hide submit" data-tar="depart">確認</button>
                    </div>
                    <?php }?>

                    <?php foreach($depart['sub'] as $k=>$d){?>
                    <?php if(!isset($depart['member'][$member['id']]) && !isset($d['member'][$member['id']])) continue;?>
                    <table class="column-table subDepart<?php echo $k;?>">
                        <tr>
                            <th colspan="2"><span class="deptSubName param" data-param="title" data-id="<?php echo $depart['id'];?>" data-sid="<?php echo $d['id'];?>"><?php echo $d['title'];?></span></th>
                        </tr>

                        <?php foreach($d['member'] as $kk=>$dd){?>
                        <tr>
                            <td>聯絡人</td>
                            <td class="param" data-param="name" data-id="<?php echo $dd['id'];?>"><?php echo $dd['name'];?></td>
                        </tr>

                        <tr>
                            <td>聯絡電話</td>
                            <td class="param" data-param="phone" data-id="<?php echo $dd['id'];?>"><?php echo $dd['phone'];?></td>
                        </tr>
                        <?php }?>

                    </table>

                    <?php if(isset($depart['member'][$member['id']]) || isset($d['member'][$member['id']])){?>
                    <div class="text-right">
                        <button type="submit" class="btn btn-submit btnInline text-right edit" data-tar="subDepart<?php echo $k;?>">編輯</button>
                        <button type="submit" class="btn btn-submit btnInline text-right hide submit" data-tar="subDepart<?php echo $k;?>">確認</button>
                    </div>
                    <?php }?>
                    <?php }?>

                </div>

            </div>
        </div>
    </main>

    <footer class="page-footer"></footer>


    <!-- Scripts -->
    <script src="js/vendor.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/kits.min.js"></script>
    <!-- main js -->
    <script src="js/main.min.js"></script>
    <script>
    $(document).ready(function(){
        $('#deptSelector').change(function(){
            location.href = $(this).val()+'.php';
        });
        
        $('.edit').click(function(){
            var tar = '.'+$(this).data('tar');
            <?php //if(!isset($depart['member'][$member['id']])){?>
            var $title = $(tar).find('span[data-param=title]');
            $title.html('<input type="text" class="form-control" placeholder="單位名稱" value="'+$title.text()+'" style="max-width:150px;display:inline-block;">');
            <?php //}?>
            var $name = $(tar).find('td[data-param=name]');
            var $phone = $(tar).find('td[data-param=phone]');
            $.each($name,function(i,v){
                $(v).html('<input type="text" class="form-control" placeholder="聯絡人姓名" value="'+$(v).text()+'">');
            });
            $.each($phone,function(i,v){
                $(v).html('<input type="text" class="form-control" placeholder="聯絡人電話" value="'+$(v).text()+'">');
            });
            $(this).addClass('hide');
            $(this).closest('div').find('.submit').removeClass('hide');
        });
        
        $('.submit').click(function(){
            var tar = '.'+$(this).data('tar');
            var formData = {
                name: {},
                phone: {}
            };
            <?php //if(!isset($depart['member'][$member['id']])){?>
            formData.title = {};
            <?php //}?>
            $.each($(tar).find('input'),function(i,v){
                var $param = $(v).closest('.param');
                if($param.data('sid')){
                    formData[$param.data('param')][$param.data('id')] = formData[$param.data('param')][$param.data('id')]||{};
                    formData[$param.data('param')][$param.data('id')][$param.data('sid')] = $(v).val();
                }
                else
                    formData[$param.data('param')][$param.data('id')] = $(v).val();
            });
            
            $.ajax({
                type : 'post',
                url : 'ajax/dept_info.php',
                data : formData,
                dataType : 'json',
                success : function(data){
                    if(data.msgcode == 200){
                        $.each($(tar).find('input'),function(i,v){
                            var $param = $(v).closest('.param');
                            $param.html($(v).val());
                        });
                    }
                    else
                        alert(data.msg);
                }
            });
            
            $(this).addClass('hide');
            $(this).closest('div').find('.edit').removeClass('hide');
        });
    });
    </script>

</body>

</html>