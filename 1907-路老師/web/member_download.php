<?php 
require_once 'php.lib/config.php';
require_once 'php.lib/main.php';
require_once 'php.lib/mysqli_class.php';
$DB = new DB_CONN();
$memberLogin = memberLoginChk();
if(!$memberLogin['status']){
    header('Location:signin.php');
    exit;
}
$member = $_SESSION[WEBX.'Mem'];
if(!in_array($member['qualify'],array(1,2))){
    header('Location:member.php');
    exit;
}

$types = array();
$result = planTypeList(array(),0);
foreach($result as $k=>$d)
    $types[$d['id']] = $d;

$plans = planList(array('publish'=>1),0);

function getFileType($fn){
    if(substr($fn,-4)=='.doc'||substr($fn,-5)=='.docx')
        return 'download_word';
    if(substr($fn,-4)=='.mp4')
        return 'download_video';
    return 'download_zip';
}
?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
    <!-- Basic Data -->
    <meta charset="UTF-8">
    <title>路老師培訓網 | 教案下載</title>
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

<body id="member-page" class="affairsDownloadPage" data-menu="0">
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
            <h2 class="pageHead">‑ 路老師專區 ‑</h2>

            <div class="bodyCont">

                <ol class="breadcrumb">
                    <li><a href="index.php">首頁</a></li>
                    <li><a href="member.php">路老師專區</a></li>
                    <li class="active">教案下載</li>
                </ol>
                
                <div class="signout">
                    <div class="showDinlineblock">
                        <label for="memberSelector"><?php echo $member['name'];?> 老師</label>
                        <select name="" id="memberSelector" class="form-control w200">
                            <option value="member">路老師專區</option>
                            <?php if(in_array($member['qualify'],array(1,2))){?>
                            <option value="member_affairs">個人宣講歷程</option>
                            <option value="member_affairs_record">宣講歷程登錄</option>
                            <option value="member_download" selected>教案下載</option>
                            <?php }?>
                            <option value="member_application">培訓報名</option>
                            <option value="member_info">個人資料</option>
                        </select>
                    </div>

                    <button type="button" class="btn btn-submit btnInline" onclick="location.href='ajax/signout.php'">登出</button>
                </div>

                <div class="pageCont">
                    <div class="pageBodyTitle">
                        <h4><img src="images/icon/icon_title_download.png" alt="">
                            ‑ 教案下載 ‑
                        </h4>
                        <div>
                            <label for="">排列順序</label>
                            <select name="" id="planSort" class="form-control">
                                <option value="0">類別</option>
                                <option value="1">內容</option>
                                <option value="2">日期</option>
                            </select>
                            <label for="">顯示</label>
                            <select name="" id="planShow" class="form-control">
                                <option value="">全部類別</option>
                                <?php foreach($types as $k=>$d){?>
                                <option value="<?php echo $d['id'];?>"><?php echo $d['title'];?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>

                    <table id="planList" class="responsive-table table-in-smallscreen">
                        <tr>
                            <th>類別</th>
                            <th>內容</th>
                            <th>日期</th>
                            <th>檔案下載</th>
                        </tr>
                        <?php foreach($plans as $k=>$d){?>
                        <tr data-type="<?php echo $d['type'];?>">
                            <td data-th="類別">
                                <p><?php echo isset($types[$d['type']])?$types[$d['type']]['title']:'';?></p>
                            </td>
                            <td data-th="內容">
                                <p><?php echo $d['title'];?></p>
                            </td>
                            <td data-th="日期">
                                <p><?php echo mingoDate($d['publishdate'],'y').'.'.mingoDate($d['publishdate'],'m').'.'.mingoDate($d['publishdate'],'d');?></p>
                            </td>
                            <td data-th="檔案下載">
                                <p>
                                    <a href="ajax/download.php?id=<?php echo $d['id'];?>&fn=all" target="_blank" class="block">
                                        <i class="glyphicon glyphicon-save cOrange"></i>
                                        打包全部
                                    </a>
                                    <?php for($i=1;$i<=6;$i++){?>
                                    <?php if(!$d['file'.$i]) continue;?>
                                    <a href="ajax/download.php?id=<?php echo $d['id'];?>&fn=<?php echo $i;?>" target="_blank" class="<?php echo getFileType($d['file'.$i]);?>"><?php echo $d['fn'.$i];?></a>
                                    <?php }?>
                                </p>
                            </td>
                        </tr>
                        <?php }?>
                    </table>
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
        $('#memberSelector').change(function(){
            location.href = $(this).val()+'.php';
        });
        
        $('#planShow').change(function(){
            if($(this).val()){
                $('#planList tr').not(':eq(0)').addClass('hide');
                $('#planList tr[data-type='+$(this).val()+']').removeClass('hide');
            }
            else
                $('#planList tr').removeClass('hide');
        });
        
        $('#planSort').change(function(){
            var ind = $(this).val();
            var ary = [];
            $.each($('#planList tr').not(':eq(0)'),function(i,v){
                ary.push({tr:$(v),key:$(v).find('td:eq('+ind+')').text().trim()});
            });
            ary = ary.sort(function(a,b){
                return a.key>b.key?1:-1;
            });
            $.each(ary,function(i,v){
                $('#planList').append(v.tr);
            });
        });
    });
    </script>
</body>

</html>