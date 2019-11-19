<?php 
require_once 'php.lib/config.php';
require_once 'php.lib/main.php';
require_once 'php.lib/mysqli_class.php';
$DB = new DB_CONN();
$memberLogin = memberLoginChk();
$departLogin = departLoginChk();
if($memberLogin['status'])
    $member = $_SESSION[WEBX.'Mem'];
else if($departLogin['status'])
    $member = $_SESSION[WEBX.'Dep'];
else
    $member = array();
$kvs = kvList(array('publish'=>1),0);
$news = newsList(array('publish'=>1),5);

/*
1. 合格路老師→路老師狀態顯示為合格的人數
2. 宣講次數→回饋資料上傳筆數(審核通過的)
3. 培訓場數→今年培訓報名總場次數(不論上下架，都加總)
3. 培訓場數→今年之前培訓報名總場次數(不論上下架，都加總)
4. 教案數量→總教案數量(不論上下架，都加總)
5. 下載次數→所有教案的總下載次數
6. 找尋次數→需求單位篩選查詢次數
*/
$qualifyTeachers = teacherCount(array('qualify'=>1));
$speachTimes = speachCount(array('status'=>1));
$trainingNow = trainingCount(array('now'=>1));
$trainingBefore = trainingCount(array('before'=>1));
$planCount = planCount(array());
$downloadTimes = planFileDownLoadLogCount(array());
$searchTimes = teacherSearchLogCount(array());
?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
  <!-- Basic Data -->
  <meta charset="UTF-8">
  <title>路老師培訓網</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="Cache-Control" content="no-cache" />
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
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> -->
  <link rel="stylesheet" href="css/main.css" />

  <!--[if IE]>
    <script type="text/javascript" src="js/html5shiv.js"></script>
  <![endif]-->

</head>

<body id="index-page">
  <!--Loading-->
  <div id="loading">
    <div class="loader">
      <div class="spinner">

      </div>
    </div>
  </div>

  <header class="page-header"></header>

  <main class="main-container">
    <div class="inside">
      <?php if(!empty($kvs)){?>
      <!-- carousel START -->
      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <?php foreach($kvs as $k=>$d){?>
          <li data-target="#carousel-example-generic" data-slide-to="<?php echo $k;?>"<?php echo $k==0?' class="active"':'';?>></li>
          <?php }?>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
          <?php foreach($kvs as $k=>$d){?>
          <div class="item<?php echo $k==0?' active':'';?>">
            <a href="<?php echo $d['url']?$d['url']:'javascript:;';?>">
              <picture>
                <source media="(min-width: 640px)" srcset="<?php echo UPLOAD_PATH.$d['img'];?>">
                <img src="<?php echo UPLOAD_PATH.$d['img_mb'];?>" alt="">
              </picture>
            </a>
          </div>
          <?php }?>
        </div>

        <!-- Controls -->
        <!-- <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a> -->
      </div>
      <!-- carousel END -->
      <?php }?>

      <div class="indexCont">

        <div class="container">
          <div class="row">
            <div id="indexNewsWrapper" class="col-sm-8">
              <h4 class="colTitle">⎯ NEWS <span class="cBlack">最新消息</span> ⎯</h4>

              <ul class="indexNewsList">
                  <?php foreach($news as $k=>$d){?>
                  <li>
                      <a href="<?php echo $d['contenttype']==2?$d['url'].'" target="_blank':'news_article.php?id='.$d['id'];?>">
                          <span class="newsDate"><?php echo mingoDate($d['publishdate']);?></span>
                          <?php 
                          switch($d['type']){
                              case 1:{ echo '<span class="newsCategory bgOrange">公告</span>'; break; }
                              case 2:{ echo '<span class="newsCategory bgGreen">活動</span>'; break; }
                              case 3:{ echo '<span class="newsCategory bgBlue">報名</span>'; break; }
                              case 4:{ echo '<span class="newsCategory bgRed">重要</span>'; break; }
                          }
                          ?>
                          <h4><?php echo $d['title'];?></h4>
                          <!-- <p><?php echo $d['description'];?></p> -->
                      </a>
                  </li>
                  <?php }?>
              </ul>
              <a href="news.php" class="btnMore"><i class="glyphicon glyphicon-play"></i><span>更多消息</span></a>
            </div>
            <div id="indexSignWrapper" class="col-sm-4">
              <?php if(empty($member)){?>
              <h4 class="colTitle">⎯ <span class="cBlack">路老師登入</span> ⎯</h4>

              <!--未登入 STRAT-->
              <div class="hasSignOut">
                  <p>只要您取得合格路老師證書，都可直接登入，若無法登入請<a href="contact.php" style="display:inline-block;">聯絡我們</a></p>
                <form action="ajax/signin.php" method="post">
                  <div class="form-group">
                    <input type="tel" class="form-control" id="signinAccount" name="account" placeholder="帳號(手機號碼)">
                  </div>
                  <div class="form-group">
                    <input type="hidden" name="psw">
                    <input type="password" class="form-control" id="signinPassword" placeholder="密碼">
                  </div>
                  <div class="flexBlock">
                    <button type="button" class="btn btn-link forgot">忘記密碼</button>
                    <button type="submit" class="btn btn-submit">登入</button>
                  </div>
                </form>

                <a href="signup.php" class="btnSignUp"><i class="glyphicon glyphicon-play"></i>我要當路老師 註冊</a>
              </div>
              <!--未登入 END-->
              <?php }else{?>
              <?php if($memberLogin['status']){?>
              <h4 class="colTitle">⎯ <span class="cBlack">路老師登入</span> ⎯</h4>

              <!--已登入 STRAT-->
              <div class="hasSignIn" data-text="路老師專區功能">
                <p>您好！歡迎登入</p>
                <div class="memberName"><span><?php echo $member['name'];?></span> 老師</div>

                <ul>
                  <li><a href="member_info.php">個人資料</a></li>
                  <li><a href="member_affairs_record.php">宣講歷程登錄</a></li>
                  <li><a href="member_download.php">教案下載</a></li>
                  <li><a href="member_application.php">培訓報名</a></li>
                </ul>
              </div>
              <!--已登入 END-->
              <?php }?>
              <?php if($departLogin['status']){?>
              <h4 class="colTitle">⎯ <span class="cBlack">單位登入</span> ⎯</h4>

              <!--已登入 STRAT-->
              <div class="hasSignIn" data-text="我要找路老師功能">
                <p>您好！歡迎登入</p>
                <div class="memberName"><span><?php echo $member['name'];?></span></div>

                <ul>
                  <li><a href="dept_info.php">單位資訊</a></li>
                  <li><a href="teacher_search.php">路老師查詢</a></li>
                </ul>
              </div>
              <!--已登入 END-->
              <?php }?>
              <?php }?>

            </div>
          </div>
        </div>

        <div class="container">
          <div class="row">
            <div id="indexStatisticWrapper" class="col-sm-8">
              <h4 class="colTitle">⎯ <span class="cBlack">最新統計</span> ⎯</h4>
              <ul>
                <li><em><?php echo number_format($qualifyTeachers);?></em>位合格路老師傳遞交通安全知識,全省共宣講<em><?php echo number_format($speachTimes);?></em>次</li>
                <li>本年度已有<em><?php echo number_format($trainingNow);?></em>場培訓在進行，歷年度已完成<em><?php echo number_format($trainingBefore);?></em>場培訓</li>
                <li>我們總共有<em><?php echo number_format($planCount);?></em>個教案,而路老師們也孜孜不倦下載了<em><?php echo number_format($downloadTimes);?></em>次</li>
                <li>需求單位透過我們尋找需要的路老師<em><?php echo number_format($searchTimes);?></em>次</li>
              </ul>
            </div>
            <div id="indexLinkWrapper" class="col-sm-4">
              <h4 class="colTitle">⎯ LINK <span class="cBlack">友站連結</span> ⎯</h4>
              <ul>
                <li><a href="https://168.motc.gov.tw/" target="_blank">168交通安全入口網</a></li>
                <li><a href="https://www.motc.gov.tw/ch/index.jsp" target="_blank">中華民國交通部</a></li>
                <li><a href="http://3atsplan.com/3atsplan/" target="_blank">舊版路老師網站</a></li>
              </ul>
            </div>
          </div>
        </div>

      </div>
    </div>
  </main>

  <footer class="page-footer"></footer>


  <!-- Scripts -->
  <script src="js/vendor.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
  <script src="js/kits.min.js"></script>
  <!-- main js -->
  <script src="js/main.min.js"></script>
  <script type="text/javascript" src="js.lib/sha.js"></script>
  <script type="text/javascript">
  $(document).ready(function(){
    $('#signinPassword').keyup(function(){
        var psw = $(this).val();
        var hashObj = new jsSHA('SHA-1','TEXT');
        hashObj.update(psw);
        $('input[name=psw]').val(hashObj.getHash('HEX'));
    });
    $('#indexSignWrapper .forgot').click(function(){
        location.href = 'signin_forgot-password.php';
    });
  });
  </script>

</body>

</html>