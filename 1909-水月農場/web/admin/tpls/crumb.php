<?php if(isset($crumbs)){?>
<table cellspacing="0" cellpadding="0" style="font-size:12px;width:100%;border:none;background-color:#e1e4e9;">
    <tr>
        <td height="30" width="90%" valign="middle" align="left" style="padding-left:8px;color:#555555">
            <img src="images/url_01.gif" />
            <?php foreach($crumbs as $k=>$d){?>
            <label><?php echo $d['name'].' ';?></label>
            <?php }?>
        </td>
    </tr>
</table>
<?php }?>