<?php 
require_once 'php.lib/constants.php';
require_once PHP_LIB_PATH.'default_setting.php';
?>
<!DOCTYPE html>
<html lang="zh-Hant">

<head>
<?php 
  $game_id = 8;
  require_once 'includes/outdoor_photo.php';
  ?>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
  <meta property="og:title" content="TNF無痕山林 淨山活動" />
  <meta property="og:description" content="如何讓這一切變得不加思索的自然，沒有猶豫的伸出雙手守護這片山林，將無痕山林理念傳遞給更多的人們，讓這一片原始山林更加自然而美麗無痕山林，不是理所當然而是自然而然。" />
  <meta property="og:image" content="http://www.xn--djr420n.tw/images/share/hiking_taipei_share.jpg" />
  <title>The North Face 100 無痕山林 淨山活動</title>
  <link rel="icon" type="image/ico" href="images/favicon.ico" />

  <!-- CSS Plugins -->
  <link rel="stylesheet" href="css/slick.min.css" />
  <link rel="stylesheet" href="css/slick-theme.min.css" />
  <!-- CSS -->
  <link rel="stylesheet" href="css/style.min.css" />

  <!-- JS Plugins -->
  <script type="text/javascript" src="js.lib/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="js.lib/jquery.zeynep.js"></script>
  <script type="text/javascript" src="js.lib/imagesloaded.js"></script>
  <script type="text/javascript" src="js.lib/slick.min.js"></script>
  <script type="text/javascript" src="js.lib/lightbox.js"></script>
</head>

<body class="activetiesTemplate hikingPage noSignUp" data-hint="hikingPage">
  <!-- Loading -->
  <div class="loading">
    <div>
      <div class="c1"></div>
      <div class="c2"></div>
      <div class="c3"></div>
      <div class="c4"></div>
    </div>
    <span>loading</span>
  </div>

  <!-- Header, Source: "includes/_header.html" -->
  <header class="pageHeader" data-hint="act"></header>

  <!--========== Main Container ==========-->
  <main>
    <!-- KV Section -->
    <section class="kv">
      <div class="container">
        <div class="topic">
          <img src="images/kv/hikng_topic.png" alt="戶外訓練 Outdoor Training">
        </div>
      </div>

      <!-- Sessions -->
      <a class="session session1 selected" href="./hiking_taipei.php">
        <p>台北<br>三貂嶺</p>
        <picture>
          <source media="(min-width: 769px)" srcset="images/icon/session_icon.png">
          <source media="(min-width: 561px)" srcset="images/icon/session_icon@2x.png">
          <img src="images//icon/session_icon@3x.png" alt="場次符號">
        </picture>
      </a>
      <a class="session session2" href="./hiking_taichung.php">
        <p>台中<br>大肚萬里長城</p>
        <picture>
          <source media="(min-width: 769px)" srcset="images/icon/session_icon.png">
          <source media="(min-width: 561px)" srcset="images/icon/session_icon@2x.png">
          <img src="images//icon/session_icon@3x.png" alt="場次符號">
        </picture>
      </a>
      <a class="session session3" href="./hiking_kaohsiung.php">
        <p>高雄<br>大崗山</p>
        <picture>
          <source media="(min-width: 769px)" srcset="images/icon/session_icon.png">
          <source media="(min-width: 561px)" srcset="images/icon/session_icon@2x.png">
          <img src="images//icon/session_icon@3x.png" alt="場次符號">
        </picture>
      </a>
    </section>  <!-- KV END -->

    <!-- Banner Section -->
    <section class="banner">
      <div class="container">
        <h2><span>【活動】The North Face無痕山林體驗日系列活動</span><span>新北三貂嶺步道淨山去！</span></h2>
        <!-- <button class="toBannerBlock">
          <p>清大/交大場</p>
        </button> -->
        <article>
          <section>
            <div class="block">
              <p>你是位喜歡爬山、也願意努力保護自然環境的愛山人嗎？那你千萬不能錯過這個好活動！</p>
            </div>
            <div class="block">
              <p>The North Face與健行筆記共同舉辦「北面無痕山林體驗日系列活動」，10/7(日)要帶大家前往新北市的三貂嶺瀑布步道淨山。當日除了清理步道上的垃圾，更將進一步分享無痕山林七大準則概念，教你如何在親近山林的同時減少人為環境衝擊。這麼棒的活動，還不快跟我們一起出發！</p>
            </div>
          </section>
        </article>
      </div>

      <div class="bannerBlock">
        <div class="container">
          <picture>
            <source media="(min-width: 769px)" srcset="images/hiking_taipei_banner.gif">
            <img src="images/hiking_taipei_banner.gif" alt="無痕山林體驗日系列活動，新北三貂嶺">
          </picture>
        </div>
      </div>
    </section>

    <section class="introduction articleSec _bgc_gray">
      <div class="container">
        <div class="_mod_title sp">
          <div class="ch">
            <h4>活動介紹</h4>
          </div>
          <div class="en">
            <h4>TNF無痕山林體驗日－台北場</h4>
          </div>
        </div>

        <article>
          <section>
            <div class="block">
              <p>活動時間：2018年10月07日（星期日）9：00~16：00</p>
              <p>集合時間與地點：上午9：00於三貂嶺車站集合</p>
              <p>大眾交通方式：</p>
              <ul>
                <li>
                  <p>@ 鐵路：搭乘台鐵普通車到「三貂嶺車站」，或在瑞芳、猴硐火車站換搭平溪線觀光列車至「三貂嶺車站」下車</p>
                </li>
                <li>
                  <p>@ 公車：搭乘台北客運795（原1076路）至平溪站，再轉搭火車至「三貂嶺車站」下車</p>
                </li>
              </ul>
              <p>報名時間：即日起至9月28日，限額30名，額滿為止（逾期未完成繳費手續者，報名系統將自動取消其報名資格）</p>
              <p>活動對象：支持無痕山林理念之朋友。純粹想健行，或是趕時間者請勿報名。為安全考量，未滿15歲者需家長陪同報名參加</p>
              <p>報名費用：新台幣300元（含保險）</p>
              <!-- <p>活動贈品：The North Face限量速乾運動服乙件（參考市價1,680／件）</p> -->
            </div>
            <!-- <div class="block picBlock">
              <picture>
                <source media="(min-width: 769px)" srcset="images/hiking_pic_01.jpg">
                <img src="images/hiking_pic_01.jpg" alt="照片">
              </picture>
              <span>註：服裝樣式僅供參考，顏色、K數可能有所不同，以當日實品為主</span>
            </div>
            <div class="block">
              <p>衣服尺寸表</p>
              <div class="listContent">
                <table>
                    <tr>
                      <td>
                        <p>CM</p>
                      </td>
                      <td>
                        <p>S</p>
                      </td>
                      <td>
                        <p>M</p>
                      </td>
                      <td>
                        <p>L</p>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <p>胸圍</p>
                      </td>
                      <td>
                        <p>97</p>
                      </td>
                      <td>
                        <p>104</p>
                      </td>
                      <td>
                        <p>112</p>
                      </td>
                    </tr>
                </table>
              </div>
            </div> -->
          </section>
          <section>

            <div class="block">
              <p class="subTitle">單日活動流程</p>
              <p class="fcGreen">行程說明</p>
              <p>三貂嶺車站→碩仁國小登山口→合谷瀑布觀景台→摩天瀑布→枇杷洞瀑布→新寮大厝→桃花源渡假村（新寮瀑布）→大華車站，預計16:00結束 </p>
            </div>
            <div class="block">
                <p class="fcGreen">課程內容</p>
                <p>初級登山及Leave No Trace認知工作坊內容，包含：</p>
                <p class="dot">戶外安全</p>
                <p class="dot">戶外裝備認識、登山杖的使用</p>
                <p class="dot">戶外食品與飲水</p>
                <p class="dot">登山基本技巧（行進、地圖與導航）</p>
                <p class="dot">Leave No Trace無痕山林概念：</p>
                <ul>
                  <li>
                    <p>(1) 事前充分的規劃與準備</p>
                  </li>
                  <li>
                    <p>(2) 在可承受地點行走宿營</p>
                  </li>
                  <li>
                    <p>(3) 適當處理垃圾維護環境</p>
                  </li>
                  <li>
                    <p>(4) 保持環境原有的風貌</p>
                  </li>
                  <li>
                    <p>(5) 減低用火對環境的衝擊</p>
                  </li>
                  <li>
                    <p>(6) 尊重野生動植物</p>
                  </li>
                  <li>
                    <p>(7) 考量其他的使用者</p>
                  </li>
                </ul>
            </div>
            <div class="block">
                <p class="fcGreen">個人需攜帶裝備</p>
                <p class="dot">排汗上衣及褲子</p>
                <p class="dot">運動鞋、越野跑鞋或輕量登山鞋（禁止穿著拖鞋及涼鞋）</p>
                <p class="dot">防曬用品 : 帽子，防曬油，太陽眼鏡</p>
                <p class="dot">頭燈或手電筒</p>
                <p class="dot">個人簡單午餐（如麵包或飯糰）、水瓶（1L以上）</p>
                <p class="dot">雨具或兩截式雨衣 (硬殼外套及褲子亦可)</p>
                <p class="dot">雙肩背包 (可放入所有的個人裝備)</p>
                <p class="dot">個人清潔用品和下山更換的衣物</p>
                <p class="dot">防蚊蟲液</p>
            </div>
            <!-- <div class="block">
                <p class="fcGreen">好康再加碼</p>
                <p>凡隨同教練完走淨山活動、並於個人FB上分享淨山心得或照片之朋友，還可以參加The North Face造型毛帽抽獎活動！（定價1,780/頂）</p>
                <p>我們將於10/8(一)抽出三名幸運得獎者，把好康寄到你家。請注意，貼文需設定為公開，並 <font class="tag">#TNF無痕山林體驗日</font> <font class="tag">#TheNorthFaceTaiwan</font>，我們才抽得到你喔！</p>
            </div>
            <div class="block picBlock">
              <picture>
                <source media="(min-width: 769px)" srcset="images/hiking_pic_02.jpg">
                <img src="images/hiking_pic_02.jpg" alt="照片">
              </picture>
              <span>本團才30人就可以抽3組！中獎率超高的還不分享！</span>
              <a href="https://store.biji.co/tborder/new/4daf1950-75c2-48a1-84b6-07384288779f" class="picSign" target="_blank"><img src="images/hiking_sign.png"></a>
            </div>
            <div class="block">
              <p class="subTitle">共同主辦單位</p>
              <p>The North Face®北面</p>
              <p>The North Face®成立於1966年，名稱源於山上最冷、最難攀爬的北坡，因此中文名為「北面」，意味著探索最難最險的戶外精神。北面的形象來源是Half Dome，它坐落於美國加洲的Yosemite National Park內（優勝美地國家公園）。</p>
              <p>1997年，The North Face®採用全新的宣傳標語：「Never Stop Expolring 探索永不停止」，從此成為品牌最重要的精神口號。The North Face®以經過運動員測試、適應各類戶外需求的產品，説明世人探索、挑戰人類潛能的極限；與此同時，品牌致力於保護戶外環境，通過各類可持續發展專案，將人類對自然環境所產生的影響降到最低。</p>
            </div>
            <div class="block">
              <p class="subTitle">活動諮詢</p>
              <p>活動相關問題，歡迎加入<a href="http://line.me/ti/p/%40kta8152e" class="fcGreen gLink" target="_blank">健行筆記LINE好友</a>健行筆記LINE好友或來信<a href="mailto:hikingnote@gmail.com" class="fcGreen gLink">hikingnote@gmail.com</a>洽詢。</p>
            </div> -->
            <div class="block">
              <p class="subTitle">活動注意事項</p>
              <p class="dot">健行筆記、The North Face得刊登及使用活動內容及課程照片。</p>
              <p class="dot">本活動贈品恕無法折現或更換其他商品。</p>
              <p class="dot">主辦單位擁有因應天候及現場狀況修改以上活動內容之權利。</p>
              <p class="dot">
                本活動已投保所有參加者200萬意外旅平險+20萬醫療險，學員務必考量自身之健康狀況，因個人病症疾患(註一)所引起之意外均不在保險範圍內，活動參加者如另有需要，請自行辦理個人人身意外保險等。
                <br>註一：不保項目(1)個人疾病造成之運動傷害、(2)因個人體質或自身心血管疾病所引發之症狀，例如：心臟病、心血管症、糖尿病、熱衰竭、脫水等引起之症狀。
              </p>
              <p class="dot">參加者於參加本活動之同時，即同意接受本活動之活動辦法與注意事項之規範。</p>
              <p class="dot">本活動辦法及相關資訊陸續公佈於網站；若有未盡事宜，得隨時增補修訂之，並以活動單位發佈消息為準。</p>
            </div>
          </section>
        </article>
      </div>
    </section>

    <section class="course articleSec _bgc_gray">
      <div class="container">
        <div class="_mod_title">
          <div class="ch">
            <h4>步道簡介</h4>
          </div>
          <div class="en">
            <h4></h4>
          </div>
        </div>

        <article>
          <section>
            <div class="block">
              <p class="subTitle">三貂嶺瀑步步道簡介</p>
              <p>三貂嶺瀑布步道沿途森林茂密、流水潺潺，途中會經過枇杷洞、摩天、合谷和新寮等瀑布，走完步道還能順遊菁桐、平溪、侯硐等風景區，可說是一條兼具登山、賞瀑、觀壺穴、遊礦城、古道尋幽和鐵道懷舊的精華路線。</p>
              <p>也因遊客眾多，山徑旁日積月累諸多垃圾，本系列活動除推廣無痕山林理念，更將與你一起身體力行，立刻把垃圾撿下山！</p>
            </div>
            <div class="block picBlock">
              <picture>
                <source media="(min-width: 769px)" srcset="images/hiking_taipei_pic_01.jpg">
                <img src="images/hiking_taipei_pic_01.jpg" alt="照片">
              </picture>
              <span>合谷瀑布氣勢磅礡（圖／Lile Hsing）</span>
            </div>
            <div class="block picBlock">
              <picture>
                <source media="(min-width: 769px)" srcset="images/hiking_taipei_pic_02.jpg">
                <img src="images/hiking_taipei_pic_02.jpg" alt="照片">
              </picture>
              <span>原始山徑充滿野趣（圖／Lile Hsing）</span>
            </div>
            <div class="block picBlock">
              <picture>
                <source media="(min-width: 769px)" srcset="images/hiking_taipei_pic_03.jpg">
                <img src="images/hiking_taipei_pic_03.jpg" alt="照片">
              </picture>
              <span>沿著索橋跨溪，趣味十足（圖／Lile Hsing）</span>
            </div>
            <div class="block picBlock">
              <picture>
                <source media="(min-width: 769px)" srcset="images/hiking_taipei_pic_04.jpg">
                <img src="images/hiking_taipei_pic_04.jpg" alt="照片">
              </picture>
              <span>美麗景緻，需要我們共同維護（圖／上衫曉馬）</span>
            </div>
          </section>
        </article>
      </div>
    </section>

    <section class="origin articleSec">
      <div class="container">
        <div class="_mod_title">
          <div class="ch">
            <h4>無痕山林概念</h4>
          </div>
        </div>

        <article>
          <section class="articleLink">
            <div class="container">
              <article>
                <a class="container" target="_blank" href="https://hiking.biji.co/index.php?q=news&act=info&id=8653">
                  <div class="articleImg">
                    <img src="images/hiking_article_01.jpg" alt="假圖假圖假圖，很重要所以說三次">
                  </div>
                  <div class="articleInfo">
                    <!-- 
                      【For 後端】
                      <h3> & <p> 麻煩後端幫忙製作 限制字數，避免換行造成破版
                      -->
                    <div>
                      <h3>【環境】無痕山林七大準則與行動概念(上)</h3>
                      <p>『無痕山林運動』主要在提醒我們應對所處的山林環境善盡應有的關懷與責任，以儘可能減少衝擊的活動方式與行為，達成親近山林的體驗。這...</p>
                    </div>
                    <span>2018/01/22</span>
                  </div>
                </a>
                <a class="container" target="_blank" href="https://hiking.biji.co/index.php?q=news&act=info&id=8654">
                  <div class="articleImg">
                    <img src="images/hiking_article_02.jpg" alt="假圖假圖假圖，很重要所以說三次">
                  </div>
                  <div class="articleInfo">
                    <!-- 
                      【For 後端】
                      <h3> & <p> 麻煩後端幫忙製作 限制字數，避免換行造成破版
                      -->
                    <div>
                      <h3>【環境】無痕山林七大準則與行動概念(中)</h3>
                      <p>離開露營地、休息區前，請將垃圾（如煙蒂）、食物、廚餘（果皮、麵條、蛋殼、貝類等有機垃圾）都帶走。這是每位造訪自然的人都應具備...</p>
                    </div>
                    <span>2018/01/22</span>
                  </div>
                </a>
                <a class="container" target="_blank" href="https://hiking.biji.co/index.php?q=news&act=info&id=8655">
                  <div class="articleImg">
                    <img src="images/hiking_article_03.jpg" alt="假圖假圖假圖，很重要所以說三次">
                  </div>
                  <div class="articleInfo">
                    <!-- 
                      【For 後端】
                      <h3> & <p> 麻煩後端幫忙製作 限制字數，避免換行造成破版
                      -->
                    <div>
                      <h3>【環境】無痕山林七大準則與行動概念(下)</h3>
                      <p>自然環境是各種生物的家，應尊重並儘量不影響牠們的生活與習慣，不餵食、不破壞、不侵犯，讓牠們可以在山林裡繼續繁衍、茁壯。...</p>
                    </div>
                    <span>2018/01/22</span>
                  </div>
                </a>
              </article>
            </div>
          </section>
        </article>
      </div>
    </section>

    <section class="googleMap _bgc_gray">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3614.0874052889185!2d121.82080476639429!3d25.06502649133312!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x345d5a90ac3ce167%3A0x6e172b63a5fcd2fc!2z5LiJ6LKC5ba66LuK56uZ!5e0!3m2!1szh-TW!2stw!4v1538644318973" frameborder="0" style="border:0" allowfullscreen></iframe>
    </section>

    <section class="review articleSec _bgc_gray">
      <div class="container">
        <div class="_mod_title">
          <div class="ch">
            <h4>精彩回顧</h4>
          </div>
          <div class="en">
            <h4>REVIEW</h4>
          </div>
        </div>
        <article>
          <section>
            <div class="block">
              <p></p>
            </div>
          </section>
          <section>
            <div class="_slick imgOnly">
              <?php foreach($photos as $v){?>
              <div class="slickItem">
                <button class="js-lb">
                  <img src="<?php echo $photo_dir.$v['img_small'];?>" style="height:auto;" alt="">
                </button>
              </div>
              <?php }?>  
            </div>
            <p class="slickPageWrap">
              <span class="nowPage">1</span>&nbsp;/&nbsp;<span class="totalPage"></span>
            </p>
          </section>
        </article>
      </div>

      <div class="reviewVidWrap _c">
        <div class="reviewTitle">
          <div class="container">
            <article>
              <div class="content">
                <picture>
                  <img src="images/icon/thf_logo@3x.jpg" alt="The North Face Logo">
                </picture>
                <h6>2018TNF無痕山林 淨山活動</h6>
              </div>
            </article>
          </div>
        </div>
        <div class="reviewVid">
          <div class="container">
            <article>
              <div class="content">
                <div class="ifrWrap">
                  <iframe src="https://www.youtube.com/embed/0Oag9CeDeqk" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
              </div>
            </article>
          </div>
        </div>
        <div class="reviewDescription">
          <div class="container">
            <article>
              <div class="content">
                <p>沒有猶豫的伸出雙手守護這片山林，將無痕山林理念傳遞給更多的人們，讓這一片原始山林更加自然而美麗，無痕山林不是理所當然而是自然而然</p>
              </div>
            </article>
          </div>
        </div>
      </div>
    </section>

    <section class="signUp articleSec _bgc_gray">
      
    </section>
  </main>

  <div class="fixedSideBar"></div>
  
  <!-- Footer, Source: "includes/_footer.html" -->
  <footer class="pageFooter"></footer>

  <!--========== Javascript ==========-->
  <script type="text/javascript" src="js/script.min.js"></script>

  <!-- IE9 以下，提醒使用者 更新 / 切換瀏覽器 -->
  <!--[if lte IE 9]><h1 class="forIE8Less" style="width:100%; height:150px; padding-top:70px; color:#000; background:#FFF; position:fixed; top:0; left:0; z-index:9999; text-align:center;">本網頁不支援 IE9 以下版本，請更新瀏覽器版本或建議使用 Chrome 瀏覽器。</h1><style>body>*{display: none;}.forIE8Less{display:block;}</style><![endif]-->
</body>

</html>