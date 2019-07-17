<button class="signUpBtn">
    <picture>
        <source media="(min-width: 769px)" srcset="images/icon/fixed_sidebar/fixed_side_bar_icon_signup.png">
        <source media="(min-width: 561px)" srcset="images/icon/fixed_sidebar/fixed_side_bar_icon_signup@2x.png">
        <img src="images/icon/fixed_sidebar/fixed_side_bar_icon_signup@3x.png" alt="立即報名">
    </picture>
    <p>立刻線上報名</p> 
</button>
<div class="container content">
    <div class="_mod_title">
        <div class="ch">
        <h4>個人報名</h4>
        </div>
        <div class="en">
        <h4>INDIVIDUAL <br>REGISTRATION</h4>
        </div>
    </div>

    <article>
        <form class="stdForm" id="join_form">
        <!--<input type="hidden" name="area_id" value="0">-->
        <!-- 報名場次 -->
        <div class="formItem clothSize">
            <div class="title">
                <p>報名場次 / Registration time</p>
            </div>
            <div class="bkContainer">
                <div class="selectWrap">
                    <select name="area_id">
                    <option value="">請選擇</option>
                    <option value="1">清大/交大場</option>
                    <option value="2">政治大學場</option>
                    <option value="3">中山大學場</option>
                    <option value="4">成功大學場</option>
                    <option value="5">台灣大學場</option>
                    <option value="6">東海大學場</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="formItem">
            <!-- 姓名 -->
            <div class="title">
            <p>姓名 / Name</p>
            </div>
            <div class="bkContainer">
            <input type="text" name="name" placeholder="範例：林小明(限中文)">
            </div>
        </div>

        <!-- 性別 -->
        <div class="formItem gender">
            <div class="title">
            <p>性別 / Gender</p>
            </div>
            <div class="bkContainer">
            <label class="radioWrap">
                <input type="radio" name="gender" value="m">
                <div class="fakebox"></div>
                <p>男 / male</p>
            </label>
            <label class="radioWrap">
                <input type="radio" name="gender" value="f">
                <div class="fakebox"></div>
                <p>女 / female</p>
            </label>
            </div>
        </div>

        <!-- 身份證號 -->
        <div class="formItem idNum">
            <div class="title">
            <p>身份證號 / ID Number</p>
            </div>
            <div class="bkContainer">
            <input type="text" maxlength="10" name="pid">
            <div class="comment">
                <p>身分證僅作為投保之用，敬請配合卻確實填寫，以確保您的利益<br>Personal identification numbers will be used for insurance purposes only, to protect your personal interests, please provide a valid number.</p>
            </div>
            </div>
        </div>

        <!-- 出生日期 -->
        <div class="formItem birthday">
            <div class="title">
            <p>出生日期 / Date Of Birth</p>
            </div>
            <div class="bkContainer">
            <div class="selectWrap">
                <select name="birthy">
                <option value="">請選擇</option>
                <?php
                for($y=1900; $y<=2018; $y++) echo '<option value="'.$y.'">'.$y.'</option>';
                ?>
                </select>
            </div>
            <div class="selectWrap">
                <select name="birthm">
                <option value="">請選擇</option>
                <option value="01">01</option>
                <option value="02">02</option>
                <option value="03">03</option>
                <option value="04">04</option>
                <option value="05">05</option>
                <option value="06">06</option>
                <option value="07">07</option>
                <option value="08">08</option>
                <option value="09">09</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                </select>
            </div>
            <div class="selectWrap">
                <select name="birthd">
                <option value="">請選擇</option>
                <option value="01">01</option>
                <option value="02">02</option>
                <option value="03">03</option>
                <option value="04">04</option>
                <option value="05">05</option>
                <option value="06">06</option>
                <option value="07">07</option>
                <option value="08">08</option>
                <option value="09">09</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
                <option value="25">25</option>
                <option value="26">26</option>
                <option value="27">27</option>
                <option value="28">28</option>
                <option value="29">29</option>
                <option value="30">30</option>
                <option value="31">31</option>
                </select>
            </div>
            </div>
        </div>

        <!-- 電子信箱 -->
        <div class="formItem">
            <div class="title">
            <p>電子信箱 / Email</p>
            </div>
            <div class="bkContainer">
            <input type="email" name="email">
            </div>
        </div>

        <!-- 聯絡電話 -->
        <div class="formItem contactNum">
            <div class="title">
            <p>聯絡電話 / Contact Number</p>
            </div>
            <div class="bkContainer">
            <div class="block">
                <picture>
                <source media="(min-width: 769px)" srcset="images/icon/phone.png">
                <source media="(min-width: 561px)" srcset="images/icon/phone@2x.png">
                <img src="images/icon/phone@3x.png" alt="Cellphone Icon">
                </picture>
                <input type="phone" placeholder="手機 / Mobile" maxlength="10" name="tel">
            </div>
            </div>
        </div>

        <!-- 衣服尺寸 -->
        <div class="formItem clothSize">
            <div class="title">
            <p>衣服尺寸 / Cloth size</p>
            </div>
            <div class="bkContainer">
            <div class="selectWrap">
                <select name="size">
                <option value="">請選擇</option>
                <option value="XS">XS</option>
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="XL">XL</option>
                </select>
            </div>
            <div class="comment">
                <table>
                <tbody>
                    <tr>
                    <td>
                        <p>XS</p>
                    </td>
                    <td>
                        <p>胸圍89cm、衣長65cm</p>
                    </td>
                    </tr>
                    <tr>
                    <td>
                        <p>S</p>
                    </td>
                    <td>
                        <p>胸圍97cm、衣長67cm</p>
                    </td>
                    </tr>
                    <tr>
                    <td>
                        <p>M</p>
                    </td>
                    <td>
                        <p>胸圍104cm、衣長69cm</p>
                    </td>
                    </tr>
                    <tr>
                    <td>
                        <p>L</p>
                    </td>
                    <td>
                        <p>胸圍112cm、衣長71cm</p>
                    </td>
                    </tr>
                    <tr>
                    <td>
                        <p>XL</p>
                    </td>
                    <td>
                        <p>胸圍122cm、衣長73cm</p>
                    </td>
                    </tr>
                </tbody>
                </table>
            </div>
            </div>
        </div>

        <div class="container">
            <div class="formBtnWrap">
            <button class="cancel _blackBG js-lb" data-lb="_signout">
                <p>取消報名</p>
            </button>
            <button class="submit _redBG">
                <p>確定報名</p>
            </button>
            </div>
        </div>
        </form>
    </article>
</div>
<script>
    $(function(){
        var $signUpBtn = $('.signUpBtn')
        $signUpBtn.on('click', function() {
            var $this = $(this);
            $this.stop().slideUp(300)
            .next().stop().slideDown(300);
        });
    })
</script>