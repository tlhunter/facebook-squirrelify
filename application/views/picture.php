<div style="width: <?=$base_width?>px; height: <?=$base_height?>px; overflow: hidden; position: relative; margin: 0 auto;">
<img src="<?=$image_url?>" width="<?=$base_width?>" height="<?=$base_height?>" />
<img src="data/squirrel_medium.png" id="squirrel_image" style="position: absolute; z-index: 100; top: <?=$base_height - 150 ?>px; left: <?=$base_width/2 - 40/2 ?>px;" />
</div>
<center style="margin-top: 8px;">Drag these controls to move your squirrel across your picture! Hit Squirrelify Photo when you're done.</center>
<form name="sq_data" method="post" action="picturesave">
<table align="center" width="560">
<tr><td>
<div id="sq_pos" class='sq_slider'></div>
</td><td>
<div id="sq_scale" class='sq_slider'></div>
</td></tr>
<tr><td colspan="2">
<table width="550" align="center">
<tr>
<?php if ($allow_upload) { ?>
<td align="center" width="33%"><input name="action" type="radio" value="upload" checked /> Save on Facebook</td>
<td align="center" width="33%"><input name="action" type="radio" value="download" /> Download Photo</td>
<?php } else { ?>
<td align="center" width="33%"><fb:prompt-permission perms="publish_stream" onclick="window.location='<?=current_url()?>'; return false;">Allow Squirrelify to Upload</fb:prompt-permission></td>
<td align="center" width="33%"><input name="action" type="radio" value="download" checked /> Download Photo</td>
<?php } ?>
<td align="center" width="33%"><input type="submit" value="Squirrelify Photo" /></td>
</tr>
</table>
</td></tr>
</table>

<input type="hidden" name="sq_pos_x" id="sq_pos_x" value="<?=$base_width/2 - 40/2 ?>"  /> <!-- WIDTH / 2 - SQ_WIDTH / 2 -->
<input type="hidden" name="sq_pos_y" id="sq_pos_y" value="<?=$base_height - 150 ?>"  />
<input type="hidden" name="sq_image" value="2"  />
<input type="hidden" name="src_img_x" value="<?=$base_width?>"  />
<input type="hidden" name="src_img_y" value="<?=$base_height?>"  />
<input type="hidden" name="pid" value="<?=$pid?>"  />
</form>
