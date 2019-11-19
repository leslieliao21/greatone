<?php if(isset($siteMap)){?>
<div id="mainMenu">
    <table border="0" cellspacing="0" cellpadding="0" width="100%">
        <tr>
            <td style="PADDING-LEFT: 12px; PADDING-BOTTOM: 3px; PADDING-TOP: 10px">
                <font style="COLOR: #000;"><img src="images/menu_01.gif">◇<strong>Menu</strong></font>
            </td>
        </tr>
        <tr>
            <td style="PADDING-LEFT: 23px; LINE-HEIGHT: 22px;" class="user">
                <ul id="treeviewSection">
                    <?php foreach($siteMap as $k=>$d){?>
                    <li<?php echo !empty($d['list'])?' class="collapsable"':'';?>>
                        <span class="treeview_span"><a href="<?php echo $d['url'];?>"><?php echo $d['name'];?></a></span>
                        <?php if(!empty($d['list'])){?>
                        <div class="hitarea collapsable-hitarea"></div>
                        <ul>
                            <?php foreach($d['list'] as $kk=>$dd){?>
                            <li><span class="treeview_span"><a href="<?php echo $dd['url'];?>"><?php echo $dd['name'];?></a></span></li>
                            <?php }?>
                        </ul>
                        <?php }?>
                    </li>
                    <?php }?>
                </ul>
            </td>
        </tr>
    </table>
</div>
<?php }?>