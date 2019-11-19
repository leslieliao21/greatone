<?php 
require_once 'php.lib/config.php';
require_once 'php.lib/main.php';
require_once 'php.lib/functions.php';
require_once 'php.lib/mysqli_class.php';
$DB = new DB_CONN();
$memberLogin = memberLoginChk();
if(!$memberLogin['status']){
    header('Location:signin.php');
    exit;
}
$member = $_SESSION[WEBX.'Mem'];

$id = isset($_GET['id'])?FUNCS::inputFilter('id','GET',1):0;
$result = trainingList(array('status'=>1,'id'=>$id),1);
$rec = !empty($result)?$result[0]:array();
// 實習教師只能報名初訓
if(empty($rec) || ($member['qualify']!=1&&$rec['type']==2)){
    echo '<script>alert("not found");history.back();</script>';
    exit;
}

if($rec['sdate']<=date('Y-m-d')){
    echo '<script>alert("報名時間已過");history.back();</script>';
    exit;
}

$rec['date'] = date('m/d',strtotime($rec['sdate'])).($rec['sdate']!='0000-00-00'&&$rec['edate']!='0000-00-00'?',':'').date('m/d',strtotime($rec['edate']));
$rec['time'] = date('H:i',strtotime($rec['stime'])).($rec['stime']!='00:00:00'&&$rec['etime']!='00:00:00'?'~':'').date('H:i',strtotime($rec['etime']));
?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
    <!-- Basic Data -->
    <meta charset="UTF-8">
    <title>路老師培訓網 | 培訓報名</title>
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

<body id="member-page" class="affairsApplyPage" data-menu="0">
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
                    <li class="active">培訓報名</li>
                </ol>
                
                <div class="signout">
                    <div class="showDinlineblock">
                        <label for="memberSelector"><?php echo $member['name'];?> 老師</label>
                        <select name="" id="memberSelector" class="form-control w200">
                            <option value="member">路老師專區</option>
                            <?php if(in_array($member['qualify'],array(1,2))){?>
                            <option value="member_affairs">個人宣講歷程</option>
                            <option value="member_affairs_record">宣講歷程登錄</option>
                            <option value="member_download">教案下載</option>
                            <?php }?>
                            <option value="member_application" selected>培訓報名</option>
                            <option value="member_info">個人資料</option>
                        </select>
                    </div>

                    <button type="button" class="btn btn-submit btnInline" onclick="location.href='ajax/signout.php'">登出</button>
                </div>

                <div class="pageCont">
                    <div class="pageBodyTitle">
                        <h4><img src="images/icon/icon_title_apply.png" alt="">
                            ‑ 培訓報名 ‑
                        </h4>
                    </div>

                    <p>請填寫報名資料</p>

                    <form id="trainingForm" action="ajax/training.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <table class="normal-table">
                        <tr>
                            <th colspan="2">培訓報名場次</th>
                        </tr>
                        <tr>
                            <td>報名場次</td>
                            <td><?php echo $rec['title'];?></td>
                        </tr>
                        <tr>
                            <td>上課日期</td>
                            <td><?php echo $rec['date'];?></td>
                        </tr>
                        <tr>
                            <td>上課時間</td>
                            <td><?php echo $rec['time'];?></td>
                        </tr>
                        <tr>
                            <td>用餐習慣</td>
                            <td>
                                <div class="form-inline radioCont">
                                    <label class="radio-inline">
                                        <input type="radio" name="vegeOption" id="Radio1" value="1">
                                        <span class="checkmark"></span>葷食
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="vegeOption" id="Radio2" value="2">
                                        <span class="checkmark"></span>素食
                                    </label>
                                </div>
                            </td>
                        </tr>
                    </table>

                    <div class="text-center">
                        <button type="button" class="btn btn-gray btnInline back">上一頁</button>
                        <button type="button" class="btn btn-submit btnInline submit">送出</button>
                    </div>
                    </form>
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
        
        $('.back').click(function(){
            history.back();
        });
        
        $('.submit').click(function(){
            if(!$('input[name=vegeOption]:checked').val())
                return alert('請選擇用餐習慣');
            
            $('#trainingForm').submit();
        });
    });
    </script>
</body>

</html>