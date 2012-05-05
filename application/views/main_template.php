<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
	<title>Squirrelify!</title>
	<link rel="icon" type="image/gif" href="<?=base_url()?>favicon.gif" />
	<script src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php" type="text/javascript"></script>
	<link type="text/css" rel="stylesheet" href="<?=base_url()?>style.css" />
	<base href="<?=base_url()?>" />
	<?=$extra_head?>
</head>
<body>
<div id="header">
	<div id="logininfo">
		<?php if ($user_id) { ?>
			<table align="right">
			<tr><td valign="center"><?=$user['first_name']?> <?=$user['last_name']?></td>
			<td rowspan="3" valign="center"><img class="profile_square" src="<?=$user['pic_square']?>" /></td></tr>
			<tr><td valign="center"><a href="logout" onclick="FB.Connect.logout(function() { window.location='<?=current_url()?>' }); return false;" >Logout from Facebook & App</a></td></tr>
			<tr><td valign="center"><a href="/">Back to Squirrelify Home</a></td></tr>
			</table>
		<?php } else { ?>
			<div id="buttonpadder">
				<fb:login-button onlogin="window.location='<?=current_url()?>'"></fb:login-button>
			</div>
		<?php } ?>
	</div>
</div>
<center><h4><fb:prompt-permission perms="publish_stream">Click here to give Squirrelify permission to post pictures.<br /><small>(Otherwise you can only download your pictures)</small></fb:prompt-permission></h4></center>
<?=$contents?>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-1577519-9");
pageTracker._trackPageview();
} catch(err) {}</script>
<script type="text/javascript">
	FB.init("<?=$this->config->item('facebook_api_key')?>", "/xd_receiver.htm", {"doNotUseCachedConnectState":true});
</script>
</body>
</html>