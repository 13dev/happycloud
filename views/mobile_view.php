<?php
/* File:	BitDrop - mobile_view.php - v1.4
 * Date:	June 17, 2013
 * Copyright (C) 2013 by http://codeeverywhere.ca
 */

include('../bitdrop.class.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?=serviceName?> - <?=$_GET['shortURL']?></title>
		<link rel="stylesheet" type="text/css" href="../css/bitdrop-mobile.css" />
		<script type="text/javascript" src="../js/numericalize.js"></script>
		<script type="text/javascript" src="../js/jquery-1.10.1.min.js"></script>
		<meta name = "viewport" content = "user-scalable=no, width=device-width, minimum-scale=0.50, maximum-scale=0.50">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="../images/iphone4-icon.png" />
	</head>
	<body>
	<script type="text/javascript">
	$(function()
	{
		$('.flag').click(function(e)
		{
			e.preventDefault();
			$.ajax({
				type: "POST",
				url: '../controller.php?method=flag',
				data: 'shortURL=' + $(this).attr('data-file'),
				success: function(response){ $('.flag').html(' <span class="red">File has been flagged.</span>'); }
			});
		});
	});	
	</script>
	
	
	<div class="header">
		<div class="wrapper">
			<a class="logo" href="../"><?=serviceName?></a> - <?=$_GET['shortURL']?>
		</div>
	</div>
	
	
	<?php if( $bitdrop->view($_GET['shortURL'], $_POST['password'])): ?>
		
		<div class="wrapper center">
			<a href="../<?=$bitdrop->largePreview?>" class="preview">
				<img src="../<?=$bitdrop->smallPreview?>" />
			</a>
		</div>
	
		<div class="wrapper box">		
			<h2>details</h2>
			<table class="ui-min" style="width: 100%;">
				<tbody>
					<tr>
						<th>Filename</th>
						<td><?=$bitdrop->filename?></td>
					</tr>
					<tr>
						<th>Size</th>
						<td><span class="data"><?=$bitdrop->size?></span></td>
					</tr>
					<tr>
						<th>Expires</th>
						<td><span class="time"><?=$bitdrop->expireDate?></span></td>
					</tr>
					<tr>
						<th>Views</th>
						<td><?=$bitdrop->views?></td>
					</tr>
					<tr>
						<th>Available</th>
						<td><?=$bitdrop->available?></td>
					</tr>
				</tbody>
			</table>
			<a href="../download.php?shortURL=<?=$bitdrop->shortURL?>" class="green-button">Download</a>
			<a href="#" class="white-button flag" data-file="<?=$bitdrop->shortURL?>"><span class="red">&bull;</span> Flag</a>
			
			<hr/>

			<h2>qr code api</h2>
			<img src="http://chart.apis.google.com/chart?cht=qr&chs=500x500&chl=<?=URLPrefix.'://'.yourURL.'/'.$bitdrop->shortURL?>" />
		</div>
	
	<?php elseif($bitdrop->isLocked): ?>
		
		<div class="wrapper box full">
			<form action="../views/download.php?shortURL=<?=$bitdrop->shortURL?>" method="post" >
				<p class="red">Sorry, the document <strong><?=$bitdrop->filename?></strong> is password protected.</p>
				<hr/>
				<input type="password" name="password" placeholder="Password"/>
				<input type="submit" class="white-button" value="Unlock and Download" />
			</form>
		</div>
		
	<?php else: ?>
		
		<div class="wrapper box full">
			<p class="red"><?=$bitdrop->errorMessage?></p>
		</div>
	
	<?php endif; ?>
	
	<div class="footer"><?=bitdropFooter?></div>
	
	</body>
</html>