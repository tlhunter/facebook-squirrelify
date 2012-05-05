<h3>Squirrelify Your Photos!</h3>
<h4>Now, select which photo to squirrelify</h4>
<div id="galleryholder">
<?php
if (!empty($gallery)) {
foreach($gallery as $gal) { ?>
<div class="thumbnail">
<a href="picture/<?=$gal['pid']?>">
<div class="thumb"><fb:photo pid="<?=$gal['pid']?>" size="thumb" /></div>
<?=$gal['caption']?>
</a>
</div>
<?php }
} else {
	echo "<p>This gallery is empty!</p>\n";
}?>
</div>
<div id="adholder">
<a href="http://www.tracklead.net/click.track?CID=103833&AFID=103807&ADID=224700&SID=" target="_blank"><img src="images/mywebface.jpg" border="0" /></a>
</div>
<div style="clear: both;"></div>
<div id="backlink"><a href="<?=base_url()?>">Back to Album Select</a></div>