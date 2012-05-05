<h3>Squirrelify Your Photos!</h3>
<h4>First, select one of your photo galleries</h4>

<div id="galleryholder">
<?php
#print_r($gallery);
if (!empty($gallery)) {
	foreach($gallery as $gal) {

?>
<div class="thumbnail">
<a href="album/<?=$gal['aid']?>">
<div class="thumb"><fb:photo pid="<?=$gal['cover_pid']?>" size="thumb" /></div>
<?=$gal['name']?>
</a>
</div>
<?php 

	}
} else {
	echo "<p>You don't have any photo galleries!</p>\n";
}
?>
</div>
<div id="adholder">
<a href="http://www.tracklead.net/click.track?CID=103833&AFID=103807&ADID=224700&SID=" target="_blank"><img src="images/mywebface.jpg" border="0" /></a>
</div>
<div style="clear: both;"></div>
<h3>Squirrelify Chat Room</h3>
<fb:comments title="Squirrelify Chatroom" width="740px"></fb:comments>